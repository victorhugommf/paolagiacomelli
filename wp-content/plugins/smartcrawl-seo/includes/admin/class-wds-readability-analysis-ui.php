<?php

class Smartcrawl_Readability_Analysis_UI extends Smartcrawl_Base_Controller {

	use Smartcrawl_Singleton;

	/**
	 * @return bool|mixed
	 */
	public function should_run() {
		return Smartcrawl_Settings::get_setting( 'analysis-readability' );
	}

	/**
	 * @return void
	 */
	protected function init() {
		add_filter( 'wds-sections-metabox-readability', array( $this, 'add_analysis_section' ), 10, 2 );
		add_filter( 'wds-metabox-nav-item', array( $this, 'add_issue_count' ), 10, 2 );
	}

	/**
	 * @param $sections
	 * @param $post
	 *
	 * @return array
	 */
	public function add_analysis_section( $sections, $post = null ) {
		if ( empty( $post ) ) {
			return $sections;
		}

		$sections['metabox/metabox-readability'] = array(
			'post' => $post,
		);

		return $sections;
	}

	/**
	 * @param $tab_name
	 * @param $tab_id
	 *
	 * @return string
	 */
	public function add_issue_count( $tab_name, $tab_id ) {
		return 'wds_readability' === $tab_id
			? $tab_name . '<span class="wds-issues"><span></span></span>'
			: $tab_name;
	}
}
