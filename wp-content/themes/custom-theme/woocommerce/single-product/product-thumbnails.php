<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.5.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}




global $product;

$attachment_ids = $product->get_gallery_image_ids();




if ( $attachment_ids && $product->get_image_id() ) : ?>
    <div class="custom-slider">
        <button class="slider-nav prev" aria-label="Previous">&lt;</button>
        <div class="slider-wrapper f-full overflow-hidden">
            <div class="slider-track flex justify-center items-center  transition-transform duration-300 ease-in-out">
                <?php foreach ( $attachment_ids as $key => $attachment_id ) : ?>
                    <div class="slider-item mx-10 border border-gray-400">
                        <?php 
                        echo apply_filters( 
                            'woocommerce_single_product_image_thumbnail_html', 
                            wc_get_gallery_image_html( $attachment_id, false, $key ), 
                            $attachment_id 
                        ); 
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="slider-nav next" aria-label="Next">&gt;</button>
    </div>
<?php endif; ?>
