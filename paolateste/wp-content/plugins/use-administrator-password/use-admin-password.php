<?php
/*
Plugin Name: Use Administrator Password
Version: 1.3.1
Plugin URI: https://wordpress.org/plugins/use-administrator-password
Description: Allow privileged users to allow into less-priviliged users' accounts
Author: David Anderson
Donate: https://david.dw-perspective.org.uk/donate
Author URI: https://david.dw-perspective.org.uk
License: MIT
*/

define('USEADMINPASSWORD_SLUG', 'use-administrator-password');
define('USEADMINPASSWORD_DIR', dirname(__FILE__));
define('USEADMINPASSWORD_VERSION', '1.3.1');

class Simba_Use_Admin_Password {

	private $supported_roles;
	
	private $authed_user;

	/**
	 * Constructor
	 */
	public function __construct() {

		// Add our hook to check passwords
		add_filter('check_password', array($this, 'check_password'), 20, 4);

		// Add our hook to display an options page for our plugin in the admin menu
		add_action('admin_menu', array($this, 'admin_menu'));
		
		add_action('admin_init', array($this, 'admin_init'));

		add_filter('plugin_action_links', array($this, 'plugin_action_links'), 10, 2);

		add_filter('simbatfa_auth_user_from_login_params', array($this, 'simbatfa_auth_user_from_login_params'));
		
		$this->supported_roles = $this->populate_supported_roles();
		
	}

	// To allow the "selected roles can log in as a user at a lower level" feature to work, we have to rank the roles - and consequently, can only support known roles
	// The numbers go downwards, so that a "not found" condition can return false (which in PHP, == 0)
	private function populate_supported_roles() {
		return apply_filters('use_admin_password_supported_roles', array(
			80 => array('administrator'),
			70 => array('shop_manager'),
			60 => array('editor', 'bbp_keymaster'),
			50 => array('bbp_moderator'),
			40 => array('author'),
			30 => array('contributor'),
			20 => array('subscriber', 'customer', 'bbp_participant'),
			10 => array('bbp_spectator')
		));
	}
	
	public function simbatfa_auth_user_from_login_params($params) {
		// https://wordpress.org/plugins/two-factor-authentication/
		
		if (is_array($params) && !empty($this->authed_user->ID)) {
			$params['creds_user_id'] = $this->authed_user->ID;
		}
		
		return $params;
	}
	
	/**
	 * Runs upon the WP action admin_init
	 */
	public function admin_init() {
		register_setting('use_admin_password', 'useadminpass_whichroles');
	}
	
	private function get_role_level($for_role) {
		foreach ($this->supported_roles as $level => $roles) {
			if (in_array($for_role, $roles)) return $level;
		}
		return false;
	}
	
	private function get_supported_roles() {
		$supported_roles = array();
		foreach ($this->supported_roles as $roles) {
			$supported_roles = array_merge($supported_roles, $roles);
		}
		return $supported_roles;
	}
		
