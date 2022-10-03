<?php

function gt3_child_scripts() {
	wp_enqueue_style( 'gt3-child-style', get_template_directory_uri() . '/style.css', array('gt3_theme', 'woocommerce') );
}

add_action( 'wp_enqueue_scripts', 'gt3_child_scripts' );

/**
 * Your code here.
*/ 

//****************************************************************************************************************
//****************************************************************************************************************
// Display the Woocommerce Discount Percentage on the Sale Badge for variable products and single products
//****************************************************************************************************************
//****************************************************************************************************************

add_filter( 'woocommerce_sale_flash', 'display_percentage_on_sale_badge', 20, 3 );
function display_percentage_on_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // This will get all the variation prices and loop throughout them
      $prices = $product->get_variation_prices();

      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

       // This will get all the variation prices and loop throughout them
      $children_ids = $product->get_children();

      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = round(100 - ($sale_price / $regular_price * 100));
          }
      }
     // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<span class="onsale">' . esc_html__( '-', 'woocommerce' ) . ' '. $percentage . '</span>'; // If needed then change or remove "up to -" text
}

//****************************************************************************************************************
//****************************************************************************************************************
//Remove product data tabs
//****************************************************************************************************************
//****************************************************************************************************************

/*add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab

    return $tabs;
}

//****************************************************************************************************************
//****************************************************************************************************************
/*Adicionar label dos atributos de cor no shop page*/
//****************************************************************************************************************
//****************************************************************************************************************

add_action('woocommerce_after_shop_loop_item_title', 'display_shop_loop_product_attributes', 100);
function display_shop_loop_product_attributes() {
    global $product;

    // Define you product attribute taxonomies in the array
    $product_attribute_taxonomies = array( 'pa_cor' );
    $attr_output = array(); // Initializing
	$term_colors = array();
	
	$terms = get_the_terms( $product->get_id(), 'pa_cor' );
	foreach ($terms as $term) {
        $term_colors[] = get_term_meta($term->term_id)["product_attribute_color"][0];
        $hash_color = get_term_meta($term->term_id)["product_attribute_color"][0];// Ex: #d4be16
        $attr_output[] = '<div class="box" style="background-color:'.$hash_color.'"></div>';
}

    

    // Output
    echo '<div class="product-attributes">';
    foreach($attr_output as $output){
        echo $output;
    }
    echo '</div>';
    
}


//****************************************************************************************************************
//****************************************************************************************************************
// Adding multiple items do cart URL code
//****************************************************************************************************************
//****************************************************************************************************************

function webroom_add_multiple_products_to_cart( $url = false ) {
	// Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
	if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
		return;
	}

	// Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
	remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

	$product_ids = explode( ',', $_REQUEST['add-to-cart'] );
	$count       = count( $product_ids );
	$number      = 0;

	foreach ( $product_ids as $id_and_quantity ) {
		// Check for quantities defined in curie notation (<product_id>:<product_quantity>)
		
		$id_and_quantity = explode( ':', $id_and_quantity );
		$product_id = $id_and_quantity[0];

		$_REQUEST['quantity'] = ! empty( $id_and_quantity[1] ) ? absint( $id_and_quantity[1] ) : 1;

		if ( ++$number === $count ) {
			// Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
			$_REQUEST['add-to-cart'] = $product_id;

			return WC_Form_Handler::add_to_cart_action( $url );
		}

		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
		$was_added_to_cart = false;
		$adding_to_cart    = wc_get_product( $product_id );

		if ( ! $adding_to_cart ) {
			continue;
		}

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

		// Variable product handling
		if ( 'variable' === $add_to_cart_handler ) {
			woo_hack_invoke_private_method( 'WC_Form_Handler', 'add_to_cart_handler_variable', $product_id );

		// Grouped Products
		} elseif ( 'grouped' === $add_to_cart_handler ) {
			woo_hack_invoke_private_method( 'WC_Form_Handler', 'add_to_cart_handler_grouped', $product_id );

		// Custom Handler
		} elseif ( has_action( 'woocommerce_add_to_cart_handler_' . $add_to_cart_handler ) ){
			do_action( 'woocommerce_add_to_cart_handler_' . $add_to_cart_handler, $url );

		// Simple Products
		} else {
			woo_hack_invoke_private_method( 'WC_Form_Handler', 'add_to_cart_handler_simple', $product_id );
		}
	}
}

// Fire before the WC_Form_Handler::add_to_cart_action callback.
add_action( 'wp_loaded', 'webroom_add_multiple_products_to_cart', 15 );


/**
 * Invoke class private method
 *
 * @since   0.1.0
 *
 * @param   string $class_name
 * @param   string $methodName
 *
 * @return  mixed
 */
function woo_hack_invoke_private_method( $class_name, $methodName ) {
	if ( version_compare( phpversion(), '5.3', '<' ) ) {
		throw new Exception( 'PHP version does not support ReflectionClass::setAccessible()', __LINE__ );
	}

	$args = func_get_args();
	unset( $args[0], $args[1] );
	$reflection = new ReflectionClass( $class_name );
	$method = $reflection->getMethod( $methodName );
	$method->setAccessible( true );

	//$args = array_merge( array( $class_name ), $args );
	$args = array_merge( array( $reflection ), $args );
	return call_user_func_array( array( $method, 'invoke' ), $args );
}
	  
	  
	  
//****************************************************************************************************************
//****************************************************************************************************************
// Melhorando a sequência dos Campos
//****************************************************************************************************************
//****************************************************************************************************************

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'removeBillingCompany' , 99);

// Our hooked in function - $fields is passed via the filter!
function removeBillingCompany( $fields ) {
     unset($fields['billing']['billing_company']);
     unset($fields['billing']['billing_last_name']);
     unset($fields['billing']['billing_birthdate_field']);
     unset($fields['billing']['billing_sex_field']);
     return $fields;
}


add_filter( 'woocommerce_checkout_fields', 'paola_checkoutfields', 1);

function paola_checkoutfields( $checkout_fields ) {
	$checkout_fields['billing']['billing_email']['priority'] = 1;
	$checkout_fields['billing']['billing_cellphone']['priority'] = 2;
	$checkout_fields['billing']['billing_first_name']['priority'] = 3;
	$checkout_fields['billing']['billing_cpf']['priority'] = 4;

	$checkout_fields['billing']['billing_cellphone']['required'] = true;
	
	$checkout_fields['billing']['billing_cellphone']['label'] = 'Celular';
	$checkout_fields['billing']['billing_cellphone']['placeholder'] = 'Número com DDD';
	$checkout_fields['billing']['billing_phone']['label'] = 'Telefone de Contato Adicional';
	$checkout_fields['billing']['billing_phone']['placeholder'] = 'Número com DDD';
	
	
	
	
	return $checkout_fields;
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' , 1);

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
    $address_fields['first_name']['label'] = 'Nome Completo';
	$address_fields['first_name']['placeholder'] = 'Digite seu nome completo';
	
	

    return $address_fields;
}