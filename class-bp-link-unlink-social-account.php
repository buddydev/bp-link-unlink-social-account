<?php
class BP_Link_Unlink_Social_Account {

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

		add_action( 'bp_core_general_settings_before_submit', array( $this, 'add_link_unlink_button' ) );
		add_action( 'wp_ajax_unlink_social_account', array( $this, 'unlink_my_social_account' ) );
	}

	public function add_link_unlink_button() {

		if ( ! bp_is_my_profile() ) {
			return;
		}

		$user_id     = get_current_user_id();
		$social_meta = get_user_meta( $user_id, 'wsl_current_provider', true );

		echo '<div id="message"></div>';
		if ( $social_meta ) {

			?>

			<div class="submit">
				<input type="button" id="unlink_social_account" value="Unlink <?php echo $social_meta; ?> Account">
			</div>

			<script type="text/javascript">

				jQuery('#unlink_social_account').click(function () {

					jQuery.post(ajaxurl, {
						action: 'unlink_social_account',
					}, function (data) {
						jQuery('#message').html(data);
						location.reload()
					})

					return false;
				})

			</script>

			<?php

		} else {
			do_action( 'wordpress_social_login', array( 'mode' => 'link', 'caption' => '' ) );
		}
	}

	public function unlink_my_social_account() {

		if ( ! is_user_logged_in() ) {
			exit;
		}

		$user_id = get_current_user_id();

		delete_user_meta( $user_id, 'wsl_current_provider' );
		delete_user_meta( $user_id, 'wsl_current_user_image' );

		echo "Account Unlinked";
		exit;
	}
}
BP_Link_Unlink_Social_Account::get_instance();