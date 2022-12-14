<?php
/**
 * Autolinks module settings
 *
 * @package Smartcrawl
 */

/**
 * Init WDS Autolinks Settings
 */
class Smartcrawl_Autolinks_Settings extends Smartcrawl_Settings_Admin {

	use Smartcrawl_Singleton;

	/**
	 * Validate submitted options
	 *
	 * @param array $input Raw input.
	 *
	 * @return array Validated input
	 */
	public function validate( $input ) {
		// Start with old values for all the options.
		$result = self::get_specific_options( $this->option_name );

		$save_woo = smartcrawl_get_array_value( $input, 'save_woo' );
		if ( $save_woo ) {
			$woo_input = smartcrawl_get_array_value( $input, 'woo-settings' );
			if ( $woo_input ) {
				$woo_data = new Smartcrawl_Woocommerce_Data();
				$woo_data->save_data( json_decode( $woo_input, true ) );

				return $result;
			}
		}

		$save_redirects = isset( $input['save_redirects'] ) && $input['save_redirects'];
		if ( $save_redirects ) {
			$result['redirect-attachments']             = ! empty( $input['redirect-attachments'] );
			$result['redirect-attachments-images_only'] = ! empty( $input['redirect-attachments-images_only'] );

			if ( isset( $input['redirections-code'] ) ) {
				$this->validate_and_save_redirection_options( $input );
			}

			return $result;
		}

		if ( ! empty( $input['save_robots'] ) ) {
			$this->validate_and_save_robots_options( $input );

			return $result;
		}

		$service = $this->get_site_service();

		if ( ! empty( $input['wds_autolinks-setup'] ) ) {
			$result['wds_autolinks-setup'] = true;
		}

		if ( $service->is_member() ) {
			// Booleans.
			$booleans = array(
				'comment',
				'onlysingle',
				'allowfeed',
				'casesens',
				'customkey_preventduplicatelink',
				'target_blank',
				'rel_nofollow',
				'allow_empty_tax',
				'excludeheading',
				'exclude_no_index',
				'exclude_image_captions',
				'disable_content_cache',
			);

			foreach ( $booleans as $bool ) {
				$result[ $bool ] = ! empty( $input[ $bool ] );
			}

			// Boolean Arrays.
			$post_type_names = array_keys( self::get_post_types() );
			foreach ( array_merge( $post_type_names, array( 'comment', 'product_cat' ) ) as $post_type ) {
				$result[ $post_type ] = (bool) smartcrawl_get_array_value( $input, $post_type );
			}
			foreach ( $post_type_names as $post_type ) {
				$result[ 'l' . $post_type ] = (bool) smartcrawl_get_array_value( $input, "l{$post_type}" );
			}
			foreach ( get_taxonomies() as $taxonomy ) {
				$tax                  = get_taxonomy( $taxonomy );
				$key                  = strtolower( $tax->labels->name );
				$result[ 'l' . $key ] = (bool) smartcrawl_get_array_value( $input, "l{$key}" );
			}

			// Numerics.
			$numeric = array(
				'cpt_char_limit',
				'tax_char_limit',
				'link_limit',
				'single_link_limit',
			);
			foreach ( $numeric as $num ) {
				if ( isset( $input[ $num ] ) ) {
					if ( is_numeric( $input[ $num ] ) ) {
						$result[ $num ] = (int) $input[ $num ];
					} elseif ( empty( $input[ $num ] ) ) {
						$result[ $num ] = '';
					} else {
						add_settings_error( $this->option_name, 'numeric-limits', __( 'Limit values must be numeric', 'wds' ) );
					}
				}
			}

			// Strings.
			$strings = array(
				'ignore',
				'ignorepost',
			);
			foreach ( $strings as $str ) {
				if ( isset( $input[ $str ] ) ) {
					$result[ $str ] = sanitize_text_field( $input[ $str ] );
				}
			}

			// Custom keywords, they need newlines.
			if ( isset( $input['customkey'] ) ) {
				$str                 = wp_check_invalid_utf8( $input['customkey'] );
				$str                 = wp_pre_kses_less_than( $str );
				$str                 = wp_strip_all_tags( $str );
				$result['customkey'] = $str;

				$found = false;
				while ( preg_match( '/%[a-f0-9]{2}/i', $str, $match ) ) {
					$str   = str_replace( $match[0], '', $str );
					$found = true;
				}
				if ( $found ) {
					$str = trim( preg_replace( '/ +/', ' ', $str ) );
				}
			}
		}

		return $result;
	}

