<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-social.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
define("FACEBOOK_URL", "https://facebook.com");
define("TWITTER_URL", "https://twitter.com");
define("LINKEDIN_URL", "https://linkedin.com");
define("BEHANCE_URL", "https://behance.com");

class theme_social_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        /* Header Section */
        $wp_customize->add_panel("social_link_options", [
            "priority" => 450,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Social-Media settings", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        //Header social Icon
        $wp_customize->add_section("social_icon", [
            "title" => esc_html__("Social-Media links", "djs-wallstreet-pro"),
            "priority" => 400,
            "panel" => "social_link_options",
        ]);

        $wp_customize->add_section("comment_icon", [
            "title" => esc_html__("Comment Options", "djs-wallstreet-pro"),
            "priority" => 400,
            "panel" => "social_link_options",
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        //Show and hide Header Social Icons
        $wp_customize->add_setting($this->theme_options_name . "[header_social_media_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[header_social_media_enabled]", [
            "label" => esc_html__("Enable social media links on header section", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //About enable/disable social icon
        $wp_customize->add_setting($this->theme_options_name . "[about_social_media_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[about_social_media_enabled]", [
            "label" => esc_html__("Enable social media links on about us section", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Footer enable/disable social icon
        $wp_customize->add_setting($this->theme_options_name . "[footer_social_media_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_social_media_enabled]", [
            "label" => esc_html__("Enable social media links on footer section", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Ein Feld-Paar (URL + "in neuem Tab oeffnen") je Netzwerk aus der zentralen Registry
        foreach (djs_wallstreet_social_networks() as $network) {
            $wp_customize->add_setting($this->theme_options_name . "[" . $network["link"] . "]", [
                "default" => isset($network["default"]) ? $network["default"] : "",
                "sanitize_callback" => "sanitize_url",
                "type" => "option",
            ]);

            $wp_customize->add_control($this->theme_options_name . "[" . $network["link"] . "]", [
                /* translators: %s: name of the social network, e.g. Mastodon */
                "label" => sprintf(esc_html__("%s URL", "djs-wallstreet-pro"), $network["label"]),
                "section" => "social_icon",
                "type" => "text",
            ]);

            $wp_customize->add_setting($this->theme_options_name . "[" . $network["tab"] . "]", [
                "default" => false,
                "capability" => "edit_theme_options",
                "sanitize_callback" => "sanitize_text_field",
                "type" => "option",
            ]);

            $wp_customize->add_control($this->theme_options_name . "[" . $network["tab"] . "]", [
                "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
                "section" => "social_icon",
                "type" => "checkbox",
            ]);
        }

        //Prev Comment
        $wp_customize->add_setting($this->theme_options_name . "[before_comment]", [
            "default" => esc_html__("Your mail address will not be published, but your name will be. First name or a nickname is sufficient. Furthermore, comments on this site are moderated. Please be patient if your comment is not activated immediately.", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[before_comment]", [
            "label" => esc_html__("First Text in Comment-Section", "djs-wallstreet-pro"),
            "section" => "comment_icon",
            "type" => "textarea",
        ]);

        //After Comment
        $wp_customize->add_setting($this->theme_options_name . "[after_comment]", [
            "default" => esc_html__("If you don't want to express yourself publicly, use the contact form or send me an email. Please don't forget to mention the article you are referring to.", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[after_comment]", [
            "label" => esc_html__("Next Text in Comment-Section", "djs-wallstreet-pro"),
            "section" => "comment_icon",
            "type" => "textarea",
        ]);
    }
}

global $customizer_social;

if (!isset($customizer_social)) {
    $customizer_social = new theme_social_customizer();
    $customizer_social->register();
}
