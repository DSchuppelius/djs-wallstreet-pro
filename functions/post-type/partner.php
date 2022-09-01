<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : client.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function partner_type() {
    $current_options = get_current_options();
    $partner_slug = $current_options["partner_slug"];

    register_post_type(PARTNER_POST_TYPE, [
        "labels" => [
            "name" => __("Partner", "wallstreet"),
            "add_new" => __("Add New", "wallstreet"),
            "add_new_item" => __("Add New Partner", "wallstreet"),
            "edit_item" => __("Add New", "wallstreet"),
            "new_item" => __("New Link", "wallstreet"),
            "all_items" => __("All Partner", "wallstreet"),
            "view_item" => __("View Link", "wallstreet"),
            "search_items" => __("Search Links", "wallstreet"),
            "not_found" => __("No Links found", "wallstreet"),
            "not_found_in_trash" => __("No Links found in Trash", "wallstreet"),
        ],
        "supports" => ["title", "thumbnail"],
        "show_in" => true,
        "public" => true,
        "menu_position" => 20,
        "rewrite" => ["slug" => $partner_slug],
        "public" => true,
        "menu_icon" => THEME_ASSETS_PATH_URI . "/images/satisfied-clients.jpg",
    ]);
}
add_action("init", "partner_type");
