<?php
global $yani_local;
$yani_local = _yani_theme()->get_text_domain();
?>
<!DOCTYPE <?php language_attributes();?>>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
    <meta name="format-detection" content="telephone=no">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
	<a href="#content" class="skip-link">Skip to Content</a>
	<?php wp_body_open(); ?>


	<?php get_template_part('template-parts/header/nav-mobile'); ?>
		
	<?php if(_yani_template()->is_dashboard()) { ?>

	<?php } else { 

		?>

		<main id="main-wrap" class="main-wrap <?php if(_yani_template()->is_splash()) { echo 'splash-page-wrap'; }?>">
		<?php 
			if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
				get_template_part('template-parts/header/main'); 
			}
		?>

		<?php
			// Header Search Start 
	if( _yani_template()->is_search_needed() ) {

		$search_enable = _yani_theme()->get_option('main-search-enable');
		$search_position = _yani_theme()->get_option('search_position');
		$search_pages = _yani_theme()->get_option('search_pages');
		$search_selected_pages = _yani_theme()->get_option('header_search_selected_pages');

		$adv_search_enable = get_post_meta($post->ID, 'yani_adv_search_enable', true);
		$adv_search = get_post_meta($post->ID, 'yani_adv_search', true);
		$adv_search_pos = get_post_meta($post->ID, 'yani_adv_search_pos', true);

		if( isset( $_GET['search_pos'] ) ) {
			$search_enable = 1;
			$search_position = $_GET['search_pos'];
		}


		if ((!empty($adv_search_enable) && $adv_search_enable != 'global') && !_yani_theme()->is_transparent_logo()) {
			if ($adv_search_pos == 'under_menu') {
				if ($adv_search == 'show' || $adv_search == 'hide_show') {
					if( wp_is_mobile() ) {
						get_template_part('template-parts/search/mobile-search-main');
					} else {
						get_template_part('template-parts/search/main'); 
					}
				}
			}
		} else {
			if (!is_home() && !is_singular('post') && !_yani_template()->is_transparent_logo()) {
				if ($search_enable != 0 && $search_position == 'under_nav') {
					
					if( wp_is_mobile() ) {
						get_template_part('template-parts/search/mobile-search-main');
					} else {
						if ($search_pages == 'only_home') {
							if (is_front_page()) {
								get_template_part('template-parts/search/main'); 
							}
						} elseif ($search_pages == 'all_pages') {
							get_template_part('template-parts/search/main'); 

						} elseif ($search_pages == 'only_innerpages') {
							if (!is_front_page()) {
								get_template_part('template-parts/search/main'); 
							}
						} else if( $search_pages == 'specific_pages' ) {
						    if( is_page( $search_selected_pages ) ) {
						        get_template_part('template-parts/search/main'); 
						    }
						}
					}
				}
			}
		}
	} // Header search End
	get_template_part('template-parts/banners/main');

?>

	<?php } ?>
<div id="content" >