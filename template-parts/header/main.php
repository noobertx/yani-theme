<header class="header-main-wrap <?php _yani_template()->get_transparent(); ?>">
    <?php
		if( _yani_theme()->get_option('top_bar') ) {
			get_template_part('template-parts/topbar/top', 'bar');
		}

    	$header = _yani_theme()->get_option('header_style'); 
    	if(empty($header) || _yani_template()->is_splash()) {
    		$header = '4';
    	}
	    get_template_part('template-parts/header/header', $header); 
	    get_template_part('template-parts/header/header-mobile'); 
    ?>
</header><!-- .header-main-wrap -->