	/**
	 * Process extra options
	 *
	 * @param array $input Raw input.
	 */
	private function validate_and_save_redirection_options( $input ) {
		$settings                      = Smartcrawl_Settings::get_specific_options( 'wds_settings_options' );
		$settings['redirections-code'] = (int) $input['redirections-code'];
		Smartcrawl_Settings::update_specific_options( 'wds_settings_options', $settings );
	}

	/**
	 * Validate and save robots options.
	 *
	 * @param array $input Input.
	 *
	 * @return void
	 */
	private function validate_and_save_robots_options( $input ) {
		$robots_options = Smartcrawl_Settings::get_specific_options( 'wds_robots_options' );

		$robots_options['sitemap_directive_disabled'] = ! empty( $input['sitemap_directive_disabled'] );
		$robots_options['custom_sitemap_url']         = esc_url_raw( $input['custom_sitemap_url'] );
		$robots_options['custom_directives']          = sanitize_textarea_field( $input['custom_directives'] );

		Smartcrawl_Settings::update_specific_options( 'wds_robots_options', $robots_options );
	}

	/**
	 * Gets site service instance.
	 *
	 * @return object
	 */
	private function get_site_service() {
		return Smartcrawl_Service::get( Smartcrawl_Service::SERVICE_SITE );
	}

	/**
	 * Static known public post types getter
	 *
	 * @return array A list of known post type *objects* keyed by name
	 */
	public static function get_post_types() {
		static $post_types;

		if ( empty( $post_types ) ) {
			$exclusions = array(
				'revision',
				'nav_menu_item',
				'attachment',
			);
			$raw        = get_post_types(
				array( 'public' => true ),
				'objects'
			);
			foreach ( $raw as $pt => $pto ) {
				if ( in_array( $pt, $exclusions, true ) ) {
					continue;
				}
				$post_types[ $pt ] = $pto;
			}
		}

		return is_array( $post_types )
			? $post_types
			: array();
	}

	/**
	 * Initializes the admin pane.
	 */
	public function init() {
		$this->option_name = 'wds_autolinks_options';
		$this->name        = Smartcrawl_Settings::COMP_AUTOLINKS;
		$this->slug        = Smartcrawl_Settings::TAB_AUTOLINKS;
		$this->action_url  = admin_url( 'options.php' );
		$this->page_title  = __( 'SmartCrawl Wizard: Advanced Tools', 'wds' );

		add_action( 'wp_ajax_wds-load_exclusion-post_data', array( $this, 'json_load_post' ) );
		add_action( 'wp_ajax_wds-load_exclusion_posts-posts_data-specific', array( $this, 'json_load_posts_specific' ) );
		add_action( 'wp_ajax_wds-load_exclusion_posts-posts_data-paged', array( $this, 'json_load_posts_paged' ) );
		add_action( 'admin_init', array( $this, 'reset_moz_api_credentials' ) );
		add_action( 'admin_init', array( $this, 'deactivate_components' ) );

		parent::init();
	}

	/**
	 * Get the title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Advanced Tools', 'wds' );
	}

	/**
	 * Resets Moz API creds.
	 *
	 * TODO: probably need to move this to the same location as save_moz_api_credentials
	 */
	public function reset_moz_api_credentials() {
		$post_data = $this->get_request_data();
		if ( isset( $post_data['reset-moz-credentials'] ) ) { // Just a presence flag.
			$options               = self::get_specific_options( 'wds_settings_options' );
			$options['access-id']  = '';
			$options['secret-key'] = '';
			self::update_specific_options( 'wds_settings_options', $options );

			wp_safe_redirect( esc_url_raw( add_query_arg( array() ) ) );
			die;
		}
	}

