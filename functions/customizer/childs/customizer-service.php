<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_service_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        //Service section panel
        $wp_customize->add_panel("service_options", [
            "priority" => 600,
            "capability" => "edit_theme_options",
            "title" => __("Service settings", "wallstreet"),
        ]);	
	}

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("service_section_head", [
            "title" => __("Service heading", "wallstreet"),
            "panel" => "service_options",
            "priority" => 50,
        ]);

        //Other service section
        $wp_customize->add_section("other_service_section", [
            "title" => __("Other services section", "wallstreet"),
            "panel" => "service_options",
            "priority" => 50,
        ]);

        //Service callout
        $wp_customize->add_section("service_callout_settings", [
            "title" => __("Service Call-to-Action settings", "wallstreet"),
            "description" => "",
            "panel" => "service_options",
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        //Number of services
        $wp_customize->add_setting($this->theme_options_name . "[service_list]", [
            "default" => 3,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[service_list]", [
            "type" => "select",
            "label" => __("Number of services on service section", "wallstreet"),
            "section" => "service_section_head",
            "priority" => 50,
            "choices" => [
                3 => 3,
                6 => 6,
                9 => 9,
                12 => 12,
                15 => 15,
                18 => 18,
                21 => 21,
                24 => 24,
            ],
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[service_variation]", [
            "default" => 1,
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[service_variation]", [
            "type" => "select",
            "label" => __("Select Service Style", "wallstreet"),
            "section" => "service_section_head",
            "priority" => 50,
            "choices" => [
                1 => __("Style 1", "wallstreet"),
                2 => __("Style 2", "wallstreet"),
                3 => __("Style 3", "wallstreet"),
                4 => __("Style 4", "wallstreet"),
                5 => __("Style 5", "wallstreet"),
                6 => __("Style 6", "wallstreet"),
            ],
        ]);
    
        //Service title
        $wp_customize->add_setting($this->theme_options_name . "[service_title]", [
            "default" => __("Our Services", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[service_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "service_section_head",
            "type" => "text",
            "priority" => 100,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[service_description]", [
            "default" => __("We offer great services to our clients", "wallstreet"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[service_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "service_section_head",
            "type" => "text",
            "sanitize_callback" => "sanitize_text_field",
            "priority" => 200,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[service_middle_extrapadding]", [
            "default" => false,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[service_middle_extrapadding]", [
            "label" => __("Give middle element more size", "wallstreet"),
            "description" => __("This setting will work with only service design 1", "wallstreet"),
            "section" => "service_section_head",
            "type" => "checkbox",
            "sanitize_callback" => "sanitize_text_field",
            "priority" => 200,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[service_hover_change_effect]", [
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[service_hover_change_effect]", [
            "label" => __("Enable service animation effect", "wallstreet"),
            "description" => __("This setting will work with only service design 1 and service design 6", "wallstreet"),
            "section" => "service_section_head",
            "type" => "checkbox",
            "sanitize_callback" => "sanitize_text_field",
            "priority" => 200,
        ]);
    
        $wp_customize->add_setting("service", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control(
            new WP_Service_Customize_Control($wp_customize, "service", [
                "section" => "service_section_head",
                "priority" => 300,
            ])
        );
    
        //Enable . disbaled other services
        $wp_customize->add_setting($this->theme_options_name . "[other_service_section_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[other_service_section_enabled]", [
            "label" => __("Enable other services section in service template", "wallstreet"),
            "section" => "other_service_section",
            "type" => "checkbox",
            "priority" => 50,
        ]);
    
        //Sarvice title
        $wp_customize->add_setting($this->theme_options_name . "[other_service_title]", [
            "default" => __("Other services", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[other_service_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "other_service_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
        //other service description
        //Service title
        $wp_customize->add_setting($this->theme_options_name . "[other_service_description]", [
            "default" => __("We offer great services to our clients", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[other_service_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "other_service_section",
            "type" => "text",
            "priority" => 100,
        ]);
    
    
        $wp_customize->add_setting("other_service", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control(
            new WP_Service_Customize_Control($wp_customize, "other_service", [
                "section" => "other_service_section",
                "priority" => 300,
            ])
        );
    
        //Enable and disabled service callout Section
        $wp_customize->add_setting($this->theme_options_name . "[call_out_area_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_area_enabled]", [
            "label" => __("Enable Callout area section", "wallstreet"),
            "section" => "service_callout_settings",
            "type" => "checkbox",
        ]);
    
        // add section to manage callout
        $wp_customize->add_setting($this->theme_options_name . "[call_out_title]", [
            "default" => __("Wallstreet is an elegant and modern theme for business websites.", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_title]", [
            "label" => __("Title", "wallstreet"),
            "section" => "service_callout_settings",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[call_out_text]", [
            "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eros elit, pretium et adipiscing vel, consectetur adipiscing elit.",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_text]", [
            "label" => __("Description", "wallstreet"),
            "section" => "service_callout_settings",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[call_out_button_text]", [
            "default" => __("Purchase Now", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_button_text]", [
            "label" => __("Button Text", "wallstreet"),
            "section" => "service_callout_settings",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[call_out_button_link]", [
            "default" => "#",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_button_link]", [
            "label" => __("Button Link", "wallstreet"),
            "section" => "service_callout_settings",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[call_out_button_link_target]", [
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "default" => true,
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[call_out_button_link_target]", [
            "type" => "checkbox",
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "service_callout_settings",
        ]);
	}
}

global $customizer_service;

if(!isset($customizer_service)) {
    $customizer_service = new theme_service_customizer();
    $customizer_service->register();
} ?>
