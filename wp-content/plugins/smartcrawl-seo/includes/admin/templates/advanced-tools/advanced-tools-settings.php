<?php
$is_member         = empty( $_view['is_member'] ) ? false : true;
$autolinks_enabled = Smartcrawl_Settings::get_setting( 'autolinks' ) && $is_member;
$form_action       = $autolinks_enabled ? $_view['action_url'] : '';
$already_exists    = empty( $already_exists ) ? false : true;
$rootdir_install   = empty( $rootdir_install ) ? false : true;
?>

<?php $this->render_view( 'before-page-container' ); ?>
<div id="container" class="<?php smartcrawl_wrap_class( 'wds-page-autolinks' ); ?>">

	<?php
	$this->render_view(
		'page-header',
		array(
			'title'                 => esc_html__( 'Advanced Tools', 'wds' ),
			'documentation_chapter' => 'advanced-tools',
			'utm_campaign'          => 'smartcrawl_advanced-tools_docs',
		)
	);
	?>

	<?php
	$this->render_view(
		'floating-notices',
		array(
			'keys' => array(
				'wds-redirect-notice',
			),
		)
	);
	?>

	<div class="wds-vertical-tabs-container sui-row-with-sidenav">
		<?php
		$this->render_view(
			'advanced-tools/advanced-side-nav',
			array(
				'active_tab' => $active_tab,
			)
		);
		?>

		<form action='<?php echo esc_attr( $form_action ); ?>' method='post' class="wds-form">
			<?php if ( $autolinks_enabled ) : ?>
				<?php $this->settings_fields( $_view['option_name'] ); ?>

				<input
					type="hidden"
					name='<?php echo esc_attr( $_view['option_name'] ); ?>[<?php echo esc_attr( $_view['slug'] ); ?>-setup]'
					value="1">
			<?php endif; ?>
			<?php
			$autolinks_disabled_section = array(
				array(
					'section_template' => 'disabled-component-inner',
					'section_args'     => array(
						'content'            => sprintf(
							'%s<br/>%s<br/>%s',
							_x( 'Configure SmartCrawl to automatically link certain key words to a page on your blog or even', 'part of a larger text', 'wds' ),
							_x( 'a whole new site all together. Internal linking can help boost SEO by giving search engines', 'part of a larger text', 'wds' ),
							_x( 'ample ways to index your site.', 'part of a larger text', 'wds' )
						),
						'image'              => 'graphic-autolinking-disabled.svg',
						'component'          => 'autolinks',
						'premium_feature'    => true,
						'upgrade_tag'        => 'smartcrawl_autolinking_upgrade_button',
						'title_actions_left' => '',
						'button_text'        => __( 'Activate', 'wds' ),
					),
				),
			);

			$autolinks_sections = array(
				array(
					'section_description' => esc_html__( 'SmartCrawl will look for keywords that match posts/pages around your website and automatically link them. Specify what post types you want to include in this tool, and what post types you want those to automatically link to.', 'wds' ),
					'section_template'    => 'advanced-tools/advanced-section-automatic-linking',
					'section_args'        => array(
						'insert' => $insert,
						'linkto' => $linkto,
					),
				),
			);

			$autolinks_tab = array(
				'tab_id'             => 'tab_automatic_linking',
				'tab_name'           => __( 'Automatic Linking', 'wds' ),
				'is_active'          => 'tab_automatic_linking' === $active_tab,
				'title_actions_left' => 'advanced-tools/advanced-tools-title-pro-tag',
				'tab_sections'       => $autolinks_enabled
					? $autolinks_sections
					: $autolinks_disabled_section,
			);

			if ( ! $autolinks_enabled ) {
				$autolinks_tab['button_text'] = false;
			}

			$this->render_view( 'vertical-tab', $autolinks_tab );
			?>
		</form>

		<form
			action='<?php echo esc_attr( $_view['action_url'] ); ?>'
			method='post'
			class="wds-form">
			<?php $this->settings_fields( $_view['option_name'] ); ?>

			<?php
			if ( smartcrawl_woocommerce_active() ) {
				$this->render_view(
					'advanced-tools/advanced-section-woo-settings',
					array(
						'is_active' => 'tab_woo' === $active_tab,
					)
				);
			}
			?>
		</form>

		<form
			action='<?php echo esc_attr( $_view['action_url'] ); ?>'
			method='post'
			class="wds-form">
			<?php $this->settings_fields( $_view['option_name'] ); ?>

			<div
				id="tab_url_redirection"
				class="wds-vertical-tab-section"
			>
				<?php
				$this->render_view(
					'advanced-tools/advanced-section-redirects',
					array(
						'is_active' => 'tab_url_redirection' === $active_tab,
					)
				);

				$this->render_view(
					'vertical-tab',
					array(
						'tab_id'       => 'tab_url_redirection_settings',
						'tab_name'     => esc_html__( 'Settings', 'wds' ),
						'is_active'    => 'tab_url_redirection' === $active_tab,
						'tab_sections' => array(
							array(
								'section_template' => 'advanced-tools/advanced-section-redirect-settings',
							),
						),
					)
				);
				?>
			</div>
		</form>

		<form method="post" class="wds-moz-form wds-form">
			<?php
			$this->render_view(
				'vertical-tab',
				array(
					'tab_id'       => 'tab_moz',
					'tab_name'     => __( 'Moz', 'wds' ),
					'is_active'    => 'tab_moz' === $active_tab,
					'button_text'  => false,
					'tab_sections' => array(
						array(
							'section_template' => 'advanced-tools/advanced-section-moz',
							'section_args'     => array(),
						),
					),
				)
			);
			?>
		</form>

		<?php
		$this->render_view(
			'advanced-tools/advanced-tab-robots',
			array(
				'active_tab'      => $active_tab,
				'already_exists'  => $already_exists,
				'rootdir_install' => $rootdir_install,
			)
		);
		?>
	</div>
	<?php $this->render_view( 'footer' ); ?>
	<?php $this->render_view( 'upsell-modal' ); ?>

</div><!-- end wds-page-autolinks -->
