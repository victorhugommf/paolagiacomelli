<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action('init', 'my_get_woo_catss');

function my_get_woo_catss() {
    $product_categories = array();
    $product_cat = array();
    if(class_exists( 'WooCommerce' )){
        $product_categories = get_terms('product_cat', 'orderby=count&hide_empty=0');
        if ( is_array( $product_categories ) ) {
            foreach ( $product_categories as $cat ) {
                $product_cat[$cat->name.' ('.$cat->slug.')'] = $cat->slug;
            }
        }
    }
    if (function_exists('vc_map')) {
        // Add list item
        vc_map(array(
            "name" => esc_html__("GT3 Shop List", 'wizestore'),
            "base" => "gt3_shop_list",
            "class" => "gt3_shop_list",
            "category" => esc_html__('GT3 Modules', 'wizestore'),
            "icon" => 'gt3_icon',
            "content_element" => true,
            "description" => esc_html__("GT3 Shop List",'wizestore'),
            "params" => array(
                array(
                    'type' => 'gt3-multi-select',
                    'heading' => esc_html__('Product Category', 'wizestore' ),
                    'param_name' => 'category',
                    'options' => $product_cat,
                    'description' => 'Leave an empty select if you want to display all categories..',
                    'edit_field_class' => 'vc_col-sm-6 pt-15',
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Items Per Page", 'wizestore'),
                    "param_name" => "per_page",
                    "value"       => '8',
                    "description" => esc_html__("How much items per page to show.", 'wizestore'),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    "heading" => esc_html__("Columns", 'wizestore'),
                    "param_name" => "columns",
                    'value'       => array( 
                        esc_html__('2', 'wizestore' ) => '2',
                        esc_html__('3', 'wizestore' ) => '3',
                        esc_html__('4', 'wizestore' ) => '4',
                        esc_html__('5', 'wizestore' ) => '5',
                        esc_html__('6', 'wizestore' ) => '6',
                    ),
                    "description" => esc_html__("How much columns grid.", 'wizestore'),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order by', 'wizestore' ),
                    'param_name'  => 'orderby',
                    'value'       => array( esc_html__('Date', 'wizestore' ) => 'date', esc_html__('ID', 'wizestore' ) => 'ID',
                        esc_html__('Author', 'wizestore' ) => 'author', esc_html__('Modified', 'wizestore' ) => 'modified',
                        esc_html__('Random', 'wizestore' ) => 'rand', esc_html__('Comment count', 'wizestore' ) => 'comment_count',
                        esc_html__('Menu Order', 'wizestore' ) => 'menu_order'
                    ),
                    'description' => esc_html__('Select how to sort retrieved products.', 'wizestore' ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order way', 'wizestore' ),
                    'param_name'  => 'order',
                    'value'       => array( esc_html__('Descending', 'wizestore' ) => 'DESC', esc_html__('Ascending', 'wizestore' ) => 'ASC'),
                    'description' => esc_html__('Designates the ascending or descending orde.', 'wizestore' ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Grid Gap', 'wizestore'),
                    'param_name' => 'grid_gap',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'wizestore') => 'gap_default',
                        esc_html__("Without Gap", 'wizestore') => 'gap_no_margin',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Grid Style', 'wizestore'),
                    'param_name' => 'grid_style',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'wizestore') => 'grid_default',
                        esc_html__("Packery", 'wizestore') => 'grid_packery',
                        esc_html__("Masonry", 'wizestore') => 'grid_masonry',
                        esc_html__("Custom Masonry", 'wizestore') => 'grid_masonry_custom',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Hover Style', 'wizestore'),
                    'param_name' => 'hover_style',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'wizestore') => 'hover_default',
                        esc_html__("Bottom Title Overlay", 'wizestore') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'wizestore') => 'hover_center',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'grid_style',
                        'value' => array("grid_default", "grid_masonry_custom", "grid_masonry"),
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Hover Style', 'wizestore'),
                    'param_name' => 'hover_style_2',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Bottom Title Overlay", 'wizestore') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'wizestore') => 'hover_center',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'grid_style',
                        'value' => array("grid_packery"),
                    ),
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Hide Products Header?', 'wizestore' ),
                    "param_name"    => "hide_products_header",
                    'save_always' => true,
                    'std' => '',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Show OrderBy?', 'wizestore' ),
                    "param_name"    => "filter",
                    'save_always' => true,
                    'std' => 'true',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Select Box', 'wizestore' ),
                    "param_name"    => "filter_number",
                    'save_always' => true,
                    'std' => 'true',
                    'description' => 'Show select box for modifying the number of items displayed per page.',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Pagination', 'wizestore'),
                    'param_name' => 'pagination',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Bottom", 'wizestore') => 'bottom',
                        esc_html__("Bottom and Top", 'wizestore') => 'bottom_top',
                        esc_html__("Off", 'wizestore') => 'off',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Use Scroll Animation?', 'wizestore' ),
                    "param_name"    => "scroll_anim",
                    'save_always' => true,
                    'std' => '',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                
            )
        ));
        
        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_shop_list extends WPBakeryShortCode {
                
            }
        } 
    }
}
