<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-1.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<header
    class="navbar navbar-wrapper navbar-inverse navbar-static-top navbar1 header-style-<?php echo $current_setup->get("header_presets_stlyle"); ?>"
    role="navigation">
    <nav class="container">
        <div class="navbar-header">
            <?php get_named_template_parts("template-parts/global/header/navbar", ["logo", "button"]); ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php get_template_part("template-parts/global/menu-search"); ?>
        </div>
    </nav>
</header>
<?php $headercheckbox = get_theme_mod("display_header_text");
Print_r($headercheckbox); ?>