<?php

class Smartcrawl_Controller_Onboard extends Smartcrawl_Base_Controller {

	use Smartcrawl_Singleton;

	const ONBOARDING_DONE_OPTION = 'wds-onboarding-done';

	/**
	 * Dispatches action listeners for admin pages
	 *
	 * @return void
	 */
	public function dispatch_actions() {
		add_action( 'wds-dshboard-after_settings', array( $this, 'add_onboarding' ) );

		add_action( 'wp_ajax_wds-boarding-toggle', array( $this, 'process_boarding_action' ) );
		add_action( 'wp_ajax_wds-boarding-skip', array( $this, 'process_boarding_skip' ) );
	}

	public function process_boarding_skip() {
		$this->mark_onboarding_done();

		wp_send_json_success();
	}

	public function process_boarding_action() {
		$data   = $this->get_request_data();
		$target = ! empty( $data['target'] ) ? sanitize_key( $data['target'] ) : false;
		$enable = empty( $data['enable'] ) ? false : true;

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();

			return;
		}

		// Throw the switch on onboarding.
		$this->mark_onboarding_done();

		switch ( $target ) {
			case 'analysis-enable':
				$opts                         = Smartcrawl_Settings::get_specific_options( 'wds_settings_options' );
				$opts['analysis-seo']         = $enable;
				$opts['analysis-readability'] = $enable;
				Smartcrawl_Settings::update_specific_options( 'wds_settings_options', $opts );
				wp_send_json_success();

				return;
			case 'opengraph-twitter-enable':
				$opts                        = Smartcrawl_Settings::get_component_options( Smartcrawl_Settings::COMP_SOCIAL );
				$opts['og-enable']           = $enable;
				$opts['twitter-card-enable'] = $enable;
				Smartcrawl_Settings::update_component_options( Smartcrawl_Settings::COMP_SOCIAL, $opts );
				wp_send_json_success();

				return;
			case 'sitemaps-enable':
				$opts            = Smartcrawl_Settings::get_specific_options( 'wds_settings_options' );
				$opts['sitemap'] = $enable;
				Smartcrawl_Settings::update_specific_options( 'wds_settings_options', $opts );
				wp_send_json_success();

				return;

			case 'robots-txt-enable':
				$opts               = Smartcrawl_Settings::get_specific_options( 'wds_settings_options' );
				$opts['robots-txt'] = $enable;
				Smartcrawl_Settings::update_specific_options( 'wds_settings_options', $opts );
				wp_send_json_success();
				return;

			default:
				wp_send_json_error();
				return;
		}
	}

	public function add_onboarding() {
		if ( $this->onboarding_done() ) {
			return;
		}

		Smartcrawl_Simple_Renderer::render( 'dashboard/onboarding' );
	}

	/**
	 * Bind listening actions
	 *
	 * @return bool
	 */
	public function init() {
		add_action( 'admin_init', array( $this, 'dispatch_actions' ) );

		return true;
	}

	/**
	 * Unbinds listening actions
	 *
	 * @return bool
	 */
	protected function terminate() {
		remove_action( 'admin_init', array( $this, 'dispatch_actions' ) );

		return true;
	}

	private function get_request_data() {
		return isset( $_POST['_wds_nonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wds_nonce'] ), 'wds-onboard-nonce' ) ? stripslashes_deep( $_POST ) : array(); // phpcs:ignore
	}

	public function get_onboarding_done_version() {
		return Smartcrawl_Settings::get_specific_options( self::ONBOARDING_DONE_OPTION );
	}

	public function onboarding_done() {
		$version = $this->get_onboarding_done_version();
		return ! empty( $version );
	}

	public function mark_onboarding_done() {
		Smartcrawl_Settings::update_specific_options( self::ONBOARDING_DONE_OPTION, SMARTCRAWL_VERSION );
	}
}
