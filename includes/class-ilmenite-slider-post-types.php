<?php
/**
 * Post Types
 *
 * Class for the post types and taxonomies
 * that relates to the slider section.
 */

class Ilmenite_Slider_PostTypes {

	function __construct() {

		// Load Brands post type
		add_action( 'init', array( $this, 'slider_post_type' ), 0 );

		// Load Brands fields
		add_action( 'init', array( $this, 'slider_custom_fields' ), 5 );

	}

	/**
	 * Register Slider Post Type
	 */
	function slider_post_type() {

		$labels = array(
			'name'                => _x( 'Slides', 'Post Type General Name', 'ilmenite_slider' ),
			'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'ilmenite_slider' ),
			'menu_name'           => __( 'Slider', 'ilmenite_slider' ),
			'parent_item_colon'   => __( 'Parent Slide:', 'ilmenite_slider' ),
			'all_items'           => __( 'All Slides', 'ilmenite_slider' ),
			'view_item'           => __( 'View Slide', 'ilmenite_slider' ),
			'add_new_item'        => __( 'Add New Slide', 'ilmenite_slider' ),
			'add_new'             => __( 'Add New', 'ilmenite_slider' ),
			'edit_item'           => __( 'Edit Slide', 'ilmenite_slider' ),
			'update_item'         => __( 'Update Slide', 'ilmenite_slider' ),
			'search_items'        => __( 'Search Slide', 'ilmenite_slider' ),
			'not_found'           => __( 'Not found', 'ilmenite_slider' ),
			'not_found_in_trash'  => __( 'Not found in trash', 'ilmenite_slider' ),
		);

		$args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'menu_icon'           => plugins_url( '/assets/images/slider-cpt-icon.png', dirname( __FILE__ ) ),
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'capability_type'     => 'page',
		);

		register_post_type( 'ilmenite_slider', $args );

	}

	/**
	 * Register Custom Fields
	 *
	 * ACF custom fields for the slider post type
	 * Depends on Advanced Custom Fields
	 */
	function slider_custom_fields() {

		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_slide',
				'title' => __( 'Slide', 'ilmenite_slider' ),
				'fields' => array (
					array (
						'key' => 'field_532d6117f1cf0',
						'label' => __( 'Link', 'ilmenite_slider' ),
						'name' => 'slide_link',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => 'http://',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_532d612ff1cf1',
						'label' => __( 'Text', 'ilmenite_slider' ),
						'name' => 'slide_text',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'ilmenite_slider',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'acf_after_title',
					'layout' => 'default',
					'hide_on_screen' => array (
						0 => 'permalink',
						1 => 'comments',
						2 => 'slug',
					),
				),
				'menu_order' => 0,
			));
		}

	}

}

new Ilmenite_Slider_PostTypes();