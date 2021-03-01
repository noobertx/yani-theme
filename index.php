<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">

	
<main>
<div class="square bg-primary"></div>
<div class="square bg-secondary"></div>
<div class="square bg-acccent"></div>
<div class="square bg-light"></div>
<div class="square bg-dark"></div>

<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
			<article <?php post_class();?>>
				
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
	<?php }?>
	<?php the_posts_pagination(); ?>
<?php }?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>