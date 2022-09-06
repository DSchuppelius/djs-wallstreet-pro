<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : navbar-logo.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>

<div class="site-logo-area <?php echo has_custom_logo() ? "with-Logo" : "no-Logo"; ?> <?php echo display_header_text() ? "with-Text" : "no-Text"; ?>">
    <?php if(has_custom_logo()) {
        $custom_logo_id = get_theme_mod("custom_logo");
        $image = wp_get_attachment_image_src($custom_logo_id, "full"); ?>
        <a class="navbar-brand" href="<?php echo esc_url(home_url("/")); ?>">
            <img src="<?php echo esc_url($image[0]); ?>" class=" img-responsive custom-logo">
        </a>
    <?php }
    if(display_header_text()) { ?>
        <div class="site-branding-text logo-link-url">
            <h1 class="site-title">
                <a class="navbar-brand" href="<?php echo esc_url(home_url("/")); ?>" rel="home">
                    <div class="wallstreet_title_head"><?php bloginfo("name"); ?></div>
                </a>
            </h1>
            <?php $wallstreet_description = get_bloginfo("description", "display");
            if ($wallstreet_description || is_customize_preview()) { ?>
                <p class="site-description"> <?php echo $wallstreet_description; ?></p>
            <?php } ?>
        </div>
    <?php } ?>
</div>
