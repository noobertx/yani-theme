<?php
	$author_id = get_the_author_meta('ID');
	$author_posts = get_the_author_posts();
	$author_display = get_the_author();
	$author_posts_url = get_author_posts_url($author_id);
	$author_description = get_the_author_meta('user_description');
	$author_website = get_the_author_meta('user_url');
?>
<article >
	<h2>
		<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"> <?php the_title(); ?></a>
	</h2>
	<div>
		<?php the_excerpt();?>
	</div>

	<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		Read More
		<span class="u-screen-reader-text">About <?php the_title()?></span>
	</a>
	<div class="author-avatar">
		<?php echo get_avatar($author_id,265); ?>
	</div>
	<div class="author-avatar__content">
		<div class="author__title">
			<?php if($author_website) { ?>
			<a href="<?php echo esc_url($author_website);?>" target="_blank">				
			<?php } ?>
				<?php echo esc_html($author_display);?>
			<?php if($author_website) { ?>
			</a>
			<?php } ?>
		</div>
		<div class="author__info">
			<a href="<?php echo esc_url($author_posts_url);?>" target="_blank">				
				<?php
					printf(esc_html(_n('%s post', '%s posts',$author_posts,'_themename')),number_format_i18n($author_posts));
				?>
			</a>
		</div>
		<div class="author__desc">
				<?php echo $author_description; ?>
		</div>
	</div>

	<?php
		$prev = get_previous_post();
		$next = get_next_post();
	?>
	<?php if($prev || $next) { ?>
	<nav role="navigation">
		<!-- <h2><?php esc_attr_e('Post Navigation','_themename')?></h2> -->
		<div class="post-navigation__links">
			<?php if($prev) { ?>
					<div class="post-navigation__post--prev">
						<a href="<?php the_permalink($prev->ID); ?>" class="post-navigation__link"> 
							<?php if(has_post_thumbnail($prev->ID)) { ?>
								<?php echo get_the_post_thumbnail($prev->ID,'thumbnail');?>
							<?php } ?>
							<div class="post-navigation__content">
								<div class="post-navigation__subtitle">
									<?php echo esc_html('Prevous Post','_themename'); ?>									
								</div>
								<span class="post-navigation__title">
									<h2><?php echo esc_html(get_the_title($prev->ID)); ?></h2>
								</span>
							</div>
						</a>
					</div>
			<?php } ?>
			<?php if($next) { ?>
					<div class="post-navigation__post--next">
						<a href="<?php the_permalink($next->ID); ?>" class="post-navigation__link"> 
							<?php if(has_post_thumbnail($next->ID)) { ?>
								<?php echo get_the_post_thumbnail($next->ID,'thumbnail');?>
							<?php } ?>
							<div class="post-navigation__content">
								<div class="post-navigation__subtitle">
									<?php echo esc_html('Next Post','_themename'); ?>									
								</div>
								<span class="post-navigation__title">
									<h2><?php echo esc_html(get_the_title($next->ID)); ?></h2>
								</span>
							</div>
						</a>
					</div>
			<?php } ?>
		</div>
	</nav>
	<?php } ?>

</article>