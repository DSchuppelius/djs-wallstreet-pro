jQuery(document).ready(function ($) {
    var maxHeight = 0;
    $(window).bind("load", function () {
        $("div.home-blog-area").each(function () {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });
        $("div.home-blog-area").height(maxHeight + 15);
    });
});
