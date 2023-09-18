<?php
/**
 * Main Custom admin functions area
 *
 * @since OffshoreThemes
 *
 * @param Education Web
 *
 */

if ( ! function_exists( 'education_web_comment' ) ) :
  /**
   * Comment Callback function.
   *
   * @since 1.0.0
   */
    function education_web_comment($comment, $args, $depth) { ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div class="comment-wrapper media" id="comment-<?php comment_ID(); ?>">
                
                <div class="head">
                  <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php echo get_avatar($comment, $size ='100' ); ?>
                  </a>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>

                     <em><?php esc_html_e('Your comment is awaiting moderation.','education-web') ?></em>  

                <?php endif; ?>

                <div class="media-body">

                      <div class="comment-heading">
                        <h4 class="media-heading"><?php echo esc_attr( get_comment_author_link() ); ?></h4>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                          <?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time()); ?>
                        </a>
                      </div>
                      
                    <div class="commentbody">
                      <?php comment_text() ?>
                      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>
            
        </li>

        <?php
    }

endif;


/**
 * Sets the Educenter Template Instead of front-page.
 */
function education_web_fp_template_set( $template ) {
  $education_web_set_original_fp = get_theme_mod( 'education_web_set_original_fp' ,false);
  if( true != $education_web_set_original_fp ){
    if ( 'posts' == get_option( 'show_on_front' ) ) {
      include( get_home_template() );
    } else {
      include( get_page_template() );
    }
  }
}
add_filter( 'education_web_enable_front_page', 'education_web_fp_template_set' );




if ( ! function_exists( 'education_web_breadcrumb' ) ) :

  /**
   * Breadcrumb.
   *
   * @since 1.0.0
   */
  function education_web_breadcrumb() {

    if ( ! function_exists( 'breadcrumb_trail' ) ) {
      require_once trailingslashit( get_template_directory() ) . '/offshorethemes/breadcrumbs/breadcrumbs.php';
    }

    $breadcrumb_args = array(
      'container'   => 'div',
      'show_browse' => false,
    );

    breadcrumb_trail( $breadcrumb_args );

  }

endif;


if ( ! function_exists( 'education_web_add_breadcrumb' ) ) :

  /**
   * Add breadcrumb.
   *
   * @since 1.0.0
   */
  function education_web_add_breadcrumb() {

    // Bail if home page.
    if ( is_front_page() || is_home() ) {
      return;
    }  ?>

    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>
                      <?php 
                        if( is_category() || is_archive() ){

                            the_archive_title( '<span>', '</span>' );

                        }elseif( is_search() ){

                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'education-web' ), '<span>' . get_search_query() . '</span>' );

                        }elseif( is_404() ){

                            esc_html_e('Error Page', 'education-web');

                        }else{

                             the_title(); 
                        }
                      ?>
                    </h2>
                    
                    <div id="breadcrumb" class="bread-list">

                        <?php education_web_breadcrumb(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

  <?php

  }

endif;

add_action( 'education_web_add_breadcrumb', 'education_web_add_breadcrumb', 10 );


