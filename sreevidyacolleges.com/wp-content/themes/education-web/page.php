<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_Web
 */

get_header(); ?>


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
			
			<div id="primary" class="col-md-8 col-sm-12 col-xs-12 content-area">
				<main id="main" class="site-main">
					
					<div class="services-main">
						<div class="services-content">
							<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content', 'page' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

							endwhile; // End of the loop.
							?>
						</div>
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
			
		</div>
	</div>
</section>

<?php get_footer();