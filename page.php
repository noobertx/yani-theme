<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

<main >

dawdawd
<?php print_r(get_post_meta(get_the_ID(),"__themename_hide_title",false));?>
<?php the_content();?>	

</main>

<?php if(is_active_sidebar('primary-sidebar')) { ?>
	<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>