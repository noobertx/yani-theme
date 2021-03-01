<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

<main >
<div class="square bg-primary"></div>
<div class="square bg-secondary"></div>
<div class="square bg-acccent"></div>
<div class="square bg-light"></div>
<div class="square bg-dark"></div>

<?php the_content();?>	
</main>

<?php if(is_active_sidebar('primary-sidebar')) { ?>
	<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>