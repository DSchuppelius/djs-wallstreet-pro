<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function service_customizer($wp_customize) {
    //Service section panel
    $wp_customize->add_panel("service_options", [
        "priority" => 600,
        "capability" => "edit_theme_options",
        "title" => __("Service settings", "wallstreet"),
    ]);

    $wp_customize->add_section("service_section_head", [
        "title" => __("Service heading", "wallstreet"),
        "panel" => "service_options",
        "priority" => 50,
    ]);

    //Number of services
    $wp_customize->add_setting("wallstreet_pro_options[service_list]", [
        "default" => 3,
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[service_list]", [
        "type" => "select",
        "label" => __("Number of services on service section", "wallstreet"),
        "section" => "service_section_head",
        "priority" => 50,
        "choices" => [
            3 => 3,
            6 => 6,
            9 => 9,
            12 => 12,
            15 => 15,
            18 => 18,
            21 => 21,
            24 => 24,
        ],
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[service_variation]", [
        "default" => 1,
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[service_variation]", [
        "type" => "select",
        "label" => __("Select Service Style", "wallstreet"),
        "section" => "service_section_head",
        "priority" => 50,
        "choices" => [
            1 => __("Style 1", "wallstreet"),
            2 => __("Style 2", "wallstreet"),
            3 => __("Style 3", "wallstreet"),
            4 => __("Style 4", "wallstreet"),
            5 => __("Style 5", "wallstreet"),
            6 => __("Style 6", "wallstreet"),
        ],
    ]);

    //Service title
    $wp_customize->add_setting("wallstreet_pro_options[service_title]", [
        "default" => __("Our Services", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "service_section_head",
        "type" => "text",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[service_description]", [
        "default" => __("We offer great services to our clients", "wallstreet"),
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "service_section_head",
        "type" => "text",
        "sanitize_callback" => "sanitize_text_field",
        "priority" => 200,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[service_middle_extrapadding]", [
        "default" => false,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_middle_extrapadding]", [
        "label" => __("Give middle element more size", "wallstreet"),
        "description" => __("This setting will work with only service design 1", "wallstreet"),
        "section" => "service_section_head",
        "type" => "checkbox",
        "sanitize_callback" => "sanitize_text_field",
        "priority" => 200,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[service_hover_change_effect]", [
        "default" => true,
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[service_hover_change_effect]", [
        "label" => __("Enable service animation effect", "wallstreet"),
        "description" => __("This setting will work with only service design 1 and service design 6", "wallstreet"),
        "section" => "service_section_head",
        "type" => "checkbox",
        "sanitize_callback" => "sanitize_text_field",
        "priority" => 200,
    ]);

    //Add Service setting
    class WP_service_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo SERVICE_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add service", "wallstreet"); ?></a>
		<?php
        }
    }

    $wp_customize->add_setting("service", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control(
        new WP_service_Customize_Control($wp_customize, "service", [
            "section" => "service_section_head",
            "priority" => 300,
        ])
    );

    //Other service section
    $wp_customize->add_section("other_service_section", [
        "title" => __("Other services section", "wallstreet"),
        "panel" => "service_options",
        "priority" => 50,
    ]);

    //Enable . disbaled other services
    $wp_customize->add_setting("wallstreet_pro_options[other_service_section_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[other_service_section_enabled]", [
        "label" => __("Enable other services section in service template", "wallstreet"),
        "section" => "other_service_section",
        "type" => "checkbox",
        "priority" => 50,
    ]);

    //Sarvice title
    $wp_customize->add_setting("wallstreet_pro_options[other_service_title]", [
        "default" => __("Other services", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[other_service_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "other_service_section",
        "type" => "text",
        "priority" => 100,
    ]);

    //other service description
    //Service title
    $wp_customize->add_setting("wallstreet_pro_options[other_service_description]", [
        "default" => __("We offer great services to our clients", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[other_service_description]", [
        "label" => __("Description", "wallstreet"),
        "section" => "other_service_section",
        "type" => "text",
        "priority" => 100,
    ]);

    //Add Service setting
    class WP_other_service_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
			<a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo SERVICE_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add service", "wallstreet"); ?></a>
		<?php
        }
    }

    $wp_customize->add_setting("other_service", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control(
        new WP_other_service_Customize_Control($wp_customize, "other_service", [
            "section" => "other_service_section",
            "priority" => 300,
        ])
    );

    //Service callout
    $wp_customize->add_section("service_callout_settings", [
        "title" => __("Service callout settings", "wallstreet"),
        "description" => "",
        "panel" => "service_options",
    ]);

    //Enable and disabled service callout Section
    $wp_customize->add_setting("wallstreet_pro_options[call_out_area_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[call_out_area_enabled]", [
        "label" => __("Enable Callout area section", "wallstreet"),
        "section" => "service_callout_settings",
        "type" => "checkbox",
    ]);

    // add section to manage callout
    $wp_customize->add_setting("wallstreet_pro_options[call_out_title]", [
        "default" => __("Wallstreet is an elegant and modern theme for business websites.", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[call_out_title]", [
        "label" => __("Title", "wallstreet"),
        "section" => "service_callout_settings",
        "type" => "text",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[call_out_text]", [
        "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eros elit, pretium et adipiscing vel, consectetur adipiscing elit.",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[call_out_text]", [
        "label" => __("Description", "wallstreet"),
        "section" => "service_callout_settings",
        "type" => "text",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[call_out_button_text]", [
        "default" => __("Purchase Now", "wallstreet"),
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[call_out_button_text]", [
        "label" => __("Button Text", "wallstreet"),
        "section" => "service_callout_settings",
        "type" => "text",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[call_out_button_link]", [
        "default" => "#",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);

    $wp_customize->add_control("wallstreet_pro_options[call_out_button_link]", [
        "label" => __("Button Link", "wallstreet"),
        "section" => "service_callout_settings",
        "type" => "text",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[call_out_button_link_target]", [
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "default" => true,
    ]);

    $wp_customize->add_control("wallstreet_pro_options[call_out_button_link_target]", [
        "type" => "checkbox",
        "label" => __("Open link in new tab", "wallstreet"),
        "section" => "service_callout_settings",
    ]);
}
add_action("customize_register", "service_customizer"); ?>
