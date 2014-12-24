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

if ( ! function_exists('disableAdminBar') ) {
 
    function disableAdminBar(){
   
    remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end
   
    function remove_admin_bar_style_backend() {  // css override for the admin page
      echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
    }
           
    add_filter('admin_head','remove_admin_bar_style_backend');
     
    function remove_admin_bar_style_frontend() { // css override for the frontend
      echo '<style type="text/css" media="screen">
      html { margin-top: 0px !important; }
      * html body { margin-top: 0px !important; }
      </style>';
    }
     
    add_filter('wp_head','remove_admin_bar_style_frontend', 99);
   
  }
 
}
 
add_action('init','disableAdminBar'); 


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

    // add_action( 'wp_head', 'abyp_load_wp_head' );
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

/**
 * 
 * Hook the galleries
 * 
 */
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag    = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns    = intval($columns);
    $itemwidth  = $columns > 0 ? floor(100/$columns) : 100;
    $float      = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = '</div><div class="safeArea SfH center-h">';
    $output .= apply_filters('gallery_style', "<div id='$selector' class='allGals gallery galleryid-{$id}'>");

    $i = 1;

    $no_image = array(3,9,16);
    foreach ( $attachments as $id => $attachment ) {
        if( in_array($i, $no_image)){            
            $output .= "<{$itemtag} class='gallery-item gridIt section-third middleHalf'></{$itemtag}>";
            $i++;
        }

        // La galeria
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, 'large', false, false) : wp_get_attachment_link($id, 'large', true, false);

        $output .= "<{$itemtag} class='gallery-item gridIt section-third middleHalf'>";
        $output .= "<{$icontag} class='gallery-icon colB center-all colB coloBlock$i'>$link</{$icontag}>";
        /*if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }*/

        $output .= "</{$itemtag}>";
        
        // if ( $columns > 0 && ++$i % $columns == 0 )
        //     $output .= '<br style="clear: both" />';
            
        $i++;

        if($i == 18)
            break;  
    }

    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}

?>