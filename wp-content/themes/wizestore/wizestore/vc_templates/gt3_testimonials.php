<?php

$defaults = array(
    'view_type' => 'type1',
    'item_align' => 'center',
    'use_carousel' => true,
    'auto_play_time' => 4000,
    'posts_per_line' => '1',
    'text_color' => '',
    'sign_color' => '',
    'img_width' => '70',
    'img_height' => '70',
    'round_imgs' => true,
    'item_el_class' => '',
    'css' => '',
    'testimonilas_text_size' => '',
    'testimonilas_author_size' => '',
    'css_animation' => '',
);

wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$_POST['gt3_testimonials_opts'] = array(
    'text_color' => $text_color,
    'sign_color' => $sign_color,
    'view_type' => $view_type,
    'testimonilas_text_size' => $testimonilas_text_size,
    'testimonilas_author_size' => $testimonilas_author_size,
    'img_width' => $img_width,
    'img_height' => $img_height,
    'round_imgs' => $round_imgs
);

$compile = '';
$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$css_class .= $use_carousel ? " active-carousel" : "";
$fade = $view_type == "type4" ? true : false;
$posts_per_line = $view_type == 'type4' ? '1' : $posts_per_line;

$text_color_html = $sign_color_html = $title_color_html = '';
if ($text_color != '') {
    $text_color_html = ' style="color: '.$text_color.'"';
}
if ($sign_color != '') {
    $sign_color_html = ' style="color: '.$sign_color.'"';
}

if ($view_type == 'type4') {
    $css_class .= ' testimonials_align_'.esc_attr($item_align);
}

// Animation
if (! empty($atts['css_animation'])) {
    $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
} else {
    $animation_class = '';
}
$css_class .= ' '.esc_attr($animation_class);

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_testimonial <?php echo esc_attr($css_class). ' ' . esc_attr($view_type); ?> " data-slides-per-line="<?php echo esc_attr($posts_per_line);?>" data-slider-fade="<?php echo esc_attr($fade);?>" data-autoplay-time="<?php echo esc_attr($auto_play_time); ?>">
        <?php
        if ($view_type == 'type4') {
            echo "<span class='testimonials-photo-wrapper' style='max-width:".(3*(int)$img_width + 30)."px;'></span>";
        }
        ?>
    	<div class="module_content testimonials_list items<?php echo esc_attr($posts_per_line); ?>">
        <?php
            if ($use_carousel) echo '	
            <div class="testimonials_rotator">';
            else echo '<div class="testimonials-grid columns-'.esc_attr($posts_per_line).'">';

            $testimonial_info = $testimonial_nav = '';

            echo do_shortcode($content);

                if ($use_carousel) echo ''.$compile .
            '</div><div class="clear"></div>';
            else echo '</div>';

            ?>
        </div>
    </div>
</div>