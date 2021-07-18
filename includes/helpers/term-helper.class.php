<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Term_Helper' ) ) {
	class _skymount_Term_Helper{
		private static $instance = null;		
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function get_term_slug($term_id, $tax) {
	        if(!empty($term_id)) {
	            $term = get_term( $term_id, $tax );

	            if( !is_wp_error($term) && !empty($term) ) {
	                return $term->slug;
	            }
	            return '';
	        }
	        return '';
	    }

	    public function get_terms_array( $tax_name, &$terms_array ) {

	        $tax_terms = get_terms( array(
	            'taxonomy'   => $tax_name,
	            'hide_empty' => false,
	        ) );
	        $this->add_term_children( 0, $tax_terms, $terms_array );
	    }

	    public  function add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
	        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
	            foreach ( $tax_terms as $term ) {
	                if ( $term->parent == $parent_id ) {
	                    $terms_array[ $term->slug ] = $prefix . $term->name;
	                    skymount_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
	                }
	            }
	        }
	    }

		    public function skymount_get_term_id_by_slug($slug, $taxonomy) {
	        if( !taxonomy_exists($taxonomy) && empty($slug)) {
	            return '';
	        }
	        $term = get_term_by('slug', $slug, $taxonomy);
	        if(empty($term)) {
	            return '';
	        }
	        return $term->term_id;
	    }

	    public function get_term_name_by_slug($slug, $taxonomy) {
	        if( !taxonomy_exists($taxonomy) && empty($slug)) {
	            return '';
	        }
	        $term = get_term_by('slug', $slug, $taxonomy);
	        if(empty($term)) {
	            return '';
	        }
	        return $term->name;
	    }

	    public function get_taxonomy_id( $tax_name )    {
	        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "ids"));
	        $term_id = '';
	        if (!empty($terms) && ! is_wp_error( $terms )):
	            foreach( $terms as $term ):
	                $term_id = $term;
	            endforeach;
	            return $term_id;
	        endif;
	        return '';
	    }

	    public function get_saved_search_term ($slugs, $taxonomy) {
		    $temp_array = array();

		    if(is_array($slugs) && !empty($slugs)) {
		        foreach ($slugs as $slug) {
		            $term = get_term_by('slug', $slug, $taxonomy);
		            $temp_array[] = $term->name;
		        }

		        $result = join( ", ", $temp_array );
		        return $result;
		    }
		    return '';
		}


		public  function get_term_by( $field, $value, $taxonomy ) {
	        $term = get_term_by( $field, $value, $taxonomy );
	        if( $term ) {
	            return $term;
	        }
	        return false;
	    }
	}
}

function _skymount_terms() {
	return _skymount_Term_Helper::get_instance();
}

