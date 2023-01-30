<?php

/**
 * Plugin Name:       Image Slider
 * Plugin URI:        https://github.com/soham1255/Slideshow
 * Description:       This ia image slider which provide you the shortcode as well as provide the setting page to manage the image position.
 * Version:           1.0.0
 * Author:            Soham Patel
 * Author URI:        https://theportfoliomaker.com/profile/Soham-Patel-2f885d0fbe2e131bfc9d98363e55d1d4
 * License:           
 * License URI:       
 * Text Domain:       image-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'IMAGE_SLIDER_VERSION', '1.0.0' );


function activate_image_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-image-slider-activator.php';
	Image_Slider_Activator::activate();
}


function deactivate_image_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-image-slider-deactivator.php';
	Image_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_image_slider' );
register_deactivation_hook( __FILE__, 'deactivate_image_slider' );


require plugin_dir_path( __FILE__ ) . 'includes/class-image-slider.php';


function run_image_slider() {

	$plugin = new Image_slider();
	$plugin->run();

}
run_image_slider();
