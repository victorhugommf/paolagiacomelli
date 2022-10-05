<?php
/**
 * Dashboard root template
 *
 * @package wpmu-dev-seo
 */

$configs_available = is_main_site();
?>
<?php $this->render_view( 'before-page-container' ); ?>

<div id="container" class="<?php smartcrawl_wrap_class( 'wds-dashboard' ); ?>">
	<?php
	$this->render_view(
		'page-header',
		array(
			'title'                 => esc_html__( 'Dashboard', 'wds' ),
			'documentation_chapter' => 'dashboard',
			'utm_campaign'          => 'smartcrawl_dashboard_docs',
		)
	);
	?>

	<?php
	$this->render_view(
		'floating-notices',
		array(
			'keys' => array( 'wds-config-notice' ),
		)
	);
	?>

	<div class="sui-row">
		<div class="sui-col-md-12">
			<?php
			Smartcrawl_Lighthouse_Dashboard_Renderer::render( 'dashboard/dashboard-top-lighthouse' );
			?>
		</div>

		<div class="sui-col">
			<?php
			Smartcrawl_Lighthouse_Dashboard_Renderer::render( 'dashboard/dashboard-widget-lighthouse' );
			$this->render_view( 'dashboard/dashboard-widget-content-analysis' );
			$this->render_view( 'dashboard/dashboard-widget-social' );
			$this->render_view( 'dashboard/dashboard-widget-schema' );
			if ( Smartcrawl_Settings_Admin::is_tab_allowed( Smartcrawl_Settings::TAB_SETTINGS ) && $configs_available ) {
				$this->render_view( 'dashboard/dashboard-widget-configs' );
			}
			?>
		</div>

		<div class="sui-col">
			<?php
			$this->render_view( 'dashboard/dashboard-widget-upgrade' );
			$this->render_view( 'dashboard/dashboard-widget-onpage' );
			$this->render_view( 'dashboard/dashboard-widget-sitemap' );
			$this->render_view( 'dashboard/dashboard-widget-advanced-tools' );
			$this->render_view( 'dashboard/dashboard-widget-reports' );
			?>
		</div>
	</div>

	<?php do_action( 'wds-dshboard-after_settings' ); // phpcs:ignore ?>

	<?php $this->render_view( 'dashboard/dashboard-cross-sell-footer' ); ?>
	<?php $this->render_view( 'footer' ); ?>
</div>
