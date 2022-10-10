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
    global $post; $result = "";

    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $form_url = esc_url(get_permalink() . "#more-" . $post->ID);
    $more_text = empty($more) ? $current_setup->get("blog_template_read_more") : $more;

    if (get_option('permalink_structure') == "")
        $result = '<a href="' . $form_url . '" class="button btn more blog-btn">' . $more_text . "</a>";
    else
        $result = '<form action="' . $form_url . '" method="get"><button class="btn more blog-btn" type="submit">' . $more_text . "</button></form>";

    return $result;
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
        if (get_option('permalink_structure') == "") {
            $result =
                '<div class ="row">
                    <div class="show-all-btn">
                        <a href="' . esc_url($link) . '" ' . get_blank_target($target) . ' class="button btn big ' . $button_class . '">' . $text . '</a>
                    </div>
                </div>';
        } else {
            $result =
                '<div class ="row">
                    <div class="show-all-btn">
                        <form action="' . esc_url($link) . '" ' . get_blank_target($target) . ' method="get">
                            <button class="btn big ' . $button_class . '" type="submit" >' . $text . '</button>
                        </form>
                    </div>
                </div>';
        }
    }

    return $result;
}

function the_show_all($link, $text, $target = false, $button_class = "more blog") {
    echo get_the_show_all($link, $text, $target, $button_class);
}

// WordPress filter and action section
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
