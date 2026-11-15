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
 * Der leuchtende Rahmen (SVG) zeigt den Ladefortschritt, theme.js setzt --p.
 */
?>
<script>document.documentElement.classList.add("js", "has-page-fader");</script>
<div id="page_fader" class="page-fader" aria-hidden="true">
    <div class="page-fader__card <?php row_frame_border(""); ?>">
        <svg class="page-fader__frame" focusable="false">
            <rect class="page-fader__track" width="100%" height="100%" rx="8" pathLength="100" />
            <rect class="page-fader__progress" width="100%" height="100%" rx="8" pathLength="100" />
            <rect class="page-fader__glint" width="100%" height="100%" rx="8" pathLength="100" />
        </svg>
        <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
        <p class="page-fader__text"><?php esc_html_e("Loading content...", "djs-wallstreet-pro"); ?></p>
    </div>
</div>
