<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns row" id="customer_login">

    <div class="u-column1 col">

        <?php endif; ?>
        <div class="card mr-auto ml-auto mb-3">
            <div class="card-header">
                <h2><?php esc_html_e( 'Login', 'online_mart' ); ?></h2>
            </div>
            <div class="card-body">
                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide">
                        <label
                            for="username"><?php esc_html_e( 'Username or email address', 'online_mart' ); ?>&nbsp;<span
                                class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text form-control"
                            name="username" id="username" autocomplete="username"
                            value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </div>
                    <div class="woocommerce-form-row woocommerce-form-row--wide">
                        <label for="password"><?php esc_html_e( 'Password', 'online_mart' ); ?>&nbsp;<span
                                class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text form-control" type="password"
                            name="password" id="password" autocomplete="current-password" />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="form-row pt-3 mt-2">
                        <div class="col-md-6">
                            <label
                                class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                    name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                <span><?php esc_html_e( 'Remember me', 'online_mart' ); ?></span>
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                            <button type="submit" class="woocommerce-button btn btn-blue woocommerce-form-login__submit"
                                name="login"
                                value="<?php esc_attr_e( 'Log in', 'online_mart' ); ?>"><?php esc_html_e( 'Log in', 'online_mart' ); ?></button>
                        </div>
                    </div>
                    <div class="woocommerce-LostPassword lost_password text-center mt-3">
                        <a class="p-3"
                            href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'online_mart' ); ?></a>
                    </div>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>
            </div>
        </div>

        <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    </div>

    <div class="u-column2 col">
        <div class="card mr-auto ml-auto mb-3">
            <div class="card-header">
                <h2><?php esc_html_e( 'Register', 'online_mart' ); ?></h2>
            </div>
            <div class="card-body">
                <form method="post" class="woocommerce-form woocommerce-form-register register"
                    <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide">
                        <label for="reg_username"><?php esc_html_e( 'Username', 'online_mart' ); ?>&nbsp;<span
                                class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text form-control"
                            name="username" id="reg_username" autocomplete="username"
                            value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </div>

                    <?php endif; ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide">
                        <label for="reg_email"><?php esc_html_e( 'Email address', 'online_mart' ); ?>&nbsp;<span
                                class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text form-control" name="email"
                            id="reg_email" autocomplete="email"
                            value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </div>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide">
                        <label for="reg_password"><?php esc_html_e( 'Password', 'online_mart' ); ?>&nbsp;<span
                                class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text form-control"
                            name="password" id="reg_password" autocomplete="new-password" />
                    </div>

                    <?php else : ?>

                    <div><?php esc_html_e( 'A password will be sent to your email address.', 'online_mart' ); ?></div>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>

                    <div class="woocommerce-form-row text-right">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        <button type="submit"
                            class="woocommerce-Button woocommerce-button btn btn-green woocommerce-form-register__submit"
                            name="register"
                            value="<?php esc_attr_e( 'Register', 'online_mart' ); ?>"><?php esc_html_e( 'Register', 'online_mart' ); ?></button>
                    </div>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>

                </form>
            </div>
        </div>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>