<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : primary-menu.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

wp_nav_menu([
    "theme_location" => "primary",
    "container"      => false,
    "menu_id"        => "primary-menu",
    "menu_class"     => "site-menu",
    "fallback_cb"    => "theme_fallback_page_menu",
    "walker"         => new DJS_Walker_Nav_Menu(),
]);
