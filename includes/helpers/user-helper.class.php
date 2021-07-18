<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_User_Helper' ) ) {
	class _skymount_User_Helper{
		private static $instance = null;

		public function get_profile_pic($user_id = null) {

	        if(empty($user_id)) {
	            $user_id = get_the_author_meta( 'ID' );
	        }
	        
	        $author_picture_id      =   get_the_author_meta( 'fave_author_picture_id' , $user_id );
	        $user_custom_picture = get_the_author_meta( 'fave_author_custom_picture', $user_id );

	        if( !empty( $author_picture_id ) ) {
	            $author_picture_id = intval( $author_picture_id );
	            if ( $author_picture_id ) {
	                $img = wp_get_attachment_image_src( $author_picture_id, 'large' );
	                $user_custom_picture = $img[0];

	            }
	        }

	        if($user_custom_picture =='' ) {
	            // $user_custom_picture = skymount_IMAGE. 'profile-avatar.png';
	        }

	        return $user_custom_picture;
	    }

	    public function get_remaining_listings($user_id) {
        	return get_the_author_meta( 'package_listings' , $user_id );
    	}

	    public function not_buyer() {
	        global $current_user;
	        $current_user = wp_get_current_user();
	        //skymount_agent, subscriber, author, skymount_buyer, skymount_owner
	        $use_skymount_roles = 1;

	        if( $use_skymount_roles != 0 ) {
	            if (in_array('skymount_buyer', (array)$current_user->roles) ) {
	                return false;
	            }
	            return true;
	        }
	        return true;
	    }

	    public function is_admin() {
	        global $current_user;
	        $current_user = wp_get_current_user();

	        if (in_array('administrator', (array)$current_user->roles)) {
	            return true;
	        }
	        return false;
	    }

	    public function user_has_membership( $user_id ) {
	        $has_package = get_the_author_meta( 'package_id', $user_id );
	        $has_listing = get_the_author_meta( 'package_listings', $user_id );

	        if( $this->is_admin() ) {
	            return true;

	        } else if( !empty( $has_package ) && ( $has_listing != 0 || $has_listing != '' ) ) {
	            
	            return true;
	        }
	        return false;
	    }

	    public function update_profile( $userID ) {

    	}

    	public function new_user_notification( $user_id, $randonpassword = '', $phone_number = '' ) {

	        $user = new WP_User( $user_id );

	        $user_login = stripslashes( $user->user_login );
	        $user_email = stripslashes( $user->user_email );

	        $phone_number = get_user_meta($user_id, 'fave_author_phone', true);

	        // Send notification to admin
	        $args = array(
	            'user_login_register' => $user_login,
	            'user_email_register' => $user_email,
	            'user_phone_register' => $phone_number
	        );
	        // skymount_register_email_type( get_option('admin_email'), 'admin_new_user_register', $args );


	        // Return if password in empty
	        if ( empty( $randonpassword ) ) {
	            return;
	        }

	        // Send notification to registered user
	        $args = array(
	            'user_login_register'  =>  $user_login,
	            'user_email_register'  =>  $user_email,
	            'user_pass_register'   => $randonpassword,
	            'user_phone_register'   => $phone_number,
	        );
	        // skymount_register_email_type( $user_email, 'new_user_register', $args );

	    }

	    public function role_is($role){
	    	global $current_user;
	        $current_user = wp_get_current_user();
	        //skymount_agent, subscriber, author, skymount_buyer, skymount_owner
	        $use_skymount_roles = 1;

	        if( $use_skymount_roles != 0 ) {
	            if (in_array($role, (array)$current_user->roles) ) {
	                return true;
	            }
	            return false;
	        }
	        return false;
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

function _skymount_user() {
	return _skymount_User_Helper::get_instance();
}