<?php

abstract class Smartcrawl_Lighthouse_Check {

	/**
	 * @var string
	 */
	private $success_title = '';

	/**
	 * @var string
	 */
	private $failure_title = '';

	/**
	 * @var string
	 */
	private $success_description = '';

	/**
	 * @var string
	 */
	private $failure_description = '';

	/**
	 * @var string
	 */
	private $copy_description = '';

	/**
	 * @var bool
	 */
	private $passed = false;

	/**
	 * @var array
	 */
	private $raw_details = array();

	/**
	 * @var
	 */
	private $weight;

	/**
	 * @var Smartcrawl_Lighthouse_Report
	 */
	private $report;

	/**
	 * @param $report
	 */
	public function __construct( $report ) {
		$this->report = $report;
	}

	/**
	 * @return string
	 */
	public function get_title() {
		if ( $this->is_passed() ) {
			return $this->success_title;
		} else {
			return $this->failure_title;
		}
	}

	/**
	 * @param string $title
	 */
	public function set_success_title( $title ) {
		$this->success_title = $title;
	}

	/**
	 * @param string $title
	 */
	public function set_failure_title( $title ) {
		$this->failure_title = $title;
	}

	/**
	 * @return string
	 */
	public function get_description() {
		if ( $this->is_passed() ) {
			return $this->success_description;
		} else {
			return $this->failure_description;
		}
	}

	/**
	 * @param string $description
	 */
	public function set_success_description( $description ) {
		$this->success_description = $description;
	}

	/**
	 * @param $description
	 *
	 * @return void
	 */
	public function set_failure_description( $description ) {
		$this->failure_description = $description;
	}

	/**
	 * @return bool
	 */
	public function is_passed() {
		return $this->passed;
	}

	/**
	 * @param bool $passed
	 */
	public function set_passed( $passed ) {
		$this->passed = $passed;
	}

	/**
	 * @return mixed
	 */
	public function get_weight() {
		return $this->weight;
	}

	/**
	 * @param $weight
	 *
	 * @return void
	 */
	public function set_weight( $weight ) {
		$this->weight = $weight;
	}

	/**
	 * @return array
	 */
	public function get_raw_details() {
		return $this->raw_details;
	}

	/**
	 * @param array $raw_details
	 */
	public function set_raw_details( $raw_details ) {
		$this->raw_details = empty( $raw_details )
			? array()
			: $raw_details;
	}

	/**
	 * @param $raw_details
	 *
	 * @return null|Smartcrawl_Lighthouse_Table
	 */
	public function parse_details( $raw_details ) {
		return null;
	}

	/**
	 * @return array
	 */
	public function get_flattened_details() {
		$table             = $this->get_details_table();
		$flattened_details = array();

		if ( empty( $table ) ) {
			return $flattened_details;
		}
		$header = $table->get_header();

		foreach ( $table->get_rows() as $row ) {
			foreach ( $row as $col_index => $col ) {
				$col_header = (string) smartcrawl_get_array_value( $header, $col_index );
				if ( $col_header ) {
					$col_header = trim( wp_strip_all_tags( $col_header ) ) . ': ';
				}
				$flattened_details[] = $col_header . $col;
			}
		}

		return $flattened_details;
	}

	/**
	 * @return null|Smartcrawl_Lighthouse_Table
	 */
	public function get_details_table() {
		if ( empty( $this->raw_details ) ) {
			return null;
		}

		return $this->parse_details( $this->raw_details );
	}

	/**
	 * @param $id
	 * @param $report
	 *
	 * @return Smartcrawl_Lighthouse_Check|null
	 */
	public static function create( $id, $report ) {
		$available_checks = array(
			'Smartcrawl_Lighthouse_Canonical_Check',
			'Smartcrawl_Lighthouse_Crawlable_Anchors_Check',
			'Smartcrawl_Lighthouse_Document_Title_Check',
			'Smartcrawl_Lighthouse_Font_Size_Check',
			'Smartcrawl_Lighthouse_Hreflang_Check',
			'Smartcrawl_Lighthouse_Http_Status_Code_Check',
			'Smartcrawl_Lighthouse_Image_Alt_Check',
			'Smartcrawl_Lighthouse_Is_Crawlable_Check',
			'Smartcrawl_Lighthouse_Link_Text_Check',
			'Smartcrawl_Lighthouse_Meta_Description_Check',
			'Smartcrawl_Lighthouse_Plugins_Check',
			'Smartcrawl_Lighthouse_Robots_Txt_Check',
			'Smartcrawl_Lighthouse_Tap_Targets_Check',
			'Smartcrawl_Lighthouse_Viewport_Check',
			'Smartcrawl_Lighthouse_Structured_Data_Check',
		);

		foreach ( $available_checks as $check ) {
			if ( constant( "{$check}::ID" ) === $id ) {
				return new $check( $report );
			}
		}

		return null;
	}

	/**
	 * @return void
	 */
	public function print_details_table() {
		$table = $this->get_details_table();
		if ( ! empty( $table ) ) {
			$table->render();
		}
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function tag( $value ) {
		return '<span class="wds-lh-tag">' . esc_html( $value ) . '</span>';
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function attr( $value ) {
		return '<span class="wds-lh-attr">' . esc_html( $value ) . '</span>';
	}

	/**
	 * @return string
	 */
	public function get_action_button() {
		return '';
	}

	/**
	 * @param $text
	 * @param $url
	 * @param $icon
	 *
	 * @return false|string
	 */
	protected function button_markup( $text, $url, $icon ) {
		ob_start();
		?>
		<a class="wds-action-button sui-button" href="<?php echo esc_url( $url ); ?>">

			<span class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></span>
			<?php echo esc_html( $text ); ?>
		</a>
		<?php
		return ob_get_clean();
	}

	/**
	 * @return false|string
	 */
	public function edit_homepage_button() {
		$page_on_front = get_option( 'page_on_front' );
		$show_on_front = get_option( 'show_on_front' );

		$has_static_homepage = 'posts' !== $show_on_front && $page_on_front;
		if ( ! $has_static_homepage || ! current_user_can( 'edit_page', $page_on_front ) ) {
			return '';
		}

		return $this->button_markup(
			esc_html__( 'Edit Homepage', 'wds' ),
			get_edit_post_link( $page_on_front ),
			'sui-icon-pencil'
		);
	}

	/**
	 * @return mixed
	 */
	abstract function get_id();

	/**
	 * @return mixed
	 */
	abstract public function prepare();

	/**
	 * @return string
	 */
	public function get_copy_description() {
		return $this->copy_description;
	}

	/**
	 * @param $copy_description
	 *
	 * @return void
	 */
	public function set_copy_description( $copy_description ) {
		$this->copy_description = $copy_description;
	}

	/**
	 * @return string
	 */
	public function get_device_label() {
		return $this->report->get_device() === 'desktop'
			? esc_html__( 'Desktop', 'wds' )
			: esc_html__( 'Mobile', 'wds' );
	}

	/**
	 * @return Smartcrawl_Lighthouse_Report
	 */
	public function get_report() {
		return $this->report;
	}
}
