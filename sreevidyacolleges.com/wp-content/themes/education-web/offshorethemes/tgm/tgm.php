<?php
/**
 * Recommended plugins
 *
 * @package Education Web
 */

if ( ! function_exists( 'education_web_recommended_plugins' ) ) :

	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function education_web_recommended_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'Page Builder by SiteOrigin', 'education-web' ),
				'slug'     => 'siteorigin-panels',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'SiteOrigin Widgets Bundle', 'education-web' ),
				'slug'     => 'so-widgets-bundle',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'education-web' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'WooCommerce', 'education-web' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'education-web' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
		);

		tgmpa( $plugins );

	}

endif;

add_action( 'tgmpa_register', 'education_web_recommended_plugins' );
