<?php
/**
 * Our Courses Section Widgets
 *
 * @since Education Web 1.0.0
 *
 * @param null
 *
 * @return array $education_web_courses_column_number
 *
 */
if ( ! function_exists( 'education_web_courses_column_number' ) ) :
	function education_web_courses_column_number() {
		$education_web_courses_column_number = array(
			2 => esc_html__( '2', 'education-web' ),
			3 => esc_html__( '3', 'education-web' )
		);

		return apply_filters( 'education_web_courses_column_number', $education_web_courses_column_number );
	}
endif;

/**
 * Our Courses Section Widgets
 *
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_courses' ) ) {

	class Education_web_courses extends WP_Widget {

		private $defaults = array(
			'title'             => '',
			'subtitle'          => '',
			'column_number'     => 3
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_courses',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Our Courses', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Our Popular Courses', 'education-web' ), )
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Select Display Number Column', 'education-web' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>">
					<?php
						$education_web_courses_column_number = education_web_courses_column_number();
						foreach ( $education_web_courses_column_number as $key => $value ) {
					?>
                        <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value ); ?></option>
					
					<?php } ?>
                </select>
            </p>

            <p class="sp-teammember">
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <a class="button teamember" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=education_web_courses_settings' ) ); ?>">
                        <?php esc_html_e('Our Courses Settings','education-web'); ?>
                    </a>
                </label></br>
                <small><?php esc_html_e('Click on button and manage courses section settings Area in customizer','education-web'); ?></small>
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
			$init_column = '';

			echo $args['before_widget'];

			$allcourse = wp_kses_post( get_theme_mod('education_web_course_area_settings') );
							
			$cdesclimit = get_theme_mod('education_web_course_text_limit', 20);
			
			if(!empty( $allcourse )) { ?>

	    	<section id="course" class="course edu-widget">
				<div class="container">				
					<?php
						/**
						 * Section Title & SubTitle
						*/
						education_web_section_title( $title, $subtitle );
					?>
								
					<div class="row">
						<?php

							if( 1 == $numberitem ){
                                $init_column .= "col-sm-12";
                            }
                            elseif( 2 == $numberitem ){
                                $init_column .= "col-sm-6 col-xs-12";
                            }
                            elseif( 3 == $numberitem ){
                                $init_column .= "col-md-4 col-sm-6 col-xs-12";
                            }
                            elseif( 4 == $numberitem ){
                                $init_column .= "col-md-3 col-sm-6 col-xs-12";
                            }
                            else{
                                $init_column .= "col-md-4 col-sm-6 col-xs-12";
                            }

							$allcourse = json_decode( $allcourse );
							foreach($allcourse as $course){ 
								$course_price = $course->course_price;
								$course_sets = $course->course_sets;
								$page_id = $course->course_page;
								if( !empty( $page_id ) ) {
								$course = new WP_Query( 'page_id='.$page_id );

							if( $course->have_posts() ) { while( $course->have_posts() ) { $course->the_post();

							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-about', true );
						?>

						<div class="<?php echo esc_attr( $init_column ); ?> ed-course-col-<?php echo intval( $numberitem ); ?>">
						    <div class="single-course">
						    	<?php if ( has_post_thumbnail() ){ ?>
							        <div class="single-course-image">
							            <a href="<?php the_permalink(); ?>">
							                <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>"> 
							                <span class="class-date"><?php the_time('M j'); ?> <span><?php the_time('Y'); ?></span></span>
							            </a>
							        </div>
							    <?php } ?>
						        <div class="single-course-text">
						            <div class="class-des">
						                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						                <p><?php echo esc_attr( wp_trim_words( get_the_content(), $cdesclimit ) ); ?></p>
						            </div>
						            <div class="course-schedule">
						                <span><?php echo esc_attr( $course_price ); ?></span>
						                <span class="arrow"><a href="<?php the_permalink(); ?>"><?php esc_html_e('View More','education-web'); ?> <i class="fa fa-angle-right"></i></a></span>
						            </div>
						        </div>
						    </div>
						</div>

						<?php  } } wp_reset_postdata(); } } ?>

					</div>
				</div>
			</section><!--/ End course -->
            
		<?php }
		
			echo $args['after_widget'];
		}
	} // Class Education_web_courses ends here
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
if ( ! function_exists( 'Education_web_courses' ) ) :

	function Education_web_courses() {
		register_widget( 'Education_web_courses' );
	}

endif;
add_action( 'widgets_init', 'Education_web_courses' );