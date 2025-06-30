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

function the_theme_link_color(): void { echo esc_attr( get_theme_link_color() ); }
function the_theme_bg_color(): void   { echo esc_attr( get_theme_bg_color() ); }

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
