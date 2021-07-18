<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_skymount_Form_Helper' ) ) {
	class _skymount_Form_Helper{
		private static $instance = null;	

		public function get_required_field_symbol( $field ,$symbol=" *") {
	        $required_fields = _skymount_theme()->get_option('required_fields');
	        
	        if(array_key_exists($field, $required_fields)) {
	            $field = $required_fields[$field];
	            if( $field != 0 ) {
	                return $symbol;
	            }
	        }
	        
	        return '';
	    }	
	    public function get_multiselect($value) {
	        $is_multiselect = $this->is_multiselect($value);

	        if($is_multiselect) {
	            return 'multiple';
	        }
	        return '';
	    }

	    public function is_multiselect($value = false) {
	        if($value) {
	            return true;
	        }
	        return false;
	    }

	    public function get_taxonomies_for_edit_listing_multivalue( $listing_id, $taxonomy ){

	        $taxonomy_terms_ids= array();
	        $taxonomy_terms = get_the_terms( $listing_id, $taxonomy );

	        if ( $taxonomy_terms && ! is_wp_error( $taxonomy_terms ) ) {
	            foreach( $taxonomy_terms as $term ) {
	                $taxonomy_terms_ids[] = intval( $term->term_id );
	            }
	        }

	        $parent_taxonomy = get_terms(
	            array(
	                $taxonomy
	            ),
	            array(
	                'orderby'       => 'name',
	                'order'         => 'ASC',
	                'hide_empty'    => false,
	                'parent' => 0
	            )
	        );

	        $this->get_taxonomies_for_edit_listing_multivalue_child( $taxonomy, $parent_taxonomy, $taxonomy_terms_ids );

	    }

	    public function get_taxonomies_for_edit_listing_multivalue_child($taxonomy, $parent_taxonomy, $terms_ids, $prefix = " " ){

	        if (!empty($parent_taxonomy)) {
	                    
	            foreach ($parent_taxonomy as $p_tax) {

	                if ( in_array( $p_tax->term_id, $terms_ids ) ) {
	                    echo '<option value="' . $p_tax->term_id . '" selected="selected">'. $prefix . $p_tax->name . '</option>';
	                } else {
	                    echo '<option value="' . $p_tax->term_id . '">'. $prefix . $p_tax->name . '</option>';
	                }

	                $get_child_tax = get_terms($taxonomy, array(
	                    'hide_empty' => false,
	                    'parent' => $p_tax->term_id
	                ));

	                if (!empty($get_child_tax)) {
	                    $this->get_taxonomies_for_edit_listing_multivalue_child( $taxonomy, $get_child_tax, $terms_ids, "- ".$prefix );
	                }

	            }
	        }
	    }

	    public function get_taxonomies_with_id_value($taxonomy, $parent_taxonomy, $taxonomy_id, $prefix = " " ){

        if (!empty($parent_taxonomy)) {
            foreach ($parent_taxonomy as $term) {
                if ($taxonomy_id != $term->term_id) {
                    echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
                }
                $get_child_terms = get_terms($taxonomy, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($get_child_terms)) {
                    $this->get_taxonomies_with_id_value( $taxonomy, $get_child_terms, $taxonomy_id, "- ".$prefix );
                }
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

function _skymount_form() {
	return _skymount_Form_Helper::get_instance();
}