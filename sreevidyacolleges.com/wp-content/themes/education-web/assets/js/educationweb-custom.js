jQuery(document).ready(function($){

	/**
	 * Sticky Header
	*/
	$(".header-inner").sticky({ 
		topSpacing: 0
	});

	/**
	 * Search Popup
	*/
	$('.search').click(function() {
		$('.ed-pop-up').toggleClass('active');
	});

	$('.search-overlay').click(function() {
		$('.ed-pop-up').removeClass('active');
	});

	/**
	 * Widget Sticky sidebar
	*/
	$('.content-area').theiaStickySidebar({
	    additionalMarginTop: 30
	});

	$('.widget-area').theiaStickySidebar({
	    additionalMarginTop: 30
	});
	

	/**
	 * Main Slider One
	*/ 
	$(".slider-one").owlCarousel({
		loop:true,
		autoplay:true,
		smartSpeed: 700,
		autoplayTimeout:4500,
		autoplayHoverPause:true,
		center:false,
		nav:true,
		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		dots:true,
		items:1,
		responsive:{
			300: {
				nav:false,
			},
			480: {
				nav:false,
			},
			768: {
				nav:false,
			},
			1170: {
				nav:true,
			},
		}
	});

	/**
	 * Testimonial JS
	*/ 
	$(".testimonial-carousel").owlCarousel({
		loop:true,
		autoplay:true,
		smartSpeed: 700,
		center:false,
		margin:15,
		nav:false,
		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		dots:true,
		responsive:{
			300: {
				items: 1,
			},
			480: {
				items: 1,
			},
			768: {
				items: 2,
			},
			1170: {
				items: 2,
			},
		}
	});

	/**
	 * Clients Carousel
	*/ 
	$(".clients-slider").owlCarousel({
		loop:true,
		autoplay:true,
		smartSpeed: 500,
		autoplayTimeout:3000,
		margin:30,
		nav:false,
		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		dots:false,
		responsive:{
			300: {
				items: 2,
			},
			480: {
				items: 3,
			},
			768: {
				items: 4,
			},
			1170: {
				items: 5,
			},
		}
	});

	/**
	 * Gallery Light Box
	*/

	$("a[rel^='edugallery']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: true,
        deeplinking : false,
        default_width: 500,
        default_height: 344,
    });

    /**
	 * Counter JS
	*/
	$('.number').counterUp({
		time: 1000
	});

	/**
	 * Blogs Posts Slider
	*/ 
	$(".blog-slider").owlCarousel({
		loop:true,
		autoplay:true,
		smartSpeed: 700,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
		margin:30,
		nav: true,
		dots:false,
		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		responsive:{
			300: {
				items: 1,
			},
			480: {
				items: 1,
			},
			768: {
				items: 2,
			},
			1170: {
				items: 3,
			},
		}
	});


	/**
	 * Why Choose Services Area
	*/
	$('.service-excerpt h5').click(function(){
		$(this).next('.service-text').slideToggle();
		$(this).parents('.service-post').toggleClass('active');
	});

	$('.service-icon').click(function(){
		$(this).next('.service-excerpt').find('.service-text').slideToggle();
		$(this).parent('.service-post').toggleClass('active');
	});

	/**
	 * Scroll To Top
	*/
	$("#footer").on('click', '.goToTop', function(e){
		e.preventDefault();
		$('html,body').animate({
			scrollTop: 0,
		},'slow');
	});
	// Show/Hide Button on Window Scroll event.
	$(window).on('scroll', function(){
		var fromTop = $(this).scrollTop();
		var display = 'none';
		if(fromTop > 650){
			display = 'block';
		}
		$('#scrollTop').css({'display': display});
	});

	/*==== nav toggle =====*/
	$(".mobile-nav").click(function(){
	    $(".nav-area").toggle();
	});

});
