<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : testimonial.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Testimonials. Ersetzt testimonial-1.php ... testimonial-4.php und carousel-script.php.
 * Auf der Startseite und den Karussell-Templates als Karussell (Customizer: Effekt, Anzahl,
 * Dauer, Pause), auf den Grid-Templates als Raster. Kartenstil 1-4 = testimonial_design_style.
 */

$pt = djs_pt();
if (!$pt) {
    return;
}
$style    = max(1, min(4, (int) ($args["variant"] ?? $pt->get("testimonial_design_style"))));
$items    = djs_testimonial_items();
$carousel = is_testimonial_carousel() || is_front_page();
$bg       = (string) $pt->get("testimonial_background");
if (!$items) {
    return;
}
if ($carousel) {
    djs_use_script("carousel");
}

// Customizer "Slidertyp": scroll = schieben, fade / crossfade / cover-fade = ueberblenden (wie bisher carouFredSel)
$effect   = in_array($pt->get("testimonial_slide_type"), ["fade", "crossfade", "cover-fade", "cover", "uncover"], true) ? "fade" : "slide"; ?>

<section class="section section--bleed testimonial-section testimonial-section--v<?php echo $style; ?>"<?php echo $bg ? ' style="--section-bg: url(\'' . esc_url($bg) . '\')"' : ""; ?>>
    <div class="section--bleed__overlay">
        <div class="site-wrap">
            <?php if ($carousel) { ?>
                <div class="carousel carousel--quotes" data-carousel
                    data-effect="<?php echo esc_attr($effect); ?>"
                    data-per-view="1"
                    data-step="<?php echo max(1, (int) $pt->get("testimonial_scroll_items")); ?>"
                    data-speed="<?php echo max(100, (int) $pt->get("testimonial_scroll_duration")); ?>"
                    data-autoplay="<?php echo max(500, (int) $pt->get("testimonial_timeout_duration")); ?>"
                    aria-roledescription="carousel" aria-label="<?php esc_attr_e("Testimonials", "djs-wallstreet-pro"); ?>">
                    <div class="carousel__viewport">
                        <div class="carousel__track">
                            <?php foreach ($items as $i => $item) { ?>
                                <div class="carousel__slide" role="group" aria-roledescription="slide">
                                    <?php get_template_part("template-parts/testimonial/quote", null, ["item" => $item, "variant" => $style]); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php get_template_part("template-parts/global/carousel", "controls"); ?>
                </div>
            <?php } else { ?>
                <div class="card-grid card-grid--2 testimonial-grid">
                    <?php foreach ($items as $item) {
                        get_template_part("template-parts/testimonial/quote", null, ["item" => $item, "variant" => $style]);
                    } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
