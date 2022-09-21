<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_setup_data.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function theme_data_setup() {
    return [
        //Logo and favicon header
        "yearformat" => __("Y", "wallstreet"),
        "monthyearformat" => __("F Y", "wallstreet"),
        "fulldateformat" => __("jS F Y", "wallstreet"),
        "fulldatetimeformat" => __("jS F Y - h:i a", "wallstreet"),
        "technicalfulldatetimeformat" => __("Y-m-d\TH:i:sP", "wallstreet"),
        "upload_image_favicon" => "",
        "stylesheet" => "default.css",
        "google_analytics" => "",
        "webrit_custom_css" => "",
        "link_color" => "#00c2a9",
        "addframe" => false,
        "contextmenu_enabled" => true,
        "addflexelements" => false,
        "page_fader_enabled" => false,
        "fixedheader_enabled" => false,
        "fixedfooter_enabled" => false,
        "bigborder" => false,
        "parallaxheader_enabled" => false,
        "parallaxbackground_enabled" => false,
        "breadcrumbposition" => "0",
        "contentposition" => "0",
        // Relax Speeds
        "data_rellax_speed_social_contact_header" => 0,
        "data_rellax_speed_header" => 0,
        "data_rellax_speed_slider" => 0,
        "data_rellax_speed_breadcrumbs" => 0,
        "data_rellax_speed_banner" => 0,
        //Scroll to top
        "scroll_to_top_enabled" => true,
        //Slide
        "home_slider_enabled" => true,
        "slidertype" => "base",
        "revolutionslidername" => "startslider",
        "animation" => "slide",
        "animationSpeed" => "1500",
        "slide_direction" => "horizontal",
        "slideshowSpeed" => "2500",
        "slideroundcorner" => "100",
        "home_slider_desktop_title_enabled" => true,
        "home_slider_desktop_subtitle_enabled" => true,
        "home_slider_desktop_desc_enabled" => true,
        "home_slider_desktop_button_enabled" => true,

        "home_slider_mobile_title_enabled" => true,
        "home_slider_mobile_subtitle_enabled" => true,
        "home_slider_mobile_desc_enabled" => true,
        "home_slider_mobile_button_enabled" => true,

        // service
        "other_service_section_enabled" => true,
        "service_list" => 3,
        "service_variation" => 1,
        "service_title" => __("Our Services", "wallstreet"),
        "service_description" => __("We offer great services to our clients", "wallstreet"),
        "other_service_title" => __("Other services", "wallstreet"),
        "other_service_description" => __("We offer great services to our clients", "wallstreet"),
        "service_hover_change_effect" => true,
        "service_middle_extrapadding" => false,

        //portfolio
        "view_all_projects_btn_enabled" => true,
        "portfolio_homepage_item_layouts" => "single-items",
        "portfolio_homepage_column_layouts" => 3,
        "portfolio_list" => 4,
        "portfolio_title" => __("Featured portfolio", "wallstreet"),
        "portfolio_description" => __("Most popular of our works.", "wallstreet"),
        "related_portfolio_title" => __("Related projects", "wallstreet"),
        "related_portfolio_description" => __("We offer great services to our clients", "wallstreet"),
        "two_thre_four_col_port_tem_title" => __("Our Portfolio", "wallstreet"),
        "two_thre_four_col_port_tem_desc" => __("Most popular of our works", "wallstreet"),
        "portfolio_numbers_on_templates" => 4,
        "portfolio_numbers_for_templates_category" => 8,
        "portfolio_more_text" => __("View All Projects", "wallstreet"),
        "portfolio_more_link" => "",
        "portfolio_more_link_target" => false,
        "related_portfolio_project_hide_show" => true,

        // Blog
        "view_all_posts_btn_enabled" => true,
        "view_all_posts_text" => __("View All Posts", "wallstreet"),
        "all_posts_link" => "",
        "view_all_link_target" => false,

        //Taxonomy Archive Portfolio
        "taxonomy_portfolio_list" => 2,
        "wallstreet_products_category_slug" => "portfolio-categories",
        "wallstreet_texonomy_title" => __("Featured portfolio", "wallstreet"),
        "wallstreet_texonomy_desc" => __("Most popular of our works.", "wallstreet"),

        //Theme Features
        "theme_feature_enabled" => true,
        "theme_feature_image" => THEME_ASSETS_PATH_URI . "/images/desk-image.png",
        "feature_image_link" => "#",
        "image_link_target" => true,
        "theme_feature_title" => __("Core features of theme", "wallstreet"),
        "theme_first_feature_icon" => "fa-sliders",
        "theme_first_title" => __("Incredibly flexible", "wallstreet"),
        "theme_first_description" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
        "theme_second_feature_icon" => "fa-paper-plane-o",
        "theme_second_title" => __("Incredibly flexible", "wallstreet"),
        "theme_second_description" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
        "theme_third_feature_icon" => "fa-bolt",
        "theme_third_title" => __("Incredibly flexible", "wallstreet"),
        "theme_third_description" => "Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.",
        "theme_feature_background" => THEME_ASSETS_PATH_URI . "/images/tweet-bg.jpg",
        "theme_feature_background_fixed" => false,

        //client
        "client_list" => "",
        "total_client" => "",
        "home_client_title" => __("Our Clients", "wallstreet"),
        "home_client_description" => __("Have a look at our clients we are growing their business and they are going up in the market by beating their competitors.", "wallstreet"),
        "client_pictureheight" => 100,
        "client_padding_tb" => 30,
        "client_padding_lr" => 30,

        //partner
        "partner_list" => "",
        "total_partner" => "",
        "home_partner_title" => __("Our Partners", "wallstreet"),
        "home_partner_description" => __("Take a look at our partners. With their help, we expand your company and leave your competitors behind.", "wallstreet"),
        "partner_pictureheight" => 100,
        "partner_padding_tb" => 30,
        "partner_padding_lr" => 30,

        //Home Team Section
        "team_design_style" => 1,
        "team_design_layout_style" => 4,
        "home_team_title" => __("The Team", "wallstreet"),
        "home_team_description" => __("Meet Our Experts", "wallstreet"),

        //Team Template Section
        "team_template_team_section_show_hide" => true,
        "team_template_feature_section_show_hide" => true,
        "team_template_client_section_show_hide" => true,

        //Testimonial template section
        "testimonial_template_cta_section_show_hide" => true,
        "testimonial_cta_title" => __("Why choose us", "wallstreet"),
        "testimonial_cta_description" => __("We offer great services to our clients", "wallstreet"),
        "testimonial_template_testimonial_section_show_hide" => true,
        "testimonial_template_client_section_show_hide" => true,

        "head_one_team" => __("Meet our", "wallstreet"),
        "head_two_team" => __("Great team", "wallstreet"),
        "related_project_heading" => __("Related projects", "wallstreet"),

        "call_out_area_enabled" => true,
        "call_out_title" => __("Wallstreet is an elegant and modern theme for business websites.", "wallstreet"),
        "call_out_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eros elit, pretium et adipiscing vel, consectetur adipiscing elit.",
        "call_out_button_text" => __("See All Features", "wallstreet"),
        "call_out_button_link" => "#",
        "call_out_button_link_target" => "on",

        // front page
        "front_page_data" => "service,portfolio,team,testimonials,blog,features,client,partner",

        //Slug
        "slider_slug" => "slider",
        "service_slug" => "service",
        "team_slug" => "team",
        "portfolio_slug" => "portfolio",
        "client_slug" => "client",
        "partner_slug" => "partner",
        "testimonial_slug" => "testimonial",

        //Testimonial Settings
        "testimonial_slide_type" => "scroll",
        "testimonial_design_style" => 1,
        "testimonial_scroll_items" => "1",
        "testimonial_timeout_duration" => "2000",
        "testimonial_scroll_duration" => "1500",
        "testimonial_background" => THEME_ASSETS_PATH_URI . "/images/testimonial-bg.jpg",

        //contact page settings
        "contact_header_settings" => "on",
        "contact_google_map_enabled" => "on",
        "contact_google_map_title" => __("Location map", "wallstreet"),
        "contact_google_map_url" => "https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538",

        "contact_header_contact_settings" => "+49-123-456-78-901",
        "contact_header_email_settings" => "info@schuppelius.org",
        "contact_address_settings" => "on",
        "contact_address_icon" => "fa-map-marker",
        "contact_address_title" => __("Address", "wallstreet"),
        "contact_address_designation_one" => "Hoffman Parkway, P.O. Box 353",
        "contact_address_designation_two" => "Mountain View. USA",

        "contact_phone_settings" => "on",
        "contact_phone_icon" => "fa-phone",
        "contact_phone_title" => "Phone",
        "contact_phone_number_one" => "1-800-123-789",
        "contact_phone_number_two" => "1-800-123-789",

        "contact_email_settings" => "on",
        "contact_email_icon" => "fa-inbox",
        "contact_email_title" => "Email",
        "contact_email_number_one" => "info@schuppelius.org",
        "contact_email_number_two" => "schuppelius.org",

        "contact_form_title" => __("Drop us a mail", "wallstreet"),
        "contact_form_description" => __("Feel free to write us a message", "wallstreet"),

        //Header Preset
        "header_presets_stlyle" => 1,
        "enable_search_btn" => true,
        "search_effect_style_setting" => "toogle",

        // Head Titles
        "about_team_section_show_hide" => true,
        "about_callout_section_show_hide" => true,
        "about_team_title" => __("Our great team", "wallstreet"),
        "about_team_description" => __("We offer great services to our clients", "wallstreet"),
        "home_blog_heading" => __("Our latest blog post", "wallstreet"),
        "home_blog_description" => __("We work with new customers and grow their businesses", "wallstreet"),
        "home_blog_counts" => 3,
        "home_blog_design" => 1,

        //Blog Meta
        "blog_template_content_excerpt_get_setting" => "content",
        "blog_template_content_excerpt_length" => 275,
        "blog_template_read_more" => "Read More",
        "home_meta_section_settings" => false,
        "blog_meta_section_settings" => false,
        "page_meta_section_settings" => false,
        "archive_page_meta_section_settings" => false,

        /** Social media links **/
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
        "social_media_vimeo_link" => "",
        "vimeo_link_new_tab" => false,

        // Typography
        "enable_custom_typography" => false,
        "google_font" => "El Messiri",
        "remove_googlefonts" => false,


        // general typography
        "general_typography_fontsize" => "16",
        "general_typography_fontfamily" => "SiteFontRegular",
        "general_typography_fontstyle" => "",

        // menu title
        "menu_title_fontsize" => "16",
        "menu_title_fontfamily" => "SiteFontRegular",
        "menu_title_fontstyle" => "",

        // post title
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

        /** footer customization **/
        "footerbar_enabled" => true,
        "footer_link_enabled" => true,
        "footer_link" => __('&nbsp;<a href="/contact">Contact</a>&nbsp;|&nbsp;<a href="/impress">Impress</a>&nbsp;|&nbsp;<a href="/privacy">Privacy policy</a>&nbsp;|&nbsp;<a href="/terms">General Terms and Conditions</a>&nbsp;|&nbsp;<a href="/rights">Rights of withdrawal</a>&nbsp;|&nbsp;<a href="/shipping-costs">Shipping costs</a>&nbsp;', "wallstreet"),
        "footer_copyright" => __("Copyright @ 2022 - DJS-WallStreet-Pro. Designed by", "wallstreet") . " " . '<a href="https://schuppelius.org" rel="nofollow" target="_blank">' . __("Daniel Joerg Schuppelius", "wallstreet") . "</a>",

        "before_comment" => "<b>" .__("Please Note:", "wallstreet"). "</b>&nbsp;" .__("Your mail address will not be published, but your name will be. First name or a nickname is sufficient. Furthermore, comments on this site are moderated. Please be patient if your comment is not activated immediately.", "wallstreet"),
        "after_comment" => __("If you don't want to express yourself publicly, use the contact form or send me an email. Please don't forget to mention the article you are referring to.", "wallstreet"),

        "cookie_before" => __("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", "wallstreet") . ' <a href="/' . urlencode(strtolower(__("Imprint", "wallstreet"))) . '">' . __("Imprint", "wallstreet") . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(__("Privacy policy", "wallstreet")))) . '">' . __("Privacy policy", "wallstreet") . '</a>. ' . __("Do you have any further questions on this topic? Write me via the", "wallstreet").' <a href="/' . urlencode(strtolower(__("contact", "wallstreet"))) . '">' . __("contact form", "wallstreet") . '</a> ' . __("or by e-mail", "wallstreet") . ' (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
        "cookie_link" => __("Yes, I would like to activate the content on this page...", "wallstreet"),
        "cookie_after" => __("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", "wallstreet"),

    ];
}

function get_current_options() {
    $djs_wallstreet_pro_options = theme_data_setup();
    return wp_parse_args(get_option("wallstreet_pro_options", []), $djs_wallstreet_pro_options);
}
?>
