<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search_form">
    <input class="search_text" type="text" name="s" placeholder="<?php esc_html_e('Search...', 'wizestore'); ?>" value="">
    <input class="search_submit" type="submit" value="<?php esc_html_e('Search', 'wizestore'); ?>">
    <?php

    $woocommerce_search = gt3_option('woocommerce_search');
    if( $woocommerce_search ){ ?>
    <input type="hidden" name="post_type" value="product" />
	<?php }; ?>
</form>