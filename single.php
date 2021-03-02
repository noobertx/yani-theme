<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

	
<main>
<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/post/content','single'); ?>
	<?php }?>

	<?php the_posts_pagination(); ?>
<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>