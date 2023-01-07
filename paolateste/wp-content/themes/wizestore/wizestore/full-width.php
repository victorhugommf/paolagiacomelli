<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
if ( !post_password_required() ) {
	get_header();
	the_post();
?>
	
    <?php
    $layout = gt3_option('page_sidebar_layout');
    $sidebar = gt3_option('page_sidebar_def');
    if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
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
    $row_class = ' sidebar_'.esc_attr($layout);
    ?>

    <div class="container-full-width">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container span<?php echo (int)$column; ?>">
                <section id='main_content'>
                <?php
                    the_content(esc_html__('Read more!', 'wizestore'));
                    wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'wizestore') . ': ', 'after' => '</div>'));
                if (gt3_option("page_comments") == "1") { ?>
                    <div class="clear"></div>
                    <?php comments_template(); ?>         
                <?php } ?>
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

} else {
	get_header();
?>
	<div class="wrapper_404 height_100percent pp_block">
        <div class="container_vertical_wrapper">
            <div class="container a-center pp_container">
                <h1><?php echo esc_html__('Password Protected', 'wizestore'); ?></h1>
                <h2><?php echo esc_html__('This content is password protected. Please enter your password below to continue.', 'wizestore'); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>
	</div>
<?php 
	get_footer();
} ?>