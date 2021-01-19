<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package online_mart
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e( 'Skip to content', 'online_mart' ); ?></a>

        <header id="masthead" class="site-header navbar-dark bg-dark">
            <div class="container-fluid" id="barnav">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark row">

                    <div class="col-md-4">
                        <div class="site-branding">
                            <?php if (has_custom_logo()) {
							the_custom_logo();
						} else {
							if (is_front_page() && is_home()) : ?>
                            <h3 class="site-title"><a id="homelink" href="<?php echo esc_url(home_url('/')); ?>"
                                    rel="home"><?php bloginfo('name'); ?></a></h3>
                            <?php else : ?>
                            <h5 class="site-title"><a id="homelink" href="<?php echo esc_url(home_url('/')); ?>"
                                    rel="home"><?php bloginfo('name'); ?></a></h5>
                            <?php endif;
							$fnd_description = get_bloginfo('description', 'display');
							if ($fnd_description || is_customize_preview()) : ?>
                            <p class="site-description"><?php echo $fnd_description; /* WPCS: xss ok. */ ?></p>
                            <?php endif;
						} ?>
                        </div><!-- .site-branding -->
                    </div>
                    <div class="col-md-8">
					<div class="d-flex justify-content-end">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					</div>
					<?php wp_nav_menu(array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container' 	  => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id'	  => 'navbarSupportedContent',
						'items_wrap' => '<ul class="navbar-nav mr-auto">%3$s</ul>',
						'menu_class' => 'nav-item'
					)); ?>
					</div>

                </nav><!-- navbar -->
            </div><!-- .container-fluid -->

        </header><!-- #masthead -->