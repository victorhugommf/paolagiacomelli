<?php


/**
* 
*/
class GT3Practice{

    private $shortcodeName;

    public function __construct() {
        $this->shortcodeName = 'gt3_practice_list';
        add_action('vc_before_init', array($this, 'shortcodesMap'));
        $this->addShortcode();
    }

	public function shortcodesMap(){
        if (function_exists('vc_map')) {
            vc_map( array(
                "name" => esc_html__("Project List", 'gt3_wize_core'),
                "base" => $this->shortcodeName,
                "class" => $this->shortcodeName,
                "category" => esc_html__('GT3 Modules', 'gt3_wize_core'),
                "icon" => 'gt3_icon',
                "content_element" => true,
                "description" => esc_html__("Project List",'gt3_wize_core'),
                "params" => array(
                    array(
                        'type' => 'loop',
                        'heading' => esc_html__('Project Items', 'gt3_wize_core'),
                        'param_name' => 'build_query',
                        'settings' => array(
                            'size' => array('hidden' => false, 'value' => 4 * 3),
                            'order_by' => array('value' => 'date'),
                            'post_type' => array('value' => 'team', 'hidden' => true),
                            'categories' => array('hidden' => true),
                            'tags' => array('hidden' => true),
                        ),
                        'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'gt3_wize_core')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Items Per Line', 'gt3_wize_core'),
                        'param_name' => 'posts_per_line',
                        'admin_label' => true,
                        'value' => array(
                            esc_html__("1", 'gt3_wize_core') => '1',
                            esc_html__("2", 'gt3_wize_core') => '2',
                            esc_html__("3", 'gt3_wize_core') => '3',
                            esc_html__("4", 'gt3_wize_core') => '4',
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Select style', 'gt3_wize_core'),
                        'param_name' => 'view_style',
                        'admin_label' => true,
                        'save_always' => true,
                        'value' => array(
                            esc_html__('Standard Pagination', 'gt3_wize_core') => "standard",
                            esc_html__('Ajax load more button', 'gt3_wize_core') => "ajax",
                        ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Filter', 'gt3_wize_core' ),
                        'param_name' => 'show_filter',
                        'value' => array( esc_html__( 'Yes', 'gt3_wize_core' ) => 'yes' ),
                        'std' => 'not',
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Pagination', 'gt3_wize_core' ),
                        'param_name' => 'show_pagination',
                        'value' => array( esc_html__( 'Yes', 'gt3_wize_core' ) => 'yes' ),
                        'std' => 'not',
                        'dependency' => array(
                            'element' => 'view_style',
                            "value" => "standard"
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Load More Button', 'gt3_wize_core' ),
                        'param_name' => 'show_loadmore',
                        'value' => array( esc_html__( 'Yes', 'gt3_wize_core' ) => 'yes' ),
                        'std' => 'not',
                        'dependency' => array(
                            'element' => 'view_style',
                            "value" => "ajax"
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Items on load', 'gt3_wize_core'),
                        'param_name' => 'items_load',
                        'value' => '4',
                        'save_always' => true,
                        'description' => esc_html__( 'Items load by load more button.', 'gt3_wize_core' ),
                        'dependency' => array(
                            'element' => 'show_loadmore',
                            "value" => "yes"
                        )
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Content', 'gt3_wize_core' ),
                        'param_name' => 'show_content',
                        'value' => array( esc_html__( 'Yes', 'gt3_wize_core' ) => 'yes' ),
                        'std' => 'yes',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Charts in content', 'gt3_wize_core'),
                        'param_name' => 'show_chart',
                        'value' => '85',
                        'save_always' => true,
                        'description' => esc_html__( 'Items load by load more button.', 'gt3_wize_core' ),
                        'dependency' => array(
                            'element' => 'show_content',
                            "value" => "yes"
                        )
                    ),
                    array( 
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Learn More Button', 'gt3_wize_core' ),
                        'param_name' => 'show_readmore',
                        'save_always' => true,
                        'value' => array( esc_html__( 'Yes', 'gt3_wize_core' ) => 'yes' ),
                        'std' => 'yes',
                    ),
                )
            ));
        }
    }

    public function addShortcode(){
        add_shortcode($this->shortcodeName, array($this, 'render'));
    }

    public function render($atts, $content = null){
        $args = array(
            'build_query' => '',
            "posts_per_line" => 1,
            "show_filter" => "",
            "view_style" => "standard",
            'items_load' => 4,
            "show_pagination" => "",
            "show_loadmore" => "",
            "show_content" => "yes",
            "show_chart" => 85,
            "show_readmore" => ""
        );

        wp_enqueue_style("font_awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
        
        $parameters = shortcode_atts($args, $atts);
        extract($parameters);
        list($query_args) = vc_build_loop_query($build_query);
        $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args['post_type'] = 'projects';

        $query_results = new WP_Query($query_args);
        $parameters['post_count'] = $query_results->post_count;
        
        $item_class = $this->grid_class($parameters);

        $out = '';
        $out .= '<div class="'.esc_attr($this->shortcodeName).'">';
            if ($view_style == "ajax") {
                wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
            }
            if ( (bool) $show_filter) {
               
                $out .= '<div class="'.esc_attr($this->shortcodeName).'__filter '.($view_style == "ajax" ? 'isotope-filter' : '').'">';
                    $out .= $this->getCategoriesOut($query_args);
                $out .= '</div>'; 
            }
            
            $out .= '<div class="'.esc_attr($this->shortcodeName).'__posts-container row '.($view_style == "ajax" ? 'isotope' : '' ).'">';
            if($query_results->have_posts()):   
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    $out .= gt3_get_practice_item($parameters, $item_class);
                endwhile;
            else:
                $out .= '<p>'. _e( 'Sorry, no posts matched your criteria.', 'gt3-wize-core' ) .'</p>';
            endif;  
            $out .= '</div>';

            wp_reset_postdata();
        $out .= '</div>';
        if ((bool) $show_pagination ) {
            global $wp_query, $paged;

            if(empty($paged)){
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }
            $selected_categories = '';
            if (isset($gt3_theme_pagebuilder['settings']['cat_ids']) && (is_array($gt3_theme_pagebuilder['settings']['cat_ids']))) {
                $compile_cats = array();
                foreach ($gt3_theme_pagebuilder['settings']['cat_ids'] as $catkey => $catvalue) {
                    array_push($compile_cats, $catkey);
                }
                $selected_categories = implode(",", $compile_cats);
            }
            $post_type_terms = array();
            $post_type_field = "id";
            if (isset($selected_categories) && strlen($selected_categories) > 0) {
                $post_type_terms = explode(",", $selected_categories);
                $post_type_filter = explode(",", $selected_categories);
                $post_type_field = "id";
            }
            $wp_query = $query_results;
            $out .= gt3_get_theme_pagination();
        }
        if ( (bool) $show_loadmore ) {
            $out .= $this->loadMorePractice ($parameters);
        }
        

        

        return $out;
    }

    public function grid_class ($parameters) {
        switch ($parameters['posts_per_line']) {
            case 1:
                $item_class = 'span12';
                break;
            case 2:
                $item_class = 'span6';
                break;
            case 3:
                $item_class = 'span4';
                break;
            case 4:
                $item_class = 'span3';
                break;
            default:
                $item_class = 'span12';
        }
        return $item_class;
    }

    public static function getImgUrl ($parameters, $wp_get_attachment_url) {
        if (strlen($wp_get_attachment_url)) {
            switch ($parameters['posts_per_line']) {
                case "1":
                    $gt3_featured_image_url = $wp_get_attachment_url;
                    break;
                case "2":
                    $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "1140", "1004", true, true, true);
                    break;
                case "3":
                    $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "740", "652", true, true, true);
                    break;
                case "4":
                    $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "540", "480", true, true, true);
                    break;
                default:
                    $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "1140", "1004", true, true, true);
            }
            $featured_image = '<img  src="' . $gt3_featured_image_url . '" alt="" />';
        } else {
            $featured_image = '';
        }
        return $featured_image;
    }

