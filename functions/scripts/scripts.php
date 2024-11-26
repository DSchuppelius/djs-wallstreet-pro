<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : scripts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function theme_bootstrap_scripts() {
    wp_enqueue_style("bootstrap",                   THEME_ASSETS_PATH_URI . "/bootstrap/css/bootstrap.min.css");
    wp_enqueue_script("bootstrap",                  THEME_ASSETS_PATH_URI . "/bootstrap/js/bootstrap.min.js");
}
add_action("wp_enqueue_scripts", "theme_bootstrap_scripts");

function theme_font_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    wp_enqueue_style("font-awesome",                THEME_ASSETS_PATH_URI . "/css/fonts/font-awesome/css/all.min.css");
    wp_enqueue_style("icon_font-faces",             THEME_ASSETS_PATH_URI . "/css/fonts/icon_font-faces.css");
    wp_enqueue_style("wallstreet-fonts",            THEME_ASSETS_PATH_URI . "/css/fonts/font.css");
    if ($current_setup->get("enable_custom_typography") == true) {
        wp_enqueue_style("spicy-fonts",             wallstreet_fonts_url($current_setup->get("google_font")), [], null);
    } else {
        switch ($current_setup->get("local_font_style")) {
	        case 'roboto':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_roboto.css");
		        break;
            case 'montserrat':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_montserrat.css");
		        break;
		    case 'dancing-script':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_dancing-script.css");
		        break;
		    case 'rubik':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_rubik.css");
		        break;
		    case 'sulphurpoint':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_sulphurpoint.css");
		        break;
		    case 'overlock':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_overlock.css");
		        break;
		    case 'opensans':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_opensans.css");
		        break;
        	case 'anonymous-pro':
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces_anonymous-pro.css");
		        break;
	        default:
		        wp_enqueue_style("site_font-faces", THEME_ASSETS_PATH_URI . "/css/fonts/site_font-faces.css");
		        break;
        }
    }
}
add_action("wp_enqueue_scripts", "theme_font_scripts");

function theme_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    wp_enqueue_style("djs-wallstreet-pro-style",    get_stylesheet_uri());

    wp_enqueue_style("djs-wallstreet-pro-default",  THEME_ASSETS_PATH_URI . "/css/" . get_custom_stylesheet($current_setup));
    wp_enqueue_style("djs-wallstreet-pro-standard", THEME_ASSETS_PATH_URI . "/css/standard.css");

    wp_enqueue_style("djs-wallstreet-pro-jetpack",  THEME_ASSETS_PATH_URI . "/css/jetpack.css");
    wp_enqueue_style("djs-wallstreet-pro-button",   THEME_ASSETS_PATH_URI . "/css/button.css");
    wp_enqueue_style("djs-wallstreet-pro-fx",       THEME_ASSETS_PATH_URI . "/css/fx.css");

    wp_enqueue_style("djs-wallstreet-pro-menu",     THEME_ASSETS_PATH_URI . "/css/menu/menu.css");
    wp_enqueue_style("djs-wallstreet-pro-tool-tip", THEME_ASSETS_PATH_URI . "/css/menu/tooltips.css");

    wp_enqueue_style("media-responsive-min-1920",   THEME_ASSETS_PATH_URI . "/css/media/responsive/min-1920.css",                   [], '1.0.0', 'only screen and (min-width: 1920px)');
    wp_enqueue_style("media-responsive-min-1136",   THEME_ASSETS_PATH_URI . "/css/media/responsive/min-1136.css",                   [], '1.0.0', 'only screen and (min-width: 1136px)');
    wp_enqueue_style("media-responsive-min-1024",   THEME_ASSETS_PATH_URI . "/css/media/responsive/min-1024.css",                   [], '1.0.0', 'only screen and (min-width: 1024px)');
    wp_enqueue_style("media-responsive-min-960",    THEME_ASSETS_PATH_URI . "/css/media/responsive/min-960.css",                    [], '1.0.0', 'only screen and (min-width: 960px)');
    wp_enqueue_style("media-responsive-min-480",    THEME_ASSETS_PATH_URI . "/css/media/responsive/min-480.css",                    [], '1.0.0', 'only screen and (min-width: 480px)');

    wp_enqueue_style("media-responsive-max-1366",   THEME_ASSETS_PATH_URI . "/css/media/responsive/max-1366.css",                   [], '1.0.0', 'only screen and (max-width: 1366px)');
    wp_enqueue_style("media-responsive-max-1136",   THEME_ASSETS_PATH_URI . "/css/media/responsive/max-1136.css",                   [], '1.0.0', 'only screen and (max-width: 1136px)');
    wp_enqueue_style("media-responsive-max-1024",   THEME_ASSETS_PATH_URI . "/css/media/responsive/max-1024.css",                   [], '1.0.0', 'only screen and (max-width: 1024px)');
    wp_enqueue_style("media-responsive-max-960",    THEME_ASSETS_PATH_URI . "/css/media/responsive/max-960.css",                    [], '1.0.0', 'only screen and (max-width: 960px)');
    wp_enqueue_style("media-responsive-max-480",    THEME_ASSETS_PATH_URI . "/css/media/responsive/max-480.css",                    [], '1.0.0', 'only screen and (max-width: 480px)');

    wp_enqueue_style("media-print",                 THEME_ASSETS_PATH_URI . "/css/media/print.css",                                 [], '1.0.0', 'only print');

    require_once "custom_style.php";

    if (defined("DJS_POSTTYPE_PLUGIN")) {
        require_once "custom_style_special.php";
    }

}
add_action("wp_enqueue_scripts", "theme_scripts");

