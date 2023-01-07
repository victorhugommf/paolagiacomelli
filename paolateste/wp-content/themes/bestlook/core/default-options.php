<?php
    function gt3_get_default_option(){
        $option = get_option( 'wize_default_options' );
        if (empty($option)) {
            $option = '{"last_tab":"","responsive":"1","page_comments":"1","preloader":"0","preloader_background":"#272f54","preloader_item_color":"#ffffff","back_to_top":"0","custom_css":"","custom_js":"jQuery(document).ready(function(){\r\n\r\n});","header_custom_js":"<script type=\'text/javascript\'>\r\njQuery(document).ready(function(){\r\n\r\n});\r\n</script>","header_background":{"color":"#272f54","alpha":"1","rgba":"rgba(39,47,84,1)"},"header_color":"#ffffff","header_height":{"height":"96"},"header_shadow":"","header_on_bg":"","mobile_background":{"color":"#ffffff","alpha":".9","rgba":"rgba(255,255,255,0.9)"},"mobile_color":"#848d95","header_top_background_set":"","header_top_background":{"color":"#000000","alpha":".5","rgba":"rgba(0,0,0,0.5)"},"header_top_color":"#ffffff","header_top_bottom_border":"1","header_top_bottom_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"top_header_bar_left":"","top_header_bar_left_editor":"","top_header_bar_right":"","top_header_bar_right_editor":"","bottom_header_bar_left":"","bottom_header_bar_left_editor":"","bottom_header_bar_right":"","bottom_header_bar_right_editor":"","bottom_header_layout":{"Items":{"placebo":"placebo","left_bar":"Left Bar","right_bar":"Right Bar"},"Left align side":{"placebo":"placebo","logo":"Logo"},"Center align side":{"placebo":"placebo"},"Right align side":{"placebo":"placebo","menu":"Menu"}},"bottom_header_vertical_order":"","page_title_conditional":"1","blog_title_conditional":"","page_title_breadcrumbs_conditional":"","page_title_vert_align":"middle","page_title_horiz_align":"center","page_title_font_color":"#000000","page_title_bg_color":"#ffffff","page_title_bg_image":{"background-repeat":"repeat","background-size":"cover","background-attachment":"scroll","background-position":"center center","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"page_title_height":{"height":"180"},"page_title_top_border":"1","page_title_top_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239,240,237,1)"},"page_title_bottom_border":"","page_title_bottom_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239,240,237,1)"},"page_title_bottom_margin":{"margin-bottom":"0"},"footer_full_width":"","footer_bg_color":"#ffffff","footer_text_color":"#94958d","footer_heading_color":"#000000","footer_bg_image":{"background-repeat":"repeat","background-size":"cover","background-attachment":"scroll","background-position":"center center","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"footer_switch":"1","footer_column":"5","footer_column2":"6-6","footer_column3":"4-4-4","footer_column5":"2-3-2-2-3","footer_align":"left","footer_spacing":{"padding-top":"70","padding-right":"0","padding-bottom":"40","padding-left":"0"},"copyright_switch":"","copyright_editor":"","copyright_align":"left","copyright_spacing":{"padding-top":"14","padding-right":"0","padding-bottom":"14","padding-left":"0"},"copyright_bg_color":"#ffffff","copyright_text_color":"#94958d","copyright_top_border":"1","copyright_top_border_color":{"color":"#2b4764","alpha":"1","rgba":"rgba(43,71,100,1)"},"pre_footer_switch":"0","pre_footer_editor":"","pre_footer_align":"center","pre_footer_spacing":{"padding-top":"20","padding-right":"0","padding-bottom":"20","padding-left":"0"},"pre_footer_bottom_border":"1","pre_footer_bottom_border_color":{"color":"#e0e1dc","alpha":"1","rgba":"rgba(224,225,220,1)"},"related_posts":"1","author_box":"0","post_comments":"1","post_pingbacks":"1","blog_post_likes":"1","blog_post_share":"1","blog_post_listing_content":"","page_sidebar_layout":"none","page_sidebar_def":"","blog_single_sidebar_layout":"none","blog_single_sidebar_def":"sidebar_main-sidebar","sidebars":["Main Sidebar","Menu Sidebar","Top Rated Products","Featured Products","Hot Sale","Shop Sidebar","Shop Sidebar Top"],"theme-custom-color":"#000000","theme-custom-color2":"#b1ba85","body-background-color":"#ffffff","menu-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","font-size":"13px","line-height":"19px"},"main-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","font-size":"14px","line-height":"24px","color":"#6e6f69"},"header-font":{"font-family":"Prata","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","color":"#000000"},"h1-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"","font-size":"36px","line-height":"43px"},"h2-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"","font-size":"30px","line-height":"40px"},"h3-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"","font-size":"24px","line-height":"36px"},"h4-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"","font-size":"18px","line-height":"30px"},"h5-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","font-size":"14px","line-height":"24px"},"h6-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","font-size":"12px","line-height":"18px","letter-spacing":""},"show_contact_widget":"","title_contact_widget":"","label_contact_icon":{"url":"","id":"","height":"","width":"","thumbnail":""},"label_contact_widget_color":{"color":"#2d628f","alpha":"1","rgba":"rgba(45,98,143,1)"},"shortcode_contact_widget":"","products_layout":"container","products_sidebar_layout":"none","products_sidebar_def":"","products_per_page":"9","woocommerce_def_columns":"4","product_layout":"","product_container":"container","sticky_thumb":"","product_sidebar_layout":"none","product_sidebar_def":"","gt3_header_builder_id":{"all_item":{"layout":"all","title":"All Item","content":{"placebo":"placebo","text4":{"title":"Text/HTML 4","has_settings":"1"},"text5":{"title":"Text/HTML 5","has_settings":"1"},"text6":{"title":"Text/HTML 6","has_settings":"1"},"delimiter1":{"title":"|"},"delimiter2":{"title":"|"},"delimiter3":{"title":"|"},"delimiter4":{"title":"|"},"delimiter5":{"title":"|"},"delimiter6":{"title":"|"},"text1":{"title":"Text/HTML 1","has_settings":"1"},"text2":{"title":"Text/HTML 2","has_settings":"1"},"text3":{"title":"Text/HTML 3","has_settings":"1"},"login":{"title":"Login"},"cart":{"title":"Cart"},"search":{"title":"Search"},"burger_sidebar":{"title":"Burger Sidebar","has_settings":"1"}}},"top_left":{"layout":"one-thirds","title":"Top Left","has_settings":"1","content":{"placebo":"placebo"}},"top_center":{"layout":"one-thirds","title":"Top Center","has_settings":"1","content":{"placebo":"placebo"}},"top_right":{"layout":"one-thirds","title":"Top Right","has_settings":"1","content":{"placebo":"placebo"}},"middle_left":{"layout":"one-thirds clear-item","title":"Middle Left","has_settings":"1","content":{"placebo":"placebo","logo":{"title":"Logo","has_settings":"1"}}},"middle_center":{"layout":"one-thirds","title":"Middle Center","has_settings":"1","content":{"placebo":"placebo"}},"middle_right":{"layout":"one-thirds","title":"Middle Right","has_settings":"1","content":{"placebo":"placebo","menu":{"title":"Menu","has_settings":"1"}}},"bottom_left":{"layout":"one-thirds clear-item","title":"Bottom Left","has_settings":"1","content":{"placebo":"placebo"}},"bottom_center":{"layout":"one-thirds","title":"Bottom Center","has_settings":"1","content":{"placebo":"placebo"}},"bottom_right":{"layout":"one-thirds","title":"Bottom Right","has_settings":"1","content":{"placebo":"placebo"}}},"header_full_width":"","header_sticky":"1","header_sticky_appearance_style":"classic","header_sticky_appearance_from_top":"auto","header_sticky_appearance_number":{"height":"300"},"header_sticky_shadow":"1","top_left-align":"left","top_center-align":"center","top_right-align":"right","middle_left-align":"left","middle_center-align":"center","middle_right-align":"right","bottom_left-align":"left","bottom_center-align":"center","bottom_right-align":"right","header_logo":{},"logo_height_custom":"1","logo_height":{"height":"41"},"logo_max_height":"","sticky_logo_height":{"height":""},"logo_sticky":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"menu_select":"","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#000000","burger_sidebar_select":"","side_top_background":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color":"#94958d","side_top_height":{"height":"40"},"side_top_border":"","side_top_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_top_sticky":"","side_top_background_sticky":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color_sticky":"#94958d","side_top_height_sticky":{"height":"38"},"side_top_mobile":"","side_middle_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color":"#000000","side_middle_height":{"height":"130"},"side_middle_border":"","side_middle_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_middle_sticky":"1","side_middle_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color_sticky":"#000000","side_middle_height_sticky":{"height":"90"},"side_middle_mobile":"1","side_bottom_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color":"#000000","side_bottom_height":{"height":"38"},"side_bottom_border":"","side_bottom_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_bottom_sticky":"","side_bottom_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color_sticky":"#000000","side_bottom_height_sticky":{"height":"38"},"side_bottom_mobile":"","text1_editor":"","text2_editor":"","text3_editor":"","text4_editor":"","text5_editor":"","text6_editor":"","redux-backup":1}';
            $option = json_decode($option,true);
            update_option( 'wize_default_options', $option );
        }
        //update_option( 'wize_default_options', '' );
    }
    gt3_get_default_option();
    if (  !class_exists( 'Redux' ) ) {
        function gt3_default_fonts(){
            $link = 'http://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CPrata:400&amp;subset=latin';
            wp_enqueue_style('gt3-default-font',$link);
        }
        add_action('wp_enqueue_scripts', 'gt3_default_fonts');
    }

    function gt3_header_presets(){
        $header_presets = array();
        $header_presets['header_preset_1'] = '{"gt3_header_builder_id":{"all_item":{"layout":"all","title":"All Item","content":{"placebo":"placebo","text4":{"title":"Text/HTML 4","has_settings":"1"},"text5":{"title":"Text/HTML 5","has_settings":"1"},"text6":{"title":"Text/HTML 6","has_settings":"1"},"delimiter1":{"title":"|"},"delimiter2":{"title":"|"},"delimiter3":{"title":"|"},"delimiter4":{"title":"|"},"delimiter5":{"title":"|"},"delimiter6":{"title":"|"}}},"top_left":{"layout":"one-thirds","title":"Top Left","has_settings":"1","content":{"placebo":"placebo","text1":{"title":"Text/HTML 1","has_settings":"1"}}},"top_center":{"layout":"one-thirds","title":"Top Center","has_settings":"1","content":{"placebo":"placebo","text2":{"title":"Text/HTML 2","has_settings":"1"}}},"top_right":{"layout":"one-thirds","title":"Top Right","has_settings":"1","content":{"placebo":"placebo","text3":{"title":"Text/HTML 3","has_settings":"1"}}},"middle_left":{"layout":"one-thirds clear-item","title":"Middle Left","has_settings":"1","content":{"placebo":"placebo","logo":{"title":"Logo","has_settings":"1"}}},"middle_center":{"layout":"one-thirds","title":"Middle Center","has_settings":"1","content":{"placebo":"placebo"}},"middle_right":{"layout":"one-thirds","title":"Middle Right","has_settings":"1","content":{"placebo":"placebo","menu":{"title":"Menu","has_settings":"1"},"login":{"title":"Login"},"cart":{"title":"Cart"},"search":{"title":"Search"},"burger_sidebar":{"title":"Burger Sidebar","has_settings":"1"}}},"bottom_left":{"layout":"one-thirds clear-item","title":"Bottom Left","has_settings":"1","content":{"placebo":"placebo"}},"bottom_center":{"layout":"one-thirds","title":"Bottom Center","has_settings":"1","content":{"placebo":"placebo"}},"bottom_right":{"layout":"one-thirds","title":"Bottom Right","has_settings":"1","content":{"placebo":"placebo"}}},"header_full_width":"","header_sticky":"1","header_sticky_appearance_style":"classic","header_sticky_appearance_from_top":"auto","header_sticky_appearance_number":{"height":"300"},"header_sticky_shadow":"1","top_left-align":"left","top_center-align":"center","top_right-align":"right","middle_left-align":"left","middle_center-align":"center","middle_right-align":"right","bottom_left-align":"left","bottom_center-align":"center","bottom_right-align":"right","header_logo":{"url":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo.png","id":"122","height":"82","width":"216","thumbnail":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo-150x82.png"},"logo_height_custom":"1","logo_height":{"height":"41"},"logo_max_height":"","sticky_logo_height":{"height":""},"logo_sticky":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"menu_select":"main-menu","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#000000","burger_sidebar_select":"sidebar_menu-sidebar","side_top_background":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color":"#94958d","side_top_height":{"height":"40"},"side_top_border":"","side_top_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_top_sticky":"","side_top_background_sticky":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color_sticky":"#94958d","side_top_height_sticky":{"height":"38"},"side_top_mobile":"","side_middle_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color":"#000000","side_middle_height":{"height":"130"},"side_middle_border":"1","side_middle_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239, 240, 237, 1)"},"side_middle_sticky":"1","side_middle_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color_sticky":"#000000","side_middle_height_sticky":{"height":"90"},"side_middle_mobile":"1","side_bottom_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color":"#000000","side_bottom_height":{"height":"38"},"side_bottom_border":"1","side_bottom_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239, 240, 237, 1)"},"side_bottom_sticky":"","side_bottom_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color_sticky":"#000000","side_bottom_height_sticky":{"height":"38"},"side_bottom_mobile":"","text1_editor":"<p>Contact us 24/7: +8 500 123 4567</p>","text2_editor":"<p><span style=\"font-weight: 500;\" class=\"gt3_font-weight\"><em>Express delivery and free returns within 28 days</em></span></p>","text3_editor":"<div class=\"gt3_currency_switcher\"><a href=\"#\">United States | $ USD English</a>\r\n<ul>\r\n<li><a href=\"#\">United States | $ USD</a></li>\r\n<li><a href=\"#\">European Union | &euro; EUR</a></li>\r\n<li><a href=\"#\">Great Britain | &pound; GBP</a></li>\r\n</ul>\r\n</div>","text4_editor":"","text5_editor":"","text6_editor":"","opt-presets":0,"header_top_style-start":"","header_top_style-end":"","search_shortcode":"","menu_shortcode":"","page_title-start":"","page_title-end":"","footer-start":"","footer-end":"","wbc_demo_importer":"","header_templates-start":"","header_templates-end":"","main_header_settings-start":"","main_header_settings-end":"","top_left-start":"","top_left-end":"","top_center-start":"","top_center-end":"","top_right-start":"","top_right-end":"","middle_left-start":"","middle_left-end":"","middle_center-start":"","middle_center-end":"","middle_right-start":"","middle_right-end":"","bottom_left-start":"","bottom_left-end":"","bottom_center-start":"","bottom_center-end":"","bottom_right-start":"","bottom_right-end":"","logo-start":"","logo-end":"","menu-start":"","menu-end":"","burger_sidebar-start":"","burger_sidebar-end":"","side_top-start":"","side_top-end":"","side_middle-start":"","side_middle-end":"","side_bottom-start":"","side_bottom-end":"","text1-start":"","text1-end":"","text2-start":"","text2-end":"","text3-start":"","text3-end":"","text4-start":"","text4-end":"","text5-start":"","text5-end":"","text6-start":"","text6-end":""}';

        $header_presets['header_preset_2'] = '{"gt3_header_builder_id":{"all_item":{"layout":"all","title":"All Item","content":{"placebo":"placebo","text4":{"title":"Text/HTML 4","has_settings":"1"},"text5":{"title":"Text/HTML 5","has_settings":"1"},"text6":{"title":"Text/HTML 6","has_settings":"1"},"delimiter1":{"title":"|"},"delimiter2":{"title":"|"},"delimiter3":{"title":"|"},"delimiter4":{"title":"|"},"delimiter5":{"title":"|"},"delimiter6":{"title":"|"}}},"top_left":{"layout":"one-thirds","title":"Top Left","has_settings":"1","content":{"placebo":"placebo","text1":{"title":"Text/HTML 1","has_settings":"1"}}},"top_center":{"layout":"one-thirds","title":"Top Center","has_settings":"1","content":{"placebo":"placebo","text2":{"title":"Text/HTML 2","has_settings":"1"}}},"top_right":{"layout":"one-thirds","title":"Top Right","has_settings":"1","content":{"placebo":"placebo","text3":{"title":"Text/HTML 3","has_settings":"1"}}},"middle_left":{"layout":"one-thirds clear-item","title":"Middle Left","has_settings":"1","content":{"placebo":"placebo","logo":{"title":"Logo","has_settings":"1"}}},"middle_center":{"layout":"one-thirds","title":"Middle Center","has_settings":"1","content":{"placebo":"placebo","menu":{"title":"Menu","has_settings":"1"}}},"middle_right":{"layout":"one-thirds","title":"Middle Right","has_settings":"1","content":{"placebo":"placebo","login":{"title":"Login"},"cart":{"title":"Cart"},"search":{"title":"Search"},"burger_sidebar":{"title":"Burger Sidebar","has_settings":"1"}}},"bottom_left":{"layout":"one-thirds clear-item","title":"Bottom Left","has_settings":"1","content":{"placebo":"placebo"}},"bottom_center":{"layout":"one-thirds","title":"Bottom Center","has_settings":"1","content":{"placebo":"placebo"}},"bottom_right":{"layout":"one-thirds","title":"Bottom Right","has_settings":"1","content":{"placebo":"placebo"}}},"header_full_width":"1","header_sticky":"1","header_sticky_appearance_style":"classic","header_sticky_appearance_from_top":"auto","header_sticky_appearance_number":{"height":"300"},"header_sticky_shadow":"1","top_left-align":"left","top_center-align":"center","top_right-align":"right","middle_left-align":"left","middle_center-align":"center","middle_right-align":"right","bottom_left-align":"left","bottom_center-align":"center","bottom_right-align":"right","header_logo":{"url":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo.png","id":"122","height":"82","width":"216","thumbnail":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo-150x82.png"},"logo_height_custom":"1","logo_height":{"height":"41"},"logo_max_height":"","sticky_logo_height":{"height":""},"logo_sticky":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"menu_select":"main-menu","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#000000","burger_sidebar_select":"sidebar_menu-sidebar","side_top_background":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color":"#94958d","side_top_height":{"height":"40"},"side_top_border":"","side_top_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_top_sticky":"","side_top_background_sticky":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color_sticky":"#94958d","side_top_height_sticky":{"height":"38"},"side_top_mobile":"","side_middle_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color":"#000000","side_middle_height":{"height":"130"},"side_middle_border":"1","side_middle_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239, 240, 237, 1)"},"side_middle_sticky":"1","side_middle_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color_sticky":"#000000","side_middle_height_sticky":{"height":"90"},"side_middle_mobile":"1","side_bottom_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color":"#000000","side_bottom_height":{"height":"38"},"side_bottom_border":"","side_bottom_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_bottom_sticky":"","side_bottom_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color_sticky":"#000000","side_bottom_height_sticky":{"height":"38"},"side_bottom_mobile":"","text1_editor":"<p>Contact us 24/7: +8 500 123 4567</p>","text2_editor":"<p><span style=\"font-weight: 500;\" class=\"gt3_font-weight\"><em>Express delivery and free returns within 28 days</em></span></p>","text3_editor":"<div class=\"gt3_currency_switcher\"><a href=\"#\">United States | $ USD English</a>\r\n<ul>\r\n<li><a href=\"#\">United States | $ USD</a></li>\r\n<li><a href=\"#\">European Union | &euro; EUR</a></li>\r\n<li><a href=\"#\">Great Britain | &pound; GBP</a></li>\r\n</ul>\r\n</div>","text4_editor":"","text5_editor":"","text6_editor":"","opt-presets":0,"header_top_style-start":"","header_top_style-end":"","search_shortcode":"","menu_shortcode":"","page_title-start":"","page_title-end":"","footer-start":"","footer-end":"","wbc_demo_importer":"","header_templates-start":"","header_templates-end":"","main_header_settings-start":"","main_header_settings-end":"","top_left-start":"","top_left-end":"","top_center-start":"","top_center-end":"","top_right-start":"","top_right-end":"","middle_left-start":"","middle_left-end":"","middle_center-start":"","middle_center-end":"","middle_right-start":"","middle_right-end":"","bottom_left-start":"","bottom_left-end":"","bottom_center-start":"","bottom_center-end":"","bottom_right-start":"","bottom_right-end":"","logo-start":"","logo-end":"","menu-start":"","menu-end":"","burger_sidebar-start":"","burger_sidebar-end":"","side_top-start":"","side_top-end":"","side_middle-start":"","side_middle-end":"","side_bottom-start":"","side_bottom-end":"","text1-start":"","text1-end":"","text2-start":"","text2-end":"","text3-start":"","text3-end":"","text4-start":"","text4-end":"","text5-start":"","text5-end":"","text6-start":"","text6-end":""}';

        $header_presets['header_preset_3'] = '{"gt3_header_builder_id":{"all_item":{"layout":"all","title":"All Item","content":{"placebo":"placebo","text4":{"title":"Text/HTML 4","has_settings":"1"},"text5":{"title":"Text/HTML 5","has_settings":"1"},"text6":{"title":"Text/HTML 6","has_settings":"1"},"delimiter1":{"title":"|"},"delimiter2":{"title":"|"},"delimiter3":{"title":"|"},"delimiter4":{"title":"|"},"delimiter5":{"title":"|"},"delimiter6":{"title":"|"}}},"top_left":{"layout":"one-thirds","title":"Top Left","has_settings":"1","content":{"placebo":"placebo","text1":{"title":"Text/HTML 1","has_settings":"1"}}},"top_center":{"layout":"one-thirds","title":"Top Center","has_settings":"1","content":{"placebo":"placebo","text2":{"title":"Text/HTML 2","has_settings":"1"}}},"top_right":{"layout":"one-thirds","title":"Top Right","has_settings":"1","content":{"placebo":"placebo","text3":{"title":"Text/HTML 3","has_settings":"1"}}},"middle_left":{"layout":"one-thirds clear-item","title":"Middle Left","has_settings":"1","content":{"placebo":"placebo"}},"middle_center":{"layout":"one-thirds","title":"Middle Center","has_settings":"1","content":{"placebo":"placebo","logo":{"title":"Logo","has_settings":"1"}}},"middle_right":{"layout":"one-thirds","title":"Middle Right","has_settings":"1","content":{"placebo":"placebo"}},"bottom_left":{"layout":"one-thirds clear-item","title":"Bottom Left","has_settings":"1","content":{"placebo":"placebo","login":{"title":"Login"},"cart":{"title":"Cart"}}},"bottom_center":{"layout":"one-thirds","title":"Bottom Center","has_settings":"1","content":{"placebo":"placebo","menu":{"title":"Menu","has_settings":"1"}}},"bottom_right":{"layout":"one-thirds","title":"Bottom Right","has_settings":"1","content":{"placebo":"placebo","search":{"title":"Search"},"burger_sidebar":{"title":"Burger Sidebar","has_settings":"1"}}}},"header_full_width":"0","header_sticky":"1","header_sticky_appearance_style":"classic","header_sticky_appearance_from_top":"auto","header_sticky_appearance_number":{"height":"300"},"header_sticky_shadow":"1","top_left-align":"left","top_center-align":"center","top_right-align":"right","middle_left-align":"left","middle_center-align":"center","middle_right-align":"right","bottom_left-align":"left","bottom_center-align":"center","bottom_right-align":"right","header_logo":{"url":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo.png","id":"122","height":"82","width":"216","thumbnail":"http://gt3demo.com/wp/wizestore/wp-content/uploads/sites/13/2017/04/logo-150x82.png"},"logo_height_custom":"1","logo_height":{"height":"41"},"logo_max_height":"","sticky_logo_height":{"height":""},"logo_sticky":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"menu_select":"main-menu","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#000000","burger_sidebar_select":"sidebar_menu-sidebar","side_top_background":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color":"#94958d","side_top_height":{"height":"40"},"side_top_border":"","side_top_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_top_sticky":"","side_top_background_sticky":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color_sticky":"#94958d","side_top_height_sticky":{"height":"38"},"side_top_mobile":"","side_middle_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color":"#000000","side_middle_height":{"height":"110"},"side_middle_border":"","side_middle_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_middle_sticky":"0","side_middle_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_middle_color_sticky":"#000000","side_middle_height_sticky":{"height":"90"},"side_middle_mobile":"1","side_bottom_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color":"#000000","side_bottom_height":{"height":"40"},"side_bottom_border":"","side_bottom_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239, 240, 237, 1)"},"side_bottom_sticky":"1","side_bottom_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color_sticky":"#000000","side_bottom_height_sticky":{"height":"58"},"side_bottom_mobile":"1","text1_editor":"<p>Contact us 24/7: +8 500 123 4567</p>","text2_editor":"<p><span style=\"font-weight: 500;\" class=\"gt3_font-weight\"><em>Express delivery and free returns within 28 days</em></span></p>","text3_editor":"<div class=\"gt3_currency_switcher\"><a href=\"#\">United States | $ USD English</a>\r\n<ul>\r\n<li><a href=\"#\">United States | $ USD</a></li>\r\n<li><a href=\"#\">European Union | &euro; EUR</a></li>\r\n<li><a href=\"#\">Great Britain | &pound; GBP</a></li>\r\n</ul>\r\n</div>","text4_editor":"","text5_editor":"","text6_editor":""}';
        /**
         * Dark header preset
         */
        $header_presets['header_preset_4'] = '{"gt3_header_builder_id":{"all_item":{"layout":"all","title":"All Item","content":{"placebo":"placebo","text4":{"title":"Text\/HTML 4","has_settings":"1"},"text5":{"title":"Text\/HTML 5","has_settings":"1"},"text6":{"title":"Text\/HTML 6","has_settings":"1"},"delimiter1":{"title":"|"},"delimiter2":{"title":"|"},"delimiter3":{"title":"|"},"delimiter4":{"title":"|"},"delimiter5":{"title":"|"},"delimiter6":{"title":"|"}}},"top_left":{"layout":"one-thirds","title":"Top Left","has_settings":"1","content":{"placebo":"placebo","text1":{"title":"Text\/HTML 1","has_settings":"1"}}},"top_center":{"layout":"one-thirds","title":"Top Center","has_settings":"1","content":{"placebo":"placebo","text2":{"title":"Text\/HTML 2","has_settings":"1"}}},"top_right":{"layout":"one-thirds","title":"Top Right","has_settings":"1","content":{"placebo":"placebo","text3":{"title":"Text\/HTML 3","has_settings":"1"}}},"middle_left":{"layout":"one-thirds clear-item","title":"Middle Left","has_settings":"1","content":{"placebo":"placebo","menu":{"title":"Menu","has_settings":"1"}}},"middle_center":{"layout":"one-thirds","title":"Middle Center","has_settings":"1","content":{"placebo":"placebo","logo":{"title":"Logo","has_settings":"1"}}},"middle_right":{"layout":"one-thirds","title":"Middle Right","has_settings":"1","content":{"placebo":"placebo","login":{"title":"Login"},"cart":{"title":"Cart"},"search":{"title":"Search"},"burger_sidebar":{"title":"Burger Sidebar","has_settings":"1"}}},"bottom_left":{"layout":"one-thirds clear-item","title":"Bottom Left","has_settings":"1","content":{"placebo":"placebo"}},"bottom_center":{"layout":"one-thirds","title":"Bottom Center","has_settings":"1","content":{"placebo":"placebo"}},"bottom_right":{"layout":"one-thirds","title":"Bottom Right","has_settings":"1","content":{"placebo":"placebo"}}},"header_full_width":"1","header_sticky":"1","header_sticky_appearance_style":"classic","header_sticky_appearance_from_top":"auto","header_sticky_appearance_number":{"height":"300"},"header_sticky_shadow":"0","top_left-align":"left","top_center-align":"center","top_right-align":"right","middle_left-align":"left","middle_center-align":"center","middle_right-align":"right","bottom_left-align":"left","bottom_center-align":"center","bottom_right-align":"right","header_logo":{"url":"http:\/\/gt3demo.com\/wp\/wizestore\/wp-content\/uploads\/sites\/13\/2017\/09\/logo_bright.png","id":"122","height":"82","width":"216","thumbnail":"http:\/\/gt3demo.com\/wp\/wizestore\/wp-content\/uploads\/sites\/13\/2017\/09\/logo_bright.png"},"logo_height_custom":"1","logo_height":{"height":"41"},"logo_max_height":"","sticky_logo_height":{"height":""},"logo_sticky":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"menu_select":"main-menu","menu_ative_top_line":"","sub_menu_background":{"color":"#1e212a","alpha":"1","rgba":"rgba(30,33,42,1)"},"sub_menu_color":"#ffffff","burger_sidebar_select":"sidebar_menu-sidebar","side_top_background":{"color":"#303031","alpha":"1","rgba":"rgba(48,48,49,1)"},"side_top_color":"#bebebe","side_top_height":{"height":"40"},"side_top_border":"","side_top_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_top_sticky":"0","side_top_background_sticky":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"side_top_color_sticky":"#94958d","side_top_height_sticky":{"height":"38"},"side_top_mobile":"","side_middle_background":{"color":"#1e212a","alpha":"1","rgba":"rgba(30,33,42,1)"},"side_middle_color":"#ffffff","side_middle_height":{"height":"130"},"side_middle_border":"0","side_middle_border_color":{"color":"#eff0ed","alpha":"1","rgba":"rgba(239,240,237,1)"},"side_middle_sticky":"1","side_middle_background_sticky":{"color":"#1e212a","alpha":"1","rgba":"rgba(30,33,42,1)"},"side_middle_color_sticky":"#ffffff","side_middle_height_sticky":{"height":"90"},"side_middle_mobile":"1","side_bottom_background":{"color":"#141518","alpha":"1","rgba":"rgba(20,21,24,1)"},"side_bottom_color":"#ffffff","side_bottom_height":{"height":"38"},"side_bottom_border":"","side_bottom_border_color":{"color":"#ffffff","alpha":".15","rgba":"rgba(255,255,255,0.15)"},"side_bottom_sticky":"","side_bottom_background_sticky":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"side_bottom_color_sticky":"#000000","side_bottom_height_sticky":{"height":"38"},"side_bottom_mobile":"","text1_editor":"<p>Contact us 24\/7: +8 500 123 4567 \u00a0 \u00a0\u00a0<\/p>","text2_editor":"<p><span style=\"font-weight: 500;\" class=\"gt3_font-weight\"><em>Express delivery and free returns within 28 days\u00a0<\/em><\/span><\/p>","text3_editor":"<div class=\"gt3_currency_switcher\"><a href=\"#\">United States | $ USD English<\/a>\r\n<ul>\r\n<li><a href=\"#\">United States | $ USD<\/a><\/li>\r\n<li><a href=\"#\">European Union | \u20ac EUR<\/a><\/li>\r\n<li><a href=\"#\">Great Britain | \u00a3 GBP<\/a><\/li>\r\n<\/ul>\r\n<\/div>","text4_editor":"","text5_editor":"","text6_editor":""}';
        return $header_presets;
    }
    
?>