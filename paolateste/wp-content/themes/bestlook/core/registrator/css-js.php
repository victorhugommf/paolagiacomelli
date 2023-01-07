<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        wp_register_script( 'gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
        $translation_array = array(
		    'gt3_ajaxurl' => esc_url(admin_url('admin-ajax.php'))
		);
		wp_localize_script( 'gt3_theme_js', 'object_name', $translation_array );

        #CSS
        wp_enqueue_style('default_style', get_bloginfo('stylesheet_url'));
		wp_enqueue_style("theme_icon", get_template_directory_uri() . '/fonts/theme-font/theme_icon.css');
		wp_enqueue_style("font_awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
		wp_enqueue_style("gt3_composer", get_template_directory_uri() . '/css/base_composer.css');
		wp_enqueue_style("gt3_responsive", get_template_directory_uri() . '/css/responsive.css');
		if( gt3_option('dark_theme') == '1' ){
			wp_enqueue_style('gt3_dark_theme', get_template_directory_uri() . '/css/dark_theme.css');
		}

        #JS
		wp_enqueue_script('cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
		wp_enqueue_script('gt3_waypoint_js', get_template_directory_uri() . '/js/waypoint.js', array('jquery'), false, false);
		wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
		wp_enqueue_script('event_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);

		#YITH Woocommerce Popup gt3 styling
		if (class_exists('YITH_Popup_Frontend') && gt3_option('gt3_yith_popup')) {
			wp_enqueue_style('gt3_css_yith_popup', get_template_directory_uri() . '/css/gt3-css-yith-popup.css', array(), '1.0');
			wp_enqueue_script('gt3_js_yith_popup', get_template_directory_uri() . '/js/gt3-js-yith-popup.js', array(), '1.0', true);
		}
		#Ajax Search Lite gt3 styling
		if (class_exists('AjaxSearchLiteWidget') && gt3_option('gt3_ajax_search')) {
			wp_enqueue_style('gt3_css_search_ajax', get_template_directory_uri() . '/css/gt3-css-search-ajax.css', array(), '1.0');
		}
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    $protocol = is_ssl() ? 'https' : 'http';

    #CSS (MAIN)
	wp_enqueue_style("font_awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style("admin_font", "$protocol://fonts.googleapis.com/css?family=Roboto:400,700,300");
	wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('admin-colorbox', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
	wp_enqueue_style("gt3-vc-backend-style", get_template_directory_uri() . '/core/admin/css/gt3-vc-backend.css');

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'), false, true);
    wp_enqueue_media();
    wp_enqueue_script('admin-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');

	if (class_exists( 'RWMB_Loader' )) {
		wp_enqueue_script('metaboxes_js', get_template_directory_uri() . '/core/admin/js/metaboxes.js');
	}
}


function gt3_custom_styles() {
	$custom_css = '';

	// THEME COLOR
	$theme_color = esc_attr(gt3_option("theme-custom-color"));
	$theme_color2 = esc_attr(gt3_option("theme-custom-color2"));
	// END THEME COLOR

	// BODY BACKGROUND
	$bg_body = esc_attr(gt3_option('body-background-color'));
	// END BODY BACKGROUND

	// BODY TYPOGRAPHY
	$main_font = gt3_option('main-font');
	if (!empty($main_font)) {
		$content_font_family = esc_attr($main_font['font-family']);
		$content_line_height = esc_attr($main_font['line-height']);
		$content_font_size = esc_attr($main_font['font-size']);
		$content_font_weight = esc_attr($main_font['font-weight']);
		$content_color = esc_attr($main_font['color']);
	}else{
		$content_font_family = '';
		$content_line_height = '';
		$content_font_size = '';
		$content_font_weight = '';
		$content_color = '';
	}
	
	// END BODY TYPOGRAPHY

	// HEADER TYPOGRAPHY
	$header_font = gt3_option('header-font');
	if (!empty($header_font)) {
		$header_font_family = esc_attr($header_font['font-family']);
		$header_font_weight = esc_attr($header_font['font-weight']);
		$header_font_color = esc_attr($header_font['color']);
	}else{
		$header_font_family = '';
		$header_font_weight = '';
		$header_font_color = '';
	}
	
	$h1_font = gt3_option('h1-font');
	if (!empty($h1_font)) {
		$H1_font_family = !empty($h1_font['font-family']) ? esc_attr($h1_font['font-family']) : '';
		$H1_font_weight = !empty($h1_font['font-weight']) ? esc_attr($h1_font['font-weight']) : '';
		$H1_font_line_height = !empty($h1_font['line-height']) ? esc_attr($h1_font['line-height']) : '';
		$H1_font_size = !empty($h1_font['font-size']) ? esc_attr($h1_font['font-size']) : '';
	}else{
		$H1_font_family = '';
		$H1_font_weight = '';
		$H1_font_line_height = '';
		$H1_font_size = '';
	}
	
	$h2_font = gt3_option('h2-font');
	if (!empty($h2_font)) {
		$H2_font_family = !empty($h2_font['font-family']) ? esc_attr($h2_font['font-family']) : '';
		$H2_font_weight = !empty($h2_font['font-weight']) ? esc_attr($h2_font['font-weight']) : '';
		$H2_font_line_height = !empty($h2_font['line-height']) ? esc_attr($h2_font['line-height']) : '';
		$H2_font_size = !empty($h2_font['font-size']) ? esc_attr($h2_font['font-size']) : '';
	}else{
		$H2_font_family = '';
		$H2_font_weight = '';
		$H2_font_line_height = '';
		$H2_font_size = '';
	}

	$h3_font = gt3_option('h3-font');
	if (!empty($h3_font)) {
		$H3_font_family = !empty($h3_font['font-family']) ? esc_attr($h3_font['font-family']) : '';
		$H3_font_weight = !empty($h3_font['font-weight']) ? esc_attr($h3_font['font-weight']) : '';
		$H3_font_line_height = !empty($h3_font['line-height']) ? esc_attr($h3_font['line-height']) : '';
		$H3_font_size = !empty($h3_font['font-size']) ? esc_attr($h3_font['font-size']) : '';
	}else{
		$H3_font_family = '';
		$H3_font_weight = '';
		$H3_font_line_height = '';
		$H3_font_size = '';
	}
	
	$h4_font = gt3_option('h4-font');
	if (!empty($h4_font)) {
		$H4_font_family = !empty($h4_font['font-family']) ? esc_attr($h4_font['font-family']) : '';
		$H4_font_weight = !empty($h4_font['font-weight']) ? esc_attr($h4_font['font-weight']) : '';
		$H4_font_line_height = !empty($h4_font['line-height']) ? esc_attr($h4_font['line-height']) : '';
		$H4_font_size = !empty($h4_font['font-size']) ? esc_attr($h4_font['font-size']) : '';
	}else{
		$H4_font_family = '';
		$H4_font_weight = '';
		$H4_font_line_height = '';
		$H4_font_size = '';
	}

	$h5_font = gt3_option('h5-font');
	if (!empty($h5_font)) {
		$H5_font_family = !empty($h5_font['font-family']) ? esc_attr($h5_font['font-family']) : '';
		$H5_font_weight = !empty($h5_font['font-weight']) ? esc_attr($h5_font['font-weight']) : '';
		$H5_font_line_height = !empty($h5_font['line-height']) ? esc_attr($h5_font['line-height']) : '';
		$H5_font_size = !empty($h5_font['font-size']) ? esc_attr($h5_font['font-size']) : '';
	}else{
		$H5_font_family = '';
		$H5_font_weight = '';
		$H5_font_line_height = '';
		$H5_font_size = '';
	}

	$h6_font = gt3_option('h6-font');
	if (!empty($h6_font)) {
		$H6_font_family = !empty($h6_font['font-family']) ? esc_attr($h6_font['font-family']) : '';
		$H6_font_weight = !empty($h6_font['font-weight']) ? esc_attr($h6_font['font-weight']) : '';
		$H6_font_line_height = !empty($h6_font['line-height']) ? esc_attr($h6_font['line-height']) : '';
		$H6_font_size = !empty($h6_font['font-size']) ? esc_attr($h6_font['font-size']) : '';
	}else{
		$H6_font_family = '';
		$H6_font_weight = '';
		$H6_font_line_height = '';
		$H6_font_size = '';
	}

	$menu_font = gt3_option('menu-font');
	if (!empty($menu_font)) {
		$menu_font_family = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
		$menu_font_weight = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
		$menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
		$menu_font_size = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
	}else{
		$menu_font_family = '';
		$menu_font_weight = '';
		$menu_font_line_height = '';
		$menu_font_size = '';
	}

	$sub_menu_bg = gt3_option('sub_menu_background');
	$sub_menu_color = gt3_option('sub_menu_color');


	/* GT3 Header Builder */
	$side_top_background = gt3_option('side_top_background');
	$side_top_background = $side_top_background['rgba'];
	$side_top_color = gt3_option('side_top_color');
	$side_top_height = gt3_option('side_top_height');
	$side_top_height = $side_top_height['height'];

	$side_middle_background = gt3_option('side_middle_background');
	$side_middle_background = $side_middle_background['rgba'];
	$side_middle_color = gt3_option('side_middle_color');
	$side_middle_height = gt3_option('side_middle_height');
	$side_middle_height = $side_middle_height['height'];

	$side_bottom_background = gt3_option('side_bottom_background');
	$side_bottom_background = $side_bottom_background['rgba'];
	$side_bottom_color = gt3_option('side_bottom_color');
	$side_bottom_height = gt3_option('side_bottom_height');
	$side_bottom_height = $side_bottom_height['height'];

	$side_top_border = (bool)gt3_option("side_top_border");
	$side_top_border_color = gt3_option("side_top_border_color");

	$side_middle_border = (bool)gt3_option("side_middle_border");
	$side_middle_border_color = gt3_option("side_middle_border_color");
    
    $side_bottom_border = (bool)gt3_option("side_bottom_border");
    $side_bottom_border_color = gt3_option("side_bottom_border_color");

    $header_sticky = gt3_option("header_sticky");
    $side_top_sticky = gt3_option('side_top_sticky');
	$side_top_background_sticky = gt3_option('side_top_background_sticky');
	$side_top_color_sticky = gt3_option('side_top_color_sticky');
	$side_top_height_sticky = gt3_option('side_top_height_sticky');

	$side_middle_sticky = gt3_option('side_middle_sticky');
	$side_middle_background_sticky = gt3_option('side_middle_background_sticky');
	$side_middle_color_sticky = gt3_option('side_middle_color_sticky');
	$side_middle_height_sticky = gt3_option('side_middle_height_sticky');

	$side_bottom_sticky = gt3_option('side_bottom_sticky');
	$side_bottom_background_sticky = gt3_option('side_bottom_background_sticky');
	$side_bottom_color_sticky = gt3_option('side_bottom_color_sticky');
	$side_bottom_height_sticky = gt3_option('side_bottom_height_sticky');


	if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
        $mb_header_presets = rwmb_meta('mb_header_presets');            
        if ($mb_header_presets != 'default' && !empty($mb_header_presets) ) {
            $presets = gt3_header_presets ();
            $preset = json_decode($presets[$mb_header_presets],true); 

            $sub_menu_bg = gt3_option_presets($preset,'sub_menu_background');
			$sub_menu_color = gt3_option_presets($preset,'sub_menu_color');
			
            $side_top_background = gt3_option_presets($preset,'side_top_background');
			$side_top_background = $side_top_background['rgba'];
			$side_top_color = gt3_option_presets($preset,'side_top_color');
			$side_top_height = gt3_option_presets($preset,'side_top_height');
			$side_top_height = $side_top_height['height'];

			$side_middle_background = gt3_option_presets($preset,'side_middle_background');
			$side_middle_background = $side_middle_background['rgba'];
			$side_middle_color = gt3_option_presets($preset,'side_middle_color');
			$side_middle_height = gt3_option_presets($preset,'side_middle_height');
			$side_middle_height = $side_middle_height['height'];

			$side_bottom_background = gt3_option_presets($preset,'side_bottom_background');
			$side_bottom_background = $side_bottom_background['rgba'];
			$side_bottom_color = gt3_option_presets($preset,'side_bottom_color');
			$side_bottom_height = gt3_option_presets($preset,'side_bottom_height');
			$side_bottom_height = $side_bottom_height['height'];    

			$side_top_border = (bool)gt3_option_presets($preset,"side_top_border");
			$side_top_border_color = gt3_option_presets($preset,"side_top_border_color");
			$side_middle_border = (bool)gt3_option_presets($preset,"side_middle_border");
			$side_middle_border_color = gt3_option_presets($preset,"side_middle_border_color");		    
		    $side_bottom_border = (bool)gt3_option_presets($preset,"side_bottom_border");
		    $side_bottom_border_color = gt3_option_presets($preset,"side_bottom_border_color");

		    $header_sticky = gt3_option_presets($preset,"header_sticky");
		    $side_top_sticky = gt3_option_presets($preset,'side_top_sticky');
			$side_top_background_sticky = gt3_option_presets($preset,'side_top_background_sticky');
			$side_top_color_sticky = gt3_option_presets($preset,'side_top_color_sticky');
			$side_top_height_sticky = gt3_option_presets($preset,'side_top_height_sticky');

			$side_middle_sticky = gt3_option_presets($preset,'side_middle_sticky');
			$side_middle_background_sticky = gt3_option_presets($preset,'side_middle_background_sticky');
			$side_middle_color_sticky = gt3_option_presets($preset,'side_middle_color_sticky');
			$side_middle_height_sticky = gt3_option_presets($preset,'side_middle_height_sticky');

			$side_bottom_sticky = gt3_option_presets($preset,'side_bottom_sticky');
			$side_bottom_background_sticky = gt3_option_presets($preset,'side_bottom_background_sticky');
			$side_bottom_color_sticky = gt3_option_presets($preset,'side_bottom_color_sticky');
			$side_bottom_height_sticky = gt3_option_presets($preset,'side_bottom_height_sticky');
        }

        $mb_customize_header_layout = rwmb_meta('mb_customize_header_layout'); 
        if ($mb_customize_header_layout == 'custom') {
	        $mb_customize_top_header_layout = rwmb_meta('mb_customize_top_header_layout'); 
	        $mb_customize_middle_header_layout = rwmb_meta('mb_customize_middle_header_layout'); 
	        $mb_customize_bottom_header_layout = rwmb_meta('mb_customize_bottom_header_layout'); 

	        if ($mb_customize_top_header_layout == 'custom') {
	        	//top
				$mb_top_header_background = rwmb_meta('mb_top_header_background');
	            $mb_top_header_background_opacity = rwmb_meta('mb_top_header_background_opacity');
	            $side_top_color = rwmb_meta('mb_top_header_color');
	            $side_top_border = rwmb_meta('mb_top_header_bottom_border');
	            $mb_header_top_bottom_border_color = rwmb_meta('mb_header_top_bottom_border_color');
	            $mb_header_top_bottom_border_color_opacity = rwmb_meta('mb_header_top_bottom_border_color_opacity');

	            if (!empty($mb_header_top_bottom_border_color)) {
	                $side_top_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_top_bottom_border_color)).','.$mb_header_top_bottom_border_color_opacity.')';
	            }else{
	                $side_top_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_top_header_background)) {
	                $side_top_background = 'rgba('.(gt3_HexToRGB($mb_top_header_background)).','.$mb_top_header_background_opacity.')';
	            }else{
	                $side_top_background = '';
	            }
	        }

	        if ($mb_customize_middle_header_layout == 'custom') {
	        	//middle
				$mb_middle_header_background = rwmb_meta('mb_middle_header_background');
	            $mb_middle_header_background_opacity = rwmb_meta('mb_middle_header_background_opacity');
	            $side_middle_color = rwmb_meta('mb_middle_header_color');
	            $side_middle_border = rwmb_meta('mb_middle_header_bottom_border');
	            $mb_header_middle_bottom_border_color = rwmb_meta('mb_header_middle_bottom_border_color');
	            $mb_header_middle_bottom_border_color_opacity = rwmb_meta('mb_header_middle_bottom_border_color_opacity');

	            if (!empty($mb_header_middle_bottom_border_color)) {
	                $side_middle_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_middle_bottom_border_color)).','.$mb_header_middle_bottom_border_color_opacity.')';
	            }else{
	                $side_middle_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_middle_header_background)) {
	                $side_middle_background = 'rgba('.(gt3_HexToRGB($mb_middle_header_background)).','.$mb_middle_header_background_opacity.')';
	            }else{
	                $side_middle_background = '';
	            }
	        }

	        if ($mb_customize_bottom_header_layout == 'custom') {
	        	//bottom
				$mb_bottom_header_background = rwmb_meta('mb_bottom_header_background');
	            $mb_bottom_header_background_opacity = rwmb_meta('mb_bottom_header_background_opacity');
	            $side_bottom_color = rwmb_meta('mb_bottom_header_color');
	            $side_bottom_border = rwmb_meta('mb_bottom_header_bottom_border');
	            $mb_header_bottom_bottom_border_color = rwmb_meta('mb_header_bottom_bottom_border_color');
	            $mb_header_bottom_bottom_border_color_opacity = rwmb_meta('mb_header_bottom_bottom_border_color_opacity');

	            if (!empty($mb_header_bottom_bottom_border_color)) {
	                $side_bottom_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_bottom_bottom_border_color)).','.$mb_header_bottom_bottom_border_color_opacity.')';
	            }else{
	                $side_bottom_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_bottom_header_background)) {
	                $side_bottom_background = 'rgba('.(gt3_HexToRGB($mb_bottom_header_background)).','.$mb_bottom_header_background_opacity.')';
	            }else{
	                $side_bottom_background = '';
	            }
	        }
	    }
    }

	/* End GT3 Header Builder */


	// END HEADER TYPOGRAPHY


	$custom_css = '
    /* Custom CSS */
    *{
	}
	
	body,
	body.wpb-js-composer .vc_row .vc_tta.vc_general .vc_tta-panel-title>a span,
	body.wpb-js-composer .vc_row .vc_toggle_title>h4,
	.main_footer .widget-title,
	.widget-title,
	.team_title__text,
	.team_title__text > a,
	.woocommerce ul.products li.product h3,
	.woocommerce form .qty,
	.woocommerce form .variations select,
	body .widget .yit-wcan-select-open,
	body .widget-hotspot {
		font-family:' . $content_font_family . ';
	}
	body {
		'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
		font-size:'.$content_font_size.';
		line-height:'.$content_line_height.';
		font-weight:'.$content_font_weight.';
		color: '.$content_color.';
	}

	/* Custom Fonts */
	.module_team .team_info,
	.module_testimonial .testimonials-text,
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.widget.widget_archive > ul > li, 
	.widget.widget_categories > ul > li, 
	.widget.widget_pages > ul > li, 
	.widget.widget_meta > ul > li, 
	.widget.widget_recent_comments > ul > li, 
	.widget.widget_recent_entries > ul > li, 
	.widget.widget_nav_menu > .menu-main-menu-container > ul > li,
	.calendar_wrap tbody,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab,
	.price_item-cost,
	.widget.widget_posts .recent_posts .post_title a{
		color: '.$header_font_color.';
	}
	.dropcap,
	.gt3_icon_box__icon--number,
	.module_testimonial .testimonials-text,
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.strip_template .strip-item a span,
	.column1 .item_title a,
	.index_number,
	.price_item_btn a,
	.shortcode_tab_item_title,
	.gt3_twitter .twitt_title{
		font-family: ' . $header_font_family . ';
		font-weight: ' . $header_font_weight . '
	}
	h1, h1 a, h1 span {
		'.(!empty($H1_font_family) ? 'font-family:'.$H1_font_family.';' : '' ).'
		'.(!empty($H1_font_weight) ? 'font-weight:'.$H1_font_weight.';' : '' ).'
		'.(!empty($H1_font_size) ? 'font-size:'.$H1_font_size.';' : '' ).'
		'.(!empty($H1_font_line_height) ? 'line-height:'.$H1_font_line_height.';' : '' ).'
	}
	h2, h2 a, h2 span {
		'.(!empty($H2_font_family) ? 'font-family:'.$H2_font_family.';' : '' ).'
		'.(!empty($H2_font_weight) ? 'font-weight:'.$H2_font_weight.';' : '' ).'
		'.(!empty($H2_font_size) ? 'font-size:'.$H2_font_size.';' : '' ).'
		'.(!empty($H2_font_line_height) ? 'line-height:'.$H2_font_line_height.';' : '' ).'
	}
	h3, h3 a, h3 span,
	#customer_login h2,
	.gt3_header_builder__login-modal_container h2,
	.sidepanel .title{
		'.(!empty($H3_font_family) ? 'font-family:'.$H3_font_family.';' : '' ).'
		'.(!empty($H3_font_weight) ? 'font-weight:'.$H3_font_weight.';' : '' ).'
		'.(!empty($H3_font_size) ? 'font-size:'.$H3_font_size.';' : '' ).'
		'.(!empty($H3_font_line_height) ? 'line-height:'.$H3_font_line_height.';' : '' ).'
	}
	h4, h4 a, h4 span{
		'.(!empty($H4_font_family) ? 'font-family:'.$H4_font_family.';' : '' ).'
		'.(!empty($H4_font_weight) ? 'font-weight:'.$H4_font_weight.';' : '' ).'
		'.(!empty($H4_font_size) ? 'font-size:'.$H4_font_size.';' : '' ).'
		'.(!empty($H4_font_line_height) ? 'line-height:'.$H4_font_line_height.';' : '' ).'
	}
	h5, h5 a, h5 span {
		'.(!empty($H5_font_family) ? 'font-family:'.$H5_font_family.';' : '' ).'
		'.(!empty($H5_font_weight) ? 'font-weight:'.$H5_font_weight.';' : '' ).'
		'.(!empty($H5_font_size) ? 'font-size:'.$H5_font_size.';' : '' ).'
		'.(!empty($H5_font_line_height) ? 'line-height:'.$H5_font_line_height.';' : '' ).'
	}
	h6, h6 a, h6 span {
		'.(!empty($H6_font_family) ? 'font-family:'.$H6_font_family.';' : '' ).'
		'.(!empty($H6_font_weight) ? 'font-weight:'.$H6_font_weight.';' : '' ).'
		'.(!empty($H6_font_size) ? 'font-size:'.$H6_font_size.';' : '' ).'
		'.(!empty($H6_font_line_height) ? 'line-height:'.$H6_font_line_height.';' : '' ).'
	}

	.diagram_item .chart,
	.item_title a ,
	.contentarea ul,
	#customer_login form .form-row label,
	.gt3_header_builder__login-modal_container form .form-row label,
	body .vc_pie_chart .vc_pie_chart_value{
		color:'. $header_font_color .';
	}
    body.wpb-js-composer .vc_row .vc_progress_bar:not(.vc_progress-bar-color-custom) .vc_single_bar .vc_label:not([style*="color"]) .vc_label_units{
    	color: '. $header_font_color .' !important;
    }


	/* Theme color */
	blockquote:before,
	a,
	#back_to_top:hover,
	.top_footer a:hover,
	.widget.widget_archive ul li:hover:before,
	.widget.widget_categories ul li:hover:before,
	.widget.widget_pages ul li:hover:before,
	.widget.widget_meta ul li:hover:before,
	.widget.widget_recent_comments ul li:hover:before,
	.widget.widget_recent_entries ul li:hover:before,
	.widget.widget_nav_menu ul li:hover:before,
	.widget.widget_archive ul li:hover > a,
	.widget.widget_categories ul li:hover > a,
	.widget.widget_pages ul li:hover > a,
	.widget.widget_meta ul li:hover > a,
	.widget.widget_recent_comments ul li:hover > a,
	.widget.widget_recent_entries ul li:hover > a,
	.widget.widget_nav_menu ul li:hover > a,
	.top_footer .widget.widget_archive ul li > a:hover,
	.top_footer .widget.widget_categories ul li > a:hover,
	.top_footer .widget.widget_pages ul li > a:hover,
	.top_footer .widget.widget_meta ul li > a:hover,
	.top_footer .widget.widget_recent_comments ul li > a:hover,
	.top_footer .widget.widget_recent_entries ul li > a:hover,
	.top_footer .widget.widget_nav_menu ul li > a:hover,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab.vc_active>a,
	.calendar_wrap thead,
	.gt3_practice_list__image-holder i,
	.load_more_works:hover,
	.copyright a:hover,
	.module_testimonial.type2 .testimonials-text:before,
	input[type="submit"]:hover,
	button:hover,
	.price_item .items_text ul li:before,
	.price_item.most_popular .item_cost_wrapper h3,
	.gt3_practice_list__title a:hover,
	.mc_form_inside #mc_signup_submit:hover,
	.pre_footer input[type="submit"]:hover,
	.team-icons .member-icon:hover,
	.gt3_top_sidebar_products .widget_price_filter .price_slider_amount .price_label{
		color: '.$theme_color.';
	}

	.price_item .item_cost_wrapper .bg-color,
	.main_menu_container .menu_item_line,
	.gt3_practice_list__link:before,
	.load_more_works,
	.content-container .vc_progress_bar .vc_single_bar .vc_bar,
	input[type="submit"],
	button,
	.mc_form_inside #mc_signup_submit,
	.pre_footer input[type="submit"]{
		background-color: '.$theme_color.';
	}
	.calendar_wrap caption,
	.widget .calendar_wrap table td#today:before{
		background: '.$theme_color.';
	}
	.woocommerce .wishlist_table td.product-add-to-cart a,
	.gt3_module_button a{
		border-color: '.$theme_color.';
		background: '.$theme_color.';
	}
	.woocommerce .wishlist_table td.product-add-to-cart a:hover,
	.woocommerce .widget_shopping_cart .buttons a:hover, 
	.woocommerce.widget_shopping_cart .buttons a:hover,
	.gt3_header_builder_cart_component .button:hover,
	.widget_search .search_form:before,
	.gt3_submit_wrapper:hover > i {
		color:'.$theme_color.';
	}
	.nivo-directionNav .nivo-prevNav:hover:after,
	.nivo-directionNav .nivo-nextNav:hover:after,
	.load_more_works,
	input[type="submit"],
	button {
		border-color: '.$theme_color.';
	}

	.isotope-filter a:hover,
	.isotope-filter a.active,
	.gt3_practice_list__filter a:hover, 
	.gt3_practice_list__filter a.active {
		border-bottom-color: '.$theme_color.';
	}

	.gt3_module_button a:hover,
	.gt3_module_button a:hover .gt3_btn_icon.fa {
		color: '.$theme_color.';
	}

	.widget_nav_menu .menu .menu-item:before,
	.gt3_icon_box__link a:before,
	.stripe_item-divider,
	.module_team .view_all_link:before {
		background-color: '.$theme_color.';
	}
	.single-member-page .member-icon:hover,
	.widget_nav_menu .menu .menu-item:hover>a,
	.single-member-page .team-link:hover,
	.module_team .view_all_link {
		color: '.$theme_color.';
	}

	.module_team .view_all_link:after {
		border-color: '.$theme_color.';
	}

	/* menu fonts */
	.main-menu>ul,
	.main-menu>div>ul {
		font-family:'.esc_attr($menu_font_family).';
		font-weight:'.esc_attr($menu_font_weight).';
		line-height:'.esc_attr($menu_font_line_height).';
		font-size:'.esc_attr($menu_font_size).';
	}

	/* sub menu styles */
	.main-menu ul li ul.sub-menu,
	.gt3_currency_switcher ul,
	.gt3_header_builder .header_search__inner .search_form,
	.mobile_menu_container,
	.gt3_header_builder_cart_component__cart-container{
		background-color: ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).' ;
		color: '.esc_attr( $sub_menu_color ).' ;
	}
	.gt3_header_builder .header_search__inner .search_text::-webkit-input-placeholder{
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.gt3_header_builder .header_search__inner .search_text:-moz-placeholder {
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.gt3_header_builder .header_search__inner .search_text::-moz-placeholder {
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.gt3_header_builder .header_search__inner .search_text:-ms-input-placeholder {
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.gt3_header_builder .header_search .header_search__inner:before,
	.main-menu > ul > li > ul:before,
	.gt3_megamenu_triangle:before,
	.gt3_currency_switcher ul:before,
	.gt3_header_builder_cart_component__cart:before{
		border-bottom-color: ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).' ;
	}
	.gt3_header_builder .header_search .header_search__inner:before,
	.main-menu > ul > li > ul:before,
	.gt3_megamenu_triangle:before,
	.gt3_currency_switcher ul:before,
	.gt3_header_builder_cart_component__cart:before{
	    -webkit-box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
	    -moz-box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
	    box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
	}

	/* blog */
	.gt3_breadcrumb,
	.team-icons .member-icon,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab>a,
	.prev_next_links a b,
	ul.pagerblock li span,
	.gt3_module_featured_posts .listing_meta,
	.gt3_module_featured_posts .listing_meta a,
	.recent_posts .listing_meta a:hover{
		color: '.$content_color.';
	}
	.blogpost_title a:hover,
	.gt3_module_featured_posts .listing_meta a:hover,
	.recent_posts .listing_meta a,
	.widget.widget_posts .recent_posts li > .recent_posts_content .post_title a:hover {
		color: '.$theme_color.';
	}
	.blogpost_title i {
		color: '.$theme_color.';
	}
	.learn_more:hover,
	.woocommerce .widget_shopping_cart .total, 
	.woocommerce.widget_shopping_cart .total,
	.module_team .view_all_link:hover {color: '.$header_font_color.';
	}
	.module_team .view_all_link:hover:before {
		background-color: '.$header_font_color.';
	}
	.module_team .view_all_link:hover:after {
		border-color: '.$header_font_color.';
	}

	.learn_more span,
	.gt3_module_title .carousel_arrows a:hover span,
	.stripe_item:after,
	.packery-item .packery_overlay,
	.prev_next_links a span i {background: '.$theme_color.';
	}
	.learn_more span:before,
	.gt3_module_title .carousel_arrows a:hover span:before,
	.prev_next_links a span i:before {border-color: '.$theme_color.';
	}
	.learn_more:hover span,
	.gt3_module_title .carousel_arrows a span {background: '.$header_font_color.';
	}
	.learn_more:hover span:before,
	.gt3_module_title .carousel_arrows a span:before {border-color: '.$header_font_color.';
	}
	.likes_block,
	.isotope-filter a:hover,
	.isotope-filter a.active{
		color: '.$theme_color.';
	}
	.post_media_info,
	.gt3_practice_list__filter,
	.isotope-filter {
		color: '.$header_font_color.';
	}

	.post_media_info:before{
		background: '.$header_font_color.';
	}

	.gt3_module_title .external_link .learn_more {
		line-height:'.$content_line_height.';
	}

	.blog_type1 .blog_post_preview:before {
		background: '.$header_font_color.';
	}

	.post_share > a:before,
	.share_wrap a span {
		font-size:'.$content_font_size.';
	}

	ol.commentlist:after {
		'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
	}

	.blog_post_media__link_text a:hover,
	h3#reply-title a,
	.comment_author_says a:hover,
	.dropcap,
	.gt3_custom_text a,
	.gt3_custom_button i {
		color: '.$theme_color.';
	}
	.single .post_tags > span,
	h3#reply-title a:hover,
	.comment_author_says,
	.comment_author_says a {
		color: '.$header_font_color.';
	}
	.blog_post_media--link .blog_post_media__link_text a,
	.post_share > a:before,
	.post_share:hover > a:before,
	.post_share:hover > a,
	.likes_block .icon,
	.likes_block:not(.already_liked):hover,
	.listing_meta,
	.comment-reply-link,
	.comment-reply-link:hover,
	#customer_login .woocommerce-LostPassword a,
	.gt3_header_builder__login-modal_container .woocommerce-LostPassword a,
	.main_wrapper ol > li:before,
	.main-menu>ul>li>a:after,
	.main-menu ul li ul li.menu-item-has-children:after, 
	.main-menu > ul > li.menu-item-has-children > a:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-classic .vc_tta-controls-icon,
	.main_wrapper ul li:before,
	.main_footer ul li:before,
	.gt3_twitter a{
		color: '.$theme_color2.';
	}

	.blog_post_media--quote,
	blockquote,
	.blog_post_media--link,
	body.wpb-js-composer .vc_row .vc_toggle_classic .vc_toggle_icon,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-controls-icon:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_alternative .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_alternative .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:after{
		border-color: '.$theme_color2.';
	}
	.module_testimonial .slick-dots li button,
	body.wpb-js-composer .vc_tta.vc_tta-tabs .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title>a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab.vc_active:before,	
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered.vc_toggle_active .vc_toggle_title:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid.vc_toggle_active .vc_toggle_title,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_solid .vc_active .vc_tta-panel-title>a,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_bordered .vc_tta-panel.vc_active .vc_tta-panel-title>a:before,
	ul.pagerblock li a.current,
	ul.pagerblock li span,
	.listing_meta span:after,
	.tagcloud a:hover,
	.woo_mini-count > span:not(:empty),
	.icon-box_number{
		background-color: '.$theme_color2.';
	}

	::-moz-selection{background: '.$theme_color.';}
	::selection{background: '.$theme_color.';}
    ';

    //sticky header logo 
    $header_sticky_height = gt3_option('header_sticky_height');
    $custom_css .='
    .gt3_practice_list__overlay:before{
    	background-color: '.$theme_color.';
    }

	input::-webkit-input-placeholder,
	textarea::-webkit-input-placeholder {
		color: '.$header_font_color.';
	}
	input:-moz-placeholder,
	textarea:-moz-placeholder { /* Firefox 18- */
		color: '.$header_font_color.';
	}
	input::-moz-placeholder,
	textarea::-moz-placeholder {  /* Firefox 19+ */
		color: '.$header_font_color.';
	}
	input:-ms-input-placeholder,
	textarea:-ms-input-placeholder {
		color: '.$header_font_color.';
	}

    ';


    // footer styles
    $footer_text_color = gt3_option_compare('footer_text_color','mb_footer_switch','yes');
    $footer_heading_color = gt3_option_compare('footer_heading_color','mb_footer_switch','yes');
    $custom_css .= '.top_footer .widget-title,
    .top_footer .widget.widget_posts .recent_posts li > .recent_posts_content .post_title a,
    .top_footer .widget.widget_archive ul li > a,
	.top_footer .widget.widget_categories ul li > a,
	.top_footer .widget.widget_pages ul li > a,
	.top_footer .widget.widget_meta ul li > a,
	.top_footer .widget.widget_recent_comments ul li > a,
	.top_footer .widget.widget_recent_entries ul li > a,
	.top_footer strong{
    	color: '.esc_attr($footer_heading_color).' ;
    }
    .top_footer{
    	color: '.esc_attr($footer_text_color).';
    }';

    $copyright_text_color = gt3_option_compare('copyright_text_color','mb_footer_switch','yes');
    $custom_css .= '.main_footer .copyright{
    	color: '.esc_attr($copyright_text_color).';
    }';

    $header_on_bg = '';

    $header_color = gt3_option_compare('header_color','mb_customize_header_layout','custom');

    if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
	    if (rwmb_meta('mb_header_on_bg') == '1' && rwmb_meta('mb_customize_header_layout') == 'custom') {
	    	$header_on_bg = rwmb_meta('mb_header_on_bg');
	    	
	    	if ($header_on_bg == '1') {

    		/////////////////////////
	    	$side_top_background_mobile = $side_middle_background_mobile = $side_bottom_background_mobile = $side_top_color_mobile = $side_middle_color_mobile = $side_bottom_color_mobile = '';

	        $mb_customize_top_header_layout_mobile = rwmb_meta('mb_customize_top_header_layout_mobile'); 
	        $mb_customize_middle_header_layout_mobile = rwmb_meta('mb_customize_middle_header_layout_mobile'); 
	        $mb_customize_bottom_header_layout_mobile = rwmb_meta('mb_customize_bottom_header_layout_mobile'); 

	        if ($mb_customize_top_header_layout_mobile == 'custom') {
	        	//top
				$mb_top_header_background_mobile = rwmb_meta('mb_top_header_background_mobile');
	            $mb_top_header_background_opacity_mobile = rwmb_meta('mb_top_header_background_opacity_mobile');
	            $side_top_color_mobile = rwmb_meta('mb_top_header_color_mobile');
            
	            if (!empty($mb_top_header_background_mobile)) {
	                $side_top_background_mobile = 'rgba('.(gt3_HexToRGB($mb_top_header_background_mobile)).','.$mb_top_header_background_opacity_mobile.')';
	            }else{
	                $side_top_background_mobile = '';
	            }
	        }

	        if ($mb_customize_middle_header_layout_mobile == 'custom') {
	        	//middle
				$mb_middle_header_background_mobile = rwmb_meta('mb_middle_header_background_mobile');
	            $mb_middle_header_background_opacity_mobile = rwmb_meta('mb_middle_header_background_opacity_mobile');
	            $side_middle_color_mobile = rwmb_meta('mb_middle_header_color_mobile');
          
	            if (!empty($mb_middle_header_background_mobile)) {
	                $side_middle_background_mobile = 'rgba('.(gt3_HexToRGB($mb_middle_header_background_mobile)).','.$mb_middle_header_background_opacity_mobile.')';
	            }else{
	                $side_middle_background_mobile = '';
	            }
	        }

	        if ($mb_customize_bottom_header_layout_mobile == 'custom') {
	        	//bottom
				$mb_bottom_header_background_mobile = rwmb_meta('mb_bottom_header_background_mobile');
	            $mb_bottom_header_background_opacity_mobile = rwmb_meta('mb_bottom_header_background_opacity_mobile');
	            $side_bottom_color_mobile = rwmb_meta('mb_bottom_header_color_mobile');
          
	            if (!empty($mb_bottom_header_background_mobile)) {
	                $side_bottom_background_mobile = 'rgba('.(gt3_HexToRGB($mb_bottom_header_background_mobile)).','.$mb_bottom_header_background_opacity_mobile.')';
	            }else{
	                $side_bottom_background_mobile = '';
	            }
	        }
		    /////////////////////////////////





	    	}

	    }
	}

	$custom_css .= '
	.toggle-inner, .toggle-inner:before, .toggle-inner:after{
		background-color:'.esc_attr($header_color).';
	}';

    if ($header_on_bg == '1') {

    	$custom_css .= '@media only screen and (max-width: 767px){
    		.gt3_header_builder__section--top{
    			background-color: '.esc_attr($side_top_background_mobile).' !important;
		    	color: '.esc_attr($side_top_color_mobile).' !important;
    		}
    		.gt3_header_builder__section--middle{
    			background-color: '.esc_attr($side_middle_background_mobile).' !important;
		    	color: '.esc_attr($side_middle_color_mobile).' !important;
    		}
    		.gt3_header_builder__section--bottom{
    			background-color: '.esc_attr($side_bottom_background_mobile).' !important;
		    	color: '.esc_attr($side_bottom_color_mobile).' !important;
    		}
		}
	    ';
    }

    /* Woocommerce */

    $custom_css .= '
    ul.pagerblock li a:hover,
    .woocommerce nav.woocommerce-pagination ul li a:focus, 
    .woocommerce nav.woocommerce-pagination ul li a:hover,  
    .woocommerce-Tabs-panel h2,
    .woocommerce-Tabs-panel h2 span,
    .woocommerce ul.product_list_widget li .gt3-widget-product-wrapper .product-title,
    .woocommerce-cart .cart_totals h2,
    .woocommerce-checkout h3,
    .woocommerce-checkout h3 span,
    .gt3-shop-product .gt3-product-title {
    	font-family:' . $content_font_family . ';
    }

    .image_size_popup .size_guide_title,
    .image_size_popup .size_guide_block .wrapper_size_guide a,
    .easyzoom-flyout,
	.products.hover_bottom li.product:hover .gt3-product-info{
    	background:' . $bg_body . ';
    }

    .gt3-category-item__title,
    .image_size_popup .size_guide_title {
    	font-family: ' . $header_font_family . ';
    }

    .woocommerce ul.products li.product .price,
    .yith-wcwl-add-button .add_to_wishlist,
    .woocommerce .gt3-products-header .gridlist-toggle>a,
    .woocommerce ul.product_list_widget li .gt3-widget-product-wrapper .woocommerce-Price-amount,
    .widget.widget_product_categories ul li > a:hover,
    .widget.widget_product_categories ul li.current-cat > a,
    .woocommerce-cart .cart_totals table.shop_table .shipping-calculator-button,
    .widget.widget_product_categories ul.children li>a:hover,
    .woocommerce div.product p.price, 
    .woocommerce div.product span.price,
    .woocommerce div.product form.cart .button:hover,
    .main_wrapper .image_size_popup_button,
    .woocommerce .gt3_woocommerce_top_filter_button span:hover,
    .woocommerce .widget_layered_nav ul li.chosen a,
    body public-modal .public-hotspot-info-holder .public-hotspot-info .public-hotspot-info__btn-buy.snpt-cta-btn:hover>span,
	.product_share > a{
    	color: '.$theme_color2.';
    }
    .woocommerce ul.products li.product .price ins,
    .woocommerce #reviews .comment-reply-title,
    .woocommerce.single-product #respond #commentform .comment-form-rating label,
    .woocommerce ul.product_list_widget li .gt3-widget-product-wrapper .product-title,
    .woocommerce ul.product_list_widget li .gt3-widget-product-wrapper ins,
    .widget.widget_product_categories ul li > a,
    .widget.widget_product_categories ul li:before,
    .woocommerce table.shop_table thead th,
    .woocommerce table.shop_table td,
    .woocommerce-cart .cart_totals h2,
    .woocommerce form.woocommerce-checkout .form-row label,
    .woocommerce form.woocommerce-form-login .form-row label,
    .woocommerce-checkout h3,
    .woocommerce-checkout h3 span,
    .woocommerce form .form-row .required,
    .woocommerce table.woocommerce-checkout-review-order-table tfoot th,
    #add_payment_method #payment label,
	.woocommerce-cart #payment label, 
	.woocommerce-checkout #payment label,
    .woocommerce div.product .gt3-product_info-wrapper span.price ins {
    	color: '.$header_font_color.';
    }
    .gt3-category-item__title {
    	color: '.$header_font_color.' !important;
    }
    .woocommerce #reviews #respond input#submit, 
	.woocommerce #reviews a.button, 
	.woocommerce #reviews button.button, 
	.woocommerce #reviews input.button,
	body.woocommerce a.button,
	#yith-quick-view-close:after,
	#yith-quick-view-close:before,
	#yith-quick-view-content .slick-prev,
	#yith-quick-view-content .slick-next,
	.image_size_popup .close:hover:before,
	.image_size_popup .close:hover:after,
	.cross-sells .slick-prev,
	.cross-sells .slick-next,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #respond input#submit.alt:hover,  
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover {
		background-color: '.$theme_color.';
	}
	.woocommerce a.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce #respond input#submit,
	.woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce .woocommerce-message a.woocommerce-Button.button,
	.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover,
	.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover,
	.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,
	.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a{
		background-color: '.$theme_color.';
		border-color: '.$theme_color.';
	}

	.woocommerce a.button:hover,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.image_size_popup .size_guide_title,
	woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.gt3-woo-filter .product-filter.active,
	.gt3-woo-filter .product-filter:hover,
	#yith-quick-view-modal .woocommerce div.product p.price ins,
	.single-product.woocommerce div.product p.price ins,
	.woocommerce div.product .gt3-product_info-wrapper span.price ins,
	#yith-quick-view-content .product_meta,
	.single-product.woocommerce div.product .product_meta,
	.woocommerce div.product form.cart .variations td,
	.woocommerce div.product .gt3-single-product-sticky .woocommerce-tabs ul.tabs li.active a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.gt3-product-title_quantity,
	.woocommerce div.product form.cart .qty,
	.woocommerce-cart .cart_totals table.shop_table tr th,
	.woocommerce #respond input#submit:hover,  
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt,
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.widget_product_search .woocommerce-product-search:before,
	.gt3-product-outofstock .gt3-product-outofstock__inner,
	body div[id*="ajaxsearchlitesettings"].searchsettings .label,
	body .widget .yit-wcan-select-open,
	.woocommerce .widget_layered_nav ul.yith-wcan-label li a,
	.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a,
	.woocommerce .widget_layered_nav ul.yith-wcan-label li span,
	.woocommerce-page .widget_layered_nav ul.yith-wcan-label li span,
	.woocommerce div.product span.price ins,
	.gt3_social_links .gt3_social_icon span{
		color: '.$theme_color.';
	}

    .woocommerce ul.products li.product .onsale,
    .woocommerce div.product form.cart .button,
    .woocommerce .gt3-products-header .gridlist-toggle>a.active,
    .woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce nav.woocommerce-pagination ul li a:focus, 
    .woocommerce nav.woocommerce-pagination ul li a:hover, 
    .woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce div.product .woocommerce-tabs ul.tabs li a:before,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-cart table.cart td.actions>.button:hover,
	.woocommerce-cart .shipping-calculator-form .button:hover,
	#yith-quick-view-content .onsale,
    .woocommerce span.onsale,
	.woocommerce button.button.alt.disabled, 
	.woocommerce button.button.alt.disabled:hover,
	.yith-wcwl-add-button:hover,
    .woocommerce .gt3_woocommerce_top_filter_button span,
    body public-modal .public-hotspot-info-holder .public-hotspot-info .public-hotspot-info__btn-buy.snpt-cta-btn,
    .no-touch body .snpt-pict-item:hover .widget-hotspot,
    .no-touch body .snptwdgt__item:hover .widget-hotspot {
    	background-color: '.$theme_color2.';
    }
    .woocommerce div.product form.cart .button,
    .yith-wcwl-add-button:hover,
    .woocommerce .gt3_woocommerce_top_filter_button span,
    body public-modal .public-hotspot-info-holder .public-hotspot-info .public-hotspot-info__btn-buy.snpt-cta-btn {
    	border-color: '.$theme_color2.';
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li a:after {
    	border-bottom-color: '.$theme_color2.' !important;
    }



    body div[id*="ajaxsearchlitesettings"].searchsettings .option label:after,
	.woocommerce .widget_layered_nav ul li a::before,
	.woocommerce .widget_layered_nav_filters ul li a::before{
		-webkit-box-shadow: inset 0px 0px 0px 1px #e4e5de, inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 5px '.$theme_color2.';
		box-shadow: inset 0px 0px 0px 1px #e4e5de, inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 5px '.$theme_color2.';
	}
    body div[id*="ajaxsearchlitesettings"].searchsettings .option input[type=checkbox]:checked + label:after,
	.woocommerce .widget_layered_nav ul li.chosen a::before,
	.woocommerce .widget_layered_nav_filters ul li.chosen a::before{
		-webkit-box-shadow: inset 0px 0px 0px 1px #e4e5de, inset 0px 0px 0px 5px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
		box-shadow: inset 0px 0px 0px 1px #e4e5de, inset 0px 0px 0px 5px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
	}
    body div[id*="ajaxsearchlitesettings"].searchsettings .option label:hover:after,
	.woocommerce .widget_layered_nav ul li:hover a::before,
	.woocommerce .widget_layered_nav_filters ul li:hover a::before{
		-webkit-box-shadow: inset 0px 0px 0px 1px '.$theme_color2.', inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
		box-shadow: inset 0px 0px 0px 1px '.$theme_color2.', inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
	}
    body div[id*="ajaxsearchlitesettings"].searchsettings .option input[type=checkbox]:checked:hover + label:after,
	.woocommerce .widget_layered_nav ul li.chosen:hover a::before,
	.woocommerce .widget_layered_nav_filters ul li.chosen:hover a::before{
		-webkit-box-shadow: inset 0px 0px 0px 1px #a00, inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
		box-shadow: inset 0px 0px 0px 1px #a00, inset 0px 0px 0px 8px #fff, inset 0px 0px 0px 8px '.$theme_color2.';
	}
	.product-categories>li.cat-parent .gt3-button-cat-open:before,
	.yit-wcan-select-open::after{
		border-color: '.$theme_color2.' transparent transparent transparent;
	}
	body #ajaxsearchlite1 .probox,
	body div[id*="ajaxsearchlite"] .probox{
		border: 1px solid '.$theme_color2.' !important;
	}
	body div[id*="ajaxsearchlite"] .probox div.prosettings,
	body div[id*="ajaxsearchlite"] .probox .promagnifier,
	body div[id*="ajaxsearchliteres"].vertical{
		background-color: '.$theme_color2.' !important;
	}
	body div[id*="ajaxsearchlite"] .probox div.asl_simple-circle{
		border: 3px solid '.$theme_color2.' !important;
	}
	body div[id*="ajaxsearchlite"] .probox .proclose svg{
		fill: '.$theme_color.' !important;
	}

    ';
    
    /* ! Woocommerce */

    
    $custom_css .= '
    .gt3_header_builder__section--top{
    	background-color:'.esc_attr($side_top_background).';
    	color:'.esc_attr($side_top_color).';
    	height:'.(int)$side_top_height.'px;
    }
    .gt3_header_builder__section--top .gt3_header_builder__section-container{
    	height:'.(int)$side_top_height.'px;
    }
    .gt3_header_builder__section--middle{
    	background-color:'.esc_attr($side_middle_background).';
    	color:'.esc_attr($side_middle_color).';
    }
    .gt3_header_builder__section--middle .gt3_header_builder__section-container{
    	height:'.(int)$side_middle_height.'px;
    }
    .gt3_header_builder__section--bottom{
    	background-color:'.esc_attr($side_bottom_background).';
    	color:'.esc_attr($side_bottom_color).';
    }
    .gt3_header_builder__section--bottom .gt3_header_builder__section-container{
    	height:'.(int)$side_bottom_height.'px;
    }
    .tp-bullets.custom .tp-bullet:after,
    .tp-bullets.custom .tp-bullet:hover:after,
	.tp-bullets.custom .tp-bullet.selected:after {
		background: '.$theme_color2.';
	}
    ';

    /* List Wine */
    $custom_css .= '
	.main_wrapper ul.gt3_list_wine li:before{
    	content: url(\'data:image/svg+xml; utf8, <svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="40" fill="'.gt3_HexToRGB($theme_color2).'"><circle cx="10" cy="10" r="6" /><circle cx="30" cy="10" r="6" /><circle cx="20" cy="25" r="6" /></svg>\');
    }';

    if ($side_top_border) {
    	if (!empty($side_top_border_color['rgba'])) {
    		$custom_css .= '
		    .gt3_header_builder__section--top{
		    	border-bottom: 1px solid '.esc_attr($side_top_border_color['rgba']).';
		    }';
    	}
    }

    if ($side_middle_border) {
    	if (!empty($side_middle_border_color['rgba'])) {
    		$custom_css .= '
		    .gt3_header_builder__section--middle{
		    	border-bottom: 1px solid '.esc_attr($side_middle_border_color['rgba']).';
		    }';
    	}
    }

    if ($side_bottom_border) {
    	if (!empty($side_bottom_border_color['rgba'])) {
    		$custom_css .= '
		    .gt3_header_builder__section--bottom{
		    	border-bottom: 1px solid '.esc_attr($side_bottom_border_color['rgba']).';
		    }';
    	}
    }

    if ((bool)$header_sticky) {

    	if ((bool)$side_top_sticky) {
			$side_top_background_sticky = $side_top_background_sticky['rgba'];
			$side_top_height_sticky = $side_top_height_sticky['height'];
			$custom_css .= '
		    .sticky_header .gt3_header_builder__section--top{
		    	background-color:'.esc_attr($side_top_background_sticky).';
		    	color:'.esc_attr($side_top_color_sticky).';
		    }
		    .sticky_header .gt3_header_builder__section--top .gt3_header_builder__section-container{
		    	height:'.(int)$side_top_height_sticky.'px;
		    }';
    	}
    	
    	if ((bool)$side_middle_sticky) {
			$side_middle_background_sticky = $side_middle_background_sticky['rgba'];
			$side_middle_height_sticky = $side_middle_height_sticky['height'];
			$custom_css .= '
		    .sticky_header .gt3_header_builder__section--middle{
		    	background-color:'.esc_attr($side_middle_background_sticky).';
		    	color:'.esc_attr($side_middle_color_sticky).';
		    }
		    .sticky_header .gt3_header_builder__section--middle .gt3_header_builder__section-container{
		    	height:'.(int)$side_middle_height_sticky.'px;
		    }';
    	}		

    	if ((bool)$side_bottom_sticky) {
			$side_bottom_background_sticky = $side_bottom_background_sticky['rgba'];
			$side_bottom_height_sticky = $side_bottom_height_sticky['height'];
			$custom_css .= '
		    .sticky_header .gt3_header_builder__section--bottom{
		    	background-color:'.esc_attr($side_bottom_background_sticky).';
		    	color:'.esc_attr($side_bottom_color_sticky).';
		    }
		    .sticky_header .gt3_header_builder__section--bottom .gt3_header_builder__section-container{
		    	height:'.(int)$side_bottom_height_sticky.'px;
		    }';
    	}
    }
    
    /* Dark Theme */

    $custom_css .= '
	.gt3_dark_theme input[type="submit"]:hover,
	.gt3_dark_theme button:hover{
		background: '.$theme_color.';
		border-color: '.$theme_color.';
	}
	.gt3_dark_theme .gt3_module_button a:hover,
	.gt3_dark_theme .gt3_module_button a:hover .gt3_btn_icon.fa{
		border-color: '.$theme_color.';
	}
	.gt3_dark_theme .tagcloud a:hover{
		background-color: '.$theme_color.';
	}
    ';

    // WooCommerce
    $custom_css .= '
	.gt3_dark_theme .video-popup__link{
		background-color: '.$theme_color.';
		border-color: '.$theme_color.'!important;
	}

	.gt3_dark_theme .woocommerce ul.products li.product .gt3_woocommerce_open_controll_tag .button,
	.gt3_dark_theme .woocommerce a.button[class*="product_type_"],
	.gt3_dark_theme .woocommerce a.button.add_to_cart_button,
	.gt3_dark_theme .woocommerce a.button.yith-wcqv-button,
	.gt3_dark_theme .yith-wcwl-add-button{
		border-color: '.$theme_color.';
	}
	.woocommerce.gt3_dark_theme ul.products li.product .gt3_woocommerce_open_controll_tag .button,
	.woocommerce.gt3_dark_theme a.button[class*="product_type_"],
	.woocommerce.gt3_dark_theme a.button.add_to_cart_button,
	.woocommerce.gt3_dark_theme a.button.yith-wcqv-button,
	.woocommerce.gt3_dark_theme .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce.gt3_dark_theme .gt3-products-header .gridlist-toggle>a{
		border-color: '.$theme_color.';
	}
	.gt3_dark_theme .mc_form_inside #mc_signup_submit:hover,
	.gt3_dark_theme .pre_footer input[type="submit"]:hover,
	.gt3_dark_theme .woocommerce ul.products li.product .gt3_woocommerce_open_controll_tag .button:hover,
	.gt3_dark_theme .woocommerce ul.products li.product .gt3_woocommerce_open_controll_tag .added_to_cart:hover,
	.gt3_dark_theme .woocommerce a.button[class*="product_type_"]:hover,
	.gt3_dark_theme .woocommerce a.button.add_to_cart_button:hover,
	.gt3_dark_theme .woocommerce a.button.yith-wcqv-button:hover,
	.gt3_dark_theme .checkout_coupon input[type="submit"]:hover{
		border-color: '.$theme_color.';
    	background-color: '.$theme_color.';
	}
	.woocommerce.gt3_dark_theme ul.products li.product .gt3_woocommerce_open_controll_tag .button:hover,
	.woocommerce.gt3_dark_theme ul.products li.product .gt3_woocommerce_open_controll_tag .added_to_cart:hover,
	.woocommerce.gt3_dark_theme a.button[class*="product_type_"]:hover,
	.woocommerce.gt3_dark_theme a.button.add_to_cart_button:hover,
	.woocommerce.gt3_dark_theme a.button.yith-wcqv-button:hover{
		border-color: '.$theme_color.';
    	background-color: '.$theme_color.';
	}
	.gt3_dark_theme .woocommerce.widget_shopping_cart .buttons a:hover,
	.gt3_dark_theme .gt3_header_builder_cart_component .button:hover,
	.gt3_dark_theme .woocommerce.widget_shopping_cart .buttons a.checkout:hover,
	.gt3_dark_theme .gt3_header_builder_cart_component .button.checkout:hover{
		border-color: '.$theme_color.';
	}
	.woocommerce.gt3_dark_theme .widget_shopping_cart .buttons a:hover,
	.woocommerce.gt3_dark_theme .widget_shopping_cart .buttons a.checkout:hover{
		border-color: '.$theme_color.';
	}
	.woocommerce.gt3_dark_theme #respond input#submit:hover{
		border-color: '.$theme_color.';
	}

	.woocommerce.gt3_dark_theme div.product form.cart .variations select,
	.gt3_dark_theme .woocommerce div.product form.cart .variations select {
		color: '.$content_color.';
	}
	body.gt3_dark_theme #ajaxsearchlite1 .probox .proinput input,
	body.gt3_dark_theme div[id*="ajaxsearchlite"] .probox .proinput input{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme #ajaxsearchlite1 .probox .proinput input::-webkit-input-placeholder{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme div[id*="ajaxsearchlite"] .probox .proinput input::-webkit-input-placeholder{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme #ajaxsearchlite1 .probox .proinput input::-moz-placeholder{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme div[id*="ajaxsearchlite"] .probox .proinput input::-moz-placeholder{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme #ajaxsearchlite1 .probox .proinput input:-ms-input-placeholder{
		color: '.$content_color.'!important;
	}
	body.gt3_dark_theme div[id*="ajaxsearchlite"] .probox .proinput input:-ms-input-placeholder{
		color: '.$content_color.'!important;
	}

	body.gt3_dark_theme div[id*=\'ajaxsearchliteres\'] .results .item .asl_content .asl_desc{
		color: '.$content_color.';
	}
	body.gt3_dark_theme div[id*="ajaxsearchliteres"] .results .item .asl_content h3,
	body.gt3_dark_theme div[id*="ajaxsearchliteres"] .results .item .asl_content h3 a{
		color: '.$header_font_color.';
	}
	.woocommerce.gt3_dark_theme div.product .woocommerce-tabs ul.tabs li a{
		color: '.$content_color.';
	}
	.woocommerce.gt3_dark_theme div.product .gt3-single-product-sticky .woocommerce-tabs ul.tabs li.active a,
	.woocommerce.gt3_dark_theme div.product .gt3-single-product-sticky .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce.gt3_dark_theme div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce.gt3_dark_theme div.product .woocommerce-tabs ul.tabs li.active a:hover{
		color: '.$theme_color.';
	}
    .woocommerce.gt3_dark_theme ul.product_list_widget li .gt3-widget-product-wrapper del,
    .woocommerce.gt3_dark_theme table.shop_table td.product-price,
    .gt3_dark_theme .woocommerce table.shop_table td.product-price{
		color: '.$theme_color.';
	}
	.gt3_dark_theme .product_share > a:before{
		color: '.$theme_color.';
	}
	.gt3_dark_theme .woocommerce table.shop_table .product-quantity .qty{
		color: '.$theme_color.';
	}
	.woocommerce-cart.gt3_dark_theme table.cart td.actions>.button,
	.woocommerce-cart.gt3_dark_theme .shipping-calculator-form .button,
	.gt3_dark_theme .woocommerce #payment #place_order,
	.woocommerce-page.gt3_dark_theme #payment #place_order,
	.woocommerce-account.gt3_dark_theme .woocommerce input.button:hover,
	.woocommerce-account.gt3_dark_theme form.woocommerce-EditAccountForm>p>.woocommerce-Button:hover{
		border-color: '.$theme_color.';
	}
	.woocommerce-cart.gt3_dark_theme table.cart td.actions>.button:hover,
	.woocommerce-cart.gt3_dark_theme .shipping-calculator-form .button:hover,
	.gt3_dark_theme .woocommerce #payment #place_order:hover,
	.woocommerce-page.gt3_dark_theme #payment #place_order:hover,
	.woocommerce-account.gt3_dark_theme .woocommerce input.button:hover,
	.woocommerce-account.gt3_dark_theme form.woocommerce-EditAccountForm>p>.woocommerce-Button:hover{
		background-color: '.$theme_color.';
	}
	.gt3_dark_theme .products.hover_center li.product .gt3-product-thumbnail-wrapper:before {
    	background-color: rgba('.(gt3_HexToRGB($bg_body)).',0.95);
	}
	.gt3_dark_theme .products.hover_bottom li.product .gt3-product-info{
    	background: rgba('.(gt3_HexToRGB($bg_body)).',0.9);
	}
	.gt3_dark_theme .products.hover_bottom li.product:hover .gt3-product-info{
    	background: rgb('.(gt3_HexToRGB($bg_body)).');
	}

	

	';


    /* ! Dark Theme */


    $custom_user_css = gt3_option("custom_css");
    $custom_css .= isset($custom_user_css) ? '/* Custom Css */'.$custom_user_css : '';

	$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
	wp_add_inline_style( 'gt3_composer', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'gt3_custom_styles' );
