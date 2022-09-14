<?php
/*
 * Created on   : Wed Sep 01 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-partner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function partner_customizer($wp_customize) {
    //Front Partner section
    $wp_customize->add_panel("partner_setting", [
        "priority" => 800,
        "capability" => "edit_theme_options",
        "title" => __("Partner settings", "wallstreet"),
    ]);

    $wp_customize->add_section("partner_section_settings", [
        "title" => __("Section Heading", "wallstreet"),
        "description" => "",
        "panel" => "partner_setting",
    ]);

    //Partner title
    $wp_customize->add_setting("wallstreet_pro_options[home_partner_title]", [
        "default" => __("Our Partners", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_partner_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "partner_section_settings",
        "type" => "text",
    ]);

    //Partner Discription
    $wp_customize->add_setting("wallstreet_pro_options[home_partner_description]", [
        "default" => __("Have a look at our partners we are growing their business and they are going up in the market by beating their competitors.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[home_partner_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "partner_section_settings",
        "type" => "textarea",
    ]);

    $wp_customize->add_panel("partner_setting", [
        "priority" => 800,
        "capability" => "edit_theme_options",
        "title" => __("Partner settings", "wallstreet"),
    ]);

    $wp_customize->add_section("partner_picture_settings", [
        "title" => __("Partner Picture Settings", "wallstreet"),
        "description" => "",
        "panel" => "partner_setting",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[partner_pictureheight]", [
        "default" => 100,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[partner_pictureheight]", [
        "label" => __("Max Pictureheight", "wallstreet"),
        "section" => "partner_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "50",
            "step" => "1",
            "max" => "200",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[partner_padding_tb]", [
        "default" => 30,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[partner_padding_tb]", [
        "label" => __("Top/Bottom Padding", "wallstreet"),
        "section" => "partner_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "100",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[partner_padding_lr]", [
        "default" => 30,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[partner_padding_lr]", [
        "label" => __("Left/Right Padding", "wallstreet"),
        "section" => "partner_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "100",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    //Partner link
    class WP_partner_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo PARTNER_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add partner", "wallstreet"); ?></a>
		<?php
        }
    }

    $wp_customize->add_setting("partner", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_control(
        new WP_partner_Customize_Control($wp_customize, "partner", [
            "section" => "partner_section_settings",
            "priority" => 500,
        ])
    );
}
add_action("customize_register", "partner_customizer"); ?>
