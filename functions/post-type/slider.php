<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : slider.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function slider_type() {
    $current_options = get_current_options();

    register_post_type(SLIDER_POST_TYPE, [
        "labels" => [
            "name" => __("Featured Sliders", "wallstreet"),
            "add_new" => __("Add New", "wallstreet"),
            "add_new_item" => __("Add New Slider", "wallstreet"),
            "edit_item" => __("Add New", "wallstreet"),
            "new_item" => __("New Link", "wallstreet"),
            "all_items" => __("All Featured Slides", "wallstreet"),
            "view_item" => __("View Link", "wallstreet"),
            "search_items" => __("Search Links", "wallstreet"),
            "not_found" => __("No Links found", "wallstreet"),
            "not_found_in_trash" => __("No Links found in Trash", "wallstreet"),
        ],
        "supports" => ["title", "thumbnail"],
        "show_in" => true,
        "show_in_nav_menus" => false,
        "public" => true,
        "menu_position" => 20,
        "rewrite" => ["slug" => $current_options["slider_slug"]],
        "public" => true,
        "menu_icon" => THEME_ASSETS_PATH_URI . "/images/slider.png",
    ]);
}
add_action("init", "slider_type");
