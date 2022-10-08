<?php
/*
 * Created on   : Wed Jun 22 2022
 * Base Author  : Joe Yabuki, Harish Lodha
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : breadcrumbs.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function qt_custom_breadcrumbs() {
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $firstDelimiter = '<span class="first material-icons-outlined">home_work</span>';
    $delimiter = '<span class="material-icons-outlined">double_arrow</span>'; // delimiter between crumbs
    $home = esc_html__("Home", "djs-wallstreet-pro"); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li class="active">'; // tag before the current crumb
    $after = "</li>"; // tag after the current crumb

    global $post;
    $homeLink = esc_url(home_url());

    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo "<li>" . $firstDelimiter . '<a href="' . $homeLink . '">' . $home . "</a></li>";
        } else {
            echo "<li>" . $firstDelimiter . '<a href="' . $homeLink . '">' . $home . "</a>" . $delimiter . "</li>";
            echo $before . single_post_title() . $after;
        }
    } else {
        echo "<li>" . $firstDelimiter . '<a href="' . $homeLink . '">' . $home . "</a>" . $delimiter;
        if (is_category()) {
            $thisCat = get_category(get_query_var("cat"), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, $delimiter);
            }
            echo $before . esc_html__("Archive by category", "djs-wallstreet-pro") . ' "' . single_cat_title("", false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . esc_html__("Search results for", "djs-wallstreet-pro") . ': "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time("Y"))) . '">' . get_the_time("Y") . "</a>" . $delimiter;
            echo '<a href="' . esc_url(get_month_link(get_the_time("Y"), get_the_time("m"))) . '">' . get_the_time("F") . "</a>" . $delimiter;
            echo $before . get_the_time("d") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time("Y"))) . '">' . get_the_time("Y") . "</a>" . $delimiter;
            echo $before . get_the_time("F") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_year()) {
            echo $before . get_the_time("Y") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != "post") {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink . "/" . $slug["slug"]) . '/">' . $post_type->labels->singular_name . "</a>";
                if ($showCurrent == 1) {
                    echo $delimiter . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, $delimiter);
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != "post" && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if (!empty($post_type)) {
                echo $before . $post_type->labels->singular_name . $after;
            } else {
                echo $before . esc_html__("Archive", "djs-wallstreet-pro") . $after;
            }
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            if (!empty($cat)) {
                $cat = $cat[0];
                echo get_category_parents($cat, true, $delimiter);
            }
            echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . "</a>";
            if ($showCurrent == 1) {
                echo "&nbsp;(" . '<span class="material-icons-outlined">image</span>' . $before . get_the_title() . "&nbsp;)" . $after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = [];
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . "</a>" . $delimiter;
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) {
                    echo $delimiter;
                }
            }
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . esc_html__("Posts tagged", "djs-wallstreet-pro") . ': "' . single_tag_title("", false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . esc_html__("Articles posted by", "djs-wallstreet-pro") . " " . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . esc_html__("Error 404", "djs-wallstreet-pro") . $after;
        } elseif (is_archive()) {
            echo $before . esc_html__("Archive", "djs-wallstreet-pro") . '<span class="material-icons-outlined">archive</span>' . $after;
        } else {
            echo $before . esc_html__("Unknown", "djs-wallstreet-pro") . '<span class="material-icons-outlined">device_unknown</span>' . $after;
        }
        if (get_query_var("paged")) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo "";
            }
            echo " (" . esc_html__("Page", "djs-wallstreet-pro") . "&nbsp;" . get_query_var("paged") . ")";
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo "";
            }
        }
        echo "</li>";
    }
} ?>
