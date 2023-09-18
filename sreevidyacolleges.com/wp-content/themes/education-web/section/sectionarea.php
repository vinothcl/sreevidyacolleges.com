<?php
/**
 * Main Custom admin functions area
 *
 * @since OffshoreThemes
 *
 * @param Education Web
 *
 */

if ( ! function_exists( 'education_web_slider_section' ) ) :
	/**
	 * Main Slider Section
	*
	* @since 1.0.0
	*/
    function education_web_slider_section() { 

    	if( get_theme_mod( 'education_web_slider_options', 1 ) == 1 ){ 

    		$all_slider = wp_kses_post( get_theme_mod('education_web_banner_all_sliders') ); 

    		if(!empty( $all_slider )) { ?>

		    	<section class="hero-area">
					<div class="slider-one">
						<?php
							$count = 0;
							$banner_slider = json_decode( $all_slider );
							foreach($banner_slider as $slider){ 
								$page_id = $slider->slider_page;
								if( !empty( $page_id ) ) {
								$slider_page = new WP_Query( 'page_id='.$page_id );								
							if( $slider_page->have_posts() ) { while( $slider_page->have_posts() ) { $slider_page->the_post();
							$image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-slider', true );
						?>
						<div class="single-slider" style="background-image:url(<?php echo esc_url( $image_path[0] ); ?>)">
							<div class="edu-overlay"></div>	
							<div class="container">
								<div class="row">
									<div class="col-md-7 col-sm-12 <?php if ($count % 2 != 0){ echo esc_attr('col-md-offset-5'); } ?> col-xs-12">
										<div class="slide-text <?php if ($count % 2 != 0){ echo esc_attr('right'); } ?>">										
											<h2><?php the_title(); ?></h2>
											<p><?php echo esc_attr( wp_trim_words( get_the_content(), 20 ) ); ?></p>
											<?php if( $slider->button_text || $slider->button_url ){ ?>
												<div class="slide-btn">	
													<a href="<?php echo esc_url( $slider->button_url ); ?>" class="btn primary">
														<?php echo esc_attr( $slider->button_text ); ?><i class="fa fa-play"></i>
													</a>
												</div>
											<?php } ?>
										</div><!--/ End SLider Text -->
									</div>
								</div>
							</div>
						</div><!--/ End Single Slider -->
						<?php $count++; } } wp_reset_postdata(); } } ?> 
					</div>
				</section><!--/ End Hero Area -->

    <?php } }

    }

    add_action('educationweb_slider','education_web_slider_section', 5 );

endif;



if ( ! function_exists( 'education_web_services_section' ) ) :
	/**
	 * Main Services Section
	*
	* @since 1.0.0
	*/
    function education_web_services_section() { 

    	if( get_theme_mod( 'education_web_services_area_options', 1 ) == 1 ){ 

    		$featuresservices = wp_kses_post( get_theme_mod('education_web_services_area_settings') );

			$desclimit = get_theme_mod('education_web_services_text_limit', 25);

			if(!empty( $featuresservices )) { ?>

		    	<section class="features hs-section">
					<div class="container">
						<div class="row">
							<?php
								$count = 1;
								$allfeaturesservices = json_decode( $featuresservices );
								foreach($allfeaturesservices as $fservices){ 
									$page_id = $fservices->services_page;
									if( !empty( $page_id ) ) {
									$servicespage = new WP_Query( 'page_id='.$page_id );								
								if( $servicespage->have_posts() ) { while( $servicespage->have_posts() ) { $servicespage->the_post();
							?>
								<div class="features-single col-md-4 col-sm-6 col-xs-12 features-<?php echo intval( $count ); ?>">

									<?php if(!empty( $fservices->services_icon )){ ?>

										<i class="fa <?php echo esc_attr( $fservices->services_icon ); ?>"></i>

									<?php } ?>

									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

									<p><?php echo esc_attr( wp_trim_words( get_the_content(), $desclimit ) ); ?></p>

								</div>

							<?php $count++; } } wp_reset_postdata(); } } ?>					
						</div>
					</div>
				</section><!--/ End Features -->

    <?php } }

    }
    add_action('educationweb_services','education_web_services_section', 10 );

endif;


