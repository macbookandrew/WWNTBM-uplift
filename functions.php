<?php
/**
 * Theme functions
 *
 * @package WWNTBM-uplift
 */

/**
 * Auto-calculate and define theme version constant for use in multiple stylesheets/scripts
 */
define( 'UPLIFT_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Enqueue subscription form JS
 */
function uplift_enqueue_js() {
	wp_enqueue_script( 'uplift', get_stylesheet_directory_uri() . '/js/uplift.js', array( 'jquery' ), UPLIFT_THEME_VERSION, true );

	// bib.ly scripts for auto-linking Bible verses.
	wp_enqueue_script( 'bibly', 'https://code.bib.ly/bibly.min.js', array(), null, true );
	wp_enqueue_style( 'bibly', 'https://code.bib.ly/bibly.min.css', array(), null );
	wp_add_inline_style( 'bibly', 'var bibly={linkVersion:"KJV",enablePopups:true,popupVersion:"KJV",autoStart:true,newWindow:true};', 'before' );
}
add_action( 'wp_enqueue_scripts', 'uplift_enqueue_js' );

/**
 * Show podcast info only to logged-in users.
 *
 * @return string HTML content
 */
function uplift_login_shortcode() {
	ob_start();

	if ( ! is_user_logged_in() ) {
		$login_args = array(
			'redirect' => get_home_url() . '/podcast/',
		);
		echo '<h2>Log In</h2>
		<p>Please log in to access these podcasts.</p>';
		wp_login_form( $login_args );
	} else {
		echo '<h2>Podcasts</h2>
		<p><a href="' . esc_url( get_home_url() ) . '/podcast/" class="button">Access the podcasts here</a>.</p>';
	}

	return ob_get_clean();
}
add_shortcode( 'conditional_login_form', 'uplift_login_shortcode' );

/**
 * Force HTTPS feed stylsheet URL.
 *
 * @param  string $feed_style_url RSS feed stylesheet URL.
 *
 * @return string modified RSS feed stylesheet URL.
 */
function uplift_rss_stylesheet( $feed_style_url ) {
	return str_replace( 'http://', 'https://', $feed_style_url );
}
add_filter( 'ssp_rss_stylesheet', 'uplift_rss_stylesheet' );

/**
 * Add placeholder attributes to Mailchimp signup form.
 *
 * @param  array $fields form fields.
 *
 * @return array modified form fields.
 */
function uplift_mc_placeholders( $fields ) {
	$fields[0]['default'] = 'john.doe@example.com';
	$fields[1]['default'] = 'John';
	$fields[2]['default'] = 'Doe';
	return $fields;
}
add_filter( 'mailchimp_dev_mode_fields', 'uplift_mc_placeholders' );
