
	
<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/post/content',get_post_format()); ?>
	<?php }?>
	<div class="pagination-wrap">		
		<?php the_posts_pagination(); ?>
	</div>
<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>
<?php comments_template();?>
