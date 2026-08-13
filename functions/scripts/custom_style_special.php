<?php
/*
 * Created on   : Mon Okt 03 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style_special.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
// Wird nur von scripts.php eingebunden, und zwar innerhalb von
// if (defined("DJS_POSTTYPE_PLUGIN")) - die Klasse ist hier also vorhanden.
$current_setup = PostTypes_Plugin_Setup::instance();

// Alle Werte sind Pixelangaben und gehen in einen <style>-Block. Vorher landeten sie
// ungeprueft dort; absint() erzwingt eine Ganzzahl, damit sich der Block nicht ueber
// einen Optionswert aufbrechen laesst.
$slider_radius     = absint($current_setup->get("slideroundcorner"));
$sub_slider_radius = max(0, $slider_radius - 20);
$client_tb         = absint($current_setup->get("client_padding_tb"));
$client_lr         = absint($current_setup->get("client_padding_lr"));
$client_hoehe      = absint($current_setup->get("client_pictureheight"));
$partner_tb        = absint($current_setup->get("partner_padding_tb"));
$partner_lr        = absint($current_setup->get("partner_padding_lr"));
$partner_hoehe     = absint($current_setup->get("partner_pictureheight")); ?>

<style>
:root {
    --main-slider-radius: <?php echo $slider_radius; ?>px !important;
    --sub-slider-radius: <?php echo $sub_slider_radius; ?>px !important;
}

.clients-logo {
    padding: <?php echo $client_tb; ?>px <?php echo $client_lr; ?>px;
}

.client-section client img {
    max-height: <?php echo $client_hoehe; ?>px
}

.partners-logo {
    padding: <?php echo $partner_tb; ?>px <?php echo $partner_lr; ?>px;
}

.partner-section partner img {
    max-height: <?php echo $partner_hoehe; ?>px
}
</style>