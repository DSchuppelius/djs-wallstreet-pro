<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : generator.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wp_version_remove_version() {
    return "";
}
add_filter("the_generator", "wp_version_remove_version");

function remove_version_from_style_js($src) {
    if (strpos($src, "ver=" . get_bloginfo("version"))) {
        $src = remove_query_arg("ver", $src);
    }
    return $src;
}
add_filter("style_loader_src", "remove_version_from_style_js");
add_filter("script_loader_src", "remove_version_from_style_js");
add_filter("revslider_meta_generator", "wp_version_remove_version");

add_action("init", function () {
    if (function_exists("visual_composer") || class_exists("Vc_Manager")) {
        remove_action("wp_head", [visual_composer(), "addMetaData"]);
    }
});
remove_action("wp_head", "wp_generator");

function jptweak_remove_share() {
    remove_filter("the_excerpt", "sharing_display", 19);
    if (!is_single()) {
        remove_filter("the_content", "sharing_display", 19);
    }
}
add_action("loop_start", "jptweak_remove_share");

?>