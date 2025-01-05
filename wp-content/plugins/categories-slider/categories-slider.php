<?php 


/*
 * Plugin Name:       Categories Slider
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
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages

 */


 function add_theme_scripts() {
	wp_enqueue_style( 'carsoul-style', plugin_dir_url(__FILE__) . 'admin/css/owl.carousel.min.css'  );
	wp_enqueue_style( 'carsoul-style-default', plugin_dir_url(__FILE__) . 'admin/css/owl.theme.default.min.css'  );
	wp_enqueue_style( 'custom-styles', plugin_dir_url(__FILE__) . 'admin/css/styles.css'  );


	
	wp_enqueue_script( 'carsoul-script', plugin_dir_url(__FILE__) . 'admin/js/owl.carousel.min.js', array( 'jquery' ), 1.1, true );
	wp_enqueue_script( 'custom-script', plugin_dir_url(__FILE__) . 'admin/js/script.js', array( 'jquery' ), 1.1, true );

	
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );













function categories_slider_shortcode() {
    // Get WooCommerce categories
    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
    );
    $categories = get_terms( $args );

    if ( empty( $categories ) || is_wp_error( $categories ) ) {
        return '<p>No categories found.</p>';
    }

    // Build the HTML for Owl Carousel
    ob_start(); // Start output buffering
    ?>
    <div class="owl-carousel categories-slider">
        <?php foreach ( $categories as $category ) : ?>
            <?php
            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : wc_placeholder_img_src();
            ?>
            <div class="category-item">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>"> 
					<div class="cat-img-container">
					  <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" />
					</div>
                    <h4 class="cat-title"><?php echo esc_html( $category->name ); ?></h4>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('.categories-slider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
				autoplay:true,
                responsive: {
                    0: {
                        items: 3
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>
    <?php
    return ob_get_clean(); // Return the buffered content
}
add_shortcode( 'categories_slider', 'categories_slider_shortcode' );






function register_categories_slider_widget( $widgets_manager ) {

    class Categories_Slider_Widget extends \Elementor\Widget_Base {

        public function get_name() {
            return 'categories_slider_widget';
        }

        public function get_title() {
            return __( 'Categories Slider', 'my-basics-plugin' );
        }

        public function get_icon() {
            return 'eicon-carousel'; // Elementor's carousel icon
        }

        public function get_categories() {
            return [ 'general' ];
        }

        public function render() {
            echo do_shortcode( '[categories_slider]' ); // Render the shortcode
        }
    }

    $widgets_manager->register( new \Categories_Slider_Widget() );
}

add_action( 'elementor/widgets/register', 'register_categories_slider_widget' );