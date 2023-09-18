<?php
/**
 * Header Section Skip Area
*/
if ( ! function_exists( 'education_web_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function education_web_skip_links() { ?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-web' ); ?></a>			
		<?php
	}
}
add_action( 'educationweb_skip_links', 'education_web_skip_links', 5 );


if ( ! function_exists( 'education_web_header_before' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function education_web_header_before() { ?>
		<header id="masthead" class="site-header header">
		<?php
	}
}
add_action( 'educationweb_header_before', 'education_web_header_before', 10 );


if ( ! function_exists( 'education_web_top_header' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function education_web_top_header() { ?>
		<?php if( get_theme_mod('education_web_top_header', 0 ) == 1 ){ ?>
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="topbar-inner">
								<div class="row">
									<div class="col-md-9 col-sm-8 col-xs-12">
					    				<ul class="contact">
					    					<?php
					    						$email_address    = get_theme_mod('education_web_email_address');
					    						$phone_number     = get_theme_mod('education_web_phone_number');
					    						$phonenumber      = preg_replace("/[^0-9]/","",$phone_number);
					    						$map_address      = get_theme_mod('education_web_map_address');
					    						$open_time   = get_theme_mod('education_web_opeening_time');
					    					
					    					if(!empty( $email_address )) { ?>        							
					    	                    <li>
					    	                    	<a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
					    	                    		<i class="fa fa-envelope"></i>
					    	                    		<?php echo esc_attr( antispambot( $email_address ) ); ?>
					    	                    	</a>
					    	                    </li>
					                        <?php }  ?>
					                        
					                        <?php if(!empty( $phone_number )) { ?>        							
					    	                    <li>				    	                    	
					    	                    	<a href="tel:<?php echo esc_attr( $phonenumber ); ?>">
					    	                    		<i class="fa fa-phone"></i>
					    	                    		<?php echo esc_attr( $phone_number ); ?>
					    	                    	</a>
					    	                    </li>
					                        <?php }  ?>
					                        
					                        <?php if(!empty( $map_address )) { ?>        							
					    	                    <li>        	                    	
						                    		<i class="fa fa-map"></i>
						                    		<?php echo esc_attr( $map_address ); ?>
					    	                    </li>
					                        <?php }  ?>
					                        
					                        <?php if(!empty( $open_time )) { ?>        							
					    	                    <li>
					    	                    	<i class="fa fa-clock-o"></i>
					    	                    	<?php echo esc_attr( $open_time ); ?>
					    	                    </li>
					                        <?php }  ?>        	                    
					    				</ul><!--/ End Contact -->
									</div>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<?php do_action( 'educationweb-sociallinks', 5 ); ?><!--/ End Social -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } 
	}
}
add_action( 'educationweb_header', 'education_web_top_header', 15 );

if ( ! function_exists( 'education_web_main_header' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function education_web_main_header() { ?>
		<div class="header-inner">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="logo site-branding">
							<?php
								if ( function_exists( 'the_custom_logo' ) ) {
									the_custom_logo();
								}
							?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<?php
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : 
							?>
								<p class="site-description"><?php echo $description; ?></p>
							<?php endif; ?>
						</div><!-- .site-branding & End Logo -->
					</div>
					<div class="col-md-9 col-sm-8 col-xs-6 edu-right-align">
						<div class="mobile-nav">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<div class="nav-area">
							<nav class="mainmenu">
								<?php
				                    wp_nav_menu( array(
				                        'menu'              => 'primary',
				                        'theme_location'    => 'menu-1',
				                        'container'         => 'div',
				                        'container_class'   => '',
				                        'menu_class'        => 'nav navbar-nav',
				                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                        'walker'            => new WP_Bootstrap_Navwalker())
				                    );
				                ?>
							</nav><!--/ End Main Menu -->
						</div>
						
						<div class="search">
							<i class="fa fa-search top-search"></i>
						</div>

						<div class="ed-pop-up">
							<?php get_search_form(); ?>
							<div class="search-overlay"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'educationweb_header', 'education_web_main_header', 20 );

if ( ! function_exists( 'education_web_header_after' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function education_web_header_after() { ?>
		</header><!-- #masthead -->
		<?php
	}
}
add_action( 'educationweb_header_after', 'education_web_header_after', 25 );



