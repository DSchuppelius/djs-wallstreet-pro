<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-typography.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class plugin_theme_typography_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;

        $this->font_size = [];
        for ($i = 9; $i <= 100; $i++) {
            $this->font_size[$i] = $i;
        }
    
        $this->font_family = [
            "400" => "GoogleFont Regular",
            "300" => "GoogleFont Light",
            "600" => "GoogleFont Bold",
            "700" => "GoogleFont Black",
            "500" => "GoogleFont Medium",
            "200" => "GoogleFont Thin",
        ];
    
        $this->font_style = ["normal" => "Normal", "italic" => "Italic"];
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("wallstreet_typography_setting", [
            "priority" => 930,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Typography settings", "djs-wallstreet-pro"),
        ]);        
    }

    public function customize_register_section($wp_customize) {
        //Local typography section
        $wp_customize->add_section("wallstreet_localfont_section", [
            "title" => esc_html__("Local font", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 0,
            "description" => esc_html__("if typography is disabled", "djs-wallstreet-pro"),
        ]);

        //Enable/Disable typography section
        $wp_customize->add_section("wallstreet_typography_section", [
            "title" => esc_html__("Typhography enable / disable", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 5,
        ]);

        //General typography section
        $wp_customize->add_section("wallstreet_general_typography", [
            "title" => esc_html__("General Paragraph", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 10,
        ]);

        //Menus typography section
        $wp_customize->add_section("wallstreet_menus_typography", [
            "title" => esc_html__("Menus", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 20,
        ]);

        //Post and page title typography section
        $wp_customize->add_section("wallstreet_post_page_title_typography", [
            "title" => esc_html__("Post / Page title", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 30,
        ]);

        if (defined("DJS_POSTTYPE_PLUGIN")) {
            //Service typography section
            $wp_customize->add_section("service_typography", [
                "title" => esc_html__("Service title", "djs-wallstreet-pro"),
                "panel" => "wallstreet_typography_setting",
                "priority" => 40,
            ]);
        
            //Portfolio title typography section
            $wp_customize->add_section("portfolio_typography", [
                "title" => esc_html__("Portfolio title", "djs-wallstreet-pro"),
                "panel" => "wallstreet_typography_setting",
                "priority" => 50,
            ]);
        }

        //Widget heading title typography section
        $wp_customize->add_section("wallstreet_widget_title_typography", [
            "title" => esc_html__("Widget heading title", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 60,
        ]);

        //Call Out Area title typography section
        $wp_customize->add_section("wallstreet_site_intro_typography", [
            "title" => esc_html__("Call-to-Action title", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 70,
        ]);

        //Call Out Area description typography section
        $wp_customize->add_section("wallstreet_callout_desc_typography", [
            "title" => esc_html__("Call-to-Action description", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 80,
        ]);

        //Call Out Area button typography section
        $wp_customize->add_section("wallstreet_callout_button_typography", [
            "title" => esc_html__("Call-to-Action button", "djs-wallstreet-pro"),
            "panel" => "wallstreet_typography_setting",
            "priority" => 90,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        $this->customize_register_normal($wp_customize);

        if (defined("DJS_POSTTYPE_PLUGIN")) {
            $this->customize_register_special($wp_customize);
        }
    }

    private function customize_register_normal($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[local_font_style]", [
            "default" => "roboto",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[local_font_style]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_localfont_section",
            "setting" => $this->theme_options_name . "[local_font_style]",
            "type" => "select",
            "choices" => [
                "anonymous-pro" => "Anonymous Pro",
                "dancing-script" => "Dancing Script",
                "el-messiri" => "El Messiri",
                "montserrat" => "Montserrat",
                "roboto" => "Roboto",
                "rubik" => "Rubik",
                "philosopher" => "Philosopher",
                "sulphurpoint" => "Sulphur Point",
            ],
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[remove_googlefonts]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[remove_googlefonts]", [
            "label" => esc_html__("Remove GoogleFonts (Works only, if custom typography is disabled)", "djs-wallstreet-pro"),
            "section" => "wallstreet_localfont_section",
            "setting" => $this->theme_options_name . "[remove_googlefonts]",
            "type" => "checkbox",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[enable_custom_typography]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[enable_custom_typography]", [
            "label" => esc_html__("Enable custom typography", "djs-wallstreet-pro"),
            "section" => "wallstreet_typography_section",
            "setting" => $this->theme_options_name . "[enable_custom_typography]",
            "type" => "checkbox",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[google_font]", [
            "default" => "El Messiri",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[google_font]", [
            "label" => esc_html__("Name of GoogleFont", "djs-wallstreet-pro"),
            "section" => "wallstreet_typography_section",
            "type" => "text",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[local_font_style]", [
            "default" => "roboto",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[local_font_style]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_localfont_section",
            "setting" => $this->theme_options_name . "[local_font_style]",
            "type" => "select",
            "choices" => [
                "anonymous-pro" => "Anonymous Pro",
                "dancing-script" => "Dancing Script",
                "el-messiri" => "El Messiri",
                "montserrat" => "Montserrat",
                "roboto" => "Roboto",
                "rubik" => "Rubik",
                "philosopher" => "Philosopher",
                "sulphurpoint" => "Sulphur Point",
            ],
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[remove_googlefonts]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[remove_googlefonts]", [
            "label" => esc_html__("Remove GoogleFonts (Works only, if custom typography is disabled)", "djs-wallstreet-pro"),
            "section" => "wallstreet_localfont_section",
            "setting" => $this->theme_options_name . "[remove_googlefonts]",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[general_typography_fontsize]", [
            "default" => 13,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[general_typography_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_general_typography",
            "setting" => $this->theme_options_name . "[general_typography_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[general_typography_fontfamily]", [
            "default" => "Helvetica Neue,Helvetica,Arial,sans-serif",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[general_typography_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_general_typography",
            "setting" => $this->theme_options_name . "[general_typography_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[general_typography_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[general_typography_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_general_typography",
            "setting" => $this->theme_options_name . "[general_typography_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    
        $wp_customize->add_setting($this->theme_options_name . "[menu_title_fontsize]", [
            "default" => 18,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[menu_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_menus_typography",
            "setting" => $this->theme_options_name . "[menu_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[menu_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[menu_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_menus_typography",
            "setting" => $this->theme_options_name . "[menu_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[menu_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[menu_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_menus_typography",
            "setting" => $this->theme_options_name . "[menu_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    
        $wp_customize->add_setting($this->theme_options_name . "[post_title_fontsize]", [
            "default" => 26,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[post_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_post_page_title_typography",
            "setting" => $this->theme_options_name . "[post_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[post_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[post_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_post_page_title_typography",
            "setting" => $this->theme_options_name . "[post_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[post_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[post_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_post_page_title_typography",
            "setting" => $this->theme_options_name . "[post_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    
        $wp_customize->add_setting($this->theme_options_name . "[widget_title_fontsize]", [
            "default" => 24,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[widget_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_widget_title_typography",
            "setting" => $this->theme_options_name . "[widget_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[widget_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[widget_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_widget_title_typography",
            "setting" => $this->theme_options_name . "[widget_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[widget_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[widget_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_widget_title_typography",
            "setting" => $this->theme_options_name . "[widget_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    
        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_title_fontsize]", [
            "default" => 34,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_site_intro_typography",
            "setting" => $this->theme_options_name . "[calloutarea_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_site_intro_typography",
            "setting" => $this->theme_options_name . "[calloutarea_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_site_intro_typography",
            "setting" => $this->theme_options_name . "[calloutarea_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_description_fontsize]", [
            "default" => 15,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_description_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_desc_typography",
            "setting" => $this->theme_options_name . "[calloutarea_description_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_description_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_description_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_desc_typography",
            "setting" => $this->theme_options_name . "[calloutarea_description_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_description_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_description_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_desc_typography",
            "setting" => $this->theme_options_name . "[calloutarea_description_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    
        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_purches_fontsize]", [
            "default" => 16,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_purches_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_button_typography",
            "setting" => $this->theme_options_name . "[calloutarea_purches_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_purches_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_purches_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_button_typography",
            "setting" => $this->theme_options_name . "[calloutarea_purches_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[calloutarea_purches_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[calloutarea_purches_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "wallstreet_callout_button_typography",
            "setting" => $this->theme_options_name . "[calloutarea_purches_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);
    }

    private function customize_register_special($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[service_title_fontsize]", [
            "default" => 26,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[service_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "service_typography",
            "setting" => $this->theme_options_name . "[service_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[service_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[service_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "service_typography",
            "setting" => $this->theme_options_name . "[service_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[service_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[service_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "service_typography",
            "setting" => $this->theme_options_name . "[service_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[portfolio_title_fontsize]", [
            "default" => 20,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[portfolio_title_fontsize]", [
            "label" => esc_html__("Font size", "djs-wallstreet-pro"),
            "section" => "portfolio_typography",
            "setting" => $this->theme_options_name . "[portfolio_title_fontsize]",
            "type" => "select",
            "choices" => $this->font_size,
            "description" => esc_html__("Pixels", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[portfolio_title_fontfamily]", [
            "default" => "SiteFontRegular",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[portfolio_title_fontfamily]", [
            "label" => esc_html__("Font family", "djs-wallstreet-pro"),
            "section" => "portfolio_typography",
            "setting" => $this->theme_options_name . "[portfolio_title_fontfamily]",
            "type" => "select",
            "choices" => $this->font_family,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[portfolio_title_fontstyle]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[portfolio_title_fontstyle]", [
            "label" => esc_html__("Font style", "djs-wallstreet-pro"),
            "section" => "portfolio_typography",
            "setting" => $this->theme_options_name . "[portfolio_title_fontstyle]",
            "type" => "select",
            "choices" => $this->font_style,
        ]);    
    }
}

global $customizer_typography;

if(!isset($customizer_typography)) {
    $customizer_typography = new plugin_theme_typography_customizer();
    $customizer_typography->register();
} ?>
