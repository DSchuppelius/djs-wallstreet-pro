<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-blog.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_blog_customizer extends Theme_Customizer {

    public function __construct() {
        parent::__construct();
        $this->register_panel = true;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("blog_setting", [
            "priority" => 225,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Blog settings", "djs-wallstreet-pro"),
        ]);
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("news_section_settings", [
            "title" => esc_html__("Home blog settings", "djs-wallstreet-pro"),
            "panel" => "blog_setting",
            "priority" => 750,
        ]);

        $wp_customize->add_section("archive_section_settings", [
            "title" => esc_html__("Archive settings", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Hide blog meta from home page", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);

        // add section to manage News
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_heading]", [
            "default" => esc_html__("Our latest blog post", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "type" => "option",
            "sanitize_callback" => "sanitize_text_field",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_heading]", [
            "label" => esc_html__("Title", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "text",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[home_blog_description]", [
            "default" => esc_html__("We work with new customers and grow their businesses", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_description]", [
            "label" => esc_html__("Description", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "textarea",
        ]);

        // Blog Design layout
        $wp_customize->add_setting($this->theme_options_name . "[home_blog_design]", [
            "default" => 1,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_design]", [
            "type" => "select",
            "label" => esc_html__("Blog design style", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "choices" => [
                1 => esc_html__("Grid View", "djs-wallstreet-pro"),
                2 => esc_html__("Masonry 2 Column", "djs-wallstreet-pro"),
                3 => esc_html__("Masonry 3 Column", "djs-wallstreet-pro"),
                4 => esc_html__("Masonry 4 Column", "djs-wallstreet-pro"),
                5 => esc_html__("List Style", "djs-wallstreet-pro"),
                6 => esc_html__("Switcher List Style", "djs-wallstreet-pro"),
            ],
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[home_blog_counts]", [
            "default" => 3,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[home_blog_counts]", [
            "type" => "select",
            "label" => esc_html__("No of Post", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Enable view all posts button", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);

        //View all posts Button text
        $wp_customize->add_setting($this->theme_options_name . "[view_all_posts_text]", [
            "default" => esc_html__("View All Posts", "djs-wallstreet-pro"),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[view_all_posts_text]", [
            "label" => esc_html__("Button Text", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "text",
        ]);

        //View all posts Button Link
        $wp_customize->add_setting($this->theme_options_name . "[all_posts_link]", [
            "default" => "#",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_url",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[all_posts_link]", [
            "label" => esc_html__("Button Link", "djs-wallstreet-pro"),
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
            "label" => esc_html__("Open link in new tab", "djs-wallstreet-pro"),
            "section" => "news_section_settings",
            "type" => "checkbox",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[max_archive_year]", [
            "default" => 5,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_year]", [
            "label" => esc_html__("Max items in year archive", "djs-wallstreet-pro"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "10",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => esc_html__("0 for full archive", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[max_archive_month]", [
            "default" => 12,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_month]", [
            "label" => esc_html__("Max items in month archive", "djs-wallstreet-pro"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "12",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => esc_html__("0 for full archive", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[max_archive_day]", [
            "default" => 7,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_archive_day]", [
            "label" => esc_html__("Max items in day archive", "djs-wallstreet-pro"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "0",
                "step" => "1",
                "max" => "31",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
            "description" => esc_html__("0 for full archive", "djs-wallstreet-pro"),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[max_page_buttons]", [
            "default" => 11,
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[max_page_buttons]", [
            "label" => esc_html__("Max buttons for blog pagination (excl. 2 buttons for next or previous page)", "djs-wallstreet-pro"),
            "section" => "archive_section_settings",
            "type" => "number",
            "input_attrs" => [
                "min" => "5",
                "step" => "1",
                "max" => "999",
            ],
            "priority" => 600,
            "sanitize_callback" => "sanitize_text_field",
        ]);
    }
}

global $customizer_blog;

if(!isset($customizer_blog)) {
    $customizer_blog = new theme_blog_customizer();
    $customizer_blog->register();
} ?>