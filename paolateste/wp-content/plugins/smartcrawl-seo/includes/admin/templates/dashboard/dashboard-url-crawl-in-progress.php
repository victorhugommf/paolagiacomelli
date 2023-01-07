<?php
$progress = empty( $progress ) ? 0 : $progress;
?>
<div class="wds-box-refresh-required"></div>
<p>
	<small><?php esc_html_e( 'SmartCrawl is performing a URL crawl, please wait …', 'wds' ); ?></small>
</p>

<?php
$this->render_view(
	'progress-bar',
	array(
		'progress'       => $progress,
		'progress_state' => esc_html__( 'Crawl in progress...', 'wds' ),
	)
);

$this->render_view(
	'progress-notice',
	array(
		'message' => 'You can always come back later. SmartCrawl will send you an email to %s with the results of the crawl.',
	)
);
?>
