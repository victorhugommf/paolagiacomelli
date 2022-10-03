<?php
include_once get_template_directory().'/vc_templates/gt3_google_fonts_render.php';

$compile = $title = $attach_image = $init_hotspot = $hotspot_action = $transition_delay = $item_el_class = $marker_pulse = $marker_style = $marker_circle_color_1 = $marker_circle_color_2 = $font_size = $responsive_font = $font_size_sm_desktop = $font_size_tablet = $font_size_mobile = $use_theme_fonts_marker = $google_fonts_marker_text = $marker_text_color_1 = $marker_text_bgcolor_2 = $marker_image = $marker_image_width = $tooltip_position = $tooltip_padding_1 = $tooltip_padding_2 = $tooltip_padding_3 = $tooltip_padding_4 = $tooltip_content_align = $tooltip_background = $tooltip_shadow = $tooltip_shadow_color = $tooltip_shadow_1 = $tooltip_shadow_2 = $tooltip_shadow_3 = $tooltip_shadow_4 = $use_google_fonts_tooltip_title = $google_fonts_tooltip_title = $tooltip_text_color_1 = $use_google_fonts_tooltip = $google_fonts_tooltip = $tooltip_text_color_2 = '';

$defaults = array(
	'title'                          => '',
	'attach_image'                   => '',
	'init_hotspot'                   => '',
	'hotspot_action'                 => 'hover',
	'animation_class'                => '',
	'transition_delay'               => 400,
	'item_el_class'                  => '',
	'marker_style'                   => 'circle',
	'tooltip_padding_1'              => 0,
	'tooltip_padding_2'              => 0,
	'tooltip_padding_3'              => 0,
	'tooltip_padding_4'              => 0,
	'marker_circle_color_1'          => 'rgba(229,98,94,0.37)',
	'marker_circle_color_2'          => '#e5625e',
	'marker_outer_width'             => 25,
	'marker_inner_width'             => 7,
	'marker_pulse'                   => 'true',
	'marker_pulse_duration'          => 2000,
	'marker_pulse_style'             => 'default',
	/*'marker_text' => '',*/
	'marker_font_size'               => '',
	'marker_line_height'             => 140,
	'responsive_font'                => '',
	'font_size_sm_desktop'           => '',
	'font_size_tablet'               => '',
	'font_size_mobile'               => '',
	'use_theme_fonts_marker'         => '',
	'google_fonts_marker_text'       => '',
	'marker_text_color_1'            => '#000000',
	'marker_text_bgcolor_2'          => '#ffffff',
	'marker_image'                   => '',
	'marker_image_width'             => 40,
	'marker_image_height'            => 40,
	'tooltip_position'               => 'tooltip-bottom',
	'tooltip_animation'              => 'tooltip_animation-slide',
	'tooltip_animation_time'         => 200,
	'tooltip_animation_function'     => 'easy-in',
	'tooltip_content_align'          => 'left',
	'tooltip_background'             => '#ffffff',
	'tooltip_width'                  => 300,
	'tooltip_shadow'                 => 'yes',
	'tooltip_shadow_color'           => '#eeeeee',
	'tooltip_shadow_1'               => '0',
	'tooltip_shadow_2'               => '0',
	'tooltip_shadow_3'               => '7',
	'tooltip_shadow_4'               => '0',
	'use_google_fonts_tooltip_title' => 'yes',
	'google_fonts_tooltip_title'     => '',
	'tooltip_text_color_1'           => '#000000',
	'use_google_fonts_tooltip'       => 'yes',
	'google_fonts_tooltip'           => '',
	'tooltip_text_color_2'           => '#6e6f69',
);
$atts     = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

