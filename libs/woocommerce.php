<?php
	add_filter('woocommerce_show_page_title','yani_remove_shop_title');

	function yani_remove_shop_title(){
		return false;
	}
?>