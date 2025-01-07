<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>


<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. 
																																																																						?>">
	<?php do_action('woocommerce_before_variations_form'); ?>

	<?php if (empty($available_variations) && false !== $available_variations) : ?>
		<p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
	<?php else : ?>
		<!-- <table class="variations" role="presentation">
			<tbody>
				<?php foreach ($attributes as $attribute_name => $options) : ?>
					<tr>
						<th class="label"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); ?></label></th>
						<td class="value">
							<div class="variation-radio-group flex items-center justify-between">
								<?php foreach ($options as $option) : ?>
									<label class="bg-gray-200 p-2 rounded-sm m-2 block">
										<input type="radio" name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>" value="<?php echo esc_attr($option); ?>">
										<?php echo esc_html($option); ?>
									</label>
								<?php endforeach; ?>
							</div>
							<select name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>" style="display:none;">
								<option value=""><?php echo esc_html(__('Choose an option', 'woocommerce')); ?></option>
								<?php foreach ($options as $option) : ?>
									<option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
				<?php endforeach; ?>

				<tr>
					<td colspan="2">
						<?php
						echo wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<button class="reset_variations" aria-label="' . esc_attr__('Clear options', 'woocommerce') . '">' . esc_html__('Clear', 'woocommerce') . '</button>'));
						?>
					</td>
				</tr>
			</tbody>
		</table> -->









		<table class="variations" role="presentation">
			<div>
				<?php foreach ($attributes as $attribute_name => $options) : ?>
					<div>
						<div class="label attribute-name"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); ?></label></div>


						<td class="value">
							<div class="variation-radio-group flex items-center justify-between">
								<?php foreach ($options as $option) : ?>

									<?php
									// Generate a unique ID for each input
									$input_id = esc_attr(sanitize_title($attribute_name . '_' . $option));
									?>

									<input 
									   id="<?php echo $input_id; ?>" 
									   type="radio" 
									   class="radio-option"
									   name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>" value="<?php echo esc_attr($option); ?>">


									<label class="label-option" for="<?php echo $input_id; ?>">
										<?php echo esc_html($option); ?>
									</label>
								<?php endforeach; ?>
							</div>



							<select name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>" style="display:none;">
								<option value=""><?php echo esc_html(__('Choose an option', 'woocommerce')); ?></option>
								<?php foreach ($options as $option) : ?>
									<option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</div>
				<?php endforeach; ?>

				<tr>
					<td colspan="2">
						<?php
						echo wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<button class="reset_variations" aria-label="' . esc_attr__('Clear options', 'woocommerce') . '">' . esc_html__('Clear', 'woocommerce') . '</button>'));
						?>
					</td>
				</tr>
			</div>
		</table>







		<?php do_action('woocommerce_after_variations_table'); ?>

		<div class="single_variation_wrap">
			<?php
			do_action('woocommerce_before_single_variation');
			do_action('woocommerce_single_variation');
			do_action('woocommerce_after_single_variation');
			?>
		</div>
	<?php endif; ?>

	<?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php
do_action('woocommerce_after_add_to_cart_form');
?>