<?php

class Smartcrawl_Lighthouse_Is_Crawlable_Check extends Smartcrawl_Lighthouse_Check {
	const ID = 'is-crawlable';
	/**
	 * @var bool|mixed|void
	 */
	private $is_blog_public;
	/**
	 * @var bool
	 */
	private $is_home_noindex;

	/**
	 * @param $report
	 */
	public function __construct( $report ) {
		$this->is_blog_public  = $this->is_blog_public();
		$this->is_home_noindex = $this->is_home_noindex();

		parent::__construct( $report );
	}

	/**
	 * @return void
	 */
	public function prepare() {
		$this->set_success_title( esc_html__( "Page isn't blocked from indexing", 'wds' ) );
		$this->set_failure_title( esc_html__( 'Page is blocked from indexing', 'wds' ) );
		$this->set_success_description( $this->format_success_description() );
		$this->set_failure_description( $this->format_failure_description() );
		$this->set_copy_description( $this->format_copy_description() );
	}

	/**
	 * @return void
	 */
	private function print_common_description() {
		?>
		<div class="wds-lh-section">
			<strong><?php esc_html_e( 'Overview', 'wds' ); ?></strong>
			<p><?php esc_html_e( "Search engines can only show pages in their search results if those pages don't explicitly block indexing by search engine crawlers. Some HTTP headers and meta tags tell crawlers that a page shouldn't be indexed.", 'wds' ); ?></p>
			<p><?php esc_html_e( "Only block indexing for content that you don't want to appear in search results.", 'wds' ); ?></p>
		</div>
		<?php
	}

