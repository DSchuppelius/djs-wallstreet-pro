<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : functions.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
define("TEMPLATE_DIR_URI", get_template_directory_uri());
define("TEMPLATE_DIR", get_template_directory());
define("THEME_ASSETS_PATH", TEMPLATE_DIR . "/assets");
define("THEME_ASSETS_PATH_URI", TEMPLATE_DIR_URI . "/assets");
define("THEME_FUNCTIONS_PATH", TEMPLATE_DIR . "/functions");
define("THEME_OPTIONS_PATH", TEMPLATE_DIR_URI . "/functions/theme_options");

if (!defined('DJS_POSTTYPE_PLUGIN_DIR')) {
    add_action('admin_notices', function() { echo "<div class='notice'><p>" . sprintf(__('To use all features of the theme "DJS-Wallstreet-Pro" download the plugin <a href="%s">%s</a>', "djs-wallstreet-pro"), "https://github.com/DSchuppelius/djs-wallstreet-pro-post-types/releases/latest/", "DJS-Wallstreet-Pro Post-Types") . "</p></div>"; });
}

require_once "theme_setup_data.php";

require_once THEME_FUNCTIONS_PATH . "/base/get_template_parts.php";
require_once THEME_FUNCTIONS_PATH . "/base/get_content_title.php";
require_once THEME_FUNCTIONS_PATH . "/theme/theme_functions.php";
require_once THEME_FUNCTIONS_PATH . "/theme/theme_sanitizer.php";
require_once THEME_FUNCTIONS_PATH . "/theme/theme_colors.php";

require_once THEME_FUNCTIONS_PATH . "/scripts/scripts.php";
require_once THEME_FUNCTIONS_PATH . "/font/font.php";

require_once THEME_FUNCTIONS_PATH . "/content/content.php";
require_once THEME_FUNCTIONS_PATH . "/excerpt/excerpt.php";
require_once THEME_FUNCTIONS_PATH . "/breadcrumbs/breadcrumbs.php";
require_once THEME_FUNCTIONS_PATH . "/testimonials/testimonials.php";
require_once THEME_FUNCTIONS_PATH . "/pagination/theme_pagination.php";
require_once THEME_FUNCTIONS_PATH . "/menu/theme_bootstrap_walker_page.php";
require_once THEME_FUNCTIONS_PATH . "/menu/theme_bootstrap_walker_nav_menu.php";

require_once THEME_FUNCTIONS_PATH . "/basic/blog.php";
require_once THEME_FUNCTIONS_PATH . "/basic/iframe.php";
require_once THEME_FUNCTIONS_PATH . "/basic/archive.php";
require_once THEME_FUNCTIONS_PATH . "/basic/jscript.php";
require_once THEME_FUNCTIONS_PATH . "/basic/lazyload.php";
require_once THEME_FUNCTIONS_PATH . "/basic/generator.php";
require_once THEME_FUNCTIONS_PATH . "/basic/htmlclasses.php";

// Sidebar Widgets
require_once THEME_FUNCTIONS_PATH . "/widget/custom-sidebar.php";
require_once THEME_FUNCTIONS_PATH . "/widget/wallstreet-latest-widget.php";
require_once THEME_FUNCTIONS_PATH . "/widget/wallstreet-post-format-widget.php";
// Shortcodes
require_once THEME_FUNCTIONS_PATH . "/shortcodes/shortcodes.php";

// Customizer
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-controls.php";

require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-blog.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-home.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-global.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-social.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-template.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-copyright.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-typography.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/childs/customizer-theme_style.php";

require_once THEME_FUNCTIONS_PATH . "/customizer/single-blog-options.php";

require_once THEME_ASSETS_PATH . "/css/custom_dark.php";
require_once THEME_ASSETS_PATH . "/css/custom_light.php";

// Title
function theme_head($title, $sep) {
    global $paged, $page;
    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo("name");

    // Add the site description for the home/front page.
    $site_description = get_bloginfo("description");
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(esc_html__("Page", "djs-wallstreet-pro"), max($paged, $page));
    }

    return $title;
}
add_filter("wp_title", "theme_head", 10, 2);

