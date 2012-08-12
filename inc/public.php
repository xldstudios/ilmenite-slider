<?php
/**
 * Public Class Extend
 *
 * Functions run on the public side
 *
 * @since Ilmenite Slider 1.0
 * @version 1.0
 * @package Ilmenite Slider
 **/

class ISL_Public extends Ilmenite_Slider {
	
	/**
	 * Init Function
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	protected function init() {
		
		// Load Stylesheets
		add_action( 'wp_head', array( $this, 'stylesheets' ) );
		
		// Load Scripts
		add_action( 'wp_head', array( $this, 'scripts' ) );
		
		// Add Shortode
		add_shortcode( 'slider', array( $this, 'slider_shortcode' ) );
		
	}
	
	/**
	 * Public Stylesheets
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function stylesheets() {
		
		// wp_register_style( $handle, $src, $deps, $ver, $media )
		wp_register_style( 'flexslider', ISL_CSS . '/flexslider.css', false, ISL_VERSION, 'all' );
		
		// Enqueue
		wp_enqueue_style( 'flexslider' );
		
	}
	
	/**
	 * Public Scripts
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function scripts() {
		
		// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
		wp_register_script( 'flexslider', ISL_JS . '/jquery.flexslider-min.js', array('jquery'), ISL_VERSION, true );
		
		// Check if slider javascript exists in stylesheet dir and template dir. If they do not, load the default plugin one.
		if( file_exists( get_stylesheet_directory() . '/js/slider.js' ) ) {
			$slider_js_path = get_stylesheet_directory() . '/js/slider.js';
		} elseif( file_exists( get_template_directory() . '/js/slider.js' ) ) {
			$slider_js_path = get_template_directory() . '/js/slider.js';
		} else {
			$slider_js_path = ISL_JS . '/slider.js';
		}
		
		wp_register_script( 'slider-script', $slider_js_path, array('jquery', 'flexslider'), ISL_VERSION, true );
		
		// Enqueue
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'slider-script' );
		
	}
	
	/**
	 * Slider Function
	 *
	 * @since Ilmenite Slider 1.0
	 * @params id (string) | class (string) | caption (true/false)
	 **/
	public function slider_code( $id = 'slider', $class = 'flexslider', $caption = 'false' ) {
		
	    $slider_args = array(
	    	'posts_per_page' => -1,
	    	'post_type' => 'slider'
	    );
		
	    $slider = new WP_Query($slider_args);
		
		if( $slider->have_posts() ) :
		
			$output .= '<section id="' . $id . '" class="' . $class . '">';
			
				$output .= '<ul class="slides">';
		
					while( $slider->have_posts() ) : $slider->the_post();
					
						$output .= '<li>';
							
							$output .= get_the_post_thumbnail($slider->ID, 'slider');
							
							// Output the caption if one is set to be displayed
							if( $caption == 'true' ) :
							
							$output .= '<div class="slide-caption">';
							
								$output .= get_the_excerpt();
								
							$output .= '</div>';
							
							endif;
							
						$output .= '</li>';

					endwhile;
					
				$output .= '</ul>';
				
			$output .= '</section>';
		
		endif;
		
		// Return
		return $output;
		
	}

	/**
	 * Slider Shortcode
	 *
	 * Usage: [slider id="string" class="string" caption="true/false" ]
	 *
	 * @since Ilmenite Slider 1.0
	 **/
	public function slider_shortcode( $atts ) {
		
		extract( shortcode_atts( array(
			'id' => 'slider',
			'class' => 'flexslider',
			'caption' => 'false'
		), $atts ) );
		
		$slider_code = $this->slider_code( $id, $class, $caption );
		
		return $slider_code;
		
	}
	
}