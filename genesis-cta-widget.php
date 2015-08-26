<?php 

/*
Plugin Name: Genesis Call To Action Widget
Description: A Genesis Framework Call To Action Widget with text, background image, alignment, and button icon support.
Version: 1.0
Author: Jordan Pakrosnis
Author URI: http://JordanPak.com/
*/


function jordanpak_register_widgets() {
	register_widget( 'WPShout_Favorite_Song_Widget');
}

add_action( 'widgets_init', 'jordanpak_register_widgets' );



class Genesis_CTA_Widget extends WP_Widget {


    function Genesis_CTA_Widget() {
        
		// Instantiate the parent object
		parent::__construct(
	            'genesis_cta_widget', // Base ID
        	    __('Genesis Call To Action Widget', 'text_domain'), // Name
 	           array( 'description' => __( 'Call To Action Widget with text, background image, alignment, and button icon support for the Genesis Framework.', 'text_domain' ), ) // Args
		);
	
    } // Genesis_CTA_Widget()
    
    
	function widget( $args, $instance ) {
		echo $args['before_widget']; 
        
        echo '<div class="gcta-wrap">';
        
            echo $args['title'];
            echo $args['body'];
            echo $args['button'];
        
        // Close Wrap
        echo '</div>';
        
		echo $args['after_widget'];
	
    } // widget()
    

} // class Genesis_CTA_Widget
