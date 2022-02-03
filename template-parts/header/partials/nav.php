<?php
$header_style = _yani_theme()->get_option('header_style', 4);
$alignClass = '';

if( $header_style == '4' ) {
	$alignClass = _yani_theme()->get_option('header_4_menu_align', 'nav-right');
	if($alignClass == 'nav-right')
		$alignClass = 'justify-content-end';

} elseif($header_style == '1') {
	$alignClass = _yani_theme()->get_option('header_1_menu_align', 'nav-right');
	if($alignClass == 'nav-right')
		$alignClass = 'justify-content-end';
}

if(_yani_template()->is_splash()) {
	$alignClass = _yani_theme()->get_option('splash_menu_align', 'nav-right');
	if($alignClass == 'nav-right')
		$alignClass = 'justify-content-end';
}

if ( has_nav_menu( 'main-menu' ) ) :
	// wp_nav_menu( array (
	// 	'theme_location' => 'main-menu',
	// 	'container' => '',
	// 	'container_class' => '',
	// 	'menu_class' => 'navbar-nav '.$alignClass,
	// 	'menu_id' => 'main-nav',
	// 	'depth' => 4,
	// 	'walker' => new yani_nav_walker()
	// ));

	wp_nav_menu(
		array(
			'theme_location'	=> 'main-menu',
			'depth'				=> 4,
			'container'			=> 'div',
			'container_class'	=> 'justify-content-lg-end collapse navbar-collapse' ,
			'container_id'		=> 'navbarSupportedContent',
			'menu_class'		=> 'navbar-nav',
			'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
			'walker' 			=> new WP_Bootstrap_Navwalker()
		)
	);

endif;
?>	