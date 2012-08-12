<?php
/**
 * Plugin Configuration File
 *
 * Basic wrapper for config variables.
 *
 * @since Ilmenite Slider 1.0
 * @version 1.0
 * @package Ilmenite Slider 1.0
 **/

class IS_Config {
	
	protected $config;
	
	/**
	 * Constructor Function
	 *
	 * @since Ilmenite Slider 1.0 
	 **/
	public function __construct( array $config ) {
		$this->config = $config;
	}
	
	/**
	 * Get Plugin Options
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function __get( $name ) {
		$value = false;
		
		if( array_key_exists( $name, $this->config ) ) {
			$value = $this->config[$name];
		}
		
		return $value;
	}
	
}