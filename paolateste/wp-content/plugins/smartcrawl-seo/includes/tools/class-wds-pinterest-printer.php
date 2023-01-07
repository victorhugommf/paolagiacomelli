<?php
/**
 * Class Smartcrawl_Pinterest_Printer
 *
 * @package SmartCrawl
 */

/**
 * Outputs Twitter cards data to the page
 */
class Smartcrawl_Pinterest_Printer extends Smartcrawl_WorkUnit {

	use Smartcrawl_Singleton;

	/**
	 * Is running flag.
	 *
	 * @var bool $is_running
	 */
	private $is_running = false;

	/**
	 * Is done flag.
	 *
	 * @var bool $is_done
	 */
	private $is_done = false;

	/**
	 * Boot the hooking part
	 */
	public static function run() {
		self::get()->add_hooks();
	}

	/**
	 * Dispatch tag injection.
	 *
	 * @return false|void
	 */
	public function dispatch_tags_injection() {
		if ( ! ! $this->is_done ) {
			return false;
		}
		$verify = $this->get_verify_content();
		if ( empty( $verify ) ) {
			return false;
		}

		$this->is_done = true;

		echo "{$verify}\n"; // phpcs:ignore -- The value has been escaped before reaching this point
	}

	/**
	 * Gets pinterest meta verification tag
	 *
	 * Verbatim HTML
	 *
	 * @return string Pinterest verification tag
	 */
	public function get_verify_content() {
		$options = Smartcrawl_Settings::get_component_options( Smartcrawl_Settings::COMP_SOCIAL );
		$tag     = is_array( $options ) && ! empty( $options['pinterest-verify'] )
			? $options['pinterest-verify']
			: '';

		return $this->get_verified_tag( $tag );
	}

	/**
	 * Gets cleaned up and verified meta tag
	 *
	 * @param string $tag HTML to clean up.
	 *
	 * @return string Verified tag
	 */
	public function get_verified_tag( $tag ) {
		$sane = trim(
			wp_kses(
				$tag,
				array(
					'meta' => array(
						'name'    => array(),
						'content' => array(),
					),
				),
				array( 'http', 'https' )
			)
		);

		return ! ! preg_match( '/<meta/i', $sane )
			? $sane
			: '';
	}

	/**
	 * Get prefix for filters.
	 *
	 * @return string
	 */
	public function get_filter_prefix() {
		return 'wds-pinterest';
	}

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	private function add_hooks() {
		// Do not double-bind.
		if ( $this->apply_filters( 'is_running', $this->is_running ) ) {
			return;
		}

		add_action( 'wp_head', array( $this, 'dispatch_tags_injection' ), 50 );
		add_action( 'wds_head-after_output', array( $this, 'dispatch_tags_injection' ) );

		$this->is_running = true;
	}
}
