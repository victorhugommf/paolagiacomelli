<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_featured_posts',
        'name' => esc_html__('Featured Blog Posts', 'wizestore'),
        "description" => esc_html__("Display the featured blog posts", 'wizestore'),
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
            // Module Title
            array(
                "type" => "textfield",
                'heading' => esc_html__('Module title', 'wizestore'),
                "param_name" => "module_title",
                "value" => "",
                "description" => esc_html__("Enter text used as module title (Note: located above content element).", 'wizestore')
            ),
            // Link Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Module Link Text", 'wizestore'),
                "param_name" => "external_link_text",
                "value" => "",
                "description" => esc_html__("Text on the module link.", 'wizestore'),
            ),
            // Link Setts
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Module Link', 'wizestore' ),
                'param_name' => 'external_link',
                "dependency" => Array("element" => "external_link_text", "not_empty" => true),
            ),
            // View Type
            array(
                'type' => 'gt3_dropdown',
                'class' => '',
                'heading' => esc_html__('Style select', 'wizestore'),
                'param_name' => 'view_type',
                'fields' => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type1.jpg',
                        'descr' => esc_html__('Type 1', 'wizestore')),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type2.jpg',
                        'descr' => esc_html__('Type 2', 'wizestore')),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type3.jpg',
                        'descr' => esc_html__('Type 3', 'wizestore')),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type4.jpg',
                        'descr' => esc_html__('Type 4', 'wizestore')),
                ),
                'value' => 'type4',
            ),
            // Post meta
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Allow uppercase post-meta text?', 'wizestore' ),
                'param_name' => 'post_meta_uppercase',
                'description' => esc_html__( 'If checked, allow uppercase post-meta text.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta author?', 'wizestore' ),
                'param_name' => 'meta_author',
                'description' => esc_html__( 'If checked, post-meta will have author.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta comments?', 'wizestore' ),
                'param_name' => 'meta_comments',
                'description' => esc_html__( 'If checked, post-meta will have comments.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta categories?', 'wizestore' ),
                'param_name' => 'meta_categories',
                'description' => esc_html__( 'If checked, post-meta will have categories.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
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
            // Post Format Label
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-format label?', 'wizestore' ),
                'param_name' => 'pf_post_icon',
                'description' => esc_html__( 'If checked, post-format label is visible.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type4"))
            ),
            // Post Read More Link
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post read more link?', 'wizestore' ),
                'param_name' => 'post_read_more_link',
                'description' => esc_html__( 'If checked, post read more link is visible.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type4"))
            ),
            // Post Read More Link
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Allow boxed text content?', 'wizestore' ),
                'param_name' => 'boxed_text_content',
                'description' => esc_html__( 'If checked, allow boxed text content.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            // Image Proportions
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Image Proportions', 'wizestore' ),
                'param_name' => 'image_proportions',
                "value"         => array(
                    esc_html__( '4/3', 'wizestore' ) => '4_3',
                    esc_html__( 'Horizontal', 'wizestore' ) => 'horizontal',
                    esc_html__( 'Vertical', 'wizestore' ) => 'vertical',
                    esc_html__( 'Square', 'wizestore' ) => 'square',
                    esc_html__( 'Original', 'wizestore' ) => 'original'
                ),
                'std' => 'square',
                "description" => esc_html__("Select image proportions.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
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
                "description" => esc_html__("Select post items per line.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Line', 'wizestore' ),
                'param_name' => 'items_per_line_type2',
                "value"         => array(
                    esc_html__( '1', 'wizestore' ) => '1',
                    esc_html__( '2', 'wizestore' ) => '2'
                ),
                "description" => esc_html__("Select post items per line.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type2")),
            ),
            // Spacing beetween items
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Spacing beetween items', 'wizestore' ),
                'param_name' => 'spacing_beetween_items',
                "value"         => array(
                    esc_html__( '30px', 'wizestore' )      => '30',
                    esc_html__( '25px', 'wizestore' )      => '25',
                    esc_html__( '20px', 'wizestore' )      => '20',
                    esc_html__( '15px', 'wizestore' )      => '15',
                    esc_html__( '10px', 'wizestore' )      => '10',
                    esc_html__( '5px', 'wizestore' )      => '5'
                ),
                "description" => esc_html__("Select spacing beetween items.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type2", "type3", "type4")),
            ),
            // Post meta position
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Post meta position', 'wizestore' ),
                'param_name' => 'meta_position',
                "value"         => array(
                    esc_html__( 'Before Title', 'wizestore' ) => 'before_title',
                    esc_html__( 'After Title', 'wizestore' ) => 'after_title'
                ),
                'std' => 'after_title',
                "description" => esc_html__("Select post-meta position.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type1","type2", "type3", "type4")),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Make first post with image', 'wizestore' ),
                'param_name' => 'first_post_image',
                'description' => esc_html__( 'If checked, make first post with image.', 'wizestore' ),
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                "dependency" => Array("element" => "view_type","value" => array("type1")),
                'save_always' => true,
                'std' => 'yes'
            ),
            // Content alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content alignment', 'wizestore' ),
                'param_name' => 'content_alignment',
                "value"         => array(
                    esc_html__( 'Left', 'wizestore' ) => 'left',
                    esc_html__( 'Center', 'wizestore' ) => 'center',
                    esc_html__( 'Right', 'wizestore' ) => 'right',
                    esc_html__( 'Justify', 'wizestore' ) => 'justify'
                ),
                "description" => esc_html__("Select content alignment.", 'wizestore'),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'wizestore'),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'wizestore' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- CAROUSEL GROUP --- //
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use blog-posts carousel?', 'wizestore' ),
                'param_name' => 'use_carousel',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                "group" => esc_html__( "Carousel", 'wizestore' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Autoplay carousel', 'wizestore' ),
                'param_name' => 'autoplay_carousel',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay time.', 'wizestore' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'autoplay_carousel',
                    'value' => array("yes"),
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Single slide to scroll', 'wizestore' ),
                'param_name' => 'scroll_items',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                'std' => 'yes',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Infinite Scroll', 'wizestore' ),
                'param_name' => 'infinite_scroll',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide Pagination control', 'wizestore' ),
                'param_name' => 'use_pagination_carousel',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide prev/next buttons', 'wizestore' ),
                'param_name' => 'use_prev_next_carousel',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Adaptive Height', 'wizestore' ),
                'param_name' => 'adaptive_height',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Column', 'wizestore' ),
                'param_name' => 'items_per_column',
                "value"         => array(
                    esc_html__( '1', 'wizestore' ) => '1',
                    esc_html__( '2', 'wizestore' ) => '2',
                    esc_html__( '3', 'wizestore' ) => '3',
                    esc_html__( '4', 'wizestore' ) => '4'
                ),
                "description" => esc_html__("Select post items per column.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'wizestore' ),
            ),
            // --- CUSTOM GROUP --- //
            // Blog Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for blog?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_blog',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_blog',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
            ),
            // Blog Headings Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for blog headings?', 'wizestore' ),
                'param_name' => 'use_theme_fonts_blog_headings',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'wizestore' ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'wizestore' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'wizestore' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_blog_headings',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default blog style?', 'wizestore' ),
                'param_name' => 'use_theme_blog_style',
                'value' => array( esc_html__( 'Yes', 'wizestore' ) => 'yes' ),
                'description' => esc_html__( 'Use default blog style from the theme.', 'wizestore' ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'std' => 'yes',
            ),
            // Custom blog style
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Theme Color", 'wizestore'),
                "param_name" => "custom_theme_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom theme color.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Headings Color", 'wizestore'),
                "param_name" => "custom_headings_color",
                "value" => esc_attr($header_font['color']),
                "description" => esc_html__("Select custom headings color.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Content Color", 'wizestore'),
                "param_name" => "custom_content_color",
                "value" => esc_attr($main_font['color']),
                "description" => esc_html__("Select custom content color.", 'wizestore'),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'wizestore'),
                'param_name' => 'heading_font_size',
                'value' => '18',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'wizestore'),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'wizestore' ),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'wizestore' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
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

    class WPBakeryShortCode_Gt3_Featured_Posts extends WPBakeryShortCode
    {
    }
}