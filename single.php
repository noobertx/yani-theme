<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
	<?php
		if(isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

<main>

<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php //if (is_product()) { ?>
		<?php get_template_part('template-parts/post/content'); ?>
		<?php //}else{ ?>
		<?php //get_template_part('template-parts/post/content','single'); ?>
		<?php //} ?>
	<?php }?>

	<?php the_posts_pagination(); ?>
<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>
<?php comments_template(); ?>  
</main>
<?php
		if(isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

</div>

<?php get_footer();?>