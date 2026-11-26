<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : nav_walker.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Hauptmenue ohne Bootstrap/jQuery:
 *  - Eltern mit Ziel-URL: Link + eigener Aufklapp-Button
 *  - Eltern ohne Ziel (leer oder "#"): der Eintrag selbst ist der Aufklapp-Button
 *  - aria-expanded/aria-controls fuer Screenreader, aria-current fuer die aktive Seite
 * Das Verhalten (Hover/Fokus am Desktop, Akkordeon mobil) steckt in assets/js/theme.js.
 */

/**
 * Pfeil-Icon als Inline-SVG - unabhaengig davon, ob eine Icon-Schrift geladen ist.
 */
function djs_menu_chevron(): string {
    return '<svg class="site-menu__chevron" viewBox="0 0 20 20" width="14" height="14" aria-hidden="true" focusable="false"><path d="M5.5 7.5 10 12l4.5-4.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

class DJS_Walker_Nav_Menu extends Walker_Nav_Menu {
    /** ID des Untermenues, das der naechste start_lvl() oeffnet. */
    private string $pending_submenu_id = '';

    public function start_lvl(&$output, $depth = 0, $args = null) {
        $id = $this->pending_submenu_id !== '' ? ' id="' . esc_attr($this->pending_submenu_id) . '"' : '';
        $output .= '<ul class="sub-menu"' . $id . '>';
        $this->pending_submenu_id = '';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $item    = $data_object;
        $args    = (object) $args;
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        $has_children = in_array('menu-item-has-children', $classes, true);
        $is_current   = in_array('current-menu-item', $classes, true);
        $is_ancestor  = (bool) array_intersect(['current-menu-ancestor', 'current-menu-parent', 'current_page_ancestor'], $classes);

        $classes[] = 'menu-item-' . $item->ID;
        if ($is_current || $is_ancestor) {
            $classes[] = 'active';
        }

        $args        = apply_filters('nav_menu_item_args', $args, $item, $depth);
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $li_id       = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);

        $output .= '<li' . ($li_id ? ' id="' . esc_attr($li_id) . '"' : '') . ' class="' . esc_attr($class_names) . '">';

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $url            = trim((string) $item->url);
        $is_placeholder = $url === '' || $url === '#';
        $submenu_id     = 'sub-menu-' . $item->ID;

        if ($has_children) {
            $this->pending_submenu_id = $submenu_id;
        }

        $item_output = $args->before ?? '';

        if ($has_children && $is_placeholder) {
            // Reiner Gruppen-Eintrag ("Toolsbox") - kein Ziel, also ein echter Button.
            $item_output .= sprintf(
                '<button type="button" class="site-menu__link site-menu__parent" aria-expanded="false" aria-controls="%s">%s%s%s%s</button>',
                esc_attr($submenu_id),
                $args->link_before ?? '',
                $title,
                $args->link_after ?? '',
                djs_menu_chevron()
            );
        } else {
            $atts = [
                'title'        => !empty($item->attr_title) ? $item->attr_title : '',
                'target'       => !empty($item->target) ? $item->target : '',
                'rel'          => !empty($item->xfn) ? $item->xfn : '',
                'href'         => $is_placeholder ? '' : $url,
                'aria-current' => $is_current ? 'page' : '',
                'class'        => 'site-menu__link',
            ];
            if ($atts['target'] === '_blank' && strpos($atts['rel'], 'noopener') === false) {
                $atts['rel'] = trim($atts['rel'] . ' noopener');
            }
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (is_scalar($value) && $value !== '' && $value !== false) {
                    $value       = $attr === 'href' ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $link = '<a' . $attributes . '>' . ($args->link_before ?? '') . $title . ($args->link_after ?? '') . '</a>';

            if ($has_children) {
                $item_output .= sprintf(
                    '<span class="site-menu__row">%s<button type="button" class="site-menu__toggle" aria-expanded="false" aria-controls="%s"><span class="screen-reader-text">%s</span>%s</button></span>',
                    $link,
                    esc_attr($submenu_id),
                    /* translators: %s: menu item title */
                    esc_html(sprintf(__('Submenu: %s', 'djs-wallstreet-pro'), wp_strip_all_tags($title))),
                    djs_menu_chevron()
                );
            } else {
                $item_output .= $link;
            }
        }

        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

/**
 * Fallback, solange im Backend kein Menue zugewiesen ist: Seitenliste im selben Markup.
 */
class DJS_Walker_Page extends Walker_Page {
    public function start_lvl(&$output, $depth = 0, $args = []) {
        $output .= '<ul class="sub-menu">';
    }

    public function end_lvl(&$output, $depth = 0, $args = []) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0) {
        $page      = $data_object;
        $css_class = ['menu-item', 'page_item', 'page-item-' . $page->ID];
        $current   = false;

        if (!empty($current_object_id)) {
            $current_page = get_post($current_object_id);
            if ($current_page && in_array($page->ID, $current_page->ancestors, true)) {
                $css_class[] = 'current_page_ancestor';
                $css_class[] = 'active';
            }
            if ($page->ID == $current_object_id) {
                $css_class[] = 'current_page_item';
                $css_class[] = 'active';
                $current     = true;
            }
        }

        $has_children = isset($args['pages_with_children'][$page->ID]);
        if ($has_children) {
            $css_class[] = 'menu-item-has-children';
        }

        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page, $depth, $args, $current_object_id));
        $title     = apply_filters('the_title', $page->post_title, $page->ID);
        $link      = sprintf(
            '<a class="site-menu__link" href="%s"%s>%s</a>',
            esc_url(get_permalink($page->ID)),
            $current ? ' aria-current="page"' : '',
            esc_html(wp_strip_all_tags($title))
        );

        $output .= '<li class="' . esc_attr($css_class) . '">';
        if ($has_children) {
            $output .= sprintf(
                '<span class="site-menu__row">%s<button type="button" class="site-menu__toggle" aria-expanded="false"><span class="screen-reader-text">%s</span>%s</button></span>',
                $link,
                esc_html(sprintf(__('Submenu: %s', 'djs-wallstreet-pro'), wp_strip_all_tags($title))),
                djs_menu_chevron()
            );
        } else {
            $output .= $link;
        }
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = []) {
        $output .= '</li>';
    }
}

