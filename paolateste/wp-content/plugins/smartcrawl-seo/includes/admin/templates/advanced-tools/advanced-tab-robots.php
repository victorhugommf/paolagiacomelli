<?php
$active_tab      = empty( $active_tab ) ? false : $active_tab;
$already_exists  = empty( $already_exists ) ? false : $already_exists;
$rootdir_install = ! empty( $rootdir_install );

$robots_enabled = (bool) Smartcrawl_Settings::get_setting( 'robots-txt' );
$show_settings  = $robots_enabled && $rootdir_install && ! $already_exists;

$section_template = $show_settings
	? 'advanced-tools/advanced-robots-settings'
	: 'advanced-tools/advanced-robots-disabled';
$section_args     = $show_settings
	? array()
	: array(
		'already_exists'  => $already_exists,
		'rootdir_install' => $rootdir_install,
	);


$tab_args = array(
	'tab_id'       => 'tab_robots_editor',
	'tab_name'     => esc_html__( 'Robots.txt Editor', 'wds' ),
	'is_active'    => 'tab_robots_editor' === $active_tab,
	'button_text'  => false,
	'tab_sections' => array(
		array(
			'section_template' => $section_template,
			'section_args'     => $section_args,
		),
	),
);
$this->render_view( 'vertical-tab', $tab_args );
