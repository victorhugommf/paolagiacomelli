<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action('init', 'my_get_woo_cats');

function my_get_woo_cats() {
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
        vc_map(array(
            'base' => 'gt3_products_tab',
            'name' => esc_html__('GT3 Products Tab', 'wizestore'),
            "description" => esc_html__("Products Tab by Category", 'wizestore'),
            'category' => esc_html__('GT3 Modules', 'wizestore'),
            'icon' => 'gt3_icon',
            'params' => array(
                array(
                    'type' => 'gt3-multi-select',
                    'heading' => esc_html__('Product Category', 'wizestore' ),
                    'param_name' => 'category',
                    'options' => $product_cat
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Items Per Page", 'wizestore'),
                    "param_name" => "per_page",
                    "value"       => '4',
                    "description" => esc_html__("How much items per page to show.", 'wizestore')
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Columns", 'wizestore'),
                    "param_name" => "columns",
                    "value"       => '4',
                    "description" => esc_html__("How much columns grid.", 'wizestore')
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
                    'description' => esc_html__('Select how to sort retrieved products.', 'wizestore' )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order way', 'wizestore' ),
                    'param_name'  => 'order',
                    'value'       => array( esc_html__('Descending', 'wizestore' ) => 'DESC', esc_html__('Ascending', 'wizestore' ) => 'ASC'),
                    'description' => esc_html__('Designates the ascending or descending orde.', 'wizestore' )
                )
            ),


        ));

        class WPBakeryShortCode_Gt3_products_tab extends WPBakeryShortCode { }

    }
}