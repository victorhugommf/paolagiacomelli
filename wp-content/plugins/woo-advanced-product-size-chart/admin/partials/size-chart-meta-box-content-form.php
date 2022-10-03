<?php

/**
 * Provide a admin area form view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    size-chart-for-woocommerce
 * @subpackage size-chart-for-woocommerce/admin/partials
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
// Add an nonce field so we can check for it later.
wp_nonce_field( 'size_chart_inner_custom_box', 'size_chart_inner_custom_box' );
$size_cart_post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
// Use get_post_meta to retrieve an existing value from the database.
$chart_label = scfw_size_chart_get_label_by_chart_id( $size_cart_post_id );
$chart_sub_title = scfw_size_chart_get_sub_title_by_chart_id( $size_cart_post_id );
$chart_tab_label = scfw_size_chart_get_tab_label_by_chart_id( $size_cart_post_id );
$chart_popup_label = scfw_size_chart_get_popup_label_by_chart_id( $size_cart_post_id );
$chart_position = scfw_size_chart_get_position_by_chart_id( $size_cart_post_id );
$chart_table = scfw_size_chart_get_chart_table_by_chart_id( $size_cart_post_id, false );
$table_style = scfw_size_chart_get_chart_table_style_by_chart_id( $size_cart_post_id );
$chart_attributes = scfw_size_chart_get_attributes( $size_cart_post_id );
// Display the form, using the current value.
$size_chart_img = scfw_size_chart_get_primary_chart_image_data_by_chart_id( $size_cart_post_id );
$image_id = $size_chart_img['attachment_id'];
$image_url = $size_chart_img['url'];
$img_width = $size_chart_img['width'];
$img_height = $size_chart_img['height'];
$close_icon_enable = $size_chart_img['close_icon_status'];
$is_disable = true;
?>
<div id="size-chart-meta-fields">
    <div id="field">
        <div class="field-title">
            <h4>
                <label for="label">
					<?php 
esc_html_e( 'Label', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Chart Label', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <input type="text" name="label" id="label" value="<?php 
echo  esc_attr( $chart_label ) ;
?>"/>
        </div>
    </div>

    <div id="field">
        <div class="field-title">
            <h4>
                <label for="size-chart-sub-title">
                    <?php 
esc_html_e( 'Sub Title', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
            <?php 
esc_html_e( 'Chart Sub Title', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <input type="text" name="size-chart-sub-title" id="size-chart-sub-title" value="<?php 
echo  esc_attr( $chart_sub_title ) ;
?>"/>
        </div>
    </div>

    <div id="field">
        <div class="field-title">
            <h4>
                <label for="primary-chart-image">
					<?php 
esc_html_e( 'Primary Chart Image', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Add/Edit primary chart image below', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <input type="hidden" name="primary-chart-image" id="primary-chart-image" value="<?php 
echo  esc_attr( $image_id ) ;
?>"/>
        </div>

        <div id="field-image">
            <div class="field_image_box">
                <img src="<?php 
echo  esc_url( $image_url ) ;
?>" width="<?php 
echo  esc_attr( $img_width ) ;
?>" height="<?php 
echo  esc_attr( $img_height ) ;
?>" id="meta_img" alt="<?php 
esc_attr_e( 'Primary Chart Image', 'size-chart-for-woocommerce' );
?>"/>
				<?php 

if ( true === $close_icon_enable ) {
    ?>
                    <a id="<?php 
    echo  esc_attr( $size_cart_post_id ) ;
    ?>" class="delete-chart-image">
                        <img src="<?php 
    echo  esc_url( plugins_url( 'images/close-icon.png', dirname( __FILE__ ) ) ) ;
    ?>" alt="<?php 
    esc_attr_e( 'close icon', 'size-chart-for-woocommerce' );
    ?>"/>
                    </a>
				<?php 
}

?>
            </div>
        </div>
        <div class="field-item">
            <input type="button" id="meta-image-button" class="button" data-uploader-title="<?php 
esc_attr_e( 'Select File', 'size-chart-for-woocommerce' );
?>" data-uploader-button-text="<?php 
esc_attr_e( 'Include File', 'size-chart-for-woocommerce' );
?>" value="<?php 
esc_attr_e( 'Upload', 'size-chart-for-woocommerce' );
?>"/>
        </div>
    </div>

    <div id="field">
        <div class="field-title">
            <h4>
                <label for="chart-attributes">
					<?php 
esc_html_e( 'Chart Attributes', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Select attributes for chart to appear on.', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <select name="chart-attributes[]" id="chart-attributes" multiple="multiple">
                <?php 
$all_attributes = wc_get_attribute_taxonomies();
if ( is_array( $all_attributes ) && !empty($all_attributes) ) {
    foreach ( $all_attributes as $attribute ) {
        ?>
                            <optgroup label="<?php 
        echo  esc_attr( $attribute->attribute_label ) ;
        ?>">
                                <?php 
        // Get its value for currnt attribute
        $attribute_values = get_terms( "pa_" . $attribute->attribute_name, array(
            'hide_empty' => false,
        ) );
        if ( !empty($attribute_values) ) {
            foreach ( $attribute_values as $value ) {
                ?>
                                            <option value="<?php 
                echo  esc_attr( $value->term_id ) ;
                ?>" <?php 
                selected( true, in_array( $value->term_id, $chart_attributes, true ), true );
                ?>>
                                                <?php 
                echo  esc_html( $value->name ) ;
                ?>
                                            </option>
                                        <?php 
            }
        }
        ?>
                            </optgroup>
                        <?php 
    }
}
?>
            </select>
        </div>
    </div>
    <div id="field">
        <div class="field-title">
            <h4>
                <label for="position">
					<?php 
esc_html_e( 'Chart Position', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Select if the chart will display as a popup or as a additional tab', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <select name="position" id="position">
                <option value="tab" <?php 
selected( $chart_position, 'tab', true );
?>><?php 
esc_html_e( 'Additional Tab', 'size-chart-for-woocommerce' );
?></option>
                <option value="popup" <?php 
selected( $chart_position, 'popup', true );
?>><?php 
esc_html_e( 'Modal Pop Up', 'size-chart-for-woocommerce' );
?></option>
            </select>
        </div>
    </div>
    <?php 
$defalut_chart_position = ( isset( $chart_position ) && '' !== $chart_position ? $chart_position : 'tab' );
?>
    <div id="field" class="chart-tab-field <?php 
echo  ( isset( $defalut_chart_position ) && 'tab' === $defalut_chart_position ? 'enable' : 'disable' ) ;
?>">
        <div class="field-title">
            <h4>
                <label for="chart-tab-label">
                    <?php 
esc_html_e( 'Tab Label', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
            <?php 
esc_html_e( 'Chart Tab Label', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <input type="text" name="chart-tab-label" id="chart-tab-label" value="<?php 
echo  esc_attr( $chart_tab_label ) ;
?>"/>
        </div>
    </div>
    <div id="field" class="chart-popup-field <?php 
echo  ( isset( $defalut_chart_position ) && 'popup' === $defalut_chart_position ? 'enable' : 'disable' ) ;
?>">
        <div class="field-title">
            <h4>
                <label for="chart-popup-label">
                    <?php 
esc_html_e( 'Popup Label', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
            <?php 
esc_html_e( 'Chart Popup Label', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <input type="text" name="chart-popup-label" id="chart-popup-label" value="<?php 
echo  esc_attr( $chart_popup_label ) ;
?>"/>
        </div>
    </div>
    <div id="field">
        <div class="field-title">
            <h4>
                <label for="table-style">
					<?php 
esc_html_e( 'Chart Table Style', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Chart Table Styles (Default Style)', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <select name="table-style" id="table-style">
                <option value="default-style" <?php 
selected( $table_style, 'default-style', true );
?>><?php 
esc_html_e( 'Default Style', 'size-chart-for-woocommerce' );
?></option>
                <option value="minimalistic" <?php 
selected( $table_style, 'minimalistic', true );
?>><?php 
esc_html_e( 'Minimalistic', 'size-chart-for-woocommerce' );
?></option>
                <option value="classic" <?php 
selected( $table_style, 'classic', true );
?>><?php 
esc_html_e( 'Classic', 'size-chart-for-woocommerce' );
?></option>
                <option value="modern" <?php 
selected( $table_style, 'modern', true );
?>><?php 
esc_html_e( 'Modern', 'size-chart-for-woocommerce' );
?></option>
                <option value="custom-style" <?php 
selected( $table_style, 'custom-style', true );
?> <?php 
disabled( $is_disable, true, true );
?> ><?php 
esc_html_e( 'Custom Style', 'size-chart-for-woocommerce' );
?></option>
            </select>
        </div>
    </div>
    <div id="field">
        <div class="field-title">
            <h4>
                <label for="chart-table">
					<?php 
esc_html_e( 'Chart Table', 'size-chart-for-woocommerce' );
?>
                </label>
            </h4>
        </div>
        <div class="field-description">
			<?php 
esc_html_e( 'Add/Edit chart below', 'size-chart-for-woocommerce' );
?>
        </div>
        <div class="field-item">
            <textarea id="chart-table" name="chart-table"><?php 
echo  esc_html( $chart_table ) ;
?></textarea>
        </div>
        <div class="field-item">
            <?php 
echo  sprintf(
    '<a id="%s" href="javascript:void(0);" class="preview_chart button button-primary" title="%s" rel="permalink">%s</a>',
    esc_attr( $size_cart_post_id ),
    esc_attr__( 'Click here for preview', 'size-chart-for-woocommerce' ),
    esc_attr__( 'Preview', 'size-chart-for-woocommerce' )
) ;
?>
        </div>
    </div>
</div>