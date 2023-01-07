<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        "name" => esc_html__("Button", 'wizestore'),
        "base" => "gt3_button",
        "class" => "gt3_button",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Add custom button",'wizestore'),
        "params" => array(
            // Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Text", 'wizestore'),
                "param_name" => "button_title",
                "value" => esc_html__("Text on the button", 'wizestore'),
                'admin_label' => true,
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'wizestore' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to button.", 'wizestore')
            ),
            // Size
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Size', 'wizestore' ),
                'param_name' => 'button_size',
                "value"         => array(
                    esc_html__( 'Normal', 'wizestore' )   => 'normal',
                    esc_html__( 'Mini', 'wizestore' )      => 'mini',
                    esc_html__( 'Small', 'wizestore' )     => 'small',
                    esc_html__( 'Large', 'wizestore' )     => 'large'
                ),
                "description" => esc_html__("Select button display size.", 'wizestore')
            ),
            // Alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'wizestore' ),
                'param_name' => 'button_alignment',
                "value"         => array(
                    esc_html__( 'Inline', 'wizestore' )      => 'inline',
                    esc_html__( 'Left', 'wizestore' )     => 'left',
                    esc_html__( 'Right', 'wizestore' )   => 'right',
                    esc_html__( 'Center', 'wizestore' )     => 'center',
                    esc_html__( 'Block', 'wizestore' )      => 'block'
                ),
                "description" => esc_html__("Select button alignment.", 'wizestore')
            ),
            // Button Border
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Radius', 'wizestore' ),
                'param_name' => 'btn_border_radius',
                "value"         => array(
                    esc_html__( 'None', 'wizestore' )      => 'none',
                    esc_html__( '1px', 'wizestore' )      => '1px',
                    esc_html__( '2px', 'wizestore' )      => '2px',
                    esc_html__( '3px', 'wizestore' )      => '3px',
                    esc_html__( '4px', 'wizestore' )      => '4px',
                    esc_html__( '5px', 'wizestore' )      => '5px',
                    esc_html__( '10px', 'wizestore' )      => '10px',
                    esc_html__( '15px', 'wizestore' )      => '15px',
                    esc_html__( '20px', 'wizestore' )      => '20px',
                    esc_html__( '25px', 'wizestore' )      => '25px',
                    esc_html__( '30px', 'wizestore' )      => '30px',
                    esc_html__( '35px', 'wizestore' )      => '35px'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Style', 'wizestore' ),
                'param_name' => 'btn_border_style',
                "value"         => array(
                    esc_html__( 'Solid', 'wizestore' )     => 'solid',
                    esc_html__( 'Dashed', 'wizestore' )   => 'dashed',
                    esc_html__( 'Dotted', 'wizestore' )     => 'dotted',
                    esc_html__( 'Double', 'wizestore' )      => 'double',
                    esc_html__( 'Inset', 'wizestore' )      => 'inset',
                    esc_html__( 'Outset', 'wizestore' )      => 'outset',
                    esc_html__( 'None', 'wizestore' )      => 'none'
                ),
                'dependency' => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Width', 'wizestore' ),
                'param_name' => 'btn_border_width',
                "value"         => array(
                    esc_html__( '1px', 'wizestore' )      => '1px',
                    esc_html__( '2px', 'wizestore' )      => '2px',
                    esc_html__( '3px', 'wizestore' )      => '3px',
                    esc_html__( '4px', 'wizestore' )      => '4px',
                    esc_html__( '5px', 'wizestore' )      => '5px',
                    esc_html__( '6px', 'wizestore' )      => '6px',
                    esc_html__( '7px', 'wizestore' )      => '7px',
                    esc_html__( '8px', 'wizestore' )      => '8px',
                    esc_html__( '9px', 'wizestore' )      => '9px',
                    esc_html__( '10px', 'wizestore' )      => '10px'
                ),
                'dependency' => array(
                    'element' => 'btn_border_style',
                    'value_not_equal_to' => 'none',
                ),
            ),
            // --- ICON GROUP --- //
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Icon Type", 'wizestore'),
                "param_name" => "btn_icon_type",
                "value" => array(
                    esc_html__("None",'wizestore') => "none",
                    esc_html__("Font",'wizestore') => "font",
                    esc_html__("Image",'wizestore') => "image",
                ),
                'group' => esc_html__( 'Icon', 'wizestore' ),
                "description" => esc_html__("Use an existing font icon or upload a custom image.", 'wizestore'),
                'dependency' => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            // Icon
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'wizestore'),
                'param_name' => 'btn_icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("font")),
                'description' => esc_html__( 'Select icon from library.', 'wizestore' ),
                'group' => esc_html__( 'Icon', 'wizestore' ),
            ),
            // Image
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'wizestore'),
                'param_name' => 'btn_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'wizestore' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image")),
                'group' => esc_html__( 'Icon', 'wizestore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Width', 'wizestore'),
                'param_name' => 'btn_img_width',
                'value' => '',
                'description' => esc_html__( 'Enter image width in pixels.', 'wizestore' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image")),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Icon', 'wizestore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Position', 'wizestore'),
                'param_name' => 'btn_icon_position',
                'value' => array(
                    esc_html__("Left", 'wizestore') => 'left',
                    esc_html__("Right", 'wizestore') => 'right'
                ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image", "font")),
                'group' => esc_html__( 'Icon', 'wizestore' ),
            ),
            // Icon Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Font Size', 'wizestore'),
                'param_name' => 'icon_font_size',
                'value' => '14',
                'description' => esc_html__( 'Enter icon font-size in pixels.', 'wizestore' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("font")),
                "group" => esc_html__( "Icon", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- TYPOGRAPHY GROUP --- //
            // Button Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for button?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_button',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Typography", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Typography", 'wizestore' ),
            ),
            // Button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Font Size', 'wizestore'),
                'param_name' => 'btn_font_size',
                'value' => '14',
                'description' => esc_html__( 'Enter button font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Typography", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- SPACING GROUP --- //
            array(
                'type' => 'css_editor',
                'param_name' => 'css',
                'group' => esc_html__( 'Spacing', 'wizestore' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            ),
            // --- CUSTOM GROUP --- //
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default button?', 'wizestore' ),
                'param_name' => 'use_theme_button',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use button from the theme.', 'wizestore' ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'std' => 'yes',
            ),
            // Button Bg
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Background", 'wizestore'),
                "param_name" => "btn_bg_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom background for button.", 'wizestore'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button text-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", 'wizestore'),
                "param_name" => "btn_text_color",
                "value" => "#ffffff",
                "description" => esc_html__("Select custom text color for button.", 'wizestore'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Background", 'wizestore'),
                "param_name" => "btn_bg_color_hover",
                "value" => "#ffffff",
                "description" => esc_html__("Select custom background for hover button.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Text Color", 'wizestore'),
                "param_name" => "btn_text_color_hover",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom text color for hover button.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button icon-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Icon Color", 'wizestore'),
                "param_name" => "btn_icon_color",
                "value" => "#ffffff",
                "description" => esc_html__("Select icon color for button.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover icon-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Icon Color", 'wizestore'),
                "param_name" => "btn_icon_color_hover",
                "value" => "#ffffff",
                "description" => esc_html__("Select icon color for hover button.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Border Color", 'wizestore'),
                "param_name" => "btn_border_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom border color for button.", 'wizestore'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Border Color", 'wizestore'),
                "param_name" => "btn_border_color_hover",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom border color for hover button.", 'wizestore'),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),


        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Button extends WPBakeryShortCode {
        }
    }
}