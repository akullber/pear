<?php
/**
 * The header for our theme
 *
 * @package Pear
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content">Skip to content</a>  
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__title" rel="home" itemprop="headline">
                <img class="site-header__logo" width="131" height="35" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
            </a>
        </div>
    </header>
</body>
</html>
