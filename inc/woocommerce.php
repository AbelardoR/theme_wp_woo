<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package online_mart
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function online_mart_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'online_mart_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function online_mart_woocommerce_scripts() {
	wp_enqueue_style( 'online_mart-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'online_mart-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'online_mart_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function online_mart_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'online_mart_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function online_mart_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'online_mart_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'online_mart_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function online_mart_woocommerce_wrapper_before() {
		?>
<div class="container-fluid" id="prod">
    <div class="row">
        <div class="col-12">
            <?php
	}
}

add_action( 'woocommerce_before_main_content', 'online_mart_woocommerce_wrapper_before' );

if ( ! function_exists( 'online_mart_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function online_mart_woocommerce_wrapper_after() {
		?>
        </div>
    </div>
</div><!-- #main -->
<?php
	}
}
add_action( 'woocommerce_after_main_content', 'online_mart_woocommerce_wrapper_after' );


/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'online_mart_woocommerce_header_cart' ) ) {
			online_mart_woocommerce_header_cart();
		}
	?>
*/

if ( ! function_exists( 'online_mart_woocommerce_cart_link_fragment' ) ) {
/**
* Cart Fragments.
*
* Ensure cart contents update when products are added to the cart via AJAX.
*
* @param array $fragments Fragments to refresh via AJAX.
* @return array Fragments to refresh via AJAX.
*/
function online_mart_woocommerce_cart_link_fragment( $fragments ) {
ob_start();
online_mart_woocommerce_cart_link();
$fragments['a.cart-contents'] = ob_get_clean();

return $fragments;
}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'online_mart_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'online_mart_woocommerce_cart_link' ) ) {
/**
* Cart Link.
*
* Displayed a link to the cart including the number of items present and the cart total.
*
* @return void
*/
function online_mart_woocommerce_cart_link() {
?>
<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>"
    title="<?php esc_attr_e( 'View your shopping cart', 'online_mart' ); ?>">
    <?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'online_mart' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
    <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span
        class="count"><?php echo esc_html( $item_count_text ); ?></span>
</a>
<?php
	}
}

if ( ! function_exists( 'online_mart_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function online_mart_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
<ul id="site-header-cart" class="site-header-cart">
    <li class="<?php echo esc_attr( $class ); ?>">
        <?php online_mart_woocommerce_cart_link(); ?>
    </li>
    <li>
        <?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
    </li>
</ul>
<?php
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );?>

<?php


function get_custom_post_type_template($single_template) {
	global $post;
  
	if ($post->post_type == 'product') {
		$single_template = dirname( __FILE__ ) . '/single-template.php';
	}
	return $single_template;
  }
  add_filter( 'single_template', 'get_custom_post_type_template' );
  
  add_filter( 'template_include', 'portfolio_page_template', 99 );
  function portfolio_page_template( $template ) {
	if ( is_page( 'slug' )  ) {
		$new_template = locate_template( array( 'single-template.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}
	return $template;
  }



  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
  add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
  
  
  function woocommerce_template_product_description() {
	woocommerce_get_template( 'single-product/tabs/description.php' );
  }
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );
  
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

  remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

  add_filter('product-type-simple_attributes','clase_item_product', 10,3);
  function clase_item_product ($atts, $item, $args){
	  $class = 'card';
	  $atts['class'] = $class;
	  return $atts;
  }


//form fileds

  add_filter (  'woocommerce_checkout_fields' , 'online_mart_fields_styling' , 1001 ) ;
 
  function online_mart_fields_styling (  $f  )  {
	## first_name
	$f ['billing']['billing_first_name'][ 'class' ] [ 0 ] = 'col-md-6';

	## last_name
	$f ['billing']['billing_last_name'][ 'class' ] [ 0 ] = 'col-md-6';

	## company
	$f ['billing']['billing_company'][ 'class' ] [ 0 ] = 'col-md-12';

	## address_1
	$f ['billing']['billing_address_1'][ 'class' ] [ 0 ] = 'col-md-12';
	$f ['billing']['billing_address_1'][ 'priority' ]  = 40;

	## address_2
	$f ['billing']['billing_address_2'][ 'class' ] [ 0 ] = 'col-md-12';
	$f ['billing']['billing_address_2'][ 'priority' ]  = 50;

	## country
	$f ['billing']['billing_country'][ 'class' ] [ 0 ] = 'col-md-6';
	$f ['billing']['billing_country'][ 'priority' ]  = 60;

	## city
	$f ['billing']['billing_city'][ 'class' ] [ 0 ] = 'col-md-6';

	## state
	$f ['billing']['billing_state'][ 'class' ] [ 0 ] = 'col-md-6';

	## postcode
	$f ['billing']['billing_postcode'][ 'class' ] [ 0 ] = 'col-md-6';

	## phone
	$f ['billing']['billing_phone'][ 'class' ] [ 0 ] = 'col-md-6 pt-4';

	## email
	$f ['billing']['billing_email'][ 'class' ] [ 0 ] = 'col-md-6';

	/*----------------------------------------------------------------*/
	## first_name
	$f ['shipping']['shipping_first_name'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';

	## last_name
	$f ['shipping']['shipping_last_name'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';

	## company
	$f ['shipping']['shipping_company'][ 'class' ] [ 0 ] = 'col-md-12';

	## address_1
	$f ['shipping']['shipping_address_1'][ 'class' ] [ 0 ] = 'col-md-12';
	$f ['shipping']['shipping_address_1'][ 'priority' ]  = 40;

	## address_2
	$f ['shipping']['shipping_address_2'][ 'class' ] [ 0 ] = 'col-md-12';
	$f ['shipping']['shipping_address_2'][ 'priority' ]  = 50;

	## country
	$f ['shipping']['shipping_country'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';
	$f ['shipping']['shipping_country'][ 'priority' ]  = 60;

	## city
	$f ['shipping']['shipping_city'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';

	## state
	$f ['shipping']['shipping_state'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';

	## postcode
	$f ['shipping']['shipping_postcode'][ 'class' ] [ 0 ] = 'col-md-6 col-sm-3';


	//order-coment
	$f ['order']['order_comments'][ 'class' ] [ 1 ] = 'col-md-12';

	return  $f ;
   
  }

  add_filter (  'woocommerce_default_address_fields' , 'online_mart_fields_account_styling' , 1500 );
  	function online_mart_fields_account_styling($f){
		$f ['first_name']['class'][0] = 'col-md-6';
		$f ['last_name']['class'][0] = 'col-md-6';
		$f ['company']['class']  = array ('col-md-10', 'col-sm-12') ;
		$f ['address_1']['class'] = array ('col-md-9', 'col-sm-12') ;
		$f ['address_1'][ 'priority' ]  = 40;
		$f ['address_2'][ 'class' ] [ 0 ] = 'col-md-12';
		$f ['address_2'][ 'priority' ]  = 50;
		$f ['country'][ 'class' ] [ 0 ] = 'col-md-3';
		$f ['country'][ 'priority' ]  = 60;
		$f ['city'][ 'class' ] [ 0 ] = 'col-md-6';
		$f ['state'][ 'class' ] [ 0 ] = 'col-md-6';
		$f ['postcode'][ 'class' ] [ 0 ] = 'col-md-6';

		return  $f ;
	  }


	  add_action("customize_register", "customizer_store_text");
	  sanitize_text($text);
	  function customizer_store_text($wp_customize){
		$wp_customize->add_panel("panel_store", array("priority" => 73, "theme_supports" => "","title" => __("Panel Store", "online_mart"), "description" => __("Set information.", "online_mart"), ));
        
        $wp_customize->add_section("store_text", array("title" => __("Change subtext on store", "online_mart"),	"panel"    => "panel_store","priority" => 20));

        $wp_customize->add_setting("storetext-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customstoretext-1", array( "label"    => __("Title subtex store", "online_mart"), "section"  => "store_text", "settings" => "storetext-1", "type"     => "textarea" )));
		$wp_customize->selective_refresh->add_partial("storetext-1", array("selector" => "#storetext-1",));
		
		$wp_customize->add_setting("classtext-1", array( "sanitize_callback" => "esc_attr", "default" => " "));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, "classtext-1", array( "label"    => __("Add classes", "online_mart"), "section"  => "store_text", "settings" => "classtext-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("classtext-1", array("selector" => "#classtext-1",));
	  }