    public function getCategoriesOut($parameters){
        $data_category = isset($parameters['tax_query']) ? $parameters['tax_query'] : array();
        $include = array();
        $exclude = array();
        if (!is_tax()) {
            if (!empty($data_category) && $data_category[0]['operator'] === 'IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($include, $value);
                }
            } elseif (!empty($data_category) && $data_category[0]['operator'] === 'NOT IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($exclude, $value);
                }
            }    
        }
        
        $cats = get_terms(array(
                'taxonomy' => 'projects-category',
                'include' => $include,
                'exclude' => $exclude
            ));
        $out = '<a href="#" data-filter=".gt3_practice_list__item" class="active">All</a>';
        foreach ($cats as $cat) {
            $out .= '<a href="'.get_term_link($cat->term_id, 'projects-category').'" data-filter=".'.$cat->slug.'">';
            $out .= $cat->name;
            $out .= '</a>';
        }
        return $out;
    }

    public function loadMorePractice ($parameters) {
        extract($parameters);
        add_action('wp_ajax_get_portfolio_works', 'get_portfolio_works');
        add_action('wp_ajax_nopriv_get_portfolio_works', 'get_portfolio_works');
        wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
        wp_enqueue_script('gt3_img_js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), false, false);
        $x = json_encode($parameters);
        $x = esc_attr($x);
        $compile = '';
        $compile .= '</div><div class="clear"></div><div class="text-center gt3_module_button  button_alignment_center"><a href="' . esc_js("javascript:void(0)") . '" class="load_more_works shortcode_button button_size_normal">' . esc_html__("Load More", 'gt3_wize_core') . '</a></div></div>';

        $posts_per_page = 2;

        $GLOBALS['showOnlyOneTimeJS']['practice'] = '
            <script>
                (function($) {
                    "use strict";
                    var posts_already_showed = 0;
                    
                    jQuery(document).ready(function () {
                        jQuery("#list.sorting_block").addClass("overflow_hidden");

                        var overflowtimer = setTimeout(function () {
                            jQuery("#list.sorting_block").removeClass("overflow_hidden");
                            clearTimeout(overflowtimer);
                        }, 2000);
                        return false;
                    });
                    
                    jQuery(window).load(function () {
                        posts_already_showed = posts_already_showed + ' . $post_count . ';
                    });
                    
                    jQuery(".load_more_works").on("click", function(){
                        var is_pres = jQuery(this).parent().parent().find(".isotope")[0];
                        
                        gt3_get_posts("get_portfolio_practice", "projects", "' . $post_count . '", posts_already_showed,  "'.$posts_per_line.'", "' . $items_load . '", is_pres,"'.$x.'");
                        posts_already_showed = posts_already_showed + ' . $items_load . ';
                    });
                    function gt3_get_posts(action, post_type, posts_count, posts_already_showed, posts_per_line, posts_per_load, is_pres, param_str) {
                        jQuery.post(object_name.gt3_ajaxurl, {
                            action: action,
                            post_type: post_type,
                            posts_count: posts_count,
                            posts_already_showed:
                            posts_already_showed,
                            posts_per_line: posts_per_line,
                            posts_per_load: posts_per_load,
                            posts_param: param_str
                        })
                        .done(function (data) {
                            is_pres.setAttribute("data-post-showed", posts_already_showed);
                        if (data.length < 1) {
                            jQuery(".load_more_works").hide("fast");
                        }
                        var isotope_block = jQuery(is_pres).isotope({itemSelector: ".item-team-member, .gt3_practice_list__item"});
                        var items = jQuery(data);
                            isotope_block.isotope("insert", items).imagesLoaded().done(function() {
                                jQuery(is_pres).isotope({itemSelector: ".item-team-member, .gt3_practice_list__item"});
                            })
                                
                        });
                    }
                })(jQuery);
            </script>
            ';
            return $compile;
    }

}
add_action('wp_ajax_get_portfolio_practice', 'get_portfolio_practice');
add_action('wp_ajax_nopriv_get_portfolio_practice', 'get_portfolio_practice');
function get_portfolio_practice() {
    $post_type = esc_attr($_POST['post_type']);
    $now_open_works = absint($_POST['posts_already_showed']);
    $works_per_load = absint($_POST['posts_per_load']);
    $posts_per_line = absint($_POST['posts_per_line']);
    $posts_param_str = str_replace('&quot;', '"', $_POST['posts_param']);
    $posts_param_str = json_decode($posts_param_str, true);

    list($query_args) = vc_build_loop_query($posts_param_str["build_query"]);
    $args = array(
            'post_type' => $post_type,
            'order' => isset($query_args['order']) ? $query_args['order'] : 'DESC',
            'orderby' => isset($query_args['orderby']) ? $query_args['orderby'] : 'date',
            'post_status' => 'publish',
            'offset' => $now_open_works,
            'posts_per_page' => $works_per_load,
        );
    $query_results = new WP_Query($args);
    $out = '';
    $parameters = $posts_param_str;
    $item_class = GT3Practice::grid_class($parameters);
    while ( $query_results->have_posts() ) : $query_results->the_post(); 
        $out .= gt3_get_practice_item($parameters, $item_class);
    endwhile;
    
    wp_reset_postdata();
    echo $out;
    wp_die();
}

