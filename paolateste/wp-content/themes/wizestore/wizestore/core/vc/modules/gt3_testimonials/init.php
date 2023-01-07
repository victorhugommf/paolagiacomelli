<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_testimonials',
        'name' => esc_html__('Testimonials', 'wizestore'),
        'description' => esc_html__('Display testimonials', 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'gt3_testimonial_item'),
        "content_element" => true,
        'show_settings_on_create' => false,
        'params' => array(
            array(
                'type' => 'gt3_dropdown',
                'class' => '',
                'heading' => esc_html__('Style select', 'wizestore'),
                'param_name' => 'view_type',
                'fields' => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img1.jpg', 
                        'descr' => esc_html__('Type 1', 'wizestore')),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img2.jpg', 
                        'descr' => esc_html__('Type 2', 'wizestore')),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img3.jpg', 
                        'descr' => esc_html__('Type 3', 'wizestore')),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img4.jpg', 
                        'descr' => esc_html__('Type 4', 'wizestore')),
                ),
                'value' => 'type1',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use testimonials carousel?', 'wizestore' ),
                'param_name' => 'use_carousel',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'view_type',
                    'value_not_equal_to' => array("type4"),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Align', 'wizestore' ),
                'param_name' => 'item_align',
                'value' => array(
                    esc_html__("left", 'wizestore') => 'left',
                    esc_html__("center", 'wizestore') => 'center',
                    esc_html__("right", 'wizestore') => 'right',
                ),
                'std' => 'center',
                'dependency' => array(
                    'element' => 'view_type',
                    'value' => array("type4"),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay time.', 'wizestore' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'wizestore'),
                'param_name' => 'posts_per_line',
                'value' => array(
                    esc_html__("1", 'wizestore') => '1',
                    esc_html__("2", 'wizestore') => '2',
                    esc_html__("3", 'wizestore') => '3',
                    esc_html__("4", 'wizestore') => '4',
                ),
                'dependency' => array(
                    'element' => 'view_type',
                    'value_not_equal_to' => array("type4"),
                ),
            ),
            vc_map_add_css_animation( true ), 
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            ),
            // Testimonials Text Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Text Font Size', 'wizestore'),
                'param_name' => 'testimonilas_text_size',
                'value' => '16',
                'description' => esc_html__( 'Enter testimonials text font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Testimonials Text Fonts
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", 'wizestore'),
                "param_name" => "text_color",
                "value" => "",
                "description" => esc_html__("Select text color for this item.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Author Font Size', 'wizestore'),
                'param_name' => 'testimonilas_author_size',
                'value' => '16',
                'description' => esc_html__( 'Enter testimonials author font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Author Color", 'wizestore'),
                "param_name" => "sign_color",
                "value" => "",
                "description" => esc_html__("Select sign color for this item.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Image setting section
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'wizestore' ),
                'param_name' => 'img_width',
                'value' => '70',
                'description' => esc_html__( 'Enter image width in pixels.', 'wizestore' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'wizestore' ),
                'param_name' => 'img_height',
                'value' => '70',
                'description' => esc_html__( 'Enter image height in pixels.', 'wizestore' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Circular Images?', 'wizestore' ),
                'param_name' => 'round_imgs',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                "group" => "Styling",
            ),
        )
    ));
    
    // Testimonial item options
    vc_map(array(
        "name" => esc_html__("Testimonial item", 'wizestore'),
        "base" => "gt3_testimonial_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_testimonials'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Author name", 'wizestore'),
                "param_name" => "tstm_author",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", 'wizestore'),
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Author Position", 'wizestore'),
                "param_name" => "tstm_author_position",
                "value" => "",
                "description" => esc_html__("Provide an author position for this list item.", 'wizestore'),
                'admin_label' => true,
            ),
            // Image Section
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'wizestore' ),
                'param_name' => 'image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'wizestore' ),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => esc_html__("Description", 'wizestore'),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Description about this list item", 'wizestore')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select Rate', 'wizestore'),
                'param_name' => 'select_rate',
                'value' => array(
                    esc_html__("none", 'wizestore') => 'none',
                    esc_html__("1", 'wizestore') => '1',
                    esc_html__("2", 'wizestore') => '2',
                    esc_html__("3", 'wizestore') => '3',
                    esc_html__("4", 'wizestore') => '4',
                    esc_html__("5", 'wizestore') => '5',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            )
        )
    ));

    /*class WPBakeryShortCode_Gt3_Testimonials extends WPBakeryShortCode
    {
    }*/
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Testimonials extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Testimonial_Item extends WPBakeryShortCode
        {
        }
    }
}