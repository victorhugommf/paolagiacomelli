<?php


if (!class_exists( 'RWMB_Loader' )) {
	return;
}



add_filter( 'rwmb_meta_boxes', 'gt3_pteam_meta_boxes' );
function gt3_pteam_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Team Options', 'wizestore' ),
        'post_types' => array( 'team' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
	            'name' => esc_html__( 'Member Job', 'wizestore' ),
	            'id'   => 'position_member',
	            'type' => 'text',
	            'class' => 'field-inputs'
	        ),

	        array(
	            'name' => esc_html__( 'Short Description', 'wizestore' ),
	            'id'   => 'member_short_desc',
	            'type' => 'textarea'
	        ),
			array(
				'name' => esc_html__( 'Fields', 'wizestore' ),
	            'id'   => 'social_url',
	            'type' => 'social',
	            'clone' => true,
	            'sort_clone'     => true,
	            'desc' => esc_html__( 'Description', 'wizestore' ),
	            'options' => array(
					'name'    => array(
						'name' => esc_html__( 'Title', 'wizestore' ),
						'type_input' => "text"
						),
					'description' => array(
						'name' => esc_html__( 'Text', 'wizestore' ),
						'type_input' => "text"
						),
					'address' => array(
						'name' => esc_html__( 'Url', 'wizestore' ),
						'type_input' => "text"
						),
				),
	        ),
	        array(
				'name'     => esc_html__( 'Icons', 'wizestore' ),
				'id'          => "icon_selection",
				'type'        => 'select_icon',
				'options'     => function_exists('gt3_get_all_icon') ? gt3_get_all_icon() : '',
				'clone' => true,
				'sort_clone'     => true,
				'placeholder' => esc_html__( 'Select an icon', 'wizestore' ),
				'multiple'    => false,
				'std'         => 'default',
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_blog_meta_boxes' );
function gt3_blog_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format Layout', 'wizestore' ),
		'post_types' => array( 'post' ),
		'context' => 'advanced',
		'fields'     => array(
			// Standard Post Format
			array(
				'name'             => esc_html__( 'You can use only featured image for this post-format', 'wizestore' ),
				'id'               => "post_format_standard",
				'type'             => 'static-text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','0'),
							array('post-format-selector-0','=','standard')
						),
					),
				),
			),
			// Gallery Post Format
			array(
				'name'             => esc_html__( 'Gallery images', 'wizestore' ),
				'id'               => "post_format_gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => '',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','gallery'),
							array('post-format-selector-0','=','gallery')
						),
					),
				),
			),
			// Video Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'wizestore' ),
				'id'   => "post_format_video_oEmbed",
				'desc' => esc_html__( 'enter URL', 'wizestore' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','video'),
							array('post-format-selector-0','=','video')
						),
						array(
							array('post_format_video_select','=','oEmbed')
						)
					),
				),
			),
			// Audio Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'wizestore' ),
				'id'   => "post_format_audio_oEmbed",
				'desc' => esc_html__( 'enter URL', 'wizestore' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','audio'),
							array('post-format-selector-0','=','audio')
						),
						array(
							array('post_format_audio_select','=','oEmbed')
						)
					),
				),
			),
			// Quote Post Format
			array(
				'name'             => esc_html__( 'Quote Author', 'wizestore' ),
				'id'               => "post_format_qoute_author",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Author Image', 'wizestore' ),
				'id'               => "post_format_qoute_author_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Quote Content', 'wizestore' ),
				'id'               => "post_format_qoute_text",
				'type'             => 'textarea',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			// Link Post Format
			array(
				'name'             => esc_html__( 'Link URL', 'wizestore' ),
				'id'               => "post_format_link",
				'type'             => 'url',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Link Text', 'wizestore' ),
				'id'               => "post_format_link_text",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),


		)
	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_page_layout_meta_boxes' );
