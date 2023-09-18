<?php
/**
 * About Us Widget Image Display Options
 *
 * @since Education Web 1.0.0
 *
 * @param null
 * @return array $education_web_image_align
 *
 */

if ( !function_exists('education_web_image_align') ) :
    function education_web_image_align() {
        $education_web_image_align =  array(
            1 => esc_html__( 'Left', 'education-web' ),
            2 => esc_html__( 'Right', 'education-web' )
        );
        return apply_filters( 'education_web_image_align', $education_web_image_align );
    }
endif;

/**
 * About Us Widget 
 *
 * @package Offshore Themes
 * @subpackage  Education Web
 * @since 1.0.0
 */

if ( ! class_exists( 'Education_web_aboutus' ) ) {

    class Education_web_aboutus extends WP_Widget {

        private function defaults(){

            $defaults = array(
                'page_id'     => '',
                'image_align' => 1
            );

            return $defaults;
        }

        function __construct() {

            parent::__construct(

                'Education_web_aboutus',

                esc_html__('OT : AboutUs Widget', 'education-web'),

                array( 'description' => esc_html__( 'A widget display about us description with features image', 'education-web' ), )
            );

        }

        /**
         * Call To Action Widget Backend
        */
        public function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, $this->defaults() );

            $page_id     = absint( $instance[ 'page_id' ] );

            $image_align = absint( $instance[ 'image_align' ] );

            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Select AboutUs Page', 'education-web' ); ?>:</label>
                <br />
                <?php
                    /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                    $args = array(
                        'selected'              => $page_id,
                        'name'                  => $this->get_field_name( 'page_id' ),
                        'id'                    => $this->get_field_id( 'page_id' ),
                        'class'                 => 'widefat',
                        'show_option_none'      => esc_html__('Select Page','education-web'),
                        'option_none_value'     => 0 // string
                    );
                    wp_dropdown_pages( $args );
                ?>
            </p>

           <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'image_align' ) ); ?>"><?php esc_html_e( 'Image Align', 'education-web' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_align' ) ); ?>" >
                    <?php
                    $education_web_image_align = education_web_image_align();
                    foreach ( $education_web_image_align as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $image_align ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>

            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance[ 'page_id' ]    = absint( $new_instance[ 'page_id' ] );

            $instance[ 'image_align' ] = absint( $new_instance[ 'image_align' ] );

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
         * @return void
         *
         */
        public function widget($args, $instance) {
            
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            
            $page_id = absint( $instance[ 'page_id' ] );
            $image_align = intval( $instance[ 'image_align' ] );


            echo $args['before_widget']; ?>
                
                <section id="our-skill" class="our-skill edu-widget">
                    <div class="container">             
                        
                        <div class="row"> 
                            <?php
                                $aboutargs = array(
                                        'page_id'        => $page_id,
                                        'posts_per_page' => 1,
                                    );

                                $skillabout = new WP_Query( $aboutargs );

                                if( $skillabout->have_posts() ) { while( $skillabout->have_posts() ) { $skillabout->the_post();

                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'education-web-about', true);

                                if( $image_align == 1 ){
                            ?>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="aboutus-image"> 
                                        <img src="<?php echo esc_url( $image[0] ); ?>" title="<?php the_title(); ?>" />
                                    </div>
                                </div>

                            <?php } ?>

                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="skill-text">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php the_content(); ?>
                                    </div>
                                </div>

                            <?php if( $image_align == 2 ){ ?>

                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="aboutus-image">
                                        <img src="<?php echo esc_url( $image[0] ); ?>" title="<?php the_title(); ?>" />
                                    </div>
                                </div>

                            <?php } ?>

                            <?php } }  wp_reset_postdata(); ?>
                        </div>

                    </div>
                </section><!--/ End aboutus -->
            
        <?php

            echo $args['after_widget'];
        }

    } // Class Education_web_aboutus ends here
}
/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'Education_web_aboutus' ) ) :

    function Education_web_aboutus() {

        register_widget( 'Education_web_aboutus' );

    }

endif;

add_action( 'widgets_init', 'Education_web_aboutus' );