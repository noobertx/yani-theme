<?php
	function _theme_name_customizer($wp_customize){
		$wp_customize->add_section(
			'sec_copyright',array(
				'title' => 'Copyright Settings',
				'description' => 'Copyright Section',
			)
		);

		$wp_customize->add_setting(
			'set_copyright',array(
				'type'	=> 'theme_mod',
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'set_copyright',array(
				'label'	=> 'Copyright',
				'description'	=> 'Add copyright information here',
				'section'	=> 'set_copyright',
				'type'	=> 'textarea',
			)
		);
	}

	add_action('customize_register','_theme_name_customizer');

	//get_thee_mod('set_copyright','Default text here')
?>