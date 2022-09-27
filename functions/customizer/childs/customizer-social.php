<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-social.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_social_customizer extends theme_customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        /* Header Section */
        $wp_customize->add_panel("social_link_options", [
            "priority" => 450,
            "capability" => "edit_theme_options",
            "title" => __("Social-Media settings", "wallstreet"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        //Header social Icon
        $wp_customize->add_section("social_icon", [
            "title" => __("Social-Media links", "wallstreet"),
            "priority" => 400,
            "panel" => "social_link_options",
        ]);
    
        $wp_customize->add_section("comment_icon", [
            "title" => __("Comment Options", "wallstreet"),
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
            "label" => __("Enable social media links on header section", "wallstreet"),
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
            "label" => __("Enable social media links on about us section", "wallstreet"),
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
            "label" => __("Enable social media links on footer section", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //twitter link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_twitter_link]", [
            "default" => "#",
            "type" => "theme_mod",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_twitter_link]", [
            "label" => __("Twitter URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        // Facebook link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_facebook_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_facebook_link]", [
            "label" => __("Facebook URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Linkedin link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_linkedin_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_linkedin_link]", [
            "label" => __("LinkedIn URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Github link
        $wp_customize->add_setting($this->theme_options_name . "[social_media_github_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_github_link]", [
            "label" => __("GitHub URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Pinterest Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_pinterest_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_pinterest_link]", [
            "label" => __("Pinterest URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Youtube Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_youtube_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_youtube_link]", [
            "label" => __("Youtube URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Skype Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_skype_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_skype_link]", [
            "label" => __("Skype URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Rss Feed Link:    
        $wp_customize->add_setting($this->theme_options_name . "[social_media_rssfeed_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_rssfeed_link]", [
            "label" => __("RSS URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //WordPress Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_wordpress_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_wordpress_link]", [
            "label" => __("WordPress URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Dropbox Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_dropbox_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_dropbox_link]", [
            "label" => __("Dropbox URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Instagram Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_instagram_link]", [
            "default" => "#",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_instagram_link]", [
            "label" => __("Instagram URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Vimeo Profile Link:
        $wp_customize->add_setting($this->theme_options_name . "[social_media_vimeo_link]", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[social_media_vimeo_link]", [
            "label" => __("Vimeo URL", "wallstreet"),
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
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "social_icon",
            "type" => "checkbox",
        ]);
    
        //Prev Comment
        $wp_customize->add_setting($this->theme_options_name . "[before_comment]", [
            "default" => "<b>" .__("Please Note:", "wallstreet"). "</b>&nbsp;" .__("Your mail address will not be published, but your name will be. First name or a nickname is sufficient. Furthermore, comments on this site are moderated. Please be patient if your comment is not activated immediately.", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[before_comment]", [
            "label" => __("First Text in Comment-Section", "wallstreet"),
            "section" => "comment_icon",
            "type" => "textarea",
        ]);
    
        //After Comment
        $wp_customize->add_setting($this->theme_options_name . "[after_comment]", [
            "default" => __("If you don't want to express yourself publicly, use the contact form or send me an email. Please don't forget to mention the article you are referring to.", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[after_comment]", [
            "label" => __("Next Text in Comment-Section", "wallstreet"),
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
