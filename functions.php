<?php
/**
 * _themename theme functions and definitions
 *
 * @package _themename
 */


$theme_includes = array(
	'/theme-support.php',                   // Initialize theme default settings.
	'/widget-areas.php',                    // Register widget area(s).
    '/enqueue-scripts.php',                 // Enqueue scripts and styles.
    '/blocks.php',                          // Register custom blocks and block editor functions
    '/shortcodes.php',                       // Shortcode registration and functions
    '/ajax-functions.php',                  // Define theme AJAX functions
    '/utility-functions.php',               // Helper/utility functions
);

if( class_exists( 'GFAPI' ) ){
    $theme_includes[] = '/gravity-form-hooks.php';
}

if( class_exists( 'ACF' ) ){
    $theme_includes[] = '/acf-hooks.php';
}

foreach ( $theme_includes as $file ) {
	$filepath = locate_template( 'library' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}