<article >				

	<div class="post__inner">
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

	<?php get_template_part("template-parts/post/footer");?>

	<?php 
	if(!is_single()) {
		_theme_readmore_link();
	} 
	?>

	<a href="<?php echo  get_comments_link();?>">Comments</a>
	

	<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		Read More
		<span class="u-screen-reader-text">About <?php the_title()?></span>
	</a>
</article>