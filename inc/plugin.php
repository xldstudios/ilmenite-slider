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
		
		$this->_config = $config; // Loads config
		
		$this->init(); // Loads init function
		
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
	
}