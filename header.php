<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$preset        = djs_header_preset();
$sticky        = (bool) $current_setup->get("fixedheader_enabled"); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?><?php djs_html_theme_attr(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="<?php echo esc_attr(djs_meta_description()); ?>">
    <meta name="keywords" content="<?php echo esc_attr(djs_meta_keywords()); ?>">
    <meta name="contributor" content="Daniel J&ouml;rg Schuppelius">
    <meta name="generator" content="Schuppelius v1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if ($current_setup->get("upload_image_favicon") != "" && !has_site_icon()) { ?>
        <link rel="icon" href="<?php echo esc_url($current_setup->get("upload_image_favicon")); ?>">
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body id="djs-body" <?php body_class(); ?><?php if (!$current_setup->get("contextmenu_enabled")) { echo ' oncontextmenu="return false;"'; } ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e("Skip to content", "djs-wallstreet-pro"); ?></a>

    <?php if ($current_setup->get("page_fader_enabled")) {
        get_template_part("template-parts/global/header/page", "fader");
    } ?>

    <div id="wall_wrapper" class="site">
        <?php if (!$sticky) { ?>
            <div class="rellax" data-rellax-speed="<?php echo intval($current_setup->get("data_rellax_speed_header")); ?>">
        <?php } ?>

        <?php get_template_part("template-parts/global/header/topbar"); ?>

        <?php // Preset 1-6: header-N.php gibt es nicht mehr, WordPress faellt auf header.php zurueck.
        get_template_part("template-parts/global/header/header", $preset["id"], ["preset" => $preset, "sticky" => $sticky]); ?>

        <?php if (!$sticky) { ?>
            </div>
        <?php } ?>

        <?php if (djs_header_search_mode() === "overlay") {
            get_template_part("template-parts/global/header/search", "overlay");
        } ?>

        <div id="site-content" class="site-content" tabindex="-1">
