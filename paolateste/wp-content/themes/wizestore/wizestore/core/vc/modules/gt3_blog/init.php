<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Blog Posts', 'wizestore'),
        'base' => 'gt3_blog',
        'class' => 'gt3_blog',
        "description" => esc_html__("Display blog posts", 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Blog Items', 'wizestore'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'post', 'hidden' => true),
                    'categories' => array('hidden' => false),
                    'tags' => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'wizestore')
            ),
            // Post meta
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Cut off text in blog listing', 'wizestore' ),
                'param_name' => 'blog_post_listing_content_module',
                'description' => esc_html__( 'If checked, cut off text in blog listing.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Post Format Label
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-format label?', 'wizestore' ),
                'param_name' => 'pf_post_icon',
                'description' => esc_html__( 'If checked, post-format label is visible.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta author?', 'wizestore' ),
                'param_name' => 'meta_author',
                'description' => esc_html__( 'If checked, post-meta will have author.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta comments?', 'wizestore' ),
                'param_name' => 'meta_comments',
                'description' => esc_html__( 'If checked, post-meta will have comments.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta categories?', 'wizestore' ),
                'param_name' => 'meta_categories',
                'description' => esc_html__( 'If checked, post-meta will have categories.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta date?', 'wizestore' ),
                'param_name' => 'meta_date',
                'description' => esc_html__( 'If checked, post-meta will have date.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Items per line
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Line', 'wizestore' ),
                'param_name' => 'items_per_line',
                "value"         => array(
                    esc_html__( '1', 'wizestore' ) => '1',
                    esc_html__( '2', 'wizestore' ) => '2',
                    esc_html__( '3', 'wizestore' ) => '3',
                    esc_html__( '4', 'wizestore' ) => '4'
                ),
                "description" => esc_html__("Select post items per line.", 'wizestore')
            ),
            // Spacing beetween items
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Spacing beetween items', 'wizestore' ),
                'param_name' => 'spacing_beetween_items',
                "value"         => array(
                    esc_html__( '5px', 'wizestore' )      => '5',
                    esc_html__( '10px', 'wizestore' )      => '10',
                    esc_html__( '15px', 'wizestore' )      => '15',
                    esc_html__( '20px', 'wizestore' )      => '20',
                    esc_html__( '25px', 'wizestore' )      => '25',
                    esc_html__( '30px', 'wizestore' )      => '30'
                ),
                'std' => '30',
                "description" => esc_html__("Select spacing beetween items.", 'wizestore'),
                "dependency" => Array("element" => "items_per_line","value" => array("2", "3", "4")),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'wizestore'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wizestore')
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Blog extends WPBakeryShortCode {
    }
}