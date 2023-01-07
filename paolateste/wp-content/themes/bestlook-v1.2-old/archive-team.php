<?php 
get_header();
$defaults = array(
    'title' => '',
    'subtitle' => '',
    'view_all_link' => '',
    'show_view_all' => 'no',
    'posts_per_line' => '4',
    'item_el_class' => '',
    'css' => ''
);
$build_query = "size:all|order_by:title|order:ASC|post_type:team";
extract($defaults);
?>
<div class="container">
    <div class="content-container">
        <section id='main_content' class='module_team'>
            <div class="shortcode_team">
                <div class="items<?php echo esc_attr($posts_per_line); ?>">
                    <ul class="item_list">
						<?php
						echo render_gt3_team($defaults, $build_query);
						?>
					</ul>
                    <div class="clear"></div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php 
get_footer();
?>