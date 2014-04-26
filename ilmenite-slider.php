<?php
/*
Plugin Name:	Ilmenite: Slider
Plugin URI: 	http://ilmenite.io/slider
Description: 	A simple slider plugin that adds post type support but leaves styling up to the theme.
Version: 		1.2
Author: 			XLD Studios
Text Domain: 	ilmenite_slider
Domain Path: 	/languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load the main plugin class
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-ilmenite-slider.php' );

/**
 * Load the plugin's non-admin parts
 */
add_action( 'plugins_loaded', array( 'Ilmenite_Slider', 'get_instance' ) );

/**
 * Load the Textdomain
 */
load_plugin_textdomain( 'ilmenite_slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );