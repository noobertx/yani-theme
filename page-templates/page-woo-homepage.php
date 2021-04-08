<?php
/*
Template Name:Woocommerce Homepage Page
*/

?>

<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?> full-width-page">

<main >

<?php $hide_title = get_post_meta(get_the_ID(),"__themename_hide_title",false)[0]; ?>
	
	<div class="page__content">
		<?php the_content();?>			
	</div>
</main>

</div>

<?php get_footer();?>