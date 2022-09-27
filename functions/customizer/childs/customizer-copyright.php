<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-copyright.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class theme_copyright_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("wallstreet_copyright_setting", [
            "priority" => 900,
            "capability" => "edit_theme_options",
            "title" => __("Copyright and cookie settings", "wallstreet"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("copyright_section_one", [
            "title" => __("Footer copyright settings", "wallstreet"),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);

        $wp_customize->add_section("cookie_section_one", [
            "title" => __("Cookie settings", "wallstreet"),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);

    }

    public function customize_register_settings_and_controls($wp_customize) {
        $current_options = get_current_options();

        $wp_customize->add_setting($this->theme_options_name . "[footer_link_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_link_enabled]", [
            "label" => __("Enable Footer Link-text", "wallstreet"),
            "section" => "copyright_section_one",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[footer_link]", [
            "default" => __('&nbsp;<a href="/contact">Contact</a>&nbsp;|&nbsp;<a href="/impress">Impress</a>&nbsp;|&nbsp;<a href="/privacy">Privacy policy</a>&nbsp;|&nbsp;<a href="/terms">General Terms and Conditions</a>&nbsp;|&nbsp;<a href="/rights">Rights of withdrawal</a>&nbsp;|&nbsp;<a href="/shipping-costs">Shipping costs</a>&nbsp;', "wallstreet"),
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_link]", [
            "label" => __("Footer Link-text", "wallstreet"),
            "section" => "copyright_section_one",
            "type" => "textarea",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[footerbar_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[footerbar_enabled]", [
            "label" => __("Enable Footer Copyright", "wallstreet"),
            "section" => "copyright_section_one",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[footer_copyright]", [
            "default" => __("Copyright @ 2022 - DJS-WallStreet-Pro. Designed by", "wallstreet") . " " . '<a href="https://schuppelius.org" rel="nofollow" target="_blank">' . __("Daniel Joerg Schuppelius", "wallstreet") . "</a>",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_copyright]", [
            "label" => __("Copyright text", "wallstreet"),
            "section" => "copyright_section_one",
            "type" => "textarea",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[cookie_before]", [
            "default" => __("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", "wallstreet") . ' <a href="/' . urlencode(strtolower(__("Imprint", "wallstreet"))) . '">' . __("Imprint", "wallstreet") . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(__("Privacy policy", "wallstreet")))) . '">' . __("Privacy policy", "wallstreet") . '</a>. ' . __("Do you have any further questions on this topic? Write me via the", "wallstreet").' <a href="/' . urlencode(strtolower(__("contact", "wallstreet"))) . '">' . __("contact form", "wallstreet") . '</a> ' . __("or by e-mail", "wallstreet") . ' (<a href="mailto:' . $current_options["contact_email_number_one"] . '" >' . $current_options["contact_email_number_one"] . "</a>)",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_before]", [
            "label" => __("Cookietext before button", "wallstreet"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_link]", [
            "default" => __("Yes, I would like to activate the content on this page...", "wallstreet"),
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_link]", [
            "label" => __("Buttontext", "wallstreet"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_after]", [
            "default" => __("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", "wallstreet"),
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_after]", [
            "label" => __("Cookietext after button", "wallstreet"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);
    }
}

global $customizer_copyright;

if(!isset($customizer_copyright)) {
    $customizer_copyright = new theme_copyright_customizer();
    $customizer_copyright->register();
} ?>
