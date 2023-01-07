<?php

class Smartcrawl_Schema_Source_Post extends Smartcrawl_Schema_Property_Source {
	const ID = 'post_data';

	const POST_TITLE         = 'post_title';
	const POST_CONTENT       = 'post_content';
	const POST_EXCERPT       = 'post_excerpt';
	const POST_DATE          = 'post_date';
	const POST_DATE_GMT      = 'post_date_gmt';
	const POST_MODIFIED      = 'post_modified';
	const POST_MODIFIED_GMT  = 'post_modified_gmt';
	const POST_PERMALINK     = 'post_permalink';
	const POST_COMMENT_COUNT = 'post_comment_count';
	const THUMBNAIL          = 'post_thumbnail';
	const THUMBNAIL_URL      = 'post_thumbnail_url';

	/**
	 * @var
	 */
	private $post;
	/**
	 * @var
	 */
	private $post_field;

	/**
	 * @param $post
	 * @param $field
	 */
	public function __construct( $post, $field ) {
		parent::__construct();

		$this->post       = $post;
		$this->post_field = $field;
	}

	/**
	 * @return array|false|int|mixed|string|WP_Error|null
	 */
	public function get_value() {
		$post_permalink = get_permalink( $this->post );
		$value          = null;

		if ( self::THUMBNAIL === $this->post_field ) {
			$image_id = get_post_thumbnail_id( $this->post );
			$value    = $this->utils->get_media_item_image_schema(
				$image_id,
				$this->utils->url_to_id( $post_permalink, '#schema-article-image' )
			);
		} elseif ( self::THUMBNAIL_URL === $this->post_field ) {
			$image_id   = get_post_thumbnail_id( $this->post );
			$media_item = $this->utils->get_attachment_image_source( $image_id );

			if ( $media_item ) {
				$value = $media_item[0];
			}
		} elseif ( self::POST_PERMALINK === $this->post_field ) {
			$value = $post_permalink;
		} elseif ( self::POST_COMMENT_COUNT === $this->post_field ) {
			$comment_count = isset( $this->post->ID )
				? get_comment_count( $this->post->ID )
				: array();
			$value         = isset( $comment_count['approved'] )
				? $comment_count['approved']
				: 0;
		} else {
			$value = get_post_field( $this->post_field, $this->post );
		}

		return $value;
	}
}
