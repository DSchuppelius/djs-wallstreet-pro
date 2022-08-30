<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : get_template_parts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_template_parts($templates, $with_header = false, $with_footer = false) {
    if ($with_header) {
        get_header();
    }

    if (isset($templates)) {
        if (is_array($templates)) {
            foreach ($templates as $template) {
                $template_values = null;
                $break_me = false;
                if (is_array($template)) {
                    $template_values = get_template_part_values($template);
                } else {
                    $template_values = get_template_part_values($templates);
                    $break_me = true;
                }

                if (!empty($template_values)) {
                    get_template_part($template_values["slug"], $template_values["name"]);
                }
                if ($break_me) {
                    break;
                }
            }
        } else {
            get_template_part($templates);
        }
    }

    if ($with_footer) {
        get_footer();
    }
}

function get_named_template_parts($template, $names, $with_header = false, $with_footer = false) {
    if ($with_header) {
        get_header();
    }

    if (!empty($template) && is_array($names)) {
        foreach ($names as $name) {
            get_template_part($template, $name);
        }
    }

    if ($with_footer) {
        get_footer();
    }
}

function get_template_part_values($template_array) {
    if (is_array($template_array)) {
        if (array_key_exists("slug", $template_array) && array_key_exists("name", $template_array) && !empty($template_array["slug"])) {
            return [
                "slug" => $template_array["slug"],
                "name" => $template_array["name"],
            ];
        } elseif (array_key_exists("slug", $template_array) && !empty($template_array["slug"])) {
            return ["slug" => $template_array["slug"], "name" => null];
        } elseif (count($template_array) >= 2 && !empty($template_array[0])) {
            return ["slug" => $template_array[0], "name" => $template_array[1]];
        } elseif (!empty($template_array[0])) {
            return ["slug" => $template_array[0], "name" => null];
        }
    } elseif (!empty($template_array)) {
        return ["slug" => $template_array, "name" => null];
    }
    return null;
}
?>
