const maxWidth = "1199px";

function setClassesOnPage($) {
    const isFixedHeader = document.getElementsByClassName('fixed_Header').length > 0;
    const isFixedFooter = document.getElementsByClassName('fixed_Footer').length > 0;

    myPage = {
        footer: function () {
            var fot = $('footer.site');
            if (window.matchMedia("(max-width: " + maxWidth + ")").matches) {
                fot.removeClass("fixed");
            } else {
                fot.addClass("fixed");
            }
        },
        header: function (isScrolled) {
            var bod = $('#djs-body');
            var nav = $('.navbar-wrapper');
            var men = $('.navbar-collapse');
            var btn = $('.navbar-toggle')
            if (isScrolled && !window.matchMedia("(max-width: " + maxWidth + ")").matches) {
                bod.removeClass("body-static-top");
                bod.addClass("body-fixed-top");
                nav.removeClass("navbar-static-top");
                nav.addClass("navbar-fixed-top");
                men.removeClass("in");
                btn.addClass("collapsed");
            } else {
                bod.addClass("body-static-top");
                bod.removeClass("body-fixed-top");
                nav.addClass("navbar-static-top");
                nav.removeClass("navbar-fixed-top");
            }
        }
    }

    if (isFixedHeader) {
        $(window).scroll(function () {
            myPage.header($(this).scrollTop() > $('.header-top-area').height());
        });
        window.addEventListener('resize', function (event) {
            myPage.header($(this).scrollTop() > $('.header-top-area').height());
        });
        myPage.header($(this).scrollTop() > $('.header-top-area').height());
    }

    if (isFixedFooter) {
        window.addEventListener('resize', function (event) {
            myPage.footer();
        });
        myPage.footer();
    }
}

jQuery(document).ready(setClassesOnPage);