if ( ! function_exists( 'education_web_footer_copyright' ) ):

    /**
     * Footer Copyright Information
     *
     * @since 1.0.0
    */

    function education_web_footer_copyright() {

        $copyright = ''; 

        if( !empty( $copyright ) ) { 

            echo apply_filters( 'education_web_copyright_text', $copyright . ' ' ); 

        } else { 
            echo esc_html( apply_filters( 'education_web_copyright_text', $content = esc_html__('Copyright  &copy; ','education-web') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );
        }

        printf( 'Sree Vidya Institutions' );   
    }

add_action( 'education_web_copyright', 'education_web_footer_copyright', 5 );

endif;


if ( ! function_exists( 'education_web_section_title' ) ) :
  /**
   * All Section Main Title & Sub Title
   *
   * @since 1.0.0
  */
  function education_web_section_title( $title, $subtitle ) { 
  
   if( !empty($title) || !empty($subtitle) ){ ?>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-title">
              <h2><?php echo esc_attr( $title ); ?></h2>
              <p><?php echo esc_html( $subtitle ); ?></p>
            </div>
        </div>
      </div>
    
    <?php }

  }

endif;
         

if ( ! function_exists( 'education_web_fonts_url' ) ) :

  /**
   * Return fonts URL.
   *
   * @since 1.0.0
   * @return string Font URL.
   */
  function education_web_fonts_url() {

    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'education-web' ) ) {
      $fonts[] = 'Roboto:300,400,500,700,900';
    }

    if ( 'off' !== _x( 'on', 'Lobster font: on or off', 'education-web' ) ) {
      $fonts[] = 'Lobster';
    }

    if ( 'off' !== _x( 'on', 'Roboto Slab font: on or off', 'education-web' ) ) {
      $fonts[] = 'Roboto Slab:300,400,700';
    }

    /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
    /*if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'education-web' ) ) {
      $fonts[] = 'Montserrat:300,400,500,600,700';
    }*/

    if ( $fonts ) {
      $fonts_url = add_query_arg( array(
        'family' => urlencode( implode( '|', $fonts ) ),
        'subset' => urlencode( $subsets ),
      ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
  }

endif;

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function education_web_excerpt_length( $length ) {

  if( is_admin() ){

    return $length;
    
  }else{

    return 55;

  }

}
add_filter( 'excerpt_length', 'education_web_excerpt_length', 999 );
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function education_web_excerpt_more( $more ) {

    if( is_admin() ){

        return $more;
    }

    return '...';
}
add_filter( 'excerpt_more', 'education_web_excerpt_more' );


/**
 * Social Media Links
*/
if ( ! function_exists( 'education_web_social_links' ) ) {
    function education_web_social_links() { ?>
        <ul class="social">
            <?php if (esc_url( get_theme_mod('education_web_social_facebook') )) :?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod('education_web_social_facebook') );?>">
                      <i class="fa fa-facebook"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (esc_url(get_theme_mod('education_web_social_twitter'))) :?>
                <li> 
                  <a href="<?php echo esc_url( get_theme_mod('education_web_social_twitter') ); ?>">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('education_web_social_googleplus'))) :?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('education_web_social_googleplus')); ?>">
                    <i class="fa fa-google-plus"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('education_web_social_instagram'))) : ?>
                <li> 
                  <a href="<?php echo esc_url(get_theme_mod('education_web_social_instagram')) ;?>">
                    <i class="fa fa-instagram"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('education_web_social_pinterest'))) : ?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('education_web_social_pinterest')); ?>">
                    <i class="fa fa-pinterest"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('education_web_social_linkedin'))) : ?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('education_web_social_linkedin')); ?>">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('education_web_social_youtube'))) : ?>
                <li> 
                  <a href="<?php echo esc_url(get_theme_mod('education_web_social_youtube')); ?>">
                    <span class="fa fa-youtube"></i>
                  </a>
               </li>
            <?php endif;?>
        </ul>
      <?php 
    }
}
add_action('educationweb-sociallinks','education_web_social_links', 5);


