<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_functions.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_Values_On_Current_Option($option, $positive, $negative = "", $prefix = "", $suffix = "") {
    $current_options = get_current_options();

    if (array_key_exists($option, $current_options)) {
        if ($current_options[$option]) {
            return $prefix . $positive . $suffix;
        } elseif (!empty($negative)) {
            return $prefix . $negative . $suffix;
        } else {
            return "";
        }
    }

    return null;
}

function get_blank_Target($option){
    $result = 'target="';
    if ($option) {
        $result .= '_blank"';
    } else {
        $result .=  '_self"';
    }
    return $result;
}

function blank_Target($option){
    echo get_blank_Target($option);
}

function is_NoFrame_With_BigBorder() {
    $current_options = get_current_options();
    if (!$current_options["addframe"] && $current_options["bigborder"]) {
        return true;
    }

    return false;
}

function is_meta_enabled($zone = "all") {
    $current_options = get_current_options();
    $pages = ["page.php", "template/page-full-width.php"];
    $pages_dateless = ["template/page-full-width-dateless.php", "template/page-full-width-no-meta.php", "template/about-us.php"];
    $archives = ["search.php"];
    $combined = [];
    array_push($combined, $pages, $archives, $pages_dateless);

    switch ($zone) {
        case "blog":
            if (!contains_page_templates($combined) && $current_options["blog_meta_section_settings"] == false) {
                return true;
            }
            break;
        case "page":
            if (is_meta_enabled("page_dateless") || is_meta_enabled("page_date")) {
                return true;
            }
            break;
        case "archive":
            if (contains_page_templates($archives) && $current_options["archive_page_meta_section_settings"] == false) {
                return true;
            }
            break;
        case "page_date":
            if (contains_page_templates($pages) && $current_options["page_meta_section_settings"] == false) {
                return true;
            }
            break;
        case "page_dateless":
            if (contains_page_templates($pages_dateless) && $current_options["page_meta_section_settings"] == false) {
                return true;
            }
            break;
        case "with_date":
            if (is_meta_enabled("blog") || is_meta_enabled("page_date") || is_meta_enabled("archive")) {
                return true;
            }
            break;
        default:
            if (is_meta_enabled("blog") || is_meta_enabled("page") || is_meta_enabled("archive")) {
                return true;
            }
            break;
    }

    return false;
}

function contains_page_templates($templates) {
    if (is_array($templates)) {
        foreach ($templates as $template) {
            if (is_page_template($template)) {
                return true;
            } elseif (!empty($templates)) {
                if (is_page_template($templates)) {
                    return true;
                }
            }
        }
    }

    return false;
}

?>