<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-blog-options.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_single_blog_customizer($wp_customize) {
    $wp_customize->add_setting("wallstreet_logo_length", [
        "default" => "156",
        "transport" => "postMessage",
        "sanitize_callback" => "absint",
    ]);

    $wp_customize->add_control(
        new Wallsteet_Slider_Custom_Control($wp_customize, "wallstreet_logo_length", [
            "label" => esc_html__("Logo Width", "djs-wallstreet-pro"),
            "priority" => 50,
            "section" => "title_tagline",
            "input_attrs" => [
                "min" => 0,
                "max" => 500,
                "step" => 1,
            ],
        ])
    );
}
add_action("customize_register", "wallstreet_single_blog_customizer"); ?>
