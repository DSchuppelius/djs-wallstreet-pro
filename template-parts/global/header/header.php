<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Gemeinsames Template fuer die Header-Presets 1-6 (ersetzt header-1.php ... header-6.php).
 * Die Unterschiede stehen als Konfiguration in djs_header_preset().
 */

$preset = $args["preset"] ?? djs_header_preset();
$sticky = $args["sticky"] ?? false;

$classes = [
    "site-header",
    "site-header--" . $preset["layout"],
    "site-header--brand-" . $preset["brand"],
    "site-header--menu-" . $preset["menu"],
    "site-header--" . $preset["style"],
    "header-style-" . $preset["id"],
];
if ($preset["float"]) {
    $classes[] = "site-header--float";
}
if (!empty($preset["slant"])) {
    $classes[] = "site-header--slant";
}
if ($sticky) {
    $classes[] = "is-sticky";
}

$nav_label = esc_attr__("Main Navigation", "djs-wallstreet-pro"); ?>

<header id="site-header" class="<?php echo esc_attr(implode(" ", $classes)); ?>" data-site-header>
    <div class="site-header__bar">
        <div class="site-wrap site-header__inner">
            <div class="site-header__brand">
                <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
            </div>

            <?php if ($preset["layout"] === "inline") { ?>
                <nav id="site-navigation" class="site-nav" aria-label="<?php echo $nav_label; ?>">
                    <?php get_template_part("template-parts/global/header/primary-menu"); ?>
                </nav>
            <?php } ?>

            <?php get_template_part("template-parts/global/header/header", "tools"); ?>
        </div>
    </div>

    <?php if ($preset["layout"] === "stacked") { ?>
        <div class="site-header__menubar">
            <div class="site-wrap">
                <nav id="site-navigation" class="site-nav" aria-label="<?php echo $nav_label; ?>">
                    <?php get_template_part("template-parts/global/header/primary-menu"); ?>
                </nav>
            </div>
        </div>
    <?php } ?>
</header>
<?php /* Header-Hoehe sofort messen: Banner/Slider liegen unter dem Glas-Header und sollen beim Laden nicht springen. theme.js aktualisiert den Wert. */ ?>
<script>(function(h){if(h){var m=parseFloat(getComputedStyle(h).marginTop)||0;document.documentElement.style.setProperty("--header-h",Math.round(h.offsetHeight+m)+"px");}})(document.querySelector("[data-site-header]"));</script>