if ( ! function_exists( 'education_web_skill_section' ) ) :
	/**
	 * Main Skill Section
	*
	* @since 1.0.0
	*/
    function education_web_skill_section() { 

    	if( get_theme_mod( 'education_web_skill_section_area_options', 1 ) == 1 ){

    		$skillabout = get_theme_mod('education_web_skill_page');

			$allskill = get_theme_mod('education_web_skill_area_settings');

			if( !empty($skillabout) && !empty( $allskill ) ){
    	?>

	    	<section id="our-skill" class="our-skill hs-section">
				<div class="container">				
					
					<div class="row"> 
						<div class="col-md-6 col-sm-12 col-xs-12">
							<?php
								$skillabout = new WP_Query( 'page_id='.$skillabout  );

								if( $skillabout->have_posts() ) { while( $skillabout->have_posts() ) { $skillabout->the_post();
							?>
								<div class="skill-text">

									<h3><?php the_title(); ?></h3>
									
									<?php the_content(); ?>

								</div>
							<?php } }  wp_reset_postdata();?>
						</div>

						<div class="col-md-6 col-sm-12 col-xs-12">
							<?php 
								if(!empty( $allskill )) {
									$allskill = json_decode( $allskill );
									foreach($allskill as $skill){
							?>
								<div class="single-skill">
									<div class="skill-info">
										<h4><?php echo esc_attr( $skill->counter_title ); ?></h4>
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo intval( $skill->counter_number ); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo intval( $skill->counter_number ); ?>%;">
										<span class="percent"><?php echo intval( $skill->counter_number ); ?>%</span></div>
									</div>
								</div>
							<?php } } ?>
						</div>
					</div>

				</div>
			</section><!--/ End Services -->

    <?php } }

    }

    add_action('educationweb_skill','education_web_skill_section', 15 );

endif;



if ( ! function_exists( 'education_web_academics_section' ) ) :
	/**
	 * Main Academics Section
	*
	* @since 1.0.0
	*/
    function education_web_academics_section() { 

    	if( get_theme_mod( 'education_web_academics_section_area_options', 1 ) == 1 ){

    		$allacademics = wp_kses_post( get_theme_mod('education_web_academics_area_settings') );
							
			$desclimit = get_theme_mod('education_web_services_text_limit', 25);
			
			if(!empty( $allacademics )) { ?>

	    	<section id="academics" class="academics hs-section">
				<div class="container">				
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_academics_section_title');
						$subtitle = get_theme_mod('education_web_academics_section_subtitle');

						education_web_section_title( $title, $subtitle );
					?>
								
					<div class="row">
						<?php
							$allacademics = json_decode( $allacademics );

							foreach($allacademics as $academics){ 

								$page_id = $academics->academics_page;

								if( !empty( $page_id ) ) {

								$academic = new WP_Query( 'page_id='.$page_id );

							if( $academic->have_posts() ) { while( $academic->have_posts() ) { $academic->the_post();
						?>
							<div class="col-md-4 col-sm-6 col-xs-12">
							    <div class="academics-item">
							        <div class="icon">
							            <i class="fa <?php echo esc_attr( $academics->academics_icon ); ?>"></i>
							        </div>
							        <div class="edu-text">
								        <h3><?php the_title(); ?></h3>
								        <p><?php echo esc_attr( wp_trim_words( get_the_content(), $desclimit ) ); ?></p>
								        <a class="btn btn-rm btn-common" href="<?php the_permalink(); ?>"><?php esc_html_e('Explore','education-web'); ?></a>
							        </div>
							    </div>
							</div>

						<?php  } } wp_reset_postdata(); } } ?>	

					</div>
				</div>
			</section><!--/ End academics -->

    <?php } }

    }

    add_action('educationweb_academics','education_web_academics_section', 20 );

endif;


