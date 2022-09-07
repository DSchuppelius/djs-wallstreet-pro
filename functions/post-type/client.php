<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : client.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function client_type() {
    $current_options = get_current_options();

    register_post_type(CLIENT_POST_TYPE, [
        "labels" => [
            "name" => __("Clients", "wallstreet"),
            "add_new" => __("Add New", "wallstreet"),
            "add_new_item" => __("Add New Client", "wallstreet"),
            "edit_item" => __("Add New", "wallstreet"),
            "new_item" => __("New Link", "wallstreet"),
            "all_items" => __("All Clients", "wallstreet"),
            "view_item" => __("View Link", "wallstreet"),
            "search_items" => __("Search Links", "wallstreet"),
            "not_found" => __("No Links found", "wallstreet"),
            "not_found_in_trash" => __("No Links found in Trash", "wallstreet"),
        ],
        "supports" => ["title", "thumbnail"],
        "show_in" => true,
        "public" => true,
        "menu_position" => 20,
        "rewrite" => ["slug" => $current_options["client_slug"]],
        "public" => true,
        "menu_icon" => THEME_ASSETS_PATH_URI . "/images/satisfied-clients.jpg",
    ]);
}
add_action("init", "client_type");
