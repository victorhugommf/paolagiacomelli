<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_video_popup',
        'name' => esc_html__('Video Popup', 'wizestore'),
        "description" => esc_html__("Video Popup Widget", 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", 'wizestore'),
                "param_name" => "video_title",
                "description" => esc_html__("Enter title.", 'wizestore')
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Background Image Video", 'wizestore'),
                "param_name" => "bg_image",
                "description" => esc_html__("Select video background image.", 'wizestore'),
                'std' => ''
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Video Link", 'wizestore'),
                "param_name" => "video_link",
                "description" => esc_html__("Enter video link from youtube or vimeo.", 'wizestore')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Align', 'wizestore' ),
                'param_name' => 'align',
                "value"         => array(
                    esc_html__( 'left', 'wizestore' ) => 'left',
                    esc_html__( 'center', 'wizestore' ) => 'center',
                    esc_html__( 'right', 'wizestore' ) => 'right',
                ),
                'std' => 'center',
            ),

            /* styling video popup */
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Title color", 'wizestore'),
                "param_name" => "title_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom color for title.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Button color", 'wizestore'),
                "param_name" => "btn_color",
                "value" => esc_attr("#ffffff"),
                "description" => esc_html__("Select custom color for button.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            // Video Popup Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for Video Popup title?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_vpopup_title',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_vpopup_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_vpopup_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'wizestore' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video Popup Content Font Size', 'wizestore'),
                'param_name' => 'title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Video Popup Title font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),

            
        ),


    ));

    class WPBakeryShortCode_Gt3_Video_Popup extends WPBakeryShortCode { }

}