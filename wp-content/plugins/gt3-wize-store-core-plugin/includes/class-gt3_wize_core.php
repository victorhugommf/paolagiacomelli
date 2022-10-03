<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/gt3themes
 * @since      1.0.0
 *
 * @package    Gt3_wize_core
 * @subpackage Gt3_wize_core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gt3_wize_core
 * @subpackage Gt3_wize_core/includes
 * @author     GT3themes <GT3themes@gmail.com>
 */
class Gt3_wize_core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gt3_wize_core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'gt3_wize_core';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_CPT_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gt3_wize_core_Loader. Orchestrates the hooks of the plugin.
	 * - Gt3_wize_core_i18n. Defines internationalization functionality.
	 * - Gt3_wize_core_Admin. Defines all hooks for the admin area.
	 * - Gt3_wize_core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_wize_core-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_wize_core-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gt3_wize_core-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gt3_wize_core-public.php';

		//Load redux
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/class.redux-plugin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/init.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-extension-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-importer-config.php';
		//Load meta-box
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metabox-addon.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/post-types-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/team/team-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/practice-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/shortcodes/practice.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-adding-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/gt3_mega_menu/class-gt3_mega_menu.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3-woocommerce-adjacent-products.php';

		// Aq_Resizer
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/aq_resizer.php';

		$this->loader = new Gt3_wize_core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gt3_wize_core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gt3_wize_core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Gt3_wize_core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	/**
	 * Register all of the hooks related to the CPT functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_CPT_hooks(){
		$plugin_CPT = GT3PostTypesRegister::getInstance();
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'register' );
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'shortcodes' );

		/*$tours = new GT3TourRegister();*/
		$practice = new GT3PracticeRegister();
		/*$this->loader->add_filter( 'manage_edit-'.$tours->cpt.'_columns', $tours, 'gt3_tours_columns_settings',10,1);
        $this->loader->add_action( 'manage_'.$tours->cpt.'_posts_custom_column', $tours, 'gt3_tours_columns_content',10,2);

        $this->loader->add_filter( 'manage_edit-'.$tours->dest_taxonomy.'_columns', $tours, 'gt3_destination_columns_settings',10,1);
        $this->loader->add_filter( 'manage_'.$tours->dest_taxonomy.'_custom_column', $tours, 'gt3_destination_columns_content',10,3);

        $this->loader->add_action( 'add_meta_boxes', $tours, 'tours_price_box',1,1);
        $this->loader->add_action( 'save_post', $tours, 'tour_price_box_save',1,2);
        $this->loader->add_action( $tours->dest_taxonomy.'_add_form_fields', $tours, 'add_thumbnail_to_taxonomy',10,2);
        $this->loader->add_action( 'admin_footer', $tours, 'add_thumbnail_to_taxonomy_sctipt');
        $this->loader->add_action( 'created_'.$tours->dest_taxonomy, $tours, 'save_taxonomy_thumbnail',10,2);
        $this->loader->add_action( $tours->dest_taxonomy.'_edit_form_fields', $tours, 'update_taxonomy_thumbnail',10,2);
        $this->loader->add_action( 'edited_'.$tours->dest_taxonomy, $tours, 'updated_taxonomy_thumbnail',10,2);*/

        /*register practice single*/
        $this->loader->add_filter( 'single_template', $practice, 'registerSingleTemplate');
        /*register tour single*/
        //$this->loader->add_filter( 'single_template', $tours, 'registerSingleTemplate');
        /* register archive tour */
        //$this->loader->add_filter( 'archive_template', $tours, 'registerArchiveTemplate');

        /* search tour */
        /*$tour_search = new GT3TourSearchRegister();

        $this->loader->add_action( 'query_vars', $tour_search, 'sm_register_query_vars');

        $this->loader->add_action( 'pre_get_posts', $tour_search, 'sm_pre_get_posts',1,1);*/

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Gt3_wize_core_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gt3_wize_core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
