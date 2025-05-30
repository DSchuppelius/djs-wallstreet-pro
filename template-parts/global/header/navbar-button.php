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
    <button class="not text_decrease material-icons" onclick="adjustFontSize(-1)">A-</button>
    <button class="not format_letter_spacing_standard material-icons" onclick="resetFontSize()">A</button>
    <button class="not text_increase material-icons" onclick="adjustFontSize(1)">A+</button>
</div>