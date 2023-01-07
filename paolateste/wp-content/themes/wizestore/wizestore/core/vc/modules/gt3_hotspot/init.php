<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
	vc_map(array(
		'name' => esc_html__('Hotspot','wizestore'),
		'base' => 'gt3_hotspot',
		'class' => 'gt3_hotspot',
		'category' => esc_html__('GT3 Modules', 'wizestore'),
		'icon' => 'gt3_icon',
		'content_element' => true,
		'description' => esc_html__('GT3 Hotspot','wizestore'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Module title', 'wizestore'),
				'param_name' => 'title',
				'description' => esc_html__('Module title.', 'wizestore'),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Select the image from the media library','wizestore'),
				'param_name' => 'attach_image',
				'description' => esc_html__('Image', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-12 pt-15',
			),

			/* INIT Hotspot */
			array(
				'type' => 'gt3_init_hotspot',
				'heading' => '',
				'param_name' => 'init_hotspot',
				'description' => esc_html__('Please click on the picture in the place where you need to leave the marker', 'wizestore'),
				'edit_field_class'	=> 'vc_col-sm-12',
			),
			/* INIT Hotspot end */

			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Action', 'wizestore'),
				'param_name' => 'hotspot_action',
				'edit_field_class' => 'vc_col-sm-6',
				'value' => array(
					esc_html__('Hover','wizestore') => 'hover',
					esc_html__('Click','wizestore') => 'click',
					esc_html__('Visible','wizestore') => 'visible',
					esc_html__('Only Marker','wizestore') => 'only_marker'
				),
				'description' => esc_html__('Select hover/click action', 'wizestore'),
			),
            vc_map_add_css_animation( true ),
			array(
				"type" => "textfield",
				"heading" => esc_html__( 'Transition delay between appearances', 'wizestore' ),
				"param_name" => "transition_delay",
				'value' => 400,
				'description' => esc_html__('Enter transition delay between appearances in miliseconds. Element will be animate when it "enters" the browsers viewport (Note: works only in modern browsers)', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Extra Class', 'wizestore'),
				'param_name' => 'item_el_class',
				'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wizestore')
			),

			/* Group Marker */
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Marker style','wizestore'),
				'param_name' => 'marker_style',
				'edit_field_class' => 'vc_col-sm-12',
				'value' => array(
					esc_html__('Circle', 'wizestore') => 'circle',
					esc_html__('Text', 'wizestore') => 'text',
					esc_html__('Image', 'wizestore') => 'image'
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Marker style. Select circle style or  select "text" and enter text below or upload image from the media library', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Padding Top', 'wizestore'),
				'param_name' => 'tooltip_padding_1',
				'value' => 0,
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter padding-top in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Padding Right', 'wizestore'),
				'param_name' => 'tooltip_padding_2',
				'value' => 0,
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter padding-right in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Padding Bottom', 'wizestore'),
				'param_name' => 'tooltip_padding_3',
				'value' => 0,
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter padding-bottom in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Padding Left', 'wizestore'),
				'param_name' => 'tooltip_padding_4',
				'value' => 0,
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter padding-left in pixels', 'wizestore'),
			),

			/* Default Circle Style */
			array(
				'type' => 'colorpicker',
				'param_name' => 'marker_circle_color_1',
				'heading' => esc_html__('Marker background (Outer)', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => 'rgba(229,98,94,0.37)',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'circle',
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Change the outer background color of the marker', 'wizestore'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'marker_circle_color_2',
				'heading' => esc_html__('Marker background (Inner)', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#e5625e',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'circle',
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Change the inner background color of the marker', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Marker Outer width (px)', 'wizestore'),
				'param_name' => 'marker_outer_width',
				'value' => 25,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'circle',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Marker Inner width (px)', 'wizestore'),
				'param_name' => 'marker_inner_width',
				'value' => 7,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'circle',
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Marker Pulse', 'wizestore' ),
				'param_name' => 'marker_pulse',
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-12',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'circle',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Marker Pulse style','wizestore'),
				'param_name' => 'marker_pulse_style',
				'edit_field_class' => 'vc_col-sm-6',
				'value' => array(
					esc_html__('Default', 'wizestore') => 'default',
					esc_html__('Toward the Outside', 'wizestore') => 'outside',
					esc_html__('Flashing', 'wizestore') => 'flashing'
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_pulse',
					'value' => 'true'
				),
				'description' => esc_html__('Change the pulse style', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Marker Pulse Animation Duration (ms)', 'wizestore'),
				'param_name' => 'marker_pulse_duration',
				'value' => 2000,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_pulse',
					'value' => 'true'
				),
			),
			/* Default Marker Style end */

			/* Text Marker Style */
			/*array(
				'type' => 'textfield',
				'heading' => esc_html__('Text marker', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-12',
				'param_name' => 'marker_text',
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'description' => esc_html__('Enter your text marker here. Required*', 'wizestore'),
			),*/
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Font Size', 'wizestore'),
				'param_name' => 'marker_font_size',
				'value' => (int)$main_font['font-size'],
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Line-height', 'wizestore'),
				'param_name' => 'marker_line_height',
				'value' => 140,
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'description' => esc_html__( 'Enter line-height in %.', 'wizestore' ),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Set Responsive Font Size', 'wizestore' ),
				'param_name' => 'responsive_font',
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-12',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Small Desktops', 'wizestore'),
				'param_name' => 'font_size_sm_desktop',
				'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'responsive_font',
					'value' => 'true'
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tablets', 'wizestore'),
				'param_name' => 'font_size_tablet',
				'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'responsive_font',
					'value' => 'true'
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Mobile', 'wizestore'),
				'param_name' => 'font_size_mobile',
				'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'responsive_font',
					'value' => 'true'
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use theme default font family?', 'wizestore' ),
				'param_name' => 'use_theme_fonts_marker',
				'value' => array(
					esc_html__( 'Yes', 'wizestore' ) => 'yes'
				),
				'group' => esc_html__( 'Marker', 'wizestore' ),
				'std' => 'yes',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'description' => esc_html__( 'Use font family from the theme to this marker text.', 'wizestore' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_marker_text',
				'value' => '',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
					),
				),
				'dependency' => array(
					'element' => 'use_theme_fonts_marker',
					'value_not_equal_to' => 'yes',
				),
				'group' => esc_html__( 'Marker', 'wizestore' ),
			),	  
			array(
				'type' => 'colorpicker',
				'param_name' => 'marker_text_color_1',
				'heading' => esc_html__('Text marker color', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#000000',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Change the color of the text marker', 'wizestore'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'marker_text_bgcolor_2',
				'heading' => esc_html__('Marker background', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'text',
				),
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Change the background color of the text marker', 'wizestore'),
			),
			/* Text Marker Style end */

			/* Image Marker Style */
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image marker','wizestore'),
				'param_name' => 'marker_image',
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'image',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__('Marker', 'wizestore'),
				'description' => esc_html__('Choose the image from the media library', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Image width', 'wizestore'),
				'param_name' => 'marker_image_width',
				'value' => '40',
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'image',
				),
				'description' => esc_html__('Enter image width in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Image height', 'wizestore'),
				'param_name' => 'marker_image_height',
				'value' => '40',
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__('Marker', 'wizestore'),
				'dependency' => array(
					'element' => 'marker_style',
					'value' => 'image',
				),
				'description' => esc_html__('Enter image height in pixels', 'wizestore'),
			),
			/* Image Marker Style end */

			/* Tooltip options */
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Tooltip position','wizestore'),
				'param_name' => 'tooltip_position',
				'value' => array(
					esc_html__('Top', 'wizestore') => 'tooltip-top',
					esc_html__('Bottom', 'wizestore') => 'tooltip-bottom',
					esc_html__('Left', 'wizestore') => 'tooltip-left',
					esc_html__('Right', 'wizestore') => 'tooltip-right',
					esc_html__('Top Left', 'wizestore') => 'tooltip-top-left',
					esc_html__('Top Right', 'wizestore') => 'tooltip-top-right',
					esc_html__('Bottom Left', 'wizestore') => 'tooltip-bottom-left',
					esc_html__('Bottom Right', 'wizestore')	=> 'tooltip-bottom-right',
				),
				'group' => esc_html__('Tooltip', 'wizestore'),
				'std' => 'tooltip-bottom',
				'edit_field_class' => 'vc_col-sm-12',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Select the location of the tooltip relative to the marker', 'wizestore'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Tooltip animation','wizestore'),
				'param_name' => 'tooltip_animation',
				'value' => array(
					esc_html__('Slide', 'wizestore') => 'tooltip_animation-slide',
					esc_html__('Fade', 'wizestore') => 'tooltip_animation-fade',
				),
				'group' => esc_html__('Tooltip', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Select the location of the tooltip relative to the marker', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tooltip animation time', 'wizestore'),
				'param_name' => 'tooltip_animation_time',
				'value' => 200,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter animation time in ms', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tooltip animation function', 'wizestore'),
				'param_name' => 'tooltip_animation_function',
				'value' => 'easy-in',
				'edit_field_class' => 'vc_col-sm-12',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('To description read about "transition-timing-function" and "cubic-bezier". Default: easy-in. Also You can enter: ease, easy-in, easy-out, ease-in-out, linear or smth like cubic-bezier(0.42,0,1,1).', 'wizestore'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Alignment Text in the tooltip ','wizestore'),
				'param_name' => 'tooltip_content_align',
				'value' => array(
					esc_html__('Left', 'wizestore') => 'text-left',
					esc_html__('Right', 'wizestore') => 'text-right',
					esc_html__('Center', 'wizestore') => 'text-center',
				),
				'group' => esc_html__('Tooltip', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-12',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Select tooltip text alignment', 'wizestore'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'tooltip_background',
				'heading' => esc_html__('Tooltip background color', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#ffffff',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Choose the background color for the tooltip\'s', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tooltip Width', 'wizestore'),
				'param_name' => 'tooltip_width',
				'value' => 300,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Enter tooltip width in pixels', 'wizestore'),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Enable the shadow for the tooltip window?', 'wizestore' ),
				'param_name' => 'tooltip_shadow',
				'value' => array(
					esc_html__( 'Yes', 'wizestore' ) => 'yes'
				),
				'group' => esc_html__( 'Tooltip', 'wizestore' ),
				'std' => 'yes',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'tooltip_shadow_color',
				'heading' => esc_html__('Tooltip shadow color', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-12',
				'value' => '#eeeeee',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'tooltip_shadow',
					'value' => 'yes',
				),
				'description' => esc_html__('Choose the color for the tooltip\'s shadow', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Left/right', 'wizestore'),
				'param_name' => 'tooltip_shadow_1',
				'value' => '0',
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'tooltip_shadow',
					'value' => 'yes',
				),
				'description' => esc_html__('Enter how much to perpend the shadow in the horizontal direction in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Top/bottom', 'wizestore'),
				'param_name' => 'tooltip_shadow_2',
				'value' => '0',
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'tooltip_shadow',
					'value' => 'yes',
				),
				'description' => esc_html__('Enter how much to perpend the shadow in the vertical direction in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Blur Radius', 'wizestore'),
				'param_name' => 'tooltip_shadow_3',
				'value' => '7',
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'tooltip_shadow',
					'value' => 'yes',
				),
				'description' => esc_html__('Enter blur radius in pixels', 'wizestore'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Spread Radius', 'wizestore'),
				'param_name' => 'tooltip_shadow_4',
				'value' => '0',
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'tooltip_shadow',
					'value' => 'yes',
				),
				'description' => esc_html__('Enter spread radius in pixels', 'wizestore'),
			),

			/* Tooltip options - typography */
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use theme default font family for title?', 'wizestore' ),
				'param_name' => 'use_google_fonts_tooltip_title',
				'value' => array(
					esc_html__( 'Yes', 'wizestore' ) => 'yes'
				),
				'group' => esc_html__( 'Tooltip', 'wizestore' ),
				'std' => 'yes',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_tooltip_title',
				'value' => '',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_tooltip_title',
					'value_not_equal_to' => 'yes',
				),
				'group' => esc_html__( 'Tooltip', 'wizestore' ),
			),	  
			array(
				'type' => 'colorpicker',
				'param_name' => 'tooltip_text_color_1',
				'heading' => esc_html__('Title color', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#000000',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Change the color of the title', 'wizestore'),
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use theme default font family for text?', 'wizestore' ),
				'param_name' => 'use_google_fonts_tooltip',
				'value' => array(
					esc_html__( 'Yes', 'wizestore' ) => 'yes'
				),
				'group' => esc_html__( 'Tooltip', 'wizestore' ),
				'std' => 'yes',
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_tooltip',
				'value' => '',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_tooltip',
					'value_not_equal_to' => 'yes',
				),
				'group' => esc_html__( 'Tooltip', 'wizestore' ),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'tooltip_text_color_2',
				'heading' => esc_html__('Text color', 'wizestore'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '#6e6f69',
				'group' => esc_html__('Tooltip', 'wizestore'),
				'dependency' => array(
					'element' => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' => esc_html__('Change the color of the message', 'wizestore'),
			),
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Gt3_hotspot extends WPBakeryShortCode {
			
		}
	} 
}