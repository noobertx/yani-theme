<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<main>	
	<section class="page-banner">		
		<header>
			<?php the_archive_title('<h1 class="light article-title">','</h1>');?>
			<?php the_archive_description('<p>','</p>');?>
		</header>
	</section>
	<?php get_template_part('loop'); ?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>