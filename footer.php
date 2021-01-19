<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package online_mart
 */

?>
<div class="container-fluid" id="info">
    <div class="container wow animate__fadeInRight">
        <div class="row py-2">
            <div class="col-md-3" id="title&&description">
                <div class="card-body">
                    <h3 class="site-title card-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
                        </a>
                    </h3>
                    <?php $description = get_bloginfo( 'description', 'display' );
          					if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description card-text"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php endif; ?>
                </div>
            </div><!-- col-md-3 -->
            <div class="col-md-3">
                <div class="card-body">
                    <a id="footLinkTitle" href="<?php if( esc_attr(get_theme_mod( "footLinkTitle") != "" )) {echo esc_attr(get_theme_mod( "footLinkTitle"));} else {echo "#";} ?>">
                        <h5 id="foot-1">
                            <?php if( esc_attr(get_theme_mod( "foot-1") != "" )) {echo esc_attr(get_theme_mod( "foot-1"));} else {echo "Contact us";} ?>
                        </h5>
                    </a>
                    <a id="footLink"
                        href="<?php if( esc_attr(get_theme_mod( "footLink") != "" )) {echo esc_attr(get_theme_mod( "footLink"));} else {echo "#";} ?>">
                        <span id="foot-2">
                            <?php if( esc_attr(get_theme_mod( "foot-2") != "" )) {echo esc_attr(get_theme_mod( "foot-2"));} else {echo "Where find us";} ?>
                        </span>
                    </a>
                    <p id="foot-3">
                        <?php if( esc_attr(get_theme_mod( "foot-3") != "" )) {echo esc_attr(get_theme_mod( "foot-3"));} else {echo "Where call us";} ?>
                    </p>
                </div>
            </div>

            <?php if ( is_active_sidebar( 'menu-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'menu-sidebar' ); ?>
            <?php else : ?>
            <!-- Time to add some widgets! -->
            <?php endif; ?>

            <div class="col-md-3">
                <?php if ( is_active_sidebar( 'Content Sidebar' ) ) : ?>
                <?php dynamic_sidebar( 'Content Sidebar' ); ?>
                <?php else : ?>
                <!-- Time to add some widgets! -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><!-- Info -->
<div class="container text-center p-3">
    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'online_mart' ) ); ?>">
                <?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'online_mart' ), 'WordPress' );
				?>
            </a>
            <span class="sep"> | </span>
            <?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'online_mart' ), 'online_mart', '<a href="https://github.com/AbelardoR">j26a90</a>' );
				?>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
wow = new WOW({
    boxClass: 'wow', // default
    animateClass: 'animate__animated', // default
    offset: 0, // default
    mobile: true, // default
    live: true // default
})
wow.init();
</script>

</body>

</html>