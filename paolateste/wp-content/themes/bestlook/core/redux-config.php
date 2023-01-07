<?php
 
    if ( !class_exists( 'Gt3_wize_core' ) ) {
        return;
    }

    $theme = wp_get_theme(); 
    $opt_name = 'wizestore';

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__('Theme Options', 'wizestore' ),
        'page_title'           => esc_html__('Theme Options', 'wizestore' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-admin-generic',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => false,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-admin-generic',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
    );


    Redux::setArgs( $opt_name, $args );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'wizestore' ),
        'id'               => 'general',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'responsive',
                'type'     => 'switch',
                'title'    => esc_html__( 'Responsive', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comments', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'preloader_background',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Background', 'wizestore' ),
                'subtitle' => esc_html__( 'Set Preloader Background', 'wizestore' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_item_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Item Color', 'wizestore' ),
                'subtitle' => esc_html__( 'Set Plreloader Item Color', 'wizestore' ),
                'default'  => '#000000',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_item_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Logo', 'wizestore' ),
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_full',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader Fullscreen', 'wizestore' ),
                'default'  => true,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'add_default_typography_sapcing',
                'type'     => 'switch',
                'title'    => esc_html__( 'Add Default Typography Spacings', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'gt3_yith_popup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Activate custom styling for YITH WooCommerce Popup Plugin', 'wizestore' ),
                'subtitle' => esc_html__( 'We recommend setting false if you are using the Premium version of this plugin.', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'gt3_ajax_search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Activate custom styling for Ajax Search Lite Plugin', 'wizestore' ),
                'subtitle' => esc_html__( 'We recommend setting false if you are using the Premium version of this plugin.', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom CSS', 'wizestore' ),
                'subtitle' => esc_html__( 'Paste your CSS code here.', 'wizestore' ),
                'mode'     => 'css',
                'theme'    => 'chrome',
                'default'  => ""
            ),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'wizestore' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'wizestore' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
            array(
                'id'       => 'header_custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'wizestore' ),
                'subtitle' => esc_html__( 'Code to be added inside HEAD tag', 'wizestore' ),
                'mode'     => 'html',
                'theme'    => 'chrome',
                'default'  => "<script type='text/javascript'>\njQuery(document).ready(function(){\n\n});\n</script>"
            ),
        ),
    ) );


    // HEADER
            if (function_exists('gt3_header_presets')) {
                $presets = gt3_header_presets();
                $header_preset_1 = $presets['header_preset_1'];
                $header_preset_2 = $presets['header_preset_2'];
                $header_preset_3 = $presets['header_preset_3'];
                $header_preset_4 = $presets['header_preset_4'];
            }  

            function gt3_getMenuList(){
                $menus = wp_get_nav_menus();
                $menu_list = array();
                
                foreach ($menus as $menu => $menu_obj) {
                    $menu_list[$menu_obj->slug] = $menu_obj->name;
                }
                return $menu_list;
            }      

            $options = array(
                array(
                    'id'   => 'gt3_header_builder_id',
                    'type' => 'gt3_header_builder',
                    'full_width' => true,
                    'options' => array(
                        'all_item' => array(
                            'title' => 'All Item', 
                            'layout' => 'all',
                            'content' => array(
                                'search' => array(
                                    'title' => 'Search', 
                                    'has_settings' => false,
                                ),
                                'login' => array(
                                    'title' => 'Login', 
                                    'has_settings' => false,
                                ),
                                'cart' => array(
                                    'title' => 'Cart', 
                                    'has_settings' => false,
                                ),
                                'burger_sidebar' => array(
                                    'title' => 'Burger Sidebar', 
                                    'has_settings' => true,
                                ),
                                'text1' => array(
                                    'title' => 'Text/HTML 1', 
                                    'has_settings' => true,
                                ),
                                'text2' => array(
                                    'title' => 'Text/HTML 2', 
                                    'has_settings' => true,
                                ),
                                
                                'text3' => array(
                                    'title' => 'Text/HTML 3', 
                                    'has_settings' => true,
                                ),
                                'text4' => array(
                                    'title' => 'Text/HTML 4', 
                                    'has_settings' => true,
                                ),
                                
                                'text5' => array(
                                    'title' => 'Text/HTML 5', 
                                    'has_settings' => true,
                                ),
                                'text6' => array(
                                    'title' => 'Text/HTML 6', 
                                    'has_settings' => true,
                                ),
                                'delimiter1' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter2' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter3' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter4' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter5' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter6' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                            ),
                        ),
                        'top_left' => array(
                            'title' => 'Top Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                            ),
                        ),
                        'top_center' => array(
                            'title' => 'Top Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(                                    
                            ),
                        ),
                        'top_right' => array(
                            'title' => 'Top Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                            ),
                        ),
                        'middle_left' => array(
                            'title' => 'Middle Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds clear-item',
                            'content' => array(
                                'logo' => array(
                                    'title' => 'Logo', 
                                    'has_settings' => true,
                                ),
                            ),
                        ),
                        'middle_center' => array(
                            'title' => 'Middle Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(

                            ),
                        ),
                        'middle_right' => array(
                            'title' => 'Middle Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                                'menu' => array(
                                    'title' => 'Menu', 
                                    'has_settings' => true,
                                ),
                            ),
                        ),
                        'bottom_left' => array(
                            'title' => 'Bottom Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds clear-item',
                            'content' => array(

                            ),
                        ),
                        'bottom_center' => array(
                            'title' => 'Bottom Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(

                            ),
                        ),
                        'bottom_right' => array(
                            'title' => 'Bottom Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(

                            ),
                        ),
                    ),
                    'default' => array(
                        'all_item' => array(
                            'title' => 'All Item', 
                            'layout' => 'all',
                            'content' => array(
                                'search' => array(
                                    'title' => 'Search', 
                                    'has_settings' => false,
                                ),
                                'login' => array(
                                    'title' => 'Login', 
                                    'has_settings' => false,
                                ),
                                'cart' => array(
                                    'title' => 'Cart', 
                                    'has_settings' => false,
                                ),
                                'burger_sidebar' => array(
                                    'title' => 'Burger Sidebar', 
                                    'has_settings' => true,
                                ),
                                'text1' => array(
                                    'title' => 'Text/HTML 1', 
                                    'has_settings' => true,
                                ),
                                'text2' => array(
                                    'title' => 'Text/HTML 2', 
                                    'has_settings' => true,
                                ),
                                
                                'text3' => array(
                                    'title' => 'Text/HTML 3', 
                                    'has_settings' => true,
                                ),
                                'text4' => array(
                                    'title' => 'Text/HTML 4', 
                                    'has_settings' => true,
                                ),
                                
                                'text5' => array(
                                    'title' => 'Text/HTML 5', 
                                    'has_settings' => true,
                                ),
                                'text6' => array(
                                    'title' => 'Text/HTML 6', 
                                    'has_settings' => true,
                                ),
                                'delimiter1' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter2' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter3' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter4' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter5' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                                'delimiter6' => array(
                                    'title' => '|', 
                                    'has_settings' => false,
                                ),
                            ),
                        ),
                        'top_left' => array(
                            'title' => 'Top Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                            ),
                        ),
                        'top_center' => array(
                            'title' => 'Top Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(                                    
                            ),
                        ),
                        'top_right' => array(
                            'title' => 'Top Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                            ),
                        ),
                        'middle_left' => array(
                            'title' => 'Middle Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds clear-item',
                            'content' => array(
                                'logo' => array(
                                    'title' => 'Logo', 
                                    'has_settings' => true,
                                ),
                            ),
                        ),
                        'middle_center' => array(
                            'title' => 'Middle Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(

                            ),
                        ),
                        'middle_right' => array(
                            'title' => 'Middle Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                                'menu' => array(
                                    'title' => 'Menu', 
                                    'has_settings' => true,
                                ),
                            ),
                        ),
                        'bottom_left' => array(
                            'title' => 'Bottom Left', 
                            'has_settings' => true,
                            'layout' => 'one-thirds clear-item',
                            'content' => array(

                            ),
                        ),
                        'bottom_center' => array(
                            'title' => 'Bottom Center', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(

                            ),
                        ),
                        'bottom_right' => array(
                            'title' => 'Bottom Right', 
                            'has_settings' => true,
                            'layout' => 'one-thirds',
                            'content' => array(
                            ),
                        ),
                    ),
                ),

                //HEADER TEMPLATES
                // MAIN HEADER SETTINGS
                array(
                    'id'       => 'header_templates-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Header Templates', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),

                array(
                    'id'         => 'opt-presets',
                    'type'       => 'image_select',
                    'presets'    => true,
                    'full_width' => true,
                    'title'      => __( 'Preset', 'wizestore' ),
                    'subtitle'   => __( 'This allows you to set default header layout.', 'wizestore' ),
                    'default'    => 0,
                    'options'    => array(
                        '1' => array(
                            'alt'     => 'Header 1',
                            'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_1.jpg',
                            'presets' => $header_preset_1
                        ),
                        '2' => array(
                            'alt'     => 'Header 2',
                            'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_2.jpg',
                            'presets' => $header_preset_2
                        ),
                        '3' => array(
                            'alt'     => 'Header 3',
                            'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_3.jpg',
                            'presets' => $header_preset_3
                        ),
                        '4' => array(
                            'alt'     => 'Header 4',
                            'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_4.jpg',
                            'presets' => $header_preset_4
                        ),
                    ),
                ),
                array(
                    'id'     => 'header_templates-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),



                // MAIN HEADER SETTINGS
                array(
                    'id'       => 'main_header_settings-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Header Main Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'header_full_width',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Full Width Header', 'wizestore' ),
                    'subtitle' => esc_html__( 'Set header content in full width layout', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'header_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Sticky Header', 'wizestore' ),
                    'default'  => true,
                ),
                array(
                    'id'       => 'header_sticky_appearance_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sticky Appearance Style', 'wizestore' ),
                    'options'  => array(
                        'classic' => esc_html__( 'Classic', 'wizestore' ),
                        'scroll_top' => esc_html__( 'Appearance only on scroll top', 'wizestore' ),
                    ),
                    'required' => array( 'header_sticky', '=', '1' ),
                    'default'  => 'classic'
                ),
                array(
                    'id'       => 'header_sticky_appearance_from_top',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sticky Header Appearance From Top of Page', 'wizestore' ),
                    'options'  => array(
                        'auto' => esc_html__( 'Auto', 'wizestore' ),
                        'custom' => esc_html__( 'Custom', 'wizestore' ),
                    ),
                    'required' => array( 'header_sticky', '=', '1' ),
                    'default'  => 'auto'
                ),
                array(
                    'id'             => 'header_sticky_appearance_number',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Set the distance from the top of the page', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 300,
                    ),
                    'required' => array( 'header_sticky_appearance_from_top', '=', 'custom' ),
                ),
                array(
                    'id'       => 'header_sticky_shadow',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Sticky Header Bottom Shadow', 'wizestore' ),
                    'default'  => true,
                    'required' => array( 'header_sticky', '=', '1' ),
                ),
                array(
                    'id'     => 'main_header_settings-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),



                // TOP LEFT SIDE SETTINGS
                array(
                    'id'       => 'top_left-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Top Left Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'top_left-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'left',
                ),
                array(
                    'id'     => 'top_left-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // TOP CENTER SIDE SETTINGS
                array(
                    'id'       => 'top_center-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Top Center Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'top_center-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'center',
                ),
                array(
                    'id'     => 'top_center-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // TOP RIGHT SIDE SETTINGS
                array(
                    'id'       => 'top_right-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Top Right Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'top_right-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'right',
                ),
                array(
                    'id'     => 'top_right-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // MIDDLE LEFT SIDE SETTINGS
                array(
                    'id'       => 'middle_left-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Middle Left Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'middle_left-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'left',
                ),
                array(
                    'id'     => 'middle_left-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // MIDDLE CENTER SIDE SETTINGS
                array(
                    'id'       => 'middle_center-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Middle Center Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'middle_center-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'center',
                ),
                array(
                    'id'     => 'middle_center-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // MIDDLE RIGHT SIDE SETTINGS
                array(
                    'id'       => 'middle_right-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Top Middle Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'middle_right-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'right',
                ),
                array(
                    'id'     => 'middle_right-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),


                // BOTTOM LEFT SIDE SETTINGS
                array(
                    'id'       => 'bottom_left-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Bottom Left Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'bottom_left-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'left',
                ),
                array(
                    'id'     => 'bottom_left-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // BOTTOM CENTER SIDE SETTINGS
                array(
                    'id'       => 'bottom_center-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Bottom Center Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'bottom_center-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'center',
                ),
                array(
                    'id'     => 'bottom_center-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // BOTTOM RIGHT SIDE SETTINGS
                array(
                    'id'       => 'bottom_right-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Bottom Right Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'bottom_right-align',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Item Align', 'wizestore' ),
                    'options'  => array(
                        'left' => __( 'Left', 'wizestore' ),
                        'center' => __( 'Center', 'wizestore' ),
                        'right' => __( 'Right', 'wizestore' ),
                    ),
                    'default'  => 'right',
                ),
                array(
                    'id'     => 'bottom_right-end',
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),





                //LOGO SETTINGS
                array(
                    'id'       => 'logo-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Logo Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'header_logo',
                    'type'     => 'media',
                    'title'    => __( 'Header Logo', 'wizestore' ),
                ),
                array(
                    'id'       => 'logo_height_custom',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Enable Logo Height', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'             => 'logo_height',
                    'type'           => 'dimensions',
                    'units'          => false,    
                    'units_extended' => false,
                    'title'          => __( 'Set Logo Height' , 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 100,
                    ),
                    'required' => array( 'logo_height_custom', '=', '1' ),
                ),
                array(
                    'id'       => 'logo_max_height',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Don\'t limit maximum height', 'wizestore' ),
                    'default'  => false,
                    'required' => array( 'logo_height_custom', '=', '1' ),
                ),
                array(
                    'id'             => 'sticky_logo_height',
                    'type'           => 'dimensions',
                    'units'          => false,    
                    'units_extended' => false,
                    'title'          => __( 'Set Sticky Logo Height' , 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => '',
                    ),
                    'required' => array(
                        array( 'logo_height_custom', '=', '1' ),
                        array( 'logo_max_height', '=', '1' ),
                    ),
                ),
                array(
                    'id'       => 'logo_sticky',
                    'type'     => 'media',
                    'title'    => __( 'Sticky Logo', 'wizestore' ),
                ),
                array(
                    'id'       => 'logo_mobile',
                    'type'     => 'media',
                    'title'    => __( 'Mobile Logo', 'wizestore' ),
                ),
                array(
                    'id'       => 'logo_limit_on_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Limit Logo on Mobile', 'wizestore' ),
                    'default'  => true,
                ),
                array(
                    'id'     => 'logo-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // MENU
                array(
                    'id'       => 'menu-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Menu Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'menu_select',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Menu', 'wizestore' ),
                    'options'  => gt3_getMenuList(),
                    'default'  => 'left',
                ),
                array(
                    'id'       => 'menu_ative_top_line',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Enable Active Menu Item Marker', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'sub_menu_background',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Sub Menu Background', 'wizestore' ),
                    'subtitle' => __( 'Set sub menu background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '1',
                        'rgba'  => 'rgba(255,255,255,1)'
                    ),
                    'mode'     => 'background',
                ),
                array(
                    'id'       => 'sub_menu_color',
                    'type'     => 'color',
                    'title'    => __( 'Sub Menu Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set sub menu header text color', 'wizestore' ),
                    'default'  => '#000000',
                    'transparent' => false,
                ),
                array(
                    'id'     => 'menu-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                // BURGER SIDEBAR
                array(
                    'id'       => 'burger_sidebar-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Burger Sidebar Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'burger_sidebar_select',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Sidebar', 'wizestore' ),
                    'data'     => 'sidebars',
                ),
                array(
                    'id'     => 'burger_sidebar-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),


                //TOP SIDE
                array(
                    'id'       => 'side_top-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Top Header Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'side_top_background',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#f5f5f5',
                        'alpha' => '1',
                        'rgba'  => 'rgba(245,245,245,1)'
                    ),
                    'mode'     => 'background',
                ),
                array(
                    'id'       => 'side_top_color',
                    'type'     => 'color',
                    'title'    => __( 'Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#94958d',
                    'transparent' => false,
                ),
                array(
                    'id'             => 'side_top_height',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 40,
                    )
                ),
                array(
                    'id'       => 'side_top_border',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Set Bottom Border', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'side_top_border_color',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Border Color', 'wizestore' ),
                    'subtitle' => __( 'Set border color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '.15',
                        'rgba'  => 'rgba(255,255,255,0.15)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_top_border', '=', '1' ),
                ),
                array(
                    'id'       => 'side_top_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Sticky Header?', 'wizestore' ),
                    'default'  => false,
                    'required' => array( 'header_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_top_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Sticky Header Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#f5f5f5',
                        'alpha' => '1',
                        'rgba'  => 'rgba(245,245,245,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_top_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_top_color_sticky',
                    'type'     => 'color',
                    'title'    => __( 'Sticky Header Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#94958d',
                    'transparent' => false,
                    'required' => array( 'side_top_sticky', '=', '1' ),
                ),
                array(
                    'id'             => 'side_top_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Sticky Header Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 38,
                    ),
                    'required' => array( 'side_top_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_top_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Mobile Header?', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'     => 'side_top-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),


                // Middle SIDE
                array(
                    'id'       => 'side_middle-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Middle Header Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'side_middle_background',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '1',
                        'rgba'  => 'rgba(255,255,255,1)'
                    ),
                    'mode'     => 'background',
                ),
                array(
                    'id'       => 'side_middle_color',
                    'type'     => 'color',
                    'title'    => __( 'Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#000000',
                    'transparent' => false,
                ),
                array(
                    'id'             => 'side_middle_height',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 130,
                    )
                ),
                array(
                    'id'       => 'side_middle_border',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Set Bottom Border', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'side_middle_border_color',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Border Color', 'wizestore' ),
                    'subtitle' => __( 'Set border color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '.15',
                        'rgba'  => 'rgba(255,255,255,0.15)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_middle_border', '=', '1' ),
                ),
                array(
                    'id'       => 'side_middle_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Sticky Header?', 'wizestore' ),
                    'default'  => true,
                    'required' => array( 'header_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_middle_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Sticky Header Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '1',
                        'rgba'  => 'rgba(255,255,255,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_middle_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_middle_color_sticky',
                    'type'     => 'color',
                    'title'    => __( 'Sticky Header Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#000000',
                    'transparent' => false,
                    'required' => array( 'side_middle_sticky', '=', '1' ),
                ),
                array(
                    'id'             => 'side_middle_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Sticky Header Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 90,
                    ),
                    'required' => array( 'side_middle_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_middle_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Mobile Header?', 'wizestore' ),
                    'default'  => true,
                ),
                array(
                    'id'     => 'side_middle-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),


                // Bottom SIDE
                array(
                    'id'       => 'side_bottom-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Bottom Header Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'       => 'side_bottom_background',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '1',
                        'rgba'  => 'rgba(255,255,255,1)'
                    ),
                    'mode'     => 'background',
                ),
                array(
                    'id'       => 'side_bottom_color',
                    'type'     => 'color',
                    'title'    => __( 'Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#000000',
                    'transparent' => false,
                ),
                array(
                    'id'             => 'side_bottom_height',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 38,
                    )
                ),
                array(
                    'id'       => 'side_bottom_border',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Set Bottom Border', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'side_bottom_border_color',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Border Color', 'wizestore' ),
                    'subtitle' => __( 'Set border color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '.15',
                        'rgba'  => 'rgba(255,255,255,0.15)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_bottom_border', '=', '1' ),
                ),
                array(
                    'id'       => 'side_bottom_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Sticky Header?', 'wizestore' ),
                    'default'  => false,
                    'required' => array( 'header_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_bottom_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => __( 'Sticky Header Background', 'wizestore' ),
                    'subtitle' => __( 'Set background color', 'wizestore' ),
                    'default'  => array(
                        'color' => '#ffffff',
                        'alpha' => '1',
                        'rgba'  => 'rgba(255,255,255,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'side_bottom_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_bottom_color_sticky',
                    'type'     => 'color',
                    'title'    => __( 'Sticky Header Text Color', 'wizestore' ),
                    'subtitle' => __( 'Set text color', 'wizestore' ),
                    'default'  => '#000000',
                    'transparent' => false,
                    'required' => array( 'side_bottom_sticky', '=', '1' ),
                ),
                array(
                    'id'             => 'side_bottom_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false, 
                    'units_extended' => false,
                    'title'          => __( 'Sticky Header Height', 'wizestore' ),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 38,
                    ),
                    'required' => array( 'side_bottom_sticky', '=', '1' ),
                ),
                array(
                    'id'       => 'side_bottom_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Show Section in Mobile Header?', 'wizestore' ),
                    'default'  => false,
                ),
                array(
                    'id'     => 'side_bottom-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),


                //TEXT SETTINGS
                array(
                    'id'       => 'text1-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 1 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text1_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text1-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                //2
                array(
                    'id'       => 'text2-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 2 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text2_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text2-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                //3
                array(
                    'id'       => 'text3-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 3 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text3_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text3-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                //4
                array(
                    'id'       => 'text4-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 4 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text4_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text4-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                //5
                array(
                    'id'       => 'text5-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 5 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text5_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text5-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),

                //6
                array(
                    'id'       => 'text6-start',
                    'type'     => 'gt3_section',
                    'title'    => __( 'Text / HTML 6 Settings', 'wizestore' ),
                    'indent'   => false,
                    'section_role' => 'start'
                ),
                array(
                    'id'      => 'text6_editor',
                    'type'    => 'editor',
                    'title'   => __( 'Text Editor', 'wizestore' ),
                    'default' => '',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 2,
                        'teeny'         => false,
                        'quicktags'     => true,
                    ),
                ),
                array(
                    'id'     => 'text6-end', 
                    'type'   => 'gt3_section',
                    'indent' => false, 
                    'section_role' => 'end'
                ),
            );

    Redux::setSection( $opt_name, array(
        'id'     => 'gt3_header_builder_section',
        'title'  =>  __( 'GT3 Header Builder', 'wizestore' ),
        'desc'   => __( 'This is GT3 Header Builder', 'wizestore' ),
        'icon'   => 'el el-screen',
        'fields' => $options
    ) );
    // END HEADER


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Title', 'wizestore' ),
        'id'               => 'page_title',
        'icon'             => 'el-icon-screen',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'page_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Page Title', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Blog Post Title', 'wizestore' ),
                'default'  => false,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Page Title Settings', 'wizestore' ),
                'indent'   => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title_breadcrumbs_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Breadcrumbs', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page_title_vert_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Vertical Align', 'wizestore' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'wizestore' ),
                    'middle' => esc_html__( 'Middle', 'wizestore' ),
                    'bottom' => esc_html__( 'Bottom', 'wizestore' )
                ),
                'default'  => 'middle'
            ),
            array(
                'id'       => 'page_title_horiz_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Title Text Align?', 'wizestore' ),
                'options'  => array(
                    'left' =>  esc_html__( 'Left', 'wizestore' ),
                    'center' => esc_html__( 'Center', 'wizestore' ),
                    'right' => esc_html__( 'Right', 'wizestore' )
                ),
                'default'  => 'center'
            ),
            array(
                'id'       => 'page_title_font_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Font Color', 'wizestore' ),
                'default'  => '#000000',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Background Color', 'wizestore' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Page Title Background Image', 'wizestore' ),
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Page Title Background Image', 'wizestore' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                )
            ),
            array(
                'id'             => 'page_title_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Page Title Height', 'wizestore' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 180,
                )
            ),
            array(
                'id'       => 'page_title_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title Top Border', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page_title_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Page Title Top Border Color', 'wizestore' ),
                'default'  => array(
                    'color' => '#eff0ed',
                    'alpha' => '1',
                    'rgba'  => 'rgba(239,240,237,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'page_title_top_border', '=', '1' ),
                ), 
            ),
            array(
                'id'       => 'page_title_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title Bottom Border', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page_title_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Page Title Bottom Border Color', 'wizestore' ),
                'default'  => array(
                    'color' => '#eff0ed',
                    'alpha' => '1',
                    'rgba'  => 'rgba(239,240,237,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'page_title_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'       => 'page_title_bottom_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => true,
                'top'   => false,
                'left'   => false,
                'right'   => false,
                'title'    => esc_html__( 'Page Title Bottom Margin', 'wizestore' ),
                'default'  => array(
                    'margin-bottom' => '0px',                
                    )
            ),
            array(
                'id'     => 'page_title-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            
        )
    ) );

    // -> START Footer Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Footer', 'wizestore' ),
        'id'               => 'footer-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-screen',
        'fields'           => array(
            array(
                'id'       => 'footer_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Footer', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'footer_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Background Color', 'wizestore' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Text color', 'wizestore' ),
                'default'  => '#94958d',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Heading color', 'wizestore' ),
                'default'  => '#000000',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Footer Background Image', 'wizestore' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer Content', 'wizestore' ),
        'id'               => 'footer_content',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Footer', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Settings', 'wizestore' ),
                'indent'   => true,
                'required' => array( 'footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'footer_column',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column', 'wizestore' ),
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                ),
                'default'  => '5'
            ),
            array(
                'id'       => 'footer_column2',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'wizestore' ),
                'options'  => array(
                    '6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '25% / 75%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
                ),
                'default'  => '6-6',
                'required' => array( 'footer_column', '=', '2' ),
            ),
            array(
                'id'       => 'footer_column3',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'wizestore' ),
                'options'  => array(
                    '4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
                ),
                'default'  => '4-4-4',
                'required' => array( 'footer_column', '=', '3' ),
            ),
            array(
                'id'       => 'footer_column5',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'wizestore' ),
                'options'  => array(
                    '2-3-2-2-3' => '16% / 25% / 16% / 16% / 25%',
                    '3-2-2-2-3' => '25% / 16% / 16% / 16% / 25%',
                    '3-2-3-2-2' => '25% / 16% / 26% / 16% / 16%',
                    '3-2-3-3-2' => '25% / 16% / 16% / 25% / 16%',
                ),
                'default'  => '2-3-2-2-3',
                'required' => array( 'footer_column', '=', '5' ),
            ),
            array(
                'id'       => 'footer_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Title Text Align', 'wizestore' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'wizestore' ),
                    'center' => esc_html__( 'Center', 'wizestore' ),
                    'right' => esc_html__( 'Right', 'wizestore' ),
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'footer_spacing',
                'type'     => 'spacing',
                'output'   => array( '.gt3-footer' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Footer Padding (px)', 'wizestore' ),
                'default'  => array(
                    'padding-top'    => '70px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '40px',
                    'padding-left'   => '0px'
                )
            ),
            array(
                'id'     => 'footer-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'footer_switch', '=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Copyright', 'wizestore' ),
        'id'               => 'copyright',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'copyright_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Copyright', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'      => 'copyright_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Copyright Editor', 'wizestore' ),
                'default' => '',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Title Text Align', 'wizestore' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'wizestore' ),
                    'center' => esc_html__( 'Center', 'wizestore' ),
                    'right' => esc_html__( 'Right', 'wizestore' ),
                ),
                'default'  => 'left',
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Copyright Padding (px)', 'wizestore' ),
                'default'  => array(
                    'padding-top'    => '14px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '14px',
                    'padding-left'   => '0px'
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Background Color', 'wizestore' ),
                'default'  => '#ffffff',
                'transparent' => true,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Text Color', 'wizestore' ),
                'default'  => '#94958d',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Copyright Top Border', 'wizestore' ),
                'default'  => true,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Copyright Border Color', 'wizestore' ),
                'default'  => array(
                    'color' => '#2b4764',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,71,100,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'copyright_top_border', '=', '1' ),
                    array( 'copyright_switch', '=', '1' )
                ), 
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Pre footer area', 'wizestore' ),
        'id'               => 'pre_footer',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'pre_footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Pre Footer Area', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'      => 'pre_footer_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Pre Footer Editor', 'wizestore' ),
                'default' => '',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Pre Footer Title Text Align', 'wizestore' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'wizestore' ),
                    'center' => esc_html__( 'Center', 'wizestore' ),
                    'right' => esc_html__( 'Right', 'wizestore' ),
                ),
                'default'  => 'center',
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Pre Footer Area Padding (px)', 'wizestore' ),
                'default'  => array(
                    'padding-top'    => '20px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '20px',
                    'padding-left'   => '0px'
                ),
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Pre Footer Border', 'wizestore' ),
                'default'  => true,
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Pre Footer Border Color', 'wizestore' ),
                'default'  => array(
                    'color' => '#e0e1dc',
                    'alpha' => '1',
                    'rgba'  => 'rgba(224,225,220,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'pre_footer_bottom_border', '=', '1' ),
                    array( 'pre_footer_switch', '=', '1' )
                ), 
            ),
        )
    ));

    // -> START Blog Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Blog', 'wizestore' ),
        'id'               => 'blog-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
        'fields'           => array(
            array(
                'id'       => 'related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'author_box',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Box on Single Post', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'post_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comments', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'post_pingbacks',
                'type'     => 'switch',
                'title'    => esc_html__( 'Trackbacks and Pingbacks', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_post_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Likes on Posts', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_post_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share on Posts', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_post_listing_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'wizestore' ),
                'default'  => false,
            ),
        )
    ) );

    // -> START Layout Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebars', 'wizestore' ),
        'id'               => 'layout_options',
        'customizer_width' => '400px',
        'icon' => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'page_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Sidebar Layout', 'wizestore' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'page_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar', 'wizestore' ),
                'data'     => 'sidebars',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Single Sidebar Layout', 'wizestore' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'blog_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar', 'wizestore' ),
                'data'     => 'sidebars',
                'required' => array( 'blog_single_sidebar_layout', '!=', 'none' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebar Generator', 'wizestore' ),
        'id'               => 'sidebars_generator_section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'=>'sidebars', 
                'type' => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__('Add Sidebar', 'wizestore' ),
                'title' => esc_html__('Sidebar Generator', 'wizestore' ),
                'default' => array('Main Sidebar','Menu Sidebar','Top Rated Products','Featured Products','Hot Sale','Shop Sidebar','Shop Sidebar Top'),
            ),
        )
    ) );   


    // -> START Styling Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Color Options', 'wizestore' ),
        'id'               => 'color_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-brush'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Colors', 'wizestore' ),
        'id'               => 'color_options_color',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'title'    => esc_html__( 'Enable Dark Theme', 'wizestore' ),
                'id'       => 'dark_theme',
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'        => 'theme-custom-color',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color 1', 'wizestore' ),
                'transparent' => false,
                'default'   => '#000000',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'theme-custom-color2',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color 2', 'wizestore' ),
                'transparent' => false,
                'default'   => '#b1ba85',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'body-background-color',
                'type'      => 'color',
                'title'     => esc_html__('Body Background Color', 'wizestore' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
                ),
        )
    ));



    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Typography', 'wizestore' ),
        'id'               => 'typography_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-font',
        'fields'           => array(
            array(
                'id'          => 'menu-font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Menu Font', 'wizestore' ),
                'google' => true,
                'font-style'    => true,
                'color' => false,
                'line-height' => true,
                'font-size' => true,
                'font-backup' => false,
                'text-align' => false,
                'all_styles'  => true,
                'default'     => array(
                    'font-style'  => '500',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '13px',
                    'line-height' => '19px'
                ),
            ),

            array(
                'id' => 'main-font',
                'type' => 'typography',
                'title' => esc_html__('Main Font', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'all_styles'  => true,
                'default' => array(
                    'font-size' => '14px',
                    'line-height' => '24px',
                    'color' => '#6e6f69',
                    'google' => true,
                    'font-family' => 'Poppins',
                    'font-weight' => '300',
                ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Headers Font', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'color' => '#000000',
                    'google' => true,
                    'font-family' => 'Prata',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'h1-font',
                'type' => 'typography',
                'title' => esc_html__('H1', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '36px',
                    'line-height' => '43px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h2-font',
                'type' => 'typography',
                'title' => esc_html__('H2', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '30px',
                    'line-height' => '40px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h3-font',
                'type' => 'typography',
                'title' => esc_html__('H3', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '24px',
                    'line-height' => '36px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h4-font',
                'type' => 'typography',
                'title' => esc_html__('H4', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '18px',
                    'line-height' => '30px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h5-font',
                'type' => 'typography',
                'title' => esc_html__('H5', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '14px',
                    'line-height' => '24px',
                    'google' => true,
                    'font-family' => 'Poppins',
                    'font-weight' => '500'
                ),
            ),
            array(
                'id' => 'h6-font',
                'type' => 'typography',
                'title' => esc_html__('H6', 'wizestore' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '12px',
                    'line-height' => '18px',
                    'google' => true,
                    'font-family' => 'Poppins',
                    'font-weight' => '500'
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Contact Widget', 'wizestore' ),
        'id'               => 'contact_widget_options',
        'customizer_width' => '400px',
        'icon' => 'el el-envelope',
        'fields'           => array(
            array(
                'title'    => esc_html__( 'Display on All Pages', 'wizestore' ),
                'id'       => 'show_contact_widget',
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id' => 'title_contact_widget',
                'type' => 'text',
                'title' => esc_html__('Label Text', 'wizestore' ),
            ),
            array(
                'id'       => 'label_contact_icon',
                'type'     => 'media',
                'title'    => esc_html__( 'Label\'s Image', 'wizestore' ),
            ),
            array(
                'id'       => 'label_contact_widget_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Label Color', 'wizestore' ),
                'subtitle' => esc_html__( 'Set label\'s color of Contact Widget', 'wizestore' ),
                'default'  => array(
                    'color' => '#2d628f',
                    'alpha' => '1',
                    'rgba'  => 'rgba(45,98,143,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id' => 'shortcode_contact_widget',
                'type' => 'text',
                'title' => esc_html__('Contact Form 7 Shortcode', 'wizestore' ),
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */

    // -> START Layout Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Shop', 'wizestore' ),
        'id'               => 'woocommerce_layout_options',
        'customizer_width' => '400px',
        'icon' => 'el el-shopping-cart',
        'fields'           => array(
            
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Products Page', 'wizestore' ),
        'id'               => 'products_page_settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'products_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Products Layout', 'wizestore' ),
                'options'  => array(
                    'container' => esc_html__( 'Container', 'wizestore' ),
                    'full_width' => esc_html__( 'Full Width', 'wizestore' ),
                    'masonry' => esc_html__( 'Full Width Masonry', 'wizestore' ),
                ),
                'default'  => 'container'
            ),
            array(
                'id'       => 'products_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Products Page Sidebar Layout', 'wizestore' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'products_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Products Page Sidebar', 'wizestore' ),
                'data'     => 'sidebars',
                'required' => array( 'products_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'products_sidebar_top',
                'type'     => 'select',
                'title'    => esc_html__( 'Products Page Top Sidebar', 'wizestore' ),
                'data'     => 'sidebars',
            ),
            array(
                'id' => 'products_per_page',
                'type' => 'text',
                'title' => esc_html__('Products Per Page', 'wizestore' ),
                'default' => '9'
            ),
            array(
                'id'       => 'woocommerce_def_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Default Number of Columns', 'wizestore' ),
                'desc'  => esc_html__( 'Select the number of columns in products page.', 'wizestore' ),
                'options'  => array(
                    '2' => esc_html__( '2', 'wizestore' ),
                    '3' => esc_html__( '3', 'wizestore' ),
                    '4' => esc_html__( '4', 'wizestore' ),
                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'woocommerce_out_of_stock',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display out of stock item page', 'wizestore' ),
                'default'  => false,
            ),
        )
    ) ); 
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Single Product Page', 'wizestore' ),
        'id'               => 'product_page_settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'product_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Thumbnails Layout', 'wizestore' ),
                'options'  => array(
                    'horizontal' => esc_html__( 'Thumbnails Bottom', 'wizestore' ),
                    'vertical' => esc_html__( 'Thumbnails Left', 'wizestore' ),
                    'thumb_grid' => esc_html__( 'Thumbnails Grid', 'wizestore' ),
                ),
                'default'  => 'thumb_bottom'
            ),
            array(
                'id'       => 'product_container',
                'type'     => 'select',
                'title'    => esc_html__( 'Product Page Layout', 'wizestore' ),
                'options'  => array(
                    'container' => esc_html__( 'Container', 'wizestore' ),
                    'full_width' => esc_html__( 'Full Width', 'wizestore' ),
                ),
                'default'  => 'container'
            ),
            array(
                'id'       => 'sticky_thumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Thumbnails', 'wizestore' ),
                'default'  => true,
            ),
            array(
                'id'       => 'product_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Single Product Page Sidebar Layout', 'wizestore' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none' 
            ),
            array(
                'id'       => 'product_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Single Product Page Sidebar', 'wizestore' ),
                'data'     => 'sidebars',
                'required' => array( 'product_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'shop_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Single Product Title Area', 'wizestore' ),
                'default'  => false,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'shop_size_guide',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Size Guide', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'       => 'size_guide_icon',
                'type'     => 'media',
                'title'    => esc_html__( 'Size guide icon Image', 'wizestore' ),
                'required' => array( 'shop_size_guide', '=', true ),
            ),
            array(
                'id'       => 'size_guide',
                'type'     => 'media',
                'title'    => esc_html__( 'Size guide Popup Image', 'wizestore' ),
                'required' => array( 'shop_size_guide', '=', true ),
            ),
            array(
                'id'       => 'next_prev_product',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Next and Previous products.', 'wizestore' ),
                'default'  => false,
            ),
            array(
                'id'        => 'share_social',
                'type'      => 'switch',
                'title'     => esc_html__( 'Show Social links', 'wizestore' ),
                'default'   => false,
            ),
            array(
                'id'        =>'share_social_select', 
                'type'      => 'select',
                'multi'     => true,
                'title'     => esc_html__('Select Social links', 'wizestore' ),
                'options'   => array(
                    'facebook'      => esc_html__( 'Facebook', 'wizestore' ),
                    'twitter'       => esc_html__( 'Twitter', 'wizestore' ),
                    'pinterest'     => esc_html__( 'Pinterest', 'wizestore' ),
                    'google'        => esc_html__( 'Google plus', 'wizestore' ),
                    'tumblr'        => esc_html__( 'Tumblr', 'wizestore' ),
                    'mail'          => esc_html__( 'Mail', 'wizestore' ),
                    'reddit'        => esc_html__( 'Reddit', 'wizestore' ),
                    //'linkedin'      => esc_html__( 'LinkedIn', 'wizestore' ),
                    //'vk'            => esc_html__( 'VK', 'wizestore' ),
                ),
                'required'  => array( 'share_social', '=', true ),
            ),
            array(
                'id'        => 'share_social-facebook',
                'type'      => 'text',
                'title'     => esc_html__('Title for Facebook icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'facebook' ),
            ),
            array(
                'id'        => 'share_social-twitter',
                'type'      => 'text',
                'title'     => esc_html__('Title for Twitter icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'twitter' ),
            ),
            array(
                'id'        => 'share_social-pinterest',
                'type'      => 'text',
                'title'     => esc_html__('Title for Pinterest icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'pinterest' ),
            ),
            array(
                'id'        => 'share_social-google',
                'type'      => 'text',
                'title'     => esc_html__('Title for Google plus icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'google' ),
            ),
            array(
                'id'        => 'share_social-linkedin',
                'type'      => 'text',
                'title'     => esc_html__('Title for LinkedIn icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'linkedin' ),
            ),
            array(
                'id'        => 'share_social-vk',
                'type'      => 'text',
                'title'     => esc_html__('Title for VK icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'vk' ),
            ),
            array(
                'id'        => 'share_social-tumblr',
                'type'      => 'text',
                'title'     => esc_html__('Title for Tumblr icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'tumblr' ),
            ),
            array(
                'id'        => 'share_social-mail',
                'type'      => 'text',
                'title'     => esc_html__('Title for E-mail icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'mail' ),
                'subtitle'  => esc_html__( 'Send this article via e-mail to a friend', 'wizestore' ),
            ),
            array(
                'id'        => 'share_social-reddit',
                'type'      => 'text',
                'title'     => esc_html__('Title for Reddit icon', 'wizestore' ),
                'default'   => '',
                'required'  => array( 'share_social_select', '=', 'reddit' ),
            ),
        )
    ) );

    // registration
    $registration_option = array(); 

    $registration_option[] = array(
                'id'   => 'gt3_registration_id',
                'title'    => esc_html__( 'Enter your purchase code:', 'wizestore' ),
                'type' => 'gt3_registration'
            );

    if (get_option( 'gt3_registration_status') == 'active') {
        $registration_option[] = array(
                'id'       => 'gt3_auto_update',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Auto-update', 'wizestore' ),
                'default'  => true,
            );
    }

    Redux::setSection( $opt_name, array(
        'id'     => 'gt3_registration_section',
        'title'  =>  __( 'Product Activation', 'wizestore' ),
        /*'desc'   => __( 'This is GT3 Registration', 'wizestore' ),*/
        'icon'   => 'el el-unlock',
        'fields' => $registration_option,
    ) );
    //end registration


$gt3_changelog = get_option( 'gt3_changelog' );

if (!empty($gt3_changelog) && is_array($gt3_changelog) && !empty($gt3_changelog['changelog'])) {

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Changelog', 'wizestore' ),
        'id'               => 'changelog',
        'icon'   => 'el el-list-alt',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'changelog',
                'type'     => 'raw',
                'markdown' => true,
                'full_width' => true,
                //'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                'content' => $gt3_changelog['changelog'],
            ),
        )
    ) );

}


    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'remove_demo' );


    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

