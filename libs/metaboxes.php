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
	$hide_title = get_post_meta($post->ID,'__themename_hide_title',false);
	?>
	<p>
		<label for="_themename_hide_title"><?php esc_html_e("Hide Page Title","_themename");?></label>
		<input type="text" name ="_themename_hide_title_field" id="_themename_hide_title" value = "<?php echo $hide_title;?>"/>
	</p>
<?php } 

add_action('save_post','_themename_save_post_metabox',10,2);
function _themename_save_post_metabox($post_id,$post){
	// if(array_key_exists('_themename_hide_title_field',$_POST)){		
		$display_title = sanitize_text_field($_POST['_themename_hide_title_field']);
		update_post_meta($post->ID,"__themename_hide_title",$display_title);
	// }
}
?>