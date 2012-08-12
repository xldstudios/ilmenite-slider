<?php
/*
Plugin Name: Ilmenite Slider
Plugin URI: http://www.xldstudios.com/plugins/ilmenite-slider/
Description: Creates a slider post type and adds functions to display it on the frontend and via shortcodes.
Version: 1.0
Author: XLD Studios
Author URI: http://www.xldstudios.com
License: GPL2
*/

/**
 * Plugin Definitions
 **/

define( 'ISL_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'ISL_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'ISL_PLUGIN_FILE', plugin_basename( __FILE__ ) );

define( 'ISL_VERSION', '1.0' )

define( 'ISL_PLUGIN_INC', ISL_PLUGIN_PATH . '/inc' );
define( 'ISL_SHORTCODES', ISL_PLUGIN_PATH . '/shortcodes' );

define( 'ISL_ASSETS', ISL_PLUGIN_URL . '/assets' );
define( 'ISL_CSS', ISL_ASSETS . '/css' );
define( 'ISL_IMAGES', ISL_ASSETS . '/images' );
define( 'ISL_JS', ISL_ASSETS . '/js' );

/**
 * Set up Plugin
 *
 * Loads all the plugin files and calls when appropriate.
 **/

require_once( ISL_PLUGIN_INC . '/plugin.php' ); // Include base file
require_once( ISL_PLUGIN_INC . '/config.php' ); // Get config file

$class_name = 'ISL_';

// Load admin file if in the admin section
if( is_admin() ) {
	$class_name .= 'Admin';
	require_once( ISL_PLUGIN_INC . '/admin.php' );
} else {
	$class_name .= 'Public';
	require_once( ISL_PLUGIN_INC . '/theme-functions.php' );
	require_once( ISL_PLUGIN_INC . '/public.php' );
}

/**
 * Configuration Data
 **/

$is_config_data = array(
	'plugin_file' => ISL_PLUGIN_FILE,
	'version' => $plugin_version
);

/**
 * Execute Plugin Class
 **/

$ilmenite_shortcode = new $class_name( new ISL_Config( $is_config_data ) );

unset( $class_name, $is_config_data ); // Unset when done.

/**
 * Auto Update
 **/
add_action('init', 'is_auto_update');

function is_auto_update() {
	
	require_once( IS_PLUGIN_INC . '/auto-update.php' ); // Load auto update class
	
	$remote_update_link = 'http://www.xldstudios.com/updates/plugins/ilmenite-slider/update.php';
	
	new WP_Auto_Update( IS_VERSION, $remote_update_link, IS_PLUGIN_FILE );
	
}