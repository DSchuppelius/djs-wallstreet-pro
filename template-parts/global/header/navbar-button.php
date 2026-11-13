<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : navbar-button.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * "Darstellung": Schriftgroesse (vorher drei lose Buttons) und - falls im Customizer
 * erlaubt - die Wahl zwischen hellem, dunklem und System-Farbschema.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$font_controls = (bool) $current_setup->get("font_size_controls_enabled");
$color_toggle  = djs_color_mode_toggle_enabled();

if (!$font_controls && !$color_toggle) {
    return;
} ?>

<details class="dropdown dropdown-end site-popover" data-popover>
    <summary class="btn btn-ghost btn-circle" title="<?php esc_attr_e("Display settings", "djs-wallstreet-pro"); ?>">
        <span class="material-symbols-outlined" aria-hidden="true">settings_accessibility</span>
        <span class="screen-reader-text"><?php esc_html_e("Display settings", "djs-wallstreet-pro"); ?></span>
    </summary>
    <div class="dropdown-content site-popover__panel site-display">
        <?php if ($font_controls) { ?>
            <p class="site-display__label" id="djs-font-size-label"><?php esc_html_e("Font size", "djs-wallstreet-pro"); ?></p>
            <div class="join w-full" role="group" aria-labelledby="djs-font-size-label">
                <button type="button" class="btn btn-sm join-item flex-1" data-font-size="-1" title="<?php esc_attr_e("Decrease font size", "djs-wallstreet-pro"); ?>">
                    <span class="material-symbols-outlined" aria-hidden="true">text_decrease</span>
                    <span class="screen-reader-text"><?php esc_html_e("Decrease font size", "djs-wallstreet-pro"); ?></span>
                </button>
                <button type="button" class="btn btn-sm join-item flex-1" data-font-size="0" title="<?php esc_attr_e("Reset font size", "djs-wallstreet-pro"); ?>">
                    <span class="material-symbols-outlined" aria-hidden="true">restart_alt</span>
                    <span class="screen-reader-text"><?php esc_html_e("Reset font size", "djs-wallstreet-pro"); ?></span>
                </button>
                <button type="button" class="btn btn-sm join-item flex-1" data-font-size="1" title="<?php esc_attr_e("Increase font size", "djs-wallstreet-pro"); ?>">
                    <span class="material-symbols-outlined" aria-hidden="true">text_increase</span>
                    <span class="screen-reader-text"><?php esc_html_e("Increase font size", "djs-wallstreet-pro"); ?></span>
                </button>
            </div>
        <?php } ?>

        <?php if ($color_toggle) { ?>
            <p class="site-display__label" id="djs-color-mode-label"><?php esc_html_e("Color scheme", "djs-wallstreet-pro"); ?></p>
            <div class="join w-full" role="radiogroup" aria-labelledby="djs-color-mode-label">
                <button type="button" class="btn btn-sm join-item flex-1" data-color-mode="light" role="radio" aria-checked="false">
                    <span class="material-symbols-outlined" aria-hidden="true">light_mode</span>
                    <?php esc_html_e("Light", "djs-wallstreet-pro"); ?>
                </button>
                <button type="button" class="btn btn-sm join-item flex-1" data-color-mode="dark" role="radio" aria-checked="false">
                    <span class="material-symbols-outlined" aria-hidden="true">dark_mode</span>
                    <?php esc_html_e("Dark", "djs-wallstreet-pro"); ?>
                </button>
                <button type="button" class="btn btn-sm join-item flex-1" data-color-mode="auto" role="radio" aria-checked="false">
                    <span class="material-symbols-outlined" aria-hidden="true">contrast</span>
                    <?php esc_html_e("System", "djs-wallstreet-pro"); ?>
                </button>
            </div>
        <?php } ?>
    </div>
</details>