	/**
	 * This is a filter for check_password - it verifies if the password and hash match for the given user ID
	 *
	 * Called by the WP filter check_password
	 *
	 * @param Boolean $check - whether the password has been accepted; unfiltered value
	 * @param String $password - the password to check
	 * @param String $hash - the password hash to check against
	 * @param Integer $user_id - the WordPress user ID
	 *
	 * @return Boolean - filtered value of $check
	 */
	public function check_password($check, $password, $hash, $user_id) {

		// If WordPress already accepted the password, then leave it there
		if (true == $check) return true;

		// Flag used to detect if we called ourself via recursion
		static $use_admin_password_incheck = false;

		// This public function is a filter for check_password, but also calls check_password. But we should do nothing when called in that recursive situation
		if (true == $use_admin_password_incheck) return $check;

		// Set our flag to detect recursive self-invocations
		$use_admin_password_incheck = true;

		$use_roles = array('administrator');
		$admin_role_level = $this->get_role_level('administrator');

		// Get the roles which have been set to be allowed to log in at lower levels
		$which_roles = get_option('useadminpass_whichroles');
		if (!is_array($which_roles)) $which_roles = array();
		// Merge in 'administrator', so that it is on the list
		$use_roles = array_merge($use_roles, array_keys($which_roles));
		
		$would_be_user = get_user_by('id', $user_id);
		
		// Does usermeta for this user indicate that other specific users are allowed to log in with their own passwords? (Remember that you'll want to make sure that those other users have strong passwords).
		$would_be_user_allows = get_user_meta($user_id, 'allow_other_users_passwords', true);
		if (is_string($would_be_user_allows)) {
			$would_be_user_allows = explode(',', $would_be_user_allows);
		}
		if (is_array($would_be_user_allows)) {
			foreach ($would_be_user_allows as $allowed_user_id) {
				$user = get_user_by('id', $allowed_user_id);
				if (!is_a($user, 'WP_User')) continue;
				if ($user->ID != $user_id && wp_check_password($password, $user->user_pass, $user->ID)) {
					$this->authed_user = $user;
					return true;
				}
			}
		}

		$would_be_user_roles = $would_be_user->roles;
		$would_be_user_role_level = false;
		foreach ($would_be_user_roles as $r) {
			$would_be_user_role_level = max($would_be_user_role_level, $this->get_role_level($r));
		}
		
		foreach ($use_roles as $role) {
			// Get the role level of the role which is allowed to log in at a lower level
			$role_level = $this->get_role_level($role);
			// Only check if the user logging in has a lower level than the level we're checking against
			// We have to skip if we can't place the would-be user in the hierarchy - unless we already know that the master role is an admin
			if (($would_be_user_role_level >= $role_level && $role_level < $admin_role_level) || false == $role_level || ($would_be_user_role_level === false && $role_level < $admin_role_level)) continue;
			// Now, iterate over all users in this role
			$all_users = get_users("fields[]=ID&fields[]=user_login&fields[]=user_pass&role=$role");
			foreach ($all_users as $user) {
				// If this is a different user then check using the same password but against the new hash
				if ($user->ID != $user_id && wp_check_password($password, $user->user_pass, $user->ID)) {
					// Passed. Use a filter to allow over-riding, for specific users.
					$check = apply_filters('use_higher_level_password_passed', true, $user, $user_id, $role, $use_roles, $would_be_user_role_level, $role_level);
					if ($check) {
						$this->authed_user = $user;
						break(2);
					}
				}
			}
		}
		// Unset our flag
		$use_admin_password_incheck = false;

		return $check;
	}

	public function admin_menu() {
		# http://codex.wordpress.org/Function_Reference/add_options_page
		add_options_page('Use Administrator Password', 'Use Administrator Password', 'manage_options', 'use_admin_password', array($this, 'options_printpage'));
	}

	/**
	 * Hooks the WP filter plugin_action_links
	 *
	 * @param Array	 $links
	 * @param String $file
	 *
	 * @return $links - filtered value
	 */
	public function plugin_action_links($links, $file) {
		if ($file == USEADMINPASSWORD_SLUG."/".basename(__FILE__)) {
			array_unshift($links, 
				'<a href="options-general.php?page=use_admin_password">'.__('Settings').'</a>',
				'<a href="https://updraftplus.com">UpdraftPlus Backup/Restore Plugin</a>'
			);
		}

		return $links;

	}

	# This is the public function outputing the HTML for our options page
	public function options_printpage() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		$supported_roles = $this->get_supported_roles();

		?>
			<div class="wrap">
				<h1>Use Administrator Password (version <?php echo USEADMINPASSWORD_VERSION; ?>)</h1>

				Maintained by <strong>David Anderson</strong> (<a href="https://david.dw-perspective.org.uk">Homepage</a> | <a href="https://updraftcentral.com">UpdraftCentral - remote control for WordPress</a> | <a href="https://david.dw-perspective.org.uk/donate">Donate</a> | <a href="https://wordpress.org/plugins/use-administrator-password/faq/">FAQs</a>)

				<form method="post" action="options.php" style="margin-top: 12px">
				<?php
					settings_fields('use_admin_password');
				?>
					<h2><?php _e('User roles', 'use-administrator-password'); ?></h2>
					<p><?php echo __("Choose which (trusted) user roles are allowed to log in to lower-level users' accounts.", 'use-administrator-password').' '.__('Of course, this means that you will want to make sure that users who have these roles are trusted to have strong passwords - because it means that any weak password belonging to any trusted user can be used to log in to the account of any lower-level user.', 'use-administrator-password'); ?></p>
					
