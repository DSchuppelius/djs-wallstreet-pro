<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$is_woocommerce = class_exists("WooCommerce") && (is_account_page() || is_cart() || is_checkout());

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start([
    "area"  => $is_woocommerce ? "woocommerce" : "sidebar_primary",
    "class" => "page-default",
]);

while (have_posts()) {
    the_post();
    get_template_part("template-parts/content/content", "complete");
    comments_template("", true);
}

djs_layout_end();
get_footer();
