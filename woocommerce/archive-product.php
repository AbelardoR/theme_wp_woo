<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<div class="container-fluid size-1 p-5 text-center"
    style="background-image: url(<?php echo header_image(); ?>); background-repeat: no-repeat; background-size: cover;">
    <header class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="woocommerce-products-header__title page-title display-4 text-bold"><?php woocommerce_page_title(); ?>
        </h1>
        <?php endif; ?>

        <?php
			/**
			 * Hook: woocommerce_archive_description.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>
    </header>
    <p id="classtext-1" class="<?php if( esc_attr(get_theme_mod( "classtext-1") != "" )) {echo esc_attr(get_theme_mod( "classtext-1"));} else {echo "lead mb-4";} ?>">
        <span id="storetext-1">
            <?php if( esc_attr(get_theme_mod( "storetext-1") != "" )) {echo esc_attr(get_theme_mod( "storetext-1"));} else {echo "insert instructions or logotip";} ?>
        </span>
    </p>
</div>
<nav class="navbar nav justify-content-center bg-transparent mb-2 mt-2">
    <ul class="nav my-0">
        <li class="nav-item">
            <p class="nav-link active">
                <?php woocommerce_output_all_notices(); ?>
            </p>
        </li>
        <li class="nav-item">
            <p class="nav-link">
                <?php woocommerce_result_count(); ?>
            </p>
        </li>
        <li class="nav-item mr-2">
            <p class="nav-link">
                <?php woocommerce_catalog_ordering(); ?>
            </p>
        </li>
        <li class="nav-item">
            <p class="nav-link">
                <?php get_product_search_form(); ?>
            </p>
        </li>
    </ul>
    <!-- <div class="row container-fluid">
		<div class="col-6 d-flex pt-4">
			</div>
		<div class="col-2"></div>
		<div class="col-4">
			</div>
			
    </div> -->
</nav>


<div class="container">
    <?php
if ( woocommerce_product_loop() ) {

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>
</div>
<?php 
get_footer( 'shop' );