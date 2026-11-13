<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-features.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Feature-Sektion: Bild + bis zu drei Merkmale (Customizer des Post-Types-Plugins).
 */

$pt = djs_pt();
if (!$pt || !$pt->get("theme_feature_enabled")) {
    return;
}
$image    = (string) $pt->get("theme_feature_image");
$link     = (string) $pt->get("feature_image_link");
$new_tab  = (bool) $pt->get("image_link_target");
$bg       = (string) $pt->get("theme_feature_background");
$features = [];
foreach (["first", "second", "third"] as $n) {
    $f = [
        "icon"  => (string) $pt->get("theme_{$n}_feature_icon"),
        "title" => (string) $pt->get("theme_{$n}_title"),
        "text"  => (string) $pt->get("theme_{$n}_description"),
    ];
    if ($f["icon"] !== "" || $f["title"] !== "" || $f["text"] !== "") {
        $features[] = $f;
    }
} ?>

<section class="section section--bleed features-section<?php echo $pt->get("theme_feature_background_fixed") ? " section--fixed-bg" : ""; ?>"<?php echo $bg ? ' style="--section-bg: url(\'' . esc_url($bg) . '\')"' : ""; ?>>
    <div class="section--bleed__overlay">
        <div class="site-wrap features<?php echo $image ? " features--with-image" : ""; ?>">
            <?php if ($image) { ?>
                <div class="features__media reveal">
                    <?php if ($link) { ?><a href="<?php echo esc_url($link); ?>" <?php blank_target($new_tab); ?><?php echo $new_tab ? ' rel="noopener"' : ""; ?>><?php } ?>
                    <img class="features__img features-img" src="<?php echo esc_url($image); ?>" alt="" loading="lazy">
                    <?php if ($link) { ?></a><?php } ?>
                </div>
            <?php } ?>
            <div class="features__body">
                <?php if ($pt->get("theme_feature_title")) { ?>
                    <h2 class="features__title features-title"><?php echo wp_kses_post($pt->get("theme_feature_title")); ?></h2>
                <?php } ?>
                <ul class="features__list">
                    <?php foreach ($features as $f) { ?>
                        <li class="feature-item reveal">
                            <?php if ($f["icon"] !== "") { ?>
                                <span class="feature-item__icon" aria-hidden="true"><i class="fa <?php echo esc_attr($f["icon"]); ?>"></i></span>
                            <?php } ?>
                            <div>
                                <?php if ($f["title"] !== "") { ?><h3 class="feature-item__title"><?php echo wp_kses_post($f["title"]); ?></h3><?php } ?>
                                <?php if ($f["text"] !== "") { ?><p class="feature-item__text"><?php echo wp_kses_post($f["text"]); ?></p><?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
