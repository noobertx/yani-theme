<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<?php
		if($custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

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

<?php
		if($custom_wprig_opt['opt-page-layout']=="right-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

</div>

<?php get_footer();?>