<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_global_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("global_theme_settings", [
            "priority" => 0,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Global options", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("themeoptions_section_settings", [
            "title" => esc_html__("Global theme options", "djs-wallstreet-pro"),
            "panel" => "global_theme_settings",
            "description" => "",
        ]);

        $wp_customize->add_section("themecorner_section_settings", [
            "title" => esc_html__("Corner options", "djs-wallstreet-pro"),
            "panel" => "global_theme_settings",
            "description" => "",
        ]);

        $wp_customize->add_section("wallstreet_datetime_section", [
            "title" => esc_html__("Datetime section", "djs-wallstreet-pro"),
            "panel" => "global_theme_settings",
            "description" => esc_html__('For more information, visit <a href="https://www.php.net/manual/en/datetime.format.php">php.net (datetime.format)</a>', "djs-wallstreet-pro"),
        ]);
    }


    public function customize_register_settings_and_controls($wp_customize) {    
        $wp_customize->add_setting($this->theme_options_name . "[yearformat]", [
            "default" => esc_html__("Y", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[yearformat]", [
            "label" => esc_html__("Year dateformat", "djs-wallstreet-pro"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[monthyearformat]", [
            "default" => esc_html__("F Y", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[monthyearformat]", [
            "label" => esc_html__("Month/Year dateformat", "djs-wallstreet-pro"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fulldateformat]", [
            "default" => esc_html__("jS F Y", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[fulldateformat]", [
            "label" => esc_html__("Full dateformat", "djs-wallstreet-pro"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[fulldatetimeformat]", [
            "default" => esc_html__("jS F Y - h:i a", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[fulldatetimeformat]", [
            "label" => esc_html__("Full datetimeformat", "djs-wallstreet-pro"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[technicalfulldatetimeformat]", [
            "default" => esc_html__("Y-m-d\TH:i:sP", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[technicalfulldatetimeformat]", [
            "label" => esc_html__("Technical full datetimeformat", "djs-wallstreet-pro"),
            "section" => "wallstreet_datetime_section",
            "type" => "text",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[a_underlined]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[a_underlined]", [
            "label" => esc_html__("Enable underline in links", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[a_mark_targets]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[a_mark_targets]", [
            "label" => esc_html__("Mark blank targets in links", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[scroll_to_top_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[scroll_to_top_enabled]", [
            "label" => esc_html__("Enable Scroll To Top Setting", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Enable Contextmenu", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Fixed header", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Fixed footer", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Enable Parallax Background", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Enable Parallax Header", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "type" => "checkbox",
            "priority" => 220,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[bigborder]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[bigborder]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable Big Border", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "priority" => 300,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[page_fader_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[page_fader_enabled]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable Fader on Pageload", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "priority" => 400,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[addframe]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[addframe]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable frame on pages", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[addflexelements]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[addflexelements]", [
            "type" => "checkbox",
            "label" => esc_html__("Add filling elements to pages", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "priority" => 500,
        ]);
            
        $wp_customize->add_setting($this->theme_options_name . "[flexelements]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[flexelements]", [
            "type" => "checkbox",
            "label" => esc_html__("fill existing elements on pages", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "priority" => 500,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[breadcrumbposition]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[breadcrumbposition]", [
            "label" => esc_html__("Custom breadcrumb position", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Custom content position", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Rellax Speed (Social Contact Header)", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Rellax Speed (Header)", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Rellax Speed (Homepage Slider)", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Rellax Speed (Breadcrumbs)", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "-5",
                "step" => "1",
                "max" => "20",
            ],
            "priority" => 650,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[data_rellax_speed_banner]", [
            "default" => 0,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[data_rellax_speed_banner]", [
            "label" => esc_html__("Rellax Speed (Site Banner)", "djs-wallstreet-pro"),
            "section" => "themeoptions_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "10",
            ],
            "priority" => 650,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[border_base]", [
            "default" => 20,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[border_base]", [
            "label" => esc_html__("Base border-radius", "djs-wallstreet-pro"),
            "section" => "themecorner_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "100",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[border_bigbase]", [
            "default" => 40,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[border_bigbase]", [
            "label" => esc_html__("Big border-radius", "djs-wallstreet-pro"),
            "section" => "themecorner_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "100",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[border_smallbase]", [
            "default" => 10,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[border_smallbase]", [
            "label" => esc_html__("Small border-radius", "djs-wallstreet-pro"),
            "section" => "themecorner_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "100",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[border_verysmallbase]", [
            "default" => 5,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[border_verysmallbase]", [
            "label" => esc_html__("Very small border-radius", "djs-wallstreet-pro"),
            "section" => "themecorner_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "100",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[input_base]", [
            "default" => 0.25,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[input_base]", [
            "label" => esc_html__("Button border-radius", "djs-wallstreet-pro"),
            "section" => "themecorner_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "0.01",
                "max" => "10",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);
    }
}

global $customizer_global;

if(!isset($customizer_global)) {
    $customizer_global = new theme_global_customizer();
    $customizer_global->register();
} ?>
