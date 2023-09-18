<?php
/**
 * Main Services Section Widgets
 *
 * @since Education Web 1.0.0
 *
 * @param null
 *
 * @return array $education_web_mainservices_column_number
 *
 */
if ( ! function_exists( 'education_web_mainservices_column_number' ) ) :
	function education_web_mainservices_column_number() {
		$education_web_mainservices_column_number = array(
			1 => esc_html__( '1', 'education-web' ),
			2 => esc_html__( '2', 'education-web' ),
			3 => esc_html__( '3', 'education-web' ),
			4 => esc_html__( '4', 'education-web' )
		);

		return apply_filters( 'education_web_mainservices_column_number', $education_web_mainservices_column_number );
	}
endif;


/**
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_mainservices' ) ) {

	class Education_web_mainservices extends WP_Widget {

		private $defaults = array(
			'page_id'           => 0,
            'post_number'       => 6,
			'sp_all_page_items' => '',
			'title'             => '',
			'subtitle'          => '',
			'column_number'     => 2
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_mainservices',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Main Services List', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Main Services Area', 'education-web' ), )
			);

			$this->sp_migrate_parent_page_to_repeater();
		}

		public function sp_migrate_parent_page_to_repeater() {
			
			if( !is_admin() ){
				return;
			}

			$all_instances = $this->get_settings();

			foreach ( $all_instances as $key => $instance ) {

				$parent_page_id = ( isset( $instance['page_id'] )? $instance['page_id'] : 0 );

				if( $parent_page_id == 0 ){
				    continue;
                }

				if ( 0 != $parent_page_id ) {

					$page_ids = array();

					$education_web_child_page_args = array(

						'post_parent'    => $parent_page_id,
						'posts_per_page' => -1,
						'post_type'      => 'page',
						'no_found_rows'  => true,
						'post_status'    => 'publish'
					);

					$slider_query = new WP_Query( $education_web_child_page_args );

					if ( ! $slider_query->have_posts() ) {

						$education_web_child_page_args = array(

							'page_id'        => $parent_page_id,
							'posts_per_page' => 1,
							'post_type'      => 'page',
							'no_found_rows'  => true,
							'post_status'    => 'publish'
						);

						$slider_query = new WP_Query( $education_web_child_page_args );
					}

					/**
					 * Start Here Loop
					*/
					if ( $slider_query->have_posts() ) :
						$i = 0;

						while ( $slider_query->have_posts() ):$slider_query->the_post();

							$page_ids[$i]['page_id'] = absint( get_the_ID() );

							$i++;

						endwhile;
					endif;

					$instance['sp_all_page_items'] = $page_ids;

					$instance['page_id'] = 0;

					$all_instances[$key] = $instance;

				}
			}

			$this->save_settings( $all_instances );
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
			$page_id            = absint( $instance['page_id'] );
			$sp_all_page_items  = $instance['sp_all_page_items'];
			$column_number      = absint( $instance['column_number'] );

		?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Enter Section Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Enter Section Sub Title', 'education-web' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
            </p>

		<?php if( $page_id != 0 ){ ?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Select Services Pages', 'education-web' ); ?>:</label>
                    <br/>
                    <small><?php esc_html_e( 'Select Services Pages', 'education-web' ); ?></small>
					<?php
						/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
						$args = array(
							'selected'         => $page_id,
							'name'             => $this->get_field_name( 'page_id' ),
							'id'               => $this->get_field_id( 'page_id' ),
							'class'            => 'widefat',
							'show_option_none' => esc_html__( 'Select Services Pages', 'education-web' ),
							'option_none_value'     => 0 // string
						);
						wp_dropdown_pages( $args );
					?>
                </p>

			<?php } else{ ?>

                <label><?php esc_html_e( 'Select Services Pages', 'education-web' ); ?>:</label>
                <div class="sp-repeater">
					<?php
						$total_repeater = 0;

						if  (is_array($sp_all_page_items) && count($sp_all_page_items) > 0){

							foreach ($sp_all_page_items as $features){

								$repeater_id  = $this->get_field_id( 'sp_all_page_items') .$total_repeater.'page_id';

								$repeater_name  = $this->get_field_name( 'sp_all_page_items' ).'['.$total_repeater.']['.'page_id'.']';
							?>
	                            <div class="repeater-table">

	                                <div class="sp-repeater-top">
	                                    <div class="sp-repeater-title-action">
	                                        <button type="button" class="sp-repeater-action">
	                                            <span class="sp-toggle-indicator" aria-hidden="true"></span>
	                                        </button>
	                                    </div>
	                                    <div class="sp-repeater-title">
	                                        <h3><?php esc_html_e( 'Select Services Page Item', 'education-web' )?><span class="in-sp-repeater-title"></span></h3>
	                                    </div>
	                                </div>

	                                <div class='sp-repeater-inside hidden'>
										<?php
											/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
											$args = array(
												'selected'          => $features['page_id'],
												'name'              => $repeater_name,
												'id'                => $repeater_id,
												'class'             => 'widefat sp-select',
												'show_option_none'  => esc_html__( 'Select Services Pages', 'education-web'),
												'option_none_value' => 0 // string
											);
											wp_dropdown_pages( $args );
										?>
	                                    <div class="sp-repeater-control-actions">
	                                        <button type="button" class="button-link button-link-delete sp-repeater-remove"><?php esc_html_e('Remove','education-web');?></button> |
	                                        <button type="button" class="button-link sp-repeater-close"><?php esc_html_e('Close','education-web');?></button>
	                                        <a class="button button-link sp-postid alignright" target="_blank" data-href="<?php echo esc_url( admin_url( 'post.php?post=POSTID&action=edit' ) ); ?>" href="<?php echo esc_url( admin_url( 'post.php?post='.$features['page_id'].'&action=edit' ) ); ?>"><?php esc_html_e('Edit / Add Icon','education-web'); ?></a>
	                                    </div>
	                                </div>
	                            </div>
							<?php
								$total_repeater = $total_repeater + 1;
							}
						}
						$coder_repeater_depth = 'coderRepeaterDepth_'.'0';

						$repeater_id  = $this->get_field_id( 'sp_all_page_items') .$coder_repeater_depth.'page_id';

						$repeater_name  = $this->get_field_name( 'sp_all_page_items' ).'['.$coder_repeater_depth.']['.'page_id'.']';
					?>
	                    <script type="text/html" class="sp-code-for-repeater">
	                        <div class="repeater-table">
	                            <div class="sp-repeater-top">
	                                <div class="sp-repeater-title-action">
	                                    <button type="button" class="sp-repeater-action">
	                                        <span class="sp-toggle-indicator" aria-hidden="true"></span>
	                                    </button>
	                                </div>
	                                <div class="sp-repeater-title">
	                                    <h3><?php esc_html_e( 'Services Page Item', 'education-web' )?><span class="in-sp-repeater-title"></span></h3>
	                                </div>
	                            </div>
	                            <div class='sp-repeater-inside hidden'>
									<?php
										/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
										$args = array(
											'selected'         => '',
											'name'             => $repeater_name,
											'id'               => $repeater_id,
											'class'            => 'widefat sp-select',
											'show_option_none' => esc_html__( 'Select Services Pages', 'education-web'),
											'option_none_value'     => 0 // string
										);
										wp_dropdown_pages( $args );
									?>
	                                <div class="sp-repeater-control-actions">
	                                    <button type="button" class="button-link button-link-delete sp-repeater-remove"><?php esc_html_e('Remove','education-web');?></button> |
	                                    <button type="button" class="button-link sp-repeater-close"><?php esc_html_e('Close','education-web');?></button>
	                                    <a class="button button-link sp-postid alignright hidden" target="_blank" data-href="<?php echo esc_url( admin_url( 'post.php?post=POSTID&action=edit' ) ); ?>" href=""><?php esc_html_e('Edit / Add Icon','education-web'); ?></a>
	                                </div>
	                            </div>
	                        </div>

	                    </script>
					<?php
						echo '<input class="sp-total-repeater" type="hidden" value="'.wp_kses_post( $total_repeater ) .'">';
						$add_field = esc_html__('Services Page Item', 'education-web');
						echo '<span class="button-primary sp-add-repeater" id="'.wp_kses_post( $coder_repeater_depth ).'">'.wp_kses_post( $add_field ).'</span><br/>';
					?>
                </div>

			<?php } ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Column Number', 'education-web' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>">
					<?php
						$education_web_mainservices_column_numbers = education_web_mainservices_column_number();
						foreach ( $education_web_mainservices_column_numbers as $key => $value ) {
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
			
			$instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'subtitle' ]  = sanitize_text_field( $new_instance[ 'subtitle' ] );

			$instance['page_id']       = absint( $new_instance['page_id'] );
			$instance['sp_all_page_items']    = $new_instance['sp_all_page_items'];
			
			$page_ids = array();
			foreach ($new_instance['sp_all_page_items'] as $key=>$features ){
				$page_ids[$key]['page_id'] = absint( $features['page_id'] );
            }

			$instance['sp_all_page_items'] = $page_ids;
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

			$title              = $instance['title'];
			$subtitle           = $instance['subtitle'];
			$page_id            = absint( $instance['page_id'] );
			$sp_all_page_items  = $instance['sp_all_page_items'];
			$column_number      = absint( $instance['column_number'] );
			$init_column        = '';

			echo $args['before_widget'];
		?>
			<section id="services" class="services edu-widget">
				<div class="container">	
					<?php
						/**
						 * Section Title & SubTitle
						*/
						education_web_section_title( $title, $subtitle );
					?>			
					<div class="row">
						<?php

							$education_web_child_page_args = array();

	                        $post_in = array();
	                        if  (is_array($sp_all_page_items) && count($sp_all_page_items) > 0 ){
		                        foreach ( $sp_all_page_items as $about ){
			                        if( isset( $about['page_id'] ) && !empty( $about['page_id'] ) ){
				                        $post_in[] = $about['page_id'];
			                        }
		                        }
	                        }
	                        if( !empty( $post_in )) :
		                        $education_web_child_page_args = array(
			                        'post__in'         => $post_in,
			                        'orderby'             => 'post__in',
			                        'posts_per_page'      => count( $post_in ),
			                        'post_type'           => 'page',
			                        'no_found_rows'       => true,
			                        'post_status'         => 'publish'
		                        );
	                        elseif( ! empty ( $page_id ) ):
		                        $education_web_child_page_args = array(
			                        'post_parent'    => $page_id,
			                        'posts_per_page' => 8,
			                        'post_type'      => 'page',
			                        'no_found_rows'  => true,
			                        'post_status'    => 'publish'
		                        );
		                        $about_query = new WP_Query( $education_web_child_page_args );
		                        if ( ! $about_query->have_posts() ) {
			                        $education_web_child_page_args = array(
				                        'page_id'        => $page_id,
				                        'posts_per_page' => 1,
				                        'post_type'      => 'page',
				                        'no_found_rows'  => true,
				                        'post_status'    => 'publish'
			                        );
		                        }
	                        endif;

                        if( !empty( $education_web_child_page_args ) ){

							$eservicespage = new WP_Query( $education_web_child_page_args );

							if( $eservicespage->have_posts() ) { while( $eservicespage->have_posts() ) { $eservicespage->the_post();
							
							$icon = get_post_meta( get_the_ID(), 'education-web-featured-icon', true );

							if( 1 == $column_number ){
                                $init_column .= " col-sm-12";
                            }
                            elseif( 2 == $column_number ){
                                $init_column .= " col-sm-6 col-xs-12";
                            }
                            elseif( 3 == $column_number ){
                                $init_column .= " col-md-4 col-sm-6 col-xs-12";
                            }
                            elseif( 4 == $column_number ){
                                $init_column .= " col-md-3 col-sm-6 col-xs-12";
                            }
                            else{
                                $init_column .= " col-md-4 col-sm-6 col-xs-12";
                            }
						?>

							<div class="<?php echo esc_attr( $init_column ) ?>">
								<div class="featured-post">
									<div class="featured-icon">
										<?php if( !empty( $icon ) ){ ?>
							            	<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
							            <?php }else{ ?>
							            	<i class="fa fa-graduation-cap"></i>
							            <?php } ?>
									</div>

									<h3><?php the_title(); ?></h3>

									<div class="featured-excerpt">
										<?php echo esc_attr( wp_trim_words( get_the_content(), 25 ) ); ?>
										<div class="featured-link">
											<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','education-web'); ?></a>
										</div>
									</div>
								</div>
							</div><!--/ End Single Service -->

						<?php } } wp_reset_postdata(); } ?>

					</div>
				</div>
			</section><!--/ End Services -->
            
		<?php
			echo $args['after_widget'];
		}
	} // Class Education_web_mainservices ends here
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
if ( ! function_exists( 'Education_web_mainservices' ) ) :

	function Education_web_mainservices() {
		register_widget( 'Education_web_mainservices' );
	}

endif;
add_action( 'widgets_init', 'Education_web_mainservices' );