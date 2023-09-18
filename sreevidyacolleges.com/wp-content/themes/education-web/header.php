<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Web
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="page" class="site">

	<?php
		/**
		 * @see  educationweb_skip_links() - 5
		*/	
		do_action( 'educationweb_header_before' ); 
	
		/**
		 * @see  education_web_top_header() - 15
		 * @see  education_web_main_header() - 20
		*/
		do_action( 'educationweb_header' ); 
	
	 	do_action( 'educationweb_header_after' ); 
	?>
	

	<div id="content" class="site-content">
		