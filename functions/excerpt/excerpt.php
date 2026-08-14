<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
// Durchgaengig mb_substr()/mb_strlen(): substr() und strlen() rechnen in Bytes und
// zerschneiden damit Umlaute (aus "ä" wird ein kaputtes Zeichen), ausserdem war der
// Laengenvergleich fuer den Read-More-Link durch die Byte-Zaehlung systematisch falsch.
function get_max_content($content, $max_chars = 45) {
    $result = $content;
    $result = strip_all($result);
    $result = mb_substr($result, 0, $max_chars);

    return $result;
}

function get_sidebar_excerpt() {
    return get_max_content(get_the_content(), 105) . "...";
}

function get_comment_sidebar($excerpt) {
    return get_max_content($excerpt, 105) . "...";
}

function get_post_blog_excerpt($length, $read) {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $excerpt = get_the_excerpt();
    $excerpt = strip_all($excerpt);
    $original_len = mb_strlen($excerpt);
    $excerpt = mb_substr($excerpt, 0, $length);

    if ($original_len > $length) {
        if ($current_setup->get("blog_template_read_more") != null) {
            $excerpt = $excerpt . get_the_read_more();
        }
    }
    return $excerpt;
}

// get_only_post_blog_excerpt() entfernt: ebenfalls nirgends aufgerufen.

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