function theme_jquery_scripts() {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    wp_enqueue_script("menu",                       THEME_ASSETS_PATH_URI . "/js/menu/menu.js",                                     ["jquery"]);
    if ($current_setup->get("page_fader_enabled")) {
        wp_enqueue_script("page_fader",             THEME_ASSETS_PATH_URI . "/js/page_fader/page_fader.js",                         ["jquery"], '1.0.0', true);
    }

    wp_enqueue_script("parallax",                   THEME_ASSETS_PATH_URI . "/js/parallax/parallax.min.js");
    wp_enqueue_script("rellax",                     THEME_ASSETS_PATH_URI . "/js/parallax/rellax.min.js");
    wp_enqueue_script("page",                       THEME_ASSETS_PATH_URI . "/js/page.js",                                          ["jquery"]);

    if ($current_setup->get("home_blog_same_height")) {
        wp_enqueue_script("djs",                    THEME_ASSETS_PATH_URI . "/js/djs.js",                                           ["jquery"]);
    }

    if ($current_setup->get("parallaxbackground_enabled")) {
        wp_enqueue_script("parallax-enabled",       THEME_ASSETS_PATH_URI . "/js/parallax/enabled.js",                              ["parallax"]);
    }

    if (class_exists("WooCommerce")) {
        wp_enqueue_style("woocommerce",             THEME_ASSETS_PATH_URI . "/css/woocommerce/woocommerce.css");
        wp_enqueue_style("woocommerce-font",        THEME_ASSETS_PATH_URI . "/css/woocommerce/font.css");
    }

    if (defined("DJS_POSTTYPE_PLUGIN")) {
        if (is_page_template("template-special/portfolio-2-column.php") || is_page_template("template-special/portfolio-3-column.php") || is_page_template("template-special/portfolio-4-column.php")) {
            wp_enqueue_style("lightbox-css",            THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_script("lightbox-js",            THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"]);
        }

        if (is_page_template("template-special/single-portfolio.php") || PORTFOLIO_POST_TYPE == get_post_type()) {
            wp_enqueue_style("lightbox",                THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_script("lightbox1",              THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"]);
            wp_enqueue_script("carouFredSel",           THEME_ASSETS_PATH_URI . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", ["jquery"]);
            wp_enqueue_script("carouFredSel1",          THEME_ASSETS_PATH_URI . "/js/caroufredsel/caroufredsel-element.js",             ["jquery"]);
        }

        if (is_front_page() || is_page_template("template/homepage.php") || is_testimonial_carousel()) {
            wp_enqueue_style("lightbox",                THEME_ASSETS_PATH_URI . "/css/lightbox/lightbox.css");
            wp_enqueue_style("flexslider",              THEME_ASSETS_PATH_URI . "/css/flexslider/flexslider.css");
            wp_enqueue_script("lightbox",               THEME_ASSETS_PATH_URI . "/js/lightbox/lightbox.js",                             ["jquery"]);
            wp_enqueue_script("flexslider",             THEME_ASSETS_PATH_URI . "/js/flexslider/jquery.flexslider.js",                  ["jquery"]);
            wp_enqueue_script("carouFredSel",           THEME_ASSETS_PATH_URI . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", ["jquery"]);
        }
    }
}
add_action("wp_enqueue_scripts", "theme_jquery_scripts");

if (is_singular()) {
    wp_enqueue_script("comment-reply");
}

function theme_custom_enqueue_css() {
    global $pagenow;

    if (in_array($pagenow, ["post.php", "post-new.php", "page-new.php", "page.php"])) {
        wp_enqueue_style("meta-box-css",            THEME_ASSETS_PATH_URI . "/css/admin/meta-box.css");
    }
    wp_enqueue_style("color-schema",                THEME_ASSETS_PATH_URI . "/customizer/color-schema.css");

}
add_action("admin_print_styles", "theme_custom_enqueue_css", 10);

function wallstreet_shortcode_detect() {
    global $wp_query;
    $posts = $wp_query->posts;
    $pattern = get_shortcode_regex();
    foreach ($posts as $post) {
        if (isset($post->post_content)) {
            if (preg_match_all("/" . $pattern . "/s", $post->post_content, $matches) && array_key_exists(2, $matches) && (in_array("button", $matches[2]) || in_array("row", $matches[2]) || in_array("accordian", $matches[2]) || in_array("tabgroup", $matches[2]) || in_array("tabs", $matches[2]) || in_array("alert", $matches[2]) || in_array("dropcap", $matches[2]) || in_array("gridsystemlayout", $matches[2]) || in_array("tooltip", $matches[2]) || in_array("heading", $matches[2]))) {
                wp_enqueue_script("bootstrap",      THEME_ASSETS_PATH_URI . "/bootstrap/js/bootstrap.min.js");
                wp_enqueue_script("accordion-tab",  THEME_ASSETS_PATH_URI . "/js/accordion-tab.js");
                wp_enqueue_script("collapse",       THEME_ASSETS_PATH_URI . "/js/collapse.js");
                break;
            }
        }
    }
}
add_action("wp", "wallstreet_shortcode_detect");

function footer_custom_script() {
    $stylesheet = get_custom_stylesheet();

    if (!class_exists("WooCommerce") && !empty($stylesheet)) {
        wp_enqueue_style("woocommerce-custom",      THEME_ASSETS_PATH_URI . "/css/woocommerce/" . $stylesheet);
    }

    if ($stylesheet == "light.css") {
        custom_light();
    } else {
        custom_dark();
    }
}
add_action("wp_footer", "footer_custom_script");

if (!function_exists("wallstreet_customizer_preview_scripts")) {
    function wallstreet_customizer_preview_scripts() {
        wp_enqueue_script("ws-customizer-preview",  THEME_ASSETS_PATH_URI . "/customizer/slider/js/customizer-preview.js", ["customize-preview", "jquery"]);
    }
}
add_action("customize_preview_init", "wallstreet_customizer_preview_scripts");

if($current_setup->get("remove_googlefonts") == true && $current_setup->get("enable_custom_typography") == false){
    add_filter('style_loader_src', function($href){
        if(strpos($href, "//fonts.googleapis.com/") === false) {
            return $href;
        }
        return false;
    });
}
?>