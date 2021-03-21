<!DOCTYPE <?php language_attributes();?>>
<html>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width-device=width,initial-scale=1.0">
	<meta http-equiv="X0UA-Compatible" content="ie=edge">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
	<header id="header">
		<div class="row">
			<div class="header-main brand col-md-3 col-12 col-lg-3 text-center text-md-left">
				<div class="branding">				
					<div class="square bg-primary"></div>
					<div class="square bg-secondary"></div>
					<div class="square bg-accent"></div>
					<div class="square bg-light"></div>
					<div class="square bg-dark"></div>
				</div>
			</div>
			<div class="header-bottom col-12 col-lg-11">	
				<div class="row">		
					<div class="account col-12 d-md-none">Account</div>
					<div class="navigation-wrap">			
						<div class="navigation">
							<div class="">
								<nav class="navbar navbar-expand-lg">
  <div class="">
    <button 
    class="navbar-toggler" 
    type="button" 
    data-bs-toggle="collapse" 
    data-bs-target="#bs-example-navbar-collapse-1" 
    aria-controls="bs-example-navbar-collapse-1" 
    aria-expanded="false" 
    aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'main-menu',
					'depth'				=> 4,
					'container'			=> 'div',
					'container_class'	=> 'collapse navbar-collapse',
					'container_id'		=> 'bs-example-navbar-collapse-1',
					'menu_class'		=> 'nav navbar-nav',
					'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
					'walker' 			=> new WP_Bootstrap_Navwalker()
				)
			);
		?>
  </div>
</nav>
								<!-- <nav class="header-nav navbar navbar-expand-md" role="navigation">
										<button 
										class="navbar-toggler" 
										type="button" 
										data-toggle="collapse" 
										data-target="#bs-example-navbar-collapse-1"
										aria-controls="bs-example-navbar-collapse-1"
										aria-expanded="false"
										aria-label="Toggle navigation"
										>									
											<span class="navbar-toggler-icon"></span>
										</button>							
										<?php
											// wp_nav_menu(
											// 	array(
											// 		'theme_location'	=> 'main-menu',
											// 		'depth'				=> 4,
											// 		'container'			=> 'div',
											// 		'container_class'	=> 'collapse navbar-collapse',
											// 		'container_id'		=> 'bs-example-navbar-collapse-1',
											// 		'menu_class'		=> 'nav navbar-nav',
											// 		'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
											// 		'walker' 			=> new WP_Bootstrap_Navwalker()
											// 	)
											// );
										?>
								</nav> -->
							</div>
								<!-- <nav class="header-nav" role="navigation" aria-label="<?php esc_html__('Main Navigation','__theme_name')?>">
									<?php 
									//	wp_nav_menu(array('theme_location'=>'main-menu'));
									?>
								</nav> -->
						</div>
					</div>
				</div>
				<div class="header-widget-wrap col-12">
					<a href="#" class="nav-search-field-toggler js-search-trigger" data-toggle="nav-search-feild">
						<i class="far fa-search"></i>
					</a>
				</div>
			</div>	
		</div>
	</header>