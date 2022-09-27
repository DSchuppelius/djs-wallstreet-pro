<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_global_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("global_theme_settings", [
            "priority" => 0,
            "capability" => "edit_theme_options",
            "title" => __("Global options", "wallstreet"),
        ]);
    }

    public function customize_register_section($wp_customize) {
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
    }


    public function customize_register_settings_and_controls($wp_customize) {    
        $wp_customize->add_setting($this->theme_options_name . "[yearformat]", [
            "default" => __("Y", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[yearformat]", [
            "label" => __("Year dateformat", "wallstreet"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[monthyearformat]", [
            "default" => __("F Y", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[monthyearformat]", [
            "label" => __("Month/Year dateformat", "wallstreet"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fulldateformat]", [
            "default" => __("jS F Y", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[fulldateformat]", [
            "label" => __("Full dateformat", "wallstreet"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fulldatetimeformat]", [
            "default" => __("jS F Y - h:i a", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[fulldatetimeformat]", [
            "label" => __("Full datetimeformat", "wallstreet"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[technicalfulldatetimeformat]", [
            "default" => __("Y-m-d\TH:i:sP", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[technicalfulldatetimeformat]", [
            "label" => __("Technical full datetimeformat", "wallstreet"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[scroll_to_top_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[scroll_to_top_enabled]", [
            "label" => __("Enable Scroll To Top Setting", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[contextmenu_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contextmenu_enabled]", [
            "label" => __("Enable Contextmenu", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 10,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fixedheader_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[fixedheader_enabled]", [
            "label" => __("Fixed header", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 10,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fixedfooter_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[fixedfooter_enabled]", [
            "label" => __("Fixed footer", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 200,
        ]);
    
        //Parallax Background
        $wp_customize->add_setting($this->theme_options_name . "[parallaxbackground_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
        $wp_customize->add_control($this->theme_options_name . "[parallaxbackground_enabled]", [
            "label" => __("Enable Parallax Background", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 210,
        ]);
    
        //Parallax Header
        $wp_customize->add_setting($this->theme_options_name . "[parallaxheader_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
        $wp_customize->add_control($this->theme_options_name . "[parallaxheader_enabled]", [
            "label" => __("Enable Parallax Header", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 220,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[bigborder]", [
            "default" => false,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[bigborder]", [
            "type" => "checkbox",
            "label" => __("Enable Big Border", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "priority" => 300,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[page_fader_enabled]", [
            "default" => false,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[page_fader_enabled]", [
            "type" => "checkbox",
            "label" => __("Enable Fader on Pageload", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "priority" => 400,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[addframe]", [
            "default" => false,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[addframe]", [
            "type" => "checkbox",
            "label" => __("Enable frame on pages", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[addflexelements]", [
            "default" => false,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[addflexelements]", [
            "type" => "checkbox",
            "label" => __("Add filling elements to pages", "wallstreet"),
            "section" => "themeoptions_section_settings",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[breadcrumbposition]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[breadcrumbposition]", [
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
    
        $wp_customize->add_setting($this->theme_options_name . "[contentposition]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[contentposition]", [
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
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_social_contact_header]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_social_contact_header]", [
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
    
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_header]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_header]", [
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
    
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_slider]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_slider]", [
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
    
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_breadcrumbs]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_breadcrumbs]", [
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
    
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_banner]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_banner]", [
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
}

global $customizer_global;

if(!isset($customizer_global)) {
    $customizer_global = new theme_global_customizer();
    $customizer_global->register();
} ?>
