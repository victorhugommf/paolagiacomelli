<?php

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!class_exists('Vc_Manager')) {
    return;
}

    require_once get_template_directory() . '/core/vc/custom_types/gt3_on_off.php';
	require_once get_template_directory() . '/core/vc/custom_types/gt3_packery_layout_select.php';
	require_once get_template_directory() . '/core/vc/custom_types/gt3_element_pos.php';
	require_once get_template_directory() . '/core/vc/custom_types/image_select.php';
    require_once get_template_directory() . '/core/vc/custom_types/gt3_multi_select.php';

add_action('vc_before_init', 'gt3_vcSetAsTheme');
function gt3_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = true);
}

/* List of Active VC Modules */
$gt3_vc_modules = array(
    'gt3_blog',
    'gt3_counter',
    'gt3_featured_posts',
    'gt3_carousel',
    'gt3_price_block',
    'gt3_team',
    'gt3_testimonials',
    'gt3_icon_box',
    'gt3_image_box',
    'gt3_message_box',
    'gt3_button',
    'gt3_custom_text',
    'gt3_process_bar',
    'gt3_countdown',
    'gt3_video_popup',
    'gt3_spacing',
    'gt3_stripe_img',
    'gt3_gallery_packery',
    'gt3_hotspot',
);

if (class_exists('WooCommerce')) {
    array_push($gt3_vc_modules, 'gt3_products_tab', 'gt3_shop_list', 'gt3_product_shop');

    if ( 'yes' !== get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
        add_action( 'wp_print_scripts', 'de_script', 100 );
        function de_script() {
            wp_dequeue_script('vc_woocommerce-add-to-cart-js');
        }
    }
}

if (class_exists('StormTwitter')) {
    array_push($gt3_vc_modules, 'gt3_twitter');
}

foreach ($gt3_vc_modules as $gt3_vc_module) {
    require_once get_template_directory() . '/core/vc/modules/' . $gt3_vc_module . '/init.php';
}

/* List of Active VC Params */
$gt3_vc_params = array(
    'param_hotspot',
);

foreach ($gt3_vc_params as $gt3_vc_param) {
    require_once get_template_directory() . '/core/vc/params/' . $gt3_vc_param . '/init.php';
}


vc_remove_param( 'vc_tta_tabs', 'style' );
vc_remove_param( 'vc_tta_tabs', 'shape' );
vc_remove_param( 'vc_tta_tabs', 'color' );
vc_remove_param( 'vc_tta_tabs', 'spacing' );
vc_remove_param( 'vc_tta_tabs', 'gap' );
vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
vc_remove_param( 'vc_tta_tabs', 'pagination_color' );
vc_remove_param( 'vc_tta_tabs', 'no_fill_content_area' );


vc_remove_param( 'vc_tta_tour', 'style' );
vc_remove_param( 'vc_tta_tour', 'shape' );
vc_remove_param( 'vc_tta_tour', 'color' );
vc_remove_param( 'vc_tta_tour', 'spacing' );
vc_remove_param( 'vc_tta_tour', 'gap' );
vc_remove_param( 'vc_tta_tour', 'pagination_style' );
vc_remove_param( 'vc_tta_tour', 'pagination_color' );
vc_remove_param( 'vc_tta_tour', 'no_fill_content_area' );

vc_remove_param( 'vc_tta_accordion', 'color' );
vc_remove_param( 'vc_tta_accordion', 'spacing' );
vc_remove_param( 'vc_tta_accordion', 'gap' );
//vc_remove_param( 'vc_tta_accordion', 'shape' );
vc_remove_param( 'vc_tta_accordion', 'no_fill' );
vc_add_param( 'vc_tta_accordion' , array(
    'type' => 'dropdown',
    'heading' => "Accordion Style",
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Classic', 'wizestore' ) => "classic",
        esc_html__( 'Solid', 'wizestore' ) => "accordion_solid",
        esc_html__( 'In Border', 'wizestore' ) => "accordion_bordered",
    )
));
vc_add_param( 'vc_tta_accordion' , array(
    'type' => 'checkbox',
    'heading' => "Accordion On Dark Background",
    'param_name' => 'shape',
));


vc_remove_param( 'vc_toggle', 'use_custom_heading' );
vc_remove_param( 'vc_toggle', 'custom_font_container' );
vc_remove_param( 'vc_toggle', 'custom_use_theme_fonts' );
vc_remove_param( 'vc_toggle', 'custom_google_fonts' );
vc_remove_param( 'vc_toggle', 'custom_css_animation' );
vc_remove_param( 'vc_toggle', 'custom_el_class' );

vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Style",
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Classic', 'wizestore' ) => "classic",
        esc_html__( 'Solid', 'wizestore' ) => "accordion_solid",
        esc_html__( 'In Border', 'wizestore' ) => "accordion_bordered",
    )
));
vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Icon",
    "param_name" => "color",
    'value' => array(
        esc_html__( 'None', 'wizestore' ) => "none",
        esc_html__( 'Chevron', 'wizestore' ) => "chevron",
        esc_html__( 'Plus', 'wizestore' ) => "plus",
        esc_html__( 'Triangle', 'wizestore' ) => "triangle",
    )
));
vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Icon Position",
    "param_name" => "size",
    'value' => array(
        esc_html__( 'Left', 'wizestore' ) => "left",
        esc_html__( 'Right', 'wizestore' ) => "right",
    )
));

vc_add_param("vc_separator",array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Element width', 'wizestore' ),
    'param_name' => 'el_width',
    'value' => array(
        '100%' => '',
        '90%' => '90',
        '80%' => '80',
        '70%' => '70',
        '60%' => '60',
        '50%' => '50',
        '40%' => '40',
        '30%' => '30',
        '20%' => '20',
        '10%' => '10',
        '100px' => '100px',
        '75px' => '75px',
        '40px' => '40px',
        ),
    'description' => esc_html__( 'Select separator width (percentage or px).', 'wizestore' ),
));
