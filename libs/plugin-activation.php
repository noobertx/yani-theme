<?php
require_once("class-tgm-activation.php");
class Yani_Plugins {
	function __construct(){
		add_action( 'tgmpa_register', [ $this, 'install_recommended_plugin' ] );  
	}

	public function install_recommended_plugin(){
		$plugins = array(
            array(
            	'name'      => __('Redux Framework', '__theme_name'),
            	'slug'      => 'redux-framework',
            	'required'  => true,
        	),
        	array(
            	'name'      => __('Custom Post Type', '__theme_name'),
            	'slug'      => 'custom-post-type-ui',
            	'required'  => false,
        	),
        	array(
            	'name'      => __('Recent Post Widget Extended', '__theme_name'),
            	'slug'      => 'recent-posts-widget-extended',
            	'required'  => false,
        	),
        	array(
            	'name'      => __('WooCommerce', '__theme_name'),
            	'slug'      => 'woocommerce',
            	'required'  => false,
        	)
        );
        
        $config = array(
        	'id'           => '__theme_name',            // Unique ID for hashing notices for multiple instances of TGMPA.
        	'default_path' => get_template_directory() . "/auxin-content/embeds/plugins/",                      // Default absolute path to bundled plugins.
        	'menu'         => 'tgmpa-install-plugins', // Menu slug.
        	'has_notices'  => false,                   // Show admin notices or not.
        	'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        	'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        	'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        	'message'      => '',                      // Message to output right before the plugins table.
	
        	'strings'      => array(
        	    'page_title'                      => __( 'Install Recommended Plugins', '__theme_name' ),
        	    'menu_title'                      => __( 'Install Plugins', '__theme_name' )
        	)
    	);


		tgmpa( $plugins, $config );
	}
}; 
new Yani_Plugins();

?>