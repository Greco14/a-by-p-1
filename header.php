<?php 
/**
 * header.php
 *
 * Header for A(by)P
 */
?>
<?php 
    // Get the favicon.
    $favicon = IMAGES . '/icons/favicon.ico';

    // Get the custom touch icon.
    $touch_icon = IMAGES . '/icons/apple-touch-icon-152x152-precomposed.png';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">    

    <meta name="keywords" content="Gallery, creative, exhibition, art, concepts, ideas, energy, interactive, futuristic, shapes">
    <meta name="robots" content="noindex, nofollow">
    <meta name="robots" content=" noarchive">
    <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5, minimum-scale= 0.5">
    <meta property="og:url" content="http://approvedbypablo.com">
    <meta property="og:title" content="Approved by Pablo.">
    <meta property="og:description" content="A(by)P is a new model for the gallery world that harnesses the energy of the ephemeral exhibition moment and that makes art and ideas accessible to all.">
    <meta property="og:image" content="http://approvedbypablo.com/img/share.png">
    <meta property="og:type" content="website">
    <meta itemprop="name" content="Approved by Pablo.">
    <meta itemprop="description" content="A(by)P is a new model for the gallery world that harnesses the energy of the ephemeral exhibition moment and that makes art and ideas accessible to all.">
    
    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="<?php echo $favicon; ?>">
    <?php /*<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $touch_icon; ?>">*/?>
    <meta itemprop="image" content="http://approvedbypablo.com/img/share.png">
    <?php wp_head(); ?>
</head>
<body <?php body_class( ); ?>>
    
    <?php /* HEADER */ ?>
    <div id="head" class="mainHold">
        <div class="safeArea center-h">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div class="logoTop bgi"></div></a>
        </div>
        <?php 
            wp_nav_menu(
                array(
                    'theme_location' => 'main-menu',
                    'menu_class'     => 'NavHold'
                )
            );
        ?>
    </div>
    <?php /* HEADER */ ?>