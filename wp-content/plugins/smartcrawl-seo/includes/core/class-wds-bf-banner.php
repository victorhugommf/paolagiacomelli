<?php
/**
 * Initializes black friday banner.
 *
 * @since   3.3.3
 * @package Smartcrawl
 */

/**
 * Class Smartcrawl_BF_Banner
 */
class Smartcrawl_BF_Banner extends Smartcrawl_Base_Controller {

	use Smartcrawl_Singleton;

	/**
	 * Initialize the class.
	 *
	 * @since 3.3.3
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'admin_init', array( $this, 'init_banner' ) );
	}

	/**
	 * Initialize the banner module.
	 *
	 * @since 3.3.3
	 *
	 * @return void
	 */
	public function init_banner() {
		$this->load_module();

		if ( class_exists( 'WPMUDEV\BlackFriday\Banner' ) ) {
			new \WPMUDEV\BlackFriday\Banner(
				array(
					'close'       => __( 'Close', 'wds' ),
					'get_deal'    => __( 'Get deal', 'wds' ),
					'intro'       => __( 'Black Friday offer for WP businesses and agencies', 'wds' ),
					'off'         => __( 'Off', 'wds' ),
					'title'       => __( 'Everything you need to run your WP business for', 'wds' ),
					'discount'    => __( '83.5', 'wds' ),
					'price'       => __( '3000', 'wds' ),
					'description' => __( 'From the creators of SmartCrawl, WPMU DEV’s all-in-one platform gives you all the Pro tools and support you need to run and grow a web development business. Trusted by over 50,000 web developers. Limited deals available.', 'wds' ),
				),
				'https://wpmudev.com/black-friday/?coupon=BFP-2022&utm_source=smartcrawl&utm_medium=plugin&utm_campaign=BFP-2022-smartcrawl&utm_id=BFP-2022&utm_term=BF-2022-plugin-SmartCrawl&utm_content=BF-2022',
				\WPMUDEV\BlackFriday\Banner::SMARTCRAWL
			);
		}
	}

	/**
	 * Load the banner module class.
	 *
	 * @since 3.3.3
	 *
	 * @return void
	 */
	private function load_module() {
		$file_path = SMARTCRAWL_PLUGIN_DIR . 'external/black-friday/banner.php';
		if ( ! file_exists( $file_path ) ) {
			return;
		}

		require_once $file_path;
	}
}
