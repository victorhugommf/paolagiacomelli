<?php

class Smartcrawl_Robots_Value_Helper extends Smartcrawl_Type_Traverser {

	const NOINDEX_KEY_FORMAT          = 'meta_robots-noindex-%s';

	const NOFOLLOW_KEY_FORMAT         = 'meta_robots-nofollow-%s';

	const SUBSEQUENT_PAGES_KEY_FORMAT = 'meta_robots-%s-subsequent_pages';

	/**
	 * The value to display in the robots tag
	 *
	 * @var string
	 */
	private $value;

	protected function clear() {
		$this->value = '';
	}

	public function get_value() {
		_deprecated_function( __FUNCTION__, '2.18.0', 'Smartcrawl_Entity::get_robots()' );

		return $this->value;
	}

	public function handle_blog_home() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		global $paged;

		$noindex               = $this->is_noindex( 'main_blog_archive' ) ? 'noindex' : 'index';
		$nofollow              = $this->is_nofollow( 'main_blog_archive' ) ? 'nofollow' : 'follow';
		$subsequent_pages_only = $this->is_active_on_subsequent_pages( 'main_blog_archive' );

		$this->value = ! $subsequent_pages_only || $paged > 1
			? "{$noindex},{$nofollow}"
			: '';
	}

	private function is_noindex( $place ) {
		$options = $this->get_options();

		return (bool) smartcrawl_get_array_value(
			$options,
			sprintf( self::NOINDEX_KEY_FORMAT, $place )
		);
	}

	private function get_options() {
		return Smartcrawl_Settings::get_options();
	}

	private function is_nofollow( $place ) {
		$options = $this->get_options();

		return (bool) smartcrawl_get_array_value(
			$options,
			sprintf( self::NOFOLLOW_KEY_FORMAT, $place )
		);
	}

	private function is_active_on_subsequent_pages( $place ) {
		$options = $this->get_options();

		return (bool) smartcrawl_get_array_value(
			$options,
			sprintf( self::SUBSEQUENT_PAGES_KEY_FORMAT, $place )
		);
	}

	public function handle_static_home() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$this->handle_singular( get_option( 'page_for_posts' ) );
	}

	public function handle_search() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$noindex  = $this->is_noindex( 'search' ) ? 'noindex' : 'index';
		$nofollow = $this->is_nofollow( 'search' ) ? 'nofollow' : 'follow';

		$this->value = "{$noindex},{$nofollow}";
	}

	public function handle_404() {
		_deprecated_function( __FUNCTION__, '2.18.0' );
		// TODO: Implement handle_404() method.
	}

	public function handle_archive() {
		_deprecated_function( __FUNCTION__, '2.18.0' );
		// TODO: Implement handle_archive() method.
	}

	public function handle_date_archive() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		global $paged;
		$options = $this->get_options();

		if ( empty( $options['enable-date-archive'] ) ) {
			$this->value = 'noindex,follow';
		} else {
			$noindex               = $this->is_noindex( 'date' ) ? 'noindex' : 'index';
			$nofollow              = $this->is_nofollow( 'date' ) ? 'nofollow' : 'follow';
			$subsequent_pages_only = $this->is_active_on_subsequent_pages( 'date' );

			$this->value = ! $subsequent_pages_only || $paged > 1
				? "{$noindex},{$nofollow}"
				: '';
		}
	}

	public function handle_pt_archive() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		global $paged;
		$post_type         = get_queried_object();
		$archive_post_type = 'pt-archive-' . $post_type->name;

		$noindex               = $this->is_noindex( $archive_post_type ) ? 'noindex' : 'index';
		$nofollow              = $this->is_nofollow( $archive_post_type ) ? 'nofollow' : 'follow';
		$subsequent_pages_only = $this->is_active_on_subsequent_pages( $archive_post_type );

		$this->value = ! $subsequent_pages_only || $paged > 1
			? "{$noindex},{$nofollow}"
			: '';
	}

	public function handle_tax_archive() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		global $paged;
		$term     = get_queried_object();
		$taxonomy = $term->taxonomy;

		$noindex_in_settings = $this->is_noindex( $taxonomy );
		$noindex_overridden  = (bool) smartcrawl_get_term_meta( $term, $taxonomy, 'wds_override_noindex' );
		$noindex_in_meta     = (bool) smartcrawl_get_term_meta( $term, $taxonomy, 'wds_noindex' );
		if ( $noindex_in_settings ) {
			$noindex = ! $noindex_overridden;
		} else {
			$noindex = $noindex_in_meta;
		}

		$nofollow_in_settings = $this->is_nofollow( $taxonomy );
		$nofollow_overridden  = (bool) smartcrawl_get_term_meta( $term, $taxonomy, 'wds_override_nofollow' );
		$nofollow_in_meta     = (bool) smartcrawl_get_term_meta( $term, $taxonomy, 'wds_nofollow' );
		if ( $nofollow_in_settings ) {
			$nofollow = ! $nofollow_overridden;
		} else {
			$nofollow = $nofollow_in_meta;
		}

		$noindex_string        = $noindex ? 'noindex' : 'index';
		$nofollow_string       = $nofollow ? 'nofollow' : 'follow';
		$subsequent_pages_only = $this->is_active_on_subsequent_pages( $taxonomy );

		$this->value = ! $subsequent_pages_only || $paged > 1
			? "{$noindex_string},{$nofollow_string}"
			: '';
	}

	public function handle_author_archive() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		global $paged;
		$options = $this->get_options();
		if ( empty( $options['enable-author-archive'] ) ) {
			$this->value = 'noindex,follow';
		} else {
			$noindex               = $this->is_noindex( 'author' ) ? 'noindex' : 'index';
			$nofollow              = $this->is_nofollow( 'author' ) ? 'nofollow' : 'follow';
			$subsequent_pages_only = $this->is_active_on_subsequent_pages( 'author' );

			$this->value = ! $subsequent_pages_only || $paged > 1
				? "{$noindex},{$nofollow}"
				: '';
		}
	}

	public function handle_bp_groups() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$noindex  = $this->is_noindex( 'bp_groups' ) ? 'noindex' : 'index';
		$nofollow = $this->is_nofollow( 'bp_groups' ) ? 'nofollow' : 'follow';

		$this->value = "{$noindex},{$nofollow}";
	}

	public function handle_bp_profile() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$noindex  = $this->is_noindex( 'bp_profile' ) ? 'noindex' : 'index';
		$nofollow = $this->is_nofollow( 'bp_profile' ) ? 'nofollow' : 'follow';

		$this->value = "{$noindex},{$nofollow}";
	}

	public function handle_woo_shop() {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$this->handle_singular( wc_get_page_id( 'shop' ) );
	}

	public function handle_singular( $post_id = 0 ) {
		_deprecated_function( __FUNCTION__, '2.18.0' );

		$post = $this->get_post_or_fallback( $post_id );
		if ( ! $post ) {
			return;
		}

		/**
		 * TODO: quick and dirty implementation, once we have a separate Smartcrawl_Product class, we won't need the following check here
		 */
		if ( $this->is_woo_product( $post ) ) {
			$product_robots = $this->get_woo_product_robots( $post );

			if ( $product_robots ) {
				$this->value = $product_robots;
				return;
			}
		}

		$post_id  = $post->ID;
		$robots[] = $this->is_singular_noindex( $post_id ) ? 'noindex' : 'index';
		$robots[] = $this->is_singular_nofollow( $post_id ) ? 'nofollow' : 'follow';

		$advanced_value = smartcrawl_get_value( 'meta-robots-adv', $post_id );
		if ( $advanced_value && 'none' !== $advanced_value ) {
			$robots[] = $advanced_value;
		}

		$this->value = implode( ',', $robots );
	}

	private function is_woo_product( $post ) {
		return smartcrawl_woocommerce_active() && 'product' === $post->post_type;
	}

	private function get_woo_product_robots( $post ) {
		$data                    = new Smartcrawl_Woocommerce_Data();
		$woo_options             = $data->get_options();
		$woo_enabled             = smartcrawl_get_array_value( $woo_options, 'woocommerce_enabled' );
		$noindex_hidden_products = smartcrawl_get_array_value( $woo_options, 'noindex_hidden_products' );
		$product                 = wc_get_product( $post );
		if (
			$woo_enabled
			&& $noindex_hidden_products
			&& $product
			&& $product->get_catalog_visibility() === 'hidden'
		) {
			return 'noindex,nofollow';
		}

		return false;
	}

	private function is_singular_noindex( $post_id ) {
		// Check if a comment page.
		$current_comments_page = (int) get_query_var( 'cpage' );
		if ( $current_comments_page ) {
			return true;
		}

		// Check at post type level.
		$post_type_noindexed = $this->is_noindex( get_post_type( $post_id ) );

		// Check at post level.
		$index   = (bool) smartcrawl_get_value( 'meta-robots-index', $post_id );
		$noindex = (bool) smartcrawl_get_value( 'meta-robots-noindex', $post_id );

		if ( $post_type_noindexed ) {
			return ! $index;
		} else {
			return $noindex;
		}
	}

	private function is_singular_nofollow( $post_id ) {
		// Check at post type level.
		$post_type_nofollowed = $this->is_nofollow( get_post_type( $post_id ) );

		// Check at post level.
		$follow   = (bool) smartcrawl_get_value( 'meta-robots-follow', $post_id );
		$nofollow = (bool) smartcrawl_get_value( 'meta-robots-nofollow', $post_id );

		if ( $post_type_nofollowed ) {
			return ! $follow;
		} else {
			return $nofollow;
		}
	}
}
