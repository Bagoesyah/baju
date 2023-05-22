/**
* @Author: Awan Tengah
* @Date:   2017-01-13T20:46:46+07:00
* @Last modified by:   Awan Tengah
* @Last modified time: 2017-03-12T23:06:41+07:00
*/

$(document).ready(function() {
    $(document).on('init.slides', function() {
        $('.loading-container').fadeOut(function() {
            $(this).remove();
        });
    });

    var windowHeight = $(window).height();
    var headerHeight = $("header").outerHeight();
    var calculatedHeight = windowHeight - headerHeight;
    var heightFill = $('.height-fill')
    $(heightFill).height(495);

    $('#slides').superslides({
        slide_easing: 'linear',
        slide_speed: 1500,
        pagination: true,
        hashchange: true,
        scrollable: true,
        inherit_height_from: '.height-fill',
        play: 5000,
        hashchange: false
    });

    // document.ontouchmove = function(e) {
    //     e.preventDefault();
    // };
    // $('#slides').hammer().on('swipeleft', function() {
    //     $(this).superslides('animate', 'next');
    // });
    //
    // $('#slides').hammer().on('swiperight', function() {
    //     $(this).superslides('animate', 'prev');
    // });
});
