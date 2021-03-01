<?php 
function _themename_sidebar_widgets(){
	register_sidebar(array(
		'id' => 'primary-sidebar',
		'name' => esc_html(__('Primary Sidebar','_theme_name')),
		'description' => esc_html(__('Sidebar Appears','_theme_name')),
		'before_widget' => '<section id="%1$s" class="">',
		'after_widget' => '</section>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
}

add_action('widgets_init','_themename_sidebar_widgets');
?>