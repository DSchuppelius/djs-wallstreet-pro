<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-testimonial.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_testimonial_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        //Home project Section
        $wp_customize->add_panel("wallstreet_test_setting", [
            "priority" => 750,
            "capability" => "edit_theme_options",
            "title" => __("Testimonial settings", "wallstreet"),
        ]);	
	}

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("test_section_settings", [
            "title" => __("Home testimonial settings", "wallstreet"),
            "description" => "",
            "panel" => "wallstreet_test_setting",
        ]);	
    }

    public function customize_register_settings_and_controls($wp_customize) {        
        //Testimonial animation
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_slide_type]", [
            "default" => "scroll",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_slide_type]", [
            "type" => "select",
            "label" => __("Slide type variations", "wallstreet"),
            "section" => "test_section_settings",
            "choices" => [
                "scroll" => __("scroll", "wallstreet"),
                "fade" => __("fade", "wallstreet"),
                "crossfade" => __("crossfade", "wallstreet"),
                "cover-fade" => __("cover-fade", "wallstreet"),
            ],
        ]);
    
        // Testimonial Design layout
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_design_style]", [
            "default" => 1,
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_design_style]", [
            "type" => "select",
            "label" => __("Testimonial design style", "wallstreet"),
            "section" => "test_section_settings",
            "choices" => [
                1 => __("Style 1", "wallstreet"),
                2 => __("Style 2", "wallstreet"),
                3 => __("Style 3", "wallstreet"),
                4 => __("Style 4", "wallstreet"),
            ],
        ]);
    
        //Testimonial Scroll Items    
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_scroll_items]", [
            "default" => "1",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_scroll_items]", [
            "type" => "select",
            "label" => __("Scroll items", "wallstreet"),
            "section" => "test_section_settings",
            "choices" => [1 => 1, 2 => 2, 3 => 3],
        ]);
    
        //Testimonial Animation speed
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_scroll_duration]", [
            "default" => 1500,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_scroll_duration]", [
            "type" => "select",
            "label" => __("Scroll duration", "wallstreet"),
            "section" => "test_section_settings",
            "priority" => 300,
            "choices" => [
                "500" => "0.5",
                "1000" => "1.0",
                "1500" => "1.5",
                "2000" => "2.0",
                "2500" => "2.5",
                "3000" => "3.0",
                "3500" => "3.5",
                "4000" => "4.0",
                "4500" => "4.5",
                "5000" => "5.0",
                "5500" => "5.5",
            ],
        ]);
    
        //Testimonail Time out Duration
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_timeout_duration]", [
            "default" => 2000,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_timeout_duration]", [
            "type" => "select",
            "label" => __("Time out duration", "wallstreet"),
            "section" => "test_section_settings",
            "priority" => 300,
            "choices" => [
                "500" => "0.5",
                "1000" => "1.0",
                "1500" => "1.5",
                "2000" => "2.0",
                "2500" => "2.5",
                "3000" => "3.0",
                "3500" => "3.5",
                "4000" => "4.0",
                "4500" => "4.5",
                "5000" => "5.0",
                "5500" => "5.5",
            ],
        ]);
    
        $wp_customize->add_setting("testimonial", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
        ]);
        $wp_customize->add_control(
            new WP_Testmonial_Customize_Control($wp_customize, "testimonial", [
                "section" => "test_section_settings",
                "priority" => 500,
            ])
        );
    
        $wp_customize->add_section("test_section_back", [
            "title" => __("Background Image", "wallstreet"),
            "description" => "",
            "panel" => "wallstreet_test_setting",
        ]);
    
        // section background image
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_background]", [
            "sanitize_callback" => "esc_url_raw",
            "type" => "option",
            "default" => THEME_ASSETS_PATH_URI . "/images/testimonial-bg.jpg",
        ]);
    
        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, $this->theme_options_name . "[testimonial_background]", [
                "label" => __("Image", "wallstreet"),
                "section" => "test_section_back",
                "settings" => $this->theme_options_name . "[testimonial_background]",
            ])
        );
	}
}

global $customizer_testimonial;

if(!isset($customizer_testimonial)) {
    $customizer_testimonial = new theme_testimonial_customizer();
    $customizer_testimonial->register();
} ?>
