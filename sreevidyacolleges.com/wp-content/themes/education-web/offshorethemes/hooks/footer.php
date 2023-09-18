<?php
/**
 * Footer Area Before
*/
if ( ! function_exists( 'education_web_footer_before' ) ) {
	function education_web_footer_before(){ ?>
		<footer id="footer" class="footer dark site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	}
}
add_action( 'education_web_footer_before', 'education_web_footer_before', 5 );

/**
 * Footer Area Goto Top
*/
if ( ! function_exists( 'education_web_footer_gototop' ) ) {
	function education_web_footer_gototop(){ ?>
		<a class="goToTop" href="#" id="scrollTop">
			<i class="fa fa-angle-up"></i>
			<span><?php esc_html_e('Top','education-web'); ?></span>
		</a>
	<?php
	}
}
add_action( 'education_web_footer_before', 'education_web_footer_gototop', 6 );

/**
 * Education Web Footer Widget Area
*/
if ( ! function_exists( 'education_web_footer_widget_area' ) ) {
	function education_web_footer_widget_area(){ 
		
		$top_footer_options = esc_attr( get_theme_mod( 'education_web_footer_area_two_enable_disable_section','enable' ) );
		
		if(!empty( $top_footer_options ) && $top_footer_options =='enable' ) { ?>


			<div class="footer-top">
				<div class="container">
					<div class="row">
						<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
							<div class="col-md-3 col-sm-6 col-xs-12">					
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
							<div class="col-md-3 col-sm-6 col-xs-12">					
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
							<div class="col-md-3 col-sm-6 col-xs-12">					
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
							<div class="col-md-3 col-sm-6 col-xs-12">					
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

	    <?php 
		}
	}
}
add_action( 'education_web_footer_widget', 'education_web_footer_widget_area', 10 );

/**
 * Top Footer Area
*/
if ( ! function_exists( 'education_web_button_footer_before' ) ) {
	function education_web_button_footer_before(){ 
		$footer_button_bg = esc_attr( get_theme_mod( 'education_web_footer_buttom_area_background_color','#333333' ) );
		?>
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="copyright">
								<p><?php do_action( 'education_web_copyright', 5 ); ?></p>
							</div><!--/ End Copyright -->
						</div>

						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="footermenu">
								<?php 
                                    wp_nav_menu( array(
                                        'theme_location'    => 'menu-2',
                                        'menu'              => 'footer'
                                    ));
                                ?>
							</div><!--/ End Copyright -->
						</div>
					</div>
				</div>
			</div>
		<?php
	}
}
add_action( 'education_web_button_footer', 'education_web_button_footer_before', 15 );

/**
 * Footer Area After
*/
if ( ! function_exists( 'education_web_footer_after' ) ) {
	function education_web_footer_after(){ ?>
		</footer>
	<?php
	}
}
add_action( 'education_web_footer_after', 'education_web_footer_after', 25 );