<?php
global $current_user, $yani_local, $hide_prop_fields, $required_fields, $is_multi_steps;
$is_multi_currency = _yani_theme()->get_option('multi_currency');
$default_multi_currency = get_the_author_meta( 'yani_author_currency' , $current_user->ID );
if(empty($default_multi_currency)) {
    $default_multi_currency = _yani_theme()->get_option('default_multi_currency');
}
?>
<div id="description-price" class="dashboard-content-block-wrap <?php echo esc_attr($is_multi_steps);?>">
	<h2><?php echo _yani_theme()->get_option('cls_description', 'Description'); ?></h2>
	<div class="dashboard-content-block">
		<?php get_template_part('template-parts/dashboard/submit/form-fields/title'); ?>
		<?php get_template_part('template-parts/dashboard/submit/form-fields/description'); ?>

		<div class="row">

			<?php if( $hide_prop_fields['prop_type'] != 1 ) { ?>
			<div class="col-md-4 col-sm-12">
				<?php get_template_part('template-parts/dashboard/submit/form-fields/type'); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>