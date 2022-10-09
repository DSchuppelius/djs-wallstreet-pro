<?php
/*
 * Created on   : Mon Okt 03 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style_special.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = PostTypes_Plugin_Setup::instance(); ?>

<style type="text/css">
    :root{
        --main-slider-radius: <?php echo $current_setup->get("slideroundcorner"); ?>px !important; 
        --sub-slider-radius: <?php echo $current_setup->get("slideroundcorner") - 20; ?>px !important;
    }

    .clients-logo {
        padding: <?php echo $current_setup->get("client_padding_tb"); ?>px <?php echo $current_setup->get("client_padding_lr"); ?>px;
    }

    .client-section client img {
        max-height: <?php echo $current_setup->get("client_pictureheight"); ?>px
    }

    .partners-logo {
        padding: <?php echo $current_setup->get("partner_padding_tb"); ?>px <?php echo $current_setup->get("partner_padding_lr"); ?>px;
    }

    .partner-section partner img {
        max-height: <?php echo $current_setup->get("partner_pictureheight"); ?>px
    }
</style>
