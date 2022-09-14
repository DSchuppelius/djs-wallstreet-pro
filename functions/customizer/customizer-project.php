<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-project.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_project_customizer($wp_customize) {
    //Home project Section
    $wp_customize->add_panel("wallstreet_project_setting", [
        "priority" => 700,
        "capability" => "edit_theme_options",
        "title" => __("Project settings", "wallstreet"),
    ]);

    $wp_customize->add_section("project_section_settings", [
        "title" => __("Homepage project settings", "wallstreet"),
        "description" => "",
        "panel" => "wallstreet_project_setting",
    ]);

    //Column Layout
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_homepage_column_layouts]", [
        "default" => 3,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_homepage_column_layouts]", [
        "type" => "radio",
        "label" => __("Portfolio Column layout section", "wallstreet"),
        "section" => "project_section_settings",
        "choices" => [
            3 => "4 Column Layout",
            4 => "3 Column Layout",
            6 => "2 Column Layout",
        ],
    ]);

    //Item Layout
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_homepage_item_layouts]", [
        "default" => "single-items",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_homepage_item_layouts]", [
        "type" => "radio",
        "label" => __("Portfolio item layout section", "wallstreet"),
        "section" => "project_section_settings",
        "choices" => [
            "clover-items" => __("Clover (Only for 4 Column Layout)", "wallstreet"),
            "block-items" => __("Block", "wallstreet"),
            "single-items" => __("Single", "wallstreet"),
        ],
    ]);

    // Number of Portfolio section
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_list]", [
        "default" => 4,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_list]", [
        "type" => "number",
        "label" => __("Number of portfolio on portfolio section", "wallstreet"),
        "section" => "project_section_settings",
        "input_attrs" => [
            "min" => "1",
            "step" => "1",
            "max" => "24",
        ],
    ]);

    //Project Title
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_title]", [
        "default" => __("Featured portfolio", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "text",
    ]);

    //Project Description
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_description]", [
        "default" => __("Most popular of our works.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "text",
    ]);

    //View all portfolio Button Link
    $wp_customize->add_setting("wallstreet_pro_options[view_all_projects_btn_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[view_all_projects_btn_enabled]", [
        "label" => __("Enable view all portfolios button", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "checkbox",
    ]);

    //Project Project Button text
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_more_text]", [
        "default" => __("View All Projects", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_more_text]", [
        "label" => __("Button Text", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "text",
    ]);

    //View all portfolio Button Link
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_more_link]", [
        "default" => "#",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[portfolio_more_link]", [
        "label" => __("Button Link", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "text",
    ]);

    //View all portfolio Button Link
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_more_link_target]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "description" => "Open link in a new window/tab",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[portfolio_more_link_target]", [
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "project_section_settings",
        "type" => "checkbox",
    ]);

    //link
    class WP_project_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo PORTFOLIO_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add project", "wallstreet"); ?></a>
		<?php
        }
    }

    $wp_customize->add_setting("project", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control(
        new WP_project_Customize_Control($wp_customize, "project", [
            "section" => "project_section_settings",
        ])
    );
}
add_action("customize_register", "wallstreet_project_customizer"); ?>
