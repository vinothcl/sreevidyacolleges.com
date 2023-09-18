<?php
/**
 * Info setup
 *
 * @package Education Web
 */

if ( ! function_exists( 'education_web_info_setup' ) ) :

	/**
	 * Info setup.
	 *
	 * @since 1.0.0
	 */
	function education_web_info_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'education-web' ), 'Education Web' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'education-web' ),
				'support'         => esc_html__( 'Support', 'education-web' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'education-web' ),
				'demo-content'    => esc_html__( 'Demo Content', 'education-web' ),
				'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'education-web' ),
			),

			// Quick links.
			'quick_links' => array(

				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'education-web' ),
					'url'  => 'https://offshorethemes.com/wordpress-themes/education-web/',
				),

				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'education-web' ),
					'url'  => 'https://offshorethemes.com/demo/educationweb/',
				),

				'documentation_url' => array(
					'text' => esc_html__( 'View Documentation', 'education-web' ),
					'url'  => 'https://offshorethemes.com/docs/educationweb/',
				),

				'rating_url' => array(
					'text' => esc_html__( 'Rate This Theme','education-web' ),
					'url'  => 'https://wordpress.org/support/theme/education-web/reviews/#new-post',
				),

				'upgrade_to_pro' => array(
					'text' => esc_html__( 'Buy Pro Themes','education-web' ),
					'url'  => 'https://offshorethemes.com/wordpress-themes/education-web-pro/',
				)

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'education-web' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'education-web' ),
					'button_text' => esc_html__( 'View Documentation', 'education-web' ),
					'button_url'  => 'https://offshorethemes.com/docs/educationweb/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'education-web' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'education-web' ),
					'button_text' => esc_html__( 'Static Front Page', 'education-web' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'education-web' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'education-web' ),
					'button_text' => esc_html__( 'Customize', 'education-web' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Page Builder', 'education-web' ),
					'icon'        => 'dashicons dashicons-admin-settings',
					'description' => esc_html__( 'Page Builder by SiteOrigin is integrated in the theme to achieve different layouts. Please make sure both Page Builder by SiteOrigin and SiteOrigin Widgets Bundle plugins are installed and activated.', 'education-web' ),
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'education-web' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'education-web' ), esc_html__( 'One Click Demo Import', 'education-web' ) ),
					'button_text' => esc_html__( 'Demo Content', 'education-web' ),
					'button_url'  => admin_url( 'themes.php?page=education-web-info&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'education-web' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'education-web' ),
					'button_text' => esc_html__( 'View Demo', 'education-web' ),
					'button_url'  => 'https://offshorethemes.com/demo/educationweb/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'education-web' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'education-web' ),
					'button_text' => esc_html__( 'Contact Support', 'education-web' ),
					'button_url'  => 'https://offshorethemes.com/forum/wordpress-themes/education-web/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'education-web' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'education-web' ),
					'button_text' => esc_html__( 'View Documentation', 'education-web' ),
					'button_url'  => 'https://offshorethemes.com/docs/educationweb/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'education-web' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'education-web' ),
					'button_text' => esc_html__( 'Learn More', 'education-web' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'education-web' ),
				),

			// Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'education-web' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'education-web' ) . '</a>' ),
				),

			// Upgrade content.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'education-web' ),
				'button_text' => esc_html__( 'Buy Pro Themes', 'education-web' ),
				'button_url'  => 'https://offshorethemes.com/wordpress-themes/education-web-pro/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Education_Web_Info::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'education_web_info_setup' );
