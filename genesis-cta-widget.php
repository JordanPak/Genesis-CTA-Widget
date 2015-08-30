<?php 

/*
Plugin Name: Genesis Call To Action Widget
Description: A Genesis Framework Call To Action Widget with text, background image, alignment, and button icon support.
Version: 1.0
Author: Jordan Pakrosnis
Author URI: http://JordanPak.com/
*/


function jordanpak_register_widgets() {
	register_widget( 'Genesis_CTA_Widget');
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
        
        // LOGIC //
        
        // Text Align
        $text_align_style = '';
        
        $text_align_style = $instance['text_align'];
        $text_align_style = 'text-align: ' . $text_align_style . '; ';
        
        
        // Background
        $bg_style = '';
        
        $bg_style .= 'background: ';
        
        if ( $instance['bg_url'] != '' )
            $bg_style .= 'url(\'' . $instance['bg_url'] . '\')';
        
        if ( $instance['bg_color'] != '' )
            $bg_style .= ' ' . $instance['bg_color'];
        
        $bg_style .= ' no-repeat';
        
        if ( $instance['bg_position'] != '' )
            $bg_style .= ' ' . $instance['bg_position'];
        
        
        
        // Button
        $button = '';
        $button .= '<a class="gcta-button" href="' . $instance['button_url'] . '">';
        if ( $instance['button_icon'] != '' )
            $button .= '<i class="fa fa-lg fa-' . $instance['button_icon'] . '"></i>&nbsp;&nbsp;&nbsp;';
            $button .= $instance['button_text'];
        $button .= '</a>';
        
        
        // Wrapper classes
        $wrapper_classes = '';
        $wrapper_classes .= 'widget gcta-wrap';
        
        if ( $instance['theme'] == 'dark' )
            $wrapper_classes .= ' gcta-theme-dark';
        
        
        
        // OUTPUT //
        
		echo $args['before_widget']; 
        
        echo '<section class="' . $wrapper_classes . '" style="' . $text_align_style . $bg_style . ';">';
        
            echo '<h3 class="widget-title widgettitle">' . $instance['title'] . '</h3>';
            echo '<p class="gcta-body">' . $instance['body'] . '</p>';
            echo $button;
        
        // Close Wrap
        echo '</section>';
        
		echo $args['after_widget'];
	
    } // widget()
    
    
    
	function update( $new_instance, $old_instance ) {
        
		$instance = $old_instance;
        
		//-- FIELDS --//
        
        // Text
        $instance['title']          = $new_instance['title'];
        $instance['body']           = $new_instance['body'];
        $instance['text_align']     = strip_tags( $new_instance['text_align'] );
        
        // Background
        $instance['theme']          = strip_tags( $new_instance['theme'] );
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
        
        $theme = '';
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
            
            $theme          = esc_attr( $instance['theme'] );
            $bg_url         = esc_url( $instance['bg_url'] );
            $bg_color       = esc_attr( $instance['bg_color'] );
            $bg_position    = esc_attr( $instance['bg_position'] );
            
            $button_text    = esc_attr( $instance['button_text'] );
            $button_icon    = esc_attr( $instance['button_icon'] );
            $button_url     = esc_url( $instance['button_url'] );
            
		} ?>
		
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('body'); ?>"><?php _e('Body / Subtitle', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>" type="text" value="<?php echo $body; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text_align'); ?>"><?php _e('Text Alignment', 'wp_widget_plugin'); ?></label>
            <select id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
                
                <?php
        
                $text_align_options = array(
                    "left" => "Left",
                    "center" => "Center",
                    "right" => "Right"
                );
        
                foreach( $text_align_options as $value=>$label ) {
                    
                    if ( $text_align == $value )
                        echo '<option selected value="' . $value . '">' . $label . '</option>';
                    
                    else
                        echo '<option value="' . $value . '">' . $label . '</option>';
                    
                } // foreach
        
                ?>
                
            </select>
        </p>

        <hr class="div">
    
        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme', 'wp_widget_plugin'); ?></label>
            <select id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                
                <?php
        
                $theme_options = array(
                    "light" => "Light",
                    "dark" => "Dark",
                );
        
                foreach( $theme_options as $value=>$label ) {
                    
                    if ( $theme == $value )
                        echo '<option selected value="' . $value . '">' . $label . '</option>';
                    
                    else
                        echo '<option value="' . $value . '">' . $label . '</option>';
                    
                } // foreach
        
                ?>
                
            </select>
        </p>  

        <p>
            <label for="<?php echo $this->get_field_id('bg_url'); ?>"><?php _e('Background URL', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_url'); ?>" name="<?php echo $this->get_field_name('bg_url'); ?>" type="text" value="<?php echo $bg_url; ?>" />
        </p>        

        <p>
            <label for="<?php echo $this->get_field_id('bg_color'); ?>"><?php _e('BG Color (Ex: #000000)', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_color'); ?>" name="<?php echo $this->get_field_name('bg_color'); ?>" type="text" value="<?php echo $bg_color; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('bg_position'); ?>"><?php _e('CSS Background Position', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_position'); ?>" name="<?php echo $this->get_field_name('bg_position'); ?>" type="text" value="<?php echo $bg_position; ?>" />
        </p>

        <hr class="div">

        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_icon'); ?>"><?php _e('Button Icon (<a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_BLANK">FontAwesome</a> class suffix. Ex: "book")', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_icon'); ?>" name="<?php echo $this->get_field_name('button_icon'); ?>" type="text" value="<?php echo $button_icon; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
        </p>

	<?php }    
    
} // class Genesis_CTA_Widget




// WIDGET STYLES
add_action( 'wp_enqueue_scripts', 'gcta_styles' );
function gcta_styles() {
    
    wp_enqueue_style( 'gcta', plugins_url() . '/genesis-cta-widget/css/gcta-styles.css', array() );
    
} // renaromano_global_styles()

