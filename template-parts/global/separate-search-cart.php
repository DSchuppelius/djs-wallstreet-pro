<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : separate-search-cart.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $woocommerce;

$current_options = get_current_options();

$menu_search_form =
    '<a href="' . get_the_currentURL() . '#" title="' .
    __("Search", "wallstreet") .
    '" class="search-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></a>
    <ul class="dropdown-menu pull-right search-panel" role="menu" aria-hidden="true" aria-expanded="false">
        <li class="dropdown-item panel-outer">
            <div class="form-container">
                <form role="search" method="get" class="search-form" action="' . esc_url(home_url("/")) . '">
                    <label>
                        <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                    </label>
                    <button type="submit" class="btn search_btn search-submit" value="' . __("Search", "wallstreet") . '">' . __("Search", "wallstreet") . '</button>
                </form>                   
            </div>
        </li>
    </ul>';
$shop_button = "";

if (class_exists("WooCommerce")) {
    if ($current_options["search_effect_style_setting"] == "toogle") {
        $shop_button .= '<div class="header-module">';
        if ($current_options["enable_search_btn"] == true) {
            $shop_button .= '<div class="search-box-outer dropdown menu-item">' . $menu_search_form . "</div>";
        }
        $shop_button .= '<div class="cart-header ">';
        $link = function_exists("wc_get_cart_url") ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();

        $shop_button .= '<a class="cart-icon" href="' . $link . '" >';
        if ($woocommerce->cart->cart_contents_count == 0) {
            $shop_button .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
        } else {
            $shop_button .= '<i class="fa fa-cart-plus" aria-hidden="true"></i>';
        }
        $shop_button .= "</a>";

        $shop_button .=
            '<a href="' .
            $link .
            '" class="cart-total"><span class="cart-total">
            ' .
            sprintf(_n("%d item", $woocommerce->cart->cart_contents_count, "wallstreet"), $woocommerce->cart->cart_contents_count) .
            "</span></a>";
        $shop_button .= "</div></div>";
    } elseif ($current_options["search_effect_style_setting"] == "popup_light" || $current_options["search_effect_style_setting"] == "popup_dark") {
        $shop_button .= '<div class="header-module">';
        if ($current_options["enable_search_btn"] == true) {
            $shop_button .= '<div class="nav-search nav-light-search wrap">
                <div class="search-box-outer">
                    <div class="dropdown">
                        <a id="searchbar_fullscreen_menu" href="' . get_the_currentURL() . '#searchbar_fullscreen" class="nav-link search-iconaria-haspopup=" true"="" aria-expanded="false"><i class="fa fa-search"></i></a>
                    </div>
                </div></div>';
        }
        $shop_button .= '<div class="cart-header ">';

        $link = function_exists("wc_get_cart_url") ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
        $shop_button .= '<a class="cart-icon" href="' . $link . '" >';

        if ($woocommerce->cart->cart_contents_count == 0) {
            $shop_button .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
        } else {
            $shop_button .= '<i class="fa fa-cart-plus" aria-hidden="true"></i>';
        }

        $shop_button .= "</a>";

        $shop_button .=
            '<a href="' .
            $link .
            '" class="cart-total"><span class="cart-total">
            ' .
            sprintf(_n("%d item", $woocommerce->cart->cart_contents_count, "wallstreet"), $woocommerce->cart->cart_contents_count) .
            "</span></a>";
        $shop_button .= "</div></div>";
    }
} else {
    if ($current_options["search_effect_style_setting"] == "toogle" && $current_options["enable_search_btn"] == true) {
        $shop_button .= '<div class="header-module"><div class="search-box-outer dropdown">' . $menu_search_form . "</div></div></div>";
    } elseif (($current_options["search_effect_style_setting"] == "popup_light" || $current_options["search_effect_style_setting"] == "popup_dark") && $current_options["enable_search_btn"] == true) {
        $shop_button .= '<div class="header-module">
            <div class="nav-search nav-light-search wrap">
                <div class="search-box-outer">
                    <div class="dropdown">
                        <a id="searchbar_fullscreen_menu" href="' . get_the_currentURL() . '#searchbar_fullscreen" class="nav-link search-iconaria-haspopup=" true"="" aria-expanded="false"><i class="fa fa-search"></i></a>
                    </div>
                </div>
            </div></div>';
    }
}
echo $shop_button;
?>
