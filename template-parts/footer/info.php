<?php 
	global $custom_wprig_opt;
?>
<div class="info-wrap bg-dark light text-center">
	<?php if ($custom_wprig_opt['opt-display-copyright'] && !empty($custom_wprig_opt['opt-display-copyright-text'])) {
		echo $custom_wprig_opt['opt-display-copyright-text'];
	}else{
		echo "All rights reserved";
	} ?>
</div>