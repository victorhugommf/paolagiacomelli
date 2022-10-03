<?php
/* Special filters to enhance responsive images */

function wize_content_image_sizes_attr($sizes, $size) {
	$width = $size[0];
	if ( class_exists('Woocommerce') && is_shop()) { // SHOP page
		$store_columns = gt3_option('woocommerce_def_columns');
		if (gt3_option('products_layout') != 'container') {
			switch ($store_columns) {
				case '2':
	        		$sizes = '50vw';
					break;
				case '3':
	        		$sizes = '(max-width: 768px) 50vw, 34vw';
					break;
				case '4':
	        		$sizes = '(max-width: 768px) 50vw, 25vw';
					break;
				case '5':
	        		$sizes = '(max-width: 768px) 50vw, 20vw';
					break;
				case '6':
	        		$sizes = '(max-width: 768px) 50vw, 16vw';
					break;
				default:
	        		$sizes = '(max-width: 768px) 50vw, 34vw';
			};
		} else {
			switch ($store_columns) {
				case '2':
	        		$sizes = '(max-width: 1200px) 50vw, 600px';
					break;
				case '3':
	        		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 34vw, 400px';
					break;
				case '4':
	        		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 25vw, 300px';
					break;
				case '5':
	        		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 20vw, 240px';
					break;
				case '6':
	        		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 16vw, 200px';
					break;
				default:
	        		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 34vw, 400px';
			};
		}
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'wize_content_image_sizes_attr', 10 , 2);

?>