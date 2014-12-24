<?php
/**
 * content.php
 *
 * The default template for displaying content
 */
?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
    <?php 
        /**
         * If the post has a thumbnail and it's not password protected
         * display the thumbnail
         */
    ?>
    <?php if( has_post_thumbnail() and ! post_password_required() ) : ?>    
    <?php 
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
    ?>
    <div style="background: url(<?php echo $src[0]; ?>) no-repeat center center fixed; -webkit-background-size: cover -moz-background-size: cover; -o-background-size: cover; background-size: cover;" class="sectInH imgcoverIN"></div>
    <?php endif; ?>

    <div class="safeArea SfH center-h">
        <?php
            if ( is_search() ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading &rarr;', 'abyp' ) );

                wp_link_pages();
            }
        ?>
    </div>
</section>