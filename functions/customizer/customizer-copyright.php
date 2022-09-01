<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-copyright.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_copyright_customizer($wp_customize) {
    $wp_customize->add_panel("wallstreet_copyright_setting", [
        "priority" => 900,
        "capability" => "edit_theme_options",
        "title" => __("Footer copyright settings", "wallstreet"),
    ]);

    $wp_customize->add_section("copyright_section_one", [
        "title" => __("Footer copyright settings", "wallstreet"),
        "priority" => 35,
        "panel" => "wallstreet_copyright_setting",
    ]);

    //Hide scroll to top
    $wp_customize->add_setting("wallstreet_pro_options[footer_link_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[footer_link_enabled]", [
        "label" => __("Enable Footer Link-text", "wallstreet"),
        "section" => "copyright_section_one",
        "type" => "checkbox",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[footer_link]", [
        "default" => __('&nbsp;<a href="/contact">Contact</a>&nbsp;|&nbsp;<a href="/impress">Impress</a>&nbsp;|&nbsp;<a href="/privacy">Privacy policy</a>&nbsp;|&nbsp;<a href="/terms">General Terms and Conditions</a>&nbsp;|&nbsp;<a href="/rights">Rights of withdrawal</a>&nbsp;|&nbsp;<a href="/shipping-costs">Shipping costs</a>&nbsp;', "wallstreet"),
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[footer_link]", [
        "label" => __("Footer Link-text", "wallstreet"),
        "section" => "copyright_section_one",
        "type" => "textarea",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[footerbar_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[footerbar_enabled]", [
        "label" => __("Enable Footer Copyright", "wallstreet"),
        "section" => "copyright_section_one",
        "type" => "checkbox",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[footer_copyright]", [
        "default" => __("Copyright @ 2022 - DJS-WallStreet-Pro. Designed by", "wallstreet") . " " . '<a href="https://schuppelius.org" rel="nofollow" target="_blank">' . __("Daniel Joerg Schuppelius", "wallstreet") . "</a>",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[footer_copyright]", [
        "label" => __("Copyright text", "wallstreet"),
        "section" => "copyright_section_one",
        "type" => "textarea",
    ]);
}
add_action("customize_register", "wallstreet_copyright_customizer"); ?>
