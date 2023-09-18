<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
								if ( have_posts() ) : ?>

									
									<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

									<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format() );

									endwhile;

									the_posts_pagination( 
		                                array(
		                                    'prev_text' => esc_html__( 'Prev', 'education-web' ),
		                                    'next_text' => esc_html__( 'Next', 'education-web' ),
		                                )
		                            );

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif; 
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