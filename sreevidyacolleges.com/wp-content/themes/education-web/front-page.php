<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Education_Web
 */
get_header(); 
	
	/**
	 * Enable Front Page
	*/
	do_action( 'education_web_enable_front_page' );

	$enable_front_page = get_theme_mod( 'education_web_set_original_fp' ,false);

	if( $enable_front_page == 1 ) {

		/**
		 * Main Slider Section in Front Page
		*/
		do_action( 'educationweb_slider' );

		if ( is_active_sidebar( 'homewidget-1' ) ) { 

			dynamic_sidebar( 'homewidget-1' );  

		}else{
		
			$section_order = get_theme_mod( 'education_web_homepage_section_order_list' );

			if( empty( $section_order ) ) {

			    $educationweb_home_section_order = array(
			                            '0'  => 'features',
			                            '1'  => 'skill',
			                            '2'  => 'academics',
			                            '3'  => 'courses',
			                            '4'  => 'extraservices',                                    
			                            '5'  => 'whychoose',
			                            '6'  => 'gallery',
			                            '7'  => 'counter',
			                            '8'  => 'ourteam',
			                            '9'  => 'testimonial',
			                            '10' => 'faq',
			                            '11' => 'ourblog',
			                            '12' => 'clientlogo',
			                        );
			} else {
			    $save_section_order = explode( ',' , $section_order);

			    $section_order_pop = array_pop( $save_section_order );

			    $educationweb_home_section_order = $save_section_order;
			}

			foreach ( $educationweb_home_section_order  as $key => $value ) {  
				
				if( $value == 'features' ) {

					/**
					 * Services Section in Front Page
					*/
					do_action( 'educationweb_services' );

				}

				if( $value == 'skill' ) {

					/**
					 * Skill Section in Front Page
					*/
					do_action( 'educationweb_skill' );

					
				}


				if( $value == 'academics' ) {

					/**
					 * Academics Section in Front Page
					*/
					do_action( 'educationweb_academics' );
					
				}


				if( $value == 'courses' ) {

					/**
					 * Course Section in Front Page
					*/
					do_action( 'educationweb_courses' );
					
				}

				if( $value == 'extraservices' ) {

					/**
					 * Extra Services Section in Front Page
					*/
					do_action( 'educationweb_extraservices' );
					
				}

				if( $value == 'gallery' ) {

					/**
					 * Gallery Section in Front Page
					*/
					do_action( 'educationweb_gallery' );
					
				}


				if( $value == 'whychoose' ) {

					/**
					 * Team Member Section in Front Page
					*/
					do_action( 'educationweb_counter' );
					
				}

				if( $value == 'counter' ) {

					/**
					 * Why Choose Section in Front Page
					*/
					do_action( 'educationweb_whychoose' );
					
				}

				if( $value == 'ourteam' ) {

					/**
					 * Team Member Section in Front Page
					*/
					do_action( 'educationweb_team' );
					
				}

				if( $value == 'testimonial' ) {

					/**
					 * Testimonials Section in Front Page
					*/
					do_action( 'educationweb_testimonials' );
					
				}

				if( $value == 'faq' ) {

					/**
					 * FAQ Section in Front Page
					*/
					do_action( 'educationweb_faq' );
					
				}

				if( $value == 'ourblog' ) {

					/**
					 * Our Blog Section in Front Page
					*/
					do_action( 'educationweb_blog' );
					
				}

				if( $value == 'clientlogo' ) {

					/**
					 * Our Brand/Client Logo in Front Page
					*/
					do_action( 'educationweb_clientlogo' );
					
				}

			}//endforeach about section reorder

		}  
	}


get_footer();