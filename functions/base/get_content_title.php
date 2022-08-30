<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : get_content_title.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_content_title() {
    $title = get_the_title();
    $print_doublepoint = true;
    $post_format = get_post_format() ? : (get_post_type(get_the_ID()) == "post" ? "standard" : "none");

    $output = '<span class="title post_format ' . $post_format . '">';

    switch ($post_format) {
        case "aside":
            $output .= __("Aside", "wallstreet");
            break;
        case "audio":
            $output .= __("Audio", "wallstreet");
            break;
        case "chat":
            $output .= __("Chat", "wallstreet");
            break;
        case "gallery":
            $output .= __("Gallery", "wallstreet");
            break;
        case "image":
            $output .= __("Image", "wallstreet");
            break;
        case "quote":
            $output .= __("Quote", "wallstreet");
            break;
        case "status":
            $output .= __("Status", "wallstreet");
            break;
        case "story":
            $output .= __("Story", "wallstreet");
            break;
        case "standard":
            $output .= __("Blog Post", "wallstreet");
            break;
        default:
            $print_doublepoint = false;
            break;
    }

    if ($print_doublepoint) {
        $output .= ": ";
    }
    if (strlen($title) == 0) {
        $output .= "</span>";
    } else {
        $output .= '</span><span class="title">' . esc_html($title) . "</span>";
    }

    return $output;
}

function the_content_title($before = "", $after = "", $echo = true) {
    $title = get_content_title();

    if (strlen($title) == 0) {
        return;
    }

    $title = $before . $title . $after;

    if ($echo) {
        echo $title;
    } else {
        return $title;
    }
}
