<?php 
/**
 * category.php
 *
 * The template for displaying category pages.
 */
?>

<?php get_header(); ?>

    <div class="main-content" role="main">
        <?php if ( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>

            <?php // abyp_paging_nav(); ?>
        <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
    </div> <!-- end main-content -->

<?php get_footer(); ?>