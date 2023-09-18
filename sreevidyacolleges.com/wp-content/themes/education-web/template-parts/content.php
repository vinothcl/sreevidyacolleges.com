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
	            <div class="blog-image">
		            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		                <img src="<?php echo esc_url( $image[0] ); ?>" title="<?php the_title(); ?>" alt="<?php the_title_attribute(); ?>">
		            </a>
		        </div>
	        <?php endif; ?>

	        <div class="blog-exercpt">

	        	<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
	            
	            <?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php education_web_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php the_excerpt(); ?>
	            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Continue Reading','education-web'); ?></a>
	        </div>
	        
	    </div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
