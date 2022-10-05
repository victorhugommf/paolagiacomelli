<?php

$file_path = SMARTCRAWL_PLUGIN_DIR . 'recommended-plugins-notice/notice.php';
if ( ! file_exists( $file_path ) ) {
	return;
}

require_once $file_path;

class Smartcrawl_Recommended_Plugins extends Smartcrawl_Base_Controller {

	use Smartcrawl_Singleton;

	protected function init() {
		do_action(
			'wpmudev-recommended-plugins-register-notice', // phpcs:ignore
			SMARTCRAWL_PLUGIN_BASENAME,
			'SmartCrawl', // Plugin Name.
			array(
				'toplevel_page_wds_wizard',
				'smartcrawl_page_wds_health',
				'smartcrawl_page_wds_onpage',
				'smartcrawl_page_wds_social',
				'smartcrawl_page_wds_sitemap',
				'smartcrawl_page_wds_autolinks',
				'smartcrawl_page_wds_settings',
			),
			array( 'after', '.sui-wrap .sui-header' )
		);

		return true;
	}
}
