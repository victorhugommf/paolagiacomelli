<?php

function gt3_get_product_name (){
    $product = 'WooCommerce Multipurpose Responsive WordPress Theme - WizeStore';
    return $product;
}

function gt3_registration($code = '',$action_type = 'register'){
    if (empty($code)) {
        $code = get_option( 'gt3_registration');
    }
    global $wp_version;
    $product = gt3_get_product_name();
    $my_theme = wp_get_theme();
    $version = $my_theme->get( 'Version' );
    $response = wp_remote_post('http://update.gt3themes.com/activate.php', array(
        'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
        'body' => array(
            'code' => urlencode(esc_attr($code)),
            'action_type' => urlencode($action_type),
            'version' => urlencode($version),
            'product' => urlencode($product)
        )
    ));

    $response_code = wp_remote_retrieve_response_code( $response );
    $version_info = wp_remote_retrieve_body( $response );

    if ( $response_code != 200 || is_wp_error( $version_info ) ) {
        return json_encode(array("respond"=>"Registration Connection error"));
    }

    return $version_info;
}

function gt3_account_activation($code = '',$email = ''){
    if (empty($code)) {
        $code = get_option( 'gt3_registration');
    }
    global $wp_version;
    $product = gt3_get_product_name();
    $my_theme = wp_get_theme();
    $version = $my_theme->get( 'Version' );

    if (!empty($email)) {
            $response = wp_remote_request('http://accounts.gt3themes.com?createnewuser=true&purchase_code='.urlencode(base64_encode($code)).'&item='.urlencode(base64_encode($product)).'&useremail=gt3themes'.urlencode(base64_encode($email)), array(
            'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
            'body' => array(
                'code' => urlencode($code),
                'version' => urlencode($version),
                'product' => urlencode($product)
            )
        ));

        $response_code = wp_remote_retrieve_response_code( $response );
        $version_info = wp_remote_retrieve_body( $response );

        if ( $response_code != 200 || is_wp_error( $version_info ) ) {
            $errore_return = new WP_Error( 'registration-error-connection-error', esc_html__( 'Registration Connection error', 'wizestore' ) );
            return json_encode($errore_return);
        }
    }else{
        $errore_return = new WP_Error( 'registration-error-invalid-email', esc_html__( 'Please provide a valid email address.', 'wizestore' ) );
        return json_encode($errore_return);
    }

    return $version_info;
}

function gt3_activation_check($code = '',$email = '',$check_is_linked = false){
    if (empty($code)) {
        $code = get_option( 'gt3_registration');
    }
    global $wp_version;
    $product = gt3_get_product_name();
    $my_theme = wp_get_theme();
    $version = $my_theme->get( 'Version' );

    if (!empty($email) || $check_is_linked) {
            $response = wp_remote_request('http://accounts.gt3themes.com?user_check=true&purchase_code='.urlencode(base64_encode($code)).'&item='.urlencode(base64_encode($product)).'&useremail=gt3themes'.urlencode(base64_encode($email)), array(
            'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
            'body' => array(
                'code' => urlencode($code),
                'version' => urlencode($version),
                'product' => urlencode($product)
            )
        ));

        $response_code = wp_remote_retrieve_response_code( $response );
        $version_info = wp_remote_retrieve_body( $response );

        if ( $response_code != 200 || is_wp_error( $version_info ) ) {
            $errore_return = new WP_Error( 'registration-error-connection-error', esc_html__( 'Registration Connection error', 'wizestore' ) );
            return json_encode($errore_return);
        }
    }else{
        $errore_return = new WP_Error( 'registration-error-invalid-email', esc_html__( 'Please provide a valid email address.', 'wizestore' ) );
        return json_encode($errore_return);
    }

    return $version_info;
}



if (get_option( 'gt3_registration_status') != 'active' && class_exists( 'Gt3_wize_core' )) {
    add_action( 'admin_notices', 'gt3_registration_notice' );
}

function gt3_get_support_time_left(){
    $time_left = array();
    $supported_until = get_option('gt3_registration_supported_until');
    if (!empty($supported_until)) {        
        $date_format = get_option( 'date_format' );
        $supported_until = strtotime($supported_until);
        $current_time = current_time('timestamp');
        $time_left['expired'] = false;
        if (($supported_until - $current_time) < (3600 * 24 * 7)) {
            $time_left['notice_srart'] = true;
        }
        if ($supported_until < $current_time) {
            $time_left['expired'] = true;
        }
        $time_left['time_to_left'] = human_time_diff($supported_until, $current_time);
        return $time_left;
    }else{
        return $time_left;  
    }
}

add_action( 'admin_print_styles', 'gt3_support_notice' );

function gt3_support_notice(){   
    if (get_option('gt3_supported_notice_srart') == 'true' && class_exists( 'Gt3_wize_core' )) {
        add_action( 'admin_notices', 'gt3_registration_notice_supported_until');
    } 
}

