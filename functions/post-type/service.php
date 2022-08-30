<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function service_type() {
    $current_options = get_current_options();
    $service_slug = $current_options["service_slug"];

    register_post_type(SERVICE_POST_TYPE, [
        "labels" => [
            "name" => __("Featured Services", "wallstreet"),
            "add_new" => __("Add New", "wallstreet"),
            "add_new_item" => __("Add New Service", "wallstreet"),
            "edit_item" => __("Add New", "wallstreet"),
            "new_item" => __("New Link", "wallstreet"),
            "all_items" => __("All Services", "wallstreet"),
            "view_item" => __("View Link", "wallstreet"),
            "search_items" => __("Search Links", "wallstreet"),
            "not_found" => __("No Links found", "wallstreet"),
            "not_found_in_trash" => __("No Links found in Trash", "wallstreet"),
        ],
        "supports" => ["title", "thumbnail"],
        "show_in" => true,
        "show_in_nav_menus" => false,
        "rewrite" => ["slug" => $service_slug],
        "public" => true,
        "menu_position" => 20,
        "public" => true,
        "menu_icon" => THEME_ASSETS_PATH_URI . "/images/service.png",
    ]);
}
add_action("init", "service_type");
