<?php

namespace WC_Juno\Emails;

use WC_Email;
use WC_Juno\functions as h;

class Pix_Subscription_Renew_Notification extends WC_Email {

	/**
	 * Initialize tracking template.
	 */
	public function __construct() {
		$this->id               = 'juno_renew_pix';
		$this->title            = __( 'Juno: e-mail sobre renovação com Pix', 'woo-juno' );
		$this->customer_email   = true;
		$this->description      = __( 'E-mail com o QR code de pagamento enviado para o cliente durante o processo de renovação de uma assinatura.', 'woo-juno' );
		$this->heading          = __( 'Renove sua assinatura', 'woo-juno' );
		$this->subject          = __( '[{site_title}] Renove sua assinatura com Pix', 'woo-juno' );
		$this->message          = __( 'Olá, o Pix para renovação de sua assinatura em {site_title} já está disponível.', 'woo-juno' )
									. PHP_EOL . ' ' . PHP_EOL
									. __( 'Veja abaixo os detalhes do pagamento.', 'woo-juno' )
									. '{pix_details}'
                  . __( 'Obrigado!', 'woo-juno' );
		$this->email_message    = $this->get_option( 'email_message', $this->message );
		$this->template_html    = 'emails/subscription-pix-renew.php';

		// Call parent constructor.
		parent::__construct();
		$this->template_base = h\config_get( 'ROOT_DIR' ) . '/templates/';
		$this->email_type    = 'html';
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Ativar/Desativar', 'woo-juno' ),
				'type'    => 'checkbox',
				'label'   => __( 'Habilitar este e-mail de notificação', 'woo-juno' ),
				'default' => 'yes',
			),
			'subject' => array(
				'title'       => __( 'Assunto', 'woo-juno' ),
				'type'        => 'text',
				'description' => sprintf( __( 'Assunto do e-mail', 'woo-juno' ), $this->subject ),
				'placeholder' => $this->subject,
				'default'     => '',
				'desc_tip'    => true,
			),
			'heading' => array(
				'title'       => __( 'Cabeçalho', 'woo-juno' ),
				'type'        => 'text',
				'description' => sprintf( __( 'Cabeçalho exibido no e-mail.', 'woo-juno' ), $this->heading ),
				'placeholder' => $this->heading,
				'default'     => '',
				'desc_tip'    => true,
			),
			'email_message' => array(
				'title'       => __( 'Mensagem', 'woo-juno' ),
				'type'        => 'textarea',
				'description' => sprintf( __( 'Mensagem padrão do e-mail.', 'woo-juno' ), $this->message ),
				'placeholder' => $this->message,
				'default'     => '',
				'desc_tip'    => true,
			),
		);
	}

	/**
	 * Get email tracking message.
	 *
	 * @return string
	 */
	public function get_email_message() {
		return $this->format_string( $this->email_message );
	}

	/**
	 * Trigger email.
	 *
	 * @param  int      $order_id      Order ID.
	 * @param  WC_Order $order         Order data.
	 * @param  string   $tracking_code Tracking code.
	 */
	public function trigger( $order ) {
		// Get the order object while resending emails.
		if ( ! is_a( $order, 'WC_Order' ) ) {
			return;
		}

		// refresh from DB
		$order = wc_get_order( $order->get_id() );

		$this->object    = $order;
		$this->recipient = $order->get_billing_email();

    $base64_payload = $order->get_meta( 'juno_qrcode_payload_base64' );

    if ( ! $base64_payload ) {
      return;
    }

    $payload = base64_decode( $base64_payload );

    ob_start();

    $gateway = wc_get_payment_gateway_by_order( $order );

    h\include_wc_template(
      'checkout/juno/pix/thankyou.php',
      [
        'id'               => $this->id,
        'instructions'     => wpautop( wptexturize( $gateway->instructions ) ),
        'payload'          => $payload,
        'qrcode_image'	   => h\generate_qrcode( $payload ),
        'is_email'         => true,
        'order'            => $order,
      ]
    );

    $pix_details = ob_get_clean();

		$this->placeholders['{order_number}']  = $this->object->get_order_number();
    $this->placeholders['{pix_details}']   = $pix_details;

		if ( ! $this->get_recipient() ) {
			return;
		}

		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}

	/**
	 * Get content HTML.
	 *
	 * @return string
	 */
	public function get_content_html() {
		ob_start();

		wc_get_template( $this->template_html, array(
			'order'            => $this->object,
			'email_heading'    => $this->get_heading(),
			'email_message'    => $this->get_email_message(),
			'display_details'  => \apply_filters(
				h\prefix( 'pix_email_display_order_details' ), false ),
			'sent_to_admin'    => false,
			'plain_text'       => false,
			'email'            => $this,
		), '', $this->template_base );

		return ob_get_clean();
	}
}
