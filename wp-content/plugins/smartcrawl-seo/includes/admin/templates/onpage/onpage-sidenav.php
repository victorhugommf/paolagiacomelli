<?php
$active_tab                = empty( $active_tab ) ? '' : $active_tab;
$show_static_home_settings = empty( $show_static_home_settings ) ? false : $show_static_home_settings;
$buddypress_active         = defined( 'BP_VERSION' );
$tab_items                 = array(
	array(
		'id'   => $show_static_home_settings ? 'tab_static_homepage' : 'tab_homepage',
		'name' => esc_html__( 'Homepage', 'wds' ),
	),
	array(
		'id'   => 'tab_post_types',
		'name' => esc_html__( 'Post Types', 'wds' ),
	),
	array(
		'id'   => 'tab_taxonomies',
		'name' => esc_html__( 'Taxonomies', 'wds' ),
	),
	array(
		'id'   => 'tab_archives',
		'name' => esc_html__( 'Archives', 'wds' ),
	),
	array(
		'id'   => 'tab_settings',
		'name' => esc_html__( 'Settings', 'wds' ),
	),
);
if ( $buddypress_active ) {
	$tab_items[] = array(
		'id'   => 'tab_buddypress',
		'name' => esc_html__( 'BuddyPress', 'wds' ),
	);
}
$this->render_view(
	'vertical-tabs-side-nav',
	array(
		'active_tab' => $active_tab,
		'tabs'       => $tab_items,
	)
);
