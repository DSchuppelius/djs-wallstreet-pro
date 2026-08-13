<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-3.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<div class="navbar-header index2 header-style-<?php echo $current_setup->get("header_presets_stlyle"); ?>">
    <div class="container">
        <?php get_template_part("template-parts/global/header/navbar", "logo"); get_template_part("template-parts/global/separate-search-cart"); ?>
    </div>
</div>
<!--/Header Details Section-->

<!--Logo & Menu Section-->
<div class="navbar navbar-wrapper navbar-inverse navbar-static-top navbar2 header-style-<?php echo $current_setup->get("header_presets_stlyle"); ?>"
    role="navigation">
    <div class="container">
        <?php get_template_part("template-parts/global/header/navbar", "button"); ?>
        <div class="navbar-collapse collapse">
            <?php wp_nav_menu([
                "theme_location" => "primary",
                // Bewusst ohne Huelle: WordPress gibt nur bei "div"/"nav" eine aus, der
                // frueher hier stehende Klassen-String fiel also ersatzlos weg
                // (wp-includes/nav-menu-template.php, $show_container). Die Huelle
                // <div class="navbar-collapse collapse"> steht bereits eine Zeile darueber -
                // eine zweite mit der Bootstrap-Klasse "collapse" darin blendet das Menue aus.
                "container" => false,
                "menu_class" => "nav navbar-nav navbar-left",
                "fallback_cb" => "theme_fallback_page_menu",
                "walker" => new Theme_Bootstrap_Walker_Nav_Menu(),
            ]); ?>
        </div>
    </div>
</div>