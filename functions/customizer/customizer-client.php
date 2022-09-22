<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-client.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function client_customizer($wp_customize) {
    //Front Client section
    $wp_customize->add_panel("client_setting", [
        "priority" => 800,
        "capability" => "edit_theme_options",
        "title" => __("Client settings", "wallstreet"),
    ]);

    $wp_customize->add_section("client_section_settings", [
        "title" => __("Section Heading", "wallstreet"),
        "description" => "",
        "panel" => "client_setting",
    ]);

    //Client title
    $wp_customize->add_setting("wallstreet_pro_options[home_client_title]", [
        "default" => __("Our Clients", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_client_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "client_section_settings",
        "type" => "text",
    ]);

    //Client Discription
    $wp_customize->add_setting("wallstreet_pro_options[home_client_description]", [
        "default" => __("Have a look at our clients we are growing their business and they are going up in the market by beating their competitors.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[home_client_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "client_section_settings",
        "type" => "textarea",
    ]);

    $wp_customize->add_panel("client_setting", [
        "priority" => 800,
        "capability" => "edit_theme_options",
        "title" => __("Client settings", "wallstreet"),
    ]);

    $wp_customize->add_section("client_picture_settings", [
        "title" => __("Client Picture Settings", "wallstreet"),
        "description" => "",
        "panel" => "client_setting",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[client_pictureheight]", [
        "default" => 100,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[client_pictureheight]", [
        "label" => __("Max Pictureheight", "wallstreet"),
        "section" => "client_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "50",
            "step" => "1",
            "max" => "200",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[client_padding_tb]", [
        "default" => 30,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[client_padding_tb]", [
        "label" => __("Top/Bottom Padding", "wallstreet"),
        "section" => "client_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "100",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[client_padding_lr]", [
        "default" => 30,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[client_padding_lr]", [
        "label" => __("Left/Right Padding", "wallstreet"),
        "section" => "client_picture_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "0",
            "step" => "1",
            "max" => "100",
        ],
        "sanitize_callback" => "sanitize_text_field",
    ]);

    //Client link
    class WP_client_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() { ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo CLIENT_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add client", "wallstreet"); ?></a>
		<?php }
    }

    $wp_customize->add_setting("client", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_control(
        new WP_client_Customize_Control($wp_customize, "client", [
            "section" => "client_section_settings",
            "priority" => 500,
        ])
    );
}
add_action("customize_register", "client_customizer"); ?>
