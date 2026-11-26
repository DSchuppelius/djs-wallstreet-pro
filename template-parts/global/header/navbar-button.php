<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : navbar-button.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Barrierefreiheit wie bisher: kleines Kaestchen am rechten Rand der Kopfleiste mit dem
 * Barrierefreiheits-Symbol; bei Hover/Fokus fahren Schrift kleiner, Zuruecksetzen und Schrift
 * groesser aus - und, falls im Customizer erlaubt, die Wahl des Farbschemas.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$font_controls = (bool) $current_setup->get("font_size_controls_enabled");
$color_toggle  = djs_color_mode_toggle_enabled();

if (!$font_controls && !$color_toggle) {
    return;
}

$color_modes = [
    "light" => ["light_mode", __("Light", "djs-wallstreet-pro")],
    "dark"  => ["dark_mode", __("Dark", "djs-wallstreet-pro")],
    "auto"  => ["contrast", __("System", "djs-wallstreet-pro")],
]; ?>

<div class="site-a11y">
    <div class="font-size-controls" role="group" aria-label="<?php esc_attr_e("Display settings", "djs-wallstreet-pro"); ?>">
        <?php if ($font_controls) { ?>
            <button type="button" class="text_decrease" data-font-size="-1" title="<?php esc_attr_e("Decrease font size", "djs-wallstreet-pro"); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">text_decrease</span>
                <span class="screen-reader-text"><?php esc_html_e("Decrease font size", "djs-wallstreet-pro"); ?></span>
            </button>
            <button type="button" class="reset anchor" data-font-size="0" title="<?php esc_attr_e("Reset font size", "djs-wallstreet-pro"); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">settings_accessibility</span>
                <span class="material-symbols-outlined" aria-hidden="true">restart_alt</span>
                <span class="screen-reader-text"><?php esc_html_e("Reset font size", "djs-wallstreet-pro"); ?></span>
            </button>
            <button type="button" class="text_increase" data-font-size="1" title="<?php esc_attr_e("Increase font size", "djs-wallstreet-pro"); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">text_increase</span>
                <span class="screen-reader-text"><?php esc_html_e("Increase font size", "djs-wallstreet-pro"); ?></span>
            </button>
        <?php } ?>

        <?php if ($color_toggle) { ?>
            <div class="font-size-controls__modes" role="radiogroup" aria-label="<?php esc_attr_e("Color scheme", "djs-wallstreet-pro"); ?>">
                <?php foreach ($color_modes as $mode => [$icon, $label]) {
                    // Ohne Schriftgroessen-Knoepfe steht "System" als sichtbarer Knopf im Kaestchen
                    $anchor = !$font_controls && $mode === "auto" ? " anchor" : ""; ?>
                    <button type="button" class="color_mode<?php echo $anchor; ?>" data-color-mode="<?php echo esc_attr($mode); ?>" role="radio" aria-checked="false" title="<?php echo esc_attr($label); ?>">
                        <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html($icon); ?></span>
                        <span class="screen-reader-text"><?php echo esc_html($label); ?></span>
                    </button>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