/**
 * fallback_cb des Hauptmenues (Name bleibt fuer Kompatibilitaet erhalten).
 */
function theme_fallback_page_menu($args = []) {
    $args = wp_parse_args($args, [
        'menu_class' => 'site-menu',
        'menu_id'    => 'primary-menu',
        'echo'       => true,
    ]);

    $items = '';

    // Startseite als erster Eintrag
    $home_current = is_front_page() && !is_paged();
    $items .= sprintf(
        '<li class="menu-item%s"><a class="site-menu__link" href="%s"%s>%s</a></li>',
        $home_current ? ' active' : '',
        esc_url(home_url('/')),
        $home_current ? ' aria-current="page"' : '',
        esc_html__('Home', 'djs-wallstreet-pro')
    );

    $exclude = get_option('show_on_front') === 'page' ? (string) get_option('page_on_front') : '';

    $items .= wp_list_pages([
        'echo'        => false,
        'title_li'    => '',
        'sort_column' => 'menu_order, post_title',
        'exclude'     => $exclude,
        'walker'      => new DJS_Walker_Page(),
    ]);

    $menu = sprintf('<ul id="%s" class="%s">%s</ul>', esc_attr($args['menu_id']), esc_attr($args['menu_class']), $items);

    if (!empty($args['echo'])) {
        echo $menu;
        return null;
    }
    return $menu;
}

// Alte Klassennamen bleiben ansprechbar (Child-Themes, Fremdcode).
if (!class_exists('Theme_Bootstrap_Walker_Nav_Menu')) {
    class_alias('DJS_Walker_Nav_Menu', 'Theme_Bootstrap_Walker_Nav_Menu');
}
if (!class_exists('Theme_Bootstrap_Walker_Page')) {
    class_alias('DJS_Walker_Page', 'Theme_Bootstrap_Walker_Page');
}
