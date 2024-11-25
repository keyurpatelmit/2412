;
(function($) {

    /* Fixed header nav */
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            var headerHeight = document.querySelector('.bottom-header').offsetHeight;
            if ($(window).width() >= 992) {
                if (window.scrollY > headerHeight) {
                    document.getElementById('masthead').classList.add('fixed-header');
                } else {
                    document.getElementById('masthead').classList.remove('fixed-header');
                }
            } else {
                var bottomheaderHeight = document.querySelector('.bottom-header').offsetHeight;
                var mobileheaderHeight = headerHeight + bottomheaderHeight;
                if (window.scrollY > mobileheaderHeight) {
                    document.getElementById('masthead').classList.add('fixed-header');
                } else {
                    document.getElementById('masthead').classList.remove('fixed-header');
                }
            }
        });
    });

    /* Show or Hide Search field on clicking search icon */
    $(document).on('click', '.header-search-icon .search-icon', function(e) {
        e.preventDefault();
        $('.header-search-form').addClass('search-in');
    });

    $('.header-search-form, .search-close').on('click', function(e) {
        e.preventDefault();
        if (!$(e.target).is('.header-search-form input')) {
            $('.header-search-form').removeClass('search-in');
        }
    });

    /* Mobile slick nav */
    $('#navigation').slicknav({
        duration: 500,
        closedSymbol: '<i class="fas fa-plus"></i>',
        openedSymbol: '<i class="fas fa-minus"></i>',
        prependTo: '.mobile-menu-container',
        allowParentLinks: true,
        nestedParentLinks: false,
        label: "Menu",
        closeOnClick: true, // Close menu when a link is clicked.
    });

    /* Home client slider */
    $('.client-slider').slick({
        dots: false,
        infinite: true,
        speed: 2000,
        prevArrow: false,
        nextArrow: false,
        slidesToShow: 4,
        autoplay: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 479,
            settings: {
                slidesToShow: 2,
            }
        }]
    });

    /* Home testimonial slider */
    $('.home-banner-slider').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        speed: 1200,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false,
        variableWidth: false,
        centerMode: false,
    });


    /* Home testimonial slider */
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 1200,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false,
        variableWidth: false,
        centerMode: false,
        prevArrow: false,
        nextArrow: false,
    });

    $(document).ready(function() {
        /* Count down */
        loopcounter('time-counter');

        // Progress bar
        $(".example").progressBar({
            duration: 1000,
        });

        var filterFns = {
            // show if number is greater than 50
            numberGreaterThan50: function() {
                var number = $(this).find('.number').text();
                return parseInt(number, 10) > 50;
            },
            // show if name ends with -ium
            ium: function() {
                var name = $(this).find('.name').text();
                return name.match(/ium$/);
            }
        };

        // bind filter button click
        $filters = $('.filter-menu').on('click', '.button', function() {
            var $this = $(this);
            var filterValue;
            if ($this.is('.is-checked')) {
                // uncheck
                filterValue = '*';
            } else {
                filterValue = $this.attr('data-filter');
                $filters.find('.is-checked').removeClass('is-checked');
            }
            $this.toggleClass('is-checked');

            // use filterFn if matches value
            filterValue = filterFns[filterValue] || filterValue;
            $grid.isotope({ filter: filterValue });
        });
    });

    /* Single gallery slider */
    $('.gallery-slider').slick({
        dots: true,
        infinite: true,
        autoplay: false,
        speed: 1200,
        slidesToShow: 2,
        adaptiveHeight: false,
        prevArrow: false,
        nextArrow: false,
        responsive: [{
            breakpoint: 479,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    // init Isotope
    function isoTopGrid() {
        $grid = $('.gallery-grid').isotope({
            itemSelector: '.gallery-grid-item'
        });
    }

    /* Blog masonry */
    function MasonryGrid() {
        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
        });
    }

    /* product detail slider */
    $('.product-thumbnails').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.product-thumb-nav'
    });
    $('.product-thumb-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.product-thumbnails',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });

    $(window).scroll(function() {
        /* back to top */
        if ($(this).scrollTop() > 300) {
            $('#backTotop').fadeIn(200);
        } else {
            $('#backTotop').fadeOut(200);
        }
    });
    /* back to top */
    $("#backTotop").on('click', function(e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    /* preloader */
    $(window).on("load", function() {
        $('#siteLoader').fadeOut(500);
        /* Blog masonry */
        MasonryGrid();
        isoTopGrid();
    });

    $(document).on("resize", function() {
        MasonryGrid();
        isoTopGrid();
    });

    // price handel
    $("#slider-range").slider({
        range: "max",
        min: 0,
        max: 1000,
        value: 500,
        slide: function(event, ui) {
            $("#maxAmount").val(ui.value);
        }
    });
    $("#maxAmount").val($("#slider-range").slider("value"));

    /* popup video */
    $("#video-container, #video-container-two").modalVideo({
        youtube: {
            controls: 0,
            nocookie: true
        }
    });

    /* counter up*/
    $('.counter').counterUp();


})(jQuery);

// show password js 
function showtxt() {
    var x = document.getElementById("showkey");
    var i = document.getElementById("icon");
    if (x.type === "password") {
        i.classList.add('show');
        x.type = "text";
    } else {
        i.classList.remove('show')
        x.type = "password";
    }
}