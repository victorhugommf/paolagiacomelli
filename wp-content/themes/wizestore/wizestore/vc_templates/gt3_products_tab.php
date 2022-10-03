<?php

$defaults = array(
	'category' => '',
	'per_page' => '4',
	'columns' => '4',
	'orderby' => 'id',
	'order' => 'DESC'
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$categories = explode( ',', $category);

$list_cat = '';
$list_item_by_cat = '';
$is_active=0;

foreach ($categories as $cat_slug) {
	$cat_obj = get_term_by('slug', $cat_slug, 'product_cat');
	$cat_name = $cat_obj->name;

	if($is_active==0){
        $active_class='active';
        $is_active = 1;
    }else{
        $active_class = '';
    }

	$list_cat .= '<a href="javascript:;" class="product-filter '.$cat_slug.'  '.$active_class.'" data-filter=".'.$cat_slug.'">'.$cat_name.'</a>';

	$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );
    $meta_query    = WC()->query->get_meta_query();

    $args = array(
        'post_type'				=> 'product',
        'post_status' 			=> 'publish',
        'ignore_sticky_posts'	=> 1,
        'orderby' 				=> $ordering_args['orderby'],
        'order' 				=> $ordering_args['order'],
        'posts_per_page' 		=> $per_page,
        'meta_query' 			=> $meta_query,
        'tax_query' 			=> array(
            array(
                'taxonomy' 		=> 'product_cat',
                'terms' 		=> $cat_slug,
                'field' 		=> 'slug',
                'operator' 		=> 'IN'
            )
        )
    );

    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
    global $woocommerce_loop;

    $columns                     = absint( $columns );
    $woocommerce_loop['columns'] = $columns;

    ob_start();

    if ( $products->have_posts() ) : ?>

        <?php do_action( 'woocommerce_shortcode_before_product_cat_loop' ); ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php do_action( 'woocommerce_shortcode_after_product_cat_loop' ); ?>

    <?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();

    $list_item_by_cat .= '<div class="gt3-tab-group '.$cat_slug . ' '.$active_class.'">' . ob_get_clean() . '</div>';

}

echo '<div class="gt3-woocommers-tab">';
	echo '<div class="gt3-woo-filter">';
		echo ''.$list_cat;
	echo '</div>';
	echo '<div class="woocommerce columns-'. $columns .'">';
		echo ''.$list_item_by_cat;
	echo '</div>';
echo '</div>'
?>