if ( ! function_exists( 'education_web_courses_section' ) ) :
	/**
	 * Main Courses Section
	*
	* @since 1.0.0
	*/
    function education_web_courses_section() { 

    	if( get_theme_mod( 'education_web_courses_section_area_options', 1 ) == 1 ){

    		$allcourse = wp_kses_post( get_theme_mod('education_web_course_area_settings') );
							
			$cdesclimit = get_theme_mod('education_web_course_text_limit', 20);
			
			if(!empty( $allcourse )) { ?>

	    	<section id="course" class="course hs-section">
				<div class="container">				
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_courses_section_title');
						$subtitle = get_theme_mod('education_web_courses_section_subtitle');

						education_web_section_title( $title, $subtitle );
					?>
								
					<div class="row">
						<?php
							$allcourse = json_decode( $allcourse );
							foreach($allcourse as $course){ 
								$course_price = $course->course_price;
								$page_id = $course->course_page;
								if( !empty( $page_id ) ) {
								$course = new WP_Query( 'page_id='.$page_id );

							if( $course->have_posts() ) { while( $course->have_posts() ) { $course->the_post();

							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-about', true );
						?>

						<div class="col-md-4 col-sm-6 col-xs-12">
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

    <?php } }

    }

    add_action('educationweb_courses','education_web_courses_section', 25 );

endif;


if ( ! function_exists( 'education_web_extra_services_section' ) ) :
	/**
	 * Main Extra Services Section
	*
	* @since 1.0.0
	*/
    function education_web_extra_services_section() { 

    	if( get_theme_mod( 'education_web_extra_services_area_options', 1 ) == 1 ){ 
    		
			$extraservices = wp_kses_post( get_theme_mod('education_web_extra_services_area_settings') );

			if(!empty( $extraservices )) { ?>

    		<section id="services" class="services hs-section">
				<div class="container">				
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_extra_services_main_title');
						$subtitle = get_theme_mod('education_web_extra_services_main_subtitle');

						education_web_section_title( $title, $subtitle );
					?>
								
					<div class="row">
						<?php
							$allextraservices = json_decode( $extraservices );

							foreach($allextraservices as $eservices){ 

								$page_id = $eservices->extra_services_page;

								if( !empty( $page_id ) ) {

								$eservicespage = new WP_Query( 'page_id='.$page_id );

							if( $eservicespage->have_posts() ) { while( $eservicespage->have_posts() ) { $eservicespage->the_post();
						?>

							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="featured-post">
									<?php if(!empty( $eservices->extra_services_icon )){ ?>
										<div class="featured-icon">
											<i class="fa <?php echo esc_attr( $eservices->extra_services_icon ); ?>"></i>
										</div>
									<?php } ?>
									<h3><?php the_title(); ?></h3>
									<div class="featured-excerpt">
										<?php echo esc_attr( wp_trim_words( get_the_content(), 25 ) ); ?>
										<div class="featured-link">
											<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','education-web'); ?></a>
										</div>
									</div>
								</div>
							</div><!--/ End Single Service -->

						<?php } } wp_reset_postdata(); } } ?>

					</div>
				</div>
			</section><!--/ End Services -->

    <?php } }

    }

    add_action('educationweb_extraservices','education_web_extra_services_section', 30 );

endif;



if ( ! function_exists( 'education_web_why_choose_section' ) ) :
	/**
	 * Main Why Choose Section
	*
	* @since 1.0.0
	*/
    function education_web_why_choose_section() { 

    	if( get_theme_mod( 'education_web_why_choose_section_area_options', 1 ) == 1 ){ 
    		
			$aboutbgimg = get_theme_mod('education_web_why_choose_page_features_image');

			$aboutservices = wp_kses_post( get_theme_mod('education_web_why_choose_area_settings') );

			if(!empty( $aboutservices )) { ?>

		    	<section id="service-post-section" class="whysection hs-section">

					<?php if( !empty( $aboutbgimg ) ){ ?>

				    	<div class="service-left-bg" style="background-image:url(<?php echo esc_url( $aboutbgimg ); ?>)"></div>
				   
				    <?php } ?>

				    <div class="container">
				        <div class="service-posts clearfix">
				            <?php
								/**
								 * Section Title & SubTitle
								*/
								$title    = get_theme_mod('education_web_why_choose_main_title');
								$subtitle = get_theme_mod('education_web_why_choose_main_subtitle');
							?>
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
									$allaboutservices = json_decode( $aboutservices );
									foreach($allaboutservices as $aservices){ 
										$page_id = $aservices->about_services_page;
										if( !empty( $page_id ) ) {

										$whychoose = new WP_Query( 'page_id='.$page_id  );

									if( $whychoose->have_posts() ) { while( $whychoose->have_posts() ) { $whychoose->the_post();
								?>
					            	<div class="service-post clearfix">
					                    
					                    <div class="service-icon"><i class="fa <?php echo esc_attr(  $aservices->about_icon ); ?>"></i></div>
					                    
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
				                <?php } } wp_reset_postdata(); } } ?>
				            </div>
				        </div>
				    </div>
				</section>

    <?php } }

    }

    add_action('educationweb_whychoose','education_web_why_choose_section', 35 );

endif;



if ( ! function_exists( 'education_web_faq_section' ) ) :
	/**
	 * Faq Section
	*
	* @since 1.0.0
	*/
    function education_web_faq_section() { 

    	if( get_theme_mod( 'education_web_faq_area_options', 1 ) == 1 ){
    		
			$allfaq = wp_kses_post( get_theme_mod('education_web_faq_area_settings') );

			$featuresimg = get_theme_mod('education_web_faq_features_image');

			if(!empty( $allfaq )) { ?>

			<section id="faq" class="faq hs-section">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_faq_section_title');
						$subtitle = get_theme_mod('education_web_faq_section_subtitle');

						education_web_section_title( $title, $subtitle );

					?>
					<div class="row">
						<div class="col-md-7 col-sm-12 col-xs-12">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								
								<?php
									$count = 0;
									$allfaq = json_decode( $allfaq );

									foreach($allfaq as $faq){ 

										$page_id    = $faq->faq_page;

									if( !empty( $page_id ) ) {

									$faqpage = new WP_Query( 'page_id='.$page_id );

									if( $faqpage->have_posts() ) { while( $faqpage->have_posts() ) { $faqpage->the_post();
								?>
									<div class="panel panel-default <?php if( $count == 0 ){ ?>active<?php } ?>">
										<div class="faq-heading" id="FaqTitle<?php echo intval($count); ?>">
										  <h4 class="faq-title">
											<a <?php if( $count != 0 ){ ?>class="collapsed"<?php } ?> data-toggle="collapse" data-parent="#accordion" href="#faq<?php echo intval($count); ?>"><?php the_title(); ?></a>
										  </h4>
										</div>
										<div id="faq<?php echo intval($count); ?>" class="panel-collapse collapse <?php if( $count == 0 ){ ?>in<?php } ?>" role="tabpanel" aria-labelledby="FaqTitle<?php echo intval($count); ?>">
										  <div class="faq-body"><?php the_content(); ?></div>
										</div>
									</div>

								<?php } $count++; } wp_reset_postdata(); } } ?>

							</div>
						</div>

						<?php if( !empty( $featuresimg ) ){ ?>
							<div class="col-md-5">
								<div class="faq-image">
									<img src="<?php echo esc_url( $featuresimg ); ?>" alt="<?php esc_html_e( 'Image preview', 'education-web' ); ?>">
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		    

    <?php } }

    }

    add_action('educationweb_faq','education_web_faq_section', 40 );

endif;


if ( ! function_exists( 'education_web_gallery_section' ) ) :
	/**
	 * Gallery Section
	*
	* @since 1.0.0
	*/
    function education_web_gallery_section() { 

    	if( get_theme_mod( 'education_web_gallery_area_options', 1 ) == 1 ){
    		
			$allgallery = get_theme_mod('education_web_client_logo_image');

			if(!empty( $allgallery )){ ?>

			<section id="projects" class="projects hs-section">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_gallery_section_title');
						$subtitle = get_theme_mod('education_web_gallery_section_subtitle');

						education_web_section_title( $title, $subtitle );
					?>
									
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="project-item">
								<div class="cbp-wrapper-outer">
									<div class="cbp-wrapper">
										<?php 
											$allgallery = explode(',', $allgallery);

											foreach ($allgallery as $gallery) {

												$image = wp_get_attachment_image_src( $gallery, 'education-web-gallery', true);
										?>
											<div class="cbp-item col-md-4 col-sm-6 col-xs-12">
												<div class="cbp-item-wrapper">
													<div class="project-single">
														<div class="project-inner">
															<div class="project-head">
																<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_html_e( 'Image preview', 'education-web' ); ?>">
															</div>
															<div class="button">
																<a href="<?php echo esc_url( $image[0] ); ?>" rel="edugallery[edu]" class="btn">
																	<i class="fa fa-photo"></i>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>

										<?php } ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</section>

    <?php } }

    }

    add_action('educationweb_gallery','education_web_gallery_section', 45 );

endif;




if ( ! function_exists( 'education_web_team_section' ) ) :
	/**
	 * Our Team Member Section
	*
	* @since 1.0.0
	*/
    function education_web_team_section() { 

    	if( get_theme_mod( 'education_web_team_area_options', 1 ) == 1 ){
    		
			
			$allmember = wp_kses_post( get_theme_mod('education_web_team_area_settings') );

			if(!empty( $allmember )) { ?>

				<section id="team" class="team hs-section">
					<div class="container">
						<?php
							/**
							 * Section Title & SubTitle
							*/
							$title = get_theme_mod('education_web_team_area_title');
							$subtitle = get_theme_mod('education_web_team_area_subtitle');

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

    <?php } }

    }

    add_action('educationweb_team','education_web_team_section', 50 );

endif;



if ( ! function_exists( 'education_web_counter_section' ) ) :
	/**
	 * Counter Section
	*
	* @since 1.0.0
	*/
    function education_web_counter_section() { 

    	if( get_theme_mod( 'education_web_counter_section_area_options', 1 ) == 1 ){
    		
			
			$allcounter = wp_kses_post( get_theme_mod('education_web_counter_area_settings') );
			
			if(!empty( $allcounter )) { ?>

			<section id="counter" class="counter hs-section">
				<div class="container">
					<div class="row">
						<?php
							$allcounter = json_decode( $allcounter );
							foreach($allcounter as $counter){ 
								$countericon = $counter->counter_icon;
								$counternumber = $counter->counter_number;
								$countertitle = $counter->counter_title;
						?>
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="counter-single">
									<div class="icon">
										<i class="fa <?php echo esc_attr( $countericon ); ?>"></i>
									</div>
									<div class="s-info">
										<span class="number"><?php echo esc_attr( $counternumber ); ?></span>
										<p><?php echo esc_attr( $countertitle ); ?></p>
									</div>
								</div><!--/ End Single Counter-->
							</div>
						<?php } ?>
						
					</div>
				</div>
			</section><!--/ End Counter -->

    <?php } }

    }

    add_action('educationweb_counter','education_web_counter_section', 55 );

endif;



if ( ! function_exists( 'education_web_testimonials_section' ) ) :
	/**
	 * Testimonials Section
	*
	* @since 1.0.0
	*/
    function education_web_testimonials_section() { 

    	if( get_theme_mod( 'education_web_testimonial_area_options', 1 ) == 1 ){
    		
			$alltestimonial = wp_kses_post( get_theme_mod('education_web_testimonial_area_settings') );
			
			if(!empty( $alltestimonial )) { ?>

			<section id="testimonials" class="testimonials hs-section">
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
							<div class="testimonial-carousel">
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

    <?php } }

    }

    add_action('educationweb_testimonials','education_web_testimonials_section', 60 );

endif;



if ( ! function_exists( 'education_web_blogs_section' ) ) :
	/**
	 * Testimonials Section
	*
	* @since 1.0.0
	*/
    function education_web_blogs_section() { 

    	if( get_theme_mod( 'education_web_blog_area_options', 1 ) == 1 ){  ?>
			
			<section id="blog-main" class="blog-main hs-section">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_blog_title');
						$subtitle = get_theme_mod('education_web_blog_subtitle');

						education_web_section_title( $title, $subtitle );
					?>
					<div class="row">
						<div class="blog-main clearfix">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="blog-list">
									<?php
										$category = get_theme_mod('education_web_blog_area_term_id',1);
										$catid = explode(',', $category);
										$args = array(
								            'post_type' => 'post',
								            'posts_per_page' => 2,
								            'tax_query' => array(
								                array(
								                    'taxonomy' => 'category',
								                    'field' => 'term_id',
								                    'terms' => $catid
								                ),
								            ),
								        );

								        $query = new WP_Query($args);

								        while ($query->have_posts()) { $query->the_post();

				                    	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-web-blog', true );
									?>
										<div class="col-md-6 col-sm-6 col-xs-12 ed-blog-section">
										    <div class="news-grid-item">
										        <div class="news-grid-img">
										            <div class="news-thum-area">
									                    <a href="<?php the_permalink(); ?>">
									                        <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>"> </a>
									                </div>
									                <div class="news-content-area">
									                    <div class="news-content">
									                    	
									                        <?php education_web_posted_on(); ?>

									                        <h3 class="news-title">
									                        	<a href="<?php the_permalink(); ?>">
									                        		<?php the_title(); ?>
									                        	</a>
									                        </h3>
									                        <p><?php the_excerpt(); ?></p>

									                        <a href="<?php the_permalink(); ?>" class="btn btn-common btn-sm">
									                        	<?php esc_html_e('Read More','education-web'); ?>
									                        </a>
									                    </div>
									                </div>
										        </div>
										    </div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</section><!--/ End Blog -->	

    <?php } 

    }

    add_action('educationweb_blog','education_web_blogs_section', 65 );

endif;


if ( ! function_exists( 'education_web_brand_logo_section' ) ) :
	/**
	 * Testimonials Section
	*
	* @since 1.0.0
	*/
    function education_web_brand_logo_section() { 

    	if( get_theme_mod( 'education_web_brand_area_options', 1 ) == 1 ){ 

    	$allclientlogo = wp_kses_post( get_theme_mod('education_web_brand_area_settings') );

		if(!empty( $allclientlogo )) { ?>
			
			<section id="clients" class="clients hs-section">
				<div class="container">
					<?php
						/**
						 * Section Title & SubTitle
						*/
						$title = get_theme_mod('education_web_brand_area_title');
						$subtitle = get_theme_mod('education_web_brand_area_subtitle');

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
											<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_html_e( 'Brand Logo Image', 'education-web' ); ?>">
										</a>
									</div><!--/ End Single Clients -->
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
			</section><!--/ End Clients -->	
 
    <?php } }

    }

    add_action('educationweb_clientlogo','education_web_brand_logo_section', 70 );

endif;
