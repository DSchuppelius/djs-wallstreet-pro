<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : breadcrumbs.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Brotkruemelpfad. Die Logik sammelt zuerst eine Liste von Stationen und rendert sie
 * dann als gueltige <ol>-Liste (vorher entstanden verschachtelte <li> ohne <ul>).
 * Zusaetzlich wird schema.org/BreadcrumbList als Microdata ausgegeben.
 */

/**
 * @return array<int, array{label:string, url?:string, icon?:string}>
 */
function djs_breadcrumb_trail(): array {
    global $post;

    $trail = [[
        'label' => esc_html__('Home', 'djs-wallstreet-pro'),
        'url'   => home_url('/'),
        'icon'  => 'home_work',
    ]];

    $add_category_parents = static function ($cat_id) use (&$trail) {
        $ancestors = array_reverse(get_ancestors($cat_id, 'category'));
        $ancestors[] = $cat_id;
        foreach ($ancestors as $id) {
            $term = get_term($id, 'category');
            if ($term && !is_wp_error($term)) {
                $trail[] = ['label' => esc_html($term->name), 'url' => get_term_link($term)];
            }
        }
    };

    if (is_front_page()) {
        return $trail;
    }

    if (is_home()) {
        $trail[] = ['label' => esc_html(single_post_title('', false))];
    } elseif (is_category()) {
        $cat = get_queried_object();
        if ($cat->parent) {
            $add_category_parents($cat->parent);
        }
        $trail[] = ['label' => sprintf('%s "%s"', esc_html__('Archive by category', 'djs-wallstreet-pro'), esc_html(single_cat_title('', false)))];
    } elseif (is_search()) {
        $trail[] = ['label' => sprintf('%s: "%s"', esc_html__('Search results for', 'djs-wallstreet-pro'), esc_html(get_search_query()))];
    } elseif (is_day()) {
        $trail[] = ['label' => get_the_time('Y'), 'url' => get_year_link(get_the_time('Y'))];
        $trail[] = ['label' => get_the_time('F'), 'url' => get_month_link(get_the_time('Y'), get_the_time('m'))];
        $trail[] = ['label' => get_the_time('d'), 'icon' => 'calendar_today'];
    } elseif (is_month()) {
        $trail[] = ['label' => get_the_time('Y'), 'url' => get_year_link(get_the_time('Y'))];
        $trail[] = ['label' => get_the_time('F'), 'icon' => 'calendar_today'];
    } elseif (is_year()) {
        $trail[] = ['label' => get_the_time('Y'), 'icon' => 'calendar_today'];
    } elseif (is_attachment()) {
        $parent = $post ? get_post($post->post_parent) : null;
        if ($parent) {
            $cats = get_the_category($parent->ID);
            if (!empty($cats)) {
                $add_category_parents($cats[0]->term_id);
            }
            $trail[] = ['label' => esc_html(get_the_title($parent)), 'url' => get_permalink($parent)];
        }
        $trail[] = ['label' => esc_html(get_the_title()), 'icon' => 'image'];
    } elseif (is_single()) {
        if (get_post_type() !== 'post') {
            $post_type = get_post_type_object(get_post_type());
            if ($post_type) {
                $archive = get_post_type_archive_link($post_type->name);
                if (!$archive) {
                    $rewrite = $post_type->rewrite;
                    $slug    = is_array($rewrite) && !empty($rewrite['slug']) ? $rewrite['slug'] : $post_type->name;
                    $archive = home_url('/' . $slug . '/');
                }
                $trail[] = ['label' => esc_html($post_type->labels->singular_name), 'url' => $archive];
            }
        } else {
            $cats = get_the_category();
            if (!empty($cats)) {
                $add_category_parents($cats[0]->term_id);
            }
        }
        $trail[] = ['label' => esc_html(get_the_title())];
    } elseif (is_page()) {
        if ($post && $post->post_parent) {
            foreach (array_reverse(get_post_ancestors($post)) as $ancestor) {
                $trail[] = ['label' => esc_html(get_the_title($ancestor)), 'url' => get_permalink($ancestor)];
            }
        }
        $trail[] = ['label' => esc_html(get_the_title())];
    } elseif (is_tag()) {
        $trail[] = ['label' => sprintf('%s: "%s"', esc_html__('Posts tagged', 'djs-wallstreet-pro'), esc_html(single_tag_title('', false)))];
    } elseif (is_author()) {
        $author  = get_queried_object();
        $trail[] = ['label' => sprintf('%s %s', esc_html__('Articles posted by', 'djs-wallstreet-pro'), esc_html($author->display_name ?? ''))];
    } elseif (is_404()) {
        $trail[] = ['label' => esc_html__('Error 404', 'djs-wallstreet-pro')];
    } elseif (is_post_type_archive()) {
        $trail[] = ['label' => esc_html(post_type_archive_title('', false))];
    } elseif (is_archive()) {
        $trail[] = ['label' => esc_html__('Archive', 'djs-wallstreet-pro'), 'icon' => 'archive'];
    } else {
        $trail[] = ['label' => esc_html__('Unknown', 'djs-wallstreet-pro'), 'icon' => 'device_unknown'];
    }

    if (get_query_var('paged')) {
        $last = array_key_last($trail);
        $trail[$last]['label'] .= ' (' . esc_html__('Page', 'djs-wallstreet-pro') . '&nbsp;' . absint(get_query_var('paged')) . ')';
    }

    return apply_filters('djs_breadcrumb_trail', $trail);
}

function djs_breadcrumbs(): void {
    $trail = djs_breadcrumb_trail();
    if (count($trail) < 2) {
        return;
    }

    $last = array_key_last($trail);
    echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
    foreach ($trail as $i => $crumb) {
        $icon = !empty($crumb['icon']) ? '<span class="material-icons-outlined" aria-hidden="true">' . esc_html($crumb['icon']) . '</span>' : '';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        if (!empty($crumb['url']) && $i !== $last) {
            printf(
                '<a itemprop="item" href="%s">%s<span itemprop="name">%s</span></a>',
                esc_url($crumb['url']),
                $i === 0 ? $icon : '',
                $crumb['label']
            );
        } else {
            printf(
                '<span itemprop="name"%s>%s</span>%s',
                $i === $last ? ' aria-current="page"' : '',
                $crumb['label'],
                $i !== 0 ? $icon : ''
            );
        }
        printf('<meta itemprop="position" content="%d">', $i + 1);
        echo '</li>';
    }
    echo '</ol>';
}

/**
 * Alter Funktionsname - bleibt fuer Child-Themes/Plugins erhalten.
 */
function qt_custom_breadcrumbs() {
    djs_breadcrumbs();
}
