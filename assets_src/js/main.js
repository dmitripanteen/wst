//=require ../../node_modules/jquery/dist/jquery.min.js
//=require ../../node_modules/lightslider/dist/js/lightslider.js

$(document).ready(function() {
    $('#catalogue-slider').lightSlider({
        item: 3,
        slideMove: 1,
        slideMargin: 10,
        addClass: '',

        mode:"fade", // Type of transition 'slide' and 'fade'.
        useCSS:true, // If true LightSlider will use CSS transitions. if falls jquery animation will be used.
        speed: 1000, // Transition duration (in ms).
        cssEasing: 'ease', // 'cubic-bezier(0.25, 0, 0.25, 1)'
        easing: 'linear', // The type of "easing". ex: 'linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)'.
        auto: false, // If true, the Slider will automatically start to play.
        pause: 3000, // The time (in ms) between each auto transition
        loop:true, // If false, will disable the ability to loop back to the beginning of the slide when on the last element.

        controls:true, // if controls:false, controls will not be added
        prevHtml:'', // custom text for prev control
        nextHtml:'', // custom text for next control
        rtl: false,
        keyPress:true, // Enable keyboard navigation
        adaptiveHeight: false,
        vertical: false,
        verticalHeight: 500,
        vThumbWidth: 100,
        thumbItem: 10,
        //galleryMargin: 5,
        pager:true, // Enable pager option
        gallery:true, // Enable gallery mode
        //thumbMargin:3, // Spacing between each thumbnails
        currentPagerPosition:'middle', // 'left' OR 'middle', 'right'

        enableTouch: true,
        enableDrag: true,
        freeMove: false,
        swipeThreshold:40, // By setting the swipeThreshold you can set how far the user must swipe for the next/prev slide
        responsive: [],

        onBeforeStart: function($el) {},
        onSliderLoad: function($el) {},
        onBeforeSlide: function($el,scene) {},
        onAfterSlide: function($el,scene) {},
        onBeforeNextSlide: function($el,scene) {},
        onBeforePrevSlide: function($el,scene) {}
    });

    function toggleMenu() {
        if ($('#mainmenu').hasClass('opened')) {
            $('#mainmenu').removeClass('opened');
            $('.menu-close').hide();
            $('.menu-open').show();
        } else {
            $('#mainmenu').addClass('opened');
            $('.menu-close').show();
            $('.menu-open').hide();
        }
    }
    $('.navbar-toggle').click(function () {
        toggleMenu();
    });

});