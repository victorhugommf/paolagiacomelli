<?php
/**
 * Import and export settings admin handler
 *
 * @package wpmu-dev-seo
 */

/**
 * IO controller class
 */
class Smartcrawl_Controller_Third_Party_Import extends Smartcrawl_WorkUnit {

	use Smartcrawl_Singleton;

	/**
	 * Controller state flag
	 *
	 * @var bool
	 */
	private $is_running = false;

	/**
	 * Boot controller listeners
	 *
	 * Do it only once, if they're already up do nothing
	 *
	 * @return bool Status
	 */
	public static function serve() {
		$me = self::get();
		if ( $me->is_running() ) {
			return false;
		}

		return $me->add_hooks();
	}

	/**
	 * Check if we already have the actions bound
	 *
	 * @return bool Status
	 */
	public function is_running() {
		return $this->is_running;
	}

	/**
	 * Bind listening actions
	 *
	 * @return bool
	 */
	private function add_hooks() {

		add_action( 'wp_ajax_import_yoast_data', array( $this, 'import_yoast_data' ) );
		add_action( 'wp_ajax_import_aioseop_data', array( $this, 'import_aioseop_data' ) );

		$this->is_running = true;

		return true;
	}

	/**
	 * Stops controller listeners
	 *
	 * @return bool
	 */
	public static function stop() {
		$me = self::get();
		if ( ! $me->is_running() ) {
			return false;
		}

		return $me->remove_hooks();
	}

	/**
	 * Unbinds listening actions
	 *
	 * @return bool
	 */
	private function remove_hooks() {
		$this->is_running = false;

		return true;
	}

	/**
	 * Filter prefix getter
	 *
	 * @return string
	 */
	public function get_filter_prefix() {
		return 'wds-controller-io';
	}

	public function import_yoast_data() {
		$options = $this->get_import_options_from_request();
		$this->do_import( new Smartcrawl_Yoast_Importer(), $options );
	}

	/**
	 * Do import.
	 *
	 * @param Smartcrawl_Importer $importer Importer.
	 * @param array               $options  Options.
	 */
	private function do_import( $importer, $options = array() ) {
		$result = array();

		if ( ! $this->user_has_permission_to_import() ) {
			$result['message'] = __( "You don't have permission to perform this operation.", 'wds' );
			wp_send_json_error( $result );
		}

		if ( ! $importer->data_exists() ) {
			$result['message'] = __( "We couldn't find any compatible data to import.", 'wds' );
			wp_send_json_error( $result );
		}

		if ( is_multisite() ) {
			$importer->import_for_all_sites( $options );
			$in_progress = $importer->is_network_import_in_progress();
		} else {
			$importer->import( $options );
			$in_progress = $importer->is_import_in_progress();
		}

		$result['in_progress']      = $in_progress;
		$result['status']           = $importer->get_status();
		$result['deactivation_url'] = $importer->get_deactivation_link();

		wp_send_json_success( $result );
	}

	private function user_has_permission_to_import() {
		if ( ! is_network_admin() && ! is_admin() ) {
			return false;
		}
		if ( is_network_admin() && ! current_user_can( 'manage_network_options' ) ) {
			return false;
		}
		if ( is_admin() && ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		return true;
	}

	public function import_aioseop_data() {
		$options = $this->get_import_options_from_request();
		$this->do_import( new Smartcrawl_AIOSEOP_Importer(), $options );
	}

	private function get_request_data() {
		if ( isset( $_POST['_wds_nonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wds_nonce'] ), 'wds-io-nonce' ) ) { // phpcs:ignore
			return stripslashes_deep( $_POST );
		} else {
			if ( ! empty( $_POST['io-action'] ) ) {
				$this->add_error( 'io-nonce-failure', __( 'Invalid parameters. Try refreshing the page and attempting again.', 'wds' ) );
			}
		}

		return array();
	}

	private function get_import_options_from_request() {
		$request_data             = $this->get_request_data();
		$options                  = smartcrawl_get_array_value( $request_data, 'items_to_import' );
		$options['force-restart'] = (bool) smartcrawl_get_array_value( $request_data, 'restart' );

		return empty( $options ) ? array() : $options;
	}
}

