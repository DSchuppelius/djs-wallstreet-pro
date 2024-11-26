<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : social-media.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $ul_class;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
if (!empty($ul_class)) {
    $ul_class .= "-";
}
?>

<ul class="<?php echo $ul_class; ?>contact-social">
    <?php if ($current_setup->get("social_media_twitter_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_twitter_link")); ?>"
            <?php blank_target($current_setup->get("twitter_link_new_tab")); ?>><i class="fa-brands fa-twitter"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_facebook_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_facebook_link")); ?>"
            <?php blank_target($current_setup->get("facebook_link_new_tab")); ?>><i
                class="fa-brands fa-facebook"></i></a></li>
    <?php }
    if ($current_setup->get("social_media_linkedin_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_linkedin_link")); ?>"
            <?php blank_target($current_setup->get("linkedin_link_new_tab")); ?>><i
                class="fa-brands fa-linkedin"></i></a></li>
    <?php }
    if ($current_setup->get("social_media_github_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_github_link")); ?>"
            <?php blank_target($current_setup->get("github_link_new_tab")); ?>><i class="fa-brands fa-github"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_pinterest_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_pinterest_link")); ?>"
            <?php blank_target($current_setup->get("pintrest_link_new_tab")); ?>><i
                class="fa-brands fa-pinterest"></i></a></li>
    <?php }
    if ($current_setup->get("social_media_youtube_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_youtube_link")); ?>"
            <?php blank_target($current_setup->get("youtube_link_new_tab")); ?>><i class="fa-brands fa-youtube"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_skype_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_skype_link")); ?>"
            <?php blank_target($current_setup->get("skype_link_new_tab")); ?>><i class="fa-brands fa-skype"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_rssfeed_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_rssfeed_link")); ?>"
            <?php blank_target($current_setup->get("rss_link_new_tab")); ?>><i class="fa fa-rss"></i></a></li>
    <?php }
    if ($current_setup->get("social_media_wordpress_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_wordpress_link")); ?>"
            <?php blank_target($current_setup->get("wp_link_new_tab")); ?>><i class="fa-brands fa-wordpress"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_dropbox_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_dropbox_link")); ?>"
            <?php blank_target($current_setup->get("db_link_new_tab")); ?>><i class="fa-brands fa-dropbox"></i></a></li>
    <?php }
    if ($current_setup->get("social_media_instagram_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_instagram_link")); ?>"
            <?php blank_target($current_setup->get("insta_link_new_tab")); ?>><i class="fa-brands fa-instagram"></i></a>
    </li>
    <?php }
    if ($current_setup->get("social_media_vimeo_link") != "") { ?>
    <li><a href="<?php echo esc_url($current_setup->get("social_media_vimeo_link")); ?>"
            <?php blank_target($current_setup->get("vimeo_link_new_tab")); ?>><i class="fa-brands fa-vimeo"></i></a>
    </li>
    <?php } ?>
</ul>