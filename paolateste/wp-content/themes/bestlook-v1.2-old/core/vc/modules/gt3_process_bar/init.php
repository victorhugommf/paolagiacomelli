<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Process Bar", 'wizestore'),
        "base" => "gt3_process_bar",
        "class" => "gt3_process_bar",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Process Bar",'wizestore'),
        "params" => array(
            // Icon Section
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Steps Count', 'wizestore' ),
                "param_name"    => "steps",
                "value"         => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
                'save_always' => true,
            ),
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 1:", 'wizestore'),
                "param_name"    => "backend_divider",
            ),
            /* step 1 */
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 1 Heading", 'wizestore'),
                "param_name" => "heading1",
                "description" => esc_html__("Enter text for heading line.", 'wizestore')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 1 Text", 'wizestore'),
                "param_name" => "text1",
                "description" => esc_html__("Enter text.", 'wizestore')
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link', 'wizestore' ),
                "param_name"    => "url1",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link Text', 'wizestore' ),
                "param_name"    => "url_text1",
                'edit_field_class' => 'vc_col-sm-6',
            ),  
            /* step 2 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 2:", 'wizestore'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 2 Heading", 'wizestore'),
                "param_name" => "heading2",
                "description" => esc_html__("Enter text for heading line.", 'wizestore')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 2 Text", 'wizestore'),
                "param_name" => "text2",
                "description" => esc_html__("Enter text.", 'wizestore')
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link', 'wizestore' ),
                "param_name"    => "url2",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link Text', 'wizestore' ),
                "param_name"    => "url_text2",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            /* step 3 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 3:", 'wizestore'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 3 Heading", 'wizestore'),
                "param_name" => "heading3",
                "description" => esc_html__("Enter text for heading line.", 'wizestore')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 3 Text", 'wizestore'),
                "param_name" => "text3",
                "description" => esc_html__("Enter text.", 'wizestore')
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link', 'wizestore' ),
                "param_name"    => "url3",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link Text', 'wizestore' ),
                "param_name"    => "url_text3",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            /* step 4 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 4:", 'wizestore'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 4 Heading", 'wizestore'),
                "param_name" => "heading4",
                "description" => esc_html__("Enter text for heading line.", 'wizestore'),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 4 Text", 'wizestore'),
                "param_name" => "text4",
                "description" => esc_html__("Enter text.", 'wizestore'),
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link', 'wizestore' ),
                "param_name"    => "url4",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link Text', 'wizestore' ),
                "param_name"    => "url_text4",
                'edit_field_class' => 'vc_col-sm-6',

            ), 
            /* step 5 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 5:", 'wizestore'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 5 Heading", 'wizestore'),
                "param_name" => "heading5",
                "description" => esc_html__("Enter text for heading line.", 'wizestore'),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 5 Text", 'wizestore'),
                "param_name" => "text5",
                "description" => esc_html__("Enter text.", 'wizestore'),
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link', 'wizestore' ),
                "param_name"    => "url5",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link Text', 'wizestore' ),
                "param_name"    => "url_text5",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
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
                    esc_html__( 'Huge', 'wizestore' )      => 'huge'
                ),              
                "group"         => esc_html__( "Styling", 'wizestore' ),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Background', 'wizestore' ),
                "param_name"    => "icon_bg",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'wizestore' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'wizestore' ),
                "value"         => '#ffffff',
                'save_always' => true,
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
                'heading' => esc_html__('Title Font Size', 'wizestore'),
                'param_name' => 'iconbox_title_size',
                'value' => '18',
                'description' => esc_html__( 'Enter title font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for title?', 'wizestore' ),
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
                'heading' => esc_html__('Content Font Size', 'wizestore'),
                'param_name' => 'iconbox_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for content?', 'wizestore' ),
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
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_process_bar extends WPBakeryShortCode {
            
        }
    } 
}
