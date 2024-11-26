<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
    <?php global $wp_query;
        $single_metakeytags = "Blog";

        if(!empty($wp_query->post)){
            $postid = $wp_query->post->ID;

            $page_description = htmlEntities(get_post_meta($postid, 'page_description', true));
            if(empty($page_description)) { $page_description = htmlentities(wp_strip_all_tags(tag_description()));}
            if(empty($page_description)) { $page_description = get_the_archive_title() != "Archive" ? htmlentities(wp_strip_all_tags(get_the_archive_title())) : "";}

            $single_description = substr(htmlentities(wp_strip_all_tags(get_the_excerpt(), true)), 0, 150);
            if(empty($single_description)) { $single_description= htmlEntities(get_the_title()); }
            $single_description .= "...";

            $tags = get_the_tags();
            if(!empty($tags))
                foreach($tags as $tag){ $single_metakeytags.= ", " . htmlentities(wp_strip_all_tags($tag->name)); }
        } ?>
    <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="contributor" content="Daniel J&ouml;rg Schuppelius" />
    <meta name="generator" content="Schuppelius v1.0" />

    <meta name="description"
        content="<?php if (is_single()) { echo htmlEntities(wp_trim_words($single_description, 120, '...')); } else if (!empty($page_description)) { bloginfo('name'); echo " - " . htmlEntities($page_description); } else { bloginfo('name'); echo " - "; bloginfo('description'); }?>" />
    <meta name="keywords" content="<?php echo $single_metakeytags; ?>" />

    <base href="<?php echo esc_url(home_url("/")); ?>">

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if ($current_setup->get("upload_image_favicon") != "") { ?>
    <link rel="shortcut icon" href="<?php echo esc_url($current_setup->get("upload_image_favicon")); ?>" />
    <?php } ?>

    <?php wp_head(); ?>
</head>
<?php
    $additional_BodyClasses = [];
    if ($current_setup->get("fixedheader_enabled") && ($current_setup->get("header_presets_stlyle") != 3 && $current_setup->get("header_presets_stlyle") != 4)) {
        $additional_BodyClasses = ["body-static-top", "fixed_Header"];
    }
    if ($current_setup->get("fixedfooter_enabled")) {
        $additional_BodyClasses[] = "fixed_Footer";
    }
    if ($current_setup->get("breadcrumbposition") != 0 || $current_setup->get("contentposition") != 0) {
        $additional_BodyClasses[] = "custom-positions";
    }
    if ($current_setup->get("a_underlined")) {
        $additional_BodyClasses[] = "a_underlined";
    }
    if ($current_setup->get("a_mark_targets")) {
        $additional_BodyClasses[] = "a_mark_targets";
    }
    if (is_denied_specialtemplate()) {
        $additional_BodyClasses[] = "denied_template_loaded";
    }
    ?>

<body id="djs-body" <?php body_class($additional_BodyClasses); ?>
    <?php if (!$current_setup->get("contextmenu_enabled")) { echo 'oncontextmenu="return false;"'; } ?>>
    <?php wp_body_open(); ?>
    <?php if ($current_setup->get("page_fader_enabled")) { get_template_part("template-parts/global/header/page", "fader"); } ?>
    <div id="wall_wrapper">
        <!--Header Top Layer Section-->
        <?php if (!$current_setup->get("fixedheader_enabled")) { ?>
        <div class="rellax" data-rellax-speed="<?php echo $current_setup->get("data_rellax_speed_header"); ?>">
            <?php } ?>
            <?php if ($current_setup->get("header_social_media_enabled") == true || $current_setup->get("contact_header_settings") == "on") { ?>
            <div class="header-top-area rellax"
                data-rellax-speed="<?php echo $current_setup->get("data_rellax_speed_social_contact_header"); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <?php if ($current_setup->get("header_social_media_enabled") == true) { ?>
                            <?php
                                    global $ul_class;
                                    $ul_class = "head";
                                    get_template_part("template-parts/global/social-media");
                                } ?>
                        </div>
                        <div class="col-sm-8">
                            <?php if ($current_setup->get("contact_header_settings") == "on") { ?>
                            <ul class="head-contact-info">
                                <?php if ($current_setup->get("contact_header_contact_settings") != "") { ?>
                                <li><i
                                        class="fa fa-phone-square"></i><?php echo $current_setup->get("contact_header_contact_settings"); ?>
                                </li>
                                <?php } ?>
                                <?php if ($current_setup->get("contact_header_email_settings") != "") { ?>
                                <li><i
                                        class="fa fa-envelope"></i><?php echo $current_setup->get("contact_header_email_settings"); ?>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!--/Header Top Layer Section.-->

            <!--Header Logo & Menus-->
            <?php get_template_part("template-parts/global/header/header", $current_setup->get("header_presets_stlyle")); ?>
            <?php if (!$current_setup->get("fixedheader_enabled")): ?>
        </div>
        <?php endif; ?>
        <?php if ($current_setup->get("search_effect_style_setting") == "toogle") { ?>
        <div id="searchbar_fullscreen"
            <?php if ($current_setup->get("search_effect_style_setting") == "popup_light") { ?> class="bg-light"
            <?php } ?>>
            <button type="button" class="not close material-icons-outlined">close</button>
            <form method="get" id="searchform" autocomplete="off" class="search-form"
                action="<?php echo esc_url(home_url("/")); ?>"><label><input type="search" class="search-field"
                        placeholder="<?php esc_attr_e("Search", "djs-wallstreet-pro"); ?> …" value="" name="s" id="s"
                        required></label><button type="submit" class="search-submit btn"
                    value="<?php echo esc_attr_e("Search", "djs-wallstreet-pro"); ?>"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></button>
            </form>
        </div>
        <?php } ?>
