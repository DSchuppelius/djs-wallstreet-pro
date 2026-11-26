<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : card.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Portfolio-Kachel mit Hover-Overlay. $args: item (djs_portfolio_item), button (Text oder ""),
 * shape ("", "block" oder "clover").
 */

$item   = $args["item"] ?? [];
$button = (string) ($args["button"] ?? "");
$shape  = (string) ($args["shape"] ?? "");
$index  = (int) ($args["index"] ?? 0);
if (!$item) {
    return;
}
$target = $item["new_tab"] ? ' target="_blank" rel="noopener"' : ""; ?>

<article class="portfolio-card<?php echo $shape ? " portfolio-card--" . esc_attr($shape) : ""; ?> reveal" style="--i: <?php echo $index; ?>">
    <div class="portfolio-card__media">
        <?php echo $item["image"] ?: '<span class="portfolio-card__placeholder material-icons" aria-hidden="true">image</span>'; ?>
        <div class="portfolio-card__overlay">
            <h3 class="portfolio-card__title"><a href="<?php echo esc_url($item["url"]); ?>"<?php echo $target; ?>><?php echo esc_html($item["title"]); ?></a></h3>
            <?php if ($item["excerpt"] !== "") { ?>
                <p class="portfolio-card__text"><?php echo esc_html($item["excerpt"]); ?></p>
            <?php } ?>
            <div class="portfolio-card__actions">
                <?php if ($item["show_image"] && $item["full"]) { ?>
                    <a class="btn btn-circle btn-sm" href="<?php echo esc_url($item["full"]); ?>" data-lightbox="portfolio" data-title="<?php echo esc_attr($item["title"]); ?>">
                        <span class="material-icons" aria-hidden="true">zoom_in</span><span class="screen-reader-text"><?php esc_html_e("Enlarge image", "djs-wallstreet-pro"); ?></span>
                    </a>
                <?php } ?>
                <a class="btn btn-circle btn-sm" href="<?php echo esc_url($item["url"]); ?>"<?php echo $target; ?> title="<?php echo esc_attr($item["summary"]); ?>">
                    <span class="material-icons" aria-hidden="true">link</span><span class="screen-reader-text"><?php echo esc_html($item["summary"]); ?></span>
                </a>
                <?php if ($button !== "") { ?>
                    <a class="btn btn-sm btn-primary" href="<?php echo esc_url($item["button_url"]); ?>"<?php echo $item["button_tab"] ? ' target="_blank" rel="noopener"' : ""; ?>><?php echo esc_html($button); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</article>
