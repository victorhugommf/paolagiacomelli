<?php
$message = esc_html__( 'OpenGraph is globally disabled.', 'wds' );
if ( Smartcrawl_Settings_Admin::is_tab_allowed( Smartcrawl_Settings::TAB_SOCIAL ) ) {
	$social_page = Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings::TAB_SOCIAL );
	$message     = sprintf(
		esc_html__( '%1$s You can enable it %2$s.', 'wds' ),
		$message,
		sprintf(
			'<a href="%s">%s</a>',
			esc_url_raw( add_query_arg( 'tab', 'tab_open_graph', $social_page ) ),
			esc_html__( 'here', 'wds' )
		)
	);
}

$this->render_view(
	'notice',
	array(
		'class'   => 'sui-notice-info',
		'message' => $message,
	)
);
