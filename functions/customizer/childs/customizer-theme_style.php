<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer_theme_style.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_style_customizer extends theme_customizer {

    public function customize_register_panel($wp_customize) {}

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("theme_style", [
            "title" => __("Theme Style settings", "wallstreet"),
            "priority" => 0,
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        $wp_customize->remove_control("header_textcolor");

        $wp_customize->add_setting($this->theme_options_name . "[stylesheet]", [
            "default" => "#00c2a9",
            "capability" => "edit_theme_options",
            "type" => "option",
        ]);
    
        $wp_customize->add_control(
            new WP_Color_Customize_Control($wp_customize, $this->theme_options_name . "[stylesheet]", [
                "section" => "theme_style",
                "type" => "radio",
                "choices" => [
                    "#ffc400" => "yellow-dark.jpg",                
                    "#ff8a00" => "orange-dark.jpg",
                    "#ee1d24" => "red-dark.jpg",
                    "#88be4c" => "papaya-dark.jpg",
                    "#00c2a9" => "turquoise-dark.jpg",
                    "#22a1c4" => "blue-dark.jpg",
                    "#c1c1c1" => "gray-dark.jpg",
                    "ffc400" => "yellow-light.jpg",
                    "ff8a00" => "orange-light.jpg",
                    "ee1d24" => "red-light.jpg",
                    "88be4c" => "papaya-light.jpg",
                    "00c2a9" => "turquoise-light.jpg",
                    "22a1c4" => "blue-light.jpg",
                    "c1c1c1" => "gray-light.jpg",
    
                    "default.css" => "dark.png",
                    "light.css" => "light.png",
                ],
            ])
        );
    
        $wp_customize->add_setting($this->theme_options_name . "[link_color]", [
            "capability" => "edit_theme_options",
            "default" => "#00c2a9",
            "type" => "option",
        ]);
    
        $wp_customize->add_control(
            new WP_Customize_Color_Control($wp_customize, $this->theme_options_name . "[link_color]", [
                "label" => __("Change skin color for light and dark background", "wallstreet"),
                "section" => "theme_style",
                "settings" => $this->theme_options_name . "[link_color]",
            ])
        );
    }
}

global $customizer_theme_style;

if(!isset($customizer_theme_style)) {
    $customizer_theme_style = new theme_style_customizer();
    $customizer_theme_style->register();
}
?>
