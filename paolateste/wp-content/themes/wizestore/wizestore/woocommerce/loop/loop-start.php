<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gt3_classes = '';
if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) { /* Added from v1.1.0 */
	$products_layout = gt3_option('products_layout');
	if ( 'masonry' == $products_layout ) {
		$gt3_classes = "shop_grid_masonry";
		add_filter( 'single_product_archive_thumbnail_size', 'gt3_filter_single_product_archive_thumbnail_size', 10, 1 );
	} else {
		$gt3_classes = "";
	}
}
$gt3_classes .= " columns-".esc_attr( wc_get_loop_prop( 'columns' ) );

?>
<ul class="products <?php echo ''.$gt3_classes; ?>">
