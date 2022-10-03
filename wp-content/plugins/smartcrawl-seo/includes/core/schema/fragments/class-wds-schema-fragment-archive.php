<?php

class Smartcrawl_Schema_Fragment_Archive extends Smartcrawl_Schema_Fragment {
	private $type;
	private $url;
	private $utils;
	/**
	 * @var WP_Post[]
	 */
	private $wp_posts;
	private $title;
	private $description;

	public function __construct( $type, $url, $wp_posts, $title, $description ) {
		$this->type = $type;
		$this->url = $url;
		$this->wp_posts = $wp_posts;
		$this->title = $title;
		$this->description = $description;
		$this->utils = Smartcrawl_Schema_Utils::get();
	}

	protected function get_raw() {
		$publisher = new Smartcrawl_Schema_Fragment_Publisher( false );
		$publisher_id = $publisher->get_publisher_id();

		$schema = array(
			new Smartcrawl_Schema_Fragment_Header( $this->url, $this->title, $this->description ),
			new Smartcrawl_Schema_Fragment_Footer( $this->url, $this->title, $this->description ),
			$publisher,
			new Smartcrawl_Schema_Fragment_Website(),
			$this->get_collection_schema( $publisher_id, $this->wp_posts ),
		);

		$custom_schema_types = $this->utils->get_custom_schema_types();
		if ( $custom_schema_types ) {
			$schema = $this->utils->add_custom_schema_types(
				$schema,
				$custom_schema_types,
				$this->utils->get_webpage_id( $this->url )
			);
		}

		return $schema;
	}

	private function get_archive_main_entity_type() {
		$list_type = $this->utils->get_schema_option( 'schema_archive_main_entity_type' );

		return $list_type
			? $list_type
			: Smartcrawl_Schema_Type_Constants::TYPE_ITEM_LIST;
	}

	private function get_collection_schema( $publisher_id, $wp_posts ) {
		return array(
			"@type"      => $this->type,
			"@id"        => $this->utils->get_webpage_id( $this->url ),
			"isPartOf"   => array(
				"@id" => $this->utils->get_website_id(),
			),
			"publisher"  => array(
				"@id" => $publisher_id,
			),
			"url"        => $this->url,
			"mainEntity" => $this->get_main_entity( $wp_posts, $publisher_id ),
		);
	}

	/**
	 * @param $wp_posts WP_Post[]
	 * @param $publisher_id string
	 *
	 * @return array|bool
	 */
	private function get_main_entity( $wp_posts, $publisher_id ) {
		$list_type = $this->get_archive_main_entity_type();
		$is_type_item_list = $list_type === Smartcrawl_Schema_Type_Constants::TYPE_ITEM_LIST;
		$list_type_key = $is_type_item_list ? "itemListElement" : "blogPosts";
		$list_item_type = $is_type_item_list ? "ListItem" : "BlogPosting";

		$item_list = array();
		$position = 1;
		$wp_posts = empty( $wp_posts ) || ! is_array( $wp_posts ) ? array() : $wp_posts;

		foreach ( $wp_posts as $wp_post ) {
			$post = new Smartcrawl_Post( $wp_post );

			if ( $is_type_item_list ) {
				$item_list[] = array(
					"@type"    => $list_item_type,
					"position" => (string) $position,
					"url"      => $post->get_permalink(),
				);
			} else {
				$item_list[] = new Smartcrawl_Schema_Fragment_Post(
					$post,
					false,
					$publisher_id,
					false
				);
			}

			$position ++;
		}

		if ( $item_list ) {
			return array(
				"@type"        => $list_type,
				$list_type_key => $item_list,
			);
		}

		return false;
	}
}
