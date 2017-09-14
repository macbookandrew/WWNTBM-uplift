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

/**
 * Show podcast info only to logged-in users
 * @return string HTML content
 */
function uplift_login_shortcode() {
    ob_start();

    if ( ! is_user_logged_in() ) {
        $login_args = array(
            'redirect'  => get_home_url() . '/podcast/',
        );
        echo '<h2>Log In</h2>
        <p>Please log in to access these podcasts.</p>';
        wp_login_form( $login_args );
    } else {
        echo '<h2>Podcasts</h2>
        <p><a href="' . get_home_url() . '/podcast/" class="button">Access the podcasts here</a>.</p>';
    }

    return ob_get_clean();
}
add_shortcode( 'conditional_login_form', 'uplift_login_shortcode' );
