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


} // class Genesis_CTA_Widget