/**
 * Custom Control for Customizer Settings
*/
if( class_exists( 'WP_Customize_control') ) {

    /**
     * Switch Custom Control Function
    */
    class Education_Web_Switch_Control extends WP_Customize_Control {
        public $type = 'switch';    
        public function render_content() { ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <div class="switch_options">
                    <span class="switch_enable"><?php esc_html_e('Enable', 'education-web'); ?></span>
                    <span class="switch_disable"><?php esc_html_e('Disable', 'education-web'); ?></span>  
                    <input type="hidden" id="enable_prev_next" <?php esc_url( $this->link() ); ?> value="<?php echo esc_attr( $this->value() ); ?>" />                           
                </div>
            </label>
        <?php   
        }
    }

    /**
     * Repeater Custom Control Function
    */
    class Education_Web_Repeater_Controler extends WP_Customize_Control {
      /**
       * The control type.
       *
       * @access public
       * @var string
      */
      public $type = 'repeater';

      public $education_web_box_label = '';

      public $education_web_box_add_control = '';

      private $cats = '';

      /**
       * The fields that each container row will contain.
       *
       * @access public
       * @var array
      */
      public $fields = array();

      /**
       * Repeater drag and drop controler
       *
       * @since  1.0.0
      */
      public function __construct( $manager, $id, $args = array(), $fields = array() ) {
        $this->fields = $fields;
        $this->education_web_box_label = $args['education_web_box_label'] ;
        $this->education_web_box_add_control = $args['education_web_box_add_control'];
        $this->cats = get_categories(array( 'hide_empty' => false ));
        parent::__construct( $manager, $id, $args );
      }

      public function render_content() {
        $values = json_decode($this->value());
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if($this->description){ ?>
          <span class="description customize-control-description">
          <?php echo wp_kses_post($this->description); ?>
          </span>
        <?php } ?>

        <ul class="education-web-repeater-field-control-wrap">
          <?php $this->education_web_get_fields(); ?>
        </ul>
        <input type="hidden" <?php esc_attr( $this->link() ); ?> class="education-web-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
        <button type="button" class="button education-web-add-control-field"><?php echo esc_html( $this->education_web_box_add_control ); ?></button>
        <?php
      }

      private function education_web_get_fields(){
        $fields = $this->fields;
        $values = json_decode($this->value());
        if(is_array($values)){
        foreach($values as $value){    ?>
          <li class="education-web-repeater-field-control">
            <h3 class="education-web-repeater-field-title accordion-section-title"><?php echo esc_html( $this->education_web_box_label ); ?></h3>
            <div class="education-web-repeater-fields">
              <?php
                foreach ($fields as $key => $field) {
                $class = isset( $field['class'] ) ? $field['class'] : '';
              ?>
                <div class="education-web-fields education-web-type-<?php echo esc_attr( $field['type'] ).' '.esc_attr( $class ); ?>">
                  <?php
                    $label = isset($field['label']) ? $field['label'] : '';
                    $description = isset($field['description']) ? $field['description'] : '';
                    if($field['type'] != 'checkbox'){ ?>
                      <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                  <?php }

                    $new_value = isset($value->$key) ? $value->$key : '';
                    $default = isset($field['default']) ? $field['default'] : '';

                    switch ( $field['type'] ) {
                      case 'text':
                        echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                        break;

                      case 'textarea':
                        echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
                        break;

                      case 'select':
                        $options = $field['options'];
                        echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                              foreach ( $options as $option => $val )
                              {
                                  printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                              }
                        echo '</select>';
                        break;

                      case 'upload':
                        $image = $image_class= "";
                        if($new_value){
                          $image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';
                          $image_class = ' hidden';
                        }
                        echo '<div class="education-web-fields-wrap">';
                        echo '<div class="attachment-media-view">';
                        echo '<div class="placeholder'.esc_attr( $image_class ).'">';
                        esc_html_e('No image selected', 'education-web');
                        echo '</div>';
                        echo '<div class="thumbnail thumbnail-image">';
                        echo esc_attr( $image );
                        echo '</div>';
                        echo '<div class="actions clearfix">';
                        echo '<button type="button" class="button education-web-delete-button align-left">'.esc_html__('Remove', 'education-web').'</button>';
                        echo '<button type="button" class="button education-web-upload-button alignright">'.esc_html__('Select Image', 'education-web').'</button>';
                        echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr( $key ).'" type="hidden" value="'.esc_attr($new_value).'"/>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        break;

                      case 'icon':
                        echo '<div class="education-web-selected-icon">';
                        echo '<i class="'.esc_attr($new_value).'"></i>';
                        echo '<span><i class="fa fa-angle-down"></i></span>';
                        echo '</div>';
                        echo '<ul class="education-web-icon-list clearfix">';
                        $education_web_font_awesome_icon_array = education_web_font_awesome_icon_array();
                        foreach ($education_web_font_awesome_icon_array as $education_web_font_awesome_icon) {
                          $icon_class = $new_value == $education_web_font_awesome_icon ? 'icon-active' : '';
                          echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $education_web_font_awesome_icon ).'"></i></li>';
                        }
                        echo '</ul>';
                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                        break;

                      default:
                        break;
                    }
                  ?>
                </div>
              <?php } ?>
              <div class="clearfix education-web-repeater-footer">
                <div class="alignright">
                  <a class="education-web-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'education-web') ?></a> |
                  <a class="education-web-repeater-field-close" href="#close"><?php esc_html_e('Close', 'education-web') ?></a>
                </div>
              </div>
            </div>
          </li>
        <?php }
        }
      }
    }

    /**
     * Multiple Category Select Custom Control Function
    */
    class Education_Web_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

       /**
        * The type of customize control being rendered.
        *
        * @since  1.0.0
        * @access public
        * @var    string
        */
       public $type = 'checkbox-multiple';

       /**
        * Displays the control content.
        *
        * @since  1.0.0
        * @access public
        * @return void
        */
       public function render_content() {

           if ( empty( $this->choices ) )
               return; ?>
             
           <?php if ( !empty( $this->label ) ) : ?>
               <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
           <?php endif; ?>

           <?php if ( !empty( $this->description ) ) : ?>
               <span class="description customize-control-description"><?php echo esc_attr( $this->description ); ?></span>
           <?php endif; ?>

           <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
           <ul>
               <?php foreach ( $this->choices as $value => $label ) : ?>
                   <li>
                       <label>
                           <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                           <?php echo esc_html( $label ); ?>
                       </label>
                   </li>
               <?php endforeach; ?>
           </ul>
           <input type="hidden" <?php esc_url( $this->link() ); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
       <?php }
    }

    /**
     * Info Test Custom Control Function
    */
    class Education_Web_Customize_Control_Info_Text extends WP_Customize_Control{
        public function render_content(){ ?>
          <span class="customize-control-title">
          <?php echo esc_html( $this->label ); ?>
        </span>
        <?php if( $this->description ){ ?>
          <span class="description customize-control-description">
            <?php echo wp_kses_post( $this->description ); ?>
          </span>
        <?php }
        }
    }

    /**
     * Multiple Gallery Image Upload Custom Control Function
    */
    class Education_Web_Display_Gallery_Control extends WP_Customize_Control{
        public $type = 'gallery';         
        public function render_content() { ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <div class="gallery-screenshot clearfix">
              <?php
                  {
                  $ids = explode( ',', $this->value() );
                      foreach ( $ids as $attachment_id ) {
                          $img = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                          echo '<div class="screen-thumb"><img src="' . esc_url( $img[0] ) . '" /></div>';
                      }
                  }
              ?>
            </div>

            <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_html_e('Add/Edit Gallery','education-web') ?>" />
            <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_html_e('Clear','education-web') ?>" />
            <input type="hidden" class="gallery_values" <?php echo esc_url( $this->link() ); ?> value="<?php echo esc_attr( $this->value() ); ?>">
        </label>
        <?php }
    }


    /**
     * Section Re-order
    */
    class Education_Web_Section_Re_Order extends WP_Customize_Control {
      
      public $type = 'dragndrop';
        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content() {

        if ( empty( $this->choices ) ){
          return;
        }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

              <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <ul class="controls" id ="tm-sections-reorder">
          <?php
              $default_short_array = array();
              foreach ( $this->choices as $value => $label ) {

                  $default_short_array[$value] = $label;

              }

              $order_save_value = get_theme_mod( $this->id );
              
          if( !empty( $order_save_value ) ) {

            $order_save_array = explode( ',' , $order_save_value);

            $order_save_array_pop = array_pop( $order_save_array );

            foreach ($order_save_array as $key => $value) {
          ?>
            <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $default_short_array[$value] ); ?></li>
          <?php 

            }
            $section_order_list = $order_save_value;

          } else {
          $order_array = array();
          foreach ( $this->choices as $value => $label ) {
            $order_array[] = $value;            
          ?>
            <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $label ); ?></li>
          <?php }
              $section_order_list = implode ( "," , $order_array );
            }
          ?>
          <input id="shortui-order" type="hidden" <?php $this->link(); ?> value="<?php echo wp_kses_post( $section_order_list ); ?>" />  
        </ul>        
        <?php
      }
    }
}