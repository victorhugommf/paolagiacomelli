<?php
// Adding functions for theme

function gt3_types_init(){
    if (class_exists('Vc_Manager')) {
        if (function_exists('gt3_shift_title_function')) {
            call_user_func('vc_add_shortcode_param','gt3_shift_title_position' , 'gt3_shift_title_function', get_template_directory_uri().'/core/vc/custom_types/js/gt3_shift_title.js');
        }
        if (function_exists('gt3_on_off_function')) {
            call_user_func('vc_add'.'_shortcode_param','gt3_on_off_function', get_template_directory_uri().'/core/vc/custom_types/js/gt3_on_off.js');
        }
        if (function_exists('gt3_packery_layout_select_function')) {
            call_user_func('vc_add'.'_shortcode_param','gt3_packery_layout_select' , 'gt3_packery_layout_select_function', get_template_directory_uri().'/core/vc/custom_types/js/gt3_packery_layout.js');
        }
        if (function_exists('gt3_image_select')) {
            call_user_func('vc_add'.'_shortcode_param','gt3_dropdown', 'gt3_image_select', get_template_directory_uri().'/core/vc/custom_types/js/gt3_image_select.js' );
        }
        if (function_exists('gt3_multi_select')) {
            call_user_func('vc_add'.'_shortcode_param','gt3-multi-select', 'gt3_multi_select', get_template_directory_uri().'/core/vc/custom_types/js/gt3_multi_select.js' );
        }
	    if( function_exists( 'vc_add_shortcode_param' ) && function_exists('gt3_func_init_hotspot') ) {
		    add_action('admin_enqueue_scripts', 'gt3_hotspot_assets');
		    vc_add_shortcode_param('gt3_init_hotspot', 'gt3_func_init_hotspot', get_template_directory_uri() . '/core/admin/js/gt3_param.js');
	    }
    }
}
add_action( 'init', 'gt3_types_init' );


function gt3_sort_place (){
    $mb_logo_position = rwmb_meta('mb_logo_position');
    $mb_menu_position = rwmb_meta('mb_menu_position');
    $mb_left_bar_position = rwmb_meta('mb_left_bar_position');
    $mb_right_bar_position = rwmb_meta('mb_right_bar_position');

    $mb_logo_order = rwmb_meta('mb_logo_order');
    $mb_menu_order = rwmb_meta('mb_menu_order');
    $mb_left_bar_order = rwmb_meta('mb_left_bar_order');
    $mb_right_bar_order = rwmb_meta('mb_right_bar_order');
    $positions = array(
        'logo' => $mb_logo_position,
        'menu' => $mb_menu_position,
        'left_bar' => $mb_left_bar_position,
        'right_bar' => $mb_right_bar_position
    );
    $sorting_array = array(
        'Left align side' => '',
        'Center align side' => '',
        'Right align side' => ''
    );
    foreach ($positions as $pos => $value) {
        switch ($value) {
            case 'left_align_side':
                $sorting_array['Left align side'][$pos] = ${'mb_'.$pos.'_order'};
                break;
            case 'center_align_side':
                $sorting_array['Center align side'][$pos] = $pos;
                break;
            case 'right_align_side':
                $sorting_array['Right align side'][$pos] = $pos;
                break;
        }
    }
    foreach ($sorting_array as $key => $value) {
        if (is_array($sorting_array[$key])) {
            asort($value);
            $sorting_array[$key] = $value;
        }
        $sorting_array[$key]['placebo'] = 'placebo';
    }
    return $sorting_array;
}



// out search shortcode
if (!function_exists('gt3_search_shortcode')) {
    function gt3_search_shortcode(){
        if (function_exists('gt3_option')) {
            $header_height = gt3_option('header_height');
        }
        $header_height = $header_height['height'];
        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
                $header_height = rwmb_meta("mb_header_height");
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:'.$header_height.'px;' : '';
        $search_style = !empty($search_style) ? ' style="'.$search_style.'"' : '' ;


        $out = '<div class="header_search"'.$search_style.'>';
            $out .= '<div class="header_search__container">';
                $out .= '<div class="header_search__icon">';
                    $out .= '<i></i>';
                $out .= '</div>';
                $out .= '<div class="header_search__inner">';
                    $out .= get_search_form(false);
                $out .= '</div>';
            $out .= '</div>';
        $out .= '</div>';
        return $out;
    }
    add_shortcode('gt3_search', 'gt3_search_shortcode');
}

