<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-typography.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_typography_customizer($wp_customize) {
    $wp_customize->add_panel("wallstreet_typography_setting", [
        "priority" => 1100,
        "capability" => "edit_theme_options",
        "title" => __("Typography settings", "wallstreet"),
    ]);
    // Enble / Disable typography section
    $wp_customize->add_section("wallstreet_typography_section", [
        "title" => __("Typhography enable / disable", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 0,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[enable_custom_typography]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[enable_custom_typography]", [
        "label" => __("Enable custom typography", "wallstreet"),
        "section" => "wallstreet_typography_section",
        "setting" => "wallstreet_pro_options[enable_custom_typography]",
        "type" => "checkbox",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[google_font]", [
        "default" => "El Messiri",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[google_font]", [
        "label" => __("Name of GoogleFont", "wallstreet"),
        "section" => "wallstreet_typography_section",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[remove_googlefonts]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[remove_googlefonts]", [
        "label" => __("Remove GoogleFonts (Works only, if custom typography is disabled)", "wallstreet"),
        "section" => "wallstreet_typography_section",
        "setting" => "wallstreet_pro_options[remove_googlefonts]",
        "type" => "checkbox",
    ]);

    $font_size = [];
    for ($i = 9; $i <= 100; $i++) {
        $font_size[$i] = $i;
    }

    $font_family = [
        "400" => "GoogleFont Regular",
        "300" => "GoogleFont Light",
        "600" => "GoogleFont Bold",
        "700" => "GoogleFont Black",
        "500" => "GoogleFont Medium",
        "200" => "GoogleFont Thin",
    ];

    $font_style = ["normal" => "Normal", "italic" => "Italic"];

    // General typography section
    $wp_customize->add_section("wallstreet_general_typography", [
        "title" => __("General Paragraph", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 1,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[general_typography_fontsize]", [
        "default" => 13,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[general_typography_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_general_typography",
        "setting" => "wallstreet_pro_options[general_typography_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[general_typography_fontfamily]", [
        "default" => "Helvetica Neue,Helvetica,Arial,sans-serif",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[general_typography_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_general_typography",
        "setting" => "wallstreet_pro_options[general_typography_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[general_typography_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[general_typography_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_general_typography",
        "setting" => "wallstreet_pro_options[general_typography_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Menus typography section
    $wp_customize->add_section("wallstreet_menus_typography", [
        "title" => __("Menus", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 2,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[menu_title_fontsize]", [
        "default" => 18,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[menu_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_menus_typography",
        "setting" => "wallstreet_pro_options[menu_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[menu_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[menu_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_menus_typography",
        "setting" => "wallstreet_pro_options[menu_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[menu_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[menu_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_menus_typography",
        "setting" => "wallstreet_pro_options[menu_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Post and page title typography section
    $wp_customize->add_section("wallstreet_post_page_title_typography", [
        "title" => __("Post / Page title", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 3,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[post_title_fontsize]", [
        "default" => 26,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[post_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_post_page_title_typography",
        "setting" => "wallstreet_pro_options[post_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[post_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[post_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_post_page_title_typography",
        "setting" => "wallstreet_pro_options[post_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[post_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[post_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_post_page_title_typography",
        "setting" => "wallstreet_pro_options[post_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Service typography section
    $wp_customize->add_section("service_typography", [
        "title" => __("Service title", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 4,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[service_title_fontsize]", [
        "default" => 26,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "service_typography",
        "setting" => "wallstreet_pro_options[service_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[service_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "service_typography",
        "setting" => "wallstreet_pro_options[service_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[service_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "service_typography",
        "setting" => "wallstreet_pro_options[service_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Portfolio title typography section
    $wp_customize->add_section("portfolio_typography", [
        "title" => __("Portfolio title", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 5,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_title_fontsize]", [
        "default" => 20,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "portfolio_typography",
        "setting" => "wallstreet_pro_options[portfolio_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "portfolio_typography",
        "setting" => "wallstreet_pro_options[portfolio_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "portfolio_typography",
        "setting" => "wallstreet_pro_options[portfolio_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Widget heading title typography section
    $wp_customize->add_section("wallstreet_widget_title_typography", [
        "title" => __("Widget heading title", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 6,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[widget_title_fontsize]", [
        "default" => 24,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[widget_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_widget_title_typography",
        "setting" => "wallstreet_pro_options[widget_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[widget_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[widget_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_widget_title_typography",
        "setting" => "wallstreet_pro_options[widget_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[widget_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[widget_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_widget_title_typography",
        "setting" => "wallstreet_pro_options[widget_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Call Out Area title typography section
    $wp_customize->add_section("wallstreet_site_intro_typography", [
        "title" => __("Callout title", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 7,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_title_fontsize]", [
        "default" => 34,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_title_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_site_intro_typography",
        "setting" => "wallstreet_pro_options[calloutarea_title_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_title_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_title_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_site_intro_typography",
        "setting" => "wallstreet_pro_options[calloutarea_title_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_title_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_title_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_site_intro_typography",
        "setting" => "wallstreet_pro_options[calloutarea_title_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Call Out Area description typography section
    $wp_customize->add_section("wallstreet_callout_desc_typography", [
        "title" => __("Callout description", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 8,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_description_fontsize]", [
        "default" => 15,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_description_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_callout_desc_typography",
        "setting" => "wallstreet_pro_options[calloutarea_description_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_description_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_description_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_callout_desc_typography",
        "setting" => "wallstreet_pro_options[calloutarea_description_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_description_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_description_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_callout_desc_typography",
        "setting" => "wallstreet_pro_options[calloutarea_description_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);

    // Call Out Area button typography section
    $wp_customize->add_section("wallstreet_callout_button_typography", [
        "title" => __("Callout button", "wallstreet"),
        "panel" => "wallstreet_typography_setting",
        "priority" => 9,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_purches_fontsize]", [
        "default" => 16,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_purches_fontsize]", [
        "label" => __("Font size", "wallstreet"),
        "section" => "wallstreet_callout_button_typography",
        "setting" => "wallstreet_pro_options[calloutarea_purches_fontsize]",
        "type" => "select",
        "choices" => $font_size,
        "description" => __("Pixels", "wallstreet"),
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_purches_fontfamily]", [
        "default" => "SiteFontRegular",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_purches_fontfamily]", [
        "label" => __("Font family", "wallstreet"),
        "section" => "wallstreet_callout_button_typography",
        "setting" => "wallstreet_pro_options[calloutarea_purches_fontfamily]",
        "type" => "select",
        "choices" => $font_family,
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[calloutarea_purches_fontstyle]", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[calloutarea_purches_fontstyle]", [
        "label" => __("Font style", "wallstreet"),
        "section" => "wallstreet_callout_button_typography",
        "setting" => "wallstreet_pro_options[calloutarea_purches_fontstyle]",
        "type" => "select",
        "choices" => $font_style,
    ]);
}
add_action("customize_register", "wallstreet_typography_customizer"); ?>
