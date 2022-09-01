<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <?php global $wp_query;
        if(!empty($wp_query->post)){
            $postid = $wp_query->post->ID;
        
            $page_description = get_post_meta($postid, 'page_description', true);
            if(empty($page_description)) {$page_description=htmlentities(wp_strip_all_tags(tag_description()));}
            if(empty($page_description)) {$page_description=get_the_archive_title()!="Archive"?htmlentities(wp_strip_all_tags(get_the_archive_title())):"";}

            $single_description = substr(htmlentities(wp_strip_all_tags(get_the_excerpt(), true)), 0, 150);
            if(empty($single_description)) {$single_description= get_the_title();}
            $single_description .= "...";

            $single_metakeytags = "Blog";
            $tags = get_the_tags();
            if(!empty($tags))
                foreach($tags as $tag){ $single_metakeytags.= ", ".htmlentities(wp_strip_all_tags($tag->name)); }
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

        <meta name="description" content="<?php if ( is_single() ) { echo wp_trim_words($single_description, 120, '...'); } else if(!empty($page_description)) { bloginfo('name'); echo " - ". $page_description; }else { bloginfo('name'); echo " - "; bloginfo('description'); }?>" />
        <meta name="keywords" content="<?php echo $single_metakeytags; ?>" />

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <?php $current_options = get_current_options(); ?>
        <?php
        if ($current_options["upload_image_favicon"] != "") { ?>
            <link rel="shortcut icon" href="<?php echo $current_options["upload_image_favicon"]; ?>" /> 
        <?php }
        wp_head();
        if ($current_options["contact_header_settings"] != "on") { ?>
            <style type="text/css">
                @media only screen and (min-width: 200px) and (max-width: 480px) {
                    .header-top-area {
                        display: none;
                    }
                }
            </style>
        <?php } ?>
        <?php if ($current_options["parallaxbackground_enabled"]) { ?>
            <script type="text/javascript">
                function snap(bgParallax){
                    if (bgParallax != null){
                        var scrollPosition = window.scrollY; //window.pageYOffset;
                        var limit = bgParallax.offsetTop + bgParallax.offsetHeight;
                        if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit){
                            bgParallax.style.backgroundPositionY = scrollPosition / 68 + 'px';
                        }else{
                            bgParallax.style.backgroundPositionY = '0';
                        }
                        setTimeout(snap, 20, bgParallax);
                    }
                }

                var timeoutId = null;
                window.addEventListener('scroll', function(){
                    if(timeoutId) clearTimeout(timeoutId);
                    timeoutId = setTimeout(snap, 200, document.getElementsByClassName('custom-background')[0]);
                }, true);
            </script>
        <?php } ?>
    </head>
    <?php
    $additional_BodyClasses = [];
    if ($current_options["fixedheader_enabled"]) {
        $additional_BodyClasses = ["body-static-top", "fixed_Header"];
    }
    if ($current_options["fixedfooter_enabled"]) {
        $additional_BodyClasses[] = "fixed_Footer";
    }
    if ($current_options["breadcrumbposition"] > 0 || $current_options["contentposition"] > 0) {
        $additional_BodyClasses[] = "custom-positions";
    }
    ?>
    <body id="djs-body" <?php body_class($additional_BodyClasses); ?> <?php if (!$current_options["contextmenu_enabled"]) { echo 'oncontextmenu="return false;"'; } ?>>
        <?php if ($current_options["page_fader_enabled"]) { ?>
            <div id="page_fader">
                <div class="page_fader logo <?php row_Frame_Border(""); ?>">
                    <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
                    <h2 class="animate">Inhalt wird geladen...</h2>
                </div>
            </div>
            <noscript>
                <div class="warning java"><span title="JavaScript Disabled" class="material-symbols-outlined">report</span></div>
                <style>#page_fader{ display: none; }</style>
            </noscript>
        <?php } ?>
        <div id="wall_wrapper">	
            <!--Header Top Layer Section-->
            <?php if (!$current_options["fixedheader_enabled"]) { ?>
                <div class="rellax" data-rellax-speed="-3">
            <?php } ?>
            <?php if ($current_options["header_social_media_enabled"] == true || $current_options["contact_header_settings"] == "on") { ?>
                <div class="header-top-area rellax" data-rellax-speed="-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php if ($current_options["header_social_media_enabled"] == true) { ?>
                                    <?php
                                    global $ul_class;
                                    $ul_class = "head";
                                    get_template_part("template-parts/global/social-media");
                                } ?>	
                            </div>
                            <div class="col-sm-6">
                                <?php if ($current_options["contact_header_settings"] == "on") { ?>
                                    <ul class="head-contact-info">
                                        <?php if ($current_options["contact_header_contact_settings"] != "") { ?>
                                            <li><i class="fa fa-phone-square"></i><?php echo $current_options["contact_header_contact_settings"]; ?></li>
                                        <?php } ?>
                                        <?php if ($current_options["contact_header_email_settings"] != "") { ?>
                                            <li><i class="fa fa-envelope"></i><?php echo $current_options["contact_header_email_settings"]; ?></li>
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
            <?php get_template_part("template-parts/global/header/header", $current_options["header_presets_stlyle"]); ?>
            <?php if (!$current_options["fixedheader_enabled"]): ?>
                </div>
            <?php endif; ?>
            <?php if ($current_options["search_effect_style_setting"] == "toogle") { ?>
                <div id="searchbar_fullscreen" <?php if ($current_options["search_effect_style_setting"] == "popup_light") { ?> class="bg-light" <?php } ?>>
                    <button type="button" class="close material-icons-outlined">close</button>
                    <form method="get" id="searchform" autocomplete="off" class="search-form" action="<?php echo esc_url(home_url("/")); ?>"><label><input type="search" class="search-field" placeholder="<?php echo esc_html__("Search", "wallstreet"); ?> …" value="" name="s" id="s" required></label><button type="submit" class="search-submit btn" value="<?php echo esc_html__("Search", "wallstreet"); ?>"><?php echo esc_html__("Search", "wallstreet"); ?></button></form>
                </div>
            <?php } ?>
