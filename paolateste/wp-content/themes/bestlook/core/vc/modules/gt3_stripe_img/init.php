<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_stripe_columns',
        'name' => esc_html__('Stripe Columns', 'wizestore'),
        'description' => esc_html__('Display Stripe Columns', 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'gt3_stripe_column_item'),
        "content_element" => true,
        'show_settings_on_create' => false,
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items Height', 'wizestore'),
                'param_name' => 'items_height',
                'value' => '600',
                'description' => esc_html__( 'Enter height in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            ),
            // Text Font styles
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'wizestore'),
                'param_name' => 'title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Title font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Title Color", 'wizestore'),
                "param_name" => "title_color",
                "value" => "",
                "description" => esc_html__("Select title color for this item.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Text Font Size', 'wizestore'),
                'param_name' => 'content_size',
                'value' => '16',
                'description' => esc_html__( 'Content Text font-size in pixels.', 'wizestore' ),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Content Text Color", 'wizestore'),
                "param_name" => "content_color",
                "value" => "",
                "description" => esc_html__("Select Content Text color for this item.", 'wizestore'),
                "group" => esc_html__( "Styling", 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));
    
    // Testimonial item options
    vc_map(array(
        "name" => esc_html__("Stripe Item", 'wizestore'),
        "base" => "gt3_stripe_column_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_stripe_columns'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'wizestore'),
                "param_name" => "title",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", 'wizestore'),
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
            
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'wizestore' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to button.", 'wizestore')
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
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            )
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Stripe_Columns extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Stripe_Column_Item extends WPBakeryShortCode
        {
        }
    }
}