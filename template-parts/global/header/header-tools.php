<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-tools.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Werkzeugleiste im Header: Suche, Warenkorb, Darstellung (Schriftgroesse, Farbschema)
 * und der Menue-Button fuer kleine Bildschirme.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$search_mode   = djs_header_search_mode(); ?>

<div class="site-header__tools">
    <?php if ($search_mode === "overlay") { ?>
        <button type="button" class="btn btn-ghost btn-circle" data-search-open aria-haspopup="dialog" aria-controls="site-search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></span>
        </button>
    <?php } elseif ($search_mode === "dropdown") {
        $panel_theme = $current_setup->get("search_effect_style_setting") === "popup_light" ? "wallstreet-light" : "wallstreet-dark"; ?>
        <details class="dropdown dropdown-end site-popover" data-popover>
            <summary class="btn btn-ghost btn-circle">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                <span class="screen-reader-text"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></span>
            </summary>
            <div class="dropdown-content site-popover__panel site-popover__panel--search" data-theme="<?php echo esc_attr($panel_theme); ?>">
                <?php get_search_form(["aria_label" => __("Search", "djs-wallstreet-pro")]); ?>
            </div>
        </details>
    <?php } ?>

    <?php if (class_exists("WooCommerce") && function_exists("WC") && WC()->cart) {
        $count = WC()->cart->get_cart_contents_count(); ?>
        <a class="btn btn-ghost btn-circle site-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
            <span class="indicator">
                <i class="fa-solid <?php echo $count ? "fa-cart-plus" : "fa-cart-shopping"; ?>" aria-hidden="true"></i>
                <span class="indicator-item badge badge-primary badge-xs djs-cart-count<?php echo $count ? "" : " hidden"; ?>"><?php echo absint($count); ?></span>
            </span>
            <span class="screen-reader-text"><?php echo esc_html(sprintf(_n("%d item", "%d items", $count, "djs-wallstreet-pro"), $count)); ?></span>
        </a>
    <?php } ?>

    <?php get_template_part("template-parts/global/header/navbar", "button"); ?>

    <button type="button" class="btn btn-ghost site-header__toggle" data-nav-toggle aria-controls="site-navigation" aria-expanded="false">
        <span class="site-header__burger" aria-hidden="true"><span></span></span>
        <span class="site-header__toggle-label"><?php esc_html_e("Menu", "djs-wallstreet-pro"); ?></span>
    </button>
</div>
