<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : navbar-button.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<button type="button" class="btn navbar-toggle collapsed" data-toggle="collapse"
    data-target="#bs-example-navbar-collapse-1"><?php esc_html_e("Menu", "djs-wallstreet-pro"); ?></button>
<div class="font-size-controls">
    <button class="not text_decrease material-icons" title="Schrift verkleinern" onclick="adjustFontSize(-1)">
        <span class="material-symbols-outlined">text_decrease</span>
    </button>

    <!-- Standard-Button (immer sichtbar) -->
    <button class="not reset material-icons short-btn-green" title="Standardschrift wiederherstellen"
        onclick="resetFontSize()">
        <span class="material-symbols-outlined">settings_accessibility</span>
        <span class="material-symbols-outlined">restart_alt</span>
    </button>

    <button class="not text_increase material-icons" title="Schrift vergrößern" onclick="adjustFontSize(1)">
        <span class="material-symbols-outlined">text_increase</span>
    </button>
</div>
