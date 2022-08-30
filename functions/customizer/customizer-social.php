<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-social.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_social_customizer($wp_customize) {
    /* Header Section */
    $wp_customize->add_panel("social_link_options", [
        "priority" => 450,
        "capability" => "edit_theme_options",
        "title" => __("Social link settings", "wallstreet"),
    ]);

    //Header social Icon
    $wp_customize->add_section("social_icon", [
        "title" => __("Social Links", "wallstreet"),
        "priority" => 400,
        "panel" => "social_link_options",
    ]);

    //Show and hide Header Social Icons
    $wp_customize->add_setting("wallstreet_pro_options[header_social_media_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[header_social_media_enabled]", [
        "label" => __("Enable social media links on header section", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //About enable/disable social icon
    $wp_customize->add_setting("wallstreet_pro_options[about_social_media_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[about_social_media_enabled]", [
        "label" => __("Enable social media links on about us section", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Footer enable/disable social icon
    $wp_customize->add_setting("wallstreet_pro_options[footer_social_media_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[footer_social_media_enabled]", [
        "label" => __("Enable social media links on footer section", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //twitter link
    $wp_customize->add_setting("wallstreet_pro_options[social_media_twitter_link]", [
        "default" => "#",
        "type" => "theme_mod",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_twitter_link]", [
        "label" => __("Twitter URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //twitter link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[twitter_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[twitter_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    // Facebook link
    $wp_customize->add_setting("wallstreet_pro_options[social_media_facebook_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_facebook_link]", [
        "label" => __("Facebook URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //facebook link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[facebook_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[facebook_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Linkdin link
    $wp_customize->add_setting("wallstreet_pro_options[social_media_linkedin_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_linkedin_link]", [
        "label" => __("LinkedIn URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //linkdin link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[linkdin_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[linkdin_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Pinterest Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_pinterest_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_pinterest_link]", [
        "label" => __("Pinterest URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //linkdin link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[pintrest_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[pintrest_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Youtube Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_youtube_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_youtube_link]", [
        "label" => __("Youtube URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //youtube link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[youtube_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[youtube_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Skype Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_skype_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_skype_link]", [
        "label" => __("Skype URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //skype link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[skype_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[skype_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Rss Feed Link:

    $wp_customize->add_setting("wallstreet_pro_options[social_media_rssfeed_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_rssfeed_link]", [
        "label" => __("RSS URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //skype link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[rss_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[rss_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //WordPress Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_wordpress_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_wordpress_link]", [
        "label" => __("WordPress URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //wordpress link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[wp_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[wp_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Dropbox Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_dropbox_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_dropbox_link]", [
        "label" => __("Dropbox URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //wordpress link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[db_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[db_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Instagram Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_instagram_link]", [
        "default" => "#",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_instagram_link]", [
        "label" => __("Instagram URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //Instagram link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[insta_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[insta_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);

    //Vimeo Profile Link:
    $wp_customize->add_setting("wallstreet_pro_options[social_media_vimeo_link]", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[social_media_vimeo_link]", [
        "label" => __("Vimeo URL", "wallstreet"),
        "section" => "social_icon",
        "type" => "text",
    ]);

    //Vimeo link new tab/window
    $wp_customize->add_setting("wallstreet_pro_options[vimeo_link_new_tab]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[vimeo_link_new_tab]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "social_icon",
        "type" => "checkbox",
    ]);


    $wp_customize->add_section("comment_icon", [
        "title" => __("Comment Options", "wallstreet"),
        "priority" => 400,
        "panel" => "social_link_options",
    ]);

    //Prev Comment
    $wp_customize->add_setting("wallstreet_pro_options[before_comment]", [
        "default" => "<b>" .__("Please Note:", "wallstreet"). "</b>&nbsp;" .__("Your mail address will not be published, but your name will be. First name or a nickname is sufficient. Furthermore, comments on this site are moderated. Please be patient if your comment is not activated immediately.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[before_comment]", [
        "label" => __("First Text in Comment-Section", "wallstreet"),
        "section" => "comment_icon",
        "type" => "textarea",
    ]);

    //After Comment
    $wp_customize->add_setting("wallstreet_pro_options[after_comment]", [
        "default" => __("If you don't want to express yourself publicly, use the contact form or send me an email. Please don't forget to mention the article you are referring to.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[after_comment]", [
        "label" => __("Next Text in Comment-Section", "wallstreet"),
        "section" => "comment_icon",
        "type" => "textarea",
    ]);
}
add_action("customize_register", "wallstreet_social_customizer"); ?>
