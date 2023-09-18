/**
 * Widget Custom JS
*/
(function ( $, window, document, undefined ) {
    'use strict';
    var waf_document = $(document);

    waf_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = $(this);
        var media_title = $(this).data('title');
        var media_button = $(this).data('button');
        var media_input_val = $(this).prev();
        var media_image_url_value = $(this).prev().prev().children('img');
        var media_image_url = $(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                WAFREFRESHVALUE(media_image_upload.closest("p"));
            }
        });
    });

    // Runs when the image button is clicked.
    jQuery('body').on('click','.media-image-remove', function(e){
        $(this).siblings('.img-preview-wrap').hide();
        $(this).prev().prev().val('');
    });


    /*sortable*/
    var WAFREFRESHVALUE = function (wrapObject) {
        wrapObject.find('[name]').each(function(){
            $(this).trigger('change');
        });
    };
    var WAFSORTABLE = function () {
        var repeaters = $('.sp-repeater');
        repeaters.sortable({
            orientation: "vertical",
            items: '> .repeater-table',
            placeholder: 'sp-sortable-placeholder',
            update: function( event, ui ) {
                WAFREFRESHVALUE(ui.item);
            }
        });
        repeaters.trigger("sortupdate");
        repeaters.sortable("refresh");
    };

    /*replace*/
    var WAFREPLACE = function( str, replaceWhat, replaceTo ){
        var re = new RegExp(replaceWhat, 'g');
        return str.replace(re,replaceTo);
    };
    var WAFREPEATER =  function (){
        waf_document.on('click','.sp-add-repeater',function (e) {
            e.preventDefault();
            var add_repeater = $(this),
                repeater_wrap = add_repeater.closest('.sp-repeater'),
                code_for_repeater = repeater_wrap.find('.sp-code-for-repeater'),
                total_repeater = repeater_wrap.find('.sp-total-repeater'),
                total_repeater_value = parseInt( total_repeater.val() ),
                repeater_html = code_for_repeater.html();

            total_repeater.val( total_repeater_value +1 );
            var final_repeater_html = WAFREPLACE( repeater_html, add_repeater.attr('id'),total_repeater_value );
            add_repeater.before($('<div class="repeater-table"></div>').append( final_repeater_html ));
            var new_html_object = add_repeater.prev('.repeater-table');
            var repeater_inside = new_html_object.find('.sp-repeater-inside');
            repeater_inside.slideDown( 'fast',function () {
                new_html_object.addClass( 'open' );
                WAFREFRESHVALUE(new_html_object);
            } );

        });
        waf_document.on('click', '.sp-repeater-top, .sp-repeater-close', function (e) {
            e.preventDefault();
            var accordion_toggle = $(this),
                repeater_field = accordion_toggle.closest('.repeater-table'),
                repeater_inside = repeater_field.find('.sp-repeater-inside');

            if ( repeater_inside.is( ':hidden' ) ) {
                repeater_inside.slideDown( 'fast',function () {
                    repeater_field.addClass( 'open' );
                } );
            }
            else {
                repeater_inside.slideUp( 'fast', function() {
                    repeater_field.removeClass( 'open' );
                });
            }
        });
        waf_document.on('click', '.sp-repeater-remove', function (e) {
            e.preventDefault();
            var repeater_remove = $(this),
                repeater_field = repeater_remove.closest('.repeater-table'),
                repeater_wrap = repeater_remove.closest('.sp-repeater');

            repeater_field.remove();
            WAFREFRESHVALUE(repeater_wrap);
        });

        waf_document.on('change', '.sp-select', function (e) {
            e.preventDefault();
            var select = $(this),
                repeater_inside = select.closest('.sp-repeater-inside'),
                postid = repeater_inside.find('.sp-postid'),
                postid_href = postid.attr('href'),
                postidhidden_href = postid.data('href'),
                optionSelected = select.find("option:selected"),
                valueSelected = optionSelected.val();
            if( valueSelected == 0 ){
                postid.addClass('hidden');
            }
            else{
                postid.removeClass('hidden');
            }

            postid_href = WAFREPLACE( postidhidden_href , 'POSTID',valueSelected );
            postid.attr('href',postid_href);
        });
    };

    /*call all methods on ready*/
    waf_document.ready( function() {
        waf_document.on('widget-added widget-updated', function( event, widgetContainer ) {
            WAFSORTABLE();
    });


    /**
     * Script for Customizer icons
    */
    waf_document.on('click', '.sp-icons-wrapper .single-icon', function() {
        var single_icon = $(this),
            at_customize_icons = single_icon.closest( '.sp-icons-wrapper' ),
            icon_display_value = single_icon.children('i').attr('class'),
            icon_split_value = icon_display_value.split(' '),
            icon_value = icon_split_value[1];

        single_icon.siblings().removeClass('selected');
        single_icon.addClass('selected');
        at_customize_icons.find('.sp-icon-value').val( icon_value );
        at_customize_icons.find('.icon-preview').html('<i class="' + icon_display_value + '"></i>');
        at_customize_icons.find('.sp-icon-value').trigger('change');
    });

    waf_document.on('click', '.sp-icons-wrapper .icon-toggle ,.sp-icons-wrapper .icon-preview', function() {
        var icon_toggle = $(this),
            at_customize_icons = icon_toggle.closest( '.sp-icons-wrapper' ),
            icons_list_wrapper = at_customize_icons.find( '.icons-list-wrapper' ),
            dashicons = at_customize_icons.find( '.dashicons' );

        if ( icons_list_wrapper.is(':hidden') ) {
            icons_list_wrapper.slideDown();
            dashicons.removeClass('dashicons-arrow-down');
            dashicons.addClass('dashicons-arrow-up');
        } else {
            icons_list_wrapper.slideUp();
            dashicons.addClass('dashicons-arrow-down');
            dashicons.removeClass('dashicons-arrow-up');
        }

    });
    waf_document.on('keyup', '.sp-icons-wrapper .icon-search', function() {
        var text = $(this),
            value = this.value,
            at_customize_icons = text.closest( '.sp-icons-wrapper' ),
            icons_list_wrapper = at_customize_icons.find( '.icons-list-wrapper' );

        icons_list_wrapper.find('i').each(function () {
            if ($(this).attr('class').search(value) > -1) {
                $(this).parent('.single-icon').show();
            } else {
                $(this).parent('.single-icon').hide();

            }
        });
    });

    /*
     * Manually trigger widget-added events for media widgets on the admin
     * screen once they are expanded. The widget-added event is not triggered
     * for each pre-existing widget on the widgets admin screen like it is
     * on the customizer. Likewise, the customizer only triggers widget-added
     * when the widget is expanded to just-in-time construct the widget form
     * when it is actually going to be displayed. So the following implements
     * the same for the widgets admin screen, to invoke the widget-added
     * handler when a pre-existing media widget is expanded.
     */
    $( function initializeExistingWidgetContainers() {
        var widgetContainers;
        if ( 'widgets' !== window.pagenow ) {
            return;
        }
        widgetContainers = $( '.widgets-holder-wrap:not(#available-widgets)' ).find( 'div.widget' );
        widgetContainers.one( 'click.toggle-widget-expanded', function toggleWidgetExpanded() {
            WAFSORTABLE();
        });
    });

    WAFREPEATER();

    });

})( jQuery, window, document );


