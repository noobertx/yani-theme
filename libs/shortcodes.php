<?php
	add_shortcode("yani_gallery","yani_gallery_callback");
	function yani_gallery_callback($atts=[],$content = null,$tag = ""){

		extract(shortcode_atts([
			"id" => ""
		],$atts,$tag));

		$ids = explode(",",$id);

		return "Shortcodes should be included in a plugin not within the theme";

	}

	function yani_gallery_atts_func(){
		return [
			"id" => ""
		];
	}
	add_filter("shortcode_atts__yani_gallery","yani_gallery_atts_func");
?>