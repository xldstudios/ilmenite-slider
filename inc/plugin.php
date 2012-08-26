<?php
/**
 * Base Plugin Class
 *
 * This class is extended in both admin and public and makes
 * config class available to both subclasses.
 * The classes also includes methods for adding WP filters and actions
 * and includes an init() function to setup filters and actions in public and admin
 *
 * @since Ilmenite Slider 1.0
 * @version 1.0
 * @package Ilmenite Slider
 **/

abstract class Ilmenite_Slider {
	
	protected $_config;
	
	/**
	 * Constuction Function
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function __construct( ISL_Config $config ) {
			
		// Loads config
		$this->_config = $config;
		
		// Load Textdomain
		load_plugin_textdomain( 'ilslider', false, ISL_PLUGIN_DIR );
		
		// Loads init function
		$this->init();
		
		// Loads slider post type function
		add_action( 'init', array( $this, 'slider_post_type' ) );
		
		// Add image sizes and thumbnail support
		add_action( 'init', array( $this, 'image_sizes' ) );
		
	}
	
	/**
	 * Init Function
	 *
	 * Used by public and admin to register filters and actions
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	abstract protected function init();
	
	protected function add_action( $action, $function = '', $priority = 10, $accepted_args = 1 ) {
		add_action( $action, array($this, $function == '' ? $action : $function ), $priority, $accepted_args );
	}
	
	protected function add_filter( $filter, $function, $priority = 10, $accepted_args = 1 ) {
		add_filter( $filter, array($this, $function == '' ? $filter : $function ), $priority, $accepted_args );
	}
	
	/**
	 * Register Slider Post Type
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function slider_post_type() {
			
		// Post Type Labels
		$labels = array(
		
			'name' => _x('Slider', 'post type general name', 'ilslider'),
			'singular_name' => _x('Slider', 'post type singular name', 'ilslider'),
			
			'add_new' => _x('Add New', 'title for add new of post type', 'ilslider'),
			'add_new_item' => __('Add New Item', 'ilslider'),
			'edit_item' => __('Edit Item', 'ilslider'),
			'new_item' => __('New Item', 'ilslider'),
			'all_items' => __('All Items', 'ilslider'),
			'view_item' => __('View Item', 'ilslider'),
			'search_items' => __('Search Items', 'ilslider'),
			
			'not_found' => __('No slider items found', 'ilslider'),
			'not_found_in_trash' => __('No slider items found in the trash', 'ilslider'),
			
			'parent_item_colon' => '',
			
			'menu_name' => _x('Slider', 'menu title for slider post type', 'ilslider')
			
		);
		
		// Post Type Arguments
		$args = array(
			
			'labels' => $labels,
			'description' => __('Image and video slider for use in themes.', 'ilslider'),
			
			'public' => true,
			'publicly_queryable' => true, // Can be accessed from a WP Query
			'exclude_from_search' => true,
			
			'show_ui' => true, // Shows admin editing UI
			'query_var' => true,
			'show_in_menu' => true, // Show in navigation screen
			'show_in_admin_bar' => true,
			'menu_position' => 33,
			'menu_icon' => ISL_IMAGES . '/slider-icon.png',
			
			'rewrite' => true,
			'has_archive' => true,
			
			'hierarchial' => false,
			'capability_type' => 'post',
			'supports' => array(
				'title', 'editor', 'thumbnail'
			)
			
		);
		
		// Register the post type
		register_post_type( 'slider', $args );
		
	}
	
	/**
	 * Define Custom Image Sizes
	 *
	 * @since Ilmenite Slider 1.0
	 * @params width (integer) | height (integer) | hardcrop (true/false)
	 **/
	public function image_sizes( $width = 960, $height = 300, $hardcrop = true ) {
		
		// Make sure we support thumbnails
		add_theme_support('post-thumbnails');
		
		// Add custom slider image size
		add_image_size( 'slider', $width, $height, $hardcrop );
		
	}
	
}