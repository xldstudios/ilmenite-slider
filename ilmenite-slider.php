<?php
/**
 * Plugin Name: Ilmenite Slider
 * Plugin URI: https://github.com/xldstudios/ilmenite-slider
 * Author: XLD Studios
 * Author URI: http://www.xldstudios.com/
 * Description: A small shortcodes plugin that contains only the shortcodes that we have found most essential to include on our clients websites to reduce bloat.
 * Version: 1.1
 * Text Domain: ilslider
 * License: GPL2
 */

/**
 * Get some constants ready for paths when your plugin grows
 */
define( 'ILSL_VERSION', '1.1' );
define( 'ILSL_PATH', dirname( __FILE__ ) );
define( 'ILSL_PATH_INCLUDES', dirname( __FILE__ ) . '/inc' );
define( 'ILSL_PATH_ASSETS', dirname( __FILE__ ) . '/assets' );
define( 'ILSL_FOLDER', basename( ILSL_PATH ) );
define( 'ILSL_URL', plugins_url() . '/' . ILSL_FOLDER );
define( 'ILSL_URL_INCLUDES', ILSL_URL . '/inc' );
define( 'ILSL_URL_ASSETS', ILSL_URL . '/assets' );

class Ilmenite_Slider {

	/**
	 *
	 * Assign everything as a call from within the constructor
	 */
	function __construct() {

		// Add scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'ilsl_add_JS' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'ilsl_add_CSS' ) );

		// Register Custom Post Types
		add_action( 'init', array( $this, 'ilsl_custom_post_types' ), 5 );

		// Register activation and deactivation hooks
		register_activation_hook( __FILE__, array( $this, 'ilsl_on_activate_callback' ) );
		register_deactivation_hook( __FILE__, array( $this, 'ilsl_on_deactivate_callback' ) );


		// Add the textdomain and support translation
		add_action( 'plugins_loaded', array( $this, 'ilsl_add_textdomain' ) );

		// Add plugin updater
		add_action( 'init', array( $this, 'ilsl_plugin_update' ) );
	}

	/**
	 * Adding JavaScript scripts
	 */
	function ilsl_add_JS() {

		// Make sure jQuery is loaded
		wp_enqueue_script( 'jquery' );

		// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
		wp_register_script( 'flexslider', ILSL_URL_ASSETS . '/js/jquery.flexslider-min.js', array( 'jquery' ), ISL_VERSION, true );

		// Check if slider javascript exists in stylesheet dir and template dir.
		// If they do not, load the default plugin one.
		if( file_exists( get_stylesheet_directory() . '/javascripts/slider.js' ) ) {
			$slider_js_path = get_stylesheet_directory() . '/javascripts/slider.js';
		} elseif( file_exists( get_template_directory() . '/javascripts/slider.js' ) ) {
			$slider_js_path = get_template_directory() . '/javascripts/slider.js';
		} else {
			$slider_js_path = ILSL_URL_ASSETS . '/js/slider.js';
		}

		wp_register_script( 'ilmenite-slider', $slider_js_path, array( 'jquery', 'flexslider' ), ISL_VERSION, true );

		// Enqueue
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'ilmenite-slider' );

	}

	/**
	 * Add CSS styles
	 */
	function ilsl_add_CSS() {

		// Register Shortcodes CSS
		wp_register_style( 'flexslider', ILSL_URL_ASSETS . '/css/flexslider.css', false, ISL_VERSION, 'all' );

		// Enqueue Styles
		wp_enqueue_style( 'flexslider' );
	}

	/**
	 * Set up Custom Post Types
	 */
	function ilsl_custom_post_types() {

			// Slider Custom Post Type
			register_post_type( 'ilmenite_slider', array(
				'labels' => array(
					'name'               => __("Slides", 'ilslider'),
					'singular_name'      => __("Slide", 'ilslider'),
					'add_new'            => _x("Add New", 'pluginbase', 'ilslider' ),
					'add_new_item'       => __("Add New Slide", 'ilslider' ),
					'edit_item'          => __("Edit Slide", 'ilslider' ),
					'new_item'           => __("New Slide", 'ilslider' ),
					'view_item'          => __("View Slide", 'ilslider' ),
					'search_items'       => __("Search Slides", 'ilslider' ),
					'not_found'          =>  __("No slides found", 'ilslider' ),
					'not_found_in_trash' => __("No slides found in Trash", 'ilslider' ),
				),
				'description'         => __("Image and video slider for use in themes.", 'ilslider'),
				'capability_type'		 => 'post',
				'public'              => true,
				'publicly_queryable'  => true,
				'query_var'           => true,
				'rewrite'             => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 33,
				'menu_icon' 			 => ILSL_URL_ASSETS . '/images/slider-icon.png',
				'supports'            => array(
					'title',
					'editor',
					'thumbnail',
				),
			));
		}


	/**
	 * Register activation hook
	 */
	function ilsl_on_activate_callback() {
		// do something on activation
	}

	/**
	 * Register deactivation hook
	 */
	function ilsl_on_deactivate_callback() {
		// do something when deactivated
	}

	/**
	 * Add textdomain for plugin
	 */
	function ilsl_add_textdomain() {
		load_plugin_textdomain( 'ilslider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Auto Update Support
	 *
	 * Adds support for auto-updating from GitHub repository.
	 *
	 * @since  1.2
	 */
	function ilsl_plugin_update() {

		// Include updater class
		require_once( ILSL_PATH_INCLUDES . '/updater.php' );

		define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

			$config = array(
				'slug'               => plugin_basename( __FILE__ ),
				'proper_folder_name' => 'ilmenite-slider',
				'api_url'            => 'https://api.github.com/repos/xldstudios/ilmenite-slider',
				'raw_url'            => 'https://raw.github.com/xldstudios/ilmenite-slider/master',
				'github_url'         => 'https://github.com/xldstudios/ilmenite-slider',
				'zip_url'            => 'https://github.com/xldstudios/ilmenite-slider/archive/master.zip',
				'sslverify'          => true,
				'requires'           => '3.0',
				'tested'             => '3.6',
				'readme'             => 'README.md',
			);

			new WP_GitHub_Updater( $config );

		}

	}

}

// Initialize everything
$il_slider = new Ilmenite_Slider();