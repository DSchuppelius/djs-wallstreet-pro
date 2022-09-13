<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-6.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>
<div class="navbar navbar-wrapper navbar-inverse navbar-static-top navbar5 header-style-<?php echo $current_options["header_presets_stlyle"]; ?>" role="navigation">
    <div class="container">
        <div class="navbar-header index3">
            <div class="container">
                <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
            </div>
        </div>
        <?php get_template_part("template-parts/global/header/navbar", "button"); ?>
        <div class="navbar-collapse collapse">
            <?php get_template_part("template-parts/global/menu-search"); ?>
        </div>
    </div>
</div>
<style type="text/css">
    .navbar .navbar-nav > li > a {
        padding: 15px 19px !important;
    }
    .homepage_mycarousel {
        margin-bottom: 70px;
    }
    .static-banner {
        position: relative;
        overflow: hidden;
        max-height: 750px;
    }
    @media only screen and (min-width: 960px) and (max-width: 1200px) {
        .flex-slider-center {
            top: 31%;
            width: 910px;
        }
    }
    @media only screen and (max-width: 959px) and (min-width: 768px) {
        .static-banner .flex-slider-center {
            top: 33.5%;
            width: 700px;
        }
    }
    @media only screen and (max-width: 767px) and (min-width: 480px) {
        .static-banner .flex-slider-center {
            top: 33%;
            width: 560px !important;
        }
    }	
    @media (max-width: 1100px) {
        .navbar5 .navbar-left {
            float: none !important;
        }
    }	
</style>  
