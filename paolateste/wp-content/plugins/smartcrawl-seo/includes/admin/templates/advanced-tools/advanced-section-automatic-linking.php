<?php
$insert = empty( $insert ) ? array() : $insert;
$linkto = empty( $linkto ) ? array() : $linkto;
$this->render_view(
	'advanced-tools/advanced-section-automatic-linking-main',
	array(
		'insert' => $insert,
		'linkto' => $linkto,
	)
);

$this->render_view(
	'advanced-tools/advanced-section-automatic-linking-settings',
	array(
		'additional_settings' => array(
			'allow_empty_tax'                => array(
				'label'       => esc_html__( 'Allow autolinks to empty taxonomies', 'wds' ),
				'description' => esc_html__( 'Allows autolinking to taxonomies that have no posts assigned to them.', 'wds' ),
			),
			'excludeheading'                 => array(
				'label'       => esc_html__( 'Prevent linking in heading tags', 'wds' ),
				'description' => esc_html__( 'Excludes headings from autolinking.', 'wds' ),
			),
			'onlysingle'                     => array(
				'label'       => esc_html__( 'Process only single posts and pages', 'wds' ),
				'description' => esc_html__( 'Process only single posts and pages', 'wds' ),
			),
			'allowfeed'                      => array(
				'label'       => esc_html__( 'Process RSS feeds', 'wds' ),
				'description' => esc_html__( 'Autolinking will also occur in RSS feeds.', 'wds' ),
			),
			'casesens'                       => array(
				'label'       => esc_html__( 'Case sensitive matching', 'wds' ),
				'description' => esc_html__( 'Only autolink the exact string match.', 'wds' ),
			),
			'customkey_preventduplicatelink' => array(
				'label'       => esc_html__( 'Prevent duplicate links', 'wds' ),
				'description' => esc_html__( 'Only link to a specific URL once per page/post.', 'wds' ),
			),
			'target_blank'                   => array(
				'label'       => esc_html__( 'Open links in new tab', 'wds' ),
				'description' => esc_html__( 'Adds the target=“_blank” tag to links to open a new tab when clicked.', 'wds' ),
			),
			'rel_nofollow'                   => array(
				'label'       => esc_html__( 'Nofollow autolinks', 'wds' ),
				'description' => esc_html__( 'Adds the nofollow meta tag to autolinks to prevent search engines following those URLs when crawling your website.', 'wds' ),
			),
			'exclude_no_index'               => array(
				'label'       => esc_html__( 'Prevent linking on no-index pages', 'wds' ),
				'description' => esc_html__( 'Prevent autolinking on no-index pages.', 'wds' ),
			),
			'exclude_image_captions'         => array(
				'label'       => esc_html__( 'Prevent linking on image captions', 'wds' ),
				'description' => esc_html__( 'Prevent links from being added to image captions.', 'wds' ),
			),
			'disable_content_cache'          => array(
				'label'       => esc_html__( 'Prevent caching for autolinked content', 'wds' ),
				'description' => esc_html__( 'Some page builder plugins and themes conflict with object cache when automatic linking is enabled. Enable this option to disable object cache for autolinked content.', 'wds' ),
			),
		),
	)
);
