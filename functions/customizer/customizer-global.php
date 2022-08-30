<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_scroll_to_top_customizer($wp_customize) {
    //Scroll To Top Section
    $wp_customize->add_section("themeoptions_section_settings", [
        "title" => __("Global theme options", "wallstreet"),
        "description" => "",
    ]);

    //Hide scroll to top
    $wp_customize->add_setting("wallstreet_pro_options[scroll_to_top_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[scroll_to_top_enabled]", [
        "label" => __("Enable Scroll To Top Setting", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[fixedheader_enabled]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[fixedheader_enabled]", [
        "label" => __("Fixed header", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 10,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[fixedfooter_enabled]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[fixedfooter_enabled]", [
        "label" => __("Fixed footer", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 200,
    ]);

    //Parallax Background
    $wp_customize->add_setting("wallstreet_pro_options[parallaxbackground_enabled]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[parallaxbackground_enabled]", [
        "label" => __("Enable Parallax Background", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 210,
    ]);

    //Parallax Header
    $wp_customize->add_setting("wallstreet_pro_options[parallaxheader_enabled]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[parallaxheader_enabled]", [
        "label" => __("Enable Parallax Header", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 220,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[bigborder]", [
        "default" => false,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[bigborder]", [
        "type" => "checkbox",
        "label" => __("Enable Big Border", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "priority" => 300,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[page_fader_enabled]", [
        "default" => false,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[page_fader_enabled]", [
        "type" => "checkbox",
        "label" => __("Enable Fader on Pageload", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "priority" => 400,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[addframe]", [
        "default" => false,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[addframe]", [
        "type" => "checkbox",
        "label" => __("Enable frame on pages", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "priority" => 500,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[addflexelements]", [
        "default" => false,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[addflexelements]", [
        "type" => "checkbox",
        "label" => __("Add filling elements to pages", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "priority" => 500,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[breadcrumbposition]", [
        "default" => __("0", "wallstreet"),
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[breadcrumbposition]", [
        "label" => __("Custom breadcrumb position", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "90",
        ],
        "priority" => 600,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[contentposition]", [
        "default" => __("0", "wallstreet"),
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[contentposition]", [
        "label" => __("Custom content position", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "210",
        ],
        "priority" => 600,
        "sanitize_callback" => "sanitize_text_field",
    ]);
}
add_action("customize_register", "wallstreet_scroll_to_top_customizer");

function wallstrett_checkbox() {
    echo '<input name="wporg_setting_name" id="wporg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option("wporg_setting_name"), false) . ' /> <label for="wporg_setting_name">Explanation text</label>';
} ?>
