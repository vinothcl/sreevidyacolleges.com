<?php
/**
 * Main Custom admin functions area
 *
 * @since OffshoreThemes
 *
 * @param Education Web
 *
 */

/**
 * Load Custom Admin functions that act independently of the theme functions.
 */
require get_theme_file_path('offshorethemes/functions.php');

/**
 * Implement the Custom Header feature.
*/
require get_theme_file_path('offshorethemes/core/custom-header.php');


/**
 * Custom template tags for this theme.
 */
require get_theme_file_path('offshorethemes/core/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
 */
require get_theme_file_path('offshorethemes/core/template-functions.php');

/**
 * Customizer additions.
 */
require get_theme_file_path('offshorethemes/customizer/customizer.php');


/**
 * Customizer additions.
 */
require get_theme_file_path('offshorethemes/wp-bootstrap-navwalker.php');


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {

	require get_theme_file_path('offshorethemes/core/jetpack.php');
    
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

	require get_theme_file_path('offshorethemes/hooks/woocommerce.php');

}

/**
 * Load header hooks file.
 */
require get_theme_file_path('offshorethemes/hooks/header.php');

/**
 * Load footer hooks file.
 */
require get_theme_file_path('offshorethemes/hooks/footer.php');

/**
 * Load section hooks file.
 */
require get_theme_file_path('section/sectionarea.php');

/**
 * Features Widget Load File.
*/
require get_theme_file_path('offshorethemes/hooks/siteorigin-panels.php');

require get_theme_file_path('offshorethemes/widgets/aboutus.php');

require get_theme_file_path('offshorethemes/widgets/featureservice.php');

require get_theme_file_path('offshorethemes/widgets/academics.php');

require get_theme_file_path('offshorethemes/widgets/mainservices.php');

require get_theme_file_path('offshorethemes/widgets/whychoose.php');

require get_theme_file_path('offshorethemes/widgets/faq.php');

require get_theme_file_path('offshorethemes/widgets/team.php');

require get_theme_file_path('offshorethemes/widgets/testimonial.php');

require get_theme_file_path('offshorethemes/widgets/clientslogo.php');

require get_theme_file_path('offshorethemes/widgets/blogs.php');

require get_theme_file_path('offshorethemes/widgets/courses.php');

/**
 * Load Page Icon Metabox File
*/
require get_theme_file_path('offshorethemes/metabox/meta-icons.php');


/**
 * Load Admin info.
 */
if ( is_admin() ) {

	require get_theme_file_path('offshorethemes/admin/about-theme/class.info.php');
	require get_theme_file_path('offshorethemes/admin/about-theme/info.php');
	
}

/**
 * Load TMG libraries.
 */
require get_theme_file_path('offshorethemes/tgm/tgm.php');
require get_theme_file_path('offshorethemes/tgm/class-tgm-plugin-activation.php');

/**
 * Load OCDI libraries.
 */
require get_theme_file_path('offshorethemes/ocdi/ocdi.php');

/**
 * Load in customizer upgrade to pro
*/
require get_theme_file_path('offshorethemes/customizer/customizer-pro/class-customize.php');
