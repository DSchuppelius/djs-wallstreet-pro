<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-slider.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Startseiten-Slider.
 *  - slidertype "base":       eigene Slides (Post-Type Slider), Karussell ohne jQuery (ersetzt Flexslider)
 *  - slidertype "revolution": Slider Revolution ueber add_revslider() - unveraendert
 *  - sonst:                   Seitenbanner
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$pt            = djs_pt();
$enabled       = $pt && $pt->get("home_slider_enabled");
$type          = $pt ? $pt->get("slidertype") : "";
$rellax        = intval($current_setup->get("data_rellax_speed_slider"));

/* ---- Slider Revolution (unveraendert) -------------------------------- */
if ($enabled && $type === "revolution" && function_exists("add_revslider")) { ?>
    <div class="homepage_mycarousel hero-revslider <?php echo esc_attr($pt->get("revolutionslidername")); ?> rellax" data-rellax-speed="<?php echo $rellax; ?>">
        <?php add_revslider($pt->get("revolutionslidername")); ?>
    </div>
    <?php return;
}

/* ---- Kein Slider: Seitenbanner --------------------------------------- */
if (!$enabled || $type !== "base" || !defined("SLIDER_POST_TYPE")) {
    get_template_part("template-parts/index/index", "banner");
    return;
}

/* ---- Eigener Slider --------------------------------------------------- */
djs_use_script("carousel");

// Sichtbarkeit je Element und Geraet (Customizer: Titel/Untertitel/Text/Button auf Desktop/Mobil)
$visibility = static function (string $part) use ($pt): string {
    $classes = [];
    if (!$pt->get("home_slider_desktop_{$part}_enabled")) {
        $classes[] = "hide-desktop";
    }
    if (!$pt->get("home_slider_mobile_{$part}_enabled")) {
        $classes[] = "hide-mobile";
    }
    return $classes ? " " . implode(" ", $classes) : "";
};

$query  = new WP_Query(["post_type" => SLIDER_POST_TYPE, "posts_per_page" => -1, "no_found_rows" => true]);
$slides = [];
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $slides[] = [
            "image"    => has_post_thumbnail() ? get_post_thumbnail_id() : 0,
            "title"    => get_the_title(),
            "subtitle" => (string) get_post_meta(get_the_ID(), "slider_title", true),
            "text"     => (string) get_post_meta(get_the_ID(), "slider_description", true),
            "button"   => (string) get_post_meta(get_the_ID(), "slider_button_text", true),
            "url"      => (string) get_post_meta(get_the_ID(), "slider_button_link", true),
            "new_tab"  => (bool) get_post_meta(get_the_ID(), "slider_button_target", true),
        ];
    }
    wp_reset_postdata();
} else {
    for ($i = 1; $i <= 3; $i++) {
        $slides[] = [
            "image_url" => THEME_ASSETS_PATH_URI . "/images/slider/slide{$i}.jpg",
            "title"     => __("Clean & fresh theme", "djs-wallstreet-pro"),
            "subtitle"  => __("Welcome to wallstreet", "djs-wallstreet-pro"),
            "text"      => __("The state-of-the-art HTML5 powered flexible layout with lightspeed fast CSS3 transition effects. Works perfect in any modern mobile.", "djs-wallstreet-pro"),
            "button"    => __("Purchase Now", "djs-wallstreet-pro"),
            "url"       => "#",
            "new_tab"   => false,
        ];
    }
}

$effect = $pt->get("animation") === "fade" ? "fade" : "slide"; ?>

<?php /* Wie bisher: der Slidername steht als Klasse am Slider (eigenes CSS kann ihn ansprechen) */ ?>
<section class="homepage_mycarousel hero-slider <?php echo esc_attr(sanitize_html_class((string) $pt->get("revolutionslidername"))); ?> rellax" data-rellax-speed="<?php echo $rellax; ?>" aria-label="<?php esc_attr_e("Slider", "djs-wallstreet-pro"); ?>">
    <div class="carousel carousel--hero" data-carousel
        data-effect="<?php echo esc_attr($effect); ?>"
        data-direction="<?php echo $pt->get("slide_direction") === "vertical" ? "vertical" : "horizontal"; ?>"
        data-speed="<?php echo max(100, (int) $pt->get("animationSpeed")); ?>"
        data-autoplay="<?php echo max(500, (int) $pt->get("slideshowSpeed")); ?>"
        aria-roledescription="carousel">
        <div class="carousel__viewport">
            <div class="carousel__track">
                <?php foreach ($slides as $i => $slide) {
                    $heading = $i === 0 ? "h1" : "p"; ?>
                    <div class="carousel__slide hero-slide" role="group" aria-roledescription="slide">
                        <?php if (!empty($slide["image"])) {
                            echo wp_get_attachment_image($slide["image"], "bigbanner-thumb", false, [
                                "class"         => "hero-slide__img",
                                "alt"           => "",
                                "sizes"         => "100vw",
                                "loading"       => $i === 0 ? "eager" : "lazy",
                                "fetchpriority" => $i === 0 ? "high" : "auto",
                            ]);
                        } elseif (!empty($slide["image_url"])) { ?>
                            <img class="hero-slide__img" src="<?php echo esc_url($slide["image_url"]); ?>" alt="" <?php echo $i ? 'loading="lazy"' : 'fetchpriority="high"'; ?>>
                        <?php } ?>
                        <div class="hero-slide__caption flex-slider-center">
                            <div class="site-wrap">
                                <p class="hero-slide__eyebrow slide-text-bg1<?php echo $visibility("title"); ?>"><?php echo esc_html($slide["title"]); ?></p>
                                <?php if ($slide["subtitle"] !== "") { ?>
                                    <<?php echo $heading; ?> class="hero-slide__title slide-text-bg2<?php echo $visibility("subtitle"); ?>"><?php echo wp_kses_post($slide["subtitle"]); ?></<?php echo $heading; ?>>
                                <?php } ?>
                                <?php if ($slide["text"] !== "") { ?>
                                    <p class="hero-slide__text slide-text-bg3<?php echo $visibility("desc"); ?>"><?php echo wp_kses_post($slide["text"]); ?></p>
                                <?php } ?>
                                <?php if ($slide["button"] !== "") { ?>
                                    <a class="btn btn-primary btn-lg hero-slide__button flex_btn<?php echo $visibility("button"); ?>" href="<?php echo esc_url($slide["url"] ?: "#"); ?>" <?php blank_target($slide["new_tab"]); ?><?php echo $slide["new_tab"] ? ' rel="noopener"' : ""; ?>>
                                        <?php echo esc_html($slide["button"]); ?><span class="material-icons" aria-hidden="true">arrow_forward</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if (count($slides) > 1) {
            get_template_part("template-parts/global/carousel", "controls");
        } ?>
    </div>
</section>
