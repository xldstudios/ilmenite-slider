<?php
/**
 * Ilmenite Slider
 *
 * Class that initializes and loads all of the plugin features.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Ilmenite_Slider {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.2';

	/**
	 * Instance of this class
	 */
	protected static $instance = null;


	/**
	 * Initialize the plugin
	 */
	function __construct() {

		// Load additional classes
		require_once( plugin_dir_path( __FILE__ ) . '/class-ilmenite-slider-post-types.php' );

	}

	/**
	 * Return an instance of this class
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

}