<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-team.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_hometeam_customizer($wp_customize) {
    //Home project Section
    $wp_customize->add_panel("team_setting", [
        "priority" => 699,
        "capability" => "edit_theme_options",
        "title" => __("Team settings", "wallstreet"),
    ]);

    $wp_customize->add_section("team_section_settings", [
        "title" => __("Homepage team settings", "wallstreet"),
        "description" => "",
        "panel" => "team_setting",
    ]);

    // hometeam Design layout
    $wp_customize->add_setting("wallstreet_pro_options[team_design_style]", [
        "default" => 1,
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[team_design_style]", [
        "type" => "select",
        "label" => __("Team design style", "wallstreet"),
        "section" => "team_section_settings",
        "choices" => [
            1 => __("Style 1", "wallstreet"),
            2 => __("Style 2", "wallstreet"),
            3 => __("Style 3", "wallstreet"),
            4 => __("Style 4", "wallstreet"),
        ],
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[team_design_layout_style]", [
        "default" => 4,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[team_design_layout_style]", [
        "type" => "select",
        "label" => __("Team design style", "wallstreet"),
        "section" => "team_section_settings",
        "choices" => [
            6 => __("2 Column Layout", "wallstreet"),
            4 => __("3 Column Layout", "wallstreet"),
            3 => __("4 Column Layout", "wallstreet"),
        ],
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_team_title]", [
        "default" => __("The Team", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_team_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "team_section_settings",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_team_description]", [
        "default" => __("Meet Our Experts", "wallstreet"),
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_team_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "team_section_settings",
        "type" => "text",
        "sanitize_callback" => "sanitize_text_field",
        "priority" => 200,
    ]);
}
add_action("customize_register", "wallstreet_hometeam_customizer"); ?>
