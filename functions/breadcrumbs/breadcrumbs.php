<?php
/*
 * Created on   : Wed Jun 22 2022
 * Base Author  : Harish Lodha
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
    $home = __("Home", "wallstreet"); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li class="active">'; // tag before the current crumb
    $after = "</li>"; // tag after the current crumb

    global $post;
    $homeLink = home_url();

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
            echo $before . __("Archive by category", "wallstreet") . ' "' . single_cat_title("", false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . __("Search results for", "wallstreet") . ': "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time("Y")) . '">' . get_the_time("Y") . "</a>" . $delimiter;
            echo '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_time("F") . "</a>" . $delimiter;
            echo $before . get_the_time("d") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time("Y")) . '">' . get_the_time("Y") . "</a>" . $delimiter;
            echo $before . get_the_time("F") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_year()) {
            echo $before . get_the_time("Y") . '<span class="material-icons-outlined">calendar_today</span>' . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != "post") {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . "/" . $slug["slug"] . '/">' . $post_type->labels->singular_name . "</a>";
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
                echo $before . "Archiv" . $after;
            }
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            if (!empty($cat)) {
                $cat = $cat[0];
                echo get_category_parents($cat, true, $delimiter);
            }
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . "</a>";
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
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . "</a>" . $delimiter;
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
                echo $delimiter . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . __("Posts tagged", "wallstreet") . ': "' . single_tag_title("", false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . __("Articles posted by", "wallstreet") . " " . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . __("Error 404", "wallstreet") . $after;
        }
        if (get_query_var("paged")) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo "";
            }
            echo " ( " . __("Page", "wallstreet") . "&nbsp;" . get_query_var("paged") . " )";
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo "";
            }
        }
        echo "</li>";
    }
} ?>
