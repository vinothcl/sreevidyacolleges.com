<?php
/**
 * Education Web Theme Customizer
 *
 * @package Education Web
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_web_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


/**
 * List All Pages
*/
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Page','education-web');
foreach ($slider_pages_obj as $page) {
  $slider_pages[$page->ID] = $page->post_title;
}

/**
 * List All Category
*/
$categories = get_categories( );
$education_web_cat = array();
foreach( $categories as $category ) {
    $education_web_cat[$category->term_id] = $category->name;
}


	/**
	 * Option to get the frontpage settings to the old default template if a static frontpage is selected
	*/
	$wp_customize->get_section('static_front_page' )->priority = 2;

	$wp_customize->add_setting( 'education_web_set_original_fp', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => false
	));
	$wp_customize->add_control( 'education_web_set_original_fp', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Use Education Web Style frontpage?','education-web' ),
		'section' => 'static_front_page'
	));

/**
 * Important Link
*/
$wp_customize->add_section('education_web_implink_link_section',array(
	'title' 			=> esc_html__( 'Important Links', 'education-web' ),
	'priority'			=> 2
));

	$wp_customize->add_setting('education_web_implink_link_options', array(
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( new Education_Web_Customize_Control_Info_Text( $wp_customize, 'education_web_implink_link_options', array(
		'settings'		=> 'education_web_implink_link_options',
		'section'		=> 'education_web_implink_link_section',
		'description'	=> '<a class="education-web-implink" href="https://www.youtube.com/channel/UC5jA2Dxj0mHB23rudgdgEqg" target="_blank">'.esc_html__('Documentation', 'education-web').'</a><a class="education-web-implink" href="https://offshorethemes.com/demo/educationweb/" target="_blank">'.esc_html__('Live Demo', 'education-web').'</a><a class="education-web-implink" href="https://offshorethemes.com/support/" target="_blank">'.esc_html__('Support Forum', 'education-web').'</a><a class="education-web-implink" href="#" target="_blank">'.esc_html__('Like Us in Facebook', 'education-web').'</a>',
	)));


/**
 * General Settings Panel
*/
$wp_customize->add_panel('education_web_general_settings', array(
   'priority' => 3,
   'title' => esc_html__('General Settings', 'education-web')
));
	
	/**
     * Logo & Tagline Settings
    */
	$wp_customize->add_section( 'title_tagline', array(
	     'title' => esc_html__( 'Site Logo/Title/Tagline', 'education-web' ),
	     'panel' => 'education_web_general_settings',
	) );

	/**
     * Background Settings
    */
	$wp_customize->add_section( 'background_image', array(
	     'title' => esc_html__( 'Background Image', 'education-web' ),
	     'panel' => 'education_web_general_settings',
	) );

	/**
     * Theme Color Settings
    */
	$wp_customize->add_section( 'colors', array(
	     'title' => esc_html__( 'Colors Settings' , 'education-web'),
	     'panel' => 'education_web_general_settings',
	) );


	/**
	 * Top Header Settings Panel
	*/
	$wp_customize->add_panel('education_web_top_header_settings', array(
	   'priority' => 3,
	   'title' => esc_html__('Top Header Settings', 'education-web')
	));

		/**
		 * Top Header Quick Contact Information Settings Area 
		*/
		$wp_customize->add_section( 'education_web_header_quickinfo', array(
		    'priority'       => 1,
		    'title'          => esc_html__( 'Quick Contact Information', 'education-web' ),
		    'panel' => 'education_web_top_header_settings',
		) );
		 
			$wp_customize->add_setting('education_web_email_address', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_email',  // done
			));

			$wp_customize->add_control('education_web_email_address',array(
				'type' => 'text',
				'label' => esc_html__('Email Address', 'education-web'),
				'section' => 'education_web_header_quickinfo',
				'setting' => 'education_web_email_address'
			));

			$wp_customize->add_setting('education_web_phone_number', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',  // done
			));  

			$wp_customize->add_control('education_web_phone_number',array(
				'type' => 'text',
				'label' => esc_html__('Phone Number', 'education-web'),
				'section' => 'education_web_header_quickinfo',
			'setting' => 'education_web_phone_number'
			));

			$wp_customize->add_setting('education_web_map_address', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',  // done
			));

			$wp_customize->add_control('education_web_map_address',array(
				'type' => 'text',
				'label' => esc_html__('Address', 'education-web'),
				'section' => 'education_web_header_quickinfo',
				'setting' => 'education_web_map_address'
			));

			$wp_customize->add_setting('education_web_opeening_time', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',  // done
			));

			$wp_customize->add_control('education_web_opeening_time',array(
				'type' => 'text',
				'label' => esc_html__('Opeening Time', 'education-web'),
				'section' => 'education_web_header_quickinfo',
				'setting' => 'education_web_opeening_time'
			));

		/**
		 * Top Header Social Icon Settings Area 
		*/
		$wp_customize->add_section('education_web_social_link_activate_settings', array(
		    'priority' => 2,
		    'title'    => esc_html__('Social Media Link Options', 'education-web'),
		    'panel' => 'education_web_top_header_settings',
		));

		    $education_web_social_links = array( 
		        'education_web_social_facebook' => array(
		            'id' => 'education_web_social_facebook',
		            'title' => esc_html__('Facebook', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_twitter' => array(
		            'id' => 'education_web_social_twitter',
		            'title' => esc_html__('Twitter', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_googleplus' => array(
		            'id' => 'education_web_social_googleplus',
		            'title' => esc_html__('Google-Plus', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_instagram' => array(
		            'id' => 'education_web_social_instagram',
		            'title' => esc_html__('Instagram', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_pinterest' => array(
		            'id' => 'education_web_social_pinterest',
		            'title' => esc_html__('Pinterest', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_linkedin' => array(
		            'id' => 'education_web_social_linkedin',
		            'title' => esc_html__('Linkedin', 'education-web'),
		            'default' => '',
		        ),
		        'education_web_social_youtube' => array(
		            'id' => 'education_web_social_youtube',
		            'title' => esc_html__('YouTube', 'education-web'),
		            'default' => '',
		        )
		    );

		    $i = 20;
		    foreach($education_web_social_links as $education_web_social_link) {
		        $wp_customize->add_setting($education_web_social_link['id'], array(
		            'default' => $education_web_social_link['default'],
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        ));

		        $wp_customize->add_control($education_web_social_link['id'], array(
		            'label' => $education_web_social_link['title'],
		            'section'=> 'education_web_social_link_activate_settings',
		            'settings'=> $education_web_social_link['id'],
		            'priority' => $i
		        ));

		        $i++;
		    }

		/**
		 * Main Header Settings
		*/
		$wp_customize->add_section( 'education_web_main_header', array(
			'title'           => esc_html__('Main Header Settings', 'education-web'),
			'priority'        => 4,
		));

			$wp_customize->add_setting( 'education_web_top_header', array(
				'default'            =>  0,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_top_header', 
				array(
					'section'       => 'education_web_main_header',
					'label'         =>  esc_html__('Disable Top Header?', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Top Header','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


		/**
		 * Banner Slider
		*/
		$wp_customize->add_section( 'education_web_banner_slider', array(
			'title'           => esc_html__('Main Banner Slider Settings', 'education-web'),
			'priority'        => 4,
		));

			$wp_customize->add_setting( 'education_web_slider_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_slider_options', 
				array(
					'section'       => 'education_web_banner_slider',
					'label'         =>  esc_html__('Choose Enable/Disable Slider', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Sticky Menu','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));

		    /**
		     * Slider Settings Area
		    */
	        $wp_customize->add_setting( 'education_web_banner_all_sliders', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	                  'slider_page' => '' ,
	                  'button_text' => '',
	                  'button_url' => ''
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_banner_all_sliders', array(
	          'label'   => esc_html__('Slider Settings Area','education-web'),
	          'section' => 'education_web_banner_slider',
	          'settings' => 'education_web_banner_all_sliders',
	          'education_web_box_label' => esc_html__('Slider Settings Options','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Slider','education-web'),
	        ),
	        array(
				'slider_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Slider Page', 'education-web' ),
					'options'   => $slider_pages
				),
				'button_text' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Button Text', 'education-web' ),
					'default'   => ''
				),
				'button_url' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Button Url', 'education-web' ),
					'default'   => ''
				)	          
	        )));


	/**
	 * Header Settings
	*/
	$wp_customize->get_section('header_image')->title = esc_html__( 'Inner Page Background Images', 'education-web' );
	$wp_customize->get_section('header_image' )->priority = 5;


	/**
	 * HomePage Settings Panel
	*/
	$wp_customize->add_panel('education_web_homepage_settings', array(
	   'priority' => 5,
	   'title' => esc_html__('HomePage Section Area', 'education-web')
	));

		/**
		 * Section Reorder
		*/
		$wp_customize->add_section( 'education_web_homepage_section_reorder', array(
		    'title'		=> esc_html__( 'Section Re Order', 'education-web' ),
		    'panel'     => 'education_web_homepage_settings',
		    'priority'  => 1,
		) );
		
		$wp_customize->add_setting( 'education_web_homepage_section_order_list', array(
		    'default' => '',
		    'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( new Education_Web_Section_Re_Order( $wp_customize, 'education_web_homepage_section_order_list', array(
		    'type' => 'dragndrop',
		    'priority'  => 3,
		    'label' => esc_html__( 'Section Re Order', 'education-web' ),
		    'section' => 'education_web_homepage_section_reorder',
			    'choices'   => array(
			        'features'  	=> esc_html__( 'Features Services', 'education-web' ),
			        'skill'  		=> esc_html__( 'Skill Section', 'education-web' ),
			        'academics'     => esc_html__( 'Academics Section', 'education-web' ),
			        'courses'      	=> esc_html__( 'Courses Area', 'education-web' ),
			        'extraservices' => esc_html__( 'Extra Services Area', 'education-web' ),
			        'whychoose'     => esc_html__( 'Why Choose Section', 'education-web' ),
			        'gallery'    	=> esc_html__( 'Gallery Section', 'education-web' ),
			        'counter'       => esc_html__( 'Counter Section', 'education-web' ),
			        'ourteam'       => esc_html__( 'Our Team Member', 'education-web' ),
			        'testimonial'  	=> esc_html__( 'Testimonial Area', 'education-web' ),
			        'faq' 			=> esc_html__( 'FAQ Section', 'education-web' ),		                            
			        'ourblog'   	=> esc_html__( 'Our Blogs', 'education-web' ),                    
			        'clientlogo' 	=> esc_html__( 'Our Client/Brand', 'education-web' )
			    ),
		) ) );


		/**
		 * Features Services Area
		*/
		$wp_customize->add_section( 'education_web_services_settings', array(
			'title'           => esc_html__('Features Services Settings', 'education-web'),
			'priority'        => 1,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_services_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_services_area_options', 
				array(
					'section'       => 'education_web_services_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Featues Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));

			$wp_customize->add_setting('education_web_services_text_limit', array(
			    'default'       =>      25,
			    'sanitize_callback' => 'absint'
			));

			$wp_customize->add_control('education_web_services_text_limit', array(
			    'section'    => 'education_web_services_settings',
			    'label'      => esc_html__('Enter Services Descriptions Limit', 'education-web'),
			    'type'       => 'number'  
			));

		    /**
		     * Feature Services Settings Area
		    */
	        $wp_customize->add_setting( 'education_web_services_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'services_icon' => 'fa fa-desktop',
	                  'services_page' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_services_area_settings', array(
	          'label'   => esc_html__('Features Services Settings Area','education-web'),
	          'section' => 'education_web_services_settings',
	          'settings' => 'education_web_services_area_settings',
	          'education_web_box_label' => esc_html__('Features Services','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Services','education-web'),
	        ),
	        array(
				'services_icon' => array(
					'type'      => 'icon',
					'label'     => esc_html__( 'Select Services Icon', 'education-web' ),
					'default'   => 'fa fa-desktop'
				),
				'services_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Services Page', 'education-web' ),
					'options'   => $slider_pages
				)          
	        )));


		
		/**
		 * Our Skill Section
		*/
		$wp_customize->add_section( 'education_web_skill_settings', array(
			'title'           => esc_html__('Skill Section Settings', 'education-web'),
			'priority'        => 2,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_skill_section_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_skill_section_area_options', 
				array(
					'section'       => 'education_web_skill_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Skill Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_skill_page', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'absint'
			));

			$wp_customize->add_control('education_web_skill_page', array(
			    'section'    => 'education_web_skill_settings',
			    'label'      => esc_html__('Select Skill Page', 'education-web'),
			    'type'       => 'dropdown-pages'  
			));

		    /**
		     * Skill Details
		    */
	        $wp_customize->add_setting( 'education_web_skill_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'counter_number' => '',
	                  'counter_title' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_skill_area_settings', array(
	          'label'   => esc_html__('Skill Settings Area','education-web'),
	          'section' => 'education_web_skill_settings',
	          'settings' => 'education_web_skill_area_settings',
	          'education_web_box_label' => esc_html__('Skill Settings Area','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Skill','education-web'),
	        ),
	        array(
				'counter_number' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Counter Number', 'education-web' ),
					'default'   => ''
				),
				'counter_title' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Skill Title', 'education-web' ),
					'default'   => ''
				)         
	        )));



	    /**
		 * Academics Departments Section
		*/
		$wp_customize->add_section( 'education_web_academics_settings', array(
			'title'           => esc_html__('Academics Section Settings', 'education-web'),
			'priority'        => 3,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_academics_section_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_academics_section_area_options', 
				array(
					'section'       => 'education_web_academics_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Academics Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_academics_section_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_academics_section_title', array(
			    'section'    => 'education_web_academics_settings',
			    'label'      => esc_html__('Enter Academics Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_academics_section_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_academics_section_subtitle', array(
			    'section'    => 'education_web_academics_settings',
			    'label'      => esc_html__('Enter Academics Main Sub Title', 'education-web'),
			    'type'       => 'text'  
			));


		    /**
		     * About Section Mission/Vision/Plan Pages Add
		    */
	        $wp_customize->add_setting( 'education_web_academics_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'academics_icon' => 'fa fa-desktop',
	                  'academics_page' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_academics_area_settings', array(
	          'label'   => esc_html__('Academics Settings Area','education-web'),
	          'section' => 'education_web_academics_settings',
	          'settings' => 'education_web_academics_area_settings',
	          'education_web_box_label' => esc_html__('Academics Area','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Academics','education-web'),
	        ),
	        array(
				'academics_icon' => array(
					'type'      => 'icon',
					'label'     => esc_html__( 'Select Academics Icon', 'education-web' ),
					'default'   => 'fa fa-desktop'
				),
				'academics_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Academics Page', 'education-web' ),
					'options'   => $slider_pages
				)          
	        )));


	    /**
		 * Courses Section
		*/
		$wp_customize->add_section( 'education_web_courses_settings', array(
			'title'           => esc_html__('Courses Section Settings', 'education-web'),
			'priority'        => 4,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_courses_section_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_courses_section_area_options', 
				array(
					'section'       => 'education_web_courses_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Courses Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_courses_section_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_courses_section_title', array(
			    'section'    => 'education_web_courses_settings',
			    'label'      => esc_html__('Enter Courses Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_courses_section_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_courses_section_subtitle', array(
			    'section'    => 'education_web_courses_settings',
			    'label'      => esc_html__('Enter Courses Main Sub Title', 'education-web'),
			    'type'       => 'text'  
			));


			$wp_customize->add_setting('education_web_course_text_limit', array(
			    'default'           =>  20,
			    'sanitize_callback' => 'absint'
			));

			$wp_customize->add_control('education_web_course_text_limit', array(
			    'section'    => 'education_web_courses_settings',
			    'label'      => esc_html__('Enter Course Descriptions Limit', 'education-web'),
			    'type'       => 'number'  
			));


		    /**
		     * Course Section Settings
		    */
	        $wp_customize->add_setting( 'education_web_course_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	                  'course_page' => '',
	                  'course_price' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_course_area_settings', array(
				'label'   => esc_html__('Course Settings Area','education-web'),
				'section' => 'education_web_courses_settings',
				'settings' => 'education_web_course_area_settings',
				'education_web_box_label' => esc_html__('Course settings Area','education-web'),
				'education_web_box_add_control' => esc_html__('Add New Course','education-web'),
	        ),
	        array(
				'course_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Academics Page', 'education-web' ),
					'options'   => $slider_pages
				),
				'course_price' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Course Price', 'education-web' ),
					'default'   => ''
				),      
	        )));


		/**
		 * Extra Services Area
		*/
		$wp_customize->add_section( 'education_web_extra_services_settings', array(
			'title'           => esc_html__('Extra Services Settings', 'education-web'),
			'priority'        => 5,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_extra_services_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_extra_services_area_options', 
				array(
					'section'       => 'education_web_extra_services_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Extra Services','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_extra_services_main_title', array(
			    'default'       =>   '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_extra_services_main_title', array(
			    'section'    => 'education_web_extra_services_settings',
			    'label'      => esc_html__('Enter Services Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_extra_services_main_subtitle', array(
			    'default'       =>  '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_extra_services_main_subtitle', array(
			    'section'    => 'education_web_extra_services_settings',
			    'label'      => esc_html__('Enter Services Sub Title', 'education-web'),
			    'type'       => 'text'  
			));


		    /**
		     * Extra Services Settings Area
		    */
	        $wp_customize->add_setting( 'education_web_extra_services_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'extra_services_icon' => 'fa fa-desktop',
	                  'extra_services_page' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_extra_services_area_settings', array(
	          'label'   => esc_html__('Extra Services Settings Area','education-web'),
	          'section' => 'education_web_extra_services_settings',
	          'settings' => 'education_web_extra_services_area_settings',
	          'education_web_box_label' => esc_html__('Extra Services','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Services','education-web'),
	        ),
	        array(
				'extra_services_icon' => array(
					'type'      => 'icon',
					'label'     => esc_html__( 'Select Services Icon', 'education-web' ),
					'default'   => 'fa fa-desktop'
				),
				'extra_services_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Services Page', 'education-web' ),
					'options'   => $slider_pages
				)          
	        )));


		/**
		 * Why Choose Secton Area
		*/
		$wp_customize->add_section( 'education_web_why_choose_settings', array(
			'title'           => esc_html__('Why Choose Section Settings', 'education-web'),
			'priority'        => 6,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_why_choose_section_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_why_choose_section_area_options', 
				array(
					'section'       => 'education_web_why_choose_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Why Choose Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_why_choose_main_title', array(
			    'default'       =>   '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_why_choose_main_title', array(
			    'section'    => 'education_web_why_choose_settings',
			    'label'      => esc_html__('Enter Why Choose Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_why_choose_main_subtitle', array(
			    'default'       =>  '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_why_choose_main_subtitle', array(
			    'section'    => 'education_web_why_choose_settings',
			    'label'      => esc_html__('Enter Why Choose Sub Title', 'education-web'),
			    'type'       => 'text'  
			));



			$wp_customize->add_setting( 'education_web_why_choose_page_features_image', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'esc_url_raw'
    		));
    		
    		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'education_web_why_choose_page_features_image', array(
    		    'section'       => 'education_web_why_choose_settings',
    		    'label'         => esc_html__('Why Choose Section Features Image', 'education-web'),
    		    'type'          => 'image',
    		)));

		    /**
		     * Why Choose Pages Area
		    */
	        $wp_customize->add_setting( 'education_web_why_choose_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'about_icon' => 'fa fa-desktop',
	                  'about_services_page' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_why_choose_area_settings', array(
	          'label'   => esc_html__('Why Choose Settings Area','education-web'),
	          'section' => 'education_web_why_choose_settings',
	          'settings' => 'education_web_why_choose_area_settings',
	          'education_web_box_label' => esc_html__('Why Choose Plan Pages','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Page','education-web'),
	        ),
	        array(
				'about_icon' => array(
					'type'      => 'icon',
					'label'     => esc_html__( 'Select Why Choose Icon', 'education-web' ),
					'default'   => 'fa fa-desktop'
				),
				'about_services_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Why Choose Page', 'education-web' ),
					'options'   => $slider_pages
				)          
	        )));



	    /**
		 * Gallery Section
		*/
		$wp_customize->add_section( 'education_web_gallery_settings', array(
			'title'           => esc_html__('Gallery Section Settings', 'education-web'),
			'priority'        => 7,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_gallery_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_gallery_area_options', 
				array(
					'section'       => 'education_web_gallery_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Gallery Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_gallery_section_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_gallery_section_title', array(
			    'section'    => 'education_web_gallery_settings',
			    'label'      => esc_html__('Enter Gallery Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_gallery_section_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_gallery_section_subtitle', array(
			    'section'    => 'education_web_gallery_settings',
			    'label'      => esc_html__('Enter Gallery Main SubTitle', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting( 'education_web_client_logo_image', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field' // Done
			) );

			$wp_customize->add_control( new Education_Web_Display_Gallery_Control( $wp_customize, 'education_web_client_logo_image', array(
				'settings'		=> 'education_web_client_logo_image',
				'section'		=> 'education_web_gallery_settings',
				'label'			=> esc_html__( 'Upload Gallery Images', 'education-web' ),
			)));


	    /**
		 * Counter Secton Area
		*/
		$wp_customize->add_section( 'education_web_counter_settings', array(
			'title'           => esc_html__('Counter Section Settings', 'education-web'),
			'priority'        => 8,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_counter_section_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_counter_section_area_options', 
				array(
					'section'       => 'education_web_counter_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Counter Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting( 'education_web_counter_bg_image', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'esc_url_raw'
    		));
    		
    		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'education_web_counter_bg_image', array(
    		    'section'       => 'education_web_counter_settings',
    		    'label'         => esc_html__('Upload Counter BG Image', 'education-web'),
    		    'type'          => 'image',
    		)));

		    /**
		     * Counter Details
		    */
	        $wp_customize->add_setting( 'education_web_counter_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'counter_icon' => 'fa fa-desktop',
	            	  'counter_number' => '',
	                  'counter_title' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_counter_area_settings', array(
	          'label'   => esc_html__('Counter Settings Area','education-web'),
	          'section' => 'education_web_counter_settings',
	          'settings' => 'education_web_counter_area_settings',
	          'education_web_box_label' => esc_html__('Counter Settings Area','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Counter','education-web'),
	        ),
	        array(
				'counter_icon' => array(
					'type'      => 'icon',
					'label'     => esc_html__( 'Select Counter Icon', 'education-web' ),
					'default'   => 'fa fa-desktop'
				),
				'counter_number' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Counter Number', 'education-web' ),
					'default'   => ''
				),
				'counter_title' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Counter Title', 'education-web' ),
					'default'   => ''
				)         
	        )));	    


		/**
		 * Our Team Member Area
		*/
		$wp_customize->add_section( 'education_web_team_settings', array(
			'title'           => esc_html__('Our Team Settings', 'education-web'),
			'priority'        => 9,
			'panel'			  => 'education_web_homepage_settings'
		));


			$wp_customize->add_setting( 'education_web_team_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_team_area_options', 
				array(
					'section'       => 'education_web_team_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Team Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));

			$wp_customize->add_setting('education_web_team_area_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_team_area_title', array(
			    'section'    => 'education_web_team_settings',
			    'label'      => esc_html__('Enter Team Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_team_area_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_team_area_subtitle', array(
			    'section'    => 'education_web_team_settings',
			    'label'      => esc_html__('Enter Team Sub Title', 'education-web'),
			    'type'       => 'text'  
			));

		    /**
		     * Team Settings Area
		    */
	        $wp_customize->add_setting( 'education_web_team_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	            	  'team_page' => '',
	                  'team_position' => '',
	                  'team_facebook' => '',
	                  'team_twitter' => '',
	                  'team_instagram' => '',
	                  'team_linkedin' => '',
	                  'team_google_plus' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_team_area_settings', array(
	          'label'   => esc_html__('Team Settings Area','education-web'),
	          'section' => 'education_web_team_settings',
	          'settings' => 'education_web_team_area_settings',
	          'education_web_box_label' => esc_html__('Our Team Settings','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New Team','education-web'),
	        ),
	        array(
				'team_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select Team Page', 'education-web' ),
					'options'   => $slider_pages
				),
				'team_position' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Position', 'education-web' ),
					'default'   => ''
				),
				'team_facebook' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Facebook Link', 'education-web' ),
					'default'   => ''
				),
				'team_twitter' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Twitter Link', 'education-web' ),
					'default'   => ''
				),
				'team_google_plus' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Googel Plus', 'education-web' ),
					'default'   => ''
				),
				'team_instagram' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Instagram', 'education-web' ),
					'default'   => ''
				),
				'team_linkedin' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Member Linkedin', 'education-web' ),
					'default'   => ''
				)        
	        )));


    	/**
    	 * Testimonial Area
    	*/
    	$wp_customize->add_section( 'education_web_testimonial_settings', array(
    		'title'           => esc_html__('Our Testimonial Settings', 'education-web'),
    		'priority'        => 10,
    		'panel'			  => 'education_web_homepage_settings'
    	));
    		
    		$wp_customize->add_setting( 'education_web_testimonial_area_options', array(
    			'default'            =>  1,
    			'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
    		));

    		$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_testimonial_area_options', 
    			array(
    				'section'       => 'education_web_testimonial_settings',
    				'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
    				'type'          =>  'switch',
    				'description'   =>  esc_html__('Choose Options to Disable Testimonial Section','education-web'),
    				'output'        =>  array('Enable', 'Disable')
    			)
    		));

    		$wp_customize->add_setting('education_web_testimonial_title', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'sanitize_text_field'
    		));

    		$wp_customize->add_control('education_web_testimonial_title', array(
    		    'section'    => 'education_web_testimonial_settings',
    		    'label'      => esc_html__('Enter Testimonial Title', 'education-web'),
    		    'type'       => 'text'  
    		));


    	    /**
    	     * Testimonial Settings Area
    	    */
            $wp_customize->add_setting( 'education_web_testimonial_area_settings', array(
              'sanitize_callback' => 'education_web_sanitize_repeater',
              'default' => json_encode( array(
                array(
                      'testimonial_page' => '',
                      'testimonial_company' => ''
                    )
                ) )        
            ));

            $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_testimonial_area_settings', array(
              'label'   => esc_html__('Testimonial Settings Area','education-web'),
              'section' => 'education_web_testimonial_settings',
              'settings' => 'education_web_testimonial_area_settings',
              'education_web_box_label' => esc_html__('Testimonial Settings','education-web'),
              'education_web_box_add_control' => esc_html__('Add New Testimonial','education-web'),
            ),
            array(
    			'testimonial_page' => array(
    				'type'      => 'select',
    				'label'     => esc_html__( 'Select Testimonial Page', 'education-web' ),
    				'options'   => $slider_pages
    			),
    			'testimonial_company' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Compnay Name', 'education-web' ),
					'default'   => ''
				),         
            )));


        /**
		 * FAQ Section
		*/
		$wp_customize->add_section( 'education_web_faq_settings', array(
			'title'           => esc_html__('FAQ Section Settings', 'education-web'),
			'priority'        => 11,
			'panel'			  => 'education_web_homepage_settings'
		));

			$wp_customize->add_setting( 'education_web_faq_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_faq_area_options', 
				array(
					'section'       => 'education_web_faq_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable FAQ Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));


			$wp_customize->add_setting('education_web_faq_section_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_faq_section_title', array(
			    'section'    => 'education_web_faq_settings',
			    'label'      => esc_html__('Enter FAQ Main Title', 'education-web'),
			    'type'       => 'text'  
			));

			$wp_customize->add_setting('education_web_faq_section_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_faq_section_subtitle', array(
			    'section'    => 'education_web_faq_settings',
			    'label'      => esc_html__('Enter FAQ Main SubTitle', 'education-web'),
			    'type'       => 'text'  
			));

		    /**
		     * FAQ Section Settings Area
		    */
	        $wp_customize->add_setting( 'education_web_faq_area_settings', array(
	          'sanitize_callback' => 'education_web_sanitize_repeater',
	          'default' => json_encode( array(
	            array(
	                  'faq_page' => '' 
	                )
	            ) )        
	        ));

	        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_faq_area_settings', array(
	          'label'   => esc_html__('FAQ Services Settings','education-web'),
	          'section' => 'education_web_faq_settings',
	          'settings' => 'education_web_faq_area_settings',
	          'education_web_box_label' => esc_html__('FAQ Services Area','education-web'),
	          'education_web_box_add_control' => esc_html__('Add New FAQ','education-web'),
	        ),
	        array(
				'faq_page' => array(
					'type'      => 'select',
					'label'     => esc_html__( 'Select FAQ Page', 'education-web' ),
					'options'   => $slider_pages
				)          
	        )));


	        $wp_customize->add_setting( 'education_web_faq_features_image', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'esc_url_raw'
    		));
    		
    		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'education_web_faq_features_image', array(
    		    'section'       => 'education_web_faq_settings',
    		    'label'         => esc_html__('Upload FAQ BG Image', 'education-web'),
    		    'type'          => 'image',
    		)));
    	


		/**
		 * Our Blogs Area
		*/
		$wp_customize->add_section( 'education_web_blog_settings', array(
			'title'           => esc_html__('Our Blogs Settings', 'education-web'),
			'priority'        => 12,
			'panel'			  => 'education_web_homepage_settings'
		));


			$wp_customize->add_setting( 'education_web_blog_area_options', array(
				'default'            =>  1,
				'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
			));

			$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_blog_area_options', 
				array(
					'section'       => 'education_web_blog_settings',
					'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
					'type'          =>  'switch',
					'description'   =>  esc_html__('Choose Options to Disable Blog Section','education-web'),
					'output'        =>  array('Enable', 'Disable')
				)
			));

			$wp_customize->add_setting('education_web_blog_title', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_blog_title', array(
			    'section'    => 'education_web_blog_settings',
			    'label'      => esc_html__('Enter Blog Title', 'education-web'),
			    'type'       => 'text'  
			));


			$wp_customize->add_setting('education_web_blog_subtitle', array(
			    'default'       =>      '',
			    'sanitize_callback' => 'sanitize_text_field'
			));

			$wp_customize->add_control('education_web_blog_subtitle', array(
			    'section'    => 'education_web_blog_settings',
			    'label'      => esc_html__('Enter Blog Sub Title', 'education-web'),
			    'type'       => 'text'  
			));


			$wp_customize->add_setting( 'education_web_blog_area_term_id', array(
				'default'			=> '',
				'sanitize_callback' => 'sanitize_text_field'
			) );
			
			$wp_customize->add_control( new Education_Web_Customize_Control_Checkbox_Multiple( $wp_customize, 'education_web_blog_area_term_id', array(
		        'label' => esc_html__( 'Select Blog Cateogry', 'education-web' ),
		        'section' => 'education_web_blog_settings',
		        'settings' => 'education_web_blog_area_term_id',
		        'choices' => $education_web_cat
		    ) ) );



    	/**
    	 * Our Brand Logo Area
    	*/
    	$wp_customize->add_section( 'education_web_brand_logo_settings', array(
    		'title'           => esc_html__('Our Client/Brand Logo Settings', 'education-web'),
    		'priority'        => 13,
    		'panel'			  => 'education_web_homepage_settings'
    	));


    		$wp_customize->add_setting( 'education_web_brand_area_options', array(
    			'default'            =>  1,
    			'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
    		));

    		$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_brand_area_options', 
    			array(
    				'section'       => 'education_web_brand_logo_settings',
    				'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
    				'type'          =>  'switch',
    				'description'   =>  esc_html__('Choose Options to Disable Client Logo Section','education-web'),
    				'output'        =>  array('Enable', 'Disable')
    			)
    		));


    		$wp_customize->add_setting('education_web_brand_area_title', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'sanitize_text_field'
    		));

    		$wp_customize->add_control('education_web_brand_area_title', array(
    		    'section'    => 'education_web_brand_logo_settings',
    		    'label'      => esc_html__('Enter Client/Brand Logo Title', 'education-web'),
    		    'type'       => 'text'  
    		));

    		$wp_customize->add_setting('education_web_brand_area_subtitle', array(
    		    'default'       =>      '',
    		    'sanitize_callback' => 'sanitize_text_field'
    		));

    		$wp_customize->add_control('education_web_brand_area_subtitle', array(
    		    'section'    => 'education_web_brand_logo_settings',
    		    'label'      => esc_html__('Enter Client/Brand Logo Sub Title', 'education-web'),
    		    'type'       => 'text'  
    		));


	    /**
	     * Client/Brand Logo Settings Area
	    */
        $wp_customize->add_setting( 'education_web_brand_area_settings', array(
          'sanitize_callback' => 'education_web_sanitize_repeater',
          'default' => json_encode( array(
            array(
                    'brand_logo' => '',
                    'brank_link' => ''
                )
            ) )        
        ));

        $wp_customize->add_control( new Education_Web_Repeater_Controler( $wp_customize, 'education_web_brand_area_settings', array(
          'label'   => esc_html__('Client/Brand Logo Settings Area','education-web'),
          'section' => 'education_web_brand_logo_settings',
          'settings' => 'education_web_brand_area_settings',
          'education_web_box_label' => esc_html__('Client/Brand Logo Settings','education-web'),
          'education_web_box_add_control' => esc_html__('Add New Logo','education-web'),
        ),
        array(
			'brand_logo' => array(
				'type'      => 'upload',
				'label'     => esc_html__( 'Update Client/Brand Logo', 'education-web' ),
				'default'   => ''
			),
			'brank_link' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Enter Client Logo Link', 'education-web' ),
				'default'   => ''
			),       
        )));


    /**
	 * Footer Call To Action
	*/
	$wp_customize->add_section( 'education_web_cta_settings', array(
		'title'           => esc_html__('Footer Call To Action', 'education-web'),
		'priority'        => 14,
		'panel'			  => 'education_web_homepage_settings'
	));


		$wp_customize->add_setting( 'education_web_cta_area_options', array(
			'default'            =>  1,
			'sanitize_callback'  =>  'education_web_enabledisable_sanitize',
		));

		$wp_customize->add_control(new Education_Web_Switch_Control( $wp_customize,'education_web_cta_area_options', 
			array(
				'section'       => 'education_web_cta_settings',
				'label'         =>  esc_html__('Choose Enable/Disable Section', 'education-web'),
				'type'          =>  'switch',
				'description'   =>  esc_html__('Choose Options to Disable Call To Action Section','education-web'),
				'output'        =>  array('Enable', 'Disable')
			)
		));


		$wp_customize->add_setting('education_web_cta_area_text', array(
		    'default'       =>      '',
		    'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control('education_web_cta_area_text', array(
		    'section'    => 'education_web_cta_settings',
		    'label'      => esc_html__('Enter Call To Action Text', 'education-web'),
		    'type'       => 'text'  
		));

		$wp_customize->add_setting('education_web_cta_button_text', array(
		    'default'       =>      '',
		    'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control('education_web_cta_button_text', array(
		    'section'    => 'education_web_cta_settings',
		    'label'      => esc_html__('Enter Button Text', 'education-web'),
		    'type'       => 'text'  
		));

		$wp_customize->add_setting('education_web_cta_button_url', array(
		    'default'       =>      '',
		    'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control('education_web_cta_button_url', array(
		    'section'    => 'education_web_cta_settings',
		    'label'      => esc_html__('Enter Button URL', 'education-web'),
		    'type'       => 'url'  
		));



	/**
	 * Web Layout Sanitization
	*/
	function education_web_web_layout($input) {
	  $valid_keys = array( 
	    'boxed' => esc_html__('Boxed Layout', 'education-web'),
	    'fullwidth' => esc_html__('Fullwidth Layout', 'education-web')
	  );
	  if ( array_key_exists( $input, $valid_keys ) ) {
	     return $input;
	  } else {
	     return '';
	  }
	}


	/**
	 *
	*/
	function education_web_select_sanitize($input) {
	  $valid_keys = array( 
		'layout1' => esc_html__( 'Layout One','education-web' ),
		'layout2' => esc_html__( 'Layout Two','education-web' )
	  );
	  if ( array_key_exists( $input, $valid_keys ) ) {
	     return $input;
	  } else {
	     return '';
	  }
	}

	/**
	 * Switch(Enable/Diable) Sanitization Function
	*/
	function education_web_enabledisable_sanitize($input) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}


	/**
	 * Repeat Fields Sanitization
	*/
	function education_web_sanitize_repeater($input){        
	  $input_decoded = json_decode( $input, true );
	  $allowed_html = array(
	    'br' => array(),
	    'em' => array(),
	    'strong' => array(),
	    'a' => array(
	      'href' => array(),
	      'class' => array(),
	      'id' => array(),
	      'target' => array()
	    ),
	    'button' => array(
	      'class' => array(),
	      'id' => array()
	    )
	  ); 

	  if(!empty($input_decoded)) {
	    foreach ($input_decoded as $boxes => $box ){
	      foreach ($box as $key => $value){
	        $input_decoded[$boxes][$key] = sanitize_text_field( $value );
	      }
	    }
	    return json_encode($input_decoded);
	  }      
	  return $input;
	}
}
add_action( 'customize_register', 'education_web_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_web_customize_preview_js() {
	wp_enqueue_script( 'education_web_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'education_web_customize_preview_js' );
