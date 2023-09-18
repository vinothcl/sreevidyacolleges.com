<?php
/**
 * Our Blog Section Widgets
 *
 * @since Education Web 1.0.0
 *
 * @param null
 *
 * @return array $education_web_mainservices_column_number
 *
 */
if ( ! function_exists( 'education_web_blogs_number' ) ) :
	function education_web_blogs_number() {
		$education_web_blogs_number = array(
			1 => esc_html__( '1', 'education-web' ),
			2 => esc_html__( '2', 'education-web' ),
			3 => esc_html__( '3', 'education-web' ),
			4 => esc_html__( '4', 'education-web' ),
			5 => esc_html__( '5', 'education-web' ),
			6 => esc_html__( '6', 'education-web' ),
			7 => esc_html__( '7', 'education-web' ),
			8 => esc_html__( '8', 'education-web' )
		);

		return apply_filters( 'education_web_blogs_number', $education_web_blogs_number );
	}
endif;

/**
 *
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_blogs' ) ) {

	class Education_web_blogs extends WP_Widget {

		private $defaults = array(
			'title'             => '',
			'subtitle'          => '',
			'column_number'     => 2 ,
			'blogscategory'     => 0 
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_blogs',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Our Blogs', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Blogs Posts', 'education-web' ), )
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
            $blogscategory =  $instance[ 'blogscategory' ];
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'blogscategory' ) ); ?>"><?php esc_html_e( 'Select Multiple Blogs Category', 'education-web' ); ?>:</label>
                </br>
                <?php

                    $taxonomy  = 'category';
                    $args = array(
                        'taxonomy'     => $taxonomy,
                    );

                    $blogscategory = get_categories( $args );

                    foreach ($blogscategory as $category) {

                        $option    = '<input type="checkbox" id="' . esc_attr( $this->get_field_id( 'blogscategory' ) ) . '[]" name="' . esc_attr( $this->get_field_name('blogscategory') ) . '[]"';
                        
                        $selected  = $instance['blogscategory'];
                        
                        $arrlength = ($selected && is_array($selected)) ? count( $selected ) : 0;

                        for ($count = 0; $count < $arrlength; $count++) {

                            if ($selected[$count] == $category->term_id) {

                                $option = $option .= ' checked="checked"';
                            }
                        }

                        $option .= ' value="' . $category->term_id . '" />';

                        $option .= $category->name;

                        $option .= '<br />';

                        echo $option;
                    }
                ?>
            </p>


            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Select Display Number Posts', 'education-web' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>">
					<?php
						$education_web_blogs_number = education_web_blogs_number();
						foreach ( $education_web_blogs_number as $key => $value ) {
					?>
                        <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value ); ?></option>
					
					<?php } ?>
                </select>
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
            $instance['blogscategory'] = wp_kses_post( $new_instance['blogscategory'] );
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

			$title          = $instance['title'];
			$subtitle       = $instance['subtitle'];
			$blogscategory  = $instance['blogscategory'];
			$postcount      = absint( $instance['column_number'] );

			echo $args['before_widget'];
		?>
			<section id="blog-main" class="blog-main edu-widget">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						education_web_section_title( $title, $subtitle );
					?>
					<div class="row">
						<div class="blog-main clearfix">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="blog-list">
									<?php
										$argss = array(
								            'post_type' => 'post',
								            'posts_per_page' => $postcount,
								            'tax_query' => array(
								                array(
								                    'taxonomy' => 'category',
								                    'field' => 'term_id',
								                    'terms' => $blogscategory
								                ),
								            ),
								        );

								        $query = new WP_Query($argss);

								        while ($query->have_posts()) { $query->the_post();

				                    	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-blog', true );
									?>
										<div class="col-md-6 col-sm-6 col-xs-12 ed-blog-section">
										    <div class="news-grid-item">
										        <div class="news-grid-img">
										            <div class="news-thum-area">
									                    <a href="<?php the_permalink(); ?>">
									                        <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">
									                    </a>
									                </div>
									                <div class="news-content-area">
									                    <div class="news-content">
									                    	
									                        <?php education_web_posted_on(); ?>

									                        <h3 class="news-title">
									                        	<a href="<?php the_permalink(); ?>">
									                        		<?php the_title(); ?>
									                        	</a>
									                        </h3>
									                        <p><?php echo esc_attr( wp_trim_words( get_the_content(), 20 ) ); ?></p>
									                        <a href="<?php the_permalink(); ?>" class="btn btn-common btn-sm">
									                        	<?php esc_html_e('Read More','education-web'); ?>
									                        </a>
									                    </div>
									                </div>
										        </div>
										    </div>
										</div>
									<?php } wp_reset_postdata(); ?>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</section><!--/ End Blog -->
		<?php
			echo $args['after_widget'];
		}
	} // Class Education_web_blogs ends here
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
if ( ! function_exists( 'Education_web_blogs' ) ) :

	function Education_web_blogs() {
		register_widget( 'Education_web_blogs' );
	}

endif;
add_action( 'widgets_init', 'Education_web_blogs' );