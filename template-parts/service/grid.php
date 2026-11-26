<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : grid.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Raster aus Service-Karten. $args: items, variant (1-6), hover (bool), padding (bool).
 */

$items   = $args["items"] ?? [];
$variant = max(1, min(6, (int) ($args["variant"] ?? 1)));
if (!$items) {
    return;
}
$classes = ["service-grid", "service-grid--v" . $variant, "card-grid"];
$classes[] = count($items) >= 4 && $variant === 6 ? "card-grid--4" : "card-grid--3";
if (!empty($args["hover"])) {
    $classes[] = "service-grid--hover";
}
if (!empty($args["padding"])) {
    $classes[] = "service-grid--roomy";
} ?>
<div class="<?php echo esc_attr(implode(" ", $classes)); ?>">
    <?php foreach (array_values($items) as $i => $item) {
        get_template_part("template-parts/service/card", null, ["item" => $item, "variant" => $variant, "index" => $i]);
    } ?>
</div>
