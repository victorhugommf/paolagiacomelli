<?php

class Smartcrawl_Sitemap_News_Query extends Smartcrawl_Sitemap_Query {

	use Smartcrawl_Singleton;

	/**
	 * @return Smartcrawl_Sitemap_News_Item[]
	 */
	public function get_items( $type = '', $page_number = 0 ) {
		$posts = $this->make_fetcher(
			$this->get_offset( $page_number ),
			$this->get_limit( $page_number ),
			empty( $type ) ? $this->get_supported_types() : array( $type )
		)->fetch();

		$items = array();
		foreach ( $posts as $post ) {
			$item = new Smartcrawl_Sitemap_News_Item();
			$item->set_title( $this->get_post_title( $post ) )
				->set_location( $this->get_post_url( $post ) )
				->set_publication_time( $this->get_post_timestamp( $post ) )
				->set_publication( $this->get_publication() )
				->set_language( $this->get_language_code() );

			$items[] = $item;
		}

		return $items;
	}

	public function get_item_count( $type = '' ) {
		return $this->make_fetcher(
			0,
			self::NO_LIMIT,
			empty( $type ) ? $this->get_supported_types() : array( $type )
		)->count();
	}

	/**
	 * @return mixed|void
	 */
	private function get_language_code() {
		$locale = get_locale();
		if ( 'zh_TW' === $locale ) {
			$language_code = 'zh-tw';
		} elseif ( 'zh_CN' === $locale ) {
			$language_code = 'zh-cn';
		} else {
			$contains_underscore = strpos( $locale, '_' ) !== false;
			$contains_dash       = strpos( $locale, '-' ) !== false;
			if ( $contains_underscore ) {
				$parts = explode( '_', $locale );
			} elseif ( $contains_dash ) {
				$parts = explode( '-', $locale );
			} else {
				$parts = array( $locale );
			}

			$language_code = empty( $parts )
				? 'en'
				: $parts[0];
		}

		return apply_filters( 'wds_news_sitemap_language_code', $language_code );
	}

	/**
	 * @return Smartcrawl_Sitemap_Post_Fetcher
	 */
	private function make_fetcher( $offset, $limit, $post_types ) {
		$fetcher    = new Smartcrawl_Sitemap_Post_Fetcher();
		$post_types = is_string( $post_types )
			? array( $post_types )
			: $post_types;

		return $fetcher->set_offset( $offset )
			->set_limit( $limit )
			->set_post_types( $post_types )
			->set_date_query(
				array(
					array(
						'after'     => '2 days ago',
						'inclusive' => true,
					),
				)
			)
			->set_order_by( 'post_date' )
			->set_ignore_ids( $this->get_ignore_ids( $post_types ) )
			->set_include_ids( $this->get_include_ids( $post_types ) );
	}

	/**
	 * @return array
	 */
	private function get_include_ids( $post_types ) {
		$include = apply_filters( 'wds_news_sitemap_include_post_ids', array(), $post_types );

		return empty( $include ) || ! is_array( $include )
			? array()
			: array_filter( array_map( 'intval', $include ) );
	}

	/**
	 * @return array|int|string
	 */
	private function get_post_title( $post ) {
		return ! empty( $post->post_title )
			? $post->post_title
			: get_post_field( 'post_title', $post->ID );
	}

	/**
	 * @return false|string|WP_Error
	 */
	private function get_post_url( $post ) {
		return get_permalink( $post->ID );
	}

	/**
	 * @return array
	 */
	private function get_custom_ignore_ids( $post_types ) {
		$ignored_ids = array();
		foreach ( $post_types as $post_type ) {
			$ignored_post_type_ids = apply_filters( "wds_news_sitemap_ignored_{$post_type}_ids", array() );
			$ignored_post_type_ids = ! empty( $ignored_post_type_ids ) && is_array( $ignored_post_type_ids )
				? $ignored_post_type_ids
				: array();

			$ignored_ids = array_merge(
				$ignored_ids,
				$ignored_post_type_ids
			);
		}

		return $ignored_ids;
	}

	/**
	 * @return array|mixed|null
	 */
	public function get_ignore_ids( $post_types ) {
		$options          = $this->get_sitemap_options();
		$ignored_post_ids = smartcrawl_get_array_value( $options, 'news-sitemap-excluded-post-ids' );
		$ignored_post_ids = empty( $ignored_post_ids ) ? array() : $ignored_post_ids;

		$ignored_post_ids = array_merge(
			$ignored_post_ids,
			$this->get_custom_ignore_ids( $post_types )
		);

		$excluded_term_ids = $this->get_excluded_term_ids( $options, $post_types );
		if ( empty( $excluded_term_ids ) ) {
			return $ignored_post_ids;
		}

		$terms = get_terms( array( 'include' => $excluded_term_ids ) );
		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return $ignored_post_ids;
		}

		$taxonomy_terms = array();
		foreach ( $terms as $term ) {
			$taxonomy_terms[ $term->taxonomy ][] = $term->term_id;
		}

		$tax_query = array( 'relation' => 'OR' );
		foreach ( $taxonomy_terms as $taxonomy => $term_ids ) {
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $term_ids,
			);
		}

		$post_ids         = get_posts(
			array(
				'post_type'      => $post_types,
				'fields'         => 'ids',
				'posts_per_page' => - 1,
				'tax_query'      => $tax_query, // phpcs:ignore
			)
		);
		$ignored_post_ids = array_merge(
			$ignored_post_ids,
			empty( $post_ids ) ? array() : $post_ids
		);

		return array_unique( $ignored_post_ids );
	}

	/**
	 * @return array
	 */
	private function get_excluded_term_ids( $options, $post_types ) {
		$excluded_term_ids = array();
		foreach ( $post_types as $post_type ) {
			$post_type_excluded_term_ids = smartcrawl_get_array_value( $options, "news-sitemap-$post_type-excluded-term-ids" );
			$excluded_term_ids           = array_merge(
				$excluded_term_ids,
				empty( $post_type_excluded_term_ids ) || ! is_array( $post_type_excluded_term_ids )
					? array()
					: $post_type_excluded_term_ids
			);
		}

		return array_unique( $excluded_term_ids );
	}

	/**
	 * @return false|int
	 */
	private function get_post_timestamp( $post ) {
		return ! empty( $post->post_date )
			? strtotime( $post->post_date )
			: time();
	}

	/**
	 * @return string
	 */
	private function get_publication() {
		$options = $this->get_sitemap_options();

		return (string) smartcrawl_get_array_value( $options, 'news-publication' );
	}

	/**
	 * @return array|mixed
	 */
	public function get_supported_types() {
		$options             = $this->get_sitemap_options();
		$included_post_types = smartcrawl_get_array_value( $options, 'news-sitemap-included-post-types' );

		return empty( $included_post_types )
			? array()
			: $included_post_types;
	}

	/**
	 * @return string
	 */
	public function get_filter_prefix() {
		return 'wds-sitemap-news-posts';
	}

	/**
	 * @return array
	 */
	private function get_sitemap_options() {
		return Smartcrawl_Settings::get_component_options( Smartcrawl_Settings::COMP_SITEMAP );
	}

	/**
	 * @return string|void
	 */
	protected function get_index_item_url( $type, $sitemap_num ) {
		return home_url( "/news-$type-sitemap$sitemap_num.xml" );
	}
}
