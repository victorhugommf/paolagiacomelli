<?php

class Smartcrawl_Schema_Type_Woo_Product extends Smartcrawl_Schema_Type {
	const TYPE          = 'WooProduct';
	const TYPE_SIMPLE   = 'WooSimpleProduct';
	const TYPE_VARIABLE = 'WooVariableProduct';

	/**
	 * @return string
	 */
	public function get_type() {
		return 'Product';
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return parent::is_active() && smartcrawl_woocommerce_active();
	}
}
