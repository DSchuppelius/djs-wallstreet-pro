<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-template.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_template_customizer($wp_customize) {
    //template panel
    $wp_customize->add_panel("wallstreet_template", [
        "priority" => 920,
        "capability" => "edit_theme_options",
        "title" => __("Template settings", "wallstreet"),
    ]);

    // add section to manage Section heading
    $wp_customize->add_section("section_heading", [
        "title" => __("About page setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 100,
    ]);

    // About us page Heading
    $wp_customize->add_setting("wallstreet_pro_options[about_team_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[about_team_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable team section", "wallstreet"),
        "section" => "section_heading",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[about_team_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Our great team", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[about_team_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "section_heading",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[about_team_description]", [
        "capability" => "edit_theme_options",
        "default" => __("We offer great services to our clients", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[about_team_description]", [
        "type" => "textarea",
        "label" => __("Description", "wallstreet"),
        "section" => "section_heading",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[about_callout_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[about_callout_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable Callout section", "wallstreet"),
        "section" => "section_heading",
    ]);

    //Team Pgae template setting
    $wp_customize->add_section("team_page_template", [
        "title" => __("Team page setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 100,
    ]);

    // Enable Team section
    $wp_customize->add_setting("wallstreet_pro_options[team_template_team_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[team_template_team_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable team section", "wallstreet"),
        "section" => "team_page_template",
    ]);
    //Enable Feature section
    $wp_customize->add_setting("wallstreet_pro_options[team_template_feature_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[team_template_feature_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable feature section", "wallstreet"),
        "section" => "team_page_template",
    ]);
    //Enable Client Section
    $wp_customize->add_setting("wallstreet_pro_options[team_template_client_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[team_template_client_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable client section", "wallstreet"),
        "section" => "team_page_template",
    ]);

    //Testimonial Pgae template setting
    $wp_customize->add_section("testi_page_template", [
        "title" => __("Testimonial page setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 100,
    ]);

    // Enable cta section
    $wp_customize->add_setting("wallstreet_pro_options[testimonial_template_cta_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[testimonial_template_cta_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable cta section", "wallstreet"),
        "section" => "testi_page_template",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[testimonial_cta_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Why choose us", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[testimonial_cta_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "testi_page_template",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[testimonial_cta_description]", [
        "capability" => "edit_theme_options",
        "default" => __("We offer great services to our clients", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[testimonial_cta_description]", [
        "type" => "textarea",
        "label" => __("Description", "wallstreet"),
        "section" => "testi_page_template",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[testimonial_template_testimonial_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[testimonial_template_testimonial_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable testimonial section", "wallstreet"),
        "section" => "testi_page_template",
    ]);
    //Enable Client Section
    $wp_customize->add_setting("wallstreet_pro_options[testimonial_template_client_section_show_hide]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[testimonial_template_client_section_show_hide]", [
        "type" => "checkbox",
        "label" => __("Enable client section", "wallstreet"),
        "section" => "testi_page_template",
    ]);
    //Blog template setting
    $wp_customize->add_section("blog_template_content_excerpt_seting", [
        "title" => __("Blog template data setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 149,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[blog_template_content_excerpt_get_seting]", [
        "default" => "content",
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[blog_template_content_excerpt_get_seting]", [
        "label" => __("From which format do you want to display data", "wallstreet"),
        "section" => "blog_template_content_excerpt_seting",
        "type" => "radio",
        "choices" => [
            "excert" => "Excerpt Data",
            "content" => "Content Data",
        ],
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[blog_template_content_excerpt_length]", [
        "default" => 275,
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[blog_template_content_excerpt_length]", [
        "label" => __("Excerpt length only for excerpt option", "wallstreet"),
        "section" => "blog_template_content_excerpt_seting",
        "type" => "number",
        "input_attrs" => [
            "min" => "1",
            "step" => "1",
            "max" => "1000",
        ],
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[blog_template_read_more]", [
        "default" => "Read More",
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[blog_template_read_more]", [
        "label" => __("Read more button text", "wallstreet"),
        "section" => "blog_template_content_excerpt_seting",
        "type" => "text",
    ]);
    //enable/disable blog post meta content
    $wp_customize->add_section("blog_template", [
        "title" => __("Blog meta settings", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 150,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[blog_meta_section_settings]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[blog_meta_section_settings]", [
        "label" => __("Hide post meta i.e. author name, date of submission, category, tags from posts page", "wallstreet"),
        "section" => "blog_template",
        "type" => "checkbox",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[page_meta_section_settings]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[page_meta_section_settings]", [
        "label" => __("Hide post meta i.e. author name, date of submission, category, tags from page", "wallstreet"),
        "section" => "blog_template",
        "type" => "checkbox",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[archive_page_meta_section_settings]", [
        "default" => 0,
        "capability" => "edit_theme_options",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[archive_page_meta_section_settings]", [
        "label" => __("Hide post meta i.e. author name, date of submission, category, tags from archive page", "wallstreet"),
        "section" => "blog_template",
        "type" => "checkbox",
    ]);

    //Portfolio Texonomy Setting

    $wp_customize->add_section("portfolio_texonomy", [
        "title" => __("Portfolio category page setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[taxonomy_portfolio_list]", [
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "default" => 2,
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[taxonomy_portfolio_list]", [
        "type" => "select",
        "label" => __("Select column layout", "wallstreet"),
        "section" => "portfolio_texonomy",
        "choices" => [2 => 2, 3 => 3, 4 => 4],
    ]);
    // Number of Portfolio Template
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_numbers_for_templates_category]", [
        "default" => 8,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_numbers_for_templates_category]", [
        "type" => "number",
        "label" => __("Numbers of portfolio in portfolio category page", "wallstreet"),
        "section" => "portfolio_texonomy",
        "input_attrs" => [
            "min" => "1",
            "step" => "1",
            "max" => "10",
        ],
    ]);
    //texonomy Title
    $wp_customize->add_setting("wallstreet_pro_options[wallstreet_texonomy_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Featured portfolio", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[wallstreet_texonomy_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "portfolio_texonomy",
    ]);

    //texonomy Description
    $wp_customize->add_setting("wallstreet_pro_options[wallstreet_texonomy_desc]", [
        "capability" => "edit_theme_options",
        "default" => __("Most popular of our works.", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[wallstreet_texonomy_desc]", [
        "type" => "textarea",
        "label" => __("Description", "wallstreet"),
        "section" => "portfolio_texonomy",
    ]);

    //Portfolio Texonomy Setting

    $wp_customize->add_section("project_realted", [
        "title" => __("Portfolio template and related page setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 100,
    ]);

    //Project Template Title
    $wp_customize->add_setting("wallstreet_pro_options[two_thre_four_col_port_tem_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Our Portfolio", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[two_thre_four_col_port_tem_title]", [
        "type" => "text",
        "label" => __("Title For Portfolio Template", "wallstreet"),
        "section" => "project_realted",
    ]);

    //Project Template Description
    $wp_customize->add_setting("wallstreet_pro_options[two_thre_four_col_port_tem_desc]", [
        "capability" => "edit_theme_options",
        "default" => __("Most popular of our works", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[two_thre_four_col_port_tem_desc]", [
        "type" => "textarea",
        "label" => __("Description For Portfolio Template", "wallstreet"),
        "section" => "project_realted",
    ]);
    // Number of Portfolio Template
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_numbers_on_templates]", [
        "default" => 4,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_numbers_on_templates]", [
        "type" => "number",
        "label" => __("Number of portfolio on portfolio template", "wallstreet"),
        "section" => "project_realted",
        "input_attrs" => [
            "min" => "1",
            "step" => "1",
            "max" => "50",
        ],
    ]);

    //Related project Title
    $wp_customize->add_setting("wallstreet_pro_options[related_portfolio_project_hide_show]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[related_portfolio_project_hide_show]", [
        "label" => __("Enable Related Project Setting", "wallstreet"),
        "section" => "project_realted",
        "type" => "checkbox",
    ]);
    $wp_customize->add_setting("wallstreet_pro_options[related_portfolio_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Related projects", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[related_portfolio_title]", [
        "type" => "text",
        "label" => __("Title For Related projects", "wallstreet"),
        "section" => "project_realted",
    ]);

    //Related project Description
    $wp_customize->add_setting("wallstreet_pro_options[related_portfolio_description]", [
        "capability" => "edit_theme_options",
        "default" => __("We offer great services to our clients", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[related_portfolio_description]", [
        "type" => "textarea",
        "label" => __("Description For Related projects", "wallstreet"),
        "section" => "project_realted",
    ]);

    //Conatct Page
    // add section to manage Address Section heading
    $wp_customize->add_section("conatact_page", [
        "title" => __("Contact page address settings", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 200,
    ]);
    // Enable Contact Page Address Section:
    $wp_customize->add_setting("wallstreet_pro_options[contact_address_settings]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_address_settings]", [
        "type" => "checkbox",
        "label" => __("Enable contact page address section", "wallstreet"),
        "section" => "conatact_page",
    ]);

    // Conatct icon
    $wp_customize->add_setting("wallstreet_pro_options[contact_address_icon]", [
        "capability" => "edit_theme_options",
        "default" => "fa-map-marker",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_address_icon]", [
        "type" => "text",
        "label" => __("Icon", "wallstreet"),
        "section" => "conatact_page",
    ]);

    // Conatct address
    $wp_customize->add_setting("wallstreet_pro_options[contact_address_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Address", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_address_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "conatact_page",
    ]);

    // Contact Aaddress Designation One:
    $wp_customize->add_setting("wallstreet_pro_options[contact_address_designation_one]", [
        "capability" => "edit_theme_options",
        "default" => "Hoffman Parkway, P.O. Box 353",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_address_designation_one]", [
        "type" => "text",
        "label" => __("Address one", "wallstreet"),
        "section" => "conatact_page",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[contact_address_designation_two]", [
        "capability" => "edit_theme_options",
        "default" => "Mountain View. USA",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_address_designation_two]", [
        "type" => "text",
        "label" => __("Address two", "wallstreet"),
        "section" => "conatact_page",
    ]);

    // add section to manage conatct phone Section heading
    $wp_customize->add_section("conatact_phone", [
        "title" => __("Contact page phone settings", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 200,
    ]);

    // Enable Contact Page phone Section:
    $wp_customize->add_setting("wallstreet_pro_options[contact_phone_settings]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_phone_settings]", [
        "type" => "checkbox",
        "label" => __("Enable contact page phone section", "wallstreet"),
        "section" => "conatact_phone",
    ]);

    // Conatct phone icon
    $wp_customize->add_setting("wallstreet_pro_options[contact_phone_icon]", [
        "capability" => "edit_theme_options",
        "default" => "fa-phone",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_phone_icon]", [
        "type" => "text",
        "label" => __("Icon", "wallstreet"),
        "section" => "conatact_phone",
    ]);

    // Contact Phone Title:
    $wp_customize->add_setting("wallstreet_pro_options[contact_phone_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Phone", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_phone_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "conatact_phone",
    ]);

    // Contact Phone Number One:
    $wp_customize->add_setting("wallstreet_pro_options[contact_phone_number_one]", [
        "capability" => "edit_theme_options",
        "default" => "1-800-123-789",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_phone_number_one]", [
        "type" => "text",
        "label" => __("Phone number one", "wallstreet"),
        "section" => "conatact_phone",
    ]);

    // Contact Phone Number Two:
    $wp_customize->add_setting("wallstreet_pro_options[contact_phone_number_two]", [
        "capability" => "edit_theme_options",
        "default" => "1-800-123-789",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_phone_number_two]", [
        "type" => "text",
        "label" => __("Phone number two", "wallstreet"),
        "section" => "conatact_phone",
    ]);

    // add section to manage Contact Page Email Section Settings
    $wp_customize->add_section("conatact_mail", [
        "title" => __("Contact page email settings", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 200,
    ]);

    // Enable Contact Page Email Section:
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_settings]", [
        "capability" => "edit_theme_options",
        "default" => true,
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_settings]", [
        "type" => "checkbox",
        "label" => __("Enable contact page email section", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // Conatct Email icon
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_icon]", [
        "capability" => "edit_theme_options",
        "default" => "fa-inbox",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_icon]", [
        "type" => "text",
        "label" => __("Icon", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // Contact Email Title:
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Email", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // Contact Email One:
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_number_one]", [
        "capability" => "edit_theme_options",
        "default" => "info@webriti.com",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_number_one]", [
        "type" => "text",
        "label" => __("Email one", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // Contact Email One:
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_number_one]", [
        "capability" => "edit_theme_options",
        "default" => "info@webriti.com",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_number_one]", [
        "type" => "text",
        "label" => __("Email one", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // Contact Email Number Two:
    $wp_customize->add_setting("wallstreet_pro_options[contact_email_number_two]", [
        "capability" => "edit_theme_options",
        "default" => "www.webriti.com",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_email_number_two]", [
        "type" => "text",
        "label" => __("Email two", "wallstreet"),
        "section" => "conatact_mail",
    ]);

    // add section to manage Contact Form title Settings
    $wp_customize->add_section("conatact_form", [
        "title" => __("Contact page form setting", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 200,
    ]);

    // Contact Form title:
    $wp_customize->add_setting("wallstreet_pro_options[contact_form_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Drop us a mail", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_form_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "conatact_form",
    ]);

    // Contact Form Description:
    $wp_customize->add_setting("wallstreet_pro_options[contact_form_description]", [
        "capability" => "edit_theme_options",
        "default" => __("Feel free to write us a message", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_form_description]", [
        "type" => "text",
        "label" => __("Description", "wallstreet"),
        "section" => "conatact_form",
    ]);

    // Conatct Google map
    $wp_customize->add_section("conatact_page_map", [
        "title" => __("Contact page Google Maps", "wallstreet"),
        "panel" => "wallstreet_template",
        "priority" => 190,
    ]);

    // Google map:
    $wp_customize->add_setting("wallstreet_pro_options[contact_google_map_enabled]", [
        "capability" => "edit_theme_options",
        "default" => "themes@webriti.com",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_google_map_enabled]", [
        "type" => "checkbox",
        "label" => __("Enable Google map in contact page", "wallstreet"),
        "section" => "conatact_page_map",
    ]);

    //Google map  tilte
    $wp_customize->add_setting("wallstreet_pro_options[contact_google_map_title]", [
        "capability" => "edit_theme_options",
        "default" => __("Location map", "wallstreet"),
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_google_map_title]", [
        "type" => "text",
        "label" => __("Title", "wallstreet"),
        "section" => "conatact_page_map",
    ]);

    //Google map URL

    $wp_customize->add_setting("wallstreet_pro_options[contact_google_map_url]", [
        "capability" => "edit_theme_options",
        "default" => "https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[contact_google_map_url]", [
        "type" => "textarea",
        "label" => __("URL", "wallstreet"),
        "section" => "conatact_page_map",
    ]);
}
add_action("customize_register", "wallstreet_template_customizer"); ?>
