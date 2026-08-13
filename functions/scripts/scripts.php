<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : scripts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

function theme_admin_enqueue_iconfonts() {
    wp_enqueue_style("font-awesome",                THEME_ASSETS_PATH_URI . "/css/fonts/font-awesome/css/all.min.css");
    wp_enqueue_style("icon_font-faces",             THEME_ASSETS_PATH_URI . "/css/fonts/icon_font-faces.css");
}
add_action("admin_enqueue_scripts", "theme_admin_enqueue_iconfonts");

function theme_bootstrap_scripts() {
    wp_enqueue_style("bootstrap",                   THEME_ASSETS_PATH_URI . "/bootstrap/css/bootstrap.min.css");
    wp_enqueue_script("bootstrap",                  THEME_ASSETS_PATH_URI . "/bootstrap/js/bootstrap.min.js", [], null, ['strategy' => 'defer', 'in_footer' => false]);
}
add_action("wp_enqueue_scripts", "theme_bootstrap_scripts");

function theme_font_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    // Font Awesome render-blockierend laden: Icons (auch die Menue-Pfeile) brauchen die
    // @font-face-Definitionen sofort beim ersten Rendern, sonst erscheinen Kaestchen.
    // (Deferred laden wurde verworfen -> sparte keine Bytes, verursachte aber Tofu-Boxen.)
    wp_enqueue_style("font-awesome",                THEME_ASSETS_PATH_URI . "/css/fonts/font-awesome/css/all.min.css");
    // v4-Shims: mappen alte Font-Awesome-4-Namen (z.B. fa-paper-plane-o, fa-thumbs-o-up,
    // fa-dot-circle-o) auf die aktuellen Icons. all.min.css enthaelt diese -o-Aliase NICHT,
    // und das Theme (sowie Freitext-Icon-Felder) nutzt v4-Namen -> Datei muss mitgeladen werden.
    wp_enqueue_style("font-awesome-v4-shims",       THEME_ASSETS_PATH_URI . "/css/fonts/font-awesome/css/v4-shims.min.css", ["font-awesome"]);
    wp_enqueue_style("icon_font-faces",             THEME_ASSETS_PATH_URI . "/css/fonts/icon_font-faces.css");
    wp_enqueue_style("wallstreet-fonts",            THEME_ASSETS_PATH_URI . "/css/fonts/font.css");
    if ($current_setup->get("enable_custom_typography") == true) {
        wp_enqueue_style("spicy-fonts",             wallstreet_fonts_url($current_setup->get("google_font")), [], null);
    } else {
        switch ($current_setup->get("local_font_style")) {
            case 'roboto':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_roboto.css");
                break;
            case 'montserrat':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_montserrat.css");
                break;
            case 'dancing-script':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_dancing-script.css");
                break;
            case 'rubik':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_rubik.css");
                break;
            case 'sulphurpoint':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_sulphurpoint.css");
                break;
            case 'overlock':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_overlock.css");
                break;
            case 'opensans':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_opensans.css");
                break;
            case 'anonymous-pro':
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_anonymous-pro.css");
                break;
            default:
                wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces.css");
                break;
        }
    }
}
add_action("wp_enqueue_scripts", "theme_font_scripts");

