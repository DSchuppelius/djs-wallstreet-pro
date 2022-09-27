<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-post-type-slugs.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_post_type_slugs_customizer extends theme_customizer {
    
    public function customize_register_panel($wp_customize) {}

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("slugs_section", [
            "priority" => 950,
            "capability" => "edit_theme_options",
            "title" => __("SEO Friendly URL", "wallstreet"),
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {    
        // Slider Slug
        $wp_customize->add_setting($this->theme_options_name . "[slider_slug]", [
            "default" => "slider",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[slider_slug]", [
            "label" => __("Slider slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        // services_slug
        $wp_customize->add_setting($this->theme_options_name . "[service_slug]", [
            "default" => "service",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
        $wp_customize->add_control($this->theme_options_name . "[service_slug]", [
            "label" => __("Service slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        // team_slug
        $wp_customize->add_setting($this->theme_options_name . "[team_slug]", [
            "default" => "team",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[team_slug]", [
            "label" => __("Team slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        //products_slug
        $wp_customize->add_setting($this->theme_options_name . "[portfolio_slug]", [
            "default" => "portfolio",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[portfolio_slug]", [
            "label" => __("Portfolio slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        //Portfolio category Slug
        $wp_customize->add_setting($this->theme_options_name . "[wallstreet_products_category_slug]", [
            "default" => "portfolio-categories",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[wallstreet_products_category_slug]", [
            "label" => __("Portfolio category slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        // Testimonial Slug
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_slug]", [
            "default" => "testimonial",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_slug]", [
            "label" => __("Testimonial slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        // Client Slug
        $wp_customize->add_setting($this->theme_options_name . "[client_slug]", [
            "default" => "client",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[client_slug]", [
            "label" => __("Client slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        // Client Slug
        $wp_customize->add_setting($this->theme_options_name . "[partner_slug]", [
            "default" => "partner",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[partner_slug]", [
            "label" => __("Partner slug", "wallstreet"),
            "section" => "slugs_section",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[wallstreet_slug_setting]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "wp_filter_nohtml_kses",
        ]);
    
        $wp_customize->add_control(
            new Wallstreet_Customize_Slug($wp_customize, $this->theme_options_name . "[wallstreet_slug_setting]", [
                "label" => __("Wallstreet slug", "wallstreet"),
                "section" => "slugs_section",
                "settings" => $this->theme_options_name . "[wallstreet_slug_setting]",
            ])
        );
    
        $wp_customize->add_setting("slug", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
        ]);
    
        $wp_customize->add_control(
            new WP_Slug_Customize_Control($wp_customize, "slug", [
                "section" => "slugs_section",
            ])
        );

    }
}

global $customizer_post_type_slugs;

if(!isset($customizer_post_type_slugs)) {
    $customizer_post_type_slugs = new theme_post_type_slugs_customizer();
    $customizer_post_type_slugs->register();
} ?>
