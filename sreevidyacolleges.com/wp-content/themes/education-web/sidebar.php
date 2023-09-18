<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Web
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="col-md-4 col-sm-12 col-xs-12 widget-area">

		<div class="services-sidebar">

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

		</div>

</aside><!-- #secondary -->