function gt3_registration_notice() {
  ?>
  <div class="notice notice-error" style="background-color: #d54e21; color: #ffffff; border-radius: 4px; padding: 10px 25px 10px 75px;position: relative;border-left: none;">
    <i class="fa fa-exclamation" aria-hidden="true" style="position: absolute; top: 50%; left: 15px; margin-top: -22px;font-size: 25px; line-height: 40px; width: 40px;text-align: center; border: 2px solid;border-radius: 40px;"></i>
    <p style="font-size: 1.4em;font-weight: 500;margin-bottom: 0;"><?php esc_html_e( 'Purchase Validation! Please activate your theme.', 'wizestore' ); ?></p>
    <div style="margin-bottom: 10px;"><a class="button button-primary" href="admin.php?page=<?php echo is_child_theme() == true ? 'Wizestore-Child' : 'Wizestore' ?>&tab=18" style="color: #ffffff;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;"><?php esc_html_e( 'Register Now', 'wizestore' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a> <a target="_blank" class="button button-primary" href="http://themeforest.net/cart/add_items?item_ids=19999516&ref=gt3themes" style="color: #ffffff;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;"><?php esc_html_e( 'Buy Theme', 'wizestore' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
  </div>
  <?php
}

function gt3_registration_notice_supported_until() {
    $support_time_left = gt3_get_support_time_left();
    if (!empty($support_time_left['notice_srart']) && $support_time_left['notice_srart']) {
        $gt3_tmeme_id = get_option( 'gt3_tmeme_id' );
        if (!empty($gt3_tmeme_id)) {
            $theme_link = 'https://themeforest.net/checkout/from_item/'.(int)$gt3_tmeme_id.'?license=regular&size=source&support=renew_6month';
        }else{
            $theme_link = 'https://themeforest.net/user/gt3themes/portfolio?ref=gt3themes';
        }
  ?>
    <div class="notice notice-error is-dismissible" style="background-color: #d54e21; color: #ffffff; border-radius: 4px; padding: 10px 25px 10px 75px;position: relative;border-left: none;">
        <i class="fa fa-exclamation" aria-hidden="true" style="position: absolute; top: 50%; left: 15px; margin-top: -22px;font-size: 25px; line-height: 40px; width: 40px;text-align: center; border: 2px solid;border-radius: 40px;"></i>
        <p style="font-size: 1.4em;font-weight: 500;margin-bottom: 0;"><?php 
        if (!empty($support_time_left['expired']) && $support_time_left['expired'] == true) {
            esc_html_e( 'Your support package for this theme expired', 'wizestore' ); ?><?php echo " ( ".$support_time_left['time_to_left']." ".esc_html( 'ago', 'wizestore' )." ).";
        }else{
            esc_html_e( 'Your support package for this theme is about to expire', 'wizestore' ); ?><?php echo " ( ".$support_time_left['time_to_left']." ".esc_html( 'left', 'wizestore' )." )."; 
        }     
        ?></p>
        <div style="margin-bottom: 10px;"><a class="button button-primary" href="<?php echo $theme_link; ?>" style="color: #ffffff;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;"><?php esc_html_e( 'Update Support Package', 'wizestore' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a> <a class="button button-primary" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'gt3-hide-notice', 'notice_srart' ), 'gt3_hide_notices_nonce', '_gt3_notice_nonce' ) ); ?>" style="color: #ffffff;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;"><?php esc_html_e( 'Dismiss this notice', 'wizestore' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
    </div>
  <?php
    }
}

add_action( 'wp_loaded', 'gt3_hide_hotice' );

function gt3_hide_hotice (){
    if ( isset( $_GET['gt3-hide-notice'] ) && isset( $_GET['_gt3_notice_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_GET['_gt3_notice_nonce'], 'gt3_hide_notices_nonce' ) ) {
            wp_die( __( 'Action failed. Please refresh the page and retry.', 'wizestore' ) );
        }
        $hide_notice = sanitize_text_field( $_GET['gt3-hide-notice'] );
        update_option( 'gt3_supported_'.$hide_notice , 'false' );
    }
}

if (get_option('gt3_supported_account_notice_srart') != 'false' 
    && get_option( 'gt3_registration_status') == 'active' 
    && class_exists( 'Gt3_wize_core' ) 
    && get_option( 'gt3_account_attached' ) != 'true') {
    add_action( 'admin_notices', 'gt3_account_notice' );
}
function gt3_account_notice(){    
    ?>
  <div class="notice notice-warning" style="padding: 10px">
    <p><strong><?php esc_html_e( 'Create account and manage your theme purchase codes.', 'wizestore' ) ?></strong></p>
    <p><strong><a href="admin.php?page=<?php echo is_child_theme() == true ? 'Wizestore-Child' : 'Wizestore' ?>&tab=18"><?php esc_html_e( 'Register Now', 'wizestore' ); ?></a> |  <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'gt3-hide-notice', 'account_notice_srart' ), 'gt3_hide_notices_nonce', '_gt3_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss this notice', 'wizestore' ); ?></a></strong></p>
  </div>
  <?php
}

//  Autoupdate theme
function gt3_check_theme_update ( $transient ){
    $slug = basename( get_template_directory() );
    $slug = 'wizestore';
    global $wp_version;

    if ( empty( $transient->checked ) || empty( $transient->checked[ $slug ] ) || ! empty( $transient->response[ $slug ] ) ) {
        return $transient;
    }    

    $product = gt3_get_product_name();
    $purchase_code = gt3_option('gt3_registration_id');
    if (is_array($purchase_code)) {
        $purchase_code = $purchase_code['puchase_code'];
    }
    $response = wp_remote_post('http://update.gt3themes.com/upgrade.php', array(
        'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
        'body' => array(
            'code' => urlencode($purchase_code),
            'slug' => urlencode($slug),
            'product' => urlencode($product)
        )
    ));

    $response_code = wp_remote_retrieve_response_code( $response );
    $version_info = wp_remote_retrieve_body( $response );    

    if ( $response_code != 200 || is_wp_error( $version_info ) ) {
        return $transient;
    }

    $response = json_decode($version_info,true);
    if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) 
    && version_compare( $transient->checked[ $slug ], $response['transient']['new_version'], '<') ) {
        $transient->response[ $slug ] = (array) $response['transient'];
    }

    return $transient;
}
if (gt3_option('gt3_auto_update')) {
    add_action( 'pre_set_site_transient_update_themes', 'gt3_check_theme_update', 100 );
}
