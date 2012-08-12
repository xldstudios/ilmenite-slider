<?php
/**
 * Theme Functions
 *
 * Functions outside the class for easier use in themes.
 *
 * @since Ilmenite Slider 1.0
 * @version 1.0
 * @package Ilmenite Slider
 **/

function get_ilmenite_slider(  $id = 'slider', $class, $caption = 'false'  ) {
	
	global $ilmenite_slider;
	
	$ilmenite_slider->slider_code(  $id, $class, $caption );
	
}

function ilmenite_slider(  $id = 'slider', $class, $caption = 'false'  ) {
	
	global $ilmenite_slider;
	
	$slider = $ilmenite_slider->slider_code(  $id, $class, $caption );
	
	echo $slider;
	
}