<?php

require_once get_template_directory() . '/core/tgm/class-tgm-plugin-activation.php'; 

add_action('tgmpa_register', 'gt3_register_required_plugins');
function gt3_register_required_plugins()
{

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $path =  get_template_directory();
    $plugins = array(
        array(
            'name'               => esc_html__('GT3 Wize Store Core Plugin', 'wizestore' ), // The plugin name.
            'slug'               => 'gt3-wize-store-core-plugin', // The plugin slug (typically the folder name).
            'source'             => $path. '/core/tgm/plugins/gt3-wize-store-core-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.1.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'          => esc_html__('WPBakery Visual Composer', 'wizestore' ), // The plugin name
            'slug'          => 'js_composer', // The plugin slug (typically the folder name)
            'source'            => $path . '/core/tgm/plugins/js_composer.zip', // The plugin source
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'version'           => '5.4.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwize a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'          => esc_html__('Revolution Slider', 'wizestore' ), // The plugin name
            'slug'          => 'revslider', // The plugin slug (typically the folder name)
            'source'            => $path . '/core/tgm/plugins/revslider.zip', // The plugin source
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'version'           => '5.4.6.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'               => esc_html__('Contact Form 7', 'wizestore' ),
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('oAuth Twitter Feed for Developers', 'wizestore' ),
            'slug'               => 'oauth-twitter-feed-for-developers',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Instagram Feed', 'wizestore' ),
            'slug'               => 'instagram-feed',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('Instagram Shop by Snapppt', 'wizestore' ),
            'slug'               => 'shop-feed-for-instagram-by-snapppt',
            'required'           => false,
        ),
        array(
            'name'         => esc_html__('GT3 Photo & Video Gallery', 'wizestore' ),
            'slug'         => 'gt3-photo-video-gallery',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('WooCommerce', 'wizestore' ),
            'slug'         => 'woocommerce',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('WooCommerce Grid / List toggle', 'wizestore' ),
            'slug'         => 'woocommerce-grid-list-toggle',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('YITH WooCommerce Wishlist', 'wizestore' ),
            'slug'         => 'yith-woocommerce-wishlist',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('YITH WooCommerce Quick View', 'wizestore' ),
            'slug'         => 'yith-woocommerce-quick-view',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('YITH WooCommerce Ajax Product Filter', 'wizestore' ),
            'slug'         => 'yith-woocommerce-ajax-navigation',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('YITH WooCommerce Popup', 'wizestore' ),
            'slug'         => 'yith-woocommerce-popup',
            'required'       => false,
        ),
        array(
            'name'         => esc_html__('Ajax Search Lite', 'wizestore' ),
            'slug'         => 'ajax-search-lite',
            'required'       => false,
        ),   
        array(
            'name'         => esc_html__('MailChimp', 'wizestore' ),
            'slug'         => 'mailchimp',
            'required'       => false,
        ),    
        array(
            'name'                  => 'Nextend Facebook Connect',
            'slug'                  => 'nextend-facebook-connect', 
            'required'       => false,
        ),
        array(
            'name'                  => 'Nextend Google Connect', 
            'slug'                  => 'nextend-google-connect',
            'required'       => false, 
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                       // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',  // Menu slug.
        'has_notices'  => true,                     // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                     // Automatically activate plugins after installation or not.
        'message'      => '',                       // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'wizestore' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'wizestore' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'wizestore' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'wizestore' ),
            'notice_can_install_required'     => esc_html__( 'This theme requires the following plugins: %1$s.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => esc_html__( 'This theme recommends the following plugins: %1$s.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => esc_html__( 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => esc_html__( 'The following required plugins are currently inactive: %1$s.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => esc_html__( 'The following recommended plugins are currently inactive: %1$s.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => esc_html__( 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => esc_html__( 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'wizestore' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => esc_html__( 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'wizestore' ), // %1$s = plugin name(s).
            'install_link'                    => esc_html__( 'Begin installing plugins', 'wizestore' ),
            'activate_link'                   => esc_html__( 'Begin activating plugins', 'wizestore' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'wizestore' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'wizestore' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'wizestore' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}