<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

<main >

<?php $hide_title = get_post_meta(get_the_ID(),"__themename_hide_title",false)[0]; ?>
	<header class="page__header">
		<div class="page__title asdasd">
			<?php 
				if($hide_title!="yes" ){ ?>
					<h1><?php the_title(); ?> </h1>
				<?php  } ?>	
		</div>
	</header>
	<div class="page__content">
		<?php the_content();?>			
	</div>
</main>

<?php if(is_active_sidebar('primary-sidebar')) { ?>
	<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>