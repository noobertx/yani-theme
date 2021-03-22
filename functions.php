<?php require_once("libs/enqueue-assets.php");?>
<?php require_once("libs/theme-support.php");?>
<?php require_once("libs/sidebars.php");?>
<?php require_once("libs/rest-api.php");?>
<?php require_once("libs/navigation.php");?>
<?php require_once("libs/fonts.php");?>
<?php require_once("libs/customizer.php"); ?>
<?php require_once("libs/metaboxes.php");?>
<?php require_once("libs/plugin-activation.php");?>
<?php require_once("libs/comments.php");?>
<?php require_once("libs/shortcodes.php"); ?>
<?php require_once("libs/custom-post-types.php");
require_once("libs/theme-customizer.php");

require_once("libs/class-wp-bootstrap-navwalker.php");


// if(class_exists('WooCommerce')){11
	require_once("libs/woocommerce.php"); 
// }

function _theme_readmore_link(){ ?> 
<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		Read More
		<span class="u-screen-reader-text">About <?php the_title()?></span>
</a>
<?php }

function _themename_post_meta(){
	
}


