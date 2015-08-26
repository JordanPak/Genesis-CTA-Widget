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
    
    
    
	function update( $new_instance, $old_instance ) {
        
		$instance = $old_instance;
        
		//-- FIELDS --//
        
        // Text
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['body']           = strip_tags( $new_instance['body'] );
        $instance['text_align']     = strip_tags( $new_instance['text_align'] );
        
        // Background
        $instance['bg_url']         = strip_tags( $new_instance['bg_url'] );
        $instance['bg_color']       = strip_tags( $new_instance['bg_color'] );
        $instance['bg_position']    = strip_tags( $new_instance['bg_position'] );
        
        // Button
        $instance['button_text']    = strip_tags( $new_instance['button_text'] );
        $instance['button_icon']    = strip_tags( $new_instance['button_icon'] );
        $instance['button_url']     = strip_tags( $new_instance['button_url'] );
		
        return $instance;
        
	} // update()



    // Widget form creation
	function form( $instance ) {
	 	
        $title = '';
        $body = '';
        $text_align = '';
        
        $bg_url = '';
        $bg_color = '';
        $bg_position = '';
        
        $button_text = '';
        $button_icon = '';
        $button_url = '';
        

		// Check values
		if( $instance ) {
			
            $title          = esc_html( $instance['title'] );
            $body           = esc_html( $instance['body'] );
            $text_align     = esc_attr( $instance['text_align'] );
            
            $bg_url         = esc_url( $instance['bg_url'] );
            $bg_color       = esc_attr( $instance['bg_color'] );
            $bg_position    = esc_attr( $instance['bg_position'] );
            
            $button_text    = esc_attr( $instance['button_text'] );
            $button_icon    = esc_attr( $instance['button_icon'] );
            $button_url     = esc_url( $instance['button_url'] );
            
                                   
//          $link = esc_attr($instance['link']);
//			$songinfo = esc_textarea($instance['songinfo']);
//            
		} ?>
		 
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		 
		<p>
			<label for="<?php echo $this->get_field_id('songinfo'); ?>"><?php _e('Song Info:', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('songinfo'); ?>" name="<?php echo $this->get_field_name('songinfo'); ?>" type="text" value="<?php echo $songinfo; ?>" />
		</p>
		
	<?php }    
    
} // class Genesis_CTA_Widget
