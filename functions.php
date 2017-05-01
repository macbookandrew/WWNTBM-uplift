<?php

/**
 * Enqueue subscription form JS
 */
function uplift_enqueue_js() {
	wp_enqueue_script( 'subscribe', get_stylesheet_directory_uri() . '/js/subscribe.js', array( 'jquery' ), NULL, true );
}
add_action( 'wp_enqueue_scripts', 'uplift_enqueue_js' );

/**
 * Make podcasts private by default
 */
function default_post_visibility() {
	global $post;

	if ( 'publish' == $post->post_status ) {
		$visibility = 'public';
		$visibility_trans = __( 'Public' );
	} elseif ( !empty( $post->post_password ) ) {
		$visibility = 'password';
		$visibility_trans = __( 'Password protected' );
	} elseif ( $post->post_type == 'podcast' && is_sticky( $post->ID ) ) {
		$visibility = 'public';
		$visibility_trans = __( 'Public, Sticky' );
	} else {
		$post->post_password = '';
		$visibility = 'private';
		$visibility_trans = __( 'Private' );
	} ?>

	<script type='text/javascript'>
		(function($) {
			try {
				$('#post-visibility-display').text('<?php echo $visibility_trans; ?>');
				$('#hidden-post-visibility').val('<?php echo $visibility; ?>');
				$('#visibility-radio-<?php echo $visibility; ?>').attr('checked', true);
			} catch(e) {}
		})(jQuery);
	</script>
	<?php
}
add_action( 'post_submitbox_misc_actions' , 'default_post_visibility' );