if (!function_exists("theme_setup")) {
    function theme_setup() {
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 600;
        } //in px

        // Load text domain for translation-ready
        load_theme_textdomain("djs-wallstreet-pro", THEME_FUNCTIONS_PATH . "/lang");

        add_image_size("index-thumb", 493, 300, true);
        add_image_size("blog-thumb", 1000, 400, true);
        add_image_size("about-thumb", 1525, 450, true);
        add_image_size("banner-thumb", 2144, 650, true);
        add_image_size("bigbanner-thumb", 2144, 800, true);
        add_image_size("port-thumb", 550, 550, true);
        add_image_size("bigport-thumb", 1000, 1000, true);

        add_image_size("post-thumb", 733, 0);
        add_image_size("bigpost-thumb", 1000, 0);
        add_image_size("fullpost-thumb", 1525, 0);

        register_default_headers([
            "mypic" => [
                "url" => THEME_ASSETS_PATH_URI . "/images/page-header-bg.jpg",
                "thumbnail_url" => THEME_ASSETS_PATH_URI . "/images/page-header-bg.jpg",
                "description" => _x("MyPic", "header image description", "djs-wallstreet-pro"),
            ],
        ]);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu("primary", esc_html__("Primary Menu", "djs-wallstreet-pro")); //Navigation

        // theme support
        add_theme_support("automatic-feed-links");
        add_theme_support("responsive-embeds");
        add_theme_support("post-thumbnails");
        add_theme_support("wp-block-styles");
        add_theme_support('editor-style');
        add_theme_support("title-tag");

        set_post_thumbnail_size(1000, 400, true);

        add_theme_support('html5', ['comment-list', 'search-form', 'comment-form']);
        add_theme_support("post-formats", ["link", "aside", "gallery", "image", "quote", "status", "video", "audio", "chat"]);

        // custom header
        add_theme_support("custom-header", [
            "default-image"         => THEME_ASSETS_PATH_URI . "/images/page-header-bg.jpg",
            "width"                 => "2560",
            "height"                => "640",
            "flex-height"           => false,
            "flex-width"            => false,
            "header-text"           => true,
            "default-text-color"    => "#143745",
        ]);

        add_theme_support("custom-logo", [
            "width"                 => 300,
            "height"                => 50,
            "flex-width"            => true,
            "flex-height"           => true,
            "header-text"           => ["site-title", "site-description"],
        ]);

        add_theme_support("custom-background", [
            "default-color"         => "000000",
            'default-repeat'        => 'no-repeat',
            'default-position-x'    => 'center',
            'default-position-y'    => 'center',
            'default-size'          => 'auto',
            'default-attachment'    => 'fixed',
            "default-image"         => THEME_ASSETS_PATH_URI . "/images/page-bg.jpg",
        ]);

        // Woocommerce support
        add_theme_support("woocommerce");

        // Added woocommerce galllery support
        add_theme_support("wc-product-gallery-zoom");
        add_theme_support("wc-product-gallery-lightbox");
        add_theme_support("wc-product-gallery-slider");
    }
}
add_action("after_setup_theme", "theme_setup");

function kb_mimes($my_mime){
    $my_mime['FCStd'] = 'application/zip';
    $my_mime['svg']   = 'image/svg+xml';
    $my_mime['zip']   = 'application/zip';
    $my_mime['m4a']   = 'audio/mp4';
    $my_mime['mp4']   = 'application/mp4';
    $my_mime['mp3']   = 'audio/mp3';
    return $my_mime;
}
add_filter('upload_mimes', 'kb_mimes');

function add_to_author_profile($contactmethods) {
    $contactmethods["facebook_profile"] = esc_html__("Facebook URL", "djs-wallstreet-pro");
    $contactmethods["twitter_profile"] = esc_html__("Twitter URL", "djs-wallstreet-pro");
    $contactmethods["linkedin_profile"] = esc_html__("LinkedIn URL", "djs-wallstreet-pro");
    return $contactmethods;
}
add_filter("user_contactmethods", "add_to_author_profile", 10, 1);

function add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-responsive comment-img img-circle", $class);
    return $class;
}
add_filter("get_avatar", "add_gravatar_class");

function next_posts_link_attributes() {
  return 'class="btn next"';
}
add_filter('next_posts_link_attributes', 'next_posts_link_attributes');

function prev_posts_link_attributes() {
  return 'class="btn prev"';
}
add_filter('previous_posts_link_attributes', 'prev_posts_link_attributes');
