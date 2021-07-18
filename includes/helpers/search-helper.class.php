<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Search_Helper' ) ) {
	class _skymount_Search_Helper{
		private static $instance = null;		

		function __construct(){
			add_filter('_skymount20_search_filters', array($this,'properties_search'));

		}

		public function properties_search($search_qry) {
			$tax_query = array();
	        $meta_query = array();
	        $allowed_html = array();
	        $keyword_array = '';
	        $keyword_field = _skymount_theme()->get_option('keyword_field');

	        $search_location = isset($_GET['search_location']) ? esc_attr($_GET['search_location']) : false;
	        $use_radius = 'on';
	        $search_lat = isset($_GET['lat']) ? (float)$_GET['lat'] : false;
	        $search_long = isset($_GET['lng']) ? (float)$_GET['lng'] : false;
	        $search_radius = isset($_GET['radius']) ? (int)$_GET['radius'] : false;

	        $search_qry = apply_filters('skymount_radius_filter', $search_qry, $search_lat, $search_long, $search_radius, $use_radius, $search_location);

	        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
	            if ($keyword_field == 'prop_address') {
	                
	                $keyword_array = $this->keyword_meta_address();

	            } else if ($keyword_field == 'prop_city_state_county') {
	        
	                $taxlocation[] = sanitize_title(wp_kses($_GET['keyword'], $allowed_html));
			        $_tax_query = Array();
			        $_tax_query['relation'] = 'OR';

			        $_tax_query[] = array(
			            'taxonomy' => 'property_area',
			            'field' => 'slug',
			            'terms' => $taxlocation
			        );

			        $_tax_query[] = array(
			            'taxonomy' => 'property_city',
			            'field' => 'slug',
			            'terms' => $taxlocation
			        );

			        $_tax_query[] = array(
			            'taxonomy' => 'property_state',
			            'field' => 'slug',
			            'terms' => $taxlocation
			        );
			        $tax_query[] = $_tax_query;
	                
	            } else {
	            
	                $search_qry = $this->keyword_search($search_qry);
	            }
	        }

			$tax_query = apply_filters( 'skymount_taxonomy_search_filter', $tax_query );
			$tax_count = count($tax_query);
	        $tax_query['relation'] = 'AND';
	        if ($tax_count > 0) {
	            $search_qry['tax_query'] = $tax_query;
	        }

	        $meta_query = apply_filters( 'skymount_meta_search_filter', $meta_query );
	        $meta_count = count($meta_query);
	        if ($meta_count > 0 || !empty($keyword_array)) {
	            $search_qry['meta_query'] = array(
	                'relation' => 'AND',
	                $keyword_array,
	                array(
	                    'relation' => 'AND',
	                    $meta_query
	                ),
	            );
	        }
	        /*echo '<pre>';
	        print_r($search_qry);*/
	        return $search_qry;

		}

		public function keyword_meta_address() {
			$allowed_html = array();
			$property_id_prefix = _skymount_theme()->get_option('property_id_prefix');

			$meta_keywork = wp_kses(stripcslashes($_GET['keyword']), $allowed_html);
	        $address_array = array(
	            'key' => 'fave_property_map_address',
	            'value' => $meta_keywork,
	            'type' => 'CHAR',
	            'compare' => 'LIKE',
	        );

	        $street_array = array(
	            'key' => 'fave_property_address',
	            'value' => $meta_keywork,
	            'type' => 'CHAR',
	            'compare' => 'LIKE',
	        );

	        $zip_array = array(
	            'key' => 'fave_property_zip',
	            'value' => $meta_keywork,
	            'type' => 'CHAR',
	            'compare' => '=',
	        );

	        $propid_array = array(
	            'key' => 'fave_property_id',
	            'value' => str_replace($property_id_prefix, "", $meta_keywork),
	            'type' => 'CHAR',
	            'compare' => '=',
	        );

	        $keyword_array = array(
	            'relation' => 'OR',
	            $address_array,
	            $street_array,
	            $propid_array,
	            $zip_array
	        );

	        return $keyword_array;
		}

		public function keyword_search($search_qry) {

			if (isset($_GET['keyword'])) {
				$keyword = trim($_GET['keyword']);

				if (!empty($keyword)) {
					$search_qry['s'] = $keyword;
					return $search_qry;
				}
			}
			return $search_qry;
		}

		public function search_builder_custom_field_elementor () {
	        $fields_array = array();
	        if(class_exists('skymount_Fields_Builder')) {
	            $fields = skymount_Fields_Builder::get_search_fields();

	            if(!empty($fields)) {
	                foreach ( $fields as $value ) {
	                    $field_title = $value->label;
	                    $field_name = $value->field_id;
	                    
	                    $fields_array[$field_name] = $field_title; 
	                }
	            }
	        }

	        return $fields_array;
	    }

	    		public function adv_search_visible() {
	        $adv_visible = _skymount_theme()->get_option('header-search-visible', 0);
	        $adv_halfmap_visible = _skymount_theme()->get_option('halfmap-search-visible', 0);

	        if( isset($_GET['s_visible']) && $_GET['s_visible'] == 'yes' ) {
	            $adv_visible = 1;
	        }

	        if(_skymount_template()->is_half_map()) {
	            return $adv_halfmap_visible;
	        } else {
	            return $adv_visible;
	        }
	    }

	    public function search_builder() {
	        if(_skymount_template()->is_half_map()) {
	            return _skymount_theme()->get_option('search_builder_halfmap');
	        } else {
	            return _skymount_theme()->get_option('search_builder');
	        }
	    }

	    public function is_radius_search() {
	        if(_skymount_template()->is_half_map()) {
	            return _skymount_theme()->get_option('enable_radius_search_halfmap');
	        } else {
	            return _skymount_theme()->get_option('enable_radius_search');
	        }
	    }

	    public function get_header_search_width() {
	        $search_width = _skymount_theme()->get_option('search_width', 'container');

	        if(_skymount_template()->is_half_map()) {
	            $search_width = 'container-fluid';
	        }

	        return $search_width;
	    }

	    public function get_search_filters_class() {
	        if( _skymount_template()->is_half_map() ) {
	            return 'skymount-search-filters-js';
	        }
	        return '';
	    }

	    public function get_search_builtIn_fields() {
	        $array = array(
	            'keyword',
	            'city',
	            'areas',
	            'status',
	            'type',
	            'bedrooms',
	            'rooms',
	            'bathrooms',
	            'min-area',
	            'max-area',
	            'min-land-area',
	            'max-land-area',
	            'min-price',
	            'max-price',
	            'property-id',
	            'label',
	            'state',
	            'country',
	            'price',
	            'geolocation',
	            'price-range',
	            'garage',
	            'year-built',
	        );
	        return $array;
	    }

	    public function get_search_builder_first_row() {

	        if( (isset($_GET['search_style']) && $_GET['search_style'] == 'style_3') || ( isset($_GET['halfmap_search']) && $_GET['halfmap_search'] == 'v3') ) {
	            return 5;
	        }

	        if(_skymount_template()->is_half_map()) {
	            return _skymount_theme()->get_option('search_top_row_fields_halfmap');
	        } else {
	            return _skymount_theme()->get_option('search_top_row_fields');
	        }
	    }

	    public  function get_adv_search_visible() {
	        $adv_visible = _skymount_theme()->get_option('header-search-visible', 0);
	        $adv_halfmap_visible = _skymount_theme()->get_option('halfmap-search-visible', 0);

	        if( isset($_GET['s_visible']) && $_GET['s_visible'] == 'yes' ) {
	            $adv_visible = 1;
	        }

	        if(_skymount_template()->is_half_map()) {
	            return $adv_halfmap_visible;
	        } else {
	            return $adv_visible;
	        }
	    }

	    public function get_ajax_search() {
	        $ajax_class = '';
	        if( (is_page_template(array('template/template-search.php')) && _skymount_theme()->get_option('search_result_page') == 'half_map') || is_page_template(array('template/property-listings-map.php')) ) {
	            $ajax_class = 'skymount_search_ajax';

	        }
	        return $ajax_class;
	    }


	   public function render_banner_search_autocomplete_html () {
	        global $post;
	        $banner_search = get_post_meta( $post->ID, 'fave_page_header_search', true );

	        if( $banner_search ) {
	            if( _skymount_theme()->get_option('banner_radius_search', 0) != 1 ) {
	                echo '<div id="skymount-auto-complete-banner" class="auto-complete"></div>';
	            }
	        }
	    }

	    public function get_header_search_position() {
        
        $search_position = _skymount_theme()->get_option('search_position');
        $adv_search_pos = get_post_meta(get_the_ID(), 'fave_adv_search_pos', true);
        $hide_show = get_post_meta(get_the_ID(), 'fave_adv_search', true);
        $header_type = get_post_meta(get_the_ID(), 'fave_header_type', true);

        if( $adv_search_pos == 'under_menu' && $hide_show == 'hide_show') {
            $search_position = 'under_banner';

        } elseif( $adv_search_pos == 'under_banner') {
            $search_position = 'under_banner';
        }

        if( $header_type == 'none' && wp_is_mobile() ) {
            $search_position = 'under_nav';
        }

        return $search_position;
    }
	    

	    public function search_builtIn_fields_elementor() {
	        $array = array(
	            'keyword' => esc_html__('keyword', _skymount_theme()->get_text_domain()),
	            'status' => esc_html__('Status', _skymount_theme()->get_text_domain()),
	            'type' => esc_html__('Type', _skymount_theme()->get_text_domain()),
	            'bedrooms' => esc_html__('Bedrooms', _skymount_theme()->get_text_domain()),
	            'rooms' => esc_html__('Bedrooms', _skymount_theme()->get_text_domain()),
	            'bathrooms' => esc_html__('Bathrooms', _skymount_theme()->get_text_domain()),
	            'min-area' => esc_html__('Min Area', _skymount_theme()->get_text_domain()),
	            'max-area' => esc_html__('Max Area', _skymount_theme()->get_text_domain()),
	            'min-price' => esc_html__('Min Price', _skymount_theme()->get_text_domain()),
	            'max-price' => esc_html__('Max Price', _skymount_theme()->get_text_domain()),
	            'property-id' => esc_html__('Property ID', _skymount_theme()->get_text_domain()),
	            'label' => esc_html__('Labels', _skymount_theme()->get_text_domain()),
	            'min-land-area' => esc_html__('Min Land Area', _skymount_theme()->get_text_domain()),
	            'max-land-area' => esc_html__('Max Land Area', _skymount_theme()->get_text_domain()),
	            'country' => esc_html__('Country', _skymount_theme()->get_text_domain()),
	            'state' => esc_html__('State', _skymount_theme()->get_text_domain()),
	            'city' => esc_html__('City', _skymount_theme()->get_text_domain()),
	            'areas' => esc_html__('Area', _skymount_theme()->get_text_domain()),
	            'geolocation' => esc_html__('Geolocation', _skymount_theme()->get_text_domain()),
	            'price-range' => esc_html__('Price Range', _skymount_theme()->get_text_domain()),
	            'garage' => esc_html__('Garage', _skymount_theme()->get_text_domain()),
	            'year-built' => esc_html__('Year Built', _skymount_theme()->get_text_domain()),
	            'submit-button' => esc_html__('Search Button', _skymount_theme()->get_text_domain()),
	        );

	        if(!taxonomy_exists('property_country')) {
	            unset($array['country']);
	        }

	        if(!taxonomy_exists('property_state')) {
	            unset($array['state']);
	        }

	        if(!taxonomy_exists('property_city')) {
	            unset($array['city']);
	        }

	        if(!taxonomy_exists('property_area')) {
	            unset($array['areas']);
	        }

	        return $array;
    	}

    	public function get_custom_search_fields() {
	        $custom_fields_array = array();
	        $custom_search_fields_array = array();
	        if(class_exists('skymount_Fields_Builder')) {
	            $fields = skymount_Fields_Builder::get_form_fields();

	            if(!empty($fields)) {
	                foreach ( $fields as $value ) {
	                    $field_title = $value->label;
	                    $field_name = $value->field_id;
	                    $is_search = $value->is_search;
	                    
	                    $custom_fields_array[$field_name] = $field_title; 

	                    if($is_search == 'yes') {
	                        $custom_search_fields_array[$field_name] = $field_title;
	                    }
	                }
	            }
	        }

	        return $custom_search_fields_array;
	    }
	    public function render_dock_search_class() {
	        $dock_search_enable = _skymount_theme()->option('enable_advanced_search_over_headers');
	        $search_over_header_pages = _skymount_theme()->option('adv_search_over_header_pages');
	        $search_selected_pages = _skymount_theme()->option('adv_search_selected_pages');
	        $return_class = '';

	        if( $dock_search_enable != 0 ) {
	            if( $search_over_header_pages == 'only_home' ) {
	                if (is_front_page()) {
	                    $return_class = 'top-banner-wrap-dock-search';
	                }
	            } else if( $search_over_header_pages == 'all_pages' ) {
	                    $return_class = 'top-banner-wrap-dock-search';

	            } else if ( $search_over_header_pages == 'only_innerpages' ){
	                if (!is_front_page()) {
	                     $return_class = 'top-banner-wrap-dock-search';
	                }
	            } else if( $search_over_header_pages == 'specific_pages' ) {
	                if( is_page( $search_selected_pages ) ) {
	                     $return_class = 'top-banner-wrap-dock-search';
	                }
	            }
	        }

	        return $return_class;
	    }

	    public function get_banner_search_type() {
	        $banner_search = get_post_meta(get_the_ID(), 'fave_page_header_search', true);
	        $search_style = get_post_meta(get_the_ID(), 'fave_head_search_style', true);
	        if( $banner_search != 0 ) {
	            if($search_style == 'vertical') {
	                echo 'vertical-search-wrap';
	            } else {
	                echo 'horizontal-search-wrap';
	            }
	        }
	        return '';
	    }

	    public function is_price_range_search() {
	        if(_Skymount_template()->is_half_map()) {
	            return _skymount_theme()->get_option('price_range_halfmap');
	        } else {
	            return _skymount_theme()->get_option('price_range');
	        }
    	}
    	public function is_other_featuers_search() {
	        if(_Skymount_template()->is_half_map()) {
	            return _skymount_theme()->get_option('search_other_features_halfmap');
	        } else {
	            return _skymount_theme()->get_option('search_other_features');
	        }
	    }

	    public function is_adv_search_visible() {
	        $adv_visible = _skymount_theme()->get_option('header-search-visible', 0);
	        $adv_halfmap_visible = _skymount_theme()->get_option('halfmap-search-visible', 0);

	        if( isset($_GET['s_visible']) && $_GET['s_visible'] == 'yes' ) {
	            $adv_visible = 1;
	        }

	        if(skymount_is_half_map()) {
	            return $adv_halfmap_visible;
	        } else {
	            return $adv_visible;
	        }
	    }

	    public function dummy_search_style_3() {
        
	        $fields_array = array( 
	            'keyword' => 'Keyword',
	            'bedrooms' => 'Bedrooms',
	            'price' => 'Price',
	            'type' => 'Type', 
	            'status' => 'Status',
	            'city' => 'city',
	            'min-area' => 'min-area',
	            'max-area' => 'max-area',
	            'bathrooms' => 'Bathrooms',
	            'property-id' => 'property-id',
	        );
	        return $fields_array;
	    }


    	public function render_search_style() {

	        $search_style = _skymount_theme()->get_option('search_style', 'style_1');
	        $halfmap_search = _skymount_theme()->get_option('halfmap_search_layout', 'v1');

	        if(isset($_GET['search_style'])) {
	            $search_style = $_GET['search_style'];
	        }
	        if(isset($_GET['halfmap_search'])) {
	            $halfmap_search = $_GET['halfmap_search'];
	        }

	        if(skymount_is_half_map()) {

	            if( $halfmap_search == 'v3' ) {
	                return true;
	            } else {
	                return false;
	            }
	            
	        } else {
	            if( $search_style == 'style_3' ) {
	                return true;
	            } else {
	                return false;
	            }
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

function _skymount_search() {
	return _skymount_Search_Helper::get_instance();
}