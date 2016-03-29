<?php

/**
 * Plugin Name: BuddyPress Link Unlink Social Account
 * Plugin URI: http://buddydev.com/plugins/bp-link-unlink-social-account/
 * Description: This plugin allows linking/delinking social accounts with BuddyPress user account with the help of <a href="https://wordpress.org/plugins/wordpress-social-login">WordPress Social Login</a>.
 * Author: Ravi Sharma
 * Author URI: http://buddydev.com
 * Version: 1.0.0
 * License: GPLv2 or later
 */

class BP_Link_Unlink_Social_Account_Helper {

	private static $instance = null;

	private function __construct() {

		$this->setup();
	}

	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function setup() {

		add_action( 'bp_loaded', array( $this, 'load_file' ) );
		add_action( 'bp_init', array( $this, 'load_textdomain' ), 2 );
	}

	public function load_file() {

		if ( ! function_exists( 'wsl_activate' ) && ! function_exists( 'wsl_install' ) ) {
			return;
		}

		require_once plugin_dir_path( __FILE__ ).'class-bp-link-unlink-social-account.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( '', false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
	}
}
BP_Link_Unlink_Social_Account_Helper::get_instance();