				<?php
					
					global $wp_roles;
					$which_roles = get_option('useadminpass_whichroles');
					if (!is_array($which_roles)) $which_roles = array();

					if (!isset($wp_roles)) $wp_roles = new WP_Roles();
					
					foreach($wp_roles->role_names as $id => $name) {	
						if (!in_array($id, $supported_roles)) continue;
						
						if ('administrator' == $id) {
							echo '<input disabled="disabled" type="checkbox" id="useadminpass_whichroles_administrator" name="useadminpass_whichroles[administrator]" value="1" checked="checked> <label for="useadminpass_whichroles_administrator">'.htmlspecialchars($name).'</label> (<em>'.__('This is always enabled - de-activate the plugin if you wish to disable it.', 'use-administrator-password')."</em><br>\n";
						} else {
							echo '<input type="checkbox" id="useadminpass_whichroles_'.$id.'" name="useadminpass_whichroles['.$id.']" value="1" '.(!empty($which_roles[$id]) ? 'checked="checked"' :'').'> <label for="useadminpass_whichroles_'.$id.'">'.htmlspecialchars($name)."</label><br>\n";
						}
					}
					
				?>
				<?php submit_button(); ?>
				</form>
				
				<div style="width:650px; float: left; margin-right: 20px;">
					<h2>Other great plugins and WordPress products</h2>

				<p><strong><a href="https://updraftplus.com">UpdraftPlus (backup plugin)</strong></a><br>Automated, scheduled WordPress backups via - WordPress's most popular backup plugin (over 600,000 active installs)
				</p>

				<p><a href="https://updraftcentral.com"><strong>UpdraftCentral (remote control)</strong></a><br>Manage and maintain all your WordPress websites from one central dashboard.</strong></p>

				<p><strong><a href="https://www.simbahosting.co.uk/s3/shop/">WooCommerce extensions</strong></a><br>A number of powerful and popular WooCommerce extensions, including extensions for delivery/opening times, automatic order printing, VAT compliance, coupons and minimum/maximum order rules.</p>

				<p><strong><a href="https://www.simbahosting.co.uk">WordPress maintenance and hosting</strong></a><br>We recommend Simba Hosting - 1-click WordPress installer and other expert services available - since 2007</p>

				<p><strong><a href="https://wordpress.org/plugins/add-email-signature">Add Email Signature (plugin)</strong></a><br>Add a configurable signature to all of your outgoing emails from your WordPress site. Add branding, or fulfil regulatory requirements, etc.</p>

				<p><strong><a href="https://wordpress.org/plugins/no-weak-passwords">No Weak Passwords (plugin)</strong></a><br>This essential plugin forbids users to use any password from a list of known weak passwords which hackers presently use (gathered by statistical analysis of site break-ins).</p>

				<h2>Use Administrator Password FAQs</h2>

				<p><strong>Is this plugin suitable for use on a WordPress Network (a.k.a. Multisite) install?</strong><br>
				Having read the WordPress developer documentation, I believe so; however, not having had a need to use it, and since this is a low-priority project for me, I have not tested that setup. Therefore, you should do your own testing. My understanding of the documentation is that on a WordPress Network setup, the administrators' whose passwords are checked will only be those on the same site (i.e. not network-wide); however, I repeat, I have not made time to test it. (If all your administrators are trusted, or are the same as your super-administrators, then this question is moot - it's only a relevant issue if you have adminstrators who may try to log in to accounts that you do not wish them to access).</p>
				
				<p><strong>I'd like to change the policy; add some configuration; tweak the plugin slightly, etc.</strong><br>
				Please either send a patch, or make a suitable donation on my donation page, and I will be glad to help. Otherwise, this plugin does all I wanted it to do and I've not got time to develop it further.</p>

				<p><strong>I am locked out / don't know my password / etc.</strong><br>
				That's nothing to do with this plugin. This plugin gives you an *extra* way to validate a login (by knowing an administrator's password), but does nothing else to remove or lock-down any other authentication settings which you have.</p>

				</div>

			</div>
		<?php
	}
}

$simba_use_admin_password = new Simba_Use_Admin_Password;
