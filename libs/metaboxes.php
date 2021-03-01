<?php

function _themename_add_meta_box(){
	add_meta_box(
		'_themename_post_metabox',
		'Page Settings',
		'_themename_post_metabox_render',
		'page',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes','_themename_add_meta_box');

function _themename_post_metabox_render($post){ 
	$hide_title = get_post_meta($post->ID,'__themename_hide_title',false)[0];
	wp_nonce_field('_themename_update_post_metabox','_themename_update_post_nonce');
	?>

	<p>
		<label for="_themename_hide_title"><?php esc_html_e("Hide Page Title","_themename");?>Hide Title</label>
		<select name="hide_title_field" id="_themename_hide_title" value="<?php echo $hide_title;?>">
			<option value="" <?php echo ($hide_title=="") ? "selected" : "" ;?>>No</option>
			<option value="yes" <?php echo ($hide_title=="yes") ? "selected" : "" ;?>>Yes</option>
		</select>
	</p>
<?php } 

add_action('save_post','_themename_save_post_metabox',10,2);
function _themename_save_post_metabox($post_id,$post){

	$edit_cap = get_post_type_object($post->post_type)->cap->edit_post;
	if(!current_user_can($edit_cap ,$post_id)){
		return;
	}

	if(!isset($_POST['_themename_update_post_nonce']) 
		|| !wp_verify_nonce($_POST['_themename_update_post_nonce'],'_themename_update_post_metabox')){
		return;
	}

	if(array_key_exists('hide_title_field',$_POST)){		
		$display_title = sanitize_text_field($_POST['hide_title_field']);
		update_post_meta($post->ID,"__themename_hide_title",$display_title);
	}
}
?>