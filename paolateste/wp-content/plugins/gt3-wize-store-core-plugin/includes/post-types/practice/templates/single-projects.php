<?php
$layout = gt3_option('page_sidebar_layout');
$sidebar = gt3_option('page_sidebar_def');
if (class_exists( 'RWMB_Loader' )) {
    $mb_layout = rwmb_meta('mb_page_sidebar_layout');
    if (!empty($mb_layout) && $mb_layout != 'default') {
        $layout = $mb_layout;
        $sidebar = rwmb_meta('mb_page_sidebar_def');
    }
}
$column = 12;
if ( $layout == 'left' || $layout == 'right' ) {
    $column = 9;
}else{
    $sidebar = '';
}
$row_class = ' sidebar_'.$layout;

get_header ();
?>

<div class="container">
    <div class="row<?php echo $row_class; ?>">
        <div class="content-container span<?php echo (int)$column; ?>">
            <section id='main_content'>
                <?php
                    while ( have_posts() ):
                        the_post();
                        if (get_post_thumbnail_id(get_the_id())) {
                            $post_img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
                            $post_img_url = aq_resize($post_img_url, "1170", "", true, true, true);
                            echo '<img src="'.esc_attr($post_img_url).'" class="gt3-single-practice_thumbnail" alt="">';
                        }

                        $page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no' ;

                        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                        $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional');
                              if ($mb_page_title_conditional == 'yes') {
                                  $page_title_conditional = 'yes';
                              }elseif($mb_page_title_conditional == 'no'){
                                  $page_title_conditional = 'no';
                              }
                        }

                        if ( $page_title_conditional != 'yes') {
                            echo '<h2>'.get_the_title().'</h2>';
                        }                        
                    endwhile;
                    the_content(esc_html__('Read more!', 'gt3_wize_core'));
                    wp_reset_postdata();
                ?>
            </section>

        </div>
        <?php
        if ($layout == 'left' || $layout == 'right') {
            echo '<div class="sidebar-container span'.(12 - (int)$column).'">';
                if (is_active_sidebar( $sidebar )) {
                    echo "<aside class='sidebar'>";
                    dynamic_sidebar( $sidebar );
                    echo "</aside>";
                }
            echo "</div>";
        }
        ?>
    </div>
    
</div>

<?php
get_footer();
/*} else {
    get_header();
?>
    <div class="wrapper_404 height_100percent pp_block">
        <div class="container text-center pp_container">
            <h1><?php echo esc_html__('Password Protected', 'gt3_wize_core'); ?></h1>
            <h2><?php echo esc_html__('This content is password protected. Please enter your password below to continue.', 'gt3_wize_core'); ?></h2>
            <?php the_content(); ?>
        </div>
    </div>
<?php 
    get_footer();
}*/ ?>