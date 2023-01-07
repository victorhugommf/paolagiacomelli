<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

function gt3_generate_autocomplite( $post_type = 'post' ) {
    $posts = get_posts( array(
        'posts_per_page'    => -1,
        'post_type'         => $post_type,
    ));
 
    $result = array();
    foreach ( $posts as $post ) {
        $id = $post->ID;
        $product_object = wc_get_product((int) $id );
        if ( is_object( $product_object ) ) {
            $product_sku = $product_object->get_sku();
            $product_title = $product_object->get_title();
            $product_id = $id;

            $product_sku_display = '';
            if ( ! empty( $product_sku ) ) {
                $product_sku_display = ' - ' . esc_html__( 'Sku', 'wizestore' ) . ': ' . $product_sku;
            }

            $product_title_display = '';
            if ( ! empty( $product_title ) ) {
                $product_title_display = ' - ' . esc_html__( 'Title', 'wizestore' ) . ': ' . $product_title;
            }

            $product_id_display = esc_html__( 'Id', 'wizestore' ) . ': ' . $product_id;

            $label = $product_id_display . $product_title_display . $product_sku_display;

        }

        $result[] = array(
            'value' => $id,
            'label' => $label,
        );
    }
    return $result;
}


add_action( 'vc_after_mapping', 'gt3_add_product_shortcode' );
function gt3_add_product_shortcode () {

    $count_posts = wp_count_posts('product');
    $options_array = array(
        array(
            'type' => 'hidden',
            // This will not show on render, but will be used when defining value for autocomplete
            'param_name' => 'sku',
        ),

        array(
            "type"          => "checkbox",
            "heading"       => esc_html__( 'Right side image.', 'wizestore' ),
            "param_name"    => "image_right",
            'save_always' => true,
            'std' => '',
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Background Text", 'wizestore'),
            "param_name" => "bg_text",
            "value"       => '',
        ),
    );

    if ((int)$count_posts->publish > 200) {
        array_unshift($options_array, 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Input product ID', 'wizestore' ),
                'param_name' => 'id',
            )
        );
    }else{
        array_unshift($options_array, 
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__( 'Select identificator', 'wizestore' ),
                'param_name' => 'id',
                'description' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'wizestore' ),
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
            )
        );
    }

    



    if (function_exists('vc_map')) {
    // Add list item
        vc_map(array(
            'name' => esc_html__( 'Gt3 Shop Product', 'wizestore' ),
            'base' => 'gt3_product_shop',
            "icon" => 'gt3_icon',
            "category" => esc_html__('GT3 Modules', 'wizestore'),
            'description' => esc_html__( 'Show a single product by ID or SKU', 'wizestore' ),
            'params' => $options_array,
        ));

        
        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_Product_Shop extends WPBakeryShortCode {
                
            }
        } 
    }    
}