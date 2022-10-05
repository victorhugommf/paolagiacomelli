<?php
$settings_errors = Smartcrawl_Controller_Third_Party_Import::get()->get_errors();
?>
<div class="sui-floating-notices">
	<?php
	if ( 'success' === smartcrawl_get_array_value( $_GET, 'import' ) ) { // phpcs:ignore
		$this->render_view(
			'floating-notice',
			array(
				'code'      => 'wds-crawl-started',
				'type'      => 'success',
				'message'   => esc_html__( 'Settings successfully imported', 'wds' ),
				'autoclose' => true,
			)
		);
	} elseif ( ! empty( $settings_errors ) ) {
		$this->render_view(
			'floating-notice',
			array(
				'code'      => 'wds-import-error',
				'type'      => 'error',
				'message'   => array_shift( $settings_errors ),
				'autoclose' => false,
			)
		);
	}
	?>
</div>
