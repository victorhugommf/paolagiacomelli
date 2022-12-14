<?php

class Smartcrawl_Autolinks_UI extends Smartcrawl_Base_Controller {

	use Smartcrawl_Singleton;

	/**
	 * Should run?.
	 *
	 * @return bool
	 */
	public function should_run() {
		return Smartcrawl_Settings_Admin::is_tab_allowed( Smartcrawl_Settings::TAB_AUTOLINKS );
	}

	/**
	 * Child controllers can use this method to initialize.
	 *
	 * @return bool
	 */
	protected function init() {
		add_filter( 'wds-sections-metabox-advanced', array( $this, 'add_advanced_metabox_redirects_section' ), 20, 2 );

		if ( Smartcrawl_Settings::get_setting( 'autolinks' ) ) {
			add_filter(
				'wds-sections-metabox-advanced',
				array(
					$this,
					'add_advanced_metabox_autolinks_section',
				),
				40,
				2
			);
		}

		return true;
	}

	/**
	 * Add advanced mextabox for redirects.
	 *
	 * @param array   $sections Sections.
	 * @param WP_Post $post     Post object.
	 */
	public function add_advanced_metabox_redirects_section( $sections, $post = null ) {
		if ( empty( $post ) ) {
			return $sections;
		}

		$post_id                                       = $post->ID;
		$sections['metabox/metabox-advanced-redirect'] = array(
			'redirect_url'   => smartcrawl_get_value( 'redirect', $post_id ),
			'has_permission' => user_can_see_seo_metabox_301_redirect(),
		);

		return $sections;
	}

	/**
	 * Add advanced metabox for auto links.
	 *
	 * @param array   $sections Sections.
	 * @param WP_Post $post     Post object.
	 */
	public function add_advanced_metabox_autolinks_section( $sections, $post = null ) {
		if ( empty( $post ) ) {
			return $sections;
		}

		$post_id                                        = $post->ID;
		$sections['metabox/metabox-advanced-autolinks'] = array(
			'autolinks_exclude' => smartcrawl_get_value( 'autolinks-exclude', $post_id ),
		);

		return $sections;
	}
}
