<?php
/**
 * Template Name: Educationweb - Builder Page
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Education_Web
 */
get_header();  ?>

<?php
	/**
	 * Breadcrumb 
	 *
     * @since 1.0.0
    */
	do_action( 'education_web_add_breadcrumb', 10 );
?>

<section id="services" class="services single section">
	<div class="container">
		<div class="row">
			<?php

				while ( have_posts() ) : the_post();

				    the_content();

				endwhile; // End of the loop.
			?>
		</div>
	</div>
</section>

<?php get_footer();