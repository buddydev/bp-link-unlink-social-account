<?php

/**
 * Plugin Name: BP Link Unlink Social Account
 * Description: This plugin is used for link or unlink their social account to the site.
 * Author: Ravi Sharma
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

	}

	public function load_file() {

		if ( ! function_exists( 'wsl_activate' ) && ! function_exists( 'wsl_install' ) ) {
			return;
		}

		require_once plugin_dir_path( __FILE__ ).'class-bp-link-unlink-social-account.php';
	}
}
BP_Link_Unlink_Social_Account_Helper::get_instance();