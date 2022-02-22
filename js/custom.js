// StarHotel Javascripts
jQuery(document).ready(function () {
    "use strict";
    // Revolution slider
    if (jQuery().revolution) {
        jQuery('.banner').revolution({
            delay: 3000,
            startwidth: 1349,
            startheight: 669,
            minHeight:200,
            autoHeight:"off",
            fullScreenAlignForce:"off",

            onHoverStop: "on",

            thumbWidth: 100,
            thumbHeight: 50,
            thumbAmount: 3,

            hideThumbsOnMobile: "on",
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResoluition: 0,

            hideThumbs:0,
            hideTimerBar:"on",

            keyboardNavigation:"on",

            navigationType: "none",
            navigationArrows: "verticalcentered",
            navigationStyle: "round",

            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 30,
            navigationVOffset: 30,

            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "bottom",
            soloArrowLeftHOffset: 100,
            soloArrowLeftVOffset: 70,

            soloArrowRightHalign: "right",
            soloArrowRightValign: "bottom",
            soloArrowRightHOffset: 100,
            soloArrowRightVOffset: 70,

            touchenabled: "on",
            swipe_velocity:"0.7",
            swipe_max_touches:"1",
            swipe_min_touches:"1",
            drag_block_vertical:"false",

            stopAtSlide: -1,
            stopAfterLoops: -1,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            hideSliderAtLimit: 0,

            dottedOverlay: "none",

            fullWidth:"off",
            forceFullWidth:"off",
            fullScreen: "off",
            fullScreenOffsetContainer: "#topheader-to-offset",

            shadow: 0
        });
    }
	// Owl sliders
    if (jQuery().owlCarousel) {
        jQuery("#owl-customer").owlCarousel({
            navigation: false,
            navigationText: ['', ''],
            slideSpeed: 800,
            paginationSpeed: 400,
            items: 2,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsMobile: [479, 1],
            pagination: true,
            autoPlay: 5000
        });
        jQuery("#owl-product-gal").owlCarousel({
            navigation: true,
            slideSpeed: 800,
            paginationSpeed: 400,
            pagination: false,
            navigationText: ['', ''],
            singleItem: true,
        });
    }
    if (jQuery().waypoint) {
        jQuery('.fadeInUp').waypoint(function () {
            var t = jQuery(this);
            if (jQuery(window).width() < 767) {
                t.delay(jQuery(this).data(1));
                t.addClass("animated");
            } else {
                t.delay(jQuery(this).data("start")).queue(function () {
                    t.addClass("animated");
                });
            }
        }, {
            offset: '75%',
            triggerOnce: true,
        });
        jQuery('.section_lua_chon').waypoint(function () {
          jQuery('.progress-bar-custom').each(function() {
            jQuery(this).find('.progress-content').animate({
              width:jQuery(this).attr('data-percentage')
            },2000);

            jQuery(this).find('.progress-number-mark').animate(
              {left:jQuery(this).attr('data-percentage')},
              {
               duration: 2000,
               step: function(now, fx) {
                 var data = Math.round(now);
                 jQuery(this).find('.percent').html(data + '%');
               }
            });
          });
        }, {
            offset: '75%',
            triggerOnce: true,
        });
    }
    //PrettyPhoto
    if (jQuery().prettyPhoto) {
        jQuery('a[data-rel]').each(function () {
            jQuery(this).attr('rel', jQuery(this).data('rel'));
        });

        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            animation_speed: 'normal', // fast/slow/normal
            slideshow: 5000, // false OR interval time in ms
            autoplay_slideshow: false, // true/false
            opacity: 0.80, // Value between 0 and 1
            show_title: true, // true/false
            allow_resize: true, // Resize the photos bigger than viewport. true/false
            default_width: 500,
            default_height: 344,
            counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
            theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
            horizontal_padding: 20, // The padding on each side of the picture
            hideflash: false, // Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto
            wmode: 'opaque', // Set the flash wmode attribute
            autoplay: true, // Automatically start videos: True/False
            modal: false, // If set to true, only the close button will close the window
            deeplinking: true, // Allow prettyPhoto to update the url to enable deeplinking.
            overlay_gallery: true, // If set to true, a gallery will overlay the fullscreen image on mouse over
            keyboard_shortcuts: true, // Set to false if you open forms inside prettyPhoto
            changepicturecallback: function () {}, // Called everytime an item is shown/changed
            callback: function () {}, // Called when prettyPhoto is closed
        });
    }
    if (jQuery().mCustomScrollbar) {
        jQuery(".mCustomScrollbar").mCustomScrollbar({
            theme:"dark-thin",
        });
    }
    // Isotope
    window.onload = function () {
        if (jQuery().isotope) {
            var jQuerycontainer2 = jQuery('.gallery');
            // initialize isotope
            jQuerycontainer2.isotope({
                filter: '*',
                masonry: {
                    columnWidth: 1,
                    gutterWidth: 0
                }
            });
        }
    }
    $(".icon-right .icon1")
    .mouseover(function() {
      $(".hotline-right").addClass("active");
    })
    .mouseout(function() {
      $(".hotline-right").removeClass("active");
    });
    // $(window).scroll(function(){
    //   $('.navbar-collapse').toggleClass("fixed-top", $(this).scrollTop() > 45 && $(this).width() > 992)
    //   $('.social-navbar').toggleClass("fixed-top", $(this).scrollTop() > 45 && $(this).width() <= 992)
    // });
});
