<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_setup_data.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

require_once THEME_FUNCTIONS_PATH . "/theme/djs_setup.php";

class DJS_Wallstreet_Pro_Theme_Setup extends DJS_Setup {
    // @return plugin|null
    public static function instance() {
        // Store the instance locally to avoid private static replication
        static $instance = null;

        // Only run these methods if they haven't been ran previously
        if (null === $instance) {
            $instance = new DJS_Wallstreet_Pro_Theme_Setup();
            $instance->load_current_setup();
        }

        // Always return the instance
        return $instance;
    }

    protected function get_initial_setup() {
        return [
            "border_base" => 20,
            "border_bigbase" => 40,
            "border_smallbase" => 10,
            "border_verysmallbase" => 5,
            "input_base" => 0.25,

            // Logo and favicon header
            "yearformat" => esc_html__("Y", "djs-wallstreet-pro"),
            "monthyearformat" => esc_html__("F Y", "djs-wallstreet-pro"),
            "fulldateformat" => esc_html__("jS F Y", "djs-wallstreet-pro"),
            "fulldatetimeformat" => esc_html__("jS F Y - h:i a", "djs-wallstreet-pro"),
            "technicalfulldatetimeformat" => esc_html__("Y-m-d\TH:i:sP", "djs-wallstreet-pro"),
            "upload_image_favicon" => "",
            "stylesheet" => "default.css",
            "google_analytics" => "",
            "webrit_custom_css" => "",
            "link_color" => "#00c2a9",
            "addframe" => false,
            "contextmenu_enabled" => true,
            "addflexelements" => false,
            "flexelements" => false,
            "page_fader_enabled" => false,
            "fixedheader_enabled" => false,
            "fixedfooter_enabled" => false,
            "bigborder" => false,
            "parallaxheader_enabled" => false,
            "parallaxbackground_enabled" => false,
            "breadcrumbposition" => 0,
            "contentposition" => 0,

            // Relax Speeds
            "data_rellax_speed_social_contact_header" => 0,
            "data_rellax_speed_header" => 0,
            "data_rellax_speed_slider" => 0,
            "data_rellax_speed_breadcrumbs" => 0,
            "data_rellax_speed_banner" => 0,

            "slideroundcorner" => "100",

            // Scroll to top
            "scroll_to_top_enabled" => true,
    
            "a_mark_targets" => false,
            "a_underlined" => true,
    
            "max_archive_year" => 5,
            "max_archive_month" => 12,
            "max_archive_day" => 7,
    
            "max_page_buttons" => 11,
            // Blog
            "view_all_posts_btn_enabled" => true,
            "view_all_posts_text" => esc_html__("View All Posts", "djs-wallstreet-pro"),
            "all_posts_link" => "#",
            "view_all_link_target" => false,
    
            "call_out_area_enabled" => true,
            "call_out_title" => esc_html__("Wallstreet is an elegant and modern theme for business websites.", "djs-wallstreet-pro"),
            "call_out_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eros elit, pretium et adipiscing vel, consectetur adipiscing elit.",
            "call_out_button_text" => esc_html__("See All Features", "djs-wallstreet-pro"),
            "call_out_button_link" => "#",
            "call_out_button_link_target" => "on",

            "home_blog_same_height" => false,
    
            // Contact page settings
            "contact_header_settings" => "on",
            "contact_google_map_enabled" => "on",
            "contact_google_map_title" => esc_html__("Location map", "djs-wallstreet-pro"),
            "contact_google_map_url" => "https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538",
    
            "contact_header_contact_settings" => "+49-123-456-78-901",
            "contact_header_email_settings" => "info@schuppelius.org",
            "contact_address_settings" => "on",
            "contact_address_icon" => "fa-map-marker",
            "contact_address_title" => esc_html__("Address", "djs-wallstreet-pro"),
            "contact_address_designation_one" => "Hoffman Parkway, P.O. Box 353",
            "contact_address_designation_two" => "Mountain View. USA",
    
            "contact_phone_settings" => "on",
            "contact_phone_icon" => "fa-phone",
            "contact_phone_title" => esc_html__("Phone", "djs-wallstreet-pro"),
            "contact_phone_number_one" => "1-800-123-789",
            "contact_phone_number_two" => "1-800-123-789",
    
            "contact_email_settings" => "on",
            "contact_email_icon" => "fa-inbox",
            "contact_email_title" => esc_html__("Email", "djs-wallstreet-pro"),
            "contact_email_number_one" => "info@schuppelius.org",
            "contact_email_number_two" => "schuppelius.org",
    
            "contact_form_title" => esc_html__("Drop us a mail", "djs-wallstreet-pro"),
            "contact_form_description" => esc_html__("Feel free to write us a message", "djs-wallstreet-pro"),
    
            // Header Preset
            "header_presets_stlyle" => 1,
            "enable_search_btn" => true,
            "search_effect_style_setting" => "toogle",
    
            // Head Titles
            "home_blog_heading" => esc_html__("Our latest blog post", "djs-wallstreet-pro"),
            "home_blog_description" => esc_html__("We work with new customers and grow their businesses", "djs-wallstreet-pro"),
            "home_blog_counts" => 3,
            "home_blog_design" => 1,
    
            // Blog Meta
            "blog_template_content_excerpt_get_setting" => "excerpt",
            "blog_template_content_excerpt_length" => 275,
            "blog_template_read_more" => esc_html__("Read More", "djs-wallstreet-pro"),
            "home_meta_section_settings" => false,
            "blog_meta_section_settings" => false,
            "page_meta_section_settings" => false,
            "archive_page_meta_section_settings" => false,
    
            // Social media links
            "about_social_media_enabled" => true,
            "header_social_media_enabled" => true,
            "footer_social_media_enabled" => true,
            "social_media_twitter_link" => "#",
            "twitter_link_new_tab" => false,
            "social_media_facebook_link" => "#",
            "facebook_link_new_tab" => false,
            "social_media_linkedin_link" => "#",
            "linkedin_link_new_tab" => false,
            "social_media_github_link" => "#",
            "github_link_new_tab" => false,
            "social_media_pinterest_link" => "#",
            "pintrest_link_new_tab" => false,
            "social_media_youtube_link" => "#",
            "youtube_link_new_tab" => false,
            "social_media_skype_link" => "#",
            "skype_link_new_tab" => false,
            "social_media_rssfeed_link" => "#",
            "rss_link_new_tab" => false,
            "social_media_wordpress_link" => "#",
            "wp_link_new_tab" => false,
            "social_media_dropbox_link" => "#",
            "db_link_new_tab" => false,
            "social_media_instagram_link" => "#",
            "insta_link_new_tab" => false,
            "social_media_vimeo_link" => "#",
            "vimeo_link_new_tab" => false,
    
            // Typography
            "local_font_style" => "roboto",
    
            "enable_custom_typography" => false,
            "google_font" => "El Messiri",
            "remove_googlefonts" => false,
    
            // General typography
            "general_typography_fontsize" => "16",
            "general_typography_fontfamily" => "SiteFontRegular",
            "general_typography_fontstyle" => "",
    
            // Menu title
            "menu_title_fontsize" => "16",
            "menu_title_fontfamily" => "SiteFontRegular",
            "menu_title_fontstyle" => "",
    
            // Post title
            "post_title_fontsize" => "40",
            "post_title_fontfamily" => "SiteFontLight",
            "post_title_fontstyle" => "",
    
            // Service  title
            "service_title_fontsize" => "24",
            "service_title_fontfamily" => "SiteFontRegular",
            "service_title_fontstyle" => "",
    
            // Potfolio  title Widget Heading Title
            "portfolio_title_fontsize" => "18",
            "portfolio_title_fontfamily" => "SiteFontMedium",
            "portfolio_title_fontstyle" => "",
    
            // Widget Heading Title
            "widget_title_fontsize" => "24",
            "widget_title_fontfamily" => "SiteFontRegular",
            "widget_title_fontstyle" => "",
    
            // Call out area Title
            "calloutarea_title_fontsize" => "24",
            "calloutarea_title_fontfamily" => "SiteFontLight",
            "calloutarea_title_fontstyle" => "",
    
            // Call out area descritpion
            "calloutarea_description_fontsize" => "15",
            "calloutarea_description_fontfamily" => "SiteFontRegular",
            "calloutarea_description_fontstyle" => "",
    
            // Call out area purches button
            "calloutarea_purches_fontsize" => "18",
            "calloutarea_purches_fontfamily" => "SiteFontRegular",
            "calloutarea_purches_fontstyle" => "",

            // Front page
            "front_page_data" => "blog",
    
            // Footer customization
            "footerbar_enabled" => true,
            "footer_link_enabled" => true,
            "footer_link" => __('&nbsp;<a href="/contact">Contact</a>&nbsp;|&nbsp;<a href="/impress">Impress</a>&nbsp;|&nbsp;<a href="/privacy">Privacy policy</a>&nbsp;|&nbsp;<a href="/terms">General Terms and Conditions</a>&nbsp;|&nbsp;<a href="/rights">Rights of withdrawal</a>&nbsp;|&nbsp;<a href="/shipping-costs">Shipping costs</a>&nbsp;', "djs-wallstreet-pro"),
            "footer_copyright" => esc_html__("Copyright @ 2022 - DJS-WallStreet-Pro. Designed by", "djs-wallstreet-pro") . " " . '<a href="https://schuppelius.org" rel="nofollow" target="_blank">' . esc_html__("Daniel Joerg Schuppelius", "djs-wallstreet-pro") . "</a>",
    
            "before_comment" => esc_html__("Your mail address will not be published, but your name will be. First name or a nickname is sufficient. Furthermore, comments on this site are moderated. Please be patient if your comment is not activated immediately.", "djs-wallstreet-pro"),
            "after_comment" => esc_html__("If you don't want to express yourself publicly, use the contact form or send me an email. Please don't forget to mention the article you are referring to.", "djs-wallstreet-pro"),
    
        ];
    }
}
?>
