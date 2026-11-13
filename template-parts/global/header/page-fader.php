<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page-fader.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Ladeblende (Customizer "Fader beim Seitenwechsel"). Ohne JavaScript bleibt sie
 * unsichtbar (Klasse .js wird erst per Skript gesetzt), statt die Seite zu verdecken.
 */
?>
<script>document.documentElement.classList.add("js", "has-page-fader");</script>
<div id="page_fader" class="page-fader" aria-hidden="true">
    <div class="page-fader__card <?php row_frame_border(""); ?>">
        <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
        <p class="page-fader__text"><?php esc_html_e("Loading content...", "djs-wallstreet-pro"); ?></p>
        <span class="page-fader__bar"></span>
    </div>
</div>
