<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $link_color;
global $background_color;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

$header_correctize = $current_setup->get("fixedheader_enabled") ? 80 : 0;
$sub_slider_correctize = $current_setup->get("slideroundcorner") > 0 ? $current_setup->get("slideroundcorner") - 20 : 0;

if ($current_setup->get("enable_custom_typography") == true) { ?>
<style type="text/css">
body {
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
}

/****** custom typography *********/
body .home-blog-description p,
body .portfolio-detail-description p,
body .blog-post-title-wrapper-full p,
body .blog-post-title-wrapper p {
    font-size: <?php echo $current_setup->get("general_typography_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("general_typography_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("general_typography_fontstyle");
    ?>;
    line-height: <?php echo $current_setup->get("general_typography_fontsize") + 5 . "px";
    ?>;
}

/*** Menu title */
.navbar .navbar-nav>li>a {
    font-size: <?php echo $current_setup->get("menu_title_fontsize") . "px";
    ?> !important;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-style: <?php echo $current_setup->get("menu_title_fontstyle");
    ?> !important;
    font-weight: <?php echo $current_setup->get("menu_title_fontfamily");
    ?> !important;
}

/*** post and Page title */
body .blog-post-title-wrapper h2,
body .blog-post-title-wrapper h2 a,
body .blog-post-title-wrapper-full h2,
body .blog-post-title-wrapper-full h2 {
    font-size: <?php echo $current_setup->get("post_title_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("post_title_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("post_title_fontstyle");
    ?>;
}

/*** service title */
body .service-area h2 {
    font-size: <?php echo $current_setup->get("service_title_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("service_title_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("service_title_fontstyle");
    ?>;
}

/******** portfolio title ********/
body .main-portfolio-showcase .main-portfolio-showcase-detail h4 {
    font-size: <?php echo $current_setup->get("portfolio_title_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("portfolio_title_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("portfolio_title_fontstyle");
    ?>;
}

/******* footer widget title*********/
body .footer_widget_title,
body .footer-widget-section .wp-block-search .wp-block-search__label,
body .footer-widget-section h1,
body .footer-widget-section h2,
body .footer-widget-section h3,
body .footer-widget-section h4,
body .footer-widget-section h5,
body .footer-widget-section h6,
body .sidebar-widget-title h2,
body .sidebar-widget .wp-block-search .wp-block-search__label,
body .sidebar-widget h1,
body .sidebar-widget h2,
.sidebar-widget h3,
body .sidebar-widget h4,
body .sidebar-widget h5,
body .sidebar-widget h6,
.wc-block-product-search__label {
    font-size: <?php echo $current_setup->get("widget_title_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("widget_title_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("widget_title_fontstyle");
    ?>;
}

body .callout-section h3 {
    font-size: <?php echo $current_setup->get("calloutarea_title_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("calloutarea_title_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("calloutarea_title_fontstyle");
    ?>;
}

body .callout-section p {
    font-size: <?php echo $current_setup->get("calloutarea_description_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("calloutarea_description_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("calloutarea_description_fontstyle");
    ?>;
}

body .callout-section a {
    font-size: <?php echo $current_setup->get("calloutarea_purches_fontsize") . "px";
    ?>;
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: <?php echo $current_setup->get("calloutarea_purches_fontfamily");
    ?>;
    font-style: <?php echo $current_setup->get("calloutarea_purches_fontstyle");
    ?>;
}

.custom-logo {
    width: <?php echo esc_html(get_theme_mod("wallstreet_logo_length", "400"));
    ?>px;
    height: auto;
}

.blog-author h6,
.blog-list-view .blog-post-title-wrapper h2,
.blog-list-view .blog-post-title-wrapper-full h2,
.blog-post-title-wrapper h2,
.title h3,
.blog-post-title-wrapper h2 span.title.post_format,
.blog-post-title-wrapper h2 span.title.post_format.none~.title,
.features-title,
.home-blog-area .home-blog-info h2,
.page-blog-area .home-blog-info h2,
.sidebar-widget .wp-block-search .wp-block-search__label,
.sidebar-widget h1,
.sidebar-widget h2,
.sidebar-widget h3,
.sidebar-widget h4,
.sidebar-widget h5,
.sidebar-widget h6,
.slide-text-bg1 h2,
a.comment-edit-link,
a.comment-reply-link,
input[type="submit"],
button,
.btn,
a.button {
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: 300
}

.page-title-col h1,
.slide-text-bg2 h1 {
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: 500
}

.section_heading_title h1,
.sidebar-widget div#calendar_wrap table>caption,
.footer_widget_column div#calendar_wrap table>caption,
.about-section h3,
.blog-post-date span.comment {
    font-family: '<?php echo $current_setup->get("google_font"); ?>' !important;
    font-weight: 700
}
</style>
<?php } ?>
<style type="text/css">
:root {
    <?php if ( !defined("DJS_POSTTYPE_PLUGIN")) {
        ?>--main-slider-radius: <?php echo $current_setup->get("slideroundcorner");
        ?>px !important;
        --sub-slider-radius: <?php echo $current_setup->get("slideroundcorner") - 20;
        ?>px !important;
        <?php
    }

    ?>--theme-background-color: <?php echo $background_color;
    ?> !important;
    --theme-color: <?php echo $link_color;
    ?> !important;

    --input-base: <?php echo $current_setup->get("input_base");
    ?>em !important;
    --input-biggerbase: <?php echo $current_setup->get("input_base")+0.2;
    ?>em !important;
    --input-smallerbase: <?php echo $current_setup->get("input_base") - 0.1;
    ?>em !important;

    --border-base: <?php echo $current_setup->get("border_base");
    ?>px !important;
    --border-bigbase: <?php echo $current_setup->get("border_bigbase");
    ?>px !important;
    --border-smallbase: <?php echo $current_setup->get("border_smallbase");
    ?>px !important;
    --border-verysmallbase: <?php echo $current_setup->get("border_verysmallbase");
    ?>px !important;
}

#page_fader {
    <?php if($background=set_url_scheme(get_background_image())) {
        ?>background-image: url('<?php echo esc_url($background); ?>');
        background-size: <?php esc_html_e(get_theme_mod('background_size', get_theme_support('custom-background', 'default-size')));
        ?>;
        background-repeat: <?php esc_html_e(get_theme_mod('background_repeat', get_theme_support('custom-background', 'default-repeat')));
        ?>;
        background-position: <?php printf("%s %s", esc_html(get_theme_mod('background_position_x', get_theme_support('custom-background', 'default-position-x'))), esc_html(get_theme_mod('background_position_y', get_theme_support('custom-background', 'default-position-y'))));
        ?>;
        background-attachment: <?php esc_html_e(get_theme_mod('background_attachment', get_theme_support('custom-background', 'default-attachment')));
        ?>;
        <?php
    }

    ?>
}

div.page-mycarousel:not(.home .page-mycarousel) {
    margin-bottom: <?php echo 80 - $sub_slider_correctize;
    ?>px;
}

.custom-logo {
    width: <?php esc_html_e(get_theme_mod("wallstreet_logo_length", "156"));
    ?>px;
    height: auto;
}

.custom-positions .page-breadcrumbs {
    bottom: <?php echo $current_setup->get("breadcrumbposition");
    ?>px;
}

.custom-positions .container.page-title-col {
    padding-bottom: <?php echo $sub_slider_correctize + $current_setup->get("breadcrumbposition") - $header_correctize;
    ?>px;
}

.custom-positions .page-mycarousel:not(.home .page-mycarousel) {
    margin-bottom: <?php echo 80 - $current_setup->get("contentposition") - $sub_slider_correctize;
    ?>px;
}
</style>

<?php if ($current_setup->get("contact_header_settings") != "on") { ?>
<style type="text/css">
@media only screen and (min-width: 200px) and (max-width: 480px) {
    .header-top-area {
        display: none;
    }
}
</style>
<?php } ?>