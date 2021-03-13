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

	add_shortcode("yani_delivery_zip","yani_delivery_zip_callback");
	function yani_delivery_zip_callback($atts=[],$content = null,$tag = ""){
		extract(shortcode_atts([
			"id" => "",
			"title" => "Check Our Delivery Areas",
			"label" => ""
		],$atts,$tag));

		ob_start(); ?>
		<div class="yani-delivery-areas text-center">			
			<h2>Check Our Delivery Areas</h2>
			<div class="delivery-area-status"></div>
			<div action="#" method="POST" id="frm-check-service-area">
				<input class="form-control" data-val="true" data-val-regex="Please specify a valid Zip Code." data-val-regex-pattern="^\d{5}(-\d{4})?$" data-val-required="The Zip Code field is required." id="postal-code" name="postalCode" placeholder="Enter your zip code" type="text" value="">
				<button id="btnGo"> Go </button>
			</div>
		</div>
			
		<?php
		$output_string =  ob_get_contents();
		ob_end_clean();
		return $output_string;
	}
?>