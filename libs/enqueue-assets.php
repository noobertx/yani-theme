<?php

function yani_assets(){
	wp_enqueue_style("yani-stylesheet",get_template_directory_uri()."/dist/assets/css/bundle.css",array(),microtime(),"all");
	wp_enqueue_style( 'font-awesome',"//kit-pro.fontawesome.com/releases/latest/css/pro.min.css" , array(),"5.13.0", 'all');

	if(is_singular() && comments_open() && get_option('thread_comments')){		
		wp_enqueue_script("comment-reply");
	}
	wp_enqueue_script("yani-script",get_template_directory_uri()."/dist/assets/js/bundle.js",array(),microtime(),true);

	wp_localize_script('yani-script', 'searchData', array(
      'root_url' => get_site_url(),
      'nonce' => wp_create_nonce('wp_rest')
    ));

} 

 
add_action("wp_enqueue_scripts","yani_assets");

function yani_admin_assets(){
	wp_enqueue_style("yani-admin-stylesheet",get_template_directory_uri()."/dist/assets/css/admin.css",array(),microtime(),"all");
	wp_enqueue_script("yani-admin-script",get_template_directory_uri()."/dist/assets/js/admin.js",array(),microtime(),true);
}


add_action("admin_enqueue_scripts","yani_admin_assets");

?>