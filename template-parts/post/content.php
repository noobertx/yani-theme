<article <?php post_class('template-parts/post/content');?>>				
	<h2>
		<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"> <?php the_title(); ?></a>
	</h2>
	<div>
		Posted on 
		<a href="<?php echo get_permalink()?>">
			<time date-time="<?echo get_the_date("c");?>">
				<?php echo get_the_date();?>
			</time>
		</a>
		By 
		<a href="<?echo get_author_posts_url(get_the_author_meta('ID'));?>">
			<?php echo get_the_author();?>
		</a>
	</div>
	<div>
		<?php the_excerpt();?>
	</div>
	<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		Read More
		<span class="u-screen-reader-text">About <?php the_title()?></span>
	</a>
</article>