<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-template.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_template_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        //template panel
        $wp_customize->add_panel("wallstreet_template", [
            "priority" => 920,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Template settings", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        if (defined("DJS_POSTTYPE_PLUGIN")) {
            // add section to manage Section heading
            $wp_customize->add_section("section_heading", [
                "title" => esc_html__("About page setting", "djs-wallstreet-pro"),
                "panel" => "wallstreet_template",
                "priority" => 100,
            ]);
    
            //Team Pgae template setting
            $wp_customize->add_section("team_page_template", [
                "title" => esc_html__("Team page setting", "djs-wallstreet-pro"),
                "panel" => "wallstreet_template",
                "priority" => 100,
            ]);
    
            //Testimonial Pgae template setting
            $wp_customize->add_section("testi_page_template", [
                "title" => esc_html__("Testimonial page setting", "djs-wallstreet-pro"),
                "panel" => "wallstreet_template",
                "priority" => 100,
            ]);
    
            //Portfolio taxonomy Setting
            $wp_customize->add_section("portfolio_taxonomy", [
                "title" => esc_html__("Portfolio category page setting", "djs-wallstreet-pro"),
                "panel" => "wallstreet_template",
                "priority" => 100,
            ]);
    
            //Project taxonomy Setting
            $wp_customize->add_section("project_realted", [
                "title" => esc_html__("Portfolio template and related page setting", "djs-wallstreet-pro"),
                "panel" => "wallstreet_template",
                "priority" => 100,
            ]);
        }
        //Blog template setting
        $wp_customize->add_section("blog_template_content_excerpt_setting", [
            "title" => esc_html__("Blog template data setting", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 149,
        ]);

        //enable/disable blog post meta content
        $wp_customize->add_section("blog_template", [
            "title" => esc_html__("Blog meta settings", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 150,
        ]);

        //Add section to manage Address Section heading
        $wp_customize->add_section("contact_section_page", [
            "title" => esc_html__("Contact page address settings", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 200,
        ]);

        //Add section to manage conatct phone Section heading
        $wp_customize->add_section("contact_section_phone", [
            "title" => esc_html__("Contact page phone settings", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 200,
        ]);

        //Add section to manage Contact Page Email Section Settings
        $wp_customize->add_section("contact_section_mail", [
            "title" => esc_html__("Contact page email settings", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 200,
        ]);

        //Add section to manage Contact Form title Settings
        $wp_customize->add_section("contact_section_form", [
            "title" => esc_html__("Contact page form setting", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 200,
        ]);

        // Contact Google map
        $wp_customize->add_section("contact_section_page_map", [
            "title" => esc_html__("Contact page Google Maps", "djs-wallstreet-pro"),
            "panel" => "wallstreet_template",
            "priority" => 190,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        if (defined("DJS_POSTTYPE_PLUGIN")) {
            $this->customize_register_heading($wp_customize);

            $this->customize_register_team($wp_customize);

            $this->customize_register_testimonial($wp_customize);

            $this->customize_register_portfolio_tax($wp_customize);

            $this->customize_register_project_related($wp_customize);
        } else {
            $this->customize_register_banner($wp_customize);
        }
        
        $this->customize_register_blog_template($wp_customize);
        $this->customize_register_blog_meta($wp_customize);

        $this->customize_register_contact_page($wp_customize);    
        $this->customize_register_contact_phone($wp_customize);
        $this->customize_register_contact_mail($wp_customize);
        $this->customize_register_contact_form($wp_customize);
        $this->customize_register_contact_map($wp_customize);
    }

    private function customize_register_banner($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[slideroundcorner]", [
            "default" => 100,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[slideroundcorner]", [
            "label" => esc_html__("Round Corner Value", "djs-wallstreet-pro"),
            "section" => "header_image",
            "type" => "number",
            "input_attrs" => [
                "min" => "1",
                "step" => "1",
                "max" => "300",
            ],
            "priority" => 400,
            "sanitize_callback" => "sanitize_text_field",
        ]);
    }

    private function customize_register_heading($wp_customize) {
        // About us page Heading
        $wp_customize->add_setting($this->theme_options_name . "[about_team_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[about_team_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable team section", "djs-wallstreet-pro"),
            "section" => "section_heading",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[about_team_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Our great team", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[about_team_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "section_heading",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[about_team_description]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("We offer great services to our clients", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[about_team_description]", [
            "type" => "textarea",
            "label" => esc_html__("Description", "djs-wallstreet-pro"),
            "section" => "section_heading",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[about_callout_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[about_callout_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable Call-to-Action section", "djs-wallstreet-pro"),
            "section" => "section_heading",
        ]);
    }

    private function customize_register_team($wp_customize) {
        // Enable Team section
        $wp_customize->add_setting($this->theme_options_name . "[team_template_team_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[team_template_team_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable team section", "djs-wallstreet-pro"),
            "section" => "team_page_template",
        ]);

        //Enable Feature section
        $wp_customize->add_setting($this->theme_options_name . "[team_template_feature_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[team_template_feature_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable feature section", "djs-wallstreet-pro"),
            "section" => "team_page_template",
        ]);

        //Enable Client Section
        $wp_customize->add_setting($this->theme_options_name . "[team_template_client_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[team_template_client_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable client section", "djs-wallstreet-pro"),
            "section" => "team_page_template",
        ]);
    }

    private function customize_register_testimonial($wp_customize) {
        // Enable cta section
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_template_cta_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_template_cta_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable Call-to-Action section", "djs-wallstreet-pro"),
            "section" => "testi_page_template",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[testimonial_cta_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Why choose us", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_cta_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "testi_page_template",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_cta_description]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("We offer great services to our clients", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_cta_description]", [
            "type" => "textarea",
            "label" => esc_html__("Description", "djs-wallstreet-pro"),
            "section" => "testi_page_template",
        ]);
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_template_testimonial_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_template_testimonial_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable testimonial section", "djs-wallstreet-pro"),
            "section" => "testi_page_template",
        ]);

        //Enable Client Section
        $wp_customize->add_setting($this->theme_options_name . "[testimonial_template_client_section_show_hide]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[testimonial_template_client_section_show_hide]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable client section", "djs-wallstreet-pro"),
            "section" => "testi_page_template",
        ]);  
    }

    private function customize_register_portfolio_tax($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[taxonomy_portfolio_list]", [
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "default" => 2,
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[taxonomy_portfolio_list]", [
            "type" => "select",
            "label" => esc_html__("Select column layout", "djs-wallstreet-pro"),
            "section" => "portfolio_taxonomy",
            "choices" => [2 => 2, 3 => 3, 4 => 4],
        ]);

        // Number of Portfolio Template
        $wp_customize->add_setting($this->theme_options_name . "[portfolio_numbers_for_templates_category]", [
            "default" => 8,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[portfolio_numbers_for_templates_category]", [
            "type" => "number",
            "label" => esc_html__("Numbers of portfolio in portfolio category page", "djs-wallstreet-pro"),
            "section" => "portfolio_taxonomy",
            "input_attrs" => [
                "min" => "1",
                "step" => "1",
                "max" => "10",
            ],
        ]);

        //taxonomy Title
        $wp_customize->add_setting($this->theme_options_name . "[wallstreet_taxonomy_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Featured portfolio", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[wallstreet_taxonomy_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "portfolio_taxonomy",
        ]);
    
        //taxonomy Description
        $wp_customize->add_setting($this->theme_options_name . "[wallstreet_taxonomy_desc]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Most popular of our works.", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[wallstreet_taxonomy_desc]", [
            "type" => "textarea",
            "label" => esc_html__("Description", "djs-wallstreet-pro"),
            "section" => "portfolio_taxonomy",
        ]);   
    }

    private function customize_register_project_related($wp_customize) {
        //Project Template Title
        $wp_customize->add_setting($this->theme_options_name . "[two_thre_four_col_port_tem_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Our Portfolio", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[two_thre_four_col_port_tem_title]", [
            "type" => "text",
            "label" => esc_html__("Title For Portfolio Template", "djs-wallstreet-pro"),
            "section" => "project_realted",
        ]);
    
        //Project Template Description
        $wp_customize->add_setting($this->theme_options_name . "[two_thre_four_col_port_tem_desc]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Most popular of our works", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[two_thre_four_col_port_tem_desc]", [
            "type" => "textarea",
            "label" => esc_html__("Description For Portfolio Template", "djs-wallstreet-pro"),
            "section" => "project_realted",
        ]);

        // Number of Portfolio Template
        $wp_customize->add_setting($this->theme_options_name . "[portfolio_numbers_on_templates]", [
            "default" => 4,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[portfolio_numbers_on_templates]", [
            "type" => "number",
            "label" => esc_html__("Number of portfolio on portfolio template", "djs-wallstreet-pro"),
            "section" => "project_realted",
            "input_attrs" => [
                "min" => "1",
                "step" => "1",
                "max" => "50",
            ],
        ]);
    
        //Related project Title
        $wp_customize->add_setting($this->theme_options_name . "[related_portfolio_project_hide_show]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[related_portfolio_project_hide_show]", [
            "label" => esc_html__("Enable Related Project Setting", "djs-wallstreet-pro"),
            "section" => "project_realted",
            "type" => "checkbox",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[related_portfolio_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Related projects", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[related_portfolio_title]", [
            "type" => "text",
            "label" => esc_html__("Title For Related projects", "djs-wallstreet-pro"),
            "section" => "project_realted",
        ]);
    
        //Related project Description
        $wp_customize->add_setting($this->theme_options_name . "[related_portfolio_description]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("We offer great services to our clients", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[related_portfolio_description]", [
            "type" => "textarea",
            "label" => esc_html__("Description For Related projects", "djs-wallstreet-pro"),
            "section" => "project_realted",
        ]);  
    }

    private function customize_register_blog_template($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[blog_template_content_excerpt_get_setting]", [
            "default" => "excerpt",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[blog_template_content_excerpt_get_setting]", [
            "label" => esc_html__("From which format do you want to display data on Archive Pages?", "djs-wallstreet-pro"),
            "section" => "blog_template_content_excerpt_setting",
            "type" => "radio",
            "choices" => [
                "excerpt" => esc_html__("Summary", "djs-wallstreet-pro"),
                "complete" => esc_html__("Full text", "djs-wallstreet-pro"),
            ],
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[blog_template_content_excerpt_length]", [
            "default" => 275,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[blog_template_content_excerpt_length]", [
            "label" => esc_html__("Excerpt length only for excerpt option", "djs-wallstreet-pro"),
            "section" => "blog_template_content_excerpt_setting",
            "type" => "number",
            "input_attrs" => [
                "min" => "1",
                "step" => "1",
                "max" => "1000",
            ],
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[blog_template_read_more]", [
            "default" => esc_html__("Read More", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[blog_template_read_more]", [
            "label" => esc_html__("Read more button text", "djs-wallstreet-pro"),
            "section" => "blog_template_content_excerpt_setting",
            "type" => "text",
        ]);   
    }

    private function customize_register_blog_meta($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[blog_meta_section_settings]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[blog_meta_section_settings]", [
            "label" => esc_html__("Hide post meta i.e. author name, date of submission, category, tags from posts page", "djs-wallstreet-pro"),
            "section" => "blog_template",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[page_meta_section_settings]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[page_meta_section_settings]", [
            "label" => esc_html__("Hide post meta i.e. author name, date of submission, category, tags from page", "djs-wallstreet-pro"),
            "section" => "blog_template",
            "type" => "checkbox",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[archive_page_meta_section_settings]", [
            "default" => 0,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[archive_page_meta_section_settings]", [
            "label" => esc_html__("Hide post meta i.e. author name, date of submission, category, tags from archive page", "djs-wallstreet-pro"),
            "section" => "blog_template",
            "type" => "checkbox",
        ]);
    }

    private function customize_register_contact_page($wp_customize) {
        // Enable Contact Page Address Section:
        $wp_customize->add_setting($this->theme_options_name . "[contact_address_settings]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_address_settings]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable contact page address section", "djs-wallstreet-pro"),
            "section" => "contact_section_page",
        ]);
    
        // Conatct icon
        $wp_customize->add_setting($this->theme_options_name . "[contact_address_icon]", [
            "capability" => "edit_theme_options",
            "default" => "fa-map-marker",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_address_icon]", [
            "type" => "text",
            "label" => esc_html__("Icon", "djs-wallstreet-pro"),
            "section" => "contact_section_page",
        ]);
    
        // Conatct address
        $wp_customize->add_setting($this->theme_options_name . "[contact_address_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Address", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_address_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "contact_section_page",
        ]);
    
        // Contact Aaddress Designation One:
        $wp_customize->add_setting($this->theme_options_name . "[contact_address_designation_one]", [
            "capability" => "edit_theme_options",
            "default" => "Hoffman Parkway, P.O. Box 353",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_address_designation_one]", [
            "type" => "text",
            "label" => esc_html__("Address one", "djs-wallstreet-pro"),
            "section" => "contact_section_page",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[contact_address_designation_two]", [
            "capability" => "edit_theme_options",
            "default" => "Mountain View. USA",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_address_designation_two]", [
            "type" => "text",
            "label" => esc_html__("Address two", "djs-wallstreet-pro"),
            "section" => "contact_section_page",
        ]);   
    }

    private function customize_register_contact_phone($wp_customize) {
        // Enable Contact Page phone Section:
        $wp_customize->add_setting($this->theme_options_name . "[contact_phone_settings]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_phone_settings]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable contact page phone section", "djs-wallstreet-pro"),
            "section" => "contact_section_phone",
        ]);
    
        // Conatct phone icon
        $wp_customize->add_setting($this->theme_options_name . "[contact_phone_icon]", [
            "capability" => "edit_theme_options",
            "default" => "fa-phone",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_phone_icon]", [
            "type" => "text",
            "label" => esc_html__("Icon", "djs-wallstreet-pro"),
            "section" => "contact_section_phone",
        ]);
    
        // Contact Phone Title:
        $wp_customize->add_setting($this->theme_options_name . "[contact_phone_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Phone", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_phone_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "contact_section_phone",
        ]);
    
        // Contact Phone Number One:
        $wp_customize->add_setting($this->theme_options_name . "[contact_phone_number_one]", [
            "capability" => "edit_theme_options",
            "default" => "1-800-123-789",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_phone_number_one]", [
            "type" => "text",
            "label" => esc_html__("Phone number one", "djs-wallstreet-pro"),
            "section" => "contact_section_phone",
        ]);
    
        // Contact Phone Number Two:
        $wp_customize->add_setting($this->theme_options_name . "[contact_phone_number_two]", [
            "capability" => "edit_theme_options",
            "default" => "1-800-123-789",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_phone_number_two]", [
            "type" => "text",
            "label" => esc_html__("Phone number two", "djs-wallstreet-pro"),
            "section" => "contact_section_phone",
        ]);
    }

    private function customize_register_contact_mail($wp_customize) {
        // Enable Contact Page Email Section:
        $wp_customize->add_setting($this->theme_options_name . "[contact_email_settings]", [
            "capability" => "edit_theme_options",
            "default" => true,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_email_settings]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable contact page email section", "djs-wallstreet-pro"),
            "section" => "contact_section_mail",
        ]);
    
        // Conatct Email icon
        $wp_customize->add_setting($this->theme_options_name . "[contact_email_icon]", [
            "capability" => "edit_theme_options",
            "default" => "fa-inbox",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_email_icon]", [
            "type" => "text",
            "label" => esc_html__("Icon", "djs-wallstreet-pro"),
            "section" => "contact_section_mail",
        ]);
    
        // Contact Email Title:
        $wp_customize->add_setting($this->theme_options_name . "[contact_email_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Email", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_email_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "contact_section_mail",
        ]);
    
        // Contact Email One:
        $wp_customize->add_setting($this->theme_options_name . "[contact_email_number_one]", [
            "capability" => "edit_theme_options",
            "default" => "info@schuppelius.org",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_email_number_one]", [
            "type" => "text",
            "label" => esc_html__("Email one", "djs-wallstreet-pro"),
            "section" => "contact_section_mail",
        ]);
    
        // Contact Email Number Two:
        $wp_customize->add_setting($this->theme_options_name . "[contact_email_number_two]", [
            "capability" => "edit_theme_options",
            "default" => "www.webriti.com",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_email_number_two]", [
            "type" => "text",
            "label" => esc_html__("Email two", "djs-wallstreet-pro"),
            "section" => "contact_section_mail",
        ]);   
    }

    private function customize_register_contact_form($wp_customize) {
        // Contact Form title:
        $wp_customize->add_setting($this->theme_options_name . "[contact_form_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Drop us a mail", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_form_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "contact_section_form",
        ]);
    
        // Contact Form Description:
        $wp_customize->add_setting($this->theme_options_name . "[contact_form_description]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Feel free to write us a message", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_form_description]", [
            "type" => "text",
            "label" => esc_html__("Description", "djs-wallstreet-pro"),
            "section" => "contact_section_form",
        ]);    
    }

    //HACK Theme Check - required to add theme in WordPress theme library (found no sanitizer)
    private function hack_4_theme_check__contact_google_map_url(){
        return esc_url("https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538");
    }

    private function customize_register_contact_map($wp_customize) {
        // Google map:
        $wp_customize->add_setting($this->theme_options_name . "[contact_google_map_enabled]", [
            "capability" => "edit_theme_options",
            "default" => "info@schuppelius.org",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_google_map_enabled]", [
            "type" => "checkbox",
            "label" => esc_html__("Enable Google map in contact page", "djs-wallstreet-pro"),
            "section" => "contact_section_page_map",
        ]);
    
        //Google map  tilte
        $wp_customize->add_setting($this->theme_options_name . "[contact_google_map_title]", [
            "capability" => "edit_theme_options",
            "default" => esc_html__("Location map", "djs-wallstreet-pro"),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_google_map_title]", [
            "type" => "text",
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "contact_section_page_map",
        ]);
    
        //Google map URL    
        $wp_customize->add_setting($this->theme_options_name . "[contact_google_map_url]", [
            "default" => $this->hack_4_theme_check__contact_google_map_url(),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[contact_google_map_url]", [
            "type" => "textarea",
            "label" => esc_html__("URL", "djs-wallstreet-pro"),
            "section" => "contact_section_page_map",
        ]);
    }
}

global $customizer_template;

if(!isset($customizer_template)) {
    $customizer_template = new theme_template_customizer();
    $customizer_template->register();
} ?>
