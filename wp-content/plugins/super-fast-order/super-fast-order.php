<?php
/*
 * Plugin Name:       Super Fast Order
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       super-fast-order
 * Domain Path:       /languages
 
 */




function wpdocs_theme_name_scripts()
{
    wp_enqueue_style('plugin-style', plugin_dir_url(__FILE__) . '/style.css');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');


    wp_enqueue_script('plugin-script', plugin_dir_url(__FILE__) . '/script.js');
    // wp_enqueue_script('script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');










add_action('woocommerce_after_single_product_summary', 'fast_order_form', 5);

function fast_order_form()
{
    // Only display on single product pages
    if (is_product()) {
        global $product;

        // Get available payment gateways
        $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
?>
        <div id="fast-order-form" style="margin-top: 20px; padding: 15px; border: 1px solid #ddd;">
            <h3 class="form__title">Fast Order Form</h3>
            <form action="" method="post" id="fast-order">
                <div class="form-group">
                    <label> <?php _e('Name', 'super-fast-order') ?> </label>
                    <input type="text" id="customer_name" class="input-control" name="customer_name" required placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label><?php _e('Phone', 'super-fast-order') ?></label>
                    <input type="text" class="input-control" name="phone_number" required placeholder="Enter your phone number">
                </div>



                <div class="quantity-section">
                    <label><?php _e('Quantity', 'super-fast-order') ?></label>
                    <div class="quantity-container">
                        <button type="button" id="inc_btn">
                            <i class="bi bi-plus"></i>
                        </button>
                        <input type="text" id="quantity" name="quantity" required min="1" value="1" readonly />
                        <button type="button" id="dec_btn">
                            <i class="bi bi-dash"></i>
                        </button>
                    </div>
                </div>






                <div>
                    <label for="payment_method"><?php _e('Payment Options', 'super-fast-order') ?></label>



                    <div id="payment_methods" class="input-control">
                        <?php foreach ($available_gateways as $gateway) : ?>
                            <label>
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="<?php echo esc_attr($gateway->id); ?>"
                                    required />
                                <?php echo esc_html($gateway->get_title()); ?>
                            </label>
                            <br />
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit" name="submit_fast_order" class="primary-buttton">
                        Send Order
                    </button>
                </div>
            </form>
        </div>
<?php
    }
}

add_action('wp', 'handle_fast_order_form_submission');
function handle_fast_order_form_submission()
{
    if (isset($_POST['submit_fast_order'])) {
        global $product;

        // Sanitize input fields
        $customer_name = sanitize_text_field($_POST['customer_name']);
        $phone_number = sanitize_text_field($_POST['phone_number']);
        $quantity = intval($_POST['quantity']);
        $payment_method = sanitize_text_field($_POST['payment_method']);

        // Create a new WooCommerce order
        $order = wc_create_order();

        // Add the current product to the order
        $product_id = get_the_ID();
        $order->add_product(wc_get_product($product_id), $quantity);

        // Set billing details
        $order->set_billing_first_name($customer_name);
        $order->set_billing_phone($phone_number);

        // Set payment method
        $order->set_payment_method($payment_method);

        // Calculate totals and save the order
        $order->calculate_totals();
        $order->save();

        // Add a success message
        wc_add_notice('Thank you for your order! Your order has been placed successfully.', 'success');

        // Redirect to the "Thank You" page
        wp_redirect($order->get_checkout_order_received_url());
        exit;
    }
}
