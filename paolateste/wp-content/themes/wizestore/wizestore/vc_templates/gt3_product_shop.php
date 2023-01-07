<?php

$defaults = array(
	'id' => '',
    'image_right' => '',
    'bg_text' => ''
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$meta_query = WC()->query->get_meta_query();

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 1,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'meta_query'     => $meta_query,
    'tax_query'      => WC()->query->get_tax_query(),
);

if ( isset( $id ) ) {
    $args['p'] = $id;
}

remove_action('woocommerce_after_shop_loop_item', 'gt3_open_controll_tag', 9);
remove_action('woocommerce_after_shop_loop_item', 'gt3_close_controll_tag', 15);


$products = new WP_Query( $args );

ob_start();
if ( $products->have_posts() ) : ?>

    <?php
    while ( $products->have_posts() ) : $products->the_post(); ?>

        <div class="product">
            <div class="gt3-product_image-wrapper">
                <?php echo woocommerce_get_product_thumbnail('full');?>
                <?php echo woocommerce_show_product_loop_sale_flash(); ?>
                <?php do_action('gt3_hot_new_label_product');  // gt3_hot_new_product - 10 ?>
            </div>

            <div class="gt3-product_info-wrapper">
                <div class="gt3-product_info-content">
                    <a href="<?php echo get_the_permalink();?>" class="woocommerce-LoopProduct-link">
                        <h3 class="gt3-product-title"><?php echo get_the_title(); ?></h3>
                    </a>
                    <?php
                    echo woocommerce_template_loop_price();
                    echo woocommerce_template_single_excerpt();
                    ?>
                    <div class="gt3-product_button-wrapper">
                        <?php  do_action( 'woocommerce_after_shop_loop_item' ); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; // end of the loop. ?>

    <?php
    do_action( 'woocommerce_after_shop_loop' ); ?>

<?php endif;

woocommerce_reset_loop();
wp_reset_postdata();

$shop_prod_class = "";
if ( (bool) $image_right ) {
    $shop_prod_class = "gt3-right-image";
}

$bg_text =  isset($bg_text) && !empty($bg_text) ? '<span class="gt3-product_bg-text">'. esc_html($bg_text) .'</span>' : '';

$list_item_by_cat = '<div class="woocommerce gt3-shop-product '.$shop_prod_class.'">' . ob_get_clean() . $bg_text . '</div>';

echo ''.$list_item_by_cat;
?>