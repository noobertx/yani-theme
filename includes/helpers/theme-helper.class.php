<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( '_skymount_Theme_Helper' ) ) {
	class _skymount_Theme_Helper{
		private static $instance = null;
		private $text_domain = "skymount";

		public function init(){
			add_filter( 'style_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
			add_filter( 'script_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
			add_filter('redirect_canonical', array($this,'disable_redirect_canonical'));
			add_action('widgets_init', array($this,'remove_recent_comments_style'));

    		add_action( 'elementor/theme/register_locations', array($this,'register_elementor_templates_locations' ));
    		add_filter('wp_dropdown_users', array($this,'author_override'));

			add_filter('body_class', array($this,'browser_body_class'));

			if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin')) {
        		add_action( 'wp_head', array($this,'add_opengraph'), 5 );
    		}
		}
		

		public function get_option( $id, $fallback = false, $param = false ) {
			if ( isset( $_GET['fave_'.$id] ) ) {
				if ( '-1' == $_GET['fave_'.$id] ) {
					return false;
				} else {
					return $_GET['fave_'.$id];
				}
			} else {
				global $skymount_option;
				if ( $fallback == false ) $fallback = '';
				$output = ( isset($skymount_option[$id]) && $skymount_option[$id] !== '' ) ? $skymount_option[$id] : $fallback;
				if ( !empty($skymount_option[$id]) && $param ) {
					$output = $skymount_option[$id][$param];
				}
			}
			return $output;
		} 

		public function get_date() {
        	return date_i18n( get_option('date_format') );
    	}

    	public  function get_time() {
        	return date_i18n( get_option('time_format') );
    	}

		public function get_text_domain(){
			return $this->text_domain;
		}

		public function is_woocommerce() {

	        if( $this->get_option('skymount_payment_gateways', 'skymount_custom_gw') == 'gw_woocommerce' && class_exists( 'WooCommerce' ) ) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	    public function is_dashboard() {

	        $files = apply_filters( 'skymount_is_dashboard_filter', array(
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_insight.php',
	            'template/user_dashboard_crm.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/user_dashboard_messages.php'
	            
	        ) );

	        if ( is_page_template($files) ) {
	            return true;
	        }
	        return false;
	    }
	   
   		

	   
	    public function get_form_type() {
	        $form_type = $this->get_option('form_type', 'custom_form');

	        if($form_type == 'contact_form_7_gravity_form' || $form_type == 'contact_form_7' || $form_type == 'gravity_form' || $form_type == 'hubspot') {
	            return true;
	        }
	        return false;
	    }
		

	    public function is_transparent_logo() {
	        $css_class = '';
	        $header_type = $this->get_option('header_style');
	        $transparent = get_post_meta(get_the_ID(), 'fave_main_menu_trans', true);

	        if( $transparent != 'no' && !empty($transparent) && ($header_type == '4') ) {
	            return true;
	        }

	        if(_skymount_template()->is_splash()) {
	            return true;
	        }
	        return false;
	    }

   		public function is_elementor(){
	        global $post;
	        if ( did_action( 'elementor/loaded' ) ) {
	            return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
	        }
	        return false;
	    }

	    public function minify_js() {
	        $minify_js = $this->option('minify_js');
	        $js_minify_prefix = '';
	        if ($minify_js != 0) {
	            $js_minify_prefix = '.min';
	        }
	        return $js_minify_prefix;
	    }

	    public function remove_wp_ver_css_js( $src ) {
        	if ( $this->get_option( 'remove_scripts_version', '1' ) ) {
            	if ( strpos( $src, 'ver=' ) ) {
                	$src = remove_query_arg( 'ver', $src );
            	}
        	}
        	return $src;
    	}

    	public function disable_redirect_canonical($redirect_url)    {

	        if (is_singular(array('skymount_agent', 'skymount_agency'))) {
	            $redirect_url = false;
	        }

	        return $redirect_url;
	    }

	    public  function wpml_translate_single_string($string_name) {
	        $translated_string = apply_filters('wpml_translate_single_string', $string_name, 'skymount_cfield', $string_name );

	        return $translated_string;
	    }

	    public function  update_recent_colors( $color, $num_col = 10 ) {
	        if ( empty( $color ) )
	            return false;

	        $current = get_option( 'skymount_recent_colors' );
	        if ( empty( $current ) ) {
	            $current = array();
	        }

	        $update = false;

	        if ( !in_array( $color, $current ) ) {
	            $current[] = $color;
	            if ( count( $current ) > $num_col ) {
	                $current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
	            }
	            $update = true;
	        }

	        if ( $update ) {
	            update_option( 'skymount_recent_colors', $current );
	        }
	    }





	    public function http_or_https() {
	        if (is_ssl()) {
	            $http_or_https = 'https';
	        } else {
	            $http_or_https = 'http';
	        }

	        return $http_or_https;
	    }

	    public function objectToArray ($object) {

	        if(!is_object($object) && !is_array($object))
	            return $object;

	        return array_map(array($this,'objectToArray'), (array) $object);
	    }

	    public function add_opengraph() {
	        if ( is_singular( 'property' ) ) {

	            global $post;
	            if ( has_excerpt( $post->ID ) ) {
	                $description = strip_tags( get_the_excerpt() );
	            } else {
	                $description = str_replace( "\r\n", ' ', substr( strip_tags( strip_shortcodes( $post->post_content ) ), 0, 160 ) );
	            }
	            if ( empty( $description ) ) {
	                $description = get_bloginfo( 'description' );
	            }

	            echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	            echo '<meta property="og:description" content="' . $description . '" />';
	            echo '<meta property="og:type" content="article"/>';
	            echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	            echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
	            if ( has_post_thumbnail( $post->ID ) ) {
	                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	                if( !empty($thumbnail_src) ) {
	                    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[ 0 ] ) . '"/>';
	                }
	            }

	        }
	    }


	    public function clean($string)    {
        	$string = preg_replace('/&#36;/', '', $string);
        	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        	$string = preg_replace('/\D/', '', $string);
        	return $string;
    	}

    	public function clean_20($string) {
       		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	    }


	    public function array_to_comma( $arr_array = array() ) {
        
	       if ( !empty($arr_array) ) {
	            
	            $temp_array = array();
	 
	            foreach ( $arr_array as $item ) {

	                $item = $this->wpml_translate_single_string($item);
	                $temp_array[] = $item;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
	    }

	    public function register_elementor_templates_locations( $elementor_theme_manager ) {

	        $elementor_theme_manager->register_location( 'header' );
	        $elementor_theme_manager->register_location( 'footer' );
	        $elementor_theme_manager->register_location( 'single' );
	        $elementor_theme_manager->register_location( 'archive' );
	    }


	    public function check_classic_editor() {
	        if( class_exists('Classic_Editor') || isset( $_GET['classic-editor'] ) ) {
	            return true;
	        }
	        return false;
	    }

		public function check_theme_option($option,$value,$return) {
	        if( $this->get_option($option, $value) ) {
	            return $return;
	        }
	        return '';
	    }

		public function is_ajax_request() {
        	if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
            	return true;
        	}
        	return false;
    	}

    	public function get_get_local() {
	        $local = get_locale();
	        $local = explode('_', $local);

	        if( isset( $local[0] ) && !empty($local[0]) ) {
	            return $local[0];
	        }
	        
	        return 'en';
	    }

	   	public function enable_svg_type($mimes) {
      		$mimes['svg'] = 'image/svg+xml';
      		return $mimes;
    	}

    	public function author_override($output){
	        global $post, $user_ID;

	        // return if this isn't the theme author override dropdown
	        if (!preg_match('/post_author_override/', $output)) return $output;

	        // return if we've already replaced the list (end recursion)
	        if (preg_match('/post_author_override_replaced/', $output)) return $output;

	        // replacement call to wp_dropdown_users
	        $output = wp_dropdown_users(array(
	            'echo' => 0,
	            'name' => 'post_author_override_replaced',
	            'selected' => empty($post->ID) ? $user_ID : $post->post_author,
	            'include_selected' => true
	        ));

	        // put the original name back
	        $output = preg_replace('/post_author_override_replaced/', 'post_author_override', $output);

	        return $output;
	    }

	    public function get_return_traffic_labels( $prop_id ) {

	        $record_days = $this->get_option('skymount_stats_days');
	        if( empty($record_days) ) {
	            $record_days = 14;
	        }

	        $views_by_date = get_post_meta($prop_id, 'skymount_views_by_date', true);

	        if (!is_array($views_by_date)) {
	            $views_by_date = array();
	        }
	        $array_labels = array_keys($views_by_date);
	        $array_labels = array_slice( $array_labels, -1 * $record_days, $record_days, false );

	        return $array_labels;
	    }

	    public function get_return_traffic_data($prop_id) {

	        $record_days = skymount_option('skymount_stats_days');
	        if( empty($record_days) ) {
	            $record_days = 14;
	        }

	        $views_by_date = get_post_meta( $prop_id, 'skymount_views_by_date', true );
	        if ( !is_array( $views_by_date ) ) {
	            $views_by_date = array();
	        }
	        $array_values = array_values( $views_by_date );
	        $array_values = array_slice( $array_values, -1 * $record_days, $record_days, false );

	        return $array_values;
	    }

	    public function generate_unique_key(){

	        $key = uniqid();
	        return $key;
	    }

	    public function browser_body_class($classes) {
        global $post;
        
        if(skymount_is_dashboard()) {
            $classes[] = 'skymount-dashboard';
        }    
        
        if ( is_page_template( 'template/template-onepage.php' ) ) {
            $classes[] = 'skymount-onepage-mode';
        }

        if( skymount_is_half_map() ) {
            $classes[] = 'skymount-halfmap-page';
        }

        $fave_head_trans = 'no';
        if( skymount_postid_needed() ) {
            $header_type = get_post_meta($post->ID, 'fave_header_type', true);
            $fave_page_header_search = get_post_meta($post->ID, 'fave_page_header_search', true);
            if ($fave_page_header_search != 'yes') {
                $fave_head_trans = get_post_meta($post->ID, 'fave_main_menu_trans', true);

                $classes[] = 'transparent-'.$fave_head_trans;
            }
            $classes[] = 'skymount-header-'.$header_type;
        }
            
        return $classes;
    }

    public function return_formatted_date($date_unix) {

        $return_date = '';
        if(!empty($date_unix)) {
            $return_date = date(get_option( 'date_format' ), $date_unix);
        }
        return $return_date;
        
    }

    public function get_formatted_time($date_unix) {

        $return_time = '';
        if(!empty($date_unix)) {
            $return_time = date(get_option( 'time_format' ), $date_unix);
        }
        return $return_time;
        
    }

    public function traverse_comma_string($string) {
        if(!empty($string)) {
            $string_array = explode(',', $string);
            
            if(!empty($string_array[0])) {
                return $string_array;
            }
        }
        return '';
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


function _skymount_theme() {
	return _skymount_Theme_Helper::get_instance();
}