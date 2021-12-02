<ul class="item-amenities <?php echo yani_v2_meta_type(); ?>">
	<?php
	$listing_data_composer = yani_option('listing_data_composer');
	$data_composer = $listing_data_composer['enabled'];
	
	$breakpoint = 4;
	if(yani_is_demo()) {
		$breakpoint = 3;
	}

	$i = 0;
	if ($data_composer) {
		unset($data_composer['placebo']);
		foreach ($data_composer as $key=>$value) { $i ++;
			if(in_array($key, yani_listing_composer_fields())) {

				get_template_part('template-parts/listing/partials/'.$key.'-v2');

			} else {
				$custom_field_value = yani_get_listing_data($key);
				$output = '';
				if( $custom_field_value != '' ) { 
					$output .= '<li class="h-'.$key.'">';
						$output .= '<span>'.esc_attr($custom_field_value).' ';
						
						if(yani_option('icons_type') == 'font-awesome') {
							$output .= ' <i class="'.yani_option('fa_'.$key).' ml-1"></i>';

						} elseif (yani_option('icons_type') == 'custom') {
							$cus_icon = yani_option($key);
							if(!empty($cus_icon['url'])) {

								$alt = isset($cus_icon['title']) ? $cus_icon['title'] : '';
								$output .= '<img class="img-fluid ml-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($alt).'">';
							}
						}

						$output .= '</span>';
						$output .= esc_attr($value);
					$output .= '</li>';
				}
				echo $output;
			}
		if($i == $breakpoint)
			break;
		}
	}
	?>
</ul>