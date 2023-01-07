<?php
	$show_likes = gt3_option('blog_post_likes');
	$show_share = gt3_option('blog_post_share');

	$all_likes = gt3pb_get_option("likes");

	$comments_num = '' . get_comments_number(get_the_ID()) . '';

	if ($comments_num == 1) {
		$comments_text = '' . esc_html__('comment', 'wizestore') . '';
	} else {
		$comments_text = '' . esc_html__('comments', 'wizestore') . '';
	}

	$post_date = $post_author = $post_category_compile = $post_comments = '';

	// Categories
	if (get_the_category()) $categories = get_the_category();
	if (!empty($categories)) {
		$post_categ = '';
		$post_category_compile = '<span>';
		foreach ($categories as $category) {
			$post_categ = $post_categ . '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . ', ';
		}
		$post_category_compile .= ' ' . trim($post_categ, ', ') . '</span>';
	}else{ $post_category_compile = '';}

	$post = get_post();

	$post_date = '<span>' . esc_html(get_the_time(get_option( 'date_format' ))) . '</span>';

	$post_author = '<span>' . esc_html__("by", 'wizestore') . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>';

	$post_comments = '<span><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';

	// Post meta
	$post_meta =  $post_date . $post_author . $post_category_compile . $post_comments;

	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');

	$pf = get_post_format();
	if (empty($pf)) $pf = "standard";

	ob_start();
	if (has_excerpt()) {
		$post_excerpt = the_excerpt();
	} else {
		$post_excerpt = the_content();
	}
	$post_excerpt = ob_get_clean();

	$width = '1170';
	$height = '725';

	$pf_media = gt3_get_pf_type_output($pf, $width, $height, $featured_image);

	$pf = $pf_media['pf'];


	$symbol_count = '400';

	if (gt3_option('blog_post_listing_content') == "1") {
		$post_excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_excerpt);
		$post_excerpt_without_tags = strip_tags($post_excerpt);
		$post_descr = gt3_smarty_modifier_truncate($post_excerpt_without_tags, $symbol_count, "...");
	} else {
		$post_descr = $post_excerpt;
	}

	$post_title = get_the_title();

?>
	<div class="blog_post_preview format-<?php echo esc_attr($pf); ?>">
		<div class="item_wrapper">
			<div class="blog_content">
			<?php
				if ($pf == 'quote' || $pf == 'audio' || $pf == 'link') {
				} else {
				echo $pf_media['content'];
				}

				if ($pf == 'quote' || $pf == 'link') {
				} else if (strlen($post_title) > 0) {
					$pf_icon = '';
					if ($pf == 'standard-image') {
						$pf_icon = '<i class="fa fa-camera"></i>';
					} else if ($pf == 'gallery') {
						$pf_icon = '<i class="fa fa-files-o"></i>';
					} else if ($pf == 'audio') {
						$pf_icon = '<i class="fa fa-headphones"></i>';
					} else if ($pf == 'video') {
						$pf_icon = '<i class="fa fa-youtube-play"></i>';
					} else {
						$pf_icon = '<i class="fa fa-file-text"></i>';
					}
					if ( is_sticky() ) {
						$pf_icon = '<i class="fa fa-thumb-tack"></i>';
					}
					echo '<h2 class="blogpost_title">' . $pf_icon . '<a href="' . esc_url(get_permalink()) . '">' . esc_html($post_title) . '</a></h2>';
				}

				echo '' . (strlen($post_meta) ? '<div class="listing_meta">' . $post_meta . '</div>' : '') . '';

				if ($pf == 'quote' || $pf == 'audio' || $pf == 'link') {
					echo $pf_media['content'];
				}
				echo '' . (strlen($post_descr) ? $post_descr : '') . '<div class="clear post_clear"></div><div class="gt3_module_button  button_alignment_inline"><a href="'. esc_url(get_permalink()) .'" class="learn_more button_size_small">'. esc_html__('Read More', 'wizestore') .'</a></div><div class="post_info">';
				if ($show_share == "1") {
					echo '
					<div class="post_share">
						<a href="#">'. esc_html__('Share', 'wizestore') .'</a>
						<div class="share_wrap">
							<ul>
								<li><a target="_blank" href="'. esc_url('https://www.facebook.com/share.php?u='. get_permalink()) .'"><span class="fa fa-facebook"></span></a></li>
								<li><a target="_blank"
                                           href="'. 'https://plus.google.com/share?url='.urlencode(get_permalink()) .'" class="share_gplus"><span class="fa fa-google-plus"></span></a></li>';
				if (strlen($featured_image[0]) > 0) {
					echo '<li><a target="_blank" href="'. esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='. $featured_image[0]) .'"><span class="fa fa-pinterest"></span></a></li>';
				}
				echo '<li><a target="_blank" href="'. esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'&amp;url='. get_permalink()) .'"><span class="fa fa-twitter"></span></a></li>';
				echo '
							</ul>
						</div>
					</div>';
				}
				if ($show_likes == "1") {
					if (isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()] == 1) {
                        $likes_text_label = esc_html__('Like', 'wizestore');
                    } else {
                        $likes_text_label = esc_html__('Likes', 'wizestore');
                    }
                    echo '<div class="likes_block post_likes_add '. (isset($_COOKIE['like_post'.get_the_ID()]) ? "already_liked" : "") .'" data-postid="'. esc_attr(get_the_ID()).'" data-modify="like_post">
                        <span class="theme_icon-favorite icon"></span>
                        <span class="like_count">'.((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0).'</span> <span class="like_title">'.$likes_text_label.'</span>
                    </div>';
				}

			?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>