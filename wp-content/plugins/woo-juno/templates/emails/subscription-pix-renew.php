<?php
/**
 * Subscription Pix Renew email template.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php echo wptexturize( wpautop( $email_message ) ); ?>

<?php

if ( $display_details ) {
  /**
   * @hooked WC_Emails::order_details() Shows the order details table.
   * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
   * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
   */
  do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

  /**
   * Order meta.
   *
   * @hooked WC_Emails::order_meta() Shows order meta data.
   */
  do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
}

/**
 * Email footer.
 *
 * @hooked WC_Emails::email_footer() Output the email footer.
 */
do_action( 'woocommerce_email_footer', $email );
