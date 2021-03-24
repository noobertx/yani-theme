<?php
class _theme_name_Customize {
   public static function register ( $wp_customize ) {
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'sec_slider', 
         array(
            'title'       => __( 'Slider Options', '_theme_name' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for MyTheme.', '_theme_name'), //Descriptive tooltip
         ) 
      );
      
      $settings = [
			[
				'fields' => [
					'set_slider_page1'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 1',
						'description'	=> 'Set Slider Page 1',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text1'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 1',
						'description'	=> 'Button Text for Page 1',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url1'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 1',
						'description'	=> 'Button URL for Page 1',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
			[
				'fields' => [
					'set_slider_page2'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 2',
						'description'	=> 'Set Slider Page 2',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text2'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 2',
						'description'	=> 'Button Text for Page 2',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url2'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 2',
						'description'	=> 'Button URL for Page 2',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
			[
				'fields' => [
					'set_slider_page3'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 3',
						'description'	=> 'Set Slider Page 3',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text3'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 3',
						'description'	=> 'Button Text for Page 3',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url1'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 3',
						'description'	=> 'Button URL for Page 3',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
		];

		_theme_name_Customize::render_setting($wp_customize,$settings,'sec_slider');
      	

		$wp_customize->add_section( 'sec_featured_products', 
        	array(
            'title'       => __( 'Products and Blog', '_theme_name' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Featured Products and Blog Settings.', '_theme_name'), //Descriptive tooltip
        	) 
      	);

      	$settings = [
			[
				'fields' => [
					'max_popular_num'=>[
						'type' => 'number',
						'label'	=> 'Popular Products Max Number',
						'description'	=> 'Popular Products Max Number',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_popular_cols'=>[
						'type' => 'number',
						'label'	=> 'Popular Products Max Columns',
						'description'	=> 'Popular Products Max Columns',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_new_products_num'=>[
						'type' => 'number',
						'label'	=> 'New Arrival Products Max Number',
						'description'	=> 'New Arrival Products Max Number',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_new_products_cols'=>[
						'type' => 'number',
						'label'	=> 'New Arrival Products Max Columns',
						'description'	=> 'New Arrival Products Max Columns',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
				]
			],
		];

		_theme_name_Customize::render_setting($wp_customize,$settings,'sec_featured_products');


   }

   public static function render_setting($wp_customize,$collection,$section){
   	foreach($collection as $item){
			foreach($item['fields'] as $name=>$field){
				$wp_customize->add_setting(
					$name,array(
						'type'	=> 'theme_mod',
						'default'	=> $field['default'],
						'sanitize_callback'	=> $field['sanitize_callback'],
					)
				);

				$wp_customize->add_control(
					$name,array(
						'label'	=> $field['label'],
						'description'	=> $field['description'],
						'section'	=> $section,
						'type'	=> $field['type'],
					)
				);
			}
		}
   }
   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
           <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
           <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
           <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( '_theme_name_Customize' , 'register' ) );

// Output custom CSS to live site
// add_action( 'wp_head' , array( '_theme_name_Customize' , 'header_output' ) );

// // Enqueue live preview javascript in Theme Customizer admin screen
// add_action( 'customize_preview_init' , array( '_theme_name_Customize' , 'live_preview' ) );