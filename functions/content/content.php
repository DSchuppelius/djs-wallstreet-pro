<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Weiterlesen-/Alle-anzeigen-Buttons. Frueher GET-Formulare (dabei ging der Anker
 * #more-ID verloren, und Screenreader meldeten ein Formular) - jetzt echte Links.
 */

function form_more_button($more = "") {
    global $post;
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $more_text     = empty($more) ? $current_setup->get("blog_template_read_more") : $more;
    $url           = get_permalink() . "#more-" . $post->ID;
    $label         = sprintf(
        /* translators: 1: button text, 2: post title */
        __('%1$s: %2$s', "djs-wallstreet-pro"),
        wp_strip_all_tags($more_text),
        wp_strip_all_tags(get_the_title())
    );

    return sprintf(
        '<a href="%s" class="btn btn-primary btn-sm more blog-btn" aria-label="%s">%s<span class="material-icons" aria-hidden="true">read_more</span></a>',
        esc_url($url),
        esc_attr($label),
        esc_html($more_text)
    );
}

function get_the_read_more($class = "blog-btn-col") {
    return '<div class="' . esc_attr($class) . '">' . form_more_button() . "</div>";
}

function the_read_more($class = "blog-btn-col") {
    echo get_the_read_more($class);
}

function get_the_show_all($link, $text, $target = false, $button_class = "more blog") {
    if (empty($text) || empty($link)) {
        return "";
    }
    return sprintf(
        '<div class="show-all-btn"><a href="%s" %s class="btn btn-primary btn-wide %s">%s</a></div>',
        esc_url($link),
        get_blank_target($target) . ($target ? ' rel="noopener"' : ""),
        esc_attr($button_class),
        esc_html($text)
    );
}

function the_show_all($link, $text, $target = false, $button_class = "more blog") {
    echo get_the_show_all($link, $text, $target, $button_class);
}

// Der Weiterlesen-Link aus <!--more--> bekommt denselben Button.
function new_content_more($more) {
    return '<span class="blog-btn-col">' . form_more_button() . "</span>";
}
add_filter("the_content_more_link", "new_content_more");

function content_width() {
    global $content_width;
    if (is_page_template("template-blog/blog-fullwidth.php")) {
        $content_width = 950;
    }
}
add_action("template_redirect", "content_width");

/**
 * Akismet-Datenschutzhinweis wie bisher im Rahmen des Kommentarformulars (unter dem Senden-Knopf)
 * statt lose dahinter: Akismet haengt ihn an "comment_form_after", das Theme setzt ihn in das
 * Formular ("comment_form"). So wandert er auch beim Antworten mit dem Formular mit.
 */
add_action("comment_form_before", static function () {
    $callback = ["Akismet", "display_comment_form_privacy_notice"];
    if (class_exists("Akismet") && has_action("comment_form_after", $callback) !== false) {
        remove_action("comment_form_after", $callback);
        add_action("comment_form", static fn() => Akismet::display_comment_form_privacy_notice());
    }
});
