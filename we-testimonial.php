<?php
/*
Plugin Name: WE - Testimonial Slider
Plugin URI: https://wordpress.org/plugins/we-testimonial-slider/
Description: WE - Testimonial Slider plugin is very easy to setup and a fully responsive & mobile friendly WordPress plugin to manage testimonials. You can choose to display single testimonial or display testimonials as a slider using custom short codes. 
Tags: testimonial, slider, all testimonial, single testimonial
Author: wordprEsteem
Author URI: https://profiles.wordpress.org/wordpresteem
Contributors: wordprEsteem
Tested up to: 6.2.2
Version: 1.5
Requires PHP: 5.6.3
Text Domain: we-testimonial-slider
License: GPL v2 or later
*/

if (!defined('ABSPATH')) die();

/**
*
* @return WE Testimonial Plugin Version
*
*/
if (!function_exists('plugin_get_version')) {
	function plugin_get_version() {
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];
	}
}


/*
*
*  Add WE Testimonial Style
*
*/
if (!function_exists('we_testimonial_stylesheet')) {
	function we_testimonial_stylesheet() {
		wp_enqueue_style('we_testimonial_fontawesome_style', plugins_url('/we-testimonial-slider/css/fontawesome-all.min.css'));		
		wp_enqueue_style('we_testimonial_slider_style', plugins_url('/we-testimonial-slider/css/we_testimonial_style.css'));
		wp_add_inline_style( 'we_testimonial_slider_style',$color);
	}
	add_action( 'wp_enqueue_scripts', 'we_testimonial_stylesheet' );
}

/*
 *
 *  WE Testimonial
 *
 */
function we_testimonial_head($defaults) {
    $defaults['testimonial_code'] = 'Shortcode';
    return $defaults;
}
add_filter('manage_testimonial_posts_columns', 'we_testimonial_head', 10);

/*
 *
 *  WE Testimonial Single Shortcode Column
 *
 */
function we_testimonial_columns_content($column_name, $post_ID) {
    if ($column_name == 'testimonial_code'){
		echo  '<span class="shortcode"><input onfocus="this.select();" readonly="readonly" value="[we_single_testimonial id='.get_the_ID().']" type="text"></span>';
	}
}
add_action('manage_testimonial_posts_custom_column', 'we_testimonial_columns_content', 10, 2);


/*
 *
 *  WE Testimonial Custom Column 
 *
 */
if (!function_exists('we_testimonial_reorder_columns')) {
	function we_testimonial_reorder_columns($columns) {
  		$crunchify_columns = array();
  		$testimonial_code = 'testimonial_code'; 
  		$date = 'date'; 
  		foreach($columns as $key => $value) {
    		if ($key==$date){
      			$crunchify_columns[$testimonial_code] = $testimonial_code;
    		}
      		$crunchify_columns[$key] = $value;
  		}
  		return $crunchify_columns;
	}
	add_filter('manage_testimonial_posts_columns', 'we_testimonial_reorder_columns');
}


/*
 *
 *  WE Testimonial Include Files
 *
 */
include_once( plugin_dir_path( __FILE__ ) . 'includes/testimonial_init.php' );
include_once( plugin_dir_path( __FILE__ ) . 'includes/testimonial_setting.php' );
include_once( plugin_dir_path( __FILE__ ) . 'includes/testimonial_shortcode.php' );


/*
*
*  Add WE Testimonial Script
*
*/
if (!function_exists('we_testimonial_adding_scripts')) {
	function we_testimonial_adding_scripts(){
		wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, false, true);	
   		wp_enqueue_script('jquery');
		wp_register_script('we_testimonial_slider', plugins_url('js/we_testimonial.js', __FILE__));	
	}
	add_action( 'wp_enqueue_scripts', 'we_testimonial_adding_scripts' );  
}

function we_testimonial_script() {
	wp_enqueue_script('we_testimonial_slider');	
}
add_action( 'wp_footer', 'we_testimonial_script' );

