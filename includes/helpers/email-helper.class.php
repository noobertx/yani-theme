<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Email_Helper' ) ) {
	class _skymount_Email_Helper{
		private static $instance = null;		
		public function get_form_user_type($token) {
    
	       $value = '';
	       
	       if( $token == 'buyer' ) {
	            $value = _skymount_theme()->get_option('spl_con_buyer', "I'm a buyer");

	       } else if( $token == 'tennant' ) {
	            $value = _skymount_theme()->get_option('spl_con_tennant', "I'm a tennant");

	       } else if( $token == 'agent' ) {
	            $value = _skymount_theme()->get_option('spl_con_agent', "I'm an agent");

	       } else if( $token == 'other' ) {
	            $value = _skymount_theme()->get_option('spl_con_other', "Other");
	       } 

	       return $value;
	    }

	    public function webhook_post_for_inquiry_contact_widget( $webhook_url, array $formData, $formId = 'contact_form' ) {

	        $webhook_url = esc_url($webhook_url);

	        $exclude_form_fields = apply_filters( 'skymount_widget_webhook_exclude_form_fields',
	            array( 
	                'action',
	                'webhook',
	                'webhook_url',
	                'redirect_to',
	                'email_to', 
	                'email_subject',
	                'email_to_cc',
	                'email_to_bcc',
	                'skymount_contact_form',
	            ),
	            $formId
	        );

	        $formData = array_merge( $formData, array( 'form_id' => $formId ) );

	        if ( !empty( $formData ) && is_array( $formData ) ) {
	            if ( !empty( $exclude_form_fields ) && is_array( $exclude_form_fields ) ) {
	                foreach ( $exclude_form_fields as $field ) {
	                    if ( isset( $formData[ $field ] ) ) {
	                        unset( $formData[ $field ] );
	                    }
	                }
	            }
	        }

	        
	        if ( !empty( $formData ) && !empty( $webhook_url ) ) {
	            $args = apply_filters( 'skymount_widget_webhook_post_args', array(
	                'body'    => wp_json_encode( $formData ),
	                'headers' => array(
	                    'Content-Type' => 'application/json; charset=UTF-8',
	                ),
	            ) );

	            wp_safe_remote_post( $webhook_url, $args );
	        }
	    }

	    public function webhook_post( array $formData, $formId = 'property_agent_contact_form' ) {

        $webhook_url = _skymount_theme()->get_option( 'skymount_webhook_url' );

        $exclude_form_fields = apply_filters( 'skymount_webhook_exclude_form_fields',
            array( 
                'action',
                'target_email',
                'property_nonce',
                'prop_payment',
                'property_agent_contact_security',
                'contact_realtor_ajax', 
                'is_listing_form',
                'submit',
                'realtor_page',
            ),
            $formId
        );

        $formData = array_merge( $formData, array( 'form_id' => $formId ) );

        if ( !empty( $formData ) && is_array( $formData ) ) {
            if ( !empty( $exclude_form_fields ) && is_array( $exclude_form_fields ) ) {
                foreach ( $exclude_form_fields as $field ) {
                    if ( isset( $formData[ $field ] ) ) {
                        unset( $formData[ $field ] );
                    }
                }
            }
        }

        
        if ( !empty( $formData ) && !empty( $webhook_url ) ) {
            $args = apply_filters( 'skymount_webhook_post_args', array(
                'body'    => wp_json_encode( $formData ),
                'headers' => array(
                    'Content-Type' => 'application/json; charset=UTF-8',
                ),
            ) );

            wp_safe_remote_post( $webhook_url, $args );
        }
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

function _skymount_email() {
	return _skymount_Email_Helper::get_instance();
}