	/**
	 * Deactivate components.
	 *
	 * @return void
	 */
	public function deactivate_components() {
		$data = isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], $this->option_name . '-options' ) // phpcs:ignore
			? stripslashes_deep( $_POST )
			: array();

		$redirect_url = wp_get_referer();
		if ( isset( $data['deactivate-autolinks-component'] ) ) {
			Smartcrawl_Settings::deactivate_component( 'autolinks' );
			wp_safe_redirect( $redirect_url );
			die();
		}

		if ( isset( $data['deactivate-robots-component'] ) ) {
			Smartcrawl_Settings::deactivate_component( 'robots-txt' );
			wp_safe_redirect( $redirect_url );
			die();
		}
	}

	/**
	 * Loads Individual post data
	 *
	 * Outputs AJAX response
	 */
	public function json_load_post() {
		$post_data = $this->get_request_data();
		$result    = array(
			'id'    => 0,
			'title' => '',
			'type'  => '',
		);
		if ( ! current_user_can( 'edit_others_posts' ) || empty( $post_data ) ) {
			wp_send_json( $result );
		}

		$post_id = ! empty( $post_data['id'] ) && is_numeric( $post_data['id'] )
			? (int) $post_data['id']
			: false;
		if ( empty( $post_id ) ) {
			wp_send_json( $result );
		}

		$post = get_post( $post_id );
		if ( ! $post ) {
			wp_send_json( $result );
		}

		wp_send_json( $this->post_to_response_data( $post ) );
	}

	/**
	 * Makes the post response format uniform
	 *
	 * @param object $post WP_Post instance.
	 *
	 * @return array Post response hash
	 */
	private function post_to_response_data( $post ) {
		$result = array(
			'id'    => 0,
			'title' => '',
			'type'  => '',
			'date'  => '',
		);
		if ( empty( $post ) || empty( $post->ID ) ) {
			return $result;
		}
		static $date_format;

		if ( empty( $date_format ) ) {
			$date_format = get_option( 'date_format' );
		}

		$post_id         = $post->ID;
		$result['id']    = $post_id;
		$result['title'] = get_the_title( $post_id );
		$result['type']  = get_post_type( $post_id );
		$result['date']  = get_post_time( $date_format, false, $post_id );

		return $result;
	}

	/**
	 * Loads posts by specific IDs
	 *
	 * Outputs AJAX response
	 */
	public function json_load_posts_specific() {
		$post_data = $this->get_request_data();
		$result    = array(
			'meta'  => array(),
			'posts' => array(),
		);
		if ( ! current_user_can( 'edit_others_posts' ) || empty( $post_data ) ) {
			wp_send_json( $result );
		}

		$post_ids = ! empty( $post_data['posts'] ) && is_array( $post_data['posts'] )
			? array_values( array_filter( array_map( 'intval', $post_data['posts'] ) ) )
			: array();
		if ( empty( $post_ids ) ) {
			wp_send_json_success( $result );
		}

		$args = array(
			'post_status'         => 'publish',
			'posts_per_page'      => - 1,
			'post__in'            => $post_ids,
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => true,
			'post_type'           => 'any',
		);

		$query = new WP_Query( $args );

		$result['meta'] = array(
			'total' => $query->max_num_pages,
			'page'  => 1,
		);

		foreach ( $query->posts as $post ) {
			$result['posts'][] = $this->post_to_response_data( $post );
		}

		wp_send_json_success( $result );
	}

	/**
	 * Loads paged posts of certain type
	 *
	 * Outputs AJAX response
	 */
	public function json_load_posts_paged() {
		$request_data = isset( $_GET['_wds_nonce'] ) && wp_verify_nonce( $_GET['_wds_nonce'], 'wds-autolinks-nonce' ) ? $_GET : array(); // phpcs:ignore
		$result       = array(
			'meta'  => array(),
			'posts' => array(),
		);
		if ( ! current_user_can( 'edit_others_posts' ) || empty( $request_data ) ) {
			wp_send_json( $result );
		}
		$args = array(
			'post_status'         => 'publish',
			'posts_per_page'      => 10,
			'ignore_sticky_posts' => true,
		);
		$page = 1;
		if ( ! empty( $request_data['type'] ) && in_array( $request_data['type'], array_keys( self::get_post_types() ), true ) ) {
			$args['post_type'] = sanitize_key( $request_data['type'] );
		}
		if ( ! empty( $request_data['term'] ) ) {
			$args['s'] = sanitize_text_field( $request_data['term'] );
		}
		if ( ! empty( $request_data['page'] ) && is_numeric( $request_data['page'] ) ) {
			$args['paged'] = (int) $request_data['page'];
			$page          = $args['paged'];
		}

		$query = new WP_Query( $args );

		$result['meta'] = array(
			'total' => $query->max_num_pages,
			'page'  => $page,
		);

		foreach ( $query->posts as $post ) {
			$result['posts'][] = $this->post_to_response_data( $post );
		}

		wp_send_json( $result );
	}

	/**
	 * Add admin settings page
	 */
	public function options_page() {
		parent::options_page();
		$arguments = array();

		$arguments['linkto'] = $this->get_linkto_keys();
		$arguments['insert'] = $this->get_insert_keys();

		$arguments['active_tab'] = $this->get_active_tab( 'tab_automatic_linking' );

		wp_enqueue_script( Smartcrawl_Controller_Assets::AUTOLINKS_PAGE_JS );

		$arguments['already_exists']  = Smartcrawl_Controller_Robots::get()->file_exists();
		$arguments['rootdir_install'] = Smartcrawl_Controller_Robots::get()->is_rootdir_install();

		$this->render_page( 'advanced-tools/advanced-tools-settings', $arguments );
	}

	/**
	 * Default settings
	 */
	public function defaults() {
		$this->options = get_option( $this->option_name );

		if ( empty( $this->options['ignorepost'] ) ) {
			$this->options['ignorepost'] = '';
		}

		if ( empty( $this->options['ignore'] ) ) {
			$this->options['ignore'] = '';
		}

		if ( empty( $this->options['customkey'] ) ) {
			$this->options['customkey'] = '';
		}

		if ( empty( $this->options['cpt_char_limit'] ) ) {
			$this->options['cpt_char_limit'] = '';
		}

		if ( empty( $this->options['tax_char_limit'] ) ) {
			$this->options['tax_char_limit'] = '';
		}

		if ( ! isset( $this->options['link_limit'] ) ) {
			$this->options['link_limit'] = '';
		}

		if ( ! isset( $this->options['single_link_limit'] ) ) {
			$this->options['single_link_limit'] = '';
		}

		update_option( $this->option_name, $this->options );
	}

	/**
	 * Get the request data.
	 *
	 * @return array
	 */
	private function get_request_data() {
		return isset( $_POST['_wds_nonce'] ) && wp_verify_nonce( $_POST['_wds_nonce'], 'wds-autolinks-nonce' ) // phpcs:ignore
			? $_POST :
			array();
	}

	/**
	 * Get the insert options.
	 *
	 * @return array
	 */
	public function get_insert_options() {
		$options = Smartcrawl_Settings::get_component_options( self::COMP_AUTOLINKS );
		$result  = array();
		foreach ( $this->get_insert_keys() as $key => $label ) {
			$result[ $key ] = array(
				'label' => $label,
				'value' => ! empty( $options[ $key ] ),
			);
		}

		return $result;
	}

	/**
	 * Get the insert keys.
	 *
	 * @return array
	 */
	private function get_insert_keys() {
		// Add post types.
		foreach ( self::get_post_types() as $post_type => $pt ) {
			$key = strtolower( $pt->name );

			$insert[ $key ] = $pt->labels->name;
		}
		// Add comments.
		$insert['comment'] = __( 'Comments', 'wds' );

		// Add Woo Product category.
		if ( taxonomy_exists( 'product_cat' ) ) {
			$taxonomy = get_taxonomy( 'product_cat' );
			// Add comments.
			$insert['product_cat'] = empty( $taxonomy->label ) ? __( 'Product Categories', 'wds' ) : $taxonomy->label;
		}

		return $insert;
	}

	/**
	 * Get link to options.
	 *
	 * @return array
	 */
	public function get_linkto_options() {
		$options = Smartcrawl_Settings::get_component_options( self::COMP_AUTOLINKS );
		$result  = array();

		foreach ( $this->get_linkto_keys() as $key => $label ) {
			$result[ $key ] = array(
				'label' => $label,
				'value' => ! empty( $options[ $key ] ),
			);
		}

		return $result;
	}

	/**
	 * Get link to keys.
	 *
	 * @return array
	 */
	private function get_linkto_keys() {
		$post_types = array();
		foreach ( self::get_post_types() as $post_type => $pt ) {
			$key                      = strtolower( $pt->name );
			$post_types[ 'l' . $key ] = $pt->labels->name;
		}

		$taxonomies = array();
		foreach ( get_taxonomies( array( 'public' => true ) ) as $taxonomy ) {
			if ( ! in_array( $taxonomy, array( 'nav_menu', 'link_category', 'post_format' ), true ) ) {
				$tax = get_taxonomy( $taxonomy );
				$key = strtolower( $tax->labels->name );

				$taxonomies[ 'l' . $key ] = $tax->labels->name;
			}
		}

		return array_merge( $post_types, $taxonomies );
	}
}

