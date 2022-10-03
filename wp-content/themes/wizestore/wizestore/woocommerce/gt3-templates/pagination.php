<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $products;
?>
<!-- pagination -->
<nav class="woocommerce-pagination">
    <?php
        echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
            'format'       => '',
            'add_args'     => false,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $products->max_num_pages,
            'prev_text'    => '&larr;',
            'next_text'    => '&rarr;',
            'type'         => 'list',
            'end_size'     => 1,
            'mid_size'     => 2,
        ) ) );
    ?>
</nav>
<!-- ! pagination -->