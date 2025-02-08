<?php
function theme_widgets_init() {
    register_sidebar([
        "name" => esc_html__("Sidebar widget area", "djs-wallstreet-pro"),
        "id" => "sidebar_primary",
        "description" => esc_html__("Sidebar widget area", "djs-wallstreet-pro"),
        "before_widget" => '<div class="sidebar-widget" >',
        "after_widget" => "</div>",
        "before_title" => '<div class="sidebar-widget-title"><h1>',
        "after_title" => "</h1></div>",
    ]);

    register_sidebar([
        "name" => esc_html__("Footer widget area", "djs-wallstreet-pro"),
        "id" => "footer-widget-area",
        "description" => esc_html__("Footer widget area", "djs-wallstreet-pro"),
        "before_widget" => '<div class="col-md-3 col-sm-6 footer_widget_column">',
        "after_widget" => "</div>",
        "before_title" => '<h1 class="footer_widget_title">',
        "after_title" => "</h1>",
    ]);

    register_sidebar([
        "name" => esc_html__("WooCommerce sidebar widget area", "djs-wallstreet-pro"),
        "id" => "woocommerce",
        "description" => esc_html__("WooCommerce sidebar widget area", "djs-wallstreet-pro"),
        "before_widget" => '<div class="sidebar-widget" >',
        "after_widget" => "</div>",
        "before_title" => '<h1 class="widget-title">',
        "after_title" => "</h1>",
    ]);
}
add_action("widgets_init", "theme_widgets_init");
?>