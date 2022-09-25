<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-home.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_home_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }
    
    public function customize_register_panel($wp_customize) {
	    /* Header Section */
        $wp_customize->add_panel("header_options", [
            "priority" => 450,
            "capability" => "edit_theme_options",
            "title" => __("Header settings", "wallstreet"),
        ]);
	}

    public function customize_register_section($wp_customize) {
	    /* favicon option */
        $wp_customize->add_section("wallstreet_favicon", [
            "title" => __("Site Favicon", "wallstreet"),
            "priority" => 300,
            "description" => __("Upload a Favicon", "wallstreet"),
            "panel" => "header_options",
        ]);

        //Header social Icon
        $wp_customize->add_section("header_social_icon", [
            "title" => __("Social Links", "wallstreet"),
            "priority" => 400,
            "panel" => "header_options",
        ]);

        //Custom css
        $wp_customize->add_section("custom_css", [
            "title" => __("Custom CSS", "wallstreet"),
            "panel" => "header_options",
            "priority" => 100,
        ]);

        //Custom css
        $wp_customize->add_section("header_contact", [
            "title" => __("Header contact settings", "wallstreet"),
            "panel" => "header_options",
            "priority" => 500,
        ]);

        //Header Preset
        $wp_customize->add_section("header_presets", [
            "title" => __("Header Preset settings", "wallstreet"),
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
                "label" => __("Upload a Favicon (ideal width and height is 16x16 or 32x32)", "wallstreet"),
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
            "label" => __("Custom CSS", "wallstreet"),
            "section" => "custom_css",
            "type" => "textarea",
            "priority" => 100,
        ]);
    
        //Text logo
        $wp_customize->add_setting($this->theme_options_name . "[contact_header_settings]", [
            "default" => true,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_header_settings]", [
            "type" => "checkbox",
            "label" => __("Enable/Disable contact header", "wallstreet"),
            "section" => "header_contact",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[contact_header_contact_settings]", [
            "default" => "+49-123-456-78-901",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_header_contact_settings]", [
            "type" => "text",
            "label" => __("Header contact info", "wallstreet"),
            "section" => "header_contact",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[contact_header_email_settings]", [
            "default" => "info@schuppelius.org",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_header_email_settings]", [
            "type" => "text",
            "label" => __("Header email info", "wallstreet"),
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
            "label" => __("Select header preset style", "wallstreet"),
            "section" => "header_presets",
            "choices" => [
                1 => __("Style 1", "wallstreet"),
                2 => __("Style 2", "wallstreet"),
                3 => __("Style 3", "wallstreet"),
                4 => __("Style 4", "wallstreet"),
                5 => __("Style 5", "wallstreet"),
                6 => __("Style 6", "wallstreet"),
            ],
        ]);
    
        //Search Enable Search button
        $wp_customize->add_setting($this->theme_options_name . "[enable_search_btn]", [
            "default" => true,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[enable_search_btn]", [
            "type" => "checkbox",
            "label" => __("Enable/Disable Search Icon", "wallstreet"),
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
            "label" => esc_html__("Choose Position", "wallstreet"),
            "section" => "header_presets",
            "type" => "select",
            "choices" => [
                "toogle" => esc_html__("Toogle", "wallstreet"),
                "popup_light" => esc_html__("Pop up light", "wallstreet"),
                "popup_dark" => esc_html__("Pop up dark", "wallstreet"),
            ],
        ]);
	}
}

global $customizer_home;

if(!isset($customizer_home)) {
    $customizer_home = new theme_home_customizer();
    $customizer_home->register();
} ?>
