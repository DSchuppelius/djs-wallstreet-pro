<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_colors.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

/* -------------------------------------------------------------------------
 *  Primäre Farb‑Getter
 * ---------------------------------------------------------------------- */
function get_theme_link_color(): string {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $stylesheet = $current_setup->get( 'stylesheet' );

    if ( in_array( $stylesheet, [ 'default.css', 'light.css' ], true ) ) {
        return maybe_hex_prefix( $current_setup->get( 'link_color' ) );
    }
    return maybe_hex_prefix( $stylesheet );
}

/**
 * Farbpalette des Block-Editors (theme.json): "Theme: Primary" folgt der Skin-Farbe aus dem
 * Customizer, damit damit eingefaerbte Bloecke dieselbe Farbe wie die Links tragen.
 */
add_filter("wp_theme_json_data_theme", static function ($theme_json) {
    $color = get_theme_link_color();
    if (!preg_match('/^#(?:[0-9a-f]{3}|[0-9a-f]{6})$/i', $color)) {
        return $theme_json;
    }
    // get_data() liefert die Voreinstellungen nach Herkunft gruppiert (["theme" => [...]])
    $data    = $theme_json->get_data();
    $palette = $data["settings"]["color"]["palette"] ?? null;
    if (is_array($palette) && isset($palette["theme"])) {
        $palette = $palette["theme"];
    }
    if (!is_array($palette)) {
        return $theme_json;
    }
    foreach ($palette as &$entry) {
        if (($entry["slug"] ?? "") === "theme-primary") {
            $entry["color"] = $color;
        }
    }
    unset($entry);
    return $theme_json->update_with(["version" => 3, "settings" => ["color" => ["palette" => $palette]]]);
});

function get_theme_bg_color(): string {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $backgroundHex = get_background_color();
    $defaultHex    = get_theme_support( 'custom-background', 'default-color' );

    if ( empty( $backgroundHex ) || ! $defaultHex || $backgroundHex === $defaultHex ) {
        return match ( get_custom_stylesheet( $current_setup ) ) {
            'default.css' => '#2a2c33',
            'light.css'   => '#ffffff',
            default       => '#000000',
        };
    }
    return '#' . ltrim( $backgroundHex, '#' );
}

// the_theme_link_color() und the_theme_bg_color() entfernt: beide wurden weder im Theme
// noch in einem der drei DJS-Plugins aufgerufen. Die get_-Varianten bleiben - sie sind
// in custom_style.php in Gebrauch.

/* -------------------------------------------------------------------------
 *  Stylesheet‑Ermittlung je nach Option
 * ---------------------------------------------------------------------- */
function get_custom_stylesheet( ?DJS_Wallstreet_Pro_Theme_Setup $current_setup = null ): string {
    $current_setup ??= DJS_Wallstreet_Pro_Theme_Setup::instance();
    $sheet = $current_setup->get( 'stylesheet' );

    return match ( true ) {
        $sheet === 'light.css'        => 'light.css',
        $sheet === 'default.css'      => 'default.css',
        str_starts_with( $sheet, '#' )=> 'default.css',
        default                       => 'light.css',
    };
}