function gt3_page_layout_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Layout', 'wizestore' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice', 'product' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Page Sidebar Layout', 'wizestore' ),
				'id'          => "mb_page_sidebar_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'none' => esc_html__( 'None', 'wizestore' ),
					'left' => esc_html__( 'Left', 'wizestore' ),
					'right' => esc_html__( 'Right', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Page Sidebar', 'wizestore' ),
				'id'          => "mb_page_sidebar_def",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_sidebar_layout','!=','default'),
						array('mb_page_sidebar_layout','!=','none'),
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_logo_meta_boxes' );
function gt3_logo_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Logo Options', 'wizestore' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Logo', 'wizestore' ),
				'id'          => "mb_customize_logo",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'             => esc_html__( 'Header Logo', 'wizestore' ),
				'id'               => "mb_header_logo",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_logo_height_custom',
				'name' => esc_html__( 'Enable Logo Height', 'wizestore' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Logo Height', 'wizestore' ),
				'id'   => "mb_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 50,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Don\'t limit maximum height', 'wizestore' ),
				'id'   => "mb_logo_max_height",
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Sticky Logo Height', 'wizestore' ),
				'id'   => "mb_sticky_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true),
						array('mb_logo_max_height','=',true),
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Sticky Logo', 'wizestore' ),
				'id'               => "mb_logo_sticky",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Mobile Logo', 'wizestore' ),
				'id'               => "mb_logo_mobile",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_header_option_meta_boxes' );
function gt3_header_option_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
        'title'      => esc_html__( 'Header Layout and Color', 'wizestore' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Header Settings', 'wizestore' ),
				'id'          => "mb_customize_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
					'none' => esc_html__( 'none', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			// Top header settings
			array(
				'name'     => esc_html__( 'Top Header Settings', 'wizestore' ),
				'id'          => "mb_customize_top_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Background', 'wizestore' ),
				'id'   => "mb_top_header_background",
				'type' => 'color',
				'std'         => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Background Opacity', 'wizestore' ),
				'id'   => "mb_top_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Text Color', 'wizestore' ),
				'id'   => "mb_top_header_color",
				'type' => 'color',
				'std'         => '#94958d',
				'js_options' => array(
					'defaultColor' => '#94958d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_top_header_bottom_border',
				'name' => esc_html__( 'Set Top Header Bottom Border', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Border color', 'wizestore' ),
				'id'   => "mb_header_top_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom'),
						array('mb_top_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Border Opacity', 'wizestore' ),
				'id'   => "mb_header_top_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom'),
						array('mb_top_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Middle Header Settings', 'wizestore' ),
				'id'          => "mb_customize_middle_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),

			// Middle header settings
			array(
				'name' => esc_html__( 'Middle Header Background', 'wizestore' ),
				'id'   => "mb_middle_header_background",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Background Opacity', 'wizestore' ),
				'id'   => "mb_middle_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Text Color', 'wizestore' ),
				'id'   => "mb_middle_header_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_middle_header_bottom_border',
				'name' => esc_html__( 'Set Middle Header Bottom Border', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Border color', 'wizestore' ),
				'id'   => "mb_header_middle_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom'),
						array('mb_middle_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Border Opacity', 'wizestore' ),
				'id'   => "mb_header_middle_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom'),
						array('mb_middle_header_bottom_border','=',true)
					)),
				),
			),

			// Bottom header settings
			array(
				'name'     => esc_html__( 'Bottom Header Settings', 'wizestore' ),
				'id'          => "mb_customize_bottom_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Background', 'wizestore' ),
				'id'   => "mb_bottom_header_background",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Background Opacity', 'wizestore' ),
				'id'   => "mb_bottom_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Text Color', 'wizestore' ),
				'id'   => "mb_bottom_header_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_bottom_header_bottom_border',
				'name' => esc_html__( 'Set Bottom Header Bottom Border', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Border color', 'wizestore' ),
				'id'   => "mb_header_bottom_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom'),
						array('mb_bottom_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Border Opacity', 'wizestore' ),
				'id'   => "mb_header_bottom_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom'),
						array('mb_bottom_header_bottom_border','=',true)
					)),
				),
			),





			//mobile options
			array(
				'id'   => 'mb_header_on_bg',
				'name' => esc_html__( 'Header Above Content', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 0,
			),



			// Mobile Top header settings
			array(
				'name'     => esc_html__( 'Top Mobile Header Settings', 'wizestore' ),
				'id'          => "mb_customize_top_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Background', 'wizestore' ),
				'id'   => "mb_top_header_background_mobile",
				'type' => 'color',
				'std'         => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Background Opacity', 'wizestore' ),
				'id'   => "mb_top_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Text Color', 'wizestore' ),
				'id'   => "mb_top_header_color_mobile",
				'type' => 'color',
				'std'         => '#94958d',
				'js_options' => array(
					'defaultColor' => '#94958d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),



			// Mobile Middle header settings
			array(
				'name'     => esc_html__( 'Middle Mobile Header Settings', 'wizestore' ),
				'id'          => "mb_customize_middle_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Background', 'wizestore' ),
				'id'   => "mb_middle_header_background_mobile",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Background Opacity', 'wizestore' ),
				'id'   => "mb_middle_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Text Color', 'wizestore' ),
				'id'   => "mb_middle_header_color_mobile",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),


			// Mobile Bottom header settings
			array(
				'name'     => esc_html__( 'Bottom Mobile Header Settings', 'wizestore' ),
				'id'          => "mb_customize_bottom_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Background', 'wizestore' ),
				'id'   => "mb_bottom_header_background_mobile",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Background Opacity', 'wizestore' ),
				'id'   => "mb_bottom_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Text Color', 'wizestore' ),
				'id'   => "mb_bottom_header_color_mobile",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),

        )

	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_header_meta_boxes' );
function gt3_header_meta_boxes( $meta_boxes ) {
	if (function_exists('gt3_header_presets')) {
		$presets = gt3_header_presets ();
		$presets_array = array();
		$i = 1;
		if (class_exists('ReduxFramework')) {
			$presets_array['default'] = esc_url(ReduxFramework::$_url) . 'assets/img/header_0.jpg';
			foreach ($presets as $key => $value) {
				$presets_array[$key] = esc_url(ReduxFramework::$_url) . 'assets/img/header_'.(int)$i.'.jpg';
				$i++;
			}
		}

	}else{
		$presets_array = array();
	}

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Header Builder', 'wizestore' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
			array(
				'name'     => esc_html__( 'Choose presets', 'wizestore' ),
				'id'          => "mb_header_presets",
				'type'        => 'image_select',
				'options'     => $presets_array,
				'multiple'    => false,
				'std'         => 'default',
			),
        )
    );
    return $meta_boxes;
}


add_filter( 'rwmb_meta_boxes', 'gt3_page_title_meta_boxes' );
function gt3_page_title_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Title Options', 'wizestore' ),
        'post_types' => array( 'page', 'post', 'team', 'practice' ),
        'context' => 'advanced',
        'fields'     => array(
			array(
				'name'     => esc_html__( 'Show Page Title', 'wizestore' ),
				'id'          => "mb_page_title_conditional",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'yes' => esc_html__( 'yes', 'wizestore' ),
					'no' => esc_html__( 'no', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name' => esc_html__( 'Page Sub Title Text', 'wizestore' ),
				'id'   => "mb_page_sub_title",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),
			array(
				'id'   => 'mb_show_breadcrumbs',
				'name' => esc_html__( 'Show Breadcrumbs', 'wizestore' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Vertical Alignment', 'wizestore' ),
				'id'       => 'mb_page_title_vertical_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'top' => esc_html__( 'top', 'wizestore' ),
					'middle' => esc_html__( 'middle', 'wizestore' ),
					'bottom' => esc_html__( 'bottom', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'middle',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Horizontal Alignment', 'wizestore' ),
				'id'       => 'mb_page_title_horizontal_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'left' => esc_html__( 'left', 'wizestore' ),
					'center' => esc_html__( 'center', 'wizestore' ),
					'right' => esc_html__( 'right', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Font Color', 'wizestore' ),
				'id'   => "mb_page_title_font_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'wizestore' ),
				'id'   => "mb_page_title_bg_color",
				'type' => 'color',
				'std'  => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Page Title Background Image', 'wizestore' ),
				'id'               => "mb_page_title_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Repeat', 'wizestore' ),
				'id'       => 'mb_page_title_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'wizestore' ),
					'repeat' => esc_html__( 'repeat', 'wizestore' ),
					'repeat-x' => esc_html__( 'repeat-x', 'wizestore' ),
					'repeat-y' => esc_html__( 'repeat-y', 'wizestore' ),
					'inherit' => esc_html__( 'inherit', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'wizestore' ),
				'id'       => 'mb_page_title_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'wizestore' ),
					'cover' => esc_html__( 'cover', 'wizestore' ),
					'contain' => esc_html__( 'contain', 'wizestore' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'wizestore' ),
				'id'       => 'mb_page_title_bg_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'wizestore' ),
					'scroll' => esc_html__( 'scroll', 'wizestore' ),
					'inherit' => esc_html__( 'inherit', 'wizestore' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'wizestore' ),
				'id'       => 'mb_page_title_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'wizestore' ),
					'left center' => esc_html__( 'left center', 'wizestore' ),
					'left bottom' => esc_html__( 'left bottom', 'wizestore' ),
					'center top' => esc_html__( 'center top', 'wizestore' ),
					'center center' => esc_html__( 'center center', 'wizestore' ),
					'center bottom' => esc_html__( 'center bottom', 'wizestore' ),
					'right top' => esc_html__( 'right top', 'wizestore' ),
					'right center' => esc_html__( 'right center', 'wizestore' ),
					'right bottom' => esc_html__( 'right bottom', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Height', 'wizestore' ),
				'id'   => "mb_page_title_height",
				'type' => 'number',
				'std'  => 200,
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_page_title_top_border',
				'name' => esc_html__( 'Set Page Title Top Border?', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Page Title Top Border Color', 'wizestore' ),
				'id'   => "mb_page_title_top_border_color",
				'type' => 'color',
				'std'         => '#eff0ed',
				'js_options' => array(
					'defaultColor' => '#eff0ed',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_top_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Page Title Top Border Opacity', 'wizestore' ),
				'id'   => "mb_page_title_top_border_color_opacity",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_top_border','=',true)
					)),
				),
			),

			array(
				'id'   => 'mb_page_title_bottom_border',
				'name' => esc_html__( 'Set Page Title Bottom Border?', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Page Title Bottom Border Color', 'wizestore' ),
				'id'   => "mb_page_title_bottom_border_color",
				'type' => 'color',
				'std'         => '#eff0ed',
				'js_options' => array(
					'defaultColor' => '#eff0ed',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Page Title Bottom Border Opacity', 'wizestore' ),
				'id'   => "mb_page_title_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_bottom_border','=',true)
					)),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_footer_meta_boxes' );
function gt3_footer_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Footer Options', 'wizestore' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Show Footer', 'wizestore' ),
				'id'          => "mb_footer_switch",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'yes' => esc_html__( 'yes', 'wizestore' ),
					'no' => esc_html__( 'no', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Footer Column', 'wizestore' ),
				'id'          => "mb_footer_column",
				'type'        => 'select',
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'multiple'    => false,
				'std'         => '4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 1', 'wizestore' ),
				'id'          => "mb_footer_sidebar_1",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 2', 'wizestore' ),
				'id'          => "mb_footer_sidebar_2",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 3', 'wizestore' ),
				'id'          => "mb_footer_sidebar_3",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 4', 'wizestore' ),
				'id'          => "mb_footer_sidebar_4",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 5', 'wizestore' ),
				'id'          => "mb_footer_sidebar_5",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3'),
						array('mb_footer_column','!=','4')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'wizestore' ),
				'id'          => "mb_footer_column2",
				'type'        => 'select',
				'options'     => array(
					'6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '75% / 25%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
				),
				'multiple'    => false,
				'std'         => '6-6',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','2')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'wizestore' ),
				'id'          => "mb_footer_column3",
				'type'        => 'select',
				'options'     => array(
					'4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
				),
				'multiple'    => false,
				'std'         => '4-4-4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','3')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'wizestore' ),
				'id'          => "mb_footer_column5",
				'type'        => 'select',
				'options'     => array(
                    '2-3-2-2-3' => '16% / 25% / 16% / 16% / 25%',
                    '3-2-2-2-3' => '25% / 16% / 16% / 16% / 25%',
                    '3-2-3-2-2' => '25% / 16% / 26% / 16% / 16%',
                    '3-2-3-3-2' => '25% / 16% / 16% / 25% / 16%',
				),
				'multiple'    => false,
				'std'         => '2-3-2-2-3',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','5')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Title Text Align', 'wizestore' ),
				'id'          => "mb_footer_align",
				'type'        => 'select',
				'options'     => array(
					'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
				),
				'multiple'    => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Top (px)', 'wizestore' ),
				'id'   => "mb_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 70,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Bottom (px)', 'wizestore' ),
				'id'   => "mb_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 70,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Left (px)', 'wizestore' ),
				'id'   => "mb_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Right (px)', 'wizestore' ),
				'id'   => "mb_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_footer_full_width',
				'name' => esc_html__( 'Full Width Footer', 'wizestore' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'wizestore' ),
				'id'   => "mb_footer_bg_color",
				'type' => 'color',
				'std'  => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Footer Text Color', 'wizestore' ),
				'id'   => "mb_footer_text_color",
				'type' => 'color',
				'std'  => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Footer Heading Color', 'wizestore' ),
				'id'   => "mb_footer_heading_color",
				'type' => 'color',
				'std'  => '#fafafa',
				'js_options' => array(
					'defaultColor' => '#fafafa',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Footer Background Image', 'wizestore' ),
				'id'               => "mb_footer_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Repeat', 'wizestore' ),
				'id'       => 'mb_footer_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'wizestore' ),
					'repeat' => esc_html__( 'repeat', 'wizestore' ),
					'repeat-x' => esc_html__( 'repeat-x', 'wizestore' ),
					'repeat-y' => esc_html__( 'repeat-y', 'wizestore' ),
					'inherit' => esc_html__( 'inherit', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'wizestore' ),
				'id'       => 'mb_footer_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'wizestore' ),
					'cover' => esc_html__( 'cover', 'wizestore' ),
					'contain' => esc_html__( 'contain', 'wizestore' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'wizestore' ),
				'id'       => 'mb_footer_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'wizestore' ),
					'scroll' => esc_html__( 'scroll', 'wizestore' ),
					'inherit' => esc_html__( 'inherit', 'wizestore' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'wizestore' ),
				'id'       => 'mb_footer_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'wizestore' ),
					'left center' => esc_html__( 'left center', 'wizestore' ),
					'left bottom' => esc_html__( 'left bottom', 'wizestore' ),
					'center top' => esc_html__( 'center top', 'wizestore' ),
					'center center' => esc_html__( 'center center', 'wizestore' ),
					'center bottom' => esc_html__( 'center bottom', 'wizestore' ),
					'right top' => esc_html__( 'right top', 'wizestore' ),
					'right center' => esc_html__( 'right center', 'wizestore' ),
					'right bottom' => esc_html__( 'right bottom', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),

			array(
				'id'   => 'mb_copyright_switch',
				'name' => esc_html__( 'Show Copyright', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Editor', 'wizestore' ),
				'id'   => "mb_copyright_editor",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Copyright Title Text Align', 'wizestore' ),
				'id'       => 'mb_copyright_align',
				'type'     => 'select',
				'options'  => array(
					'left' => esc_html__( 'left', 'wizestore' ),
					'center' => esc_html__( 'center', 'wizestore' ),
					'right' => esc_html__( 'right', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Top (px)', 'wizestore' ),
				'id'   => "mb_copyright_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Bottom (px)', 'wizestore' ),
				'id'   => "mb_copyright_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Left (px)', 'wizestore' ),
				'id'   => "mb_copyright_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Right (px)', 'wizestore' ),
				'id'   => "mb_copyright_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Background Color', 'wizestore' ),
				'id'   => "mb_copyright_bg_color",
				'type' => 'color',
				'std'  => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Text Color', 'wizestore' ),
				'id'   => "mb_copyright_text_color",
				'type' => 'color',
				'std'  => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_copyright_top_border',
				'name' => esc_html__( 'Set Copyright Top Border?', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Color', 'wizestore' ),
				'id'   => "mb_copyright_top_border_color",
				'type' => 'color',
				'std'         => '#2b4764',
				'js_options' => array(
					'defaultColor' => '#2b4764',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Opacity', 'wizestore' ),
				'id'   => "mb_copyright_top_border_color_opacity",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),

			//prefooter
			array(
				'id'   => 'mb_pre_footer_switch',
				'name' => esc_html__( 'Show Pre Footer Area', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Editor', 'wizestore' ),
				'id'   => "mb_pre_footer_editor",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Pre Footer Title Text Align', 'wizestore' ),
				'id'       => 'mb_pre_footer_align',
				'type'     => 'select',
				'options'  => array(
					'left' => esc_html__( 'left', 'wizestore' ),
					'center' => esc_html__( 'center', 'wizestore' ),
					'right' => esc_html__( 'right', 'wizestore' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Padding Top (px)', 'wizestore' ),
				'id'   => "mb_pre_footer_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Padding Bottom (px)', 'wizestore' ),
				'id'   => "mb_pre_footer_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Padding Left (px)', 'wizestore' ),
				'id'   => "mb_pre_footer_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Padding Right (px)', 'wizestore' ),
				'id'   => "mb_pre_footer_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_pre_footer_bottom_border',
				'name' => esc_html__( 'Set Pre Footer Bottom Border?', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Border Color', 'wizestore' ),
				'id'   => "mb_pre_footer_bottom_border_color",
				'type' => 'color',
				'std'         => '#f0f0f0',
				'js_options' => array(
					'defaultColor' => '#f0f0f0',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_pre_footer_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Pre Footer Border Opacity', 'wizestore' ),
				'id'   => "mb_pre_footer_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_pre_footer_bottom_border','=',true)
					)),
				),
			),
        ),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_preloader_meta_boxes' );
function gt3_preloader_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Preloader Options', 'wizestore' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Preloader', 'wizestore' ),
				'id'          => "mb_preloader",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'custom', 'wizestore' ),
					'none' => esc_html__( 'none', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name' => esc_html__( 'Preloader Background', 'wizestore' ),
				'id'   => "mb_preloader_background",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Preloader Item Color', 'wizestore' ),
				'id'   => "mb_preloader_item_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Preloader Logo', 'wizestore' ),
				'id'               => "mb_preloader_item_logo",
				'type'             => 'image_advanced',
				'size'		=> 'full',
				'max_file_uploads' => 1,
				'max_status' => true,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_preloader_full',
				'name' => esc_html__( 'Preloader Fullscreen', 'wizestore' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_contact_widget_meta_boxes' );
function gt3_contact_widget_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Contact Widget', 'wizestore' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Display Contact Widget', 'wizestore' ),
				'id'          => "mb_display_contact_widget",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'on' => esc_html__( 'On', 'wizestore' ),
					'off' => esc_html__( 'Off', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_shortcode_meta_boxes' );
function gt3_shortcode_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Shortcode Above Content', 'wizestore' ),
		'post_types' => array( 'page' ),
		'context' => 'advanced',
		'fields'     => array(
			array(
				'name' => esc_html__( 'Shortcode', 'wizestore' ),
				'id'   => "mb_page_shortcode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3
			),
		),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_single_product_meta_boxes' );
function gt3_single_product_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Single Product Settings', 'wizestore' ),
        'post_types' => array( 'product' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Single Product Page Settings', 'wizestore' ),
				'id'          => "mb_single_product",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'Custom', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			// Thumbnails Layout Settings
			array(
				'name'     => esc_html__( 'Thumbnails Layout', 'wizestore' ),
				'id'          => "mb_thumbnails_layout",
				'type'        => 'select',
				'options'     => array(
					'horizontal' => esc_html__( 'Thumbnails Bottom', 'wizestore' ),
					'vertical' => esc_html__( 'Thumbnails Left', 'wizestore' ),
					'thumb_grid' => esc_html__( 'Thumbnails Grid', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'horizontal',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_single_product','=','custom')
					)),
				),
			),

			array(
				'name'     => esc_html__( 'Product Page Layout', 'wizestore' ),
				'id'          => "mb_product_container",
				'type'        => 'select',
				'options'     => array(
					'container' => esc_html__( 'Container', 'wizestore' ),
					'full_width' => esc_html__( 'Full Width', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'container',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_single_product','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_sticky_thumb',
				'name' => esc_html__( 'Sticky Thumbnails', 'wizestore' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_single_product','=','custom')
					)),
				),
			),
        	array(
				'name'     => esc_html__( 'Size Guide for this product', 'wizestore' ),
				'id'          => "mb_img_size_guide",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'wizestore' ),
					'custom' => esc_html__( 'Custom', 'wizestore' ),
					'none' => esc_html__( 'None', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'id'   => 'mb_size_guide_icon',
				'name' => esc_html__( 'Size guide icon Image', 'wizestore' ),
				'type' => 'image_advanced',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_img_size_guide','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_size_guide',
				'name' => esc_html__( 'Size guide Popup Image', 'wizestore' ),
				'type' => 'image_advanced',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_img_size_guide','=','custom')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Image Size for Masonry Layout', 'wizestore' ),
				'id'          => "mb_img_size_masonry",
				'type'        => 'select',
				'options'     => array(
					'small_h_rect' => esc_html__( 'Small Horizontal Rectangle', 'wizestore' ),
					'large_h_rect' => esc_html__( 'Large Horizontal Rectangle', 'wizestore' ),
					'large_v_rect' => esc_html__( 'Large Vertical Rectangle', 'wizestore' ),
				),
				'multiple'    => false,
				'std'         => 'small_h_rect',
			),

        )
    );
    return $meta_boxes;
}

?>