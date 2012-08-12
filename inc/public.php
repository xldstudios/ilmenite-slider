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
		
		// Enqueue
		wp_enqueue_script( 'flexslider' );
		
	}
	
	/**
	 * Slider Function
	 *
	 * @since Ilmenite Slider 1.0
	 * @params id (string) | class (string) | caption (true/false)
	 **/
	public function slider_code( $id = 'slider', $class, $caption = 'false' ) {
		
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
							
							$output .= the_post_thumbnail('slider');
							
							// Output the caption if one is set to be displayed
							if( $caption == true ) :
							
							$output .= '<p class="flex-caption">';
							
								$output .= get_the_excerpt();
								
							$output .= '</p>';
							
							endif;
							
						$output .= '</li>';

					endwhile;
					
				$output .= '</ul>';
				
			$output .= '</section>';
		
		endif;
		
		// Return
		return $output;
		
	}
	
}