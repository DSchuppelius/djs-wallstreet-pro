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

        //twitter link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_twitter_link]", [
            "default" => "#",
            "type" => "theme_mod",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_twitter_link]", [
            "label" => esc_html__("Twitter URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //twitter link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[twitter_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[twitter_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        // Facebook link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_facebook_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_facebook_link]", [
            "label" => esc_html__("Facebook URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //facebook link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[facebook_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[facebook_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Linkedin link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_linkedin_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_linkedin_link]", [
            "label" => esc_html__("LinkedIn URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //Linkedin link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[linkedin_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[linkedin_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Github link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_github_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_github_link]", [
            "label" => esc_html__("GitHub URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //Github link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[github_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[github_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Pinterest Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_pinterest_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_pinterest_link]", [
            "label" => esc_html__("Pinterest URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //Pinterest link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[pintrest_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[pintrest_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Youtube Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_youtube_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_youtube_link]", [
            "label" => esc_html__("Youtube URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //youtube link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[youtube_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[youtube_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Skype Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_skype_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_skype_link]", [
            "label" => esc_html__("Skype URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //skype link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[skype_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[skype_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Rss Feed Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_rssfeed_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_rssfeed_link]", [
            "label" => esc_html__("RSS URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //skype link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[rss_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[rss_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //WordPress Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_wordpress_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_wordpress_link]", [
            "label" => esc_html__("WordPress URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //wordpress link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[wp_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[wp_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Dropbox Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_dropbox_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_dropbox_link]", [
            "label" => esc_html__("Dropbox URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //WordPress link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[db_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[db_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Instagram Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_instagram_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_instagram_link]", [
            "label" => esc_html__("Instagram URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //Instagram link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[insta_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[insta_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

        //Vimeo Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_vimeo_link]", [
            "default" => "",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[social_media_vimeo_link]", [
            "label" => esc_html__("Vimeo URL", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "text",
        ]);

        //Vimeo link new tab/window
        $wp_customize->add_setting($this->theme_options_name . "[vimeo_link_new_tab]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[vimeo_link_new_tab]", [
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);

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

if(!isset($customizer_social)) {
    $customizer_social = new theme_social_customizer();
    $customizer_social->register();
} ?>