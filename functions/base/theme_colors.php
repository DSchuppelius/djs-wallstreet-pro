<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_light.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $link_color;
global $background_color;

$current_options = get_current_options();

if ($current_options["stylesheet"] == "default.css" || $current_options["stylesheet"] == "light.css") {
    $link_color = $current_options["link_color"];
} else {
    $hash = substr($current_options["stylesheet"], 0, 1);
    $color = substr($current_options["stylesheet"], 1);

    if ($hash == "#") {
        $link_color = $current_options["stylesheet"];
    } else {
        $link_color = "#" . $current_options["stylesheet"];
    }
}

$temp_color = get_background_color();
$default_color = get_theme_support('custom-background', 'default-color');

if(empty($temp_color) || $default_color == false || $temp_color === $default_color) {
    switch (get_custom_stylesheet()) {
        case 'default.css':
            $background_color = "#2a2c33";
            break;
        case 'light.css':
            $background_color = "#fff";
            break;	
        default:
            $background_color = "#000";
            break;
    }
}else {
    $background_color = "#" . get_background_color();
}

function get_custom_stylesheet($options = null) {
    if (empty($options)) {
        $current_options = get_current_options();
    } else {
        $current_options = $options;
    }

    $output = null;

    if ($current_options["stylesheet"] == "light.css") {
        $output = "light.css";
    } elseif ($current_options["stylesheet"] == "default.css") {
        $output = "default.css";
    } else {
        $hash = substr($current_options["stylesheet"], 0, 1);
        if ($hash == "#") {
            $output = "default.css";
        } else {
            $output = "light.css";
        }
    }
    return $output;
}

function get_rgba($hex_color, $alpha = 1, $reduce_color="#000000", $add_color="#000000") {
    list($r, $g, $b) = sscanf($hex_color, "#%02x%02x%02x");
    list($r_r, $r_g, $r_b) = sscanf($reduce_color, "#%02x%02x%02x");
    list($a_r, $a_g, $a_b) = sscanf($add_color, "#%02x%02x%02x");
    return sprintf("rgba(%d, %d, %d, %01.2f)", $r - $r_r + $a_r, $g - $r_g + $a_g, $b - $r_b + $r_b, $alpha);
}

function the_rgba($hex_color, $alpha = 1){
    echo get_rgba($hex_color, $alpha);
}

function the_reduced_rgba($hex_color, $alpha = 1, $reduce_color="#321928"){
    echo get_rgba($hex_color, $alpha, $reduce_color);
}

function the_additional_rgba($hex_color, $alpha = 1, $add_color="#101010"){
    echo get_rgba($hex_color, $alpha, "#000000", $add_color);
}
?>
