<?php

function yani_assets(){
	wp_enqueue_style("yani-stylesheet",get_template_directory_uri()."/dist/assets/css/bundle.css",array(),microtime(),"all");
}

add_action("wp_enqueue_scripts","yani_assets");

?>