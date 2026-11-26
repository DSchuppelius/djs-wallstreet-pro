<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : navbar-logo.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$has_logo  = has_custom_logo();
$show_text = display_header_text();
$home_url  = esc_url(home_url("/"));
// Auf der Startseite ist der Seitenname die Hauptueberschrift, sonst nicht.
$title_tag = (is_front_page() && !$has_logo) ? "h1" : "p"; ?>

<div class="site-logo-area <?php echo $has_logo ? "with-Logo" : "no-Logo"; ?> <?php echo $show_text ? "with-Text" : "no-Text"; ?>">
    <?php if ($has_logo) {
        $logo_id = get_theme_mod("custom_logo");
        $logo    = wp_get_attachment_image($logo_id, "full", false, [
            "class"         => "custom-logo",
            "alt"           => get_bloginfo("name", "display"),
            "loading"       => "eager",
            "fetchpriority" => "high",
            "decoding"      => "async",
        ]); ?>
        <a class="site-logo" href="<?php echo $home_url; ?>" rel="home">
            <?php echo $logo; ?>
        </a>
    <?php } ?>

    <?php if ($show_text) { ?>
        <div class="site-branding-text">
            <<?php echo $title_tag; ?> class="site-title">
                <a href="<?php echo $home_url; ?>" rel="home"><?php bloginfo("name"); ?></a>
            </<?php echo $title_tag; ?>>
            <?php $description = get_bloginfo("description", "display");
            if ($description || is_customize_preview()) { ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php } ?>
        </div>
    <?php } ?>
</div>
