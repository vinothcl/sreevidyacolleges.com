<?php
/**
 * Our Team Member Section Widgets
 *
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_team' ) ) {

	class Education_web_team extends WP_Widget {

		private $defaults = array(
			'title'             => '',
			'subtitle'          => ''
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_team',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Our Team Member', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Team Member', 'education-web' ), )
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

		?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Enter Section Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Enter Section Sub Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
            </p>

            <p class="sp-teammember">
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <a class="button teamember" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=education_web_team_settings' ) ); ?>">
                        <?php esc_html_e('Our Team Member Settings','education-web'); ?>
                    </a>
                </label></br>
                <small><?php esc_html_e('Click on button and manage team member section settings Area in customizer','education-web'); ?></small>
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
			
			$instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'subtitle' ]  = sanitize_text_field( $new_instance[ 'subtitle' ] );

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

			$title               = $instance['title'];
			$subtitle            = $instance['subtitle'];

			echo $args['before_widget'];

			$allmember = wp_kses_post( get_theme_mod('education_web_team_area_settings') );

			if(!empty( $allmember )) { ?>

				<section id="team" class="team edu-widget">
					<div class="container">
						<?php
							/**
							 * Section Title & SubTitle
							*/
							education_web_section_title( $title, $subtitle );
						?>
						<div class="row">
							<?php
								$allmember = json_decode( $allmember );

								foreach($allmember as $team){ 

									$page_id    = $team->team_page;
									$position   = $team->team_position;

								if( !empty( $page_id ) ) {

								$teampage = new WP_Query( 'page_id='.$page_id );

								if( $teampage->have_posts() ) { while( $teampage->have_posts() ) { $teampage->the_post();
								
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-team', true );
							?>
								<div class="col-md-4 col-sm-6 col-xs-6">
									<div class="single-team-item">
										<div class="single-team-img">
											<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>">                                                
											<div class="team-overlay">
												<div class="team-socila-profile">
													<a href="<?php echo esc_url( $team->team_facebook ); ?>"><i class="fa fa-facebook"></i></a>
													<a href="<?php echo esc_url( $team->team_twitter ); ?>"><i class="fa fa-twitter"></i></a>
													<a href="<?php echo esc_url( $team->team_instagram ); ?>"><i class="fa fa-instagram"></i></a>
													<a href="<?php echo esc_url( $team->team_linkedin ); ?>"><i class="fa fa-linkedin"></i></a>
													<a href="<?php echo esc_url( $team->team_google_plus ); ?>"><i class="fa fa-google-plus"></i></a>
												</div>
											</div>
										</div>
										<div class="team-desc">
											<h4><?php the_title(); ?><span><?php echo esc_attr( $position ); ?></span></h4>
										</div>
									</div>
								</div>

							<?php } } wp_reset_postdata(); } } ?>

						</div>

					</div>
				</section>
            
		<?php }
		
			echo $args['after_widget'];
		}
	} // Class Education_web_team ends here
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
if ( ! function_exists( 'Education_web_team' ) ) :

	function Education_web_team() {
		register_widget( 'Education_web_team' );
	}

endif;
add_action( 'widgets_init', 'Education_web_team' );