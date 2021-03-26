<section>	
	<?php
global $custom_wprig_opt;
		if($custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/post/content',get_post_format()); ?>
	<?php }?>
<section>	
	<?php the_posts_pagination(); ?>
</section>
<?php
		if($custom_wprig_opt['opt-page-layout']=="right-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>
</section>