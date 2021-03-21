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
		<div class="header-main">
			<div class="branding">				
				<div class="square bg-primary"></div>
				<div class="square bg-secondary"></div>
				<div class="square bg-accent"></div>
				<div class="square bg-light"></div>
				<div class="square bg-dark"></div>
			</div>
		</div>
		<div class="header-bottom">			
			<div class="navigation-wrap">			
				<div class="navigation">
					<div class="container">
						<nav class="header-nav navbar navbar-expand-md" role="navigation">
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
									wp_nav_menu(
										array(
											'theme_location'	=> 'main-menu',
											'depth'				=> 2,
											'container'			=> 'div',
											'container_class'	=> 'collapse navbar-collapse',
											'container_id'		=> 'bs-example-navbar-collapse-1',
											'menu_class'		=> 'nav navbar-nav',
											'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
											'walker' 			=> new WP_Bootstrap_Navwalker()
										)
									);
								?>
						</nav>
					</div>
						<!-- <nav class="header-nav" role="navigation" aria-label="<?php esc_html__('Main Navigation','__theme_name')?>">
							<?php 
							//	wp_nav_menu(array('theme_location'=>'main-menu'));
							?>
						</nav> -->
				</div>
			</div>
			<div class="header-widget-wrap">
				<a href="#" class="nav-search-field-toggler js-search-trigger" data-toggle="nav-search-feild">
					<i class="far fa-search"></i>
				</a>
			</div>
		</div>
	</header>