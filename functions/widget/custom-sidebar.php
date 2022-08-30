<?php
function theme_widgets_init() {
    register_sidebar([
        "name" => __("Sidebar widget area", "wallstreet"),
        "id" => "sidebar_primary",
        "description" => __("Sidebar widget area", "wallstreet"),
        "before_widget" => '<div class="sidebar-widget" >',
        "after_widget" => "</div>",
        "before_title" => '<div class="sidebar-widget-title"><h2>',
        "after_title" => "</h2></div>",
    ]);

    register_sidebar([
        "name" => __("Footer widget area", "wallstreet"),
        "id" => "footer-widget-area",
        "description" => __("Footer widget area", "wallstreet"),
        "before_widget" => '<div class="col-md-3 col-sm-6 footer_widget_column">',
        "after_widget" => "</div>",
        "before_title" => '<h2 class="footer_widget_title">',
        "after_title" => "</h2>",
    ]);

    register_sidebar([
        "name" => __("WooCommerce sidebar widget area", "wallstreet"),
        "id" => "woocommerce",
        "description" => __("WooCommerce sidebar widget area", "wallstreet"),
        "before_widget" => '<div class="sidebar-widget" >',
        "after_widget" => "</div>",
        "before_title" => '<h3 class="widget-title">',
        "after_title" => "</h3>",
    ]);
}
add_action("widgets_init", "theme_widgets_init");
?>