if ( isset( $attach_image ) && ! empty( $attach_image ) ) {

	$data_atts = $el_class = $styles_marker = $marker_circle_1 = $marker_circle_2 = $markers = $marker = $count_markers = $marker_wrapper = $attr_tooltip = $styles_tooltip = $shadow_custom = $marker_pulse_wrap = $marker_pulse_class = '';

	// Title
	$title = ! empty( $title ) ? esc_attr( $title ) : '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array(
		'google_fonts_marker_text',
		'google_fonts_tooltip_title',
		'google_fonts_tooltip'
	) ) );
	$styles_marker_text   = ! empty( $styles_google_fonts_marker_text ) ? esc_attr( $styles_google_fonts_marker_text ) : '';
	$styles_tooltip_title = ! empty( $styles_google_fonts_tooltip_title ) ? esc_attr( $styles_google_fonts_tooltip_title ) : '';
	$styles_tooltip_text  = ! empty( $styles_google_fonts_tooltip ) ? esc_attr( $styles_google_fonts_tooltip ) : '';

	// Hotspot Data Init
	$data_atts .= ! empty( $init_hotspot ) ? ' data-hotspot-init="'.esc_attr( urldecode( $init_hotspot ) ).'"' : '';

	// Hotspot Action
	$el_class  .= ! empty( $hotspot_action ) ? ' hotspot_action-'.esc_attr( $hotspot_action ) : '';
	$data_atts .= ! empty( $hotspot_action ) ? ' data-hotspot_action='.esc_attr( $hotspot_action ) : '';

	// Animation
	$animation_class = ! empty( $css_animation ) ? $this->getCSSAnimation( $css_animation ) : '';

	// Element Class
	$el_class .= ! empty( $item_el_class ) ? ' '.esc_attr( $item_el_class ) : '';

	// Marker
	$styles_marker .= 'padding: ';
	$styles_marker .= ! empty( $tooltip_padding_1 ) ? esc_attr( (float) $tooltip_padding_1 ).'px ' : '0 ';
	$styles_marker .= ! empty( $tooltip_padding_2 ) ? esc_attr( (float) $tooltip_padding_2 ).'px ' : '0 ';
	$styles_marker .= ! empty( $tooltip_padding_3 ) ? esc_attr( (float) $tooltip_padding_3 ).'px ' : '0 ';
	$styles_marker .= ! empty( $tooltip_padding_4 ) ? esc_attr( (float) $tooltip_padding_4 ).'px;' : '0; ';

	// Marker Text Style
	$styles_marker_text .= ! empty( $marker_text_color_1 ) ? ' color:'.esc_attr( $marker_text_color_1 ).';' : '';
	$styles_marker_text .= ! empty( $marker_text_bgcolor_2 ) ? ' background-color:'.esc_attr( $marker_text_bgcolor_2 ).';' : '';
	$styles_marker_text .= ! empty( $marker_line_height ) ? ' line-height:'.(int) $marker_line_height.'%;' : '';

	// Marker Circle Style
	$marker_circle_1     .= ! empty( $marker_circle_color_1 ) ? 'background-color: '.$marker_circle_color_1.';' : '';
	$marker_circle_2     .= ! empty( $marker_circle_color_2 ) ? 'background-color: '.$marker_circle_color_2.';' : '';
		$marker_circle_2 .= ! empty( $marker_inner_width ) ? 'width: '.(int) $marker_inner_width.'px; height: '.(int) $marker_inner_width.'px;' : '';

		$marker_pos_fix = ! empty( $marker_outer_width ) ? 'margin-top: -'.(int) ( $marker_outer_width / 2 ).'px; margin-left: -'.(int) ( $marker_outer_width / 2 ).'px;' : '';

		// Marker Circle Pulse Style
		if ( $marker_pulse === 'true' ) {
			$marker_pulse_wrap  .= ! empty( $marker_outer_width ) ? 'width: '.(int) $marker_outer_width.'px; height: '.(int) $marker_outer_width.'px;' : '';
			$marker_pulse_class .= 'gt3_marker_pulse-'.( ! empty( $marker_pulse_style ) ? esc_attr( $marker_pulse_style ) : '' );
			if ( ! empty( $marker_pulse_duration ) ) {
				$marker_circle_1 .= '-webkit-animation-duration: '.(int) $marker_pulse_duration.'ms;';
				$marker_circle_1 .= '-moz-animation-duration: '.(int) $marker_pulse_duration.'ms;';
				$marker_circle_1 .= '-o-animation-duration: '.(int) $marker_pulse_duration.'ms;';
				$marker_circle_1 .= 'animation-duration: '.(int) $marker_pulse_duration.'ms;';
			}
		}

		// Tooltip Style
		$attr_tooltip   .= ! empty( $tooltip_position ) ? esc_attr( $tooltip_position ) : '';
		$styles_tooltip .= ! empty( $tooltip_content_align ) ? ' text-align:'.esc_attr( $tooltip_content_align ).';' : '';
		$styles_tooltip .= ! empty( $tooltip_background ) ? ' background-color:'.esc_attr( $tooltip_background ).';' : '';

		$styles_tooltip .= ! empty( $tooltip_width ) ? 'width: '.esc_attr( (float) $tooltip_width ).'px;' : '';

		$attr_tooltip .= ! empty( $tooltip_animation ) ? ' '.esc_attr( $tooltip_animation ) : '';
		if ( ! empty( $tooltip_animation_time ) ) {
			$styles_tooltip .= '-webkit-transition-duration: '.(int) $tooltip_animation_time.'ms;';
			$styles_tooltip .= '-moz-transition-duration: '.(int) $tooltip_animation_time.'ms;';
			$styles_tooltip .= '-o-transition-duration: '.(int) $tooltip_animation_time.'ms;';
			$styles_tooltip .= 'transition-duration: '.(int) $tooltip_animation_time.'ms;';
		}
		if ( ! empty( $tooltip_animation_function ) ) {
			$styles_tooltip .= '-webkit-transition-timing-function: '.esc_attr( $tooltip_animation_function ).';';
			$styles_tooltip .= '-moz-transition-timing-function: '.esc_attr( $tooltip_animation_function ).';';
			$styles_tooltip .= '-o-transition-timing-function: '.esc_attr( $tooltip_animation_function ).';';
			$styles_tooltip .= 'transition-timing-function: '.esc_attr( $tooltip_animation_function ).';';
		}

		if ( $tooltip_shadow == 'yes' ) {
			$styles_tooltip .= ' box-shadow: ';
			$styles_tooltip .= ! empty( $tooltip_shadow_1 ) ? esc_attr( (float) $tooltip_shadow_1 ).'px ' : '0 ';
			$styles_tooltip .= ! empty( $tooltip_shadow_2 ) ? esc_attr( (float) $tooltip_shadow_2 ).'px ' : '0 ';
			$styles_tooltip .= ! empty( $tooltip_shadow_3 ) ? esc_attr( (float) $tooltip_shadow_3 ).'px ' : '0 ';
			$styles_tooltip .= ! empty( $tooltip_shadow_4 ) ? esc_attr( (float) $tooltip_shadow_4 ).'px ' : '0 ';
			$styles_tooltip .= ! empty( $tooltip_shadow_color ) ? esc_attr( $tooltip_shadow_color ).';' : '0 ';
		}
		$styles_tooltip_title .= ! empty( $tooltip_text_color_1 ) ? ' color:'.esc_attr( $tooltip_text_color_1 ).';' : '';
		$styles_tooltip_text  .= ! empty( $tooltip_text_color_2 ) ? ' color:'.esc_attr( $tooltip_text_color_2 ).';' : '';

		// Marker Init
		$markers       = json_decode( urldecode( $init_hotspot ), true );
		$count_markers = count( $markers );
		if ( $count_markers > 0 ) {
			$styles_marker_text .= ! empty( $marker_font_size ) ? ' font-size:'.(int) $marker_font_size.'px;' : '';

			$gt3_marker_text_bool  = $marker_style == 'text'/* && !empty($marker_text)*/
			;
			$gt3_marker_image_bool = $marker_style == 'image' && isset( $marker_image ) && ! empty( $marker_image );

			if ( (bool) $gt3_marker_text_bool ) {
				$marker .= '<div class="hotspot_module hotspot_style-text">';
			} elseif ( (bool) $gt3_marker_image_bool ) {
				$marker .= '<div class="hotspot_module hotspot_style-image">';
			} else {
				$marker .= '<div class="hotspot_module hotspot_style-circle"> ';
			}

			$x = 0;
			while ( $x < $count_markers ) {
				$marker_wrapper_start = $marker_wrapper_end = '';
				$this_marker          = $markers[ $x ];
				$x ++;
				$delay           = $transition_delay * $x;
				$marker_pos      = 'left: '.esc_attr( round( $this_marker["x"], 2 ) ).'%; ';
				$marker_pos      .= 'top: '.esc_attr( round( $this_marker["y"], 2 ) ).'%; ';
				$animation_style = '';
				if ( ! empty( $atts['css_animation'] ) ) {
					$animation_style .= '-webkit-transition-delay: '.(int) $delay.'ms;';
					$animation_style .= '-moz-transition-delay: '.(int) $delay.'ms;';
					$animation_style .= '-o-transition-delay: '.(int) $delay.'ms;';
					$animation_style .= 'transition-delay: '.(int) $delay.'ms;';
					$animation_style .= '-webkit-animation-delay: '.(int) $delay.'ms;';
					$animation_style .= '-moz-animation-delay: '.(int) $delay.'ms;';
					$animation_style .= '-o-animation-delay: '.(int) $delay.'ms;';
					$animation_style .= 'animation-delay: '.(int) $delay.'ms;';
				}

				$marker_wrapper_start = '<div class="gt3_marker_wrapper" style="'.esc_attr( $marker_pos ).esc_attr( $marker_pos_fix ).'">';
				$marker_wrapper_start .= '<div class="gt3_marker" style="'.esc_attr( $styles_marker ).esc_attr( $marker_pos ).'">';
				$marker_wrapper_start .= '<div class="gt3_marker_animation_wrap '.esc_attr( $animation_class ).'" style="'.esc_attr( $animation_style ).'">';
				$marker_wrapper_end   .= '</div><!-- gt3_marker_animation_wrap -->';
				$marker_wrapper_end   .= '</div><!-- gt3_marker -->';
				if ( $hotspot_action !== 'only_marker' && ! empty( $this_marker["Title"] ) && ! empty( $this_marker["Message"] ) ) {
					$marker_wrapper_end .= '<div class="gt3_tooltip '.esc_attr( $attr_tooltip ).'" style="'.esc_attr( $styles_tooltip ).'">';
					$marker_wrapper_end .= '<a href="#" class="gt3-close" title="'.esc_html__( 'Close', 'wizestore' ).'"></a>';
					$marker_wrapper_end .= ! empty( $this_marker["Title"] ) ? '<h3 class="gt3_tooltip_title" style="'.esc_attr( $styles_tooltip_title ).'">'.esc_attr( $this_marker["Title"] ).'</h3>' : '';
					$marker_wrapper_end .= ! empty( $this_marker["Message"] ) ? '<div class="gt3_tooltip_message" style="'.esc_attr( $styles_tooltip_text ).'">'.wp_kses_post( $this_marker["Message"] ).'</div>' : '';
					$marker_wrapper_end .= '</div><!-- gt3_tooltip -->';
				}
				$marker_wrapper_end .= '</div><!-- gt3_marker_wrapper -->';

				// Marker Style
				if ( (bool) $gt3_marker_text_bool ) {
					$marker .= $marker_wrapper_start;
					$marker .= '<div class="gt3_marker_font_size" style="'.esc_attr( $styles_marker_text ).'">';
					if ( $responsive_font == 'true' ) {
						$marker .= ! empty( $font_size_sm_desktop ) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int) $font_size_sm_desktop.'px;">' : '';
						$marker .= ! empty( $font_size_tablet ) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int) $font_size_tablet.'px;">' : '';
						$marker .= ! empty( $font_size_mobile ) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int) $font_size_mobile.'px;">' : '';
					}

					$marker_text_loop = isset( $this_marker["Marker"] ) && ! empty( $this_marker["Marker"] ) ? esc_attr( $this_marker["Marker"] ) : '<span class="gt3_hotspot_blank_circle"></span>';
					$marker           .= $marker_text_loop;

					if ( $responsive_font == 'true' ) {
						$marker .= ! empty( $font_size_sm_desktop ) ? ' </div>' : '';
						$marker .= ! empty( $font_size_tablet ) ? ' </div>' : '';
						$marker .= ! empty( $font_size_mobile ) ? ' </div>' : '';
					}
					$marker .= '</div><!-- gt3_marker_font_size -->';
					$marker .= $marker_wrapper_end;
				} elseif ( (bool) $gt3_marker_image_bool ) {
					if ( ! empty( $marker_image_width ) && ! empty( $marker_image_height ) && $marker_image_width !== '0' && $marker_image_height !== '0' ) {
						$marker .= $marker_wrapper_start.'<div class="gt3_custom_image_marker">'.wp_get_attachment_image( $marker_image, array(
								(int) $marker_image_width,
								(int) $marker_image_height
							) ).'</div>'.$marker_wrapper_end;
					} else {
						$marker .= $marker_wrapper_start.'<div class="gt3_custom_image_marker">'.wp_get_attachment_image( $marker_image, 'full' ).'</div>'.$marker_wrapper_end;
					}
				} else {
					$marker .= $marker_wrapper_start;
					$marker .= '<div class="hotspot_style-circle_wrap '.esc_attr( $marker_pulse_class ).'" style="'.esc_attr( $marker_pulse_wrap ).'">';
					$marker .= '<div class="hotspot_style-circle_outer" style="'.esc_attr( $marker_circle_1 ).'"></div>';
					$marker .= '<div class="hotspot_style-circle_inner" style="'.esc_attr( $marker_circle_2 ).'"></div>';
					$marker .= $responsive_font == 'true' ? '<div class="hotspot_style-circle_animate"></div>' : '';

					$marker .= '</div> <!-- hotspot_style-circle_wrap -->';
					$marker .= $marker_wrapper_end;
				}
			}
			$marker .= '</div> <!-- hotspot_module-->';
		}

		// Hotspot Init
		$compile             .= '<div class="gt3-hotspot-shortcode-wrapper">';
			$compile         .= '<div class="gt3-hotspot-shortcode" '.$data_atts.'>';
				$compile     .= '<div class="gt3-hotspot-image-cover '.esc_attr( $el_class ).'">';
					$compile .= wp_get_attachment_image( $attach_image, 'full' );
					$compile .= $marker;
				$compile     .= '</div>';
			$compile         .= '</div>';
		$compile             .= '</div>';
	}

echo ''.$compile;