if (!function_exists('gt3_menu_shortcode')) {
    function gt3_menu_shortcode(){
        if (function_exists('gt3_option')) {
            $header_height = gt3_option('header_height');
        }
        $header_height = $header_height['height'];
        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
                $header_height = rwmb_meta("mb_header_height");
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:'.$header_height.'px;' : '';
        $search_style = !empty($search_style) ? ' style="'.$search_style.'"' : '' ;

        ob_start();
        if (has_nav_menu( 'top_header_menu' )) {
            echo "<nav class='top-menu main-menu main_menu_container'>";
                gt3_top_menu ();
            echo "</nav>";
            echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>';
        }
        $out = ob_get_clean();
        return !empty($out) ? $out : '';
    }
    add_shortcode('gt3_menu', 'gt3_menu_shortcode');
}

if (!function_exists('gt3_top_menu')) {
    function gt3_top_menu (){
        wp_nav_menu( array(
            'theme_location'  => 'top_header_menu',
            'container' => '',
            'container_class' => '',
            'after' => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker' => ''
        ) );
    }
}

add_action('wp_head','gt3_wp_head_custom_code',1000);
function gt3_wp_head_custom_code() {
    // this code not only js or css / can insert any type of code

    if (function_exists('gt3_option')) {
        $header_custom_code = gt3_option('header_custom_js');
    }
    echo isset($header_custom_code) ? $header_custom_code : '';
}

add_action('wp_footer', 'gt3_custom_footer_js',1000);
function gt3_custom_footer_js() {
    if (function_exists('gt3_option')) {
        $custom_js = gt3_option('custom_js');
    }
    echo isset($custom_js) ? '<script type="text/javascript" id="gt3_custom_footer_js">'.$custom_js.'</script>' : '';
}


function gt3_changelog(){

    global $wp_version;
    $my_theme = wp_get_theme();
    $version = $my_theme->get( 'Version' );

    $gt3_changelog = get_option( 'gt3_changelog' );

    if (!empty($gt3_changelog) && is_array($gt3_changelog)) {
        if (version_compare( $version, $gt3_changelog['version'], '>')) {
            $gt3_changelog['version'] = $version;
            $gt3_changelog['changelog'] = gt3_get_changlog_content();
            update_option( 'gt3_changelog' , $gt3_changelog);
        }
    }else{
        $gt3_changelog = array();
        $gt3_changelog['version'] = $version;
        $gt3_changelog['changelog'] = gt3_get_changlog_content();
        update_option( 'gt3_changelog' , $gt3_changelog);
    }

}
gt3_changelog();

function gt3_get_changlog_content(){
    $changelog = '';
    $file = get_template_directory() . '/changelog.txt';
    if (!file_exists($file)) {
        return 'No Logs';
    }
    $myfile = call_user_func('fopen', $file, "r") or die("Unable to open file!");
    $changelog_content = call_user_func('fread', $myfile, filesize($file)) ;
    call_user_func('fclose', $myfile);
    $changelog_content = explode("------------------------------------------------------------------------------", $changelog_content);
    if (!empty($changelog_content) && is_array($changelog_content)) {
        foreach ($changelog_content as $changelog_item) {
            $changelog_item = trim($changelog_item);
            if ( preg_match_all( "/^.+/", $changelog_item, $matches, PREG_PATTERN_ORDER ) ){
                $content = str_replace($matches[0], '', $changelog_item);
                $content_array = explode('Changed files:', $content);
                $content = !empty($content_array[0]) ? $content_array[0] : $content;
                $changed_files = !empty($content_array[1]) ? $content_array[1] : '';
                $changelog .= "<div class='gt3_changelog'>";
                $changelog .=  "<h2>".$matches[0][0]."</h2>";
                $changelog .=  "<pre>".$content."</pre>";
                if (!empty($changed_files)) {
                    $changelog .=  "<strong>Changed files:</strong>";
                    $changelog .=  "<pre>".trim($changed_files)."</pre>";
                }
                $changelog .=  "</div>";
            }
        }
    }
    return $changelog;
}


if (!function_exists('gt3_string_coding')) {
	function gt3_string_coding($code){
		if (!empty($code)) {
			return base64_encode($code);
		}
		return;
	}
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

if (!function_exists('gt3_add_widget_to_theme')) {
	function gt3_add_widget_to_theme(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/posts.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/flickr.php';
	}
}
if( !function_exists('posts_register_widgets')){
	function posts_register_widgets(){
		register_widget('posts');
	}
}
if( !function_exists('flickr_register_widgets')) {
	function flickr_register_widgets() {
		register_widget( 'flickr' );
	}
}

remove_filter('pre_user_description', 'wp_filter_kses');


