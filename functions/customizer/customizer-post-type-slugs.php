<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-post-type-slugs.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_post_type_slugs_customizer($wp_customize) {
    /* post type slugs settings */
    $wp_customize->add_panel("post_type_slug_settings", [
        "priority" => 950,
        "capability" => "edit_theme_options",
        "title" => __("SEO Friendly URL", "wallstreet"),
    ]);

    /* post type slugs page */
    $wp_customize->add_section("slugs_section", [
        "title" => __("SEO Friendly Url's", "wallstreet"),
        "panel" => "post_type_slug_settings",
    ]);

    // Slider Slug
    $wp_customize->add_setting("wallstreet_pro_options[slider_slug]", [
        "default" => "slider",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[slider_slug]", [
        "label" => __("Slider slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    // services_slug
    $wp_customize->add_setting("wallstreet_pro_options[service_slug]", [
        "default" => "service",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_slug]", [
        "label" => __("Service slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    // team_slug
    $wp_customize->add_setting("wallstreet_pro_options[team_slug]", [
        "default" => "team",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[team_slug]", [
        "label" => __("Team slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    //products_slug
    $wp_customize->add_setting("wallstreet_pro_options[portfolio_slug]", [
        "default" => "portfolio",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[portfolio_slug]", [
        "label" => __("Portfolio slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    //Portfolio category Slug
    $wp_customize->add_setting("wallstreet_pro_options[wallstreet_products_category_slug]", [
        "default" => "portfolio-categories",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[wallstreet_products_category_slug]", [
        "label" => __("Portfolio category slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    // Testimonial Slug
    $wp_customize->add_setting("wallstreet_pro_options[testimonial_slug]", [
        "default" => "testimonial",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[testimonial_slug]", [
        "label" => __("Testimonial slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    // Client Slug
    $wp_customize->add_setting("wallstreet_pro_options[client_slug]", [
        "default" => "client",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[client_slug]", [
        "label" => __("Client slug", "wallstreet"),
        "section" => "slugs_section",
        "type" => "text",
    ]);

    class wallstreet_Customize_slug extends WP_Customize_Control {
        public function render_content() {
            ?>
			<h3><?php _e("After changing the slug, please do not forget to save the permalinks. Without saving, the old permalinks will not update.", "wallstreet"); ?>
		<?php
        }
    }

    $wp_customize->add_setting("wallstreet_pro_options[wallstreet_slug_setting]", [
        "default" => false,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "wp_filter_nohtml_kses",
    ]);
    $wp_customize->add_control(
        new wallstreet_Customize_slug($wp_customize, "wallstreet_pro_options[wallstreet_slug_setting]", [
            "label" => __("Wallstreet slug", "wallstreet"),
            "section" => "slugs_section",
            "settings" => "wallstreet_pro_options[wallstreet_slug_setting]",
        ])
    );

    class WP_slug_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/options-permalink.php" class="button" target="_blank"><?php _e("Click here permalinks setting", "wallstreet"); ?></a>
		<?php
        }
    }

    $wp_customize->add_setting("slug", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control(
        new WP_slug_Customize_Control($wp_customize, "slug", [
            "section" => "slugs_section",
        ])
    );
}
add_action("customize_register", "wallstreet_post_type_slugs_customizer"); ?>
