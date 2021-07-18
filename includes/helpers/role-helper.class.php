<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Role_Helper' ) ) {
	class _skymount_Role_Helper{
		private static $instance = null;

		public function check_role() {
	        global $current_user;
	        $current_user = wp_get_current_user();
	        //skymount_agent, subscriber, author, skymount_buyer, skymount_owner, skymount_seller, skymount_manager, skymount_agency
	        $use_skymount_roles = 1;

	        if( $use_skymount_roles != 0 ) {
	            if (in_array('skymount_buyer', (array)$current_user->roles) || in_array('subscriber', (array)$current_user->roles)) {
	                return false;
	            }
	            return true;
	        }
	        return true;
	    }

	    public function user_role_by_post_id($the_id) {

	        $user_id = get_post_field( 'post_author', $the_id );
	        $user = new WP_User($user_id); //administrator

	        if( $user->ID == 0 ) {
	            return 'skymount_guest';
	        }
	        $user_role = $user->roles[0];
	        return $user_role;
	    }

	    public function user_role_by_user_id($user_id) {

	        $user = new WP_User($user_id);

	        if( $user->ID == 0 ) {
	            return 'skymount_guest';
	        }
	        $user_role = $user->roles[0];
	        return $user_role;
	    }

		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

function _skymount_role() {
	return _skymount_Role_Helper::get_instance();
}