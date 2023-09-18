<?php
/**
 * Clients/Brand Logo Section Widgets
 *
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_clientlogo' ) ) {

	class Education_web_clientlogo extends WP_Widget {

		private $defaults = array(
			'title'             => '',
			'subtitle'          => ''
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_clientlogo',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Clients/Brand Logo Area', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Clients/Brand Logo', 'education-web' ), )
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
                    <a class="button teamember" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=education_web_brand_logo_settings' ) ); ?>">
                        <?php esc_html_e('Our Clients/Brand Logo','education-web'); ?>
                    </a>
                </label></br>
                <small><?php esc_html_e('Click on button and manage clients/brand logo section settings Area in customizer','education-web'); ?></small>
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

			$instance                = $old_instance;
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

            $allclientlogo = wp_kses_post( get_theme_mod('education_web_brand_area_settings') );

		if(!empty( $allclientlogo )) { ?>
			
			<section id="clients" class="clients edu-widget">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						education_web_section_title( $title, $subtitle );
					?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="clients-slider">
								<?php
									$allclientlogos = json_decode( $allclientlogo );

									foreach($allclientlogos as $clientlogo){ 
										$logo = $clientlogo->brand_logo;
										$link = $clientlogo->brank_link;
									if(!empty( $logo )){
								?>
									<div class="single-clients">
										<a href="<?php echo esc_url( $link ); ?>" target="_blank">
											<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_html_e( 'Brnd Logo Image', 'education-web' ); ?>">
										</a>
									</div><!--/ End Single Clients -->
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
			</section><!--/ End Clients -->	
			
		<?php }

			echo $args['after_widget'];
		}
	} // Class Education_web_clientlogo ends here
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
if ( ! function_exists( 'Education_web_clientlogo' ) ) :

	function Education_web_clientlogo() {
		register_widget( 'Education_web_clientlogo' );
	}

endif;
add_action( 'widgets_init', 'Education_web_clientlogo' );