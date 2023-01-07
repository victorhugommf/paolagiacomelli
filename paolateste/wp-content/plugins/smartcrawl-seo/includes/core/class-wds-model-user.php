<?php

class Smartcrawl_Model_User extends Smartcrawl_Model {

	/**
	 * Holds the user ID reference used in the constructor
	 *
	 * @var int
	 */
	private $user_id;

	/**
	 * Holds the user object cache
	 *
	 * @var WP_User object.
	 */
	private $user;

	public function __construct( $user_id = false ) {
		if ( ! empty( $user_id ) && is_numeric( $user_id ) ) {
			$this->user_id = (int) $user_id;
			$this->user    = new WP_User( $user_id );
		} elseif ( ! empty( $user_id ) ) {
			$user = new WP_User( $user_id );
			if ( ! empty( $user->ID ) && is_numeric( $user->ID ) ) {
				$this->user_id = $user->ID;
				$this->user    = $user;
			}
		} else {
			$this->user_id = false;
			$this->user    = new WP_User();
		}
	}

	/**
	 * Current user convenience factory method
	 *
	 * @return Smartcrawl_Model_User Current user instance
	 */
	public static function current() {
		return self::get( get_current_user_id() );
	}

	/**
	 * Particular user convenience factory method
	 *
	 * @param int|string $user_id User ID, or login|email.
	 *
	 * @return Smartcrawl_Model_User Particular user instance.
	 */
	public static function get( $user_id = false ) {
		return new self( $user_id );
	}

	/**
	 * Fetches the site owner user (one of)
	 *
	 * @return Smartcrawl_Model_User Owner user reference.
	 */
	public static function owner() {
		$by_id = get_user_by( 'ID', apply_filters( 'wds-site-owner-id', 1 ) ); // phpcs:ignore
		if ( $by_id && in_array( 'administrator', $by_id->roles, true ) ) {
			return self::get( $by_id );
		}

		$by_admin_email = get_user_by( 'email', get_option( 'admin_email' ) );
		if ( $by_admin_email && in_array( 'administrator', $by_admin_email->roles, true ) ) {
			return self::get( $by_admin_email );
		}

		$admins = get_users(
			array(
				'role'   => 'administrator',
				'fields' => 'ID',
			)
		);

		return self::get( reset( $admins ) );
	}

	/**
	 * Returns user first name
	 *
	 * @return string First name, or display name
	 */
	public function get_first_name() {
		$name = $this->user->user_firstname;
		$name = ! empty( $name )
			? $name
			: $this->get_display_name();

		return apply_filters(
			$this->get_filter( 'first_name' ),
			$name,
			$this->user_id
		);
	}

	public function get_last_name() {
		return $this->user->user_lastname;
	}

	/**
	 * Returns user display name
	 *
	 * @return string Display name, or fallback
	 */
	public function get_display_name() {
		$name = $this->user->display_name;
		$name = ! empty( $name )
			? $name
			: $this->get_fallback_name();

		return apply_filters(
			$this->get_filter( 'display_name' ),
			$name,
			$this->user_id
		);
	}

	public function get_username() {
		return $this->user->user_login;
	}

	/**
	 * Returns the fallback name, for when other methods fail
	 *
	 * @return string
	 */
	public function get_fallback_name() {
		$name = $this->user->user_nicename;
		$name = ! empty( $name )
			? $name
			: __( 'Anonymous', 'wds' );

		return apply_filters(
			$this->get_filter( 'fallback_name' ),
			$name,
			$this->user_id
		);
	}

	/**
	 * Gets user full name
	 *
	 * Falls back to display name
	 *
	 * @return string Full name
	 */
	public function get_full_name() {
		$name = '';

		// Try full first.
		$first = get_user_meta( $this->get_id(), 'first_name', true );
		$last  = get_user_meta( $this->get_id(), 'last_name', true );
		if ( ! empty( $first ) && ! empty( $last ) ) {
			$name = "{$first} {$last}";
		}

		// Fall back to display name.
		if ( empty( $name ) ) {
			$name = $this->user->display_name;
		}

		return apply_filters(
			$this->get_filter( 'full_name' ),
			$name,
			$first,
			$last
		);
	}

	/**
	 * Returns the user ID
	 *
	 * @return int
	 */
	public function get_id() {
		return (int) $this->user_id;
	}

	/**
	 * Gets user URL
	 *
	 * Falls back to posts URL
	 *
	 * @return string User URL
	 */
	public function get_user_url() {
		$url = get_user_meta( $this->get_id(), 'url', true );
		if ( empty( $url ) ) {
			$url = get_author_posts_url( $this->get_id() );
		}

		return apply_filters( $this->get_filter( 'user_url' ), $url, $this->get_id() );
	}

	public function get_user_urls() {
		// TODO: fetch user URLs.
		return array();
	}

	public function get_type() {
		return 'user';
	}

	public function get_email() {
		return $this->user->user_email;
	}

	public function get_description() {
		return get_the_author_meta( 'description', $this->get_id() );
	}

	public function get_avatar_url( $size ) {
		return get_avatar_url( $this->get_id(), $size );
	}
}
