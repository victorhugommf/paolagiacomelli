<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_price_block',
        'name' => esc_html__('Price Block', 'wizestore'),
        "description" => esc_html__("Create price table", 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Name / Title", 'wizestore'),
                "param_name" => "title",
                "description" => esc_html__("Enter title of price block.", 'wizestore')
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Header Background Image", 'wizestore'),
                "param_name" => "header_img",
                "description" => esc_html__("Select header background image.", 'wizestore')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Active package', 'wizestore'),
                'param_name' => 'package_is_active',
                'admin_label' => true,
                'value' => array(
                    esc_html__("No", 'wizestore') => 'no',
                    esc_html__("Yes", 'wizestore') => 'yes',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Price", 'wizestore'),
                "param_name" => "price",
                "description" => esc_html__("Enter the price for this package. e.g. '157'", 'wizestore')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Prefix", 'wizestore'),
                "param_name" => "price_prefix",
                "description" => esc_html__("Enter the price prefix for this package. e.g. '$'", 'wizestore')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Suffix", 'wizestore'),
                "param_name" => "price_suffix",
                "description" => esc_html__("Enter the price suffix for this package. e.g. '/ person'", 'wizestore')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package description", 'wizestore'),
                "param_name" => "price_description",
                "description" => esc_html__("Enter the price block short description", 'wizestore')
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", 'wizestore'),
                "param_name" => "button_link",
            ),
            array(
                "type" => "textarea_html",
                "heading" => esc_html__("Price field", 'wizestore'),
                "param_name" => "content",
            ),
            
            // General Params
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'wizestore' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'wizestore' ),
                'edit_field_class' => '',
            ),
            // Price Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for price table header?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_price_header',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_price_header',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_price_header',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for price table content?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_price_content',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_price_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_price_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            // Button COLOR
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Button color", 'wizestore'),
                "param_name" => "btn_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom color for button.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use alternative button style?', 'wizestore' ),
                'param_name' => 'use_alt_button_style',
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => '',
            ),
        ),


    ));

    class WPBakeryShortCode_Gt3_Price_block extends WPBakeryShortCode { }

}