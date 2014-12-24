<?php 
/**
 * page.php
 *
 * The template for displaying all pages.
 */
?>

<?php get_header(); ?>

    <div class="main-content" role="main">            

        <?php while( have_posts() ) : the_post(); ?>            
            
            <?php if( is_front_page()): ?>
            <?php the_content(); ?>    
            <?php else : ?>
            <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Article header -->
                <?php
                    // If the post has a thumbnail and it's not password protected
                    // then display the thumbnail 
                ?>
                <?php if( has_post_thumbnail() and ! post_password_required() ) : ?>                    
                <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); ?>
                <div style="background: url('<?php echo $src[0]; ?>') no-repeat center center fixed; -webkit-background-size: cover -moz-background-size: cover; -o-background-size: cover; background-size: cover;" class="sectInH imgcoverIN"></div>
                <?php endif; ?>

                <!-- Article content -->
                <div class="safeArea SfH center-h">
                    <?php the_content(); ?>
                    <?php // wp_link_pages(); ?>
                </div> <!-- end entry-content -->
            </section>

            <?php comments_template(); ?>    
            <?php endif; ?>

        <?php endwhile; ?>

        <?php if( is_front_page() ) :?>
        <section id="contact">
            <div class="safeArea SfH center-h">
                <h1 style="color:#000;">contact us</h1>
                <div class="lineThis"></div>
                <a href="mailto:info@a-by-p.com"><h1 style="color:#000;">info@a-by-p.com</h1></a>
            </div>
        </section>
        <?php endif; ?>

    </div> <!-- end main-content -->
<?php get_footer(); ?>