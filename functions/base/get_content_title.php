<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : get_content_title.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_content_title($separator = ': ') {
    $output = "";
    $title = get_the_title();
    $post_format = get_post_format() ? : (get_post_type(get_the_ID()) == "post" ? "standard" : "none");

    if (!is_single()) {
        $print_separator = !empty($separator);
        $output = '<span class="title post_format ' . $post_format . '">';
    
        switch ($post_format) {
            case "aside":
                $output .= esc_html__("Aside", "djs-wallstreet-pro");
                break;
            case "audio":
                $output .= esc_html__("Audio", "djs-wallstreet-pro");
                break;
            case "video":
                $output .= esc_html__("Video", "djs-wallstreet-pro");
                break;
            case "chat":
                $output .= esc_html__("Chat", "djs-wallstreet-pro");
                break;
            case "gallery":
                $output .= esc_html__("Gallery", "djs-wallstreet-pro");
                break;
            case "image":
                $output .= esc_html__("Image", "djs-wallstreet-pro");
                break;
            case "link":
                $output .= esc_html__("Link", "djs-wallstreet-pro");
                break;
            case "quote":
                $output .= esc_html__("Quote", "djs-wallstreet-pro");
                break;
            case "status":
                $output .= esc_html__("Status", "djs-wallstreet-pro");
                break;
            case "story":
                $output .= esc_html__("Story", "djs-wallstreet-pro");
                break;
            case "standard":
                $output .= esc_html__("Blog Post", "djs-wallstreet-pro");
                break;
            default:
                $print_separator = false;
                break;
        }

        if ($print_separator) {
            $output .= $separator;
        }

        $output .= "</span>";
    }

    if (strlen($title) > 0) {
        $output .= '<span class="title">' . esc_html($title) . "</span>";
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
