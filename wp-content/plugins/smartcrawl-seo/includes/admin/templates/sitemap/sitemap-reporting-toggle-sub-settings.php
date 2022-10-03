<?php
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
$email_recipients = empty( $email_recipients ) ? array() : $email_recipients;
?>
<small><strong><?php esc_html_e( 'Recipients', 'wds' ); ?></strong></small>
<div class="wds-recipients sui-recipients" id="wds-email-recipients"></div>
<p></p>

<small><strong><?php esc_html_e( 'Schedule', 'wds' ); ?></strong></small>

<?php $this->_render( 'reporting-schedule', array(
	'component' => 'crawler',
	'frequency' => empty( $_view['options']['crawler-frequency'] ) ? false : $_view['options']['crawler-frequency'],
	'dow_value' => isset( $_view['options']['crawler-dow'] ) ? $_view['options']['crawler-dow'] : false,
	'tod_value' => isset( $_view['options']['crawler-tod'] ) ? $_view['options']['crawler-tod'] : false,
) ); ?>
