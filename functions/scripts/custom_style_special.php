<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style_special.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Werte aus dem Post-Types-Plugin als CSS-Variablen (Slider-Rundung, Logo-Leisten).
 * Wird nur von scripts.php eingebunden, wenn das Plugin aktiv ist.
 */

$current_setup = PostTypes_Plugin_Setup::instance();

// Alles Pixelwerte; absint() verhindert, dass ein Optionswert den Block aufbricht.
$slider_radius = absint($current_setup->get("slideroundcorner"));

wp_add_inline_style("djs-wallstreet-pro", sprintf(
    ":root{--main-slider-radius:%1\$dpx;--sub-slider-radius:%2\$dpx;--client-pad-y:%3\$dpx;--client-pad-x:%4\$dpx;--client-logo-h:%5\$dpx;--partner-pad-y:%6\$dpx;--partner-pad-x:%7\$dpx;--partner-logo-h:%8\$dpx;}",
    $slider_radius,
    max(0, $slider_radius - 20),
    absint($current_setup->get("client_padding_tb")),
    absint($current_setup->get("client_padding_lr")),
    absint($current_setup->get("client_pictureheight")),
    absint($current_setup->get("partner_padding_tb")),
    absint($current_setup->get("partner_padding_lr")),
    absint($current_setup->get("partner_pictureheight"))
));
