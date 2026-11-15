<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-banner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seitenkopf mit Header-Bild, Seitentitel und Brotkruemelpfad.
 * Das Bild ist ein echtes <img> (statt CSS-Hintergrund): es kann priorisiert geladen
 * werden (LCP), bekommt srcset und fuer "Parallax-Header" verschiebt es theme.js.
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
global $loaded_banner;
$loaded_banner = true;

/* ---- Header-Bild ---------------------------------------------------- */
// Neben der Mediathek-ID wird das Seitenverhaeltnis des angezeigten Bildes (banner-thumb bzw.
// Standardbild des Themes) ermittelt: der Banner ist wie bisher so hoch wie das Bild in voller
// Seitenbreite (siehe glass.css, --banner-ratio).
$header_url   = get_header_image();
$header_id    = 0;
$header_ratio = 0.0;
if (!empty($header_url)) {
    $cache_key = "djs_ws_banner_" . md5($header_url);
    $cached    = get_transient($cache_key);
    if (!is_array($cached) || count($cached) !== 2) {
        $id    = (int) attachment_url_to_postid($header_url);
        $ratio = 0.0;
        if ($id) {
            $src = wp_get_attachment_image_src($id, "banner-thumb");
            if ($src && $src[1] > 0) {
                $ratio = $src[2] / $src[1];
            }
        } else {
            // Standardbild aus dem Theme (kein Mediathek-Eintrag): Masse aus der Datei,
            // die Angabe in add_theme_support('custom-header') passt nicht zum Bild
            $theme_uri = get_template_directory_uri();
            if (str_starts_with($header_url, $theme_uri)) {
                $size = wp_getimagesize(get_template_directory() . substr($header_url, strlen($theme_uri)));
                if ($size && $size[0] > 0) {
                    $ratio = $size[1] / $size[0];
                }
            }
        }
        $cached = [$id, $ratio];
        set_transient($cache_key, $cached, DAY_IN_SECONDS);
    }
    [$header_id, $header_ratio] = $cached;
}

/* ---- Titel ---------------------------------------------------------- */
$format_titles = [
    "post-format-aside"   => __("Aside Archives", "djs-wallstreet-pro"),
    "post-format-audio"   => __("Audio Archives", "djs-wallstreet-pro"),
    "post-format-chat"    => __("Chat Archives", "djs-wallstreet-pro"),
    "post-format-gallery" => __("Gallery Archives", "djs-wallstreet-pro"),
    "post-format-image"   => __("Image Archives", "djs-wallstreet-pro"),
    "post-format-link"    => __("Link Archives", "djs-wallstreet-pro"),
    "post-format-quote"   => __("Quote Archives", "djs-wallstreet-pro"),
    "post-format-status"  => __("Status Archives", "djs-wallstreet-pro"),
    "post-format-video"   => __("Video Archives", "djs-wallstreet-pro"),
];

if (is_front_page()) {
    $title = esc_html__("Home", "djs-wallstreet-pro");
} elseif (is_home()) {
    $title = esc_html(single_post_title("", false));
} elseif (is_loaded_template("category.php")) {
    $title = sprintf(esc_html__("Category Archive: %s", "djs-wallstreet-pro"), "<span>" . esc_html(single_cat_title("", false)) . "</span>");
} elseif (is_loaded_template("tag.php")) {
    $title = sprintf(esc_html__("Tag Archive: %s", "djs-wallstreet-pro"), "<span>" . esc_html(single_tag_title("", false)) . "</span>");
} elseif (is_loaded_template("author.php")) {
    $title = sprintf(
        esc_html__("Author Archive: %s", "djs-wallstreet-pro"),
        '<a href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '" rel="me">' . esc_html(get_the_author()) . "</a>"
    );
} elseif (is_loaded_template("archive.php")) {
    $format = get_query_var("post_format");
    if (isset($format_titles[$format])) {
        $title = esc_html($format_titles[$format]);
    } elseif (is_day()) {
        $title = esc_html__("Daily Archive", "djs-wallstreet-pro") . " " . esc_html(get_the_date($current_setup->get("fulldateformat")));
    } elseif (is_month()) {
        $title = esc_html__("Monthly Archive", "djs-wallstreet-pro") . " " . esc_html(get_the_date($current_setup->get("monthyearformat")));
    } elseif (is_year()) {
        $title = esc_html__("Yearly Archive", "djs-wallstreet-pro") . " " . esc_html(get_the_date($current_setup->get("yearformat")));
    } else {
        $title = esc_html__("Blog Archive", "djs-wallstreet-pro");
    }
} elseif (class_exists("WooCommerce") && function_exists("is_shop") && is_shop()) {
    $title = esc_html(woocommerce_page_title(false));
} elseif (is_archive()) {
    $title = get_the_archive_title();
} elseif (is_search()) {
    $title = sprintf(esc_html__("Search results for: %s", "djs-wallstreet-pro"), '<span>"' . esc_html(get_search_query()) . '"</span>');
} elseif (is_404()) {
    $title = esc_html__("Error 404", "djs-wallstreet-pro");
} else {
    $title = esc_html(get_the_title());
}

$parallax = (bool) $current_setup->get("parallaxheader_enabled"); ?>

<section class="page-banner page-mycarousel<?php echo $parallax ? " page-banner--parallax" : ""; ?>"<?php echo $header_ratio > 0 ? sprintf(' style="--banner-ratio: %.5F"', $header_ratio) : ""; ?> aria-labelledby="page-title">
    <?php if (!empty($header_url)) { ?>
        <div class="page-banner__media" aria-hidden="true">
            <?php if ($header_id) {
                echo wp_get_attachment_image($header_id, "banner-thumb", false, [
                    "class"         => "page-banner__img header-img",
                    "alt"           => "",
                    "loading"       => "eager",
                    "fetchpriority" => "high",
                    "decoding"      => "async",
                    "sizes"         => "100vw",
                    "data-parallax" => $parallax ? "0.8" : false,
                ]);
            } else { ?>
                <img class="page-banner__img header-img" src="<?php echo esc_url($header_url); ?>" alt="" fetchpriority="high" decoding="async" <?php echo $parallax ? 'data-parallax="0.8"' : ""; ?>>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="site-wrap page-banner__content page-title-col">
        <h1 id="page-title" class="page-banner__title"><?php echo $title; ?></h1>
    </div>

    <?php get_template_part("template-parts/global/breadcrumb"); ?>
</section>

<?php if (show_rellax_div()) { ?>
    <div class="site-main rellax" data-rellax-speed="<?php echo intval($current_setup->get("data_rellax_speed_banner")); ?>">
<?php } ?>
