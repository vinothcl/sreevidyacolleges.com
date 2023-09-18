<?php
/**
 * Testimonial Section Widgets
 *
 * @since Education Web 1.0.0
 *
 * @param null
 *
 * @return array $education_web_testimonial_column_number
 *
 */
if ( ! function_exists( 'education_web_testimonial_column_number' ) ) :
	function education_web_testimonial_column_number() {
		$education_web_testimonial_column_number = array(
			1 => esc_html__( '1', 'education-web' ),
			2 => esc_html__( '2', 'education-web' ),
			3 => esc_html__( '3', 'education-web' )
		);

		return apply_filters( 'education_web_testimonial_column_number', $education_web_testimonial_column_number );
	}
endif;

/**
 * Testimonial Section Widgets
 *
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_testimonial' ) ) {

	class Education_web_testimonial extends WP_Widget {

		private $defaults = array(
			'title'             => '',
			'subtitle'          => '',
			'column_number'     => 2
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_testimonial',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Testimonial Area', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Testimonial', 'education-web' ), )
			);
		}

		/**
		 * Widget Backend
		*/
		public function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, $this->defaults );
			
			/**
			 * Set Default Values
			*/

			$title    =  $instance[ 'title' ];
            $subtitle =  $instance[ 'subtitle' ];
            $column_number = absint( $instance['column_number'] );

		?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Enter Section Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Enter Section Sub Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Select Display Number Items', 'education-web' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>">
					<?php
						$education_web_testimonial_column_number = education_web_testimonial_column_number();
						foreach ( $education_web_testimonial_column_number as $key => $value ) {
					?>
                        <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value ); ?></option>
					
					<?php } ?>
                </select>
            </p>

            <p class="sp-teammember">
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <a class="button teamember" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=education_web_testimonial_settings' ) ); ?>">
                        <?php esc_html_e('Our Testimonial Settings','education-web'); ?>
                    </a>
                </label></br>
                <small><?php esc_html_e('Click on button and manage testimonial section settings Area in customizer','education-web'); ?></small>
            </p>

		<?php
			}

		/**
		 * Function to Updating widget replacing old instances with new
		 *
		 * @access public
		 * @since 1.0.0
		 *
		 * @param array $new_instance new arrays value
		 * @param array $old_instance old arrays value
		 *
		 * @return array
		 *
		 */
		public function update( $new_instance, $old_instance ) {

			$instance                  = $old_instance;
			
			$instance[ 'title' ]       = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'subtitle' ]    = sanitize_text_field( $new_instance[ 'subtitle' ] );
            $instance['column_number'] = absint( $new_instance['column_number'] );

			return $instance;
		}

		/**
		 * Function to Creating widget front-end. This is where the action happens
		 *
		 * @access public
		 * @since 1.0.0
		 *
		 * @param array $args widget setting
		 * @param array $instance saved values
		 *
		 * @return void
		 *
		 */
		public function widget( $args, $instance ) {

			$instance    = wp_parse_args( (array) $instance, $this->defaults );

			$title       = $instance['title'];
			$subtitle    = $instance['subtitle'];
			$numberitem  = absint( $instance['column_number'] );

		echo $args['before_widget'];

			$alltestimonial = wp_kses_post( get_theme_mod('education_web_testimonial_area_settings') );
			
			if(!empty( $alltestimonial )) { ?>

			<section id="testimonials" class="testimonials edu-widget">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_testimonial_title');

						education_web_section_title( $title, $subtitle = '' );
						
					?>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="testimonial-carousel1">
								<?php
									$alltestimonials = json_decode( $alltestimonial );
									foreach($alltestimonials as $testimonials){ 
										$page_id = $testimonials->testimonial_page;
										$compnay = $testimonials->testimonial_company;
										if( !empty( $page_id ) ) {											
										$testimonials = new WP_Query( 'page_id='.$page_id );								
									if( $testimonials->have_posts() ) { while( $testimonials->have_posts() ) { $testimonials->the_post();
								?>
									<div class="single-testimonial">
										<div class="testimonial-content">
											<i class="fa fa-quote-left"></i>
											<?php the_excerpt(); ?>
										</div>
										<div class="testimonial-info">										
											<?php if ( has_post_thumbnail() ) : ?>
												<span class="arrow"></span>
											    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											        <?php the_post_thumbnail('thumbnail'); ?>
											    </a>
											<?php endif; ?>
											<h6><?php the_title(); ?><span><?php echo esc_attr( $compnay ); ?></span></h6>
										</div>				
									</div>
								<?php } } wp_reset_postdata(); } } ?>		
							</div>
						</div>
					</div>
				</div>
			</section><!--/ End Testimonial -->
		<script type="text/javascript">
			jQuery(document).ready(function($){
				/**
				 * Testimonial JS
				*/ 
				$(".testimonial-carousel1").owlCarousel({
					loop:true,
					autoplay:true,
					smartSpeed: 700,
					center:false,
					margin:15,
					nav:false,
					navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
					dots:true,
					responsive:{
						300: {
							items: 1,
						},
						480: {
							items: 1,
						},
						768: {
							items: 1,
						},
						1170: {
							items: <?php echo intval( $numberitem ); ?>,
						},
					}
				});
			});
        </script>

		<?php }

			echo $args['after_widget'];
		}
	} // Class Education_web_testimonial ends here
}

/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 *
 * @return null
 *
 */
if ( ! function_exists( 'Education_web_testimonial' ) ) :

	function Education_web_testimonial() {
		register_widget( 'Education_web_testimonial' );
	}

endif;
add_action( 'widgets_init', 'Education_web_testimonial' );