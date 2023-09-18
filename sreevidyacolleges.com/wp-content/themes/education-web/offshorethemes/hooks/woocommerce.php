<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Education_Web
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function education_web_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'education_web_woocommerce_setup' );


/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function education_web_woocommerce_scripts() {
	wp_enqueue_style( 'education-web-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'education_web_woocommerce_scripts' );

/**
 * Load Education Web Woocommerce Action and Filter.
*/
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

/**
 * WooCommerce add content primary div function
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('education_web_woocommerce_output_content_wrapper')) {
    function education_web_woocommerce_output_content_wrapper(){ ?>
    	<section id="services" class="services single section">
			<div class="container">
				<div class="row">
					<div id="primary" class="col-md-8 col-sm-12 col-xs-12 content-area">
						<main id="main" class="site-main" role="main">
							<div class="services-main">
								<div class="services-content">
    <?php }
}
add_action( 'woocommerce_before_main_content', 'education_web_woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('education_web_woocommerce_output_content_wrapper_end')) {
    function education_web_woocommerce_output_content_wrapper_end(){ ?>
	                			</div>
	                		</div>
                		</main>
                	</div>

              		<?php get_sidebar('woocommerce'); ?>

                </div>
            </div>
        </section>
    <?php }
}
add_action( 'woocommerce_after_main_content', 'education_web_woocommerce_output_content_wrapper_end', 10 );
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/**
 * Woo Commerce Number of row filter Function
*/
add_filter('loop_shop_columns', 'education_web_loop_columns');
if (!function_exists('education_web_loop_columns')) {
    function education_web_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'education_web_woo_body_class');
if (!function_exists('education_web_woo_body_class')) {
    function education_web_woo_body_class( $class ) {
           $class[] = 'columns-'.intval(education_web_loop_columns());
           return $class;
    }
}

/**
 * WooCommerce display related product.
*/
if (!function_exists('education_web_related_products_args')) {
  function education_web_related_products_args( $args ) {
      $args['posts_per_page']   = 6;
      $args['columns']          = 3;
      return $args;
  }
}
add_filter( 'woocommerce_output_related_products_args', 'education_web_related_products_args' );

/**
 * WooCommerce display upsell product.
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
if ( ! function_exists( 'education_web_woocommerce_upsell_display' ) ) {
  function education_web_woocommerce_upsell_display() {
      woocommerce_upsell_display( 6, 3 ); 
  }
}
add_action( 'woocommerce_after_single_product_summary', 'education_web_woocommerce_upsell_display', 15 );
