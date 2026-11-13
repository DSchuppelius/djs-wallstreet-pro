<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom-sidebar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Widget-Bereiche. Titel sind <h2> statt <h1> (eine Seite hat genau eine h1),
 * Spalten entstehen per CSS Grid statt ueber Bootstrap-Klassen.
 */
function theme_widgets_init() {
    register_sidebar([
        "name"          => esc_html__("Sidebar widget area", "djs-wallstreet-pro"),
        "id"            => "sidebar_primary",
        "description"   => esc_html__("Sidebar widget area", "djs-wallstreet-pro"),
        "before_widget" => '<section id="%1$s" class="widget sidebar-widget %2$s">',
        "after_widget"  => "</section>",
        "before_title"  => '<div class="sidebar-widget-title"><h2 class="widget-title">',
        "after_title"   => "</h2></div>",
    ]);

    register_sidebar([
        "name"          => esc_html__("Footer widget area", "djs-wallstreet-pro"),
        "id"            => "footer-widget-area",
        "description"   => esc_html__("Footer widget area", "djs-wallstreet-pro"),
        "before_widget" => '<section id="%1$s" class="widget footer_widget_column %2$s">',
        "after_widget"  => "</section>",
        "before_title"  => '<h2 class="footer_widget_title widget-title">',
        "after_title"   => "</h2>",
    ]);

    register_sidebar([
        "name"          => esc_html__("WooCommerce sidebar widget area", "djs-wallstreet-pro"),
        "id"            => "woocommerce",
        "description"   => esc_html__("WooCommerce sidebar widget area", "djs-wallstreet-pro"),
        "before_widget" => '<section id="%1$s" class="widget sidebar-widget %2$s">',
        "after_widget"  => "</section>",
        "before_title"  => '<h2 class="widget-title">',
        "after_title"   => "</h2>",
    ]);
}
add_action("widgets_init", "theme_widgets_init");
