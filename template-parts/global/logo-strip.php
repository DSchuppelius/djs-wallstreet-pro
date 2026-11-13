<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : logo-strip.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Logo-Leiste fuer Kunden und Partner. $args: type (client|partner).
 */

$pt   = djs_pt();
$type = ($args["type"] ?? "client") === "partner" ? "partner" : "client";
if (!$pt) {
    return;
}
$post_type = $type === "partner" ? (defined("PARTNER_POST_TYPE") ? PARTNER_POST_TYPE : "partner") : (defined("CLIENT_POST_TYPE") ? CLIENT_POST_TYPE : "client");
$items     = $type === "partner"
    ? djs_logo_items($post_type, "partnerstrip_link", "meta_partner_target", "clients")
    : djs_logo_items($post_type, "clientstrip_link", "meta_client_target", "clients");
if (!$items) {
    return;
} ?>

<section class="section logo-section <?php echo $type; ?>-section site-wrap">
    <?php djs_section_heading($pt->get("home_{$type}_title"), $pt->get("home_{$type}_description")); ?>
    <ul class="logo-strip logo-strip--<?php echo $type; ?>">
        <?php foreach ($items as $item) { ?>
            <li class="logo-strip__item <?php echo $type === "partner" ? "partners-logo" : "clients-logo"; ?> reveal">
                <?php $inner = $item["image"] ?: '<span class="logo-strip__name">' . esc_html($item["name"]) . "</span>";
                if ($item["url"] !== "") {
                    printf(
                        '<a href="%s" %s%s title="%s">%s</a>',
                        esc_url($item["url"]),
                        get_blank_target($item["new_tab"]),
                        $item["new_tab"] ? ' rel="noopener"' : "",
                        esc_attr($item["name"]),
                        $inner
                    );
                } else {
                    echo $inner;
                } ?>
            </li>
        <?php } ?>
    </ul>
</section>
