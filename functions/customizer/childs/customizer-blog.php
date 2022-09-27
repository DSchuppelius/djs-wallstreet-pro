<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-blog.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_blog_customizer extends theme_customizer {
    
    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("blog_setting", [
            "priority" => 200,
            "capability" => "edit_theme_options",
            "title" => __("Blog settings", "wallstreet"),
        ]);        
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("news_section_settings", [
            "title" => __("Home blog settings", "wallstreet"),
            "panel" => "blog_setting",
            "priority" => 750,
        ]);

        $wp_customize->add_section("archive_section_settings", [
            "title" => __("Archive settings", "wallstreet"),
            "panel" => "blog_setting",
            "priority" => 850,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {    
        // hide meta content
        $wp_customize->add_setting($this->theme_options_name . "[home_meta_section_settings]", [
            "default" => "",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_meta_section_settings]", [
            "label" => __("Hide blog meta from home page", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);
    
        // add section to manage News
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_heading]", [
            "default" => __("Our latest blog post", "wallstreet"),
            "capability" => "edit_theme_options",
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_heading]", [
            "label" => __("Title", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "text",
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_description]", [
            "default" => __("We work with new customers and grow their businesses", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_description]", [
            "label" => __("Description", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "textarea",
        ]);
    
        // Blog Design layout
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_design]", [
            "default" => 1,
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_design]", [
            "type" => "select",
            "label" => __("Blog design style", "wallstreet"),
            "section" => "news_section_settings",
            "choices" => [
                1 => __("Grid View", "wallstreet"),
                2 => __("Masonry 2 Column", "wallstreet"),
                3 => __("Masonry 3 Column", "wallstreet"),
                4 => __("Masonry 4 Column", "wallstreet"),
                5 => __("List Style", "wallstreet"),
                6 => __("Switcher List Style", "wallstreet"),
            ],
        ]);
    
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_counts]", [
            "default" => 3,
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_counts]", [
            "type" => "select",
            "label" => __("No of Post", "wallstreet"),
            "section" => "news_section_settings",
            "choices" => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9,
            ],
        ]);
    
        //View all posts Button Enable
        $wp_customize->add_setting($this->theme_options_name . "[view_all_posts_btn_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);
    
        $wp_customize->add_control($this->theme_options_name . "[view_all_posts_btn_enabled]", [
            "label" => __("Enable view all posts button", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);
    
        //View all posts Button text
        $wp_customize->add_setting($this->theme_options_name . "[view_all_posts_text]", [
            "default" => __("View All Posts", "wallstreet"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[view_all_posts_text]", [
            "label" => __("Button Text", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "text",
        ]);
    
        //View all posts Button Link
        $wp_customize->add_setting($this->theme_options_name . "[all_posts_link]", [
            "default" => "#",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[all_posts_link]", [
            "label" => __("Button Link", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "text",
        ]);
    
        //View all portfolio Button Link
        $wp_customize->add_setting($this->theme_options_name . "[view_all_link_target]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "description" => "Open link in a new window/tab",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[view_all_link_target]", [
            "label" => __("Open link in new tab", "wallstreet"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[max_archive_year]", [
            "default" => 5,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_year]", [
            "label" => __("Max items in year archive", "wallstreet"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "10",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => __("0 for full archive", "wallstreet"),
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[max_archive_month]", [
            "default" => 12,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_month]", [
            "label" => __("Max items in month archive", "wallstreet"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "12",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => __("0 for full archive", "wallstreet"),
        ]);
        
        $wp_customize->add_setting($this->theme_options_name . "[max_archive_day]", [
            "default" => 7,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_day]", [
            "label" => __("Max items in day archive", "wallstreet"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "31",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => __("0 for full archive", "wallstreet"),
        ]);
    }
}

global $customizer_blog;

if(!isset($customizer_blog)) {
    $customizer_blog = new theme_blog_customizer();
    $customizer_blog->register();
} ?>
