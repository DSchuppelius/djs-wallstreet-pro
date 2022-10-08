<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : menu-search.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$is_toggle_button = $current_setup->get("search_effect_style_setting") == "toogle" && $current_setup->get("enable_search_btn") == true;
if (!$is_toggle_button) {
    $menu_search_form =
        '<div class="search-box-outer dropdown">
            <a id="searchbar_menu" href="' . get_the_currentURL() . '#" title="' . esc_html__("Search", "djs-wallstreet-pro") . '" class="search-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa-solid fa-magnifying-glass"></i></a>
            <ul class="dropdown-menu pull-right search-panel ' . $current_setup->get("search_effect_style_setting") . '" role="menu" aria-hidden="true" aria-expanded="false">
                <li class="dropdown-item panel-outer">
                    <div class="form-container">
                        <form role="search" method="get" autocomplete="off" class="search-form" action="' . esc_url(home_url("/")) . '">
                            <label>
                                <input type="search" class="search-field" placeholder="' . esc_html__("Search", "djs-wallstreet-pro") . ' …" value="" name="s" required>
                            </label>
                            <button type="submit" class="btn search_btn" value="' . esc_html__("Search", "djs-wallstreet-pro") . '">' .
                                esc_html__("Search", "djs-wallstreet-pro") .
                            '</button>
                        </form>                   
                    </div>
                </li>
            </ul>
        </div>';
} else {
    $menu_search_form =
        '<div class="nav-search nav-light-search wrap">
            <div class="search-box-outer">
                <div id="top_searchmenu" class="dropdown">
                    <a id="searchbar_fullscreen_menu" href="' . get_the_currentURL() . '#searchbar_fullscreen" title="Search" class="nav-link search-iconaria-haspopup" true"="" aria-expanded="false">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>
            </div>
        </div>';
}

if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
    $shop_button = '<ul class="nav navbar-nav navbar-left">%3$s';
} else {
    $shop_button = '<ul class="nav navbar-nav navbar-right">%3$s';
}

if (class_exists("WooCommerce")) {
    if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
        $shop_button .= '</ul> <div class="header-module">';
    } else {
        $shop_button .= '<li> <div class="header-module">';
    }

    if ($is_toggle_button) {
        $shop_button .= $menu_search_form;
    } elseif (($current_setup->get("search_effect_style_setting") == "popup_light" || $current_setup->get("search_effect_style_setting") == "popup_dark") && $current_setup->get("enable_search_btn") == true) {
        $shop_button .= $menu_search_form;
    }

    $shop_button .= '<div class="cart-header ">';
    global $woocommerce;
    $link = esc_url(function_exists("wc_get_cart_url") ? wc_get_cart_url() : $woocommerce->cart->get_cart_url());

    $shop_button .= '<a class="cart-icon" href="' . $link . '" >';
    if ($woocommerce->cart->cart_contents_count == 0) {
        $shop_button .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
    } else {
        $shop_button .= '<i class="fa fa-cart-plus" aria-hidden="true"></i>';
    }
    $shop_button .= "</a>";

    $shop_button .=
        '<a class="cart-total" href="' . $link . '" >
            <span class="cart-total">' .
                sprintf(_n("%d item", "%d items", $woocommerce->cart->cart_contents_count, "djs-wallstreet-pro"), $woocommerce->cart->cart_contents_count) .
            '</span>
        </a>';

    if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
        $shop_button .= "</div>";
    }
} else {
    if ($is_toggle_button) {
        if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
            $shop_button .= '</ul><div class="header-module">';
        } else {
            $shop_button .= '<li><div class="header-module">';
        }

        $shop_button .= $menu_search_form . "</div>";
    } elseif (($current_setup->get("search_effect_style_setting") == "popup_light" || $current_setup->get("search_effect_style_setting") == "popup_dark") && $current_setup->get("enable_search_btn") == true) {
        if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
            $shop_button .= '</ul><div class="header-module">';
        } else {
            $shop_button .= '<li class="nav-item"><div class="header-module">';
        }

        $shop_button .= $menu_search_form . "</div>";
    }
}

if ($current_setup->get("header_presets_stlyle") == 4 || $current_setup->get("header_presets_stlyle") == 6) {
    $shop_button .= "</ul></div>";
} else {
    $shop_button .= "</ul>";
}
if ($current_setup->get("header_presets_stlyle") == 6) {
    wp_nav_menu([
        "theme_location" => "primary",
        "container" => "nav-collapse collapse navbar-inverse-collapse",
        "menu_class" => "nav navbar-nav navbar-left",
        "items_wrap" => $shop_button,
        "fallback_cb" => "theme_fallback_page_menu",
        "walker" => new Theme_Bootstrap_Walker_Nav_Menu(),
    ]);
} else {
    wp_nav_menu([
        "theme_location" => "primary",
        "container" => "nav-collapse collapse navbar-inverse-collapse",
        "menu_class" => "nav navbar-nav navbar-right",
        "items_wrap" => $shop_button,
        "fallback_cb" => "theme_fallback_page_menu",
        "walker" => new Theme_Bootstrap_Walker_Nav_Menu(),
    ]);
}
?>
