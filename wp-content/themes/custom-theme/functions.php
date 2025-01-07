<?php
/**
 * custom theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package custom_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function custom_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on custom theme, use a find and replace
		* to change 'custom-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'custom-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'custom-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'custom_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'custom_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'custom_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'custom-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'custom-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// ----------------------------------- ############### -------------------------------
/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts() {
	wp_enqueue_style( 'custom-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	 wp_style_add_data( 'custom-theme-style', 'rtl', 'replace' );
	 wp_enqueue_style( 'tailwind-css',  get_template_directory_uri() . '/src/output.css', // Correct path to Tailwind output.
    array(), 
        _S_VERSION // Optional versioning to clear cache when you update the file.
    );

	wp_enqueue_style('bootstrap-icons','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
	wp_enqueue_script( 'custom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'custom-script', get_template_directory_uri() . 'js/script.js',  );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );





function custom_quantity_buttons_script() {
    wp_enqueue_script('custom-quantity-buttons', get_template_directory_uri() . '/js/quantity-buttons.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_quantity_buttons_script');











add_action( 'wp_footer', function() {
    if ( is_product() ) { // Load only on single product pages
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const slider = document.querySelector('.custom-slider');
                const track = slider.querySelector('.slider-track');
                const items = slider.querySelectorAll('.slider-item');
                const prevButton = slider.querySelector('.slider-nav.prev');
                const nextButton = slider.querySelector('.slider-nav.next');
                
                const slideWidth = items[0].offsetWidth;
                let currentIndex = 0;

                function updateSliderPosition() {
                    const offset = -(slideWidth * currentIndex);
                    track.style.transform = `translateX(${offset}px)`;
                }

                function showPrevSlide() {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateSliderPosition();
                    }
                }

                function showNextSlide() {
                    if (currentIndex < items.length - 4) { // Adjust 4 to the number of visible slides
                        currentIndex++;
                        updateSliderPosition();
                    }
                }

                prevButton.addEventListener('click', showPrevSlide);
                nextButton.addEventListener('click', showNextSlide);

                // Optional: Disable buttons when at the edges
                function updateNavButtons() {
                    prevButton.disabled = currentIndex === 0;
                    nextButton.disabled = currentIndex >= items.length - 4; // Adjust 4 to the number of visible slides
                }

                prevButton.addEventListener('click', updateNavButtons);
                nextButton.addEventListener('click', updateNavButtons);
                updateNavButtons();
            });
        </script>
        <?php
    }
});







add_action( 'wp_enqueue_scripts', function() {
    if ( is_product() ) {
        wp_add_inline_script( 'woocommerce', "
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('.variations_form');
                if (!form) return;

                // Initialize WooCommerce variation form
                jQuery(form).wc_variation_form();

                // Add event listeners to radio buttons
                const radios = document.querySelectorAll('.variation-radio-group input[type=\"radio\"]');
                radios.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const attributeName = this.name;
                        const value = this.value;

                        // Find the corresponding select dropdown
                        const select = form.querySelector('select[name=\"' + attributeName + '\"]');
                        if (select) {
                            select.value = value;
                            jQuery(select).trigger('change'); // Trigger change event
                        }

                        // Trigger WooCommerce update events
                        jQuery(form).trigger('woocommerce_variation_select_change');
                        jQuery(form).trigger('check_variations');
                    });
                });

                // Trigger initial variation check
                form.dispatchEvent(new Event('check_variations'));
            });
        ");
    }
});

