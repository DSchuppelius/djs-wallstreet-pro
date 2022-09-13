<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_sidebar_excerpt() {
    global $post;
    $excerpt = get_the_content();
    $excerpt = preg_replace(" (\[.*?\])", "", $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, 45);
    $len = strlen($excerpt);
    if ($original_len > 45) {
        $excerpt = $excerpt;
    }
    return $excerpt;
}

function get_comment_sidebar($excerpt) {
    $excerpt = $excerpt;
    $excerpt = preg_replace(" (\[.*?\])", "", $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, 45);
    return $excerpt;
}

function get_home_blog_excerpt($length, $read) {
    global $post;
    $excerpt = get_the_content();
    $excerpt = strip_tags(preg_replace(" (\[.*?\])", "", $excerpt));
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, $length);
    $len = strlen($excerpt);
    if ($original_len > $length) {
        $excerpt = $excerpt . '<div class="blog-btn-col"><form action"' . get_the_permalink() . '"><button class="btn more" type="submit">' . __($read, "wallstreet") . "</button></form></div>";
    }
    return $excerpt;
}

function get_post_blog_excerpt($length, $read) {
    $current_options = get_current_options();
    global $post;
    $excerpt = get_the_excerpt();
    $excerpt = strip_tags(preg_replace(" (\[.*?\])", "", $excerpt));
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, $length);
    $len = strlen($excerpt);

    if ($original_len > $length) {
        if ($current_options["blog_template_read_more"] != null) {
            $excerpt = $excerpt . '<div class="blog-btn-col"><form action"' . get_the_permalink() . '"><button class="btn more" type="submit" >' . __($read, "wallstreet") . "</button></form></div>";
        } else {
            $excerpt = $excerpt;
        }
    }
    return $excerpt;
}

function get_only_post_blog_excerpt($length) {
    global $post;
    $excerpt = get_the_excerpt();
    $excerpt = strip_tags(preg_replace(" (\[.*?\])", "", $excerpt));
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
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
