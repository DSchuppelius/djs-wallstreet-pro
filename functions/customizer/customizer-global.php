<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_global_customizer($wp_customize) {
    $wp_customize->add_panel("global_theme_settings", [
        "priority" => 0,
        "capability" => "edit_theme_options",
        "title" => __("Global options", "wallstreet"),
    ]);

    $wp_customize->add_section("themeoptions_section_settings", [
        "title" => __("Global theme options", "wallstreet"),
        "panel" => "global_theme_settings",
        "description" => "",
    ]);

    $wp_customize->add_section("wallstreet_datetime_section", [
        "title" => __("Datetime section", "wallstreet"),
        "panel" => "global_theme_settings",
        "description" => __('For more information, visit <a href="https://www.php.net/manual/en/datetime.format.php">php.net (datetime.format)</a>', "wallstreet"),
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[yearformat]", [
        "default" => __("Y", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[yearformat]", [
        "label" => __("Year dateformat", "wallstreet"),
        "section" => "wallstreet_datetime_section",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[monthyearformat]", [
        "default" => __("F Y", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[monthyearformat]", [
        "label" => __("Month/Year dateformat", "wallstreet"),
        "section" => "wallstreet_datetime_section",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[fulldateformat]", [
        "default" => __("jS F Y", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[fulldateformat]", [
        "label" => __("Full dateformat", "wallstreet"),
        "section" => "wallstreet_datetime_section",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[fulldatetimeformat]", [
        "default" => __("jS F Y - h:i a", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[fulldatetimeformat]", [
        "label" => __("Full datetimeformat", "wallstreet"),
        "section" => "wallstreet_datetime_section",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[technicalfulldatetimeformat]", [
        "default" => __("Y-m-d\TH:i:sP", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[technicalfulldatetimeformat]", [
        "label" => __("Technical full datetimeformat", "wallstreet"),
        "section" => "wallstreet_datetime_section",
        "type" => "text",
        "priority" => 100,
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

    $wp_customize->add_setting("wallstreet_pro_options[contextmenu_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contextmenu_enabled]", [
        "label" => __("Enable Contextmenu", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "checkbox",
        "priority" => 10,
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
        "default" => 0,
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
        "default" => 0,
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

    //rellax
    $wp_customize->add_setting("wallstreet_pro_options[data_rellax_speed_social_contact_header]", [
        "default" => 0,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[data_rellax_speed_social_contact_header]", [
        "label" => __("Rellax Speed (Social Contact Header)", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "-5",
            "step" => "1",
            "max" => "20",
        ],
        "priority" => 650,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[data_rellax_speed_header]", [
        "default" => 0,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[data_rellax_speed_header]", [
        "label" => __("Rellax Speed (Header)", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "-5",
            "step" => "1",
            "max" => "20",
        ],
        "priority" => 650,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[data_rellax_speed_slider]", [
        "default" => 0,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[data_rellax_speed_slider]", [
        "label" => __("Rellax Speed (Homepage Slider)", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "-5",
            "step" => "1",
            "max" => "20",
        ],
        "priority" => 650,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[data_rellax_speed_breadcrumbs]", [
        "default" => 0,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[data_rellax_speed_breadcrumbs]", [
        "label" => __("Rellax Speed (Breadcrumbs)", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "-5",
            "step" => "1",
            "max" => "20",
        ],
        "priority" => 650,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[data_rellax_speed_banner]", [
        "default" => 0,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[data_rellax_speed_banner]", [
        "label" => __("Rellax Speed (Site Banner)", "wallstreet"),
        "section" => "themeoptions_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "10",
        ],
        "priority" => 650,
        "sanitize_callback" => "sanitize_text_field",
    ]);

}
add_action("customize_register", "wallstreet_global_customizer");

function wallstrett_checkbox() {
    echo '<input name="wporg_setting_name" id="wporg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option("wporg_setting_name"), false) . ' /> <label for="wporg_setting_name">Explanation text</label>';
} ?>
