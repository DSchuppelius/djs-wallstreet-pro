<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-4.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<div class="navbar-header index3 header-style-<?php echo $current_setup->get("header_presets_stlyle"); ?>">
    <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
</div>
<div class="navbar navbar-wrapper navbar-inverse navbar-static-top navbar3 header-style-<?php echo $current_setup->get("header_presets_stlyle"); ?>"
    role="navigation">
    <div class="container">
        <?php get_template_part("template-parts/global/header/navbar", "button"); ?>
        <div class="navbar-collapse collapse">
            <?php get_template_part("template-parts/global/menu-search"); ?>
        </div>
    </div>
</div>