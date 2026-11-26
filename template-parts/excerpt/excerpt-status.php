<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-status.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Format "Status": Inhalt als Terminal-Anzeige mit Zeichenzaehler (255 Zeichen je Seite).
 * Titel und Meta gibt die Beitragskarte aus (template-parts/content/content.php).
 */

$content        = wp_strip_all_tags(get_the_content());
$content_length = mb_strlen($content);
$pages          = intdiv($content_length, 255) + 1; ?>
<div class="status-screen">
    <p class="status-screen__text"><?php echo esc_html($content); ?></p>
    <small class="status-screen__count"><?php echo esc_html($content_length); ?> / 255<?php echo $content_length > 255 ? " (" . esc_html($pages) . ")" : ""; ?></small>
</div>
