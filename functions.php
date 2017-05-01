<?php

/**
 * Enqueue subscription form JS
 */
function uplift_enqueue_js() {
	wp_enqueue_script( 'subscribe', get_stylesheet_directory_uri() . '/js/subscribe.js', array( 'jquery' ), NULL, true );
}
add_action( 'wp_enqueue_scripts', 'uplift_enqueue_js' );
