<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : font.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_fonts_url($font) {
    $fonts_url = "";
    $font_families = [];
    $font_families = [$font . ":100,300,400,500,700", "900", "italic"];

    $query_args = [
        "family" => urlencode(implode("|", $font_families)),
        "subset" => urlencode("latin,latin-ext"),
    ];

    $fonts_url = add_query_arg($query_args, "//fonts.googleapis.com/css");

    return $fonts_url;
}
?>
