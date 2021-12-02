<div class="form-group">
	<label><?php echo _yani_theme()->get_option('cl_content', 'Content'); ?></label>
	<?php
	$editor_id = 'prop_des';
	$settings = array(
	    'media_buttons' => false,
	    'textarea_rows' => 10,
	);
	if (_yani_post()->can_be_editted()) {
	    global $property_data;
	    wp_editor($property_data->post_content, $editor_id, $settings);
	} else {
	    wp_editor('', $editor_id, $settings);
	}
	?>
</div>