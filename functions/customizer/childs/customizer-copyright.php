<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-copyright.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class theme_copyright_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("wallstreet_copyright_setting", [
            "priority" => 900,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Copyright and cookie settings", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("copyright_section_one", [
            "title" => esc_html__("Footer copyright settings", "djs-wallstreet-pro"),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);

        $wp_customize->add_section("cookie_section_one", [
            "title" => esc_html__("Cookie settings", "djs-wallstreet-pro"),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);

    }

    //HACK Theme Check - required to add theme in WordPress theme library (found no sanitizer)
    private function hack_4_theme_check__footer_link(){
        return sanitize_link_field(esc_html__('&nbsp;<a href="/contact">Contact</a>&nbsp;|&nbsp;<a href="/impress">Impress</a>&nbsp;|&nbsp;<a href="/privacy">Privacy policy</a>&nbsp;|&nbsp;<a href="/terms">General Terms and Conditions</a>&nbsp;|&nbsp;<a href="/rights">Rights of withdrawal</a>&nbsp;|&nbsp;<a href="/shipping-costs">Shipping costs</a>&nbsp;', "djs-wallstreet-pro"));
    }

    public function customize_register_settings_and_controls($wp_customize) {
        $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

        $wp_customize->add_setting($this->theme_options_name . "[footer_link_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_link_enabled]", [
            "label" => esc_html__("Enable Footer Link-text", "djs-wallstreet-pro"),
            "section" => "copyright_section_one",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[footer_link]", [
            "default" => $this->hack_4_theme_check__footer_link(),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_link]", [
            "label" => esc_html__("Footer Link-text", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Enable Footer Copyright", "djs-wallstreet-pro"),
            "section" => "copyright_section_one",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[footer_copyright]", [
            "default" => esc_html__("Copyright @ 2022 - DJS-WallStreet-Pro. Designed by", "djs-wallstreet-pro") . " " . '<a href="https://schuppelius.org" rel="nofollow" target="_blank">' . esc_html__("Daniel Joerg Schuppelius", "djs-wallstreet-pro") . "</a>",
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[footer_copyright]", [
            "label" => esc_html__("Copyright text", "djs-wallstreet-pro"),
            "section" => "copyright_section_one",
            "type" => "textarea",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[cookie_before]", [
            "default" => esc_html__("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", "djs-wallstreet-pro") . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", "djs-wallstreet-pro"))) . '">' . esc_html__("Imprint", "djs-wallstreet-pro") . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", "djs-wallstreet-pro")))) . '">' . esc_html__("Privacy policy", "djs-wallstreet-pro") . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", "djs-wallstreet-pro").' <a href="/' . urlencode(strtolower(esc_html__("contact", "djs-wallstreet-pro"))) . '">' . esc_html__("contact form", "djs-wallstreet-pro") . '</a> ' . esc_html__("or by e-mail", "djs-wallstreet-pro") . ' (<a href="mailto:' . $current_setup->get("contact_email_number_one") . '" >' . $current_setup->get("contact_email_number_one") . "</a>)",
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_before]", [
            "label" => esc_html__("Cookietext before button", "djs-wallstreet-pro"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_link]", [
            "default" => esc_html__("Yes, I would like to activate the content on this page...", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_link]", [
            "label" => esc_html__("Buttontext", "djs-wallstreet-pro"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_after]", [
            "default" => esc_html__("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_after]", [
            "label" => esc_html__("Cookietext after button", "djs-wallstreet-pro"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[script_before]", [
            "default" => esc_html__("This site uses third-party program code that may allow conclusions to be drawn about your user behavior. Some of these program codes are loaded from external servers. We use this code to determine what content is of interest to you or to make the behavior and appearance of this website more pleasant for you. Would you like to support us and unlock these external scripts and styles? You can find more information about the use of data on these websites on the following pages:", "djs-wallstreet-pro") . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", "djs-wallstreet-pro"))) . '">' . esc_html__("Imprint", "djs-wallstreet-pro") . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", "djs-wallstreet-pro")))) . '">' . esc_html__("Privacy policy", "djs-wallstreet-pro") . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", "djs-wallstreet-pro").' <a href="/' . urlencode(strtolower(esc_html__("contact", "djs-wallstreet-pro"))) . '">' . esc_html__("contact form", "djs-wallstreet-pro") . '</a> ' . esc_html__("or by e-mail", "djs-wallstreet-pro") . ' (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_before]", [
            "label" => esc_html__("Load scripts question", "djs-wallstreet-pro"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[script_link]", [
            "default" => esc_html__("Yes, I would like to activate the external scripts on this page...", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_link]", [
            "label" => esc_html__("Load external Skripts", "djs-wallstreet-pro"),
            "section" => "cookie_section_one",
            "type" => "textarea",
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[noscript_link]", [
            "default" => esc_html__("No, I do not like to activate the external scripts on this page...", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[noscript_link]", [
            "label" => esc_html__("No external Skripts", "djs-wallstreet-pro"),
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
