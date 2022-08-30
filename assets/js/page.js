jQuery(document).ready(function ($) {
    const isFixedHeader = document.getElementsByClassName('fixed_Header').length > 0;

    var adm = $('#wpadminbar');
    var bod = $('#djs-body');
    var nav = $('.navbar-wrapper');
    var men = $('.navbar-collapse');
    var btn = $('.navbar-toggle')
    var headSocialHeight = $('.header-top-area').height();

    if (isFixedHeader)
        $(window).scroll(function () {
            if ($(this).scrollTop() > headSocialHeight) {
                bod.removeClass("body-static-top");
                bod.addClass("body-fixed-top");
                nav.removeClass("navbar-static-top");
                nav.addClass("navbar-fixed-top");
                adm.removeClass("navbar-static-top");
                adm.addClass("navbar-fixed-top");
                men.removeClass("in");
                btn.addClass("collapsed");
            } else {
                bod.addClass("body-static-top");
                bod.removeClass("body-fixed-top");
                nav.addClass("navbar-static-top");
                nav.removeClass("navbar-fixed-top");
                adm.addClass("navbar-static-top");
                adm.removeClass("navbar-fixed-top");
            }
        });
});