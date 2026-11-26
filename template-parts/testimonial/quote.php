<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : quote.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Einzelnes Testimonial. $args: item (name, text, image), variant (1-4).
 */

$item    = $args["item"] ?? [];
$variant = (int) ($args["variant"] ?? 1);
if (!$item) {
    return;
} ?>
<figure class="quote-card quote-card--v<?php echo $variant; ?>">
    <?php if ($item["image"]) { ?>
        <div class="quote-card__avatar"><?php echo $item["image"]; ?></div>
    <?php } ?>
    <blockquote class="quote-card__text">
        <p><?php echo esc_html($item["text"]); ?></p>
    </blockquote>
    <figcaption class="quote-card__name"><?php echo esc_html($item["name"]); ?></figcaption>
</figure>
