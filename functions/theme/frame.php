<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : frame.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seitenrahmen: Farbmodus, Header-Presets, Meta-Angaben, Body-Klassen.
 */

/* -------------------------------------------------------------------------
 *  Farbmodus (daisyUI-Themes)
 * ---------------------------------------------------------------------- */

/**
 * Schema aus der Stil-Auswahl im Customizer: "dark" oder "light".
 * default.css und "#rrggbb" sind die dunklen Varianten, light.css und "rrggbb" die hellen.
 */
function djs_color_scheme(): string {
    return get_custom_stylesheet() === 'light.css' ? 'light' : 'dark';
}

/**
 * Aktiver Modus: "dark", "light" oder "auto" (folgt prefers-color-scheme).
 */
function djs_color_mode(): string {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    return $current_setup->get('color_mode') === 'auto' ? 'auto' : djs_color_scheme();
}

function djs_color_mode_toggle_enabled(): bool {
    return (bool) DJS_Wallstreet_Pro_Theme_Setup::instance()->get('color_mode_toggle');
}

/**
 * data-theme fuer <html>. Im Modus "auto" bleibt das Attribut weg - daisyUI waehlt
 * dann per Media-Query zwischen hell (Standard) und dunkel (prefersdark).
 */
function djs_html_theme_attr(): void {
    $mode = djs_color_mode();
    if ($mode !== 'auto') {
        printf(' data-theme="wallstreet-%s"', esc_attr($mode));
    }
    printf(' data-color-default="%s"', esc_attr($mode));
}

/**
 * Fruehes Inline-Skript im <head>: markiert JS-Unterstuetzung und stellt die vom
 * Besucher gewaehlte Schriftgroesse bzw. Farbe vor dem ersten Rendern her (kein Springen,
 * kein Aufblitzen).
 */
function djs_head_prefs_script(): void {
    $color_toggle = djs_color_mode_toggle_enabled(); ?>
    <script>
        (function (d) {
            d.classList.add("js");
            try {
                var f = parseFloat(localStorage.getItem("fontSize"));
                if (f >= 10 && f <= 30) d.style.fontSize = f + "px";
                <?php if ($color_toggle) { ?>
                var m = localStorage.getItem("djs-color-mode");
                if (m === "light" || m === "dark") d.setAttribute("data-theme", "wallstreet-" + m);
                else if (m === "auto") d.removeAttribute("data-theme");
                <?php } ?>
            } catch (e) {}
        })(document.documentElement);
    </script>
<?php }
add_action('wp_head', 'djs_head_prefs_script', 1);

/* -------------------------------------------------------------------------
 *  Header-Presets
 * ---------------------------------------------------------------------- */

/**
 * Die sechs Header-Varianten aus dem Customizer als Konfiguration statt als sechs
 * fast gleiche Template-Dateien.
 *
 *  layout  inline  = Logo und Menue in einer Zeile
 *          stacked = Logo-Zeile oben, Menueleiste darunter
 *  brand   Ausrichtung des Logos in der oberen Zeile (stacked)
 *  menu    Ausrichtung des Menues
 *  style   Hervorhebung der Menuepunkte (pill = Flaeche, underline = Linie)
 *  float   Header als schwebende, abgerundete Leiste
 */
function djs_header_preset(?int $preset = null): array {
    $presets = [
        1 => ['layout' => 'inline', 'brand' => 'start', 'menu' => 'end', 'style' => 'pill', 'float' => false],
        2 => ['layout' => 'inline', 'brand' => 'start', 'menu' => 'end', 'style' => 'underline', 'float' => false],
        3 => ['layout' => 'stacked', 'brand' => 'start', 'menu' => 'start', 'style' => 'underline', 'float' => false],
        4 => ['layout' => 'stacked', 'brand' => 'center', 'menu' => 'start', 'style' => 'pill', 'float' => false],
        5 => ['layout' => 'inline', 'brand' => 'start', 'menu' => 'end', 'style' => 'pill', 'float' => true],
        6 => ['layout' => 'stacked', 'brand' => 'center', 'menu' => 'center', 'style' => 'underline', 'float' => false],
    ];

    if ($preset === null) {
        $preset = absint(DJS_Wallstreet_Pro_Theme_Setup::instance()->get('header_presets_stlyle'));
    }
    $preset = isset($presets[$preset]) ? $preset : 1;

    return ['id' => $preset] + $presets[$preset];
}

/**
 * Suchvariante: "overlay" (Vollbild, Customizer "Toogle"), "dropdown" (Pop-up)
 * oder "" (Suche deaktiviert).
 */
function djs_header_search_mode(): string {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    if (!$current_setup->get('enable_search_btn')) {
        return '';
    }
    return $current_setup->get('search_effect_style_setting') === 'toogle' ? 'overlay' : 'dropdown';
}

/* -------------------------------------------------------------------------
 *  Meta-Angaben im <head>
 * ---------------------------------------------------------------------- */

function djs_meta_description(): string {
    if (is_singular()) {
        $post_id     = get_queried_object_id();
        $description = get_post_meta($post_id, 'page_description', true);
        if (empty($description) && is_single()) {
            $description = wp_strip_all_tags(get_the_excerpt($post_id), true);
            if (empty($description)) {
                $description = get_the_title($post_id);
            }
            return wp_html_excerpt($description, 155, '…');
        }
        if (!empty($description)) {
            return get_bloginfo('name') . ' - ' . wp_strip_all_tags($description);
        }
    } elseif (is_archive()) {
        $description = wp_strip_all_tags(get_the_archive_description());
        if (empty($description)) {
            $description = wp_strip_all_tags(get_the_archive_title());
        }
        if (!empty($description)) {
            return get_bloginfo('name') . ' - ' . $description;
        }
    }

    return get_bloginfo('name') . ' - ' . get_bloginfo('description');
}

function djs_meta_keywords(): string {
    $keywords = ['Blog'];
    if (is_singular()) {
        $tags = get_the_tags(get_queried_object_id());
        if (!empty($tags) && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $keywords[] = wp_strip_all_tags($tag->name);
            }
        }
    }
    return implode(', ', $keywords);
}

/* -------------------------------------------------------------------------
 *  Body-Klassen aus den Customizer-Schaltern
 * ---------------------------------------------------------------------- */

add_filter('body_class', static function (array $classes): array {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $preset        = djs_header_preset();

    $classes[] = 'header-preset-' . $preset['id'];

    if ($current_setup->get('fixedheader_enabled')) {
        $classes[] = 'fixed_Header';
    }
    if ($current_setup->get('fixedfooter_enabled')) {
        $classes[] = 'fixed_Footer';
    }
    if ($current_setup->get('breadcrumbposition') != 0 || $current_setup->get('contentposition') != 0) {
        $classes[] = 'custom-positions';
    }
    if ($current_setup->get('a_underlined')) {
        $classes[] = 'a_underlined';
    }
    if ($current_setup->get('a_mark_targets')) {
        $classes[] = 'a_mark_targets';
    }
    if ($current_setup->get('parallaxbackground_enabled')) {
        $classes[] = 'parallax-background';
    }
    if ($current_setup->get('addframe')) {
        $classes[] = 'has-frame';
    }
    if ($current_setup->get('bigborder')) {
        $classes[] = 'has-bigborder';
    }
    if (function_exists('is_denied_specialtemplate') && is_denied_specialtemplate()) {
        $classes[] = 'denied_template_loaded';
    }

    return $classes;
});

/**
 * Inline-Abstaende fuer die Optionen "Breadcrumb-/Inhaltsposition" (Pixel, auch negativ).
 */
function djs_position_vars(): string {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    return sprintf(
        ':root{--breadcrumb-offset:%dpx;--content-offset:%dpx;}',
        intval($current_setup->get('breadcrumbposition')),
        intval($current_setup->get('contentposition'))
    );
}
