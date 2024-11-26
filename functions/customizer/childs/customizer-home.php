<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-home.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_home_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        /* Header Section */
        $wp_customize->add_panel("header_options", [
            "priority" => 450,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Header settings", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        /* favicon option */
        $wp_customize->add_section("wallstreet_favicon", [
            "title" => esc_html__("Site Favicon", "djs-wallstreet-pro"),
            "priority" => 300,
            "description" => esc_html__("Upload a Favicon", "djs-wallstreet-pro"),
            "panel" => "header_options",
        ]);

        //Header social Icon
        $wp_customize->add_section("header_social_icon", [
            "title" => esc_html__("Social Links", "djs-wallstreet-pro"),
            "priority" => 400,
            "panel" => "header_options",
        ]);

        //Custom css
        $wp_customize->add_section("custom_css", [
            "title" => esc_html__("Custom CSS", "djs-wallstreet-pro"),
            "panel" => "header_options",
            "priority" => 100,
        ]);

        //Custom css
        $wp_customize->add_section("header_contact", [
            "title" => esc_html__("Header contact settings", "djs-wallstreet-pro"),
            "panel" => "header_options",
            "priority" => 500,
        ]);

        //Header Preset
        $wp_customize->add_section("header_presets", [
            "title" => esc_html__("Header Preset settings", "djs-wallstreet-pro"),
            "panel" => "header_options",
            "priority" => 600,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[upload_image_favicon]", [
            "sanitize_callback" => "esc_url_raw",
            "capability" => "edit_theme_options",
            "type" => "option",
        ]);

        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, $this->theme_options_name . "[upload_image_favicon]", [
                "label" => esc_html__("Upload a Favicon (ideal width and height is 16x16 or 32x32)", "djs-wallstreet-pro"),
                "section" => "wallstreet_favicon",
            ])
        );

        $wp_customize->add_setting($this->theme_options_name . "[webrit_custom_css]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
        $wp_customize->add_control($this->theme_options_name . "[webrit_custom_css]", [
            "label" => esc_html__("Custom CSS", "djs-wallstreet-pro"),
            "section" => "custom_css",
            "type" => "textarea",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[home_blog_same_height]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
        $wp_customize->add_control($this->theme_options_name . "[home_blog_same_height]", [
            "label" => esc_html__("Same height for home blogview", "djs-wallstreet-pro"),
            "section" => "custom_css",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        //Text logo
        $wp_customize->add_setting($this->theme_options_name . "[contact_header_settings]", [
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[contact_header_settings]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable/Disable contact header", "djs-wallstreet-pro"),
            "section" => "header_contact",
            "priority" => 500,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[contact_header_contact_settings]", [
            "default" => "+49-123-456-78-901",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[contact_header_contact_settings]", [
            "type" => "text",
            "label" => esc_html__("Header contact info", "djs-wallstreet-pro"),
            "section" => "header_contact",
            "priority" => 500,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[contact_header_email_settings]", [
            "default" => "info@schuppelius.org",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[contact_header_email_settings]", [
            "type" => "text",
            "label" => esc_html__("Header email info", "djs-wallstreet-pro"),
            "section" => "header_contact",
            "priority" => 500,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[header_presets_stlyle]", [
            "default" => 1,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[header_presets_stlyle]", [
            "type" => "select",
            "label" => esc_html__("Select header preset style", "djs-wallstreet-pro"),
            "section" => "header_presets",
            "choices" => [
                1 => esc_html__("Style 1", "djs-wallstreet-pro"),
                2 => esc_html__("Style 2", "djs-wallstreet-pro"),
                3 => esc_html__("Style 3", "djs-wallstreet-pro"),
                4 => esc_html__("Style 4", "djs-wallstreet-pro"),
                5 => esc_html__("Style 5", "djs-wallstreet-pro"),
                6 => esc_html__("Style 6", "djs-wallstreet-pro"),
            ],
        ]);

        //Search Enable Search button
        $wp_customize->add_setting($this->theme_options_name . "[enable_search_btn]", [
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[enable_search_btn]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable/Disable Search Icon", "djs-wallstreet-pro"),
            "section" => "header_presets",
            "priority" => 500,
        ]);

        //SEARCH EFFECT OR STYLES
        $wp_customize->add_setting($this->theme_options_name . "[search_effect_style_setting]", [
            "default" => "toogle",
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[search_effect_style_setting]", [
            "label" => esc_html__("Choose Position", "djs-wallstreet-pro"),
            "section" => "header_presets",
            "type" => "select",
            "choices" => [
                "toogle" => esc_html__("Toogle", "djs-wallstreet-pro"),
                "popup_light" => esc_html__("Pop up light", "djs-wallstreet-pro"),
                "popup_dark" => esc_html__("Pop up dark", "djs-wallstreet-pro"),
            ],
        ]);
    }
}

global $customizer_home;

if(!isset($customizer_home)) {
    $customizer_home = new theme_home_customizer();
    $customizer_home->register();
} ?>