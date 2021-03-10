<?php
	function _themename_theme_support(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5',array(
			'search-form',
			'comment-list',
			'comment-form',
			'gallery',
			'caption',
		));
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support('custom-logo',array(
			'height' => 200,
			'width' => 600,
			'flex-height' => true,
			'flex-width' => true,
		));
		add_theme_support('post-formats',array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		));
		add_theme_support( 'editor-styles' );
		add_theme_support('align-wide');
		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Primary', 'wp-rig' ),
					'slug'  => 'theme-primary',
					'color' => "#457B9D",
				],
				[
					'name'  => __( 'Secondary', 'wp-rig' ),
					'slug'  => 'theme-secondary',
					'color' => "#E63946",
				],
                [
					'name'  => __( 'Accent', 'wp-rig' ),
					'slug'  => 'theme-accent',
					'color' => '#A8DADC',
				],
                [
					'name'  => __( 'Dark', 'wp-rig' ),
					'slug'  => 'theme-dark',
					'color' => '#1D3557',
				],
                [
					'name'  => __( 'Light', 'wp-rig' ),
					'slug'  => 'theme-light',
					'color' => '#E5E5E5',
				],
				[
					'name'  => __( 'Default', 'wp-rig' ),
					'slug'  => 'theme-default',
					'color' => '#999',
				],
				[
					'name'  => __( 'Info', 'wp-rig' ),
					'slug'  => 'theme-info',
					'color' => '#00bcd4',
				],
				[
					'name'  => __( 'Success', 'wp-rig' ),
					'slug'  => 'theme-success',
					'color' => '#4caf50',
				],
				[
					'name'  => __( 'Warning', 'wp-rig' ),
					'slug'  => 'theme-warning',
					'color' => '#ff9800',
				],
				[
					'name'  => __( 'Danger', 'wp-rig' ),
					'slug'  => 'theme-danger',
					'color' => '#f44336',
				],				
			]
		);
	}

	add_action( 'after_setup_theme', '_themename_theme_support');
?>