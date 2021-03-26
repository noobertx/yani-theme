<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/post/content',get_post_format()); ?>
	<?php }?>
<section>	
	<?php the_posts_pagination(); ?>
</section>
<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>