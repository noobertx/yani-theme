<article >				
	<?php get_template_part("template-parts/post/header")?>
	<div class="post__inner">
		<div class="post__content">
			<?php the_content();?>
		</div>
		<div class="post__meta">
			<?php //_themename_post_meta();?>
		</div>
	</div>
		<?php get_template_part("template-parts/post/footer");?>
</article>