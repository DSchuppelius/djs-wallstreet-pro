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

require_once "theme_setup_data.php";

require_once THEME_FUNCTIONS_PATH . "/base/get_template_parts.php";
require_once THEME_FUNCTIONS_PATH . "/base/get_content_title.php";
require_once THEME_FUNCTIONS_PATH . "/base/theme_functions.php";
require_once THEME_FUNCTIONS_PATH . "/base/theme_colors.php";

require_once THEME_FUNCTIONS_PATH . "/font/font.php";
require_once THEME_FUNCTIONS_PATH . "/scripts/scripts.php";

require_once THEME_FUNCTIONS_PATH . "/excerpt/excerpt.php";
require_once THEME_FUNCTIONS_PATH . "/meta-box/post-meta.php";
require_once THEME_FUNCTIONS_PATH . "/taxonomies/taxonomies.php";
require_once THEME_FUNCTIONS_PATH . "/widget/custom-sidebar.php";
require_once THEME_FUNCTIONS_PATH . "/breadcrumbs/breadcrumbs.php";
require_once THEME_FUNCTIONS_PATH . "/testimonials/testimonials.php";
require_once THEME_FUNCTIONS_PATH . "/post-type/custom-post-types.php";
require_once THEME_FUNCTIONS_PATH . "/pagination/theme_pagination.php";
require_once THEME_FUNCTIONS_PATH . "/menu/theme_bootstrap_walker_page.php";
require_once THEME_FUNCTIONS_PATH . "/menu/theme_bootstrap_walker_nav_menu.php";

require_once THEME_FUNCTIONS_PATH . "/basic/blog.php";
require_once THEME_FUNCTIONS_PATH . "/basic/iframe.php";
require_once THEME_FUNCTIONS_PATH . "/basic/lazyload.php";
require_once THEME_FUNCTIONS_PATH . "/basic/generator.php";
require_once THEME_FUNCTIONS_PATH . "/basic/htmlclasses.php";

// Sidebar Widgets
require_once THEME_FUNCTIONS_PATH . "/widget/wallstreet-latest-widget.php";
// Webriti shortcodes
require_once THEME_FUNCTIONS_PATH . "/shortcodes/shortcodes.php"; //for shortcodes

// Customizer
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-blog.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-home.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-team.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-global.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-client.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-layout.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-slider.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-social.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-feature.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-service.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-project.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-template.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-copyright.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-typography.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-testimonial.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer_theme_style.php";
require_once THEME_FUNCTIONS_PATH . "/customizer/customizer-post-type-slugs.php";

require_once THEME_FUNCTIONS_PATH . "/customizer/single-blog-options.php";

require_once THEME_ASSETS_PATH . "/css/custom_dark.php";
require_once THEME_ASSETS_PATH . "/css/custom_light.php";
require_once TEMPLATE_DIR . "/inc/customizer/customizer-slider/customizer-slider.php";

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
        $title = "$title $sep " . sprintf(_e("Page", "wallstreet"), max($paged, $page));
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
        load_theme_textdomain("wallstreet", THEME_FUNCTIONS_PATH . "/lang");

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
                "description" => _x("MyPic", "header image description", "wallstreet"),
            ],
        ]);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu("primary", __("Primary Menu", "wallstreet")); //Navigation

        // theme support
        add_theme_support("automatic-feed-links");
        add_theme_support("post-thumbnails");
        add_theme_support("title-tag");
        add_theme_support("post-formats", ["link", "aside", "gallery", "image", "quote", "status", "video", "audio", "chat"]);

        // custom header
        add_theme_support("custom-header", [
            "default-image" => THEME_ASSETS_PATH_URI . "/images/page-header-bg.jpg",
            "width" => "2560",
            "height" => "640",
            "flex-height" => false,
            "flex-width" => false,
            "header-text" => true,
            "default-text-color" => "#143745",
        ]);

        add_theme_support("custom-logo", [
            "width" => 300,
            "height" => 50,
            "flex-width" => true,
            "flex-height" => true,
            "header-text" => ["site-title", "site-description"],
        ]);

        add_theme_support("custom-background", ["default-color" => "000000"]);

        // Woocommerce support
        add_theme_support("woocommerce");

        // Added woocommerce galllery support
        add_theme_support("wc-product-gallery-zoom");
        add_theme_support("wc-product-gallery-lightbox");
        add_theme_support("wc-product-gallery-slider");

        // Setup admin pannel default data for index page
        $wallstreet_pro_options = theme_data_setup(); // TODO ?
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
add_filter( 'upload_mimes', 'kb_mimes' );

if (!function_exists("busiprof_customizer_preview_scripts")) {
    function busiprof_customizer_preview_scripts() {
        wp_enqueue_script("honeypress-customizer-preview", trailingslashit(get_template_directory_uri()) . "inc/customizer/customizer-slider/js/customizer-preview.js", ["customize-preview", "jquery"]);
    }
}
add_action("customize_preview_init", "busiprof_customizer_preview_scripts");

// Read more tag to formatting in blog page
function new_content_more($more) {
    global $post;
    return '<form action="' . get_permalink() . "#more-" . $post->ID . '"><button class="btn more blog-btn" type="submit" >' . __("Read More", "wallstreet") . "</button></form>";
}
add_filter("the_content_more_link", "new_content_more");

function add_to_author_profile($contactmethods) {
    $contactmethods["facebook_profile"] = __("Facebook URL", "wallstreet");
    $contactmethods["twitter_profile"] = __("Twitter URL", "wallstreet");
    $contactmethods["linkedin_profile"] = __("LinkedIn URL", "wallstreet");
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

function content_width() {
    global $content_width;
    if (is_page_template("template/blog-fullwidth.php")) {
        $content_width = 950;
    }
}
add_action("template_redirect", "content_width");

function mfields_set_default_object_terms($post_id, $post) {
    if ("publish" == $post->post_status && $post->post_type == PORTFOLIO_POST_TYPE) {
        $taxonomies = get_object_taxonomies($post->post_type, "object");
        foreach ($taxonomies as $taxonomy) {
            $terms = wp_get_post_terms($post_id, $taxonomy->name);
            $myid = get_option("wallstreet_theme_default_term_id");
            $a = get_term_by("id", $myid, PORTFOLIO_TAXONOMY);
            if (empty($terms)) {
                wp_set_object_terms($post_id, $a->slug, $taxonomy->name);
            }
        }
    }
}
add_action("save_post", "mfields_set_default_object_terms", 100, 2);

function wallstreet_taxonomies_paged_function($query) {
    if (!is_admin() && $query->is_main_query() && is_tax(PORTFOLIO_TAXONOMY)) {
        $current_options = get_current_options();
        $tax_page = $current_options["portfolio_numbers_for_templates_category"];
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $query->set("posts_per_page", $tax_page);
        $query->set("paged", $paged);
    }
}
add_action("pre_get_posts", "wallstreet_taxonomies_paged_function");
