<?php
/*
 * @Theme Name	:	DJS-Wallstreet-Pro
 * @file         :	taxonomies.php
 * @package      :	DJS-Wallstreet-Pro
 * @author       :	Hari Maliya
 * @license      :	license.txt*
 * Add custom taxonomies
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function create_portfolio_taxonomy() {
    $current_options = get_current_options();
    $wallstreet_products_category_slug = $current_options["wallstreet_products_category_slug"];

    register_taxonomy(PORTFOLIO_TAXONOMY, PORTFOLIO_POST_TYPE, [
        "hierarchical" => true,
        "show_in_nav_menus" => true,
        "rewrite" => ["slug" => $wallstreet_products_category_slug],
        "label" => __("Portfolio Categories", "wallstreet"),
        "query_var" => true,
    ]);

    if (isset($_POST["action"]) && isset($_POST["taxonomy"])) {
        wp_update_term($_POST["tax_ID"], PORTFOLIO_TAXONOMY, [
            "name" => $_POST["name"],
            "slug" => $_POST["slug"],
        ]);
    } else {
        $myterms = get_terms(PORTFOLIO_TAXONOMY, ["hide_empty" => false]);
        if (empty($myterms)) {
            $defaultterm = wp_insert_term("ALL", PORTFOLIO_TAXONOMY, [
                "description" => "Default Category",
                "slug" => "ALL",
            ]);
            update_option("wallstreet_theme_default_term_id", $defaultterm["term_id"]);
        }
    }
    //update category
    if (isset($_POST["action"]) && isset($_POST["taxonomy"])) {
        wp_update_term($_POST["tag_ID"], PORTFOLIO_TAXONOMY, [
            "name" => $_POST["name"],
            "slug" => $_POST["slug"],
            "description" => $_POST["description"],
        ]);
    }
    // Delete default category
    if (isset($_POST["action"]) && isset($_POST["tag_ID"])) {
        if ($_POST["tag_ID"] == $defualt_tex_id && $_POST["action"] == "delete-tag") {
            delete_option("custom_texo_appointment");
        }
    }
}
add_action("init", "create_portfolio_taxonomy");
?>
