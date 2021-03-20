<?php
	add_filter('woocommerce_show_page_title','yani_remove_shop_title');

	function yani_remove_shop_title(){
		return false;
	}


	if(is_product_tag()){

	remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
	}

	if(is_product_tag()){
		add_action('woocommerce_before_main_content','__theme_name_add_sidebar_tags',6);

		function __theme_name_add_sidebar_tags(){
			echo '<div class="sidebar-shop">';
		}
		add_action('woocommerce_before_main_content','woocommerce_get_sidebar',7);

		add_action('woocommerce_before_main_content','__theme_name_close_sidebar_tags',8);

		function __theme_name_close_sidebar_tags(){
			echo '</div>';
		}

	}
?>