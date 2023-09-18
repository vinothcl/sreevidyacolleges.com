<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_Web
 */
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'education-web-post', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-lists">
	    <div class="blog-items">
	        <?php if ( has_post_thumbnail() ) : ?>
	           <!-- <div class="blog-image">
		            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		                <img src="<?php echo esc_url( $image[0] ); ?>" title="<?php the_title(); ?>" alt="<?php the_title_attribute(); ?>">
		            </a>
		        </div>-->
	        <?php endif; ?>

	        <div class="blog-exercpt">

	        	<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
	            
	            <?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php education_web_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
	        </div>
	    </div>

	    <div class="entry-content">
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'education-web' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-web' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