	/**
	 * @return false|string
	 */
	private function format_success_description() {
		ob_start();
		$this->print_common_description();
		?>
		<div class="wds-lh-section">
			<strong><?php esc_html_e( 'Status', 'wds' ); ?></strong>
			<?php
			Smartcrawl_Simple_Renderer::render(
				'notice',
				array(
					'class'   => 'sui-notice-success',
					'message' => esc_html__( 'Page is crawlable', 'wds' ),
				)
			);
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * @return false|string
	 */
	private function format_failure_description() {
		ob_start();
		$this->print_common_description();
		?>
		<div class="wds-lh-section">
			<strong><?php esc_html_e( 'Status', 'wds' ); ?></strong>
			<?php
			Smartcrawl_Simple_Renderer::render(
				'notice',
				array(
					'class'   => 'sui-notice-warning',
					'message' => $this->get_warning_message(),
				)
			);
			?>

			<?php $this->print_details_table(); ?>
		</div>

		<?php if ( ! $this->is_blog_public || $this->is_home_noindex ) : ?>
			<div class="wds-lh-section">
				<strong><?php esc_html_e( 'How to ensure search engines can crawl your page', 'wds' ); ?></strong>

				<?php
				if ( ! $this->is_blog_public ) :
					$this->print_search_engine_visibility_fix();
				elseif ( $this->is_home_noindex ) :
					$this->print_sc_title_and_meta_fix();
				endif;
				?>
			</div>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}

	/**
	 * @return string
	 */
	private function get_warning_message() {
		$default = esc_html__( 'Page is not crawlable', 'wds' );
		if ( ! $this->is_blog_public ) {
			return sprintf(
				esc_html__( 'Your WordPress Settings are currently to %s this site.', 'wds' ),
				'<strong>' . esc_html__( 'Discourage search engines from indexing', 'wds' ) . '</strong>'
			);
		} elseif ( $this->is_home_noindex ) {
			return sprintf(
				esc_html__( 'Your SmartCrawl Settings are currently set to %s.', 'wds' ),
				'<strong>' . esc_html__( 'No Index', 'wds' ) . '</strong>'
			);
		} else {
			return $default;
		}
	}

	/**
	 * @return void
	 */
	private function print_sc_title_and_meta_fix() {
		?>
		<p>
			<?php
			printf(
				esc_html__( 'Go to %s and enable the indexing option for your Homepage. Indexing enables you to configure how you want your website to appear in search results.', 'wds' ),
				'<strong>' . esc_html__( 'SmartCrawl > Titles & Meta', 'wds' ) . '</strong>'
			);
			?>
		</p>
		<?php
	}

	/**
	 * @return void
	 */
	private function print_search_engine_visibility_fix() {
		?>
		<p><?php esc_html_e( 'Preventing search engine bots from indexing your site is generally not recommended. However, if this is intentional (you’re still in development) you can ignore this recommendation.', 'wds' ); ?></p>
		<p>
			<?php
			printf(
				esc_html__( 'In the %1$s area, the %2$s has a checkbox labelled Search Engine Visibility. Make sure the checkbox is not selected and click Save Changes. If this warning is still displaying after running another audit, it’s likely the <meta> tag has been hardcoded to your theme files, or is being output from another plugin. Contact your web developer to take a look and fix up the issue.', 'wds' ),
				'<strong>' . esc_html__( 'WordPress Settings', 'wds' ) . '</strong>',
				'<strong>' . esc_html__( 'Reading tab', 'wds' ) . '</strong>'
			);
			?>
		</p>
		<?php
	}

	/**
	 * @return bool
	 */
	private function is_home_noindex() {
		$posts_on_front = 'posts' === get_option( 'show_on_front' ) || 0 === (int) get_option( 'page_on_front' );

		if ( $posts_on_front ) {
			$home_robots = ( new Smartcrawl_Blog_Home() )->get_robots();
		} else {
			$page_on_front_id = (int) get_option( 'page_on_front' );
			$page_on_front    = Smartcrawl_Post_Cache::get()->get_post( $page_on_front_id );
			$home_robots      = $page_on_front
				? $page_on_front->get_robots()
				: '';
		}

		return strpos( $home_robots, 'noindex' ) !== false;
	}

	/**
	 * @return string
	 */
	public function get_id() {
		return self::ID;
	}

	/**
	 * @param $raw_details
	 *
	 * @return Smartcrawl_Lighthouse_Table
	 */
	public function parse_details( $raw_details ) {
		$table = new Smartcrawl_Lighthouse_Table(
			array(
				esc_html__( 'Blocking Directive Source', 'wds' ),
			),
			$this->get_report()
		);

		$items = smartcrawl_get_array_value( $raw_details, 'items' );
		foreach ( $items as $item ) {
			$source_details = smartcrawl_get_array_value( $item, 'source' );
			$source_type    = smartcrawl_get_array_value( $source_details, 'type' );
			if ( is_string( $source_details ) ) {
				$table->add_row( array( $source_details ) );
			} elseif ( 'node' === $source_type ) {
				$snippet = smartcrawl_get_array_value( $source_details, 'snippet' );
				if ( $snippet ) {
					$table->add_row( array( $snippet ) );
				}
			} elseif ( 'source-location' === $source_type ) {
				$robots_url = smartcrawl_get_array_value( $source_details, 'url' );
				if ( $robots_url ) {
					$table->add_row( array( $robots_url ) );
				}
			}
		}

		return $table;
	}

	/**
	 * @return bool|mixed|void
	 */
	private function is_blog_public() {
		return get_option( 'blog_public' );
	}

	/**
	 * @return false|string
	 */
	public function get_action_button() {
		if ( ! $this->is_blog_public ) {
			return $this->get_reading_options_button();
		} elseif ( $this->is_home_noindex ) {
			return $this->get_homepage_onpage_button();
		} else {
			return '';
		}
	}

	/**
	 * @return false|string
	 */
	private function get_homepage_onpage_button() {
		if ( ! Smartcrawl_Settings_Admin::is_tab_allowed( Smartcrawl_Settings::TAB_ONPAGE ) ) {
			return '';
		}

		return $this->button_markup(
			esc_html__( 'Edit Settings', 'wds' ),
			Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings::TAB_ONPAGE ),
			'sui-icon-wrench-tool'
		);
	}

	/**
	 * @return false|string
	 */
	private function get_reading_options_button() {
		if ( is_multisite() ) {
			return '';
		}

		return $this->button_markup(
			empty( $text ) ? esc_html__( 'Edit Settings', 'wds' ) : $text,
			admin_url( 'options-reading.php' ),
			'sui-icon-wrench-tool'
		);
	}

	/**
	 * @return string
	 */
	private function format_copy_description() {
		$parts = array_merge(
			array(
				__( 'Tested Device: ', 'wds' ) . $this->get_device_label(),
				__( 'Audit Type: Indexing audits', 'wds' ),
				'',
				__( 'Failing Audit: Page is blocked from indexing', 'wds' ),
				'',
				__( 'Status: Page is not crawlable', 'wds' ),
				'',
			),
			$this->get_flattened_details(),
			array(
				'',
				__( 'Overview:', 'wds' ),
				__( "Search engines can only show pages in their search results if those pages don't explicitly block indexing by search engine crawlers. Some HTTP headers and meta tags tell crawlers that a page shouldn't be indexed.", 'wds' ),
				__( "Only block indexing for content that you don't want to appear in search results.", 'wds' ),
				'',
				__( 'For more information please check the SEO Audits section in SmartCrawl plugin.', 'wds' ),
			)
		);

		return implode( "\n", $parts );
	}
}
