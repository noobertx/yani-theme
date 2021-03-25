<?php 
function _theme_name_callback($comment,$args,$depth){
	$tag = ($args['style'] == "div") ? "div" : "li";
	?>
	<<?php echo $tag;?> <?php comment_class('comment-item',$comment->comment_parent ? 'comment--child' : 't');?>>
		<article class="comment__body" id="div-commen-<?php comment_ID();?>">
			<?php echo ($args["avatar_size"] != 0 ) ? get_avatar($comment,$args["avatar_size"],false,false,array("class"=>"comment__avatar")): "" ; ?>
			<?php edit_comment_link(esc_html__('Edit Comment','_themename'),'<span class="comment__edit--link">','</span');?>
			<div class="comment__content">
				<div class="comment__author">
					<?php echo get_comment_author_link($comment);?>
				</div>
			<a href="<?php echo esc_url(get_comment_link($comment,$args));?>" class="comment__time">
				<time datetime="<?php comment_time('c');?>">
					 <?php 
					 	printf(esc_html('%s ago','_themename'),human_time_diff(get_comment_time("U"),current_time("U")));
					 ?>
				</time> 
			</a>
			</div>
			<?php if($comment->comment_approved == "0"){ ?>
				<p class="comment__awaiting-moderation">
					<?php
						esc_html_e("Comment is awaiting moderation","_themename")
					?>
				</p>	
			<?php } ?>
			<?php if($comment->comment_type =="" || ($comment->comment_type == "pingback" || $comment->comment_type == "trackback") && !$args['short_ping']){
			 		comment_text();
			} ?>
			<?php comment_reply_link(array_merge($args,array(
				'depth'=> $depth,
				'max_depth'=> $args['max_depth'],
				'reply_text'=> "Reply",
				'add_bellow'=> 'div-comment',
				'before'=> '<div class="comment__reply-link">',
				'after'=> '</div>',

			)));?>
		</article>
	</<?php echo $tag;?>>
	<?php 

}
?>