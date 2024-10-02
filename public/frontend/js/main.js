(function($){
	"use strict";

    // Mean Menu
    jQuery('.mean-menu').meanmenu({
        meanScreenWidth: "991"
    });

    // Header Sticky
    $(window).on('scroll',function() {
        if ($(this).scrollTop() > 120){
            $('.navbar-area').addClass("is-sticky");
        }
        else{
            $('.navbar-area').removeClass("is-sticky");
        }
    });

    // Courses Slides
    $('.courses-slides').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 30,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // Popup Video
    $('.popup-youtube').magnificPopup({
        disableOn: 320,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // Stallions Slides
    $('.stallions-slides').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 30,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // Feedback Slides
    $('.feedback-slides').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 30,
        autoplayHoverPause: true,
        autoplay: true,
        center: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // // Subscribe form
    // $(".newsletter-form").validator().on("submit", function (event) {
    //     if (event.isDefaultPrevented()) {
    //     // handle the invalid form...
    //         formErrorSub();
    //         submitMSGSub(false, "Please enter your email correctly.");
    //     } else {
    //         // everything looks good!
    //         event.preventDefault();
    //     }
    // });
    function callbackFunction (resp) {
        if (resp.result === "success") {
            formSuccessSub();
        }
        else {
            formErrorSub();
        }
    }
    function formSuccessSub(){
        $(".newsletter-form")[0].reset();
        submitMSGSub(true, "Thank you for subscribing!");
        setTimeout(function() {
            $("#validator-newsletter").addClass('hide');
        }, 4000)
    }
    function formErrorSub(){
        $(".newsletter-form").addClass("animated shake");
        setTimeout(function() {
            $(".newsletter-form").removeClass("animated shake");
        }, 1000)
    }
    function submitMSGSub(valid, msg){
        if(valid){
            var msgClasses = "validation-success";
        } else {
            var msgClasses = "validation-danger";
        }
        $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
    }
    // AJAX MailChimp
    $(".newsletter-form").ajaxChimp({
        url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
        callback: callbackFunction
    });

    // Instructor Slides
    $('.instructor-slides').owlCarousel({
        loop: true,
        nav: true,
        margin: 30,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // Popup Image
    $('.popup-btn').magnificPopup({
        type: 'image',
        gallery: {
            enabled:true
        }
    });

    // Products Slides
    $('.products-slides').owlCarousel({
        loop: true,
        nav: true,
        margin: 30,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // Partner Slides
    $('.partner-slides').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        margin: 30,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 2,
            },
            768: {
                items: 4,
            },
            1200: {
                items: 6,
            }
        }
    });

    // Products Image Slides
    $('.products-image-slides').owlCarousel({
        loop: true,
        nav: true,
        margin: 30,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        items: 1,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
    });

    // FAQ Accordion
    $(function() {
        $('.accordion').find('.accordion-title').on('click', function(){
            // Adds Active Class
            $(this).toggleClass('active');
            // Expand or Collapse This Panel
            $(this).next().slideToggle('fast');
            // Hide The Other Panels
            $('.accordion-content').not($(this).next()).slideUp('fast');
            // Removes Active Class From Other Titles
            $('.accordion-title').not($(this)).removeClass('active');
        });
    });

    // Tabs
    (function ($) {
        $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
        $('.tab ul.tabs li a').on('click', function (g) {
            var tab = $(this).closest('.tab'),
            index = $(this).closest('li').index();
            tab.find('ul.tabs > li').removeClass('current');
            $(this).closest('li').addClass('current');
            tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
            tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
            g.preventDefault();
        });
    })(jQuery);

    // Tabs
    $("#tabs li").on("click", function(){
        var tab = $(this).attr("id");
        if ($(this).hasClass("inactive")) {
            $(this).removeClass("inactive");
            $(this).addClass("active");
            $(this).siblings().removeClass("active").addClass("inactive");
            $("#" + tab + "_content").addClass("show");
            $("#" + tab + "_content").siblings("div").removeClass("show");
        }
    });

    // Count Time
    function makeTimer() {
        var endTime = new Date("September 30, 2025 17:00:00 PDT");
        var endTime = (Date.parse(endTime)) / 1000;
        var now = new Date();
        var now = (Date.parse(now) / 1000);
        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
        if (hours < "10") { hours = "0" + hours; }
        if (minutes < "10") { minutes = "0" + minutes; }
        if (seconds < "10") { seconds = "0" + seconds; }
        $("#days").html(days + "<span>Days</span>");
        $("#hours").html(hours + "<span>Hours</span>");
        $("#minutes").html(minutes + "<span>Minutes</span>");
        $("#seconds").html(seconds + "<span>Seconds</span>");
    }
    setInterval(function() { makeTimer(); }, 1000);

    // Go to Top
    $(function(){
        //Scroll event
        $(window).on('scroll', function(){
            var scrolled = $(window).scrollTop();
            if (scrolled > 300) $('.go-top').fadeIn('slow');
            if (scrolled < 300) $('.go-top').fadeOut('slow');
        });
        //Click event
        $('.go-top').on('click', function() {
            $("html, body").animate({ scrollTop: "0" },  0);
        });
    });

    // Odometer JS
    $('.odometer').appear(function(e) {
        var odo = $(".odometer");
        odo.each(function() {
            var countNumber = $(this).attr("data-count");
            $(this).html(countNumber);
        });
    });

    // WOW JS
	$(window).on ('load', function (){
        if ($(".wow").length) {
            var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 20, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
          });
          wow.init();
        }
    });

    // Preloader Area
	jQuery(window).on('load', function() {
	    $('.preloader').fadeOut();
	});

    /* Start "Horse Ranch Demo JS, "Equestrian Club Demo JS & Horse Riding School Demo JS" */

    // Search Popup JS
	$('.close-btn').on('click',function() {
		$('.search-overlay').fadeOut();
		$('.search-btn').show();
		$('.close-btn').removeClass('active');
	});
	$('.search-btn').on('click',function() {
		$(this).hide();
		$('.search-overlay').fadeIn();
		$('.close-btn').addClass('active');
	});

    // Horse Ranch Slides
    $('.horse-ranch-slides').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        animateOut: 'fadeOut',
        smartSpeed: 1000,
        autoplayTimeout: 1000,
        autoHeight: true,
        items: 1,
        navText: [
            "<i class='icofont-long-arrow-left'></i>",
            "<i class='icofont-long-arrow-right'></i>"
        ],
    });

    // Feedback Wrap Slides
    $('.feedback-wrap-slides').owlCarousel({
        loop: true,
        nav: false,
        margin: 30,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    // Overview Gallery Slides
    $('.overview-gallery-slides').owlCarousel({
        loop: true,
        nav: false,
        margin: 30,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        stagePadding: 150,
        navText: [
            "<i class='icofont-simple-left'></i>",
            "<i class='icofont-simple-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                stagePadding: 0,
            },
            768: {
                items: 2,
                stagePadding: 0,
            },
            1200: {
                items: 2,
            }
        }
    });

    /* End "Horse Ranch Demo JS, "Equestrian Club Demo JS & Horse Riding School Demo JS" */

}(jQuery));