jQuery(document).ready(function($){
    /**
     * Repeater Fields
    */
	function education_web_refresh_repeater_values(){
		$(".education-web-repeater-field-control-wrap").each(function(){			
			var values = []; 
			var $this = $(this);			
			$this.find(".education-web-repeater-field-control").each(function(){
			var valueToPush = {};
			$(this).find('[data-name]').each(function(){
				var dataName = $(this).attr('data-name');
				var dataValue = $(this).val();
				valueToPush[dataName] = dataValue;
			});
			values.push(valueToPush);
			});
			$this.next('.education-web-repeater-collector').val(JSON.stringify(values)).trigger('change');
		});
	}

    $('#customize-theme-controls').on('click','.education-web-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.education-web-repeater-field-control').toggleClass('expanded');
    });
    $('#customize-theme-controls').on('click', '.education-web-repeater-field-close', function(){
    	$(this).closest('.education-web-repeater-fields').slideUp();;
    	$(this).closest('.education-web-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.education-web-add-control-field', function(){
		var $this = $(this).parent();
		if(typeof $this != 'undefined') {
            var field = $this.find(".education-web-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){                
                field.find("input[type='text'][data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("textarea[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("select[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

                field.find(".education-web-icon-list").each(function(){
					var defaultValue = $(this).next('input[data-name]').attr('data-default');
					$(this).next('input[data-name]').val(defaultValue);
					$(this).prev('.education-web-selected-icon').children('i').attr('class','').addClass(defaultValue);
					
					$(this).find('li').each(function(){
						var icon_class = $(this).find('i').attr('class');
						if(defaultValue == icon_class ){
							$(this).addClass('icon-active');
						}else{
							$(this).removeClass('icon-active');
						}
					});
				});

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });

				field.find('.education-web-fields').show();

				$this.find('.education-web-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.education-web-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                education_web_refresh_repeater_values();
            }

		}
		return false;
	 });
	
	$("#customize-theme-controls").on("click", ".education-web-repeater-field-remove",function(){
		if( typeof	$(this).parent() != 'undefined'){
			$(this).closest('.education-web-repeater-field-control').slideUp('normal', function(){
				$(this).remove();
				education_web_refresh_repeater_values();
			});			
		}
		return false;
	});

	$("#customize-theme-controls").on('keyup change', '[data-name]',function(){
		 education_web_refresh_repeater_values();
		 return false;
	});


	// Set all variables to be used in scope
	var frame;
	// ADD IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.education-web-upload-button', function( event ){
		event.preventDefault();
		var imgContainer = $(this).closest('.education-web-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.education-web-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Create a new media frame
		frame = wp.media({
		    title: 'Select or Upload Image',
		    button: {
		    text: 'Use Image'
		    },
		    multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected in the media frame...
		frame.on( 'select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			// Send the attachment URL to our custom image input field.
			imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
			placeholder.addClass('hidden');
			// Send the attachment id to our hidden input
			imgIdInput.val( attachment.url ).trigger('change');
		});

		// Finally, open the modal on click
		frame.open();
	});


	// DELETE IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.education-web-delete-button', function( event ){

		event.preventDefault();
		var imgContainer = $(this).closest('.education-web-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.education-web-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Clear out the preview image
		imgContainer.find('img').remove();
		placeholder.removeClass('hidden');

		// Delete the image id from the hidden input
		imgIdInput.val( '' ).trigger('change');

	});


	$('body').on('click', '.education-web-icon-list li', function(){
		var icon_class = $(this).find('i').attr('class');
		$(this).addClass('icon-active').siblings().removeClass('icon-active');
		$(this).parent('.education-web-icon-list').prev('.education-web-selected-icon').children('i').attr('class','').addClass(icon_class);
		$(this).parent('.education-web-icon-list').next('input').val(icon_class).trigger('change');
		education_web_refresh_repeater_values();
	});

	$('body').on('click', '.education-web-selected-icon', function(){
		$(this).next().slideToggle();
	});

	/*Drag and drop to change order*/
	$(".education-web-repeater-field-control-wrap").sortable({
		orientation: "vertical",
		update: function( event, ui ) {
			education_web_refresh_repeater_values();
		}
	});


	/**
	 * Enable/Disable Swithc Options
	*/
	$('.switch_options').each(function() {    
	    var obj = $(this); //This object
	    var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
	    var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
	    var input = obj.children('input'); //cache the element where we must set the value
	    var input_val = obj.children('input').val(); //cache the element where we must set the value

	    /* Check selected */
	    if (0 == input_val) {
	        dsb.addClass('selected');
	    }
	    else if (1 == input_val) {
	        enb.addClass('selected');
	    }

	    //Action on user's click(ON)
	    enb.on('click', function() {
	        $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
	        $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
	        $(input).val(1).change(); //Finally change the value to 1
	    });

	    //Action on user's click(OFF)
	    dsb.on('click', function() {
	        $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
	        $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
	        $(input).val(0).change(); // //Finally change the value to 0
	    });
	});

	/**
	 * Select Multiple Category
	*/
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return $( this ).val();
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        
        }
    );

    /**
     * Multiple Gallery Image Control
    */
    $('.upload_gallery_button').click(function(event){
        var current_gallery = $( this ).closest( 'label' );

        if ( event.currentTarget.id === 'clear-gallery' ) {
            //remove value from input
            current_gallery.find( '.gallery_values' ).val( '' ).trigger( 'change' );

            //remove preview images
            current_gallery.find( '.gallery-screenshot' ).html( '' );
            return;
        }

        // Make sure the media gallery API exists
        if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find( '.gallery_values' ).val();
        var final;

        if ( !val ) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit( final );

        frame.state( 'gallery-edit' ).on(
            'update', function( selection ) {

                //clear screenshot div so we can append new selected images
                current_gallery.find( '.gallery-screenshot' ).html( '' );

                var element, preview_html = '', preview_img;
                var ids = selection.models.map(
                    function( e ) {
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                        preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                        current_gallery.find( '.gallery-screenshot' ).append( preview_html );
                        return e.id;
                    }
                );

                current_gallery.find( '.gallery_values' ).val( ids.join( ',' ) ).trigger( 'change' );
            }
        );
        return false;
    });

    
    /**
     * Section re-order
    */
    $('#tm-sections-reorder').sortable({
        cursor: 'move',
        update: function(event, ui) {
            var section_ids = '';
            $('#tm-sections-reorder li').css('cursor','default').each(function() {
                var section_id = jQuery(this).attr( 'data-section-name' );
                section_ids = section_ids + section_id + ',';
            });
            $('#shortui-order').val(section_ids);
            $('#shortui-order').trigger('change');
        }
    });

});
