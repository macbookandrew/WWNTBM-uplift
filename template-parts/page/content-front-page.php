<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

    <?php if ( has_post_thumbnail() ) :
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

        $post_thumbnail_id = get_post_thumbnail_id( $post->ID );

        $thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

        // Calculate aspect ratio: h / w * 100%.
        $ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
        ?>

        <div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
            <div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
        </div><!-- .panel-image -->

    <?php endif; ?>

    <div class="panel-content">
        <div class="wrap">
            <header class="entry-header">
                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

                <?php twentyseventeen_edit_link( get_the_ID() ); ?>

            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                    /* translators: %s: Name of current post */
                    the_content( sprintf(
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                        get_the_title()
                    ) );

                    if ( is_user_logged_in() ) {
                        echo '<section class="home-half login">
                            <h2>Missionary Podcasts</h2>
                            <p><a href="' . get_home_url() . '/podcast/" class="button">Access the missionary-only podcasts here</a>.</p>
                        </section>';
                    }

                    echo '</section>
                    <section class="home-half public">
                    <h2>Uplift for Servants</h2>
                    ' . do_shortcode( '[podcast_playlist series="uplift-for-servants"]' ) . '</section>';

                    if ( ! is_user_logged_in() ) {
                        $login_args = array(
                            'redirect'  => get_home_url() . '/podcast/',
                        );
                        echo '<section class="home-half login">
                            <h2>Missionary Podcasts</h2>
                            <p>Please log in to access these podcasts.</p>';
                            wp_login_form( $login_args );
                        echo '</section>';
                    }

                ?>
            </div><!-- .entry-content -->

        </div><!-- .wrap -->
    </div><!-- .panel-content -->

</article><!-- #post-## -->
