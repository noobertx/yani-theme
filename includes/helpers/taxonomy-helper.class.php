<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Taxonomy_Helper' ) ) {
	class _skymount_Taxonomy_Helper{
		private static $instance = null;	

		public function get_taxonomy_simple( $tax_name ) {        
	        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "names"));
	        if (!empty($terms) && ! is_wp_error( $terms ) ) {
	            
	            $temp_array = array();
	 
	            foreach ( $terms as $term ) {
	                $temp_array[] = $term;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
	    }

	    public function get_post_term_slug( $post_id, $tax_name ) {
	        $terms = get_the_terms( $post_id, $tax_name );
	        if ( !empty( $terms ) ){
	            // get the first term
	            $term = array_shift( $terms );
	            return $term->slug;
	        }
	    }

	    public function taxonomy_by_postID( $property_id, $taxonomy_name ){

	        $tax_terms = get_the_terms( $property_id, $taxonomy_name );
	        $tax_name = '';
	        if( !empty($tax_terms) ){
	            foreach( $tax_terms as $tax_term ){
	                $tax_name = $tax_term->name;
	                break;
	            }
	        }
	        return $tax_name;
	    }

	    public function hide_empty_taxonomies() {
	        $state_city_area_dropdowns = _skymount_theme()->get_option('state_city_area_dropdowns');
	        if( $state_city_area_dropdowns != 0 ) {
	            $hide_empty = true;
	        } else {
	            $hide_empty = false;
	        }

	        return $hide_empty;
	    }

	    public function check_for_taxonomy($tax_setting_name) {

	        if(class_exists('skymount_Taxonomies')) {
	            if(skymount_Taxonomies::get_setting($tax_setting_name) != 'disabled') {
	                return true;
	            } else {
	                return false;
	            }
	        }

	        return true;
	    }

	    public function is_tax() {
	        if(is_tax(
	                array(
	                    'property_type',
	                    'property_status',
	                    'property_feature',
	                    'property_label',
	                    'property_country',
	                    'property_state',
	                    'property_city',
	                    'property_area'
	                )
	            )
	        ) {
	            return true;
	        }
	        return false;
	    }

	    public  function skymount_taxonomy_simple_2( $tax_name, $propID ) {

	        $terms = wp_get_post_terms( $propID, $tax_name, array("fields" => "names"));
	        if (!empty($terms) && ! is_wp_error( $terms )){
	            $temp_array = array();
	 
	            foreach ( $terms as $term ) {
	                $temp_array[] = $term;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
	    }

	    public function render_hirarchical_options($taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ){

	        if (!empty($taxonomy_terms) && taxonomy_exists($taxonomy_name)) {
	            foreach ($taxonomy_terms as $term) {

	                if( $taxonomy_name == 'property_area' ) {
	                    $term_meta= get_option( "_skymount_property_area_$term->term_id");
	                    $parent_city = sanitize_title($term_meta['parent_city']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }
	                    
	                } elseif( $taxonomy_name == 'property_city' ) {
	                    $term_meta= get_option( "_skymount_property_city_$term->term_id");
	                    $parent_state = sanitize_title($term_meta['parent_state']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } elseif( $taxonomy_name == 'property_state' ) {

	                    $term_meta = get_option( "_skymount_property_state_$term->term_id");
	                    $parent_country = sanitize_title($term_meta['parent_country']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } elseif( $taxonomy_name == 'property_country' ) {
	            
	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } else {

	                    if ($searched_term == $term->slug) {
	                        echo '<option value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    }
	                }


	                $child_terms = get_terms($taxonomy_name, array(
	                    'hide_empty' => false,
	                    'parent' => $term->term_id
	                ));

	                if (!empty($child_terms)) {
	                    $this->render_hirarchical_options( $taxonomy_name, $child_terms, $searched_term, "- ".$prefix );
	                }
	            }
	        }
	    }

	    public function render_taxonomy_hirarchical_options_for_search($taxonomy_name, $taxonomy_terms, $target_term_name, $prefix = " " ){
        if (!empty($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {

                if( $taxonomy_name == 'property_area' ) {
                    $term_meta= get_option( "_skymount_property_area_$term->term_id");
                    $parent_city = sanitize_title($term_meta['parent_city']);

                    if ($target_term_name == $term->slug) {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
                    } else {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
                    }

                } elseif( $taxonomy_name == 'property_city' ) {
                    $term_meta= get_option( "_skymount_property_city_$term->term_id");
                    $parent_state = sanitize_title($term_meta['parent_state']);

                    if ($target_term_name == $term->slug) {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
                    } else {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
                    }

                }  elseif( $taxonomy_name == 'property_state' ) {
                    $term_meta= get_option( "_skymount_property_state_$term->term_id");
                    $parent_country = sanitize_title($term_meta['parent_country']);

                    if ($target_term_name == $term->slug) {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
                    } else {
                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
                    }

                } elseif( $taxonomy_name == 'property_country' ) {
            
                    if ($target_term_name == $term->slug) {
                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
                    } else {
                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
                    }

                } else {
                    if ($target_term_name == $term->slug) {
                        echo '<option value="' . urldecode($term->slug) . '" selected="selected">' . $prefix . $term->name . '</option>';
                    } else {
                        echo '<option value="' . urldecode($term->slug) . '">' . $prefix . $term->name . '</option>';
                    }
                }


                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    $this->render_taxonomy_hirarchical_options_for_search( $taxonomy_name, $child_terms, $target_term_name, "- ".$prefix );
                }
            }
        }
    }
	    public  function get_search_taxonomies($taxonomy_name, $searched_data = "", $args = array() ){
        
        $hide_empty = false;
        if($taxonomy_name == 'property_city' || $taxonomy_name == 'property_area' || $taxonomy_name == 'property_country' || $taxonomy_name == 'property_state') {
            $hide_empty = $this->hide_empty_taxonomies();
        }
        
        $defaults = array(
            'taxonomy' => $taxonomy_name,
            'orderby'       => 'name',
            'order'         => 'ASC',
            'hide_empty'    => $hide_empty,
        );

        $args       = wp_parse_args( $args, $defaults );
        $taxonomies = get_terms( $args );

        if ( empty( $taxonomies ) || is_wp_error( $taxonomies ) ) {
            return false;
        }

        $output = '';
        foreach( $taxonomies as $category ) {
            if( $category->parent == 0 ) {

                $data_attr = $data_subtext = '';

                if( $taxonomy_name == 'property_city' ) {
                    $term_meta= get_option( "_skymount_property_city_$category->term_id");
                    $parent_state = isset($term_meta['parent_state']) ? $term_meta['parent_state'] : '';
                    $parent_state = sanitize_title($parent_state);
                    $data_attr = 'data-belong="'.esc_attr($parent_state).'"';
                    $data_subtext = 'data-subtext="'._skymount_terms()->get_term_name_by_slug($parent_state, 'property_state').'"';

                } elseif( $taxonomy_name == 'property_area' ) {
                    $term_meta= get_option( "_skymount_property_area_$category->term_id");
                    $parent_city = isset($term_meta['parent_city']) ? $term_meta['parent_city'] : '';
                    $parent_city = sanitize_title($parent_city);
                    $data_attr = 'data-belong="'.esc_attr($parent_city).'"';
                    $data_subtext = 'data-subtext="'._skymount_terms()->get_term_name_by_slug($parent_city, 'property_city').'"';

                } elseif( $taxonomy_name == 'property_state' ) {
                    $term_meta = get_option( "_skymount_property_state_$category->term_id");
                    $parent_country = isset($term_meta['parent_country']) ? $term_meta['parent_country'] : '';
                    $parent_country = sanitize_title($parent_country);
                    $data_attr = 'data-belong="'.esc_attr($parent_country).'"';
                    $data_subtext = 'data-subtext="'._skymount_terms()->get_term_name_by_slug($parent_country, 'property_country').'"';

                }

                if ( !empty($searched_data) && in_array( $category->slug, $searched_data ) ) {
                    $output.= '<option data-ref="'.esc_attr($category->slug).'" '.$data_attr.' '.$data_subtext.' value="' . esc_attr($category->slug) . '" selected="selected">'. esc_attr($category->name) . '</option>';
                } else {
                    $output.= '<option data-ref="'.esc_attr($category->slug).'" '.$data_attr.' '.$data_subtext.' value="' . esc_attr($category->slug) . '">' . esc_attr($category->name) . '</option>';
                }

                foreach( $taxonomies as $subcategory ) {
                    if($subcategory->parent == $category->term_id) {

                        $data_attr_child = '';
                        if( $taxonomy_name == 'property_city' ) {
                            $term_meta= get_option( "_skymount_property_city_$subcategory->term_id");
                            $parent_state = isset($term_meta['parent_state']) ? $term_meta['parent_state'] : '';
                            $parent_state = sanitize_title($parent_state);
                            $data_attr_child = 'data-belong="'.esc_attr($parent_state).'"';

                        } elseif( $taxonomy_name == 'property_area' ) {
                            $term_meta= get_option( "_skymount_property_area_$subcategory->term_id");
                            $parent_city = isset($term_meta['parent_city']) ? $term_meta['parent_city'] : '';
                            $parent_city = sanitize_title($parent_city);
                            $data_attr_child = 'data-belong="'.esc_attr($parent_city).'"';

                        } elseif( $taxonomy_name == 'property_state' ) {
                            $term_meta= get_option( "_skymount_property_state_$subcategory->term_id");
                            $parent_country = isset($term_meta['parent_country']) ? $term_meta['parent_country'] : '';
                            $parent_country = sanitize_title($parent_country);
                            $data_attr_child = 'data-belong="'.esc_attr($parent_country).'"';
                        }

                        if ( !empty($searched_data) && in_array( $subcategory->slug, $searched_data ) ) {
                            $output.= '<option data-ref="'.esc_attr($subcategory->slug).'" '.$data_attr_child.' value="' . esc_attr($subcategory->slug) . '" selected="selected"> - '. esc_attr($subcategory->name) . '</option>';
                        } else {
                            $output.= '<option data-ref="'.esc_attr($subcategory->slug).'" '.$data_attr_child.' value="' . esc_attr($subcategory->slug) . '"> - ' . esc_attr($subcategory->name) . '</option>';
                        }
                    }
                }
            }
        }
        echo $output;

    }

    public function render_taxonomy_edit_hirarchical_options_for_search( $property_id, $taxonomy_name ){

        $existing_term_name = '';
        $taxonomy_terms = get_the_terms( $property_id, $taxonomy_name );

        if( !empty($taxonomy_terms) ){
            foreach( $taxonomy_terms as $tax_term ){
                $existing_term_name = $tax_term->slug;
                break;
            }
        }

        if( empty($existing_term_name) ){
            echo '<option value="" selected="selected">'._skymount_theme()->get_option('cl_none', 'None').'</option>';
        } else {
            echo '<option value="">'._skymount_theme()->get_option('cl_none', 'None').'</option>';
        }

        $parent_terms = get_terms(
            array(
                $taxonomy_name
            ),
            array(
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'parent' => 0
            )
        );
        $this->taxonomy_hirarchical_options_for_search( $taxonomy_name, $parent_terms, $existing_term_name );

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

function _skymount_taxonomy() {
	return _skymount_Taxonomy_Helper::get_instance();
}