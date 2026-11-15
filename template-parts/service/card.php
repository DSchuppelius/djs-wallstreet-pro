<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : card.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Service-Karte. $args: item (djs_service_item), variant (1-6).
 */

$item    = $args["item"] ?? [];
$variant = (int) ($args["variant"] ?? 1);
$index   = (int) ($args["index"] ?? 0);
if (!$item) {
    return;
}
$target = $item["new_tab"] ? ' target="_blank" rel="noopener"' : ""; ?>

<article class="service-card service-card--v<?php echo $variant; ?><?php echo $variant === 1 ? " surface-card" : ""; ?> reveal<?php echo $item["image"] && !$item["icon"] ? " has-image" : ($item["icon"] ? " has-icon" : ""); ?>" style="--i: <?php echo $index; ?>">
    <a class="service-card__visual" href="<?php echo esc_url($item["url"]); ?>"<?php echo $target; ?> tabindex="-1" aria-hidden="true">
        <?php if ($item["icon"]) { ?>
            <span class="service-card__icon"><i class="fa <?php echo esc_attr($item["icon"]); ?>"></i></span>
        <?php } elseif ($item["image"]) {
            echo $item["image"];
        } else { ?>
            <span class="service-card__icon"><span class="material-icons">widgets</span></span>
        <?php } ?>
    </a>
    <div class="service-card__body">
        <h3 class="service-card__title"><a href="<?php echo esc_url($item["url"]); ?>"<?php echo $target; ?>><?php echo esc_html($item["title"]); ?></a></h3>
        <?php if ($item["text"] !== "") { ?>
            <p class="service-card__text"><?php echo $item["text"]; ?></p>
        <?php } ?>
        <?php if ($item["more"] !== "") { ?>
            <?php /* Stil 1: Glanz-Button mit Icon-Feld, Stil 6: Button in Themefarbe, sonst Rahmen-Button (wie bisher) */
            $more_class = $variant === 1 ? "btn-primary more services" : ($variant === 6 ? "btn-primary" : "btn-outline"); ?>
            <a class="service-card__more btn btn-sm <?php echo esc_attr($more_class); ?>" href="<?php echo esc_url($item["url"]); ?>"<?php echo $target; ?>>
                <?php echo esc_html($item["more"]); ?><?php if ($variant === 1) { ?><span class="material-icons" aria-hidden="true">person_search</span><?php } ?>
            </a>
        <?php } ?>
    </div>
</article>
