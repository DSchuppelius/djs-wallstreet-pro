<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-calloutarea.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Call-out-Bereich (Customizer: Call-out).
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
if (!$current_setup->get("call_out_area_enabled")) {
    return;
}
$title  = (string) $current_setup->get("call_out_title");
$text   = (string) $current_setup->get("call_out_text");
$button = (string) $current_setup->get("call_out_button_text");
$link   = (string) $current_setup->get("call_out_button_link");
$newtab = $current_setup->get("call_out_button_link_target") == "on"; ?>

<section class="callout callout-section site-wrap reveal">
    <div class="callout__inner">
        <div class="callout__text">
            <?php if ($title !== "") { ?><h2 class="callout__title"><?php echo wp_kses_post($title); ?></h2><?php } ?>
            <?php if ($text !== "") { ?><p class="callout__desc"><?php echo wp_kses_post($text); ?></p><?php } ?>
        </div>
        <?php if ($button !== "") { ?>
            <a class="btn btn-lg callout__button" href="<?php echo esc_url($link ?: "#"); ?>" <?php blank_target($newtab); ?><?php echo $newtab ? ' rel="noopener"' : ""; ?>>
                <?php echo esc_html($button); ?><span class="material-icons" aria-hidden="true">arrow_forward</span>
            </a>
        <?php } ?>
    </div>
</section>
