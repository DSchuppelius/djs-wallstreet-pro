<?php
/*
 * Created on   : Wed Sep 21 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// Read more tag to formatting in blog page
function form_more_button($more = "") {
    global $post;
    $current_options = get_current_options();
    $more_text = empty($more) ? $current_options["blog_template_read_more"] : $more;
    return '<form action="' . get_permalink() . "#more-" . $post->ID . '"><button class="btn more blog-btn" type="submit">' . $more_text . "</button></form>";
}

function get_the_read_more($class = 'blog-btn-col') {
    return '<div class="' . $class . '">' . form_more_button() . '</div>';
}

function the_read_more($class = 'blog-btn-col') {
    echo get_the_read_more($class);
}

function get_the_show_all($link, $text, $target = false, $button_class = "more blog") {
    $result = "";

    if(!empty($text) && !empty($link)) {
        $action = 'action="' . $link . '" ' . get_blank_target($target, 'method="get"');
        $result =
            '<div class ="row">
                <div class="show-all-btn">
                    <form ' . $action . '>
                        <button class="btn big ' . $button_class . '" type="submit" >' . $text . '</button>
                    </form>
                </div>
            </div>';
    }

    return $result;
}

function the_show_all($link, $text, $target = false, $button_class = "more blog") {
    echo get_the_show_all($link, $text, $target, $button_class);
}

// Wordpress filter and action section
function new_content_more($more) {
    return form_more_button();
}
add_filter("the_content_more_link", "new_content_more");

function content_width() {
    global $content_width;
    if (is_page_template("template/blog-fullwidth.php")) {
        $content_width = 950;
    }
}
add_action("template_redirect", "content_width");
?>