<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

	
<main>
	<div class="square bg-primary"></div>
	<div class="square bg-secondary"></div>
	<div class="square bg-acccent"></div>
	<div class="square bg-light"></div>
	<div class="square bg-dark"></div>
	<a href="#" class="nav-search-field-toggler js-search-trigger" data-toggle="nav-search-feild"><i class="far fa-search"></i></a>

	<header>
		<?php the_archive_title('<h1>','</h1>');?>
		<?php the_archive_description('<p>','</p>');?>
	</header>
	<?php get_template_part('loop'); ?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>