function theme_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    wp_enqueue_style("djs-wallstreet-pro-style",    get_stylesheet_uri(),                                                           [], '1.0.0');

    wp_enqueue_style("djs-wallstreet-pro-default",  THEME_ASSETS_PATH_URI . "/css/" . get_custom_stylesheet($current_setup),        [], '1.0.0');
    wp_enqueue_style("djs-wallstreet-pro-standard", THEME_ASSETS_PATH_URI . "/css/standard.css",                                    [], '1.0.0');
    wp_enqueue_style('djs-wallstreet-pro-dynamic',  THEME_ASSETS_PATH_URI . '/css/dynamic.css',                                     [], '1.0.0');

    if (function_exists("djs_wallstreet_root_css")) {
        wp_add_inline_style("djs-wallstreet-pro-standard", djs_wallstreet_root_css());
    }

    // jetpack + button + fx + menu + tooltips zu einem Bundle zusammengefasst,
    // um 4 render-blockierende HTTP-Requests im <head> zu sparen.
    wp_enqueue_style("djs-wallstreet-pro-bundle",   THEME_ASSETS_PATH_URI . "/css/theme-bundle.css",                                [], '1.0.0');

    // Zusammengefasst aus 10 Einzeldateien (media/responsive/*) in eine Datei,
    // um 9 render-blockierende HTTP-Requests im <head> zu sparen.
    // Die Media-Queries stecken jetzt als @media-Bloecke in der Datei selbst.
    wp_enqueue_style("media-responsive",            THEME_ASSETS_PATH_URI . "/css/media/responsive.css",                            [], '1.0.0');

    wp_enqueue_style("media-print",                 THEME_ASSETS_PATH_URI . "/css/media/print.css",                                 [], '1.0.0', 'only print');

    // require_once "custom_style.php";

    if (defined("DJS_POSTTYPE_PLUGIN")) {
        require_once "custom_style_special.php";
    }
}
add_action("wp_enqueue_scripts", "theme_scripts");

function theme_jquery_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    wp_enqueue_script("menu",                       THEME_ASSETS_PATH_URI . "/js/menu/menu.js",                                     ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
    if ($current_setup->get("page_fader_enabled")) {
        wp_enqueue_script("page_fader",             THEME_ASSETS_PATH_URI . "/js/page_fader/page_fader.js",                         ["jquery"], '1.0.0', ['strategy' => 'defer', 'in_footer' => true]);
    }

    if ($current_setup->get("parallaxheader_enabled") || $current_setup->get("parallaxbackground_enabled")) {
        wp_enqueue_script("parallax",               THEME_ASSETS_PATH_URI . "/js/parallax/parallax.min.js",                         [], null, ['strategy' => 'defer', 'in_footer' => true]);
    }

    wp_enqueue_script("rellax",                     THEME_ASSETS_PATH_URI . "/js/parallax/rellax.min.js",                           [], null, ['strategy' => 'defer', 'in_footer' => true]);
    wp_enqueue_script("page",                       THEME_ASSETS_PATH_URI . "/js/page.js",                                          ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);

    if ($current_setup->get("home_blog_same_height")) {
        wp_enqueue_script("djs",                    THEME_ASSETS_PATH_URI . "/js/djs.js",                                           ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
    }

    if ($current_setup->get("parallaxbackground_enabled")) {
        wp_enqueue_script("parallax-enabled",       THEME_ASSETS_PATH_URI . "/js/parallax/enabled.js",                              ["parallax"], null, ['strategy' => 'defer', 'in_footer' => true]);
    }

    if (class_exists("WooCommerce")) {
        wp_enqueue_style("woocommerce",             THEME_ASSETS_PATH_URI . "/css/woocommerce/woocommerce.css");
        wp_enqueue_style("woocommerce-font",        THEME_ASSETS_PATH_URI . "/css/woocommerce/font.css");
    }

    if (defined("DJS_POSTTYPE_PLUGIN")) {
        if (is_page_template("template-specials/portfolio-2-column.php") || is_page_template("template-specials/portfolio-3-column.php") || is_page_template("template-specials/portfolio-4-column.php")) {
            wp_enqueue_style("lightbox-css",        THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_script("lightbox-js",        THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
        }

        if (PORTFOLIO_POST_TYPE == get_post_type()) {
            wp_enqueue_style("lightbox",            THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_script("lightbox1",          THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
            wp_enqueue_script("carouFredSel",       THEME_ASSETS_PATH_URI . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
            wp_enqueue_script("carouFredSel1",      THEME_ASSETS_PATH_URI . "/js/caroufredsel/caroufredsel-element.js",             ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
        }

        if (is_front_page() || is_page_template("template/homepage.php") || is_testimonial_carousel()) {
            wp_enqueue_style("lightbox",            THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_style("flexslider",          THEME_ASSETS_PATH_URI . "/css/flexslider/flexslider.css");
            wp_enqueue_script("lightbox",           THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
            wp_enqueue_script("flexslider",         THEME_ASSETS_PATH_URI . "/js/flexslider/jquery.flexslider.js",                  ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
            wp_enqueue_script("carouFredSel",       THEME_ASSETS_PATH_URI . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", ["jquery"], null, ['strategy' => 'defer', 'in_footer' => true]);
        }
    }
}
add_action("wp_enqueue_scripts", "theme_jquery_scripts");

// Muss in einem Hook stehen: Conditional Tags wie is_singular() funktionieren erst,
// wenn die Hauptquery gelaufen ist. Zur Ladezeit der functions.php lieferten sie
// immer false (plus _doing_it_wrong-Notice) -> comment-reply wurde nie geladen und
// verschachteltes Antworten war ohne Funktion.
function theme_comment_reply_script() {
    if (is_singular() && comments_open() && get_option("thread_comments")) {
        wp_enqueue_script("comment-reply");
    }
}
add_action("wp_enqueue_scripts", "theme_comment_reply_script");

function theme_custom_enqueue_css() {
    global $pagenow;

    if (in_array($pagenow, ["post.php", "post-new.php", "page-new.php", "page.php"])) {
        wp_enqueue_style("meta-box-css",            THEME_ASSETS_PATH_URI . "/css/admin/meta-box.css");
    }
    wp_enqueue_style("color-schema",                THEME_ASSETS_PATH_URI . "/customizer/color-schema.css");
}
add_action("admin_print_styles", "theme_custom_enqueue_css", 10);

function wallstreet_shortcode_detect() {
    global $wp_query;

    if (empty($wp_query->posts)) {
        return;
    }

    // Die Regex direkt auf die relevanten Shortcodes begrenzen. Vorher lief sie ueber
    // saemtliche registrierten Shortcodes und die Treffer wurden anschliessend per
    // zehnfachem in_array() nachgefiltert - jetzt matcht sie nur noch, was zaehlt,
    // und preg_match() kann beim ersten Treffer abbrechen.
    $pattern = get_shortcode_regex(["button", "row", "accordian", "tabgroup", "tabs", "alert", "dropcap", "gridsystemlayout", "tooltip", "heading"]);

    foreach ($wp_query->posts as $post) {
        // Billiger Vorfilter: ohne eckige Klammer kann kein Shortcode enthalten sein.
        if (empty($post->post_content) || strpos($post->post_content, "[") === false) {
            continue;
        }

        if (preg_match("/" . $pattern . "/s", $post->post_content)) {
            wp_enqueue_script("bootstrap",      THEME_ASSETS_PATH_URI . "/bootstrap/js/bootstrap.min.js",                       [], null, ['strategy' => 'defer', 'in_footer' => false]);
            wp_enqueue_script("accordion-tab",  THEME_ASSETS_PATH_URI . "/js/accordion-tab.js",                                 [], null, ['strategy' => 'defer', 'in_footer' => false]);
            // assets/js/collapse.js gibt es im Theme nicht - die Einreihung erzeugte nur
            // einen 404 pro Seite mit passendem Shortcode. Das Collapse-Verhalten liefert
            // ohnehin bootstrap.min.js eine Zeile darueber.
            break;
        }
    }
}
add_action("wp", "wallstreet_shortcode_detect");

function footer_custom_script() {
    $stylesheet = get_custom_stylesheet();

    if (!class_exists("WooCommerce") && !empty($stylesheet)) {
        wp_enqueue_style("woocommerce-custom",      THEME_ASSETS_PATH_URI . "/css/woocommerce/" . $stylesheet);
    }
}
add_action("wp_footer", "footer_custom_script");

if (!function_exists("wallstreet_customizer_preview_scripts")) {
    function wallstreet_customizer_preview_scripts() {
        wp_enqueue_script("ws-customizer-preview",  THEME_ASSETS_PATH_URI . "/customizer/slider/js/customizer-preview.js",          ["customize-preview", "jquery"], null, ['strategy' => 'defer', 'in_footer' => false]);
    }
}
add_action("customize_preview_init", "wallstreet_customizer_preview_scripts");

// Stand vorher im globalen Scope und griff auf ein dort nicht existierendes
// $current_setup zu. Das war nur deshalb kein Fatal Error, weil das Extensions-Plugin
// zufaellig eine gleichnamige Variable ins globale Scope legt - mit dem Setup-Objekt
// des Plugins statt dem des Themes. Die Bedingung war damit nie erfuellt (das Plugin
// kennt "remove_googlefonts" nicht), die Einstellung also wirkungslos.
function theme_remove_googlefonts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    if (!$current_setup->get("remove_googlefonts") || $current_setup->get("enable_custom_typography")) {
        return;
    }

    add_filter("style_loader_src", function ($href) {
        if (strpos($href, "//fonts.googleapis.com/") === false) {
            return $href;
        }
        return false;
    });
}
add_action("wp_enqueue_scripts", "theme_remove_googlefonts");

add_action('wp_head', function () {
    $styles = wp_styles();
    if (!$styles) return;

    $handles = [];
    foreach (['icon_font-faces', 'site_font-faces'] as $h) {
        if (isset($styles->registered[$h])) $handles[] = $h;
    }
    if (!$handles) return;

    // Die Font-Quellen selbst zu ermitteln ist billig (kein Datei-Zugriff) und dient
    // zugleich als Cache-Schluessel: wechselt die Schriftart im Customizer, aendert
    // sich der Schluessel und der Cache greift sofort neu.
    $srcs = [];
    foreach ($handles as $handle) {
        $srcs[$handle] = $styles->registered[$handle]->src ?? '';
    }

    $cache_key = 'djs_ws_font_preload_' . md5(implode('|', $srcs));
    $out = get_transient($cache_key);

    // Das Parsen darunter liest die CSS-Dateien von der Platte und jagt zwei Regexes
    // darueber. Das Ergebnis aendert sich praktisch nie, lief vorher aber bei jedem
    // einzelnen Seitenaufruf -> jetzt einmal pro Tag bzw. pro Font-Wechsel.
    if ($out === false) {
        $out = [];
        foreach ($handles as $handle) {
            $src = $srcs[$handle];
            if (!$src) continue;

            // URL → Pfad auflösen
            $path = '';
            if (str_starts_with($src, get_stylesheet_directory_uri())) {
                $path = get_stylesheet_directory() . substr($src, strlen(get_stylesheet_directory_uri()));
            } elseif (str_starts_with($src, content_url())) {
                $path = WP_CONTENT_DIR . substr($src, strlen(content_url()));
            }
            if (!$path || !is_readable($path)) continue;

            $css  = file_get_contents($path);
            if ($css === false) continue;

            // @font-face-Blöcke mit Familie + erster woff2-URL
            if (preg_match_all('/@font-face\s*{[^}]*?font-family\s*:\s*([\'"]?)([^;\'"]+)\1\s*;[^}]*?src\s*:\s*([^;]+);/is', $css, $m, PREG_SET_ORDER)) {
                $base = trailingslashit(dirname($src));
                foreach ($m as $blk) {
                    $family = trim($blk[2]);
                    $srcdecl = $blk[3];

                    if (!preg_match('/url\((["\']?)([^)]+\.woff2[^)]*)\1\)/i', $srcdecl, $u)) continue;
                    $url = $u[2];
                    // relativ → absolut
                    if (str_starts_with($url, '//')) {
                        $url = 'https:' . $url;
                    } elseif (!preg_match('#^https?://#i', $url)) {
                        $url = $base . ltrim($url, './');
                    }

                    // Schema entfernen → protokoll-relative URL
                    $url = preg_replace('#^https?:#i', '', $url);

                    $key = strtolower($family);
                    // pro Familie nur einen Eintrag
                    if (!isset($out[$key])) $out[$key] = esc_url($url);
                }
            }
        }

        set_transient($cache_key, $out, DAY_IN_SECONDS);
    }

    // harte Obergrenze, sonst bremst es
    $limit = 4;
    $i = 0;
    foreach ($out as $href) {
        echo '<link rel="preload" as="font" type="font/woff2" href="' . $href . '" crossorigin>' . "\n";
        if (++$i >= $limit) break;
    }
}, 5);
