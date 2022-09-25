<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-feature.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_feature_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
	    //Service section panel
        $wp_customize->add_panel("wallstreet_features_options", [
            "priority" => 700,
            "capability" => "edit_theme_options",
            "title" => __("Theme feature settings", "wallstreet"),
        ]);
	}

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("features_section", [
            "title" => __("Theme feature settings", "wallstreet"),
            "panel" => "wallstreet_features_options",
            "priority" => 1,
        ]);
        
        $wp_customize->add_section("features_section_back", [
            "title" => __("Background Image", "wallstreet"),
            "panel" => "wallstreet_features_options",
            "priority" => 2,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {    
        // Enable/disable Feature Section
        $wp_customize->add_setting($this->theme_options_name . "[theme_feature_enabled]", [
            "default" => true,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_feature_enabled]", [
            "type" => "checkbox",
            "label" => __("Check to enable theme featured section on homepage", "wallstreet"),
            "section" => "features_section",
        ]);
    
        //Feature image
        $wp_customize->add_setting($this->theme_options_name . "[theme_feature_image]", [
            "sanitize_callback" => "esc_url_raw",
            "type" => "option",
            "default" => THEME_ASSETS_PATH_URI . "/images/desk-image.png",
        ]);

        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, $this->theme_options_name . "[theme_feature_image]", [
                "label" => __("Image", "wallstreet"),
                "section" => "features_section",
                "settings" => $this->theme_options_name . "[theme_feature_image]",
            ])
        );
    
        //feature section image link
        $wp_customize->add_setting($this->theme_options_name . "[feature_image_link]", [
            "default" => "#",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[feature_image_link]", [
            "label" => __("Image Link", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
        ]);
    
        //View all portfolio Button Link
        $wp_customize->add_setting($this->theme_options_name . "[image_link_target]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "description" => __("Open link in new tab", "wallstreet"),
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[image_link_target]", [
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "features_section",
            "type" => "checkbox",
        ]);
    
        //Feature title
        $wp_customize->add_setting($this->theme_options_name . "[theme_feature_title]", [
            "default" => __("Core features of theme", "wallstreet"),
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[theme_feature_title]", [
            "type" => "text",
            "label" => __("Title", "wallstreet"),
            "section" => "features_section",
        ]);
    
        //Theme first icon
        $wp_customize->add_setting($this->theme_options_name . "[theme_first_feature_icon]", [
            "default" => "fa-sliders",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_first_feature_icon]", [
            "label" => __("Icon", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
        ]);
    
        //First Feature Title:
        $wp_customize->add_setting($this->theme_options_name . "[theme_first_title]", [
            "default" => __("Incredibly flexible", "wallstreet"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_first_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        //First Feature Description:
        $wp_customize->add_setting($this->theme_options_name . "[theme_first_description]", [
            "default" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_first_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        //Second feature section
        //Theme second icon
        $wp_customize->add_setting($this->theme_options_name . "[theme_second_feature_icon]", [
            "default" => "fa-paper-plane",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_second_feature_icon]", [
            "label" => __("Icon", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
        ]);
    
        //second Feature Title:
        $wp_customize->add_setting($this->theme_options_name . "[theme_second_title]", [
            "default" => __("Incredibly flexible", "wallstreet"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_second_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        //second Feature Description:
        $wp_customize->add_setting($this->theme_options_name . "[theme_second_description]", [
            "default" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_second_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        //Third feature section
        //Theme Third icon
        $wp_customize->add_setting($this->theme_options_name . "[theme_third_feature_icon]", [
            "default" => "fa-bolt",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_third_feature_icon]", [
            "label" => __("Icon", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
        ]);
    
        //third Feature Title:
        $wp_customize->add_setting($this->theme_options_name . "[theme_third_title]", [
            "default" => __("Incredibly flexible", "wallstreet"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_third_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        //third Feature Description:
        $wp_customize->add_setting($this->theme_options_name . "[theme_third_description]", [
            "default" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[theme_third_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "features_section",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        // section background image
        $wp_customize->add_setting($this->theme_options_name . "[theme_feature_background]", [
            "sanitize_callback" => "esc_url_raw",
            "type" => "option",
            "default" => THEME_ASSETS_PATH_URI . "/images/tweet-bg.jpg",
        ]);
    
        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, $this->theme_options_name . "[theme_feature_background]", [
                "label" => __("Image", "wallstreet"),
                "section" => "features_section_back",
                "settings" => $this->theme_options_name . "[theme_feature_background]",
            ])
        );
    
        $wp_customize->add_setting($this->theme_options_name . "[theme_feature_background_fixed]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "description" => __("Open link in new tab", "wallstreet"),
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[theme_feature_background_fixed]", [
            "label" => __("Background Image Fixed", "wallstreet"),
            "section" => "features_section",
            "type" => "checkbox",
        ]);
    }
}

global $customizer_feature;

if(!isset($customizer_feature)) {
    $customizer_feature = new theme_feature_customizer();
    $customizer_feature->register();
} ?>
