<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Icon Box", 'wizestore'),
        "base" => "gt3_icon_box",
        "class" => "gt3_icon_box",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Icon Box",'wizestore'),
        "params" => array(
            // Icon Section
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Type', 'wizestore' ),
                "param_name"    => "icon_type",
                "value"         => array(
                    esc_html__( 'None', 'wizestore' )      => 'none',
                    esc_html__( 'Font', 'wizestore' )      => 'font',
                    esc_html__( 'Image', 'wizestore' )     => 'image',
                    esc_html__( 'Number', 'wizestore' )    => 'number',
                ),
                'save_always' => true,
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Number', 'wizestore' ),
                "param_name"    => "number",
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'number',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'wizestore' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'wizestore' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array( 'image' ),
                ),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Position', 'wizestore' ),
                "param_name"    => "icon_position",
                "value"         => array(
                    esc_html__( 'Top', 'wizestore' )               => 'top',
                    esc_html__( 'Left', 'wizestore' )              => 'left',
                    esc_html__( 'Right', 'wizestore' )             => 'right',
                    esc_html__('Inline with Title', 'wizestore')   => 'inline_title'
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value_not_equal_to' => array( 'number' ),
                ),
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Heading", 'wizestore'),
                "param_name" => "heading",
                "description" => esc_html__("Enter text for heading line.", 'wizestore'),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", 'wizestore'),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", 'wizestore')
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link', 'wizestore' ),
                "param_name"    => "url",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link Text', 'wizestore' ),
                "param_name"    => "url_text",
            ),            
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Open in New Tab', 'wizestore' ),
                "param_name"    => "new_tab",
                'save_always' => true,
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Icon in circle', 'wizestore' ),
                "param_name"    => "icon_circle",
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value_not_equal_to' => array( 'number' ),
                ),
            ),
             array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Circle Color', 'wizestore' ),
                "param_name"    => "circle_bg",
                "value"         => '#e9e9e9',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_circle',
                    'value' => "true",
                ),
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Add Number', 'wizestore' ),
                "param_name"    => "icon_add_number",
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value_not_equal_to' => array( 'number' ),
                ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Number', 'wizestore' ),
                "param_name"    => "icon_number",
                'dependency' => array(
                    'element' => 'icon_add_number',
                    'value' => "true",
                ),
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Add divider after Heading', 'wizestore' ),
                "param_name"    => "add_divider",
                'std' => '',

            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Divider Color', 'wizestore' ),
                "param_name"    => "divider_color",
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider',
                    'value' => "true",
                ),
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Size', 'wizestore' ),
                "param_name"    => "icon_size",
                "value"         => array(
                    esc_html__( 'Regular', 'wizestore' )   => 'regular',
                    esc_html__( 'Mini', 'wizestore' )      => 'mini',
                    esc_html__( 'Small', 'wizestore' )     => 'small',
                    esc_html__( 'Large', 'wizestore' )     => 'large',
                    esc_html__( 'Huge', 'wizestore' )      => 'huge',
                    esc_html__( 'Custom', 'wizestore')     => 'custom'
                ),              
                "group"         => esc_html__( "Styling", 'wizestore' ),
                'save_always' => true,
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'wizestore'),
                'param_name' => 'custom_icon_size',
                'value' => '18',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'dependency' => array(
                    'element' => 'icon_size',
                    'value' => 'custom',
                ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'wizestore' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font','number'),
                ),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Title Tag', 'wizestore' ),
                "param_name"    => "title_tag",
                "value"         => array(
                    esc_html__( 'H2', 'wizestore' )    => 'h2',
                    esc_html__( 'H3', 'wizestore' )    => 'h3',
                    esc_html__( 'H4', 'wizestore' )    => 'h4',
                    esc_html__( 'H5', 'wizestore' )    => 'h5',
                    esc_html__( 'H6', 'wizestore' )    => 'h6',
                ),
                'save_always' => true,
                "group"         => esc_html__( "Styling", 'wizestore' ),
            ),
            // Icon Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Box Title Font Size', 'wizestore'),
                'param_name' => 'iconbox_title_size',
                'value' => '28',
                'description' => esc_html__( 'Enter Icon Box title font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox title?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_iconbox_title',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Box Content Font Size', 'wizestore'),
                'param_name' => 'iconbox_content_size',
                'value' => '14',
                'description' => esc_html__( 'Enter Icon Box content font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox content?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_iconbox_content',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'wizestore' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'wizestore' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr($main_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Color', 'wizestore' ),
                "param_name"    => "link_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Hover Color', 'wizestore' ),
                "param_name"    => "link_hover_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),                
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_icon_box extends WPBakeryShortCode {
            
        }
    } 
}
