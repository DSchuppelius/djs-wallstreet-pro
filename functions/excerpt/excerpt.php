<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_max_content($content, $max_chars = 45) {
    $result = $content;
    $result = strip_all($result);
    $result = substr($result, 0, $max_chars);

    return $result;
}

function get_sidebar_excerpt() {
    return get_max_content(get_the_content(), 105) . "...";
}

function get_comment_sidebar($excerpt) {
    return get_max_content($excerpt, 105) . "...";
}

function get_home_blog_excerpt($length, $read) {
    $excerpt = get_the_excerpt();
    $excerpt = strip_all($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, $length);

    if ($original_len > $length) {
        $excerpt = $excerpt . get_the_read_more();
    }
    return $excerpt;
}

function get_post_blog_excerpt($length, $read) {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $excerpt = get_the_excerpt();
    $excerpt = strip_all($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, $length);

    if ($original_len > $length) {
        if ($current_setup->get("blog_template_read_more") != null) {
            $excerpt = $excerpt . get_the_read_more();
        }
    }
    return $excerpt;
}

function get_only_post_blog_excerpt($length) {
    $excerpt = get_the_excerpt();
    $excerpt = strip_all($excerpt);
    $excerpt = substr($excerpt, 0, $length);

    return $excerpt;
}

function portfolio_excerpt($limit, $post_id) {
    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    $output = get_the_excerpt();
    $post = $save_post;
    $excerpt = explode(" ", $output, $limit);

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . "...";
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace("`\[[^\]]*\]`", "", $excerpt);
    return $excerpt;
}
?>