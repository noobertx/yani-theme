<article >				

	<div class="post__inner">
		
			<?php if(get_the_post_thumbnail() !== ""){ ?>
				<div class="post__thumbnail">
					<?php the_post_thumbnail('large');?>
				</div>
			<?php } ?>

			<?php get_template_part("template-parts/post/header")?>

			<?php if(is_single()){ ?>
				<div class="post__content">
					<?php the_content();?>
					<?php wp_link_pages();?>
				</div>
			<?php }else { ?>
				<div class="post__excerpt">
					<?php the_excerpt()?>
				</div>
			<?php } ?>
		</div>
	<?php 
		if(!is_single()) {
			get_template_part("template-parts/post/footer");
		} 
		
		if(!is_single()) {
			_theme_readmore_link();
		} 
	?>

</article>