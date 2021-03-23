<?php
/*
Template Name:Woocommerce Homepage Page
*/

?>

<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?> full-width-page">

<main >
	<section class="main-slider">

		<div class="slick page-slider">
			<?php for($i =1; $i<4 ; ++$i){ 
				$slider_page[$i] 		= get_theme_mod('set_slider_page'.$i);
				$slider_button_text[$i] = get_theme_mod('set_slider_button_text'.$i);
				$slider_button_url[$i] 	= get_theme_mod('set_slider_button_url'.$i);
			?>
			<?php } ?>

			<?php
				$j = 1;
				$args = [
					'post_type' => "page",
					'post_per_page' => 3,
					'post__in' => $slider_page,
					'orderby' => "post__in",
				];

				$slider_loop = new WP_Query($args);

				if($slider_loop->have_posts()){
					while($slider_loop->have_posts()){
						$slider_loop->the_post();
						?>
							<div style="background-image:url('<?php echo get_the_post_thumbnail_url(get_the_ID());?>');background-size:cover;">															
								
								<div class="container">
									<div class="slider-details-container">
										<div class="slide-title">
											<h1><?php the_title();?></h1>
										</div>
										<div class="slide-description">
											<div class="subtitle">
												<?php //the_excerpt();?>
											</div>
											<a href="<?php echo $slider_button_url[$j] ?>" class="link"><?php echo $slider_button_text[$j] ?></a>
										</div>
									</div>
								</div>
							</div>
						<?php
						++$j ;
					}
				}
			?>
		</div>
	</section>	
	<div class="page__content">
		<?php //the_content();?>			
	</div>
</main>

</div>

<?php get_footer();?>