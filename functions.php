<?php
/**
 * functions.php
 *
 * Functions and definitions
 */

/**
 * ---------------------------------------------------------------------------
 * Constants
 * ---------------------------------------------------------------------------
 */

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() .'/framework' );

/**
 * ---------------------------------------------------------------------------
 * Load the framework
 * ---------------------------------------------------------------------------
 */

require_once( FRAMEWORK . '/init.php' );

/**
 * ---------------------------------------------------------------------------
 * Set up the content width
 * ---------------------------------------------------------------------------
 */

if ( ! isset($content_width) ){
    $content_width = 980;
}

/**
 * ---------------------------------------------------------------------------
 * Set up theme default and register various supported features
 * ---------------------------------------------------------------------------
 */
if ( ! function_exists( 'abyp_setup' )){
    function abyp_setup(){
        /**
         * ¿Translation ready?
         */
        $lang_dir = THEMEROOT .'/languages';
        load_theme_textdomain( 'abyp', $lang_dir );

        /**
         * Post Formats
         */
        add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

        // Automatic feed links
        add_theme_support( 'automatic-feed-links' );

        // Post thumbnails support
        add_theme_support( 'post-thumbnails');

        // Default custom backgrounds
        // add_theme_support( 'custom-background' );

        /**
         * Register Nav Menus
         */
        register_nav_menus(
                array(
                    'main-menu' => __( 'Main Menu', 'abyp')
                )
            );
    }

    add_action( 'after_setup_theme', 'abyp_setup' );
}
/**
 * ---------------------------------------------------------------------------
 * Meta Information for specific post
 * ---------------------------------------------------------------------------
 */

if ( ! function_exists( 'abyp_post_meta' )){
    function abyp_post_meta() {
        echo '<ul class="list-inline entry-meta">';

        if ( get_post_type() === 'post' ) {
            // If the post is sticky, mark it.
            if ( is_sticky() ) {
                echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'abyp' ) . ' </li>';
            }

            // Get the post author.
            printf(
                '<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );

            // Get the date.
            echo '<li class="meta-date"> ' . get_the_date() . ' </li>';

            // The categories.
            $category_list = get_the_category_list( ', ' );
            if ( $category_list ) {
                echo '<li class="meta-categories"> ' . $category_list . ' </li>';
            }

            // The tags.
            $tag_list = get_the_tag_list( '', ', ' );
            if ( $tag_list ) {
                echo '<li class="meta-tags"> ' . $tag_list . ' </li>';
            }

            // Comments link.
            if ( comments_open() ) :
                echo '<li>';
                echo '<span class="meta-reply">';
                comments_popup_link( __( 'Leave a comment', 'abyp' ), __( 'One comment so far', 'abyp' ), __( 'View all % comments', 'abyp' ) );
                echo '</span>';
                echo '</li>';
            endif;

            // Edit link.
            if ( is_user_logged_in() ) {
                echo '<li>';
                edit_post_link( __( 'Edit', 'abyp' ), '<span class="meta-edit">', '</span>' );
                echo '</li>';
            }
        }
    }
}

/**
 * ----------------------------------------------------------------------------------------
 * Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'abyp_paging_nav' ) ) {
    function abyp_paging_nav() { ?>
        <ul>
            <?php 
                if ( get_previous_posts_link() ) : ?>
                <li class="next">
                    <?php previous_posts_link( __( 'Newer Posts &rarr;', 'abyp' ) ); ?>
                </li>
                <?php endif;
             ?>
            <?php 
                if ( get_next_posts_link() ) : ?>
                <li class="previous">
                    <?php next_posts_link( __( '&larr; Older Posts', 'abyp' ) ); ?>
                </li>
                <?php endif;
             ?>
        </ul> <?php
    }
}

/**
 * ----------------------------------------------------------------------------------------
 * Function that validates a field's length.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'abyp_validate_length' ) ) {
    function abyp_validate_length( $fieldValue, $minLength ) {
        // First, remove trailing and leading whitespace
        return ( strlen( trim( $fieldValue ) ) > $minLength );
    }
}

/**
 * ----------------------------------------------------------------------------------------
 * Include the generated CSS in the page header.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'abyp_load_wp_head' ) ) {
    function abyp_load_wp_head() {    
        if ( is_user_logged_in() ) {
            ?>
            <style type="text/css">
                #head { top: 32px; }
            </style>
            <?php 
        }
    }

    add_action( 'wp_head', 'abyp_load_wp_head' );
}

/**
 * ----------------------------------------------------------------------------------------
 * Load the custom scripts for the theme.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'abyp_scripts' ) ) {
    function abyp_scripts() {
        // Adds support for pages with threaded comments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Register scripts        
        wp_register_script( 'modernizr', SCRIPTS . '/vendor/modernizr.custom.25133.js', false, false, true );
        wp_register_script( 'tween-max', SCRIPTS . '/vendor/TweenMax.min.js', false, false, true );
        wp_register_script( 'jquery-abyp', SCRIPTS . '/vendor/jquery-2.1.1.min.js', false, false, true );
        wp_register_script( 'easing', SCRIPTS . '/vendor/jquery.easing.1.3.js', false, false, true );
        wp_register_script( 'lightbox', SCRIPTS . '/vendor/lightbox-2.6.min.js', false, false, true );
        wp_register_script( 'vendor-bundle', SCRIPTS . '/vendor/vendor.bundle.js', false, false, true );
        wp_register_script( 'abyp-main', SCRIPTS . '/main.js', false, false, true );

        // Load the custom scripts        
        wp_enqueue_script( 'modernizr' );
        wp_enqueue_script( 'tween-max' );
        wp_enqueue_script( 'jquery-abyp' );
        wp_enqueue_script( 'easing' );
        wp_enqueue_script( 'lightbox' );
        wp_enqueue_script( 'vendor-bundle' );
        wp_enqueue_script( 'abyp-main' );       

        // Load the stylesheets        
        wp_enqueue_style( 'lightbox', THEMEROOT . '/assets/css/lightbox.css' );
        wp_enqueue_style( 'abyp-master', THEMEROOT . '/assets/css/master.css' );
    }

    add_action( 'wp_enqueue_scripts', 'abyp_scripts' );
}

?>