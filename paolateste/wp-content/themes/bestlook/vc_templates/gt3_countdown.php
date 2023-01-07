<?php
	$defaults = array(
		'icon_type' => 'font',
		'countdown_year' => '2017',
		'countdown_month' => '8',
		'countdown_day' => '14',
		'countdown_hours' => '12',
		'countdown_min' => '00',
        'show_seconds' => 'true',
        'show_day' => 'true',
        'show_hours' => 'true',
        'show_minutes' => 'true',
        'size' => '',
        'box_shadow' => '',
        'counter_bg' => '',
        'color' => '',
        'align' => '',
        'css_animation' => '',
	);

	wp_enqueue_script('gt3_coundown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, false);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

    $label_years = esc_html__('Years', 'wizestore');
    $label_months = esc_html__('Months', 'wizestore');
    $label_weeks = esc_html__('Weeks', 'wizestore');
    $label_days = esc_html__('Days', 'wizestore');
    $label_hours = esc_html__('Hours', 'wizestore');
    $label_minutes = esc_html__('Minutes', 'wizestore');
    $label_seconds = esc_html__('Seconds', 'wizestore');

    $label_year = esc_html__('Year', 'wizestore');
    $label_month = esc_html__('Month', 'wizestore');
    $label_week = esc_html__('Week', 'wizestore');
    $label_day = esc_html__('Day', 'wizestore');
    $label_hour = esc_html__('Hour', 'wizestore');
    $label_minute = esc_html__('Minute', 'wizestore');
    $label_second = esc_html__('Second', 'wizestore');

    $format = '';
    if ((bool)$show_day) {
        $format .= 'd';
    }
    if ((bool)$show_hours) {
        $format .= 'H';
    }
    if ((bool)$show_minutes) {
        $format .= 'M';
    }
    if ((bool)$show_seconds) {
        $format .= 'S';
    }

    if (!empty($format)) {
        $format = ' data-format="'.esc_attr($format).'"';
    }

    $item_style = '';
    if (!empty($counter_bg)) {
        $item_style .= 'background-color:'.esc_attr($counter_bg).';';
    }
    if (!empty($color)) {
        $item_style .= 'color:'.esc_attr($color).';';
    }

    $item_class = '';
    if ((bool)$box_shadow) {
        $item_class .= ' gt3-countdown--shadow';
    }
    if (!empty($size)) {
        $item_class .= ' gt3-countdown--size_'.$size;
    }

    $item_style = !empty($item_style) ? ' style="'.$item_style.'"' : '';

    // Animation
    if (! empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    } else {
        $animation_class = '';
    }

	$compile = '';
	$compile .= '<div class="countdown_wrapper '.esc_attr($animation_class).(!empty($align) ? ' countdown_wrapper--'.esc_attr($align) : '').'">
                    <div class="gt3-countdown'.esc_attr($item_class).'" '.$item_style.' data-year="'.esc_attr($countdown_year).'" data-month="'.esc_attr($countdown_month).'" data-day="'.esc_attr($countdown_day).'" data-hours="'.esc_attr($countdown_hours).'" data-min="'.esc_attr($countdown_min).'" data-label_years="'.esc_attr($label_years).'" data-label_months="'.esc_attr($label_months).'" data-label_weeks="'.esc_attr($label_weeks).'" data-label_days="'.esc_attr($label_days).'" data-label_hours="'.esc_attr($label_hours).'" data-label_minutes="'.esc_attr($label_minutes).'" data-label_seconds="'.esc_attr($label_seconds).'" data-label_year="'.esc_attr($label_year).'" data-label_month="'.esc_attr($label_month).'" data-label_week="'.esc_attr($label_week).'" data-label_day="'.esc_attr($label_day).'" data-label_hour="'.esc_attr($label_hour).'" data-label_minute="'.esc_attr($label_minute).'" data-label_second="'.esc_attr($label_second).'"'.$format.'></div>
                </div>';
	
	echo $compile;
?>
    
