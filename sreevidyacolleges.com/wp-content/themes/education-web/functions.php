<?php
/**
 * Education Web functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Education_Web
 */

if ( ! function_exists( 'education_web_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function education_web_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Education Web, use a find and replace
		 * to change 'education-web' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'education-web', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style.
		*/
		add_editor_style( array( 'assets/css/editor-style.css', education_web_fonts_url() ) );

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
		add_image_size('education-web-slider', 1320, 475, true);
		add_image_size('education-web-gallery', 450, 350, true);
		add_image_size('education-web-post', 800, 350, true);
		add_image_size('education-web-about', 560, 485, true);
		add_image_size('education-web-team', 400, 500, true);
		add_image_size('education-web-blog', 800, 500, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'education-web' ),
			'menu-2' => esc_html__( 'Footer Menu', 'education-web' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'education_web_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'education_web_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_web_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'education_web_content_width', 640 );
}
add_action( 'after_setup_theme', 'education_web_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_web_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'education-web' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<aside id="%1$s" class="widget single-sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Widget Area', 'education-web' ),
		'id'            => 'homewidget-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<aside id="%1$s" class="widget homewidget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area One', 'education-web' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<div id="%1$s" class="widget single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Two', 'education-web' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<div id="%1$s" class="widget single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Three', 'education-web' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<div id="%1$s" class="widget single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Four', 'education-web' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'education-web' ),
		'before_widget' => '<div id="%1$s" class="widget single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'education_web_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function education_web_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	$fonts_url = education_web_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'education-web-google-fonts', $fonts_url, array(), null );
	}

	/**
	 * Load Bootstrap CSS Library File
	*/
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap' . $min . '.css', '', '3.3.7' );
	
	/**
	 * Load Animate CSS Library File
	*/
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/library/animate/animate' . $min . '.css', '', '3.5.2' );

	/**
	 * Load Bx Slider CSS Library File
	*/
	wp_enqueue_style( 'jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/css/jquery.bxslider' . $min . '.css', '', '4.2.12' );

	/**
	 * Load Font Awesome CSS Library File
	*/
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	/**
	 * Pretty Photo CSS Library File
	*/
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/assets/library/prettyphoto/css/prettyPhoto.css' );

	/**
	 * Load Owl Carousel CSS Library File
	*/
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/library/OwlCarousel/assets/owl.carousel' . $min . '.css', '', '2.2.1' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/library/OwlCarousel/assets/owl.theme.default' . $min . '.css', '', '2.2.1' );

	/**
	 * Load Theme Main CSS Library File
	*/
	wp_enqueue_style( 'education-web-style', get_stylesheet_uri() );

	/**
	 * Load Animate CSS Library File
	*/
	wp_enqueue_style( 'education-web-responsive', get_template_directory_uri() . '/assets/css/responsive.css','1.0.0' );

	if ( has_header_image() ) {
		$custom_css = '#breadcrumbs{ background-image: url("' . esc_url( get_header_image() ) . '"); background-repeat: no-repeat; background-position: center center; background-size: cover; }';
		wp_add_inline_style( 'education-web-style', $custom_css );
	}
	
	$counterimg = get_theme_mod('education_web_counter_bg_image');
	$custom_css = '.counter{ background-image: url("' . esc_url( $counterimg ) . '"); }';
	wp_add_inline_style( 'education-web-style', $custom_css );

	
	/**
	 * Load HTML5 Library File
	*/
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv' . $min . '.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /**
     * Load Respond Library File
    */
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond' . $min . '.js', array('jquery'), '1.0.0', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /**
     * Load Bootstrap JavScript Library File
    */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '3.3.7', true );

    /**
     * Load Bx Slider JavScript Library File
    */
    wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/js/jquery.bxslider' . $min . '.js', array('jquery'), '4.2.12', true );
        
    /**
     * Load CounterUp JavScript Library File
    */
    wp_enqueue_script('jquery-counterup', get_template_directory_uri() . '/assets/library/counterup/jquery.counterup' . $min . '.js', array('jquery'), '1.0', true );

    /**
     * Load Waypoints JavScript Library File
    */
    wp_enqueue_script('jquery-waypoints', get_template_directory_uri() . '/assets/library/waypoints/jquery.waypoints' . $min . '.js', array('jquery'), '4.0.0', true );

    /**
     * Load Carousel JavaScript File 
    */
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/library/OwlCarousel/js/owl.carousel' . $min . '.js', array(), '2.2.1', true);

    /**
     * Load PrettyPhoto JavaScript File 
    */
    wp_enqueue_script('jquery-prettyPhoto', get_template_directory_uri() . '/assets/library/prettyphoto/js/jquery.prettyPhoto.js', array(), '3.1.6', true);

    /**
	 * Load Sticky Library File
	*/
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.js', '1.0.4', true );

	/**
     * Load Theia Sticky Sidebar Library File
    */
    wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/js/theia-sticky-sidebar' . $min . '.js', array('jquery'), '1.6.0', true );
	
	/**
	 * Load Default JavaScript Library File
	*/
	wp_enqueue_script( 'education-web-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $min . '.js', array(), '20151215', true );

	/**
	 * Load Custom Themes JavaScript Library File
	*/
	wp_enqueue_script( 'education-web-custom', get_template_directory_uri() . '/assets/js/educationweb-custom.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_web_scripts' );



/**
 * Admin Enqueue scripts and styles.
*/
if ( ! function_exists( 'education_web_admin_scripts' ) ) {
    function education_web_admin_scripts( $hook ) {

    	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && 'widgets.php' != $hook )

        return;

        wp_enqueue_script('education-web-admin-script', get_template_directory_uri() . '/assets/js/educationweb-admin.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );       
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css');    
        wp_enqueue_style( 'education-web-admin-style', get_template_directory_uri() . '/assets/css/educationweb-admin.css');    
    }
}
add_action('admin_enqueue_scripts', 'education_web_admin_scripts');


/**
 * Require init.
*/
require  trailingslashit( get_template_directory() ).'offshorethemes/init.php';
