<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-slider.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function slider_customizer($wp_customize) {
    //slider Section
    $wp_customize->add_panel("slider_setting", [
        "priority" => 500,
        "capability" => "edit_theme_options",
        "title" => __("Slider settings", "wallstreet"),
    ]);

    $wp_customize->add_section("slider_section_settings", [
        "title" => __("Slider settings", "wallstreet"),
        "description" => "",
        "panel" => "slider_setting",
    ]);

    //Hide slider
    $wp_customize->add_setting("wallstreet_pro_options[home_slider_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_enabled]", [
        "label" => __("Enable home slider", "wallstreet"),
        "section" => "slider_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[slidertype]", [
        "default" => "base",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[slidertype]", [
        "type" => "select",
        "label" => __("Select slidertype", "wallstreet"),
        "section" => "slider_section_settings",
        "priority" => 190,
        "choices" => [
            "base" => __("Baseslider", "wallstreet"),
            "revolution" => __("Revolution", "wallstreet"),
        ],
    ]);

    //Slider name
    $wp_customize->add_setting("wallstreet_pro_options[revolutionslidername]", [
        "default" => "startslider",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[revolutionslidername]", [
        "type" => "textbox",
        "label" => __("Slidername", "wallstreet"),
        "section" => "slider_section_settings",
    ]);

    //Slider animation
    $wp_customize->add_setting("wallstreet_pro_options[animation]", [
        "default" => "slide",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[animation]", [
        "type" => "select",
        "label" => __("Select slider animation", "wallstreet"),
        "section" => "slider_section_settings",
        "priority" => 200,
        "choices" => [
            "slide" => __("Slide", "wallstreet"),
            "fade" => __("Fade", "wallstreet"),
        ],
    ]);

    //Slider animation
    $wp_customize->add_setting("wallstreet_pro_options[slide_direction]", [
        "default" => "horizontal",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[slide_direction]", [
        "type" => "select",
        "label" => __("Slide direction", "wallstreet"),
        "section" => "slider_section_settings",
        "priority" => 250,
        "choices" => [
            "horizontal" => __("horizontal", "wallstreet"),
            "vertical" => __("vertical", "wallstreet"),
        ],
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[animationSpeed]", [
        "default" => "1500",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[animationSpeed]", [
        "type" => "select",
        "label" => __("Animation speed", "wallstreet"),
        "section" => "slider_section_settings",
        "priority" => 300,
        "choices" => [
            "500" => "0.5",
            "1000" => "1.0",
            "1500" => "1.5",
            "2000" => "2.0",
            "2500" => "2.5",
            "3000" => "3.0",
            "3500" => "3.5",
            "4000" => "4.0",
            "4500" => "4.5",
            "5000" => "5.0",
            "5500" => "5.5",
        ],
    ]);

    // Slide show speed
    $wp_customize->add_setting("wallstreet_pro_options[slideshowSpeed]", [
        "default" => "2500",
        "type" => "option",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[slideshowSpeed]", [
        "type" => "select",
        "label" => __("Slideshow speed", "wallstreet"),
        "section" => "slider_section_settings",
        "priority" => 300,
        "choices" => [
            "500" => "0.5",
            "1000" => "1.0",
            "1500" => "1.5",
            "2000" => "2.0",
            "2500" => "2.5",
            "3000" => "3.0",
            "3500" => "3.5",
            "4000" => "4.0",
            "4500" => "4.5",
            "5000" => "5.0",
            "5500" => "5.5",
        ],
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[slideroundcorner]", [
        "default" => __("100", "wallstreet"),
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[slideroundcorner]", [
        "label" => __("Round Corner Value", "wallstreet"),
        "section" => "slider_section_settings",
        "type" => "number",
        "input_attrs" => [
            "min" => "1",
            "step" => "1",
            "max" => "1000",
        ],
        "priority" => 400,
        "sanitize_callback" => "sanitize_text_field",
    ]);

    //Section For Desktop View
    $wp_customize->add_section("slider_desktop_section_settings", [
        "title" => __("Slider desktop view settings", "wallstreet"),
        "description" => "",
        "panel" => "slider_setting",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_desktop_title_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_desktop_title_enabled]", [
        "label" => __("Enable slider title", "wallstreet"),
        "section" => "slider_desktop_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_desktop_subtitle_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_desktop_subtitle_enabled]", [
        "label" => __("Enable slider subtitle", "wallstreet"),
        "section" => "slider_desktop_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_desktop_desc_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_desktop_desc_enabled]", [
        "label" => __("Enable slider description", "wallstreet"),
        "section" => "slider_desktop_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_desktop_button_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_desktop_button_enabled]", [
        "label" => __("Enable button", "wallstreet"),
        "section" => "slider_desktop_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    //Section For Desktop View
    $wp_customize->add_section("slider_mobile_section_settings", [
        "title" => __("Slider mobile view settings", "wallstreet"),
        "description" => "",
        "panel" => "slider_setting",
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_mobile_title_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_mobile_title_enabled]", [
        "label" => __("Enable slider title", "wallstreet"),
        "section" => "slider_mobile_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_mobile_subtitle_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_mobile_subtitle_enabled]", [
        "label" => __("Enable slider subtitle", "wallstreet"),
        "section" => "slider_mobile_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_mobile_desc_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_mobile_desc_enabled]", [
        "label" => __("Enable slider description", "wallstreet"),
        "section" => "slider_mobile_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    $wp_customize->add_setting("wallstreet_pro_options[home_slider_mobile_button_enabled]", [
        "default" => true,
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
    ]);
    $wp_customize->add_control("wallstreet_pro_options[home_slider_mobile_button_enabled]", [
        "label" => __("Enable button", "wallstreet"),
        "section" => "slider_mobile_section_settings",
        "type" => "checkbox",
        "priority" => 100,
    ]);

    //Add Slider setting
    class WP_slider_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            ?>
            <a href="<?php bloginfo("url"); ?>/wp-admin/edit.php?post_type=<?php echo SLIDER_POST_TYPE; ?>" class="button" target="_blank"><?php _e("Click here to add slider", "wallstreet"); ?></a>
        <?php
        }
    }

    $wp_customize->add_setting("slider", [
        "default" => "",
        "capability" => "edit_theme_options",
        "sanitize_callback" => "sanitize_text_field",
    ]);
    $wp_customize->add_control(
        new WP_slider_Customize_Control($wp_customize, "slider", [
            "section" => "slider_section_settings",
            "priority" => 500,
        ])
    );
}
add_action("customize_register", "slider_customizer"); ?>
