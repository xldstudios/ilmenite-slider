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

class ISL_Admin extends Ilmenite_Slider {
	
	
	/**
	 * Admin Init Function
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	protected function init() {
		
		// Runs the activation function
		register_activation_hook( $this->_config->plugin_file, array( $this, 'activate' ) );
		
		// Registers admin menu separators
		add_action( 'admin_menu', array( $this, 'admin_menu_separator' ) );
		
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
	
	/**
	 * Admin Menu Seprator
	 *
	 * @since Ilmenite Slider 1.0
	 * @param integer
	 **/
	function add_admin_menu_separator($position) {

		global $menu;
		$index = 0;
	
		foreach($menu as $offset => $section) {
			if (substr($section[2],0,9)=='separator')
			    $index++;
			if ($offset>=$position) {
				$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
				break;
		    }
		}
	
		ksort( $menu );
	}
	
	/**
	 * Adds admin menu separators
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	function admin_menu_separator() {

		// Adds custom separator after comments (at position 30)
		$this->add_admin_menu_separator(30);
	}
	
}