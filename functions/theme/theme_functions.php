<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_functions.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_values_on_current_option($option, $positive, $negative = "", $prefix = "", $suffix = "") {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    $wert = $current_setup->get($option);
    return !empty($wert) ? $prefix . $positive . $suffix : null;
}

function values_on_current_option($option, $positive, $negative = "", $prefix = "", $suffix = "") {
    echo get_values_on_current_option($option, $positive, $negative, $prefix, $suffix);
}

function get_blank_target($option, $prefix = null) {
    $result = 'target="';
    if ($option) {
        $result .= '_blank"';
    } else {
        $result .= '_self"';
    }
    return !empty($prefix) ? $prefix . " " . $result : $result;
}

function blank_target($option, $prefix = null) {
    echo get_blank_target($option, $prefix);
}

function is_noframe_with_bigborder() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    if (!$current_setup->get("addframe") && $current_setup->get("bigborder")) {
        return true;
    }

    return false;
}

function is_meta_enabled($zone = "all") {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $pages = ["page.php", "template/page-full-width.php"];
    $pages_dateless = ["template/page-full-width-dateless.php", "template/page-full-width-no-meta.php", "template/about-us.php"];
    // OFFENER PUNKT (Verhalten bewusst unveraendert):
    // is_page_template("search.php") kann nie true werden - search.php ist ein Template
    // der Hierarchie, kein Seiten-Template mit "Template Name"-Header. Die Zone "archive"
    // liefert dadurch nie true. Gemeint war vermutlich is_search() bzw. is_archive(); das
    // zu aendern wuerde aber die Meta-Anzeige auf Such- und Archivseiten umstellen, und
    // welcher Zustand beabsichtigt war, geht aus dem Code nicht hervor.
    // Nebenbefund: array_push() erzeugt hier ein verschachteltes Array ([[..],[..],[..]]),
    // contains_page_templates() reicht die inneren Arrays anschliessend an
    // is_page_template() weiter, das einen String erwartet.
    $archives = ["search.php"];
    $combined = [];
    array_push($combined, $pages, $archives, $pages_dateless);

    switch ($zone) {
        case "blog":
            if (!contains_page_templates($combined) && $current_setup->get("blog_meta_section_settings") == false) {
                return true;
            }
            break;
        case "page":
            if (is_meta_enabled("page_dateless") || is_meta_enabled("page_date")) {
                return true;
            }
            break;
        case "archive":
            if (contains_page_templates($archives) && $current_setup->get("archive_page_meta_section_settings") == false) {
                return true;
            }
            break;
        case "page_date":
            if (contains_page_templates($pages) && $current_setup->get("page_meta_section_settings") == false) {
                return true;
            }
            break;
        case "page_dateless":
            if (contains_page_templates($pages_dateless) && $current_setup->get("page_meta_section_settings") == false) {
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

function is_loaded_template($my_template) {
    global $template;
    return basename($template) === $my_template;
}

function is_denied_specialtemplate() {
    return !defined("DJS_POSTTYPE_PLUGIN") && str_contains(get_page_template_slug(), "template-specials");
}

function show_rellax_div() {
    global $loaded_banner;

    if (!is_404() && $loaded_banner && !is_denied_specialtemplate())
        return true;

    return false;
}
