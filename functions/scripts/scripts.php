<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : scripts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

/**
 * Versionsstempel aus dem Aenderungsdatum - Browser laden eine Datei neu, sobald sie
 * sich aendert, und cachen sie sonst unbegrenzt.
 */
function djs_asset_version(string $relative_path): ?string {
    $path = THEME_ASSETS_PATH . '/' . ltrim($relative_path, '/');
    return file_exists($path) ? (string) filemtime($path) : null;
}

function djs_asset_uri(string $relative_path): string {
    return THEME_ASSETS_PATH_URI . '/' . ltrim($relative_path, '/');
}

/**
 * Font-Face-Datei der im Customizer gewaehlten lokalen Seitenschrift (relativ zu assets/).
 */
function djs_site_font_file(): string {
    $local_fonts = ["roboto", "montserrat", "dancing-script", "rubik", "sulphurpoint", "overlock", "opensans", "anonymous-pro"];
    $font        = DJS_Wallstreet_Pro_Theme_Setup::instance()->get("local_font_style");
    return in_array($font, $local_fonts, true) ? "css/fonts/site_font-faces_{$font}.css" : "css/fonts/site_font-faces.css";
}

/* -------------------------------------------------------------------------
 *  Backend
 * ---------------------------------------------------------------------- */
function theme_admin_enqueue_iconfonts() {
    wp_enqueue_style("font-awesome", djs_asset_uri("css/fonts/font-awesome/css/all.min.css"));
    wp_enqueue_style("icon_font-faces", djs_asset_uri("css/fonts/icon_font-faces.css"));
}
add_action("admin_enqueue_scripts", "theme_admin_enqueue_iconfonts");

function theme_custom_enqueue_css() {
    global $pagenow;

    if (in_array($pagenow, ["post.php", "post-new.php", "page-new.php", "page.php"], true)) {
        wp_enqueue_style("meta-box-css", djs_asset_uri("css/admin/meta-box.css"));
    }
    wp_enqueue_style("color-schema", djs_asset_uri("customizer/color-schema.css"));
}
add_action("admin_print_styles", "theme_custom_enqueue_css", 10);

/* -------------------------------------------------------------------------
 *  Schriften und Icons
 * ---------------------------------------------------------------------- */
function theme_font_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    // Font Awesome render-blockierend: Icons brauchen @font-face sofort, sonst Tofu-Kaestchen.
    wp_enqueue_style("font-awesome", djs_asset_uri("css/fonts/font-awesome/css/all.min.css"));
    // v4-Shims: alte Namen (fa-paper-plane-o ...) aus Freitext-Icon-Feldern.
    wp_enqueue_style("font-awesome-v4-shims", djs_asset_uri("css/fonts/font-awesome/css/v4-shims.min.css"), ["font-awesome"]);
    wp_enqueue_style("icon_font-faces", djs_asset_uri("css/fonts/icon_font-faces.css"));
    wp_enqueue_style("wallstreet-fonts", djs_asset_uri("css/fonts/local-families.css"));

    if ($current_setup->get("enable_custom_typography") == true) {
        wp_enqueue_style("spicy-fonts", wallstreet_fonts_url($current_setup->get("google_font")), [], null);
        return;
    }

    wp_enqueue_style("site_font-faces", djs_asset_uri(djs_site_font_file()));
}
add_action("wp_enqueue_scripts", "theme_font_scripts");

/* -------------------------------------------------------------------------
 *  Theme-Stylesheet (Tailwind/daisyUI-Build) und Theme-Skript
 * ---------------------------------------------------------------------- */
function theme_scripts() {
    wp_enqueue_style("djs-wallstreet-pro", djs_asset_uri("dist/theme.css"), ["wallstreet-fonts"], djs_asset_version("dist/theme.css"));

    $inline = function_exists("djs_wallstreet_root_css") ? djs_wallstreet_root_css() : "";
    $inline .= djs_position_vars();
    wp_add_inline_style("djs-wallstreet-pro", $inline);

    // Child-Themes bringen ihre style.css mit; das Eltern-Theme hat dort nur den Theme-Header.
    if (is_child_theme()) {
        wp_enqueue_style("djs-wallstreet-pro-child", get_stylesheet_uri(), ["djs-wallstreet-pro"], wp_get_theme()->get("Version"));
    }

    wp_enqueue_script("rellax", djs_asset_uri("js/parallax/rellax.min.js"), [], "1.12.1", ["strategy" => "defer", "in_footer" => true]);
    wp_enqueue_script("djs-wallstreet-pro", djs_asset_uri("js/theme.js"), ["rellax"], djs_asset_version("js/theme.js"), ["strategy" => "defer", "in_footer" => true]);
    wp_add_inline_script("djs-wallstreet-pro", "window.djsL10n=" . wp_json_encode([
        /* translators: 1: slide number, 2: number of slides */
        "slide" => __('Slide %1$s of %2$s', "djs-wallstreet-pro"),
        "play"  => __("Start automatic rotation", "djs-wallstreet-pro"),
        "pause" => __("Pause automatic rotation", "djs-wallstreet-pro"),
        "close" => __("Close", "djs-wallstreet-pro"),
        "prev"  => __("Previous", "djs-wallstreet-pro"),
        "next"  => __("Next", "djs-wallstreet-pro"),
    ]) . ";", "before");

    if (defined("DJS_POSTTYPE_PLUGIN")) {
        require_once "custom_style_special.php";
    }
}
add_action("wp_enqueue_scripts", "theme_scripts");

/* -------------------------------------------------------------------------
 *  WooCommerce
 * ---------------------------------------------------------------------- */
function theme_woocommerce_scripts() {
    if (class_exists("WooCommerce")) {
        wp_enqueue_style("woocommerce", djs_asset_uri("css/woocommerce/woocommerce.css"));
        wp_enqueue_style("woocommerce-font", djs_asset_uri("css/woocommerce/font.css"));
    }
}
add_action("wp_enqueue_scripts", "theme_woocommerce_scripts");

/**
 * Warenkorb-Zaehler im Header nach "In den Warenkorb" per AJAX aktualisieren.
 */
add_filter("woocommerce_add_to_cart_fragments", static function ($fragments) {
    $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $fragments["span.djs-cart-count"] = '<span class="indicator-item badge badge-primary badge-xs djs-cart-count' . ($count ? "" : " hidden") . '">' . absint($count) . "</span>";
    return $fragments;
});

/* -------------------------------------------------------------------------
 *  Kommentare
 * ---------------------------------------------------------------------- */
// Muss im Hook stehen: is_singular() funktioniert erst nach der Hauptquery.
function theme_comment_reply_script() {
    if (is_singular() && comments_open() && get_option("thread_comments")) {
        wp_enqueue_script("comment-reply");
    }
}
add_action("wp_enqueue_scripts", "theme_comment_reply_script");

/* -------------------------------------------------------------------------
 *  Customizer-Vorschau
 * ---------------------------------------------------------------------- */
if (!function_exists("wallstreet_customizer_preview_scripts")) {
    function wallstreet_customizer_preview_scripts() {
        wp_enqueue_script("ws-customizer-preview", djs_asset_uri("customizer/slider/js/customizer-preview.js"), ["customize-preview"], null, ["strategy" => "defer", "in_footer" => false]);
    }
}
add_action("customize_preview_init", "wallstreet_customizer_preview_scripts");

/* -------------------------------------------------------------------------
 *  Google Fonts entfernen (Customizer-Option, DSGVO)
 * ---------------------------------------------------------------------- */
function theme_remove_googlefonts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    if (!$current_setup->get("remove_googlefonts") || $current_setup->get("enable_custom_typography")) {
        return;
    }

    add_filter("style_loader_src", function ($href) {
        return strpos((string) $href, "//fonts.googleapis.com/") === false ? $href : false;
    });
}
add_action("wp_enqueue_scripts", "theme_remove_googlefonts");

/* -------------------------------------------------------------------------
 *  Preload der Webfonts (woff2) - Ergebnis einen Tag bzw. bis zum Font-Wechsel gecacht
 * ---------------------------------------------------------------------- */
add_action('wp_head', function () {
    $styles = wp_styles();
    if (!$styles) return;

    $handles = [];
    foreach (['icon_font-faces', 'site_font-faces'] as $h) {
        if (isset($styles->registered[$h])) $handles[] = $h;
    }
    if (!$handles) return;

    $srcs = [];
    foreach ($handles as $handle) {
        $srcs[$handle] = $styles->registered[$handle]->src ?? '';
    }

    $cache_key = 'djs_ws_font_preload_v4_' . md5(implode('|', $srcs));
    $out = get_transient($cache_key);

    if ($out === false) {
        $out = [];
        foreach ($handles as $handle) {
            $src = $srcs[$handle];
            if (!$src) continue;

            $path = '';
            if (str_starts_with($src, get_template_directory_uri())) {
                $path = get_template_directory() . substr($src, strlen(get_template_directory_uri()));
            } elseif (str_starts_with($src, content_url())) {
                $path = WP_CONTENT_DIR . substr($src, strlen(content_url()));
            }
            if (!$path || !is_readable($path)) continue;

            $css = file_get_contents($path);
            if ($css === false) continue;

            if (preg_match_all('/@font-face\s*{[^}]*?font-family\s*:\s*([\'"]?)([^;\'"]+)\1\s*;[^}]*?src\s*:\s*([^;]+);/is', $css, $m, PREG_SET_ORDER)) {
                $base = trailingslashit(dirname($src));
                foreach ($m as $blk) {
                    $family = trim($blk[2]);
                    // Nur die eigentliche Seitenschrift - die Alias-Familien (SiteFontBold ...) braucht der erste Bildschirm nicht.
                    if (preg_match('/^SiteFont./i', $family)) continue;
                    // Von den Icon-Schriften nur Material Icons (Buttons, Menue): "Bootstrap Icons" und die
                    // alte Familie "FontAwesome" nutzt das Theme nicht - vorab geladen waren das 120 kB je Seite umsonst.
                    if ($handle === 'icon_font-faces' && strcasecmp($family, 'Material Icons') !== 0) continue;
                    if (!preg_match('/url\((["\']?)([^)]+\.woff2[^)]*)\1\)/i', $blk[3], $u)) continue;
                    $url = $u[2];
                    if (str_starts_with($url, '//')) {
                        $url = 'https:' . $url;
                    } elseif (!preg_match('#^https?://#i', $url)) {
                        $url = $base . ltrim($url, './');
                    }
                    $url = preg_replace('#^https?:#i', '', $url);

                    $key = strtolower($family);
                    if (!isset($out[$key])) $out[$key] = esc_url($url);
                }
            }
        }

        set_transient($cache_key, $out, DAY_IN_SECONDS);
    }

    $limit = 4;
    $i = 0;
    foreach ($out as $href) {
        echo '<link rel="preload" as="font" type="font/woff2" href="' . $href . '" crossorigin>' . "\n";
        if (++$i >= $limit) break;
    }
}, 5);
