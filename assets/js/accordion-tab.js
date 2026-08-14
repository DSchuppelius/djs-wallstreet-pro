/* Accordion Js */

jQuery(document).ready(function () {

    // Icon-Paare [zugeklappt, aufgeklappt]. Beim Aufklappen wird links gegen rechts
    // getauscht, beim Zuklappen zurueck. fa-plus/fa-minus bedient den theme-eigenen
    // [accordian]-Shortcode, die uebrigen Paare das c_icon-Attribut der aus dem
    // WPBakery-Content nachgebauten Accordions (functions/shortcodes/shortcodes_vc_compat.php).
    var iconPairs = [
        ["fa-plus", "fa-minus"],
        ["fa-chevron-down", "fa-chevron-up"],
        ["fa-caret-down", "fa-caret-up"]
    ];

    function swapIcons($panel, opened) {
        jQuery.each(iconPairs, function (index, pair) {
            var from = opened ? pair[0] : pair[1];
            var to = opened ? pair[1] : pair[0];

            $panel.find("." + from).removeClass(from).addClass(to);
        });
    }

    jQuery(".collapse")
        .on("shown.bs.collapse", function (event) {
            // Die Bootstrap-Events blubbern nach oben: bei verschachtelten .collapse
            // wuerde das Elternpanel sein Icon mitdrehen.
            if (event.target !== this) {
                return;
            }
            swapIcons(jQuery(this).parent(), true);
        })
        .on("hidden.bs.collapse", function (event) {
            if (event.target !== this) {
                return;
            }
            swapIcons(jQuery(this).parent(), false);
        });

});