function gt3_get_practice_item ($parameters, $item_class) {
    $out = '';
    $post_cats = wp_get_post_terms(get_the_id(), 'projects-category');
        $post_cats_str = '';
            for ($i=0; $i<count( $post_cats ); $i++) {
                $post_cat_term = $post_cats[$i];
                $post_cat_name = $post_cat_term->slug;
                $post_cats_str .= ' '.$post_cat_name;
            }
        $item_class .= $post_cats_str;
        // set post options
        $p_id = get_the_ID();

        $content_post = get_post($p_id);
        // Letter Count
        if ((bool) $parameters["show_content"]) {
            $content_letter_count = isset($parameters["show_chart"]) ? $parameters["show_chart"] : 85;

            if (has_excerpt()) {
                $post_excerpt = get_the_excerpt();
            } else {
                $post_excerpt = get_the_content();
            }

            $post_excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_excerpt);
            $post_excerpt_without_tags = strip_tags($post_excerpt);

            if ($content_letter_count != '') {
                $post_descr = gt3_smarty_modifier_truncate($post_excerpt_without_tags, $content_letter_count, "...");
            } else {
                $post_descr = $post_excerpt_without_tags;
            }
            if ($content_letter_count == '0') {
                $post_descr = '';
            }
        } else {
            $post_descr = '';
        }

        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'single-post-thumbnail');

        $out .= '<article class="gt3_practice_list__item '.esc_attr($item_class).'">';
            $out .= '<div class="gt3_practice_list__image-holder">';
                $out .= GT3Practice::getImgUrl($parameters, $wp_get_attachment_url);
                $out .= '<a href="'.get_permalink().'" class="gt3_practice_list__overlay"><span class="gt3_practice_list__overlay-button"></span></a>';
            $out .= '</div>';
            $out .= '<div class="gt3_practice_list__content">';
                $out .= '<h4 class="gt3_practice_list__title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                $out .= !empty($post_descr) ? '<div class="gt3_practice_list__text">'.$post_descr.'</div>' : '';
                $out .= (bool) $parameters["show_readmore"] ? '<a href="'.get_permalink().'" class="gt3_practice_list__link learn_more">Learn More<span></span></a>' : '';
            $out .= '</div>';
        $out .= '</article>';
    return $out;
}


?>