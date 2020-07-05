jQuery('document').ready(function($) {

    $('.main-container').css('padding-top', ($('header#navbar').innerHeight()) ); //  correct padding from the header
});

jQuery(window).resize(function() {
    jQuery('.main-container').css('padding-top', (jQuery('header#navbar').innerHeight()) ); //  correct padding from the header
});