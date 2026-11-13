<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : servic.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Service-Sektion der Startseite (ersetzt servic-1.php ... servic-6.php).
 * Customizer: service_variation (1-6), service_list (Anzahl), service_hover_change_effect,
 * service_middle_extrapadding.
 */

$pt = djs_pt();
if (!$pt) {
    return;
}
$variant = max(1, min(6, (int) ($args["variant"] ?? $pt->get("service_variation")))); ?>

<section class="section service-section site-wrap">
    <?php djs_section_heading($pt->get("service_title"), $pt->get("service_description")); ?>
    <?php get_template_part("template-parts/service/grid", null, [
        "items"   => djs_service_items((int) $pt->get("service_list") ?: -1),
        "variant" => $variant,
        "hover"   => (bool) $pt->get("service_hover_change_effect"),
        "padding" => (bool) $pt->get("service_middle_extrapadding"),
    ]); ?>
</section>
