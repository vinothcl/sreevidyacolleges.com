<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Web
 */

?>

<?php if( get_theme_mod( 'education_web_cta_area_options', 1 ) == 1 ){ 

		$text = get_theme_mod('education_web_cta_area_text');
		$button = get_theme_mod('education_web_cta_button_text');
		$buttonurl = get_theme_mod('education_web_cta_button_url');
	?>
	<section class="call-to-action">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="call-to-main">
						<h2><?php echo wp_kses_post( $text ); ?></h2>
						<?php if( !empty($button) || !empty($buttonurl) ){ ?>
							<a href="<?php echo esc_url( $buttonurl ); ?>" class="btn"><i class="fa fa-send"></i><?php echo esc_attr( $button ); ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/ End Call-To-Action -->
<?php } ?>

	</div><!-- #content -->

	<?php

		do_action( 'education_web_footer_before');
		

			/**
			 * @see  education_web_footer_widget_area() - 10
			*/
			do_action( 'education_web_footer_widget', 10);

	    	/**
	    	 * Button Footer Area
	    	*/
	    	do_action( 'education_web_button_footer', 15);

	    
	    do_action( 'education_web_footer_after');
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
