<?php
/**
 * Class for adding features Section Widget
 *
 * @package  Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_web_whychoose' ) ) {

	class Education_web_whychoose extends WP_Widget {

		private $defaults = array(
			'page_id'           => 0,
			'sp_all_page_items' => '',
			'title'             => '',
			'subtitle'          => '',
			'bg_image'          => ''
		);

		function __construct() {

			parent::__construct(

				/**
				 * Base ID of your widget
				*/
				'Education_web_whychoose',

				/**
				 * Widget name will appear in UI
				*/
				esc_html__( 'OT : Why Choose Services', 'education-web' ),

				/**
				 * Widget description
				*/
				array( 'description' => esc_html__( 'A Widget Display Company Why Choose Services', 'education-web' ), )
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
            $bg_image =  $instance[ 'bg_image' ];
			$page_id            = absint( $instance['page_id'] );
			$sp_all_page_items  = $instance['sp_all_page_items'];

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
                    <label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Select Why Choose Pages', 'education-web' ); ?>:</label>
                    <br/>
                    <small><?php esc_html_e( 'Select Why Choose Pages', 'education-web' ); ?></small>
					<?php
						/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
						$args = array(
							'selected'         => $page_id,
							'name'             => $this->get_field_name( 'page_id' ),
							'id'               => $this->get_field_id( 'page_id' ),
							'class'            => 'widefat',
							'show_option_none' => esc_html__( 'Select Why Choose Pages', 'education-web' ),
							'option_none_value'     => 0 // string
						);
						wp_dropdown_pages( $args );
					?>
                </p>

			<?php } else{ ?>

                <label><?php esc_html_e( 'Select Why Choose Pages', 'education-web' ); ?>:</label>
                <div class="sp-repeater">
					<?php
						$total_repeater = 0;

						if  ( is_array($sp_all_page_items) && count($sp_all_page_items) > 0){

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
	                                        <h3><?php esc_html_e( 'Select Why Choose Page Item', 'education-web' )?><span class="in-sp-repeater-title"></span></h3>
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
												'show_option_none'  => esc_html__( 'Select Why Choose Pages', 'education-web'),
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
	                                    <h3><?php esc_html_e( 'Why Choose Page Item', 'education-web' )?><span class="in-sp-repeater-title"></span></h3>
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
											'show_option_none' => esc_html__( 'Select Why Choose Pages', 'education-web'),
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
						$add_field = esc_html__('Why Choose Page Item', 'education-web');
						echo '<span class="button-primary sp-add-repeater" id="'.wp_kses_post( $coder_repeater_depth ).'">'.wp_kses_post( $add_field ).'</span><br/>';
					?>
                </div>

			<?php } ?>

			<p>
                <label for="<?php echo esc_attr( $this->get_field_id('bg_image') ); ?>">
                    <?php esc_html_e( 'Select Background Image', 'education-web' ); ?>:
                </label>
                <?php
                $education_web_display_none = '';
                if ( empty( $bg_image ) ){
                    $education_web_display_none = ' style="display:none;" ';
                }
                ?>
                <span class="img-preview-wrap" <?php echo  wp_kses_post( $education_web_display_none ) ; ?>>
                    <img class="widefat" src="<?php echo esc_url( $bg_image ); ?>" alt="<?php esc_html_e( 'Image preview', 'education-web' ); ?>"  />
                </span><!-- .img-preview-wrap -->

                <input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name('bg_image') ); ?>" id="<?php echo esc_attr( $this->get_field_id('bg_image') ); ?>" value="<?php echo esc_url( $bg_image ); ?>" />
                <input type="button" value="<?php esc_html_e( 'Upload Image', 'education-web' ); ?>" class="button media-image-upload" data-title="<?php esc_html_e( 'Select Background Image','education-web'); ?>" data-button="<?php esc_html_e( 'Select Background Image','education-web'); ?>"/>
                <input type="button" value="<?php esc_html_e( 'Remove Image', 'education-web' ); ?>" class="button media-image-remove" />
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

            $instance['bg_image'] = ( isset( $new_instance['bg_image'] ) ) ?  esc_url_raw( $new_instance['bg_image'] ): '';

			$instance['page_id']       = absint( $new_instance['page_id'] );
			$instance['sp_all_page_items']    = $new_instance['sp_all_page_items'];
			
			$page_ids = array();
			foreach ($new_instance['sp_all_page_items'] as $key=>$features ){
				$page_ids[$key]['page_id'] = absint( $features['page_id'] );
            }

			$instance['sp_all_page_items'] = $page_ids;

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
			$aboutbgimg         = $instance['bg_image'];
			$page_id            = absint( $instance['page_id'] );
			$sp_all_page_items  = $instance['sp_all_page_items'];

			echo $args['before_widget'];
		?>
			<section id="service-post-section" class="whysection edu-widget">

					<?php if( !empty( $aboutbgimg ) ){ ?>
				    	<div class="service-left-bg" style="background-image:url(<?php echo esc_url( $aboutbgimg ); ?>)"></div>
				    <?php } ?>

				    <div class="container">
				        <div class="service-posts clearfix">
				            <div class="section-title-tagline">
				                <?php if(!empty( $title )){ ?>

				                	<h3>
				                		<?php echo esc_attr( $title ); ?>
				                	</h3>

				                <?php } if(!empty( $subtitle )){ ?>

				                	<div class="section-tagline"><?php echo esc_attr( $subtitle ); ?></div>

				                <?php } ?>
				            </div>

				            <div class="service-post-wrap">
				            	<?php
									
									$education_web_child_page_args = array();

			                        $post_in = array();
			                        if  (is_array($sp_all_page_items) && count($sp_all_page_items) > 0){
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
					                        'posts_per_page' => 6,
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

									$whychoose = new WP_Query( $education_web_child_page_args );

									if( $whychoose->have_posts() ) { while( $whychoose->have_posts() ) { $whychoose->the_post();
									
									$icon = get_post_meta( get_the_ID(), 'education-web-featured-icon', true );
								?>
					            	<div class="service-post clearfix">
					                    
					                    <div class="service-icon">
					                    	<?php if( !empty( $icon ) ){ ?>
								            	<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
								            <?php }else{ ?>
								            	<i class="fa fa-graduation-cap"></i>
								            <?php } ?>
					                    </div>
					                    
					                    <div class="service-excerpt">
					                        <h5><?php the_title(); ?></h5>
					                        <div class="service-text">
					                            <?php the_excerpt(); ?>
					                            
					                            <a href="<?php the_permalink(); ?>" class="why-read">
					                            	<?php esc_html_e('Read More','education-web'); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
					                            </a>
					                        </div>
					                    </div>
					                </div>
				                <?php } } wp_reset_postdata(); } ?>
				            </div>
				        </div>
				    </div>
				</section>
            
		<?php
			echo $args['after_widget'];
		}
	} // Class Education_web_whychoose ends here
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
if ( ! function_exists( 'Education_web_whychoose' ) ) :

	function Education_web_whychoose() {
		register_widget( 'Education_web_whychoose' );
	}

endif;
add_action( 'widgets_init', 'Education_web_whychoose' );