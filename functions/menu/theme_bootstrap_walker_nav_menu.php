<?php
/*
 * Created on   : Wed Jun 22 2022
 * Base Author  : johnmegahan
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_bootstrap_walker_nav_menu.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class Theme_Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = []) {
        $output .= "\n" . str_repeat("    ", $depth) . '<ul class="dropdown-menu">' . "\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $indent = $depth ? str_repeat("    ", $depth) : "";

        $class_names = "";

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = "menu-item-" . $item->ID;
        if ($args->has_children && $depth > 0) {
            $classes[] = "dropdown-submenu";
        } elseif ($args->has_children && $depth === 0) {
            $classes[] = "dropdown";
        }
        $class_names = join(" ", apply_filters("nav_menu_css_class", array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : "";

        $id = apply_filters("nav_menu_item_id", "menu-item-" . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : "";

        $output .= $indent . "<li" . $id . $class_names . ">";

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : "";
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : "";
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : "";
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : "";
        $attributes .= $args->has_children ? ' data-toggle="dropdown" class="dropdown-toggle"' : "";

        $item_output = $args->before;
        $item_output .= "<a" . $attributes . ">";
        $item_output .= $args->link_before . apply_filters("the_title", $item->title, $item->ID) . $args->link_after;
        if ($args->has_children && $depth > 0) {
            $item_output .= $args->has_children ? '<b class="glyphicon glyphicon-menu-right"></b></a>' : "</a>";
        } else {
            $item_output .= $args->has_children ? '<b class="glyphicon glyphicon-menu-down"></b></a>' : "</a>";
        }
        $item_output .= $args->after;

        $output .= apply_filters("walker_nav_menu_start_el", $item_output, $item, $depth, $args);
    }

    function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        if (!$element || !is_numeric($depth) || !is_numeric($max_depth)) {
            return;
        }

        $id_field = $this->db_fields["id"];

        if (is_array($args[0])) {
            $args[0]["has_children"] = !empty($children_elements[$element->$id_field]);
        } elseif (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        call_user_func_array([$this, "start_el"], array_merge([&$output, $element, $depth], $args));

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
                    call_user_func_array([$this, "start_lvl"], array_merge([&$output, $depth], $args));
                }

                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);

            if (isset($newlevel) && $newlevel) {
                call_user_func_array([$this, "end_lvl"], array_merge([&$output, $depth], $args));
            }
        }
        call_user_func_array([$this, "end_el"], array_merge([&$output, $element, $depth], $args));
    }
}
function theme_nav_menu_css_class($classes) {
    if (in_array("current-menu-item", $classes) or in_array("current-menu-ancestor", $classes)) {
        $classes[] = "active";
    }

    return $classes;
}
add_filter("nav_menu_css_class", "theme_nav_menu_css_class");