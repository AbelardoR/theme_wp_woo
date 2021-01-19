<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle">
    <?php wc_print_notice( 
		apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon ?  ', 'online_mart' ) 
		. '<a data-toggle="collapse" href="#coupons" role="button" aria-expanded="false" aria-controls="coupons">' 
		. esc_html__( 'Click here to enter your code', 'online_mart' ) 
		. '</a>' ), 'notice' ); ?>
</div>
<div class="collapse mb-4" id="coupons">
    <div class="card card-body border-secondary text-secondary bg-transparent">
        <form class="checkout_coupon woocommerce-form-coupon" method="post">

            <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'online_mart' ); ?></p>

            <p class="form-row form-row-first">
                <input type="text" name="coupon_code" class="input-text"
                    placeholder="<?php esc_attr_e( 'Coupon code', 'online_mart' ); ?>" id="coupon_code" value="" />
            </p>

            <p class="form-row form-row-last">
                <button type="submit" class="button btn btn-info " name="apply_coupon"
                    value="<?php esc_attr_e( 'Apply coupon', 'online_mart' ); ?>"><?php esc_html_e( 'Apply coupon', 'online_mart' ); ?></button>
            </p>

            <div class="clear"></div>
        </form>
    </div>
</div>