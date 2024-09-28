(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();

    $(".scroll-top").hide();
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $(".scroll-top").fadeIn();
        } else {
            $(".scroll-top").fadeOut();
        }
    });
    $(".scroll-top").on("click", function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            700
        );
    });

    $(document).ready(function () {
        $(".select2").select2({
            theme: "bootstrap",
        });
    });


    $(".video-button").magnificPopup({
        type: "iframe",
        gallery: {
            enabled: true,
        },
    });
    $(".magnific").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });

    $(".slide-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        margin: 0,
        mouseDrag: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        nav: true,
        navText: [
            "<i class='fas fa-long-arrow-alt-left'></i>",
            "<i class='fas fa-long-arrow-alt-right'></i>",
        ],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    // $(".testimonial-carousel").owlCarousel({
    //     loop: true,
    //     autoplay: true,
    //     autoplayHoverPause: true,
    //     autoplaySpeed: 1500,
    //     smartSpeed: 1500,
    //     margin: 30,
    //     nav: false,
        // animateIn: "fadeIn",
        // animateOut: "fadeOut",
        // navText: [
        //     "<i class='fa fa-caret-left'></i>",
        //     "<i class='fa fa-caret-right'></i>",
        // ],
    //     responsive: {
    //         0: {
    //             items: 1,
    //             dots: false,
    //             nav: true,
    //         },
    //         768: {
    //             items: 1,
    //         },
    //         992: {
    //             items: 1,
    //         },
    //     },
    // });

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    $(".room-detail-carousel").owlCarousel({
        loop: true,
        autoplay: false,
        autoplayHoverPause: true,
        margin: 0,
        mouseDrag: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    jQuery(".mean-menu").meanmenu({
        meanScreenWidth: "991",
    });

    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true
    });

    $('.counter').counterUp();

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    if(jQuery().select2) {
        $(".select2").select2();
    }

    if(jQuery().select2) {
        $(".select2_tags").select2({
            tags: true,
            multiple: true,
        });
    }

})(jQuery);
