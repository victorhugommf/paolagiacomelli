<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_packery',
        'name' => esc_html__('Gallery Packery', 'wizestore'),
        "description" => esc_html__("Gallery Packery", 'wizestore'),
        'category' => esc_html__('GT3 Modules', 'wizestore'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('Add Images', 'wizestore'),
                'param_name' => 'images',
                'admin_label' => true,
                'description' => esc_html__('Select images from media library.', 'wizestore'),			
                'value' => ''
            ),
            array(
                "type" => "gt3_packery_layout_select",
                "heading" => esc_html__("Select Layout", 'wizestore'),
                "param_name" => "packery_layout",
				"val" => ''
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Layouts on First Load", 'wizestore'),
                "param_name" => "layouts_on_start",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Layouts on Load More", 'wizestore'),
                "param_name" => "layouts_per_load",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1'
            ),
			array(
                "type" => "textfield",
                "heading" => esc_html__("Button Title", 'wizestore'),
                "param_name" => "button_title",
				'edit_field_class' => 'vc_col-sm-6',
                "value" => esc_html__("Load More", 'wizestore')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Paddings around the images", 'wizestore'),
                "param_name" => "items_padding",
				'edit_field_class' => 'vc_col-sm-6',
				'description' => esc_html__('Please use this option to add paddings around the images. Recommended size in pixels 0-50. (Ex.: 15px):', 'wizestore'),
				'value' => '15px'
            ),
			array(
				'param_name' => 'custom_class',
				'heading' => esc_html__('Custom Class', 'wizestore'),
				'description' => '',
				'type' => 'textfield',
				'value' => '',
				'admin_label' => false,
				'weight' => 0,
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__('CSS', 'wizestore'),
				'param_name' => 'custom_css',
				'group' => esc_html__('Design options', 'wizestore'),
			)
			
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery_Packery extends WPBakeryShortCode
    {
    }
}