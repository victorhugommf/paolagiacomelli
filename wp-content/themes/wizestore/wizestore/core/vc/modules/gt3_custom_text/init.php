<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Custom Text", 'wizestore'),
        "base" => "gt3_custom_text",
        "class" => "gt3_custom_text",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Custom Text",'wizestore'),
        "params" => array(
            // Icon Section
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => esc_html__("Content", 'wizestore') ,
                "param_name" => "content",
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'wizestore' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr($main_font['color']),
                'save_always' => true,
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size', 'wizestore'),
                'param_name' => 'font_size',
                'value' => (int)$main_font['font-size'],
                'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Line Height', 'wizestore'),
                'param_name' => 'line_height',
                'value' => '140',
                'description' => esc_html__( 'Enter line height in %.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Set Resonsive Font Size', 'wizestore' ),
                'param_name' => 'responsive_font',
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for small Desktops', 'wizestore'),
                'param_name' => 'font_size_sm_desctop',
                'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    "value" => "true"
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for Tablets', 'wizestore'),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    "value" => "true"
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for Mobile', 'wizestore'),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    "value" => "true"
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family?', 'wizestore' ),
                'param_name' => 'use_theme_fonts',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),               
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_custom_text extends WPBakeryShortCode {
            
        }
    } 
}
