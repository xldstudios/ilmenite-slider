<?php
/**
 * Admin Class
 *
 * Extends the plugin class with features run on the admin panel.
 *
 * @since Ilmenite Slider 1.0
 * @version 1.0
 * @package Ilmenite Slider
 **/

class IS_Admin extends Ilmenite_Slider {
	
	
	/**
	 * Admin Init Function
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	protected function init() {
		
		// Runs the activation function
		register_activation_hook( $this->_config->plugin_file, array( $this, 'activate' ) );
		
	}
	
	/**
	 * Activate Function
	 *
	 * Code that is run when plugin is activated.
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function activate() {
		
	}
	
}