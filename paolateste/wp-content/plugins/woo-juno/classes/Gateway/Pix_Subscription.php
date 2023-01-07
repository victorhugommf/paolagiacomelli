<?php

namespace WC_Juno\Gateway;

use Exception;
use WC_Juno\functions as h;

class Pix_Subscription extends Pix {

  /**
   * the current subscription ID being processed
   *
   * @var null
   */
  private $subscription_id = null;

	public function __construct () {
    parent::__construct();

    if ( 2 > $this->api->version ) {
      add_action( 'admin_notices', [ $this, 'api_version_not_compatible' ] );
      return;
    }

    if ( class_exists( '\WC_Subscriptions_Order' ) ) {
      add_action( 'woocommerce_scheduled_subscription_payment_' . $this->id, [ $this, 'scheduled_subscription_payment' ], 10, 2 );

      add_action( 'woocommerce_subscription_date_updated', [ $this, 'subscription_date_updated' ], 200, 3 );

      add_action( 'woocommerce_subscription_date_deleted', [ $this, 'subscription_date_deleted' ], 20, 2 );

      add_action( h\prefix( 'pix_subscription_schedule' ), [ $this, 'subscription_schedule_invoice' ], 10, 1 );

      add_action( h\prefix( 'notification_processed' ), [ $this, 'notification_processed' ], 10, 2 );

      $this->supports = [
        'products',
        'subscriptions',
        'subscription_cancellation',
        'subscription_suspension',
        'subscription_reactivation',
        'subscription_amount_changes',
        'subscription_date_changes',
        'subscription_payment_method_change',
        'subscription_payment_method_change_customer',
        'subscription_payment_method_change_admin',
        'multiple_subscriptions',
      ];
    }
  }



  public function process_payment( $order_id, $is_frontend = true ) {
    // process only subscriptions!
		if ( ! $this->is_subscription() ) {
      return parent::process_payment( $order_id, $is_frontend );
    }

    // just get the card hash
    if ( 0 === $this->get_order_total() ) {
      $order = wc_get_order( $order_id );

      // Remove cart.
      WC()->cart->empty_cart();

      if ( is_a( $order, '\WC_Subscription' ) ) {
        $order->add_order_note( 'Pagamento atualizado sem cobrança.' );
      } else {
        $order->update_status( 'processing', 'Compra recorrente sem valor inicial.' );
      }

      // Return thankyou redirect.
      return array(
        'result'   => 'success',
        'redirect' => $this->get_return_url( $order ),
      );
    }

    return parent::process_payment( $order_id, $is_frontend );
  }


  /**
   * Charge recurring subscription
   *
   * @param float $amount_to_charge
   * @param WC_Order $renewal_order
   * @return void
   */
  public function scheduled_subscription_payment( $amount_to_charge, $renewal_order ) {
    $subscription_id = $renewal_order->get_meta( '_subscription_renewal' );

    if ( ! $subscription_id ) {
      $renewal_order->add_order_note( __( 'Assinatura não encontrada.', 'woo-juno' ) );
      $renewal_order->payment_failed( 'cancelled' );
      return;
    }

    $subscription = new \WC_Subscription( $subscription_id );

    // pix already sent to customer
    if ( $subscription->get_meta( 'juno_qrcode_id' ) ) {
      $this->log( 'Renovação já enviada.' );
      return;
    }

    try {
      $this->subscription_schedule_invoice( $subscription_id, $renewal_order );

      $renewal_order->add_order_note( __( 'Novo Pix enviado ao cliente.', 'woo-juno' ) );
    } catch ( \Exception $e ) {
      // if the order was processed, don't do anything
      // await the webhooks!
      $renewal_order->update_status( 'on-hold', sprintf( __( 'Falha na cobrança recorrente com Pix: %s', 'woo-juno' ), $e->getMessage() ) );
    }
  }


  /**
   * Schedule the bank slip notification before the
   * subscription expires and prevent suspensions time
   *
   * @param WC_Subscription $subscription
   * @param string $date_type
   * @param string $datetime
   * @return void
   */
  public function subscription_date_updated( $subscription, $date_type, $datetime ) {
    if ( 'next_payment' !== $date_type ) {
      return;
    }

    $parent_order = $subscription->get_parent();

    if ( ! $parent_order || $this->id !== $parent_order->get_payment_method() ) {
      return;
    }

    // TODO
    // check if the subscription interval is less than biweekly
    // doesn't make sense before that
    // if ( '' ) {
    //   // return;
    // }


    /**
     * interval before the subscription expires
     * to send the first copy of the bank slip
     */
    $days_before_expire = apply_filters( h\prefix( 'pix_subscription_days_before_expire' ), 3, $subscription );

    // first, delete any possible old actions
    as_unschedule_all_actions(
      h\prefix( 'pix_subscription_schedule' ),
      [
        'subscription_id' => $subscription->get_id()
      ]
    );

    // schedule the new bank slip to be processed
    // $days_before_expire before the actual expiration time
    as_schedule_single_action(
      strtotime( "-$days_before_expire days", strtotime( $datetime ) ),
      h\prefix( 'pix_subscription_schedule' ),
      [
        'subscription_id' => $subscription->get_id(),
      ],
      'juno_pix_subscription'
    );
  }


  /**
   * if WooCommerce Subscription removes the scheduled event
   * we should do the same
   *
   * @param WC_Subscription $subscription
   * @param string $date_type
   * @return void
   */
  public function subscription_date_deleted( $subscription, $date_type ) {
    if ( 'next_payment' !== $date_type ) {
      return;
    }

    $parent_order = $subscription->get_parent();

    if ( ! $parent_order || $this->id !== $parent_order->get_payment_method() ) {
      return;
    }

    // cancelar todos os pix da juno desse pedido
    // posteriormente eles todos recriados quando o novo hook for criado!
    as_unschedule_all_actions(
      h\prefix( 'pix_subscription_schedule' ),
      [
        'subscription_id' => $subscription->get_id()
      ]
    );
  }


  /**
   * Generate new bank slip for subscription
   *
   * @param int $subscription_id
   * @param WC_Order $renewal_order renewal order or create a new one
   * @return void
   */
  public function subscription_schedule_invoice( $subscription_id, $renewal_order = false ) {
    $subscription = new \WC_Subscription( $subscription_id );

    // subscription must exists
    if ( ! $subscription ) {
      return;
    }

    // está fazendo um envio de Pix prévio, antes do ciclo real. então ela ainda precisa estar ativa
    if ( ! $renewal_order && ! $subscription->has_status( 'active' ) ) {
      $this->log( 'Status inválido: ' . $subscription->get_status() );
      return;
    }

    $next_payment_date = $subscription->get_date( 'next_payment' );
    $slug = $this->get_method_slug();

    // set the current subscription ID
    $this->subscription_id = $subscription->get_id();

    // WooCommerce Subscription next payment interval
    $next_payment_date = $subscription->get_date( 'next_payment' );

    if ( ! $renewal_order ) {
      // create the renewal order
      $renewal_order = wcs_create_renewal_order( $subscription );

      // update payment method
      $renewal_order->set_payment_method( wc_get_payment_gateway_by_order( $subscription ) );

      $renewal_order->add_order_note( __( 'Assinatura Juno: enviado primeira cobrança Pix. Assinatura expira em ' . $next_payment_date, 'woo-juno' ) );
    }

    // Juno bank slip specific reference
    $renewal_order->update_meta_data( '_juno_pix_subscription_renewal', true );

    $renewal_order->save();

    // generate pix renewal order
    try {
      add_filter( h\prefix( 'payment_' . $slug . '_api_params' ), [ $this, 'subscription_schedule_invoice_params' ], 100, 1 );

      $result = parent::process_payment( $renewal_order->get_id(), false );

      // get fresh data from database
      $response = get_post_meta( $renewal_order->get_id(), '_juno_payment_response', true );

      // TODO: notify customer! and disable the forced Juno notification
      $mailer       = WC()->mailer();
      $notification = isset( $mailer->emails['juno_renew_pix'] ) ? $mailer->emails['juno_renew_pix'] : null;

      if ( $notification && 'yes' === $notification->enabled ) {
        $notification->trigger( $renewal_order );
      }

      remove_filter( h\prefix( 'payment_' . $slug . '_api_params' ), [ $this, 'subscription_schedule_invoice_params' ], 100 );
    } catch (\Exception $e) {
      // $e->getMessage();
    }
  }



  /**
   * Custom invoice params
   *
   * @param mixed $params
   * @return void
   */
  public function subscription_schedule_invoice_params( $params ) {
    // should not be used outside the right scope
    if ( empty( $this->subscription_id ) ) {
      return $params;
    }

    if ( ! isset( $params[''] ) ) {
      return $params;
    }

    $params['additionalData'][] = [
      'name' => 'ID da assinatura',
      'value' => $this->subscription_id,
    ];

    $params['expiration'] = 48 * 60; // 2 days

    return $params;
  }



  /**
   * Process custom webhook data
   *
   * @param WC_Order $order
   * @param object $notification
   * @return void
   */
  public function notification_processed( $order, $notification ) {
    if ( $this->id !== $order->get_payment_method() ) {
      return;
    }

    $subscription_id = $order->get_meta( '_subscription_renewal' );

    // regular payment
    if ( ! $subscription_id ) {
      return;
    }

    // is Juno pix renewal?
    if ( ! $order->get_meta( '_juno_pix_subscription_renewal' ) ) {
      return;
    }

    $subscription = new \WC_Subscription( $subscription_id );

    if ( ! $subscription ) {
      return;
    }

    if ( ! isset( $notification[0]->attributes->status ) || 'CONFIRMED' !== $notification[0]->attributes->status ) {
      return;
    }

    // next payment - if shop is not using the "sync" method, the customer may lost some days
    $calculated_next_payment = $subscription->calculate_date( 'next_payment' );

    $subscription->update_dates( array(
    	'next_payment' => $calculated_next_payment,
    ) );

    $subscription->add_order_note( __( 'Pix Juno foi pago. Assinatura renovada' , 'woo-juno' ) );

    $subscription->save();
  }


  /**
   * Only API V2 or greater is allowed
   *
   * @return void
   */
  public function api_version_not_compatible() {
    h\include_php_template( 'admin-notice.php', [
      'message' => __( 'Juno para WooCommerce requer a API na versão 2 para funcionar com assinaturas. Atualize suas configurações.', 'woo-juno' ),
      'class'   => 'error juno-urgent'
    ] );
  }
}
