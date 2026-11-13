<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-gallery.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Auszug fuer das Format "Galerie": erste Galerie.
 * Titel und Meta gibt die Beitragskarte aus (template-parts/content/content.php).
 */

$content = get_the_content();
if (has_block("core/gallery", $content)) {
    twenty_twenty_one_print_first_instance_of_block("core/gallery", $content);
} elseif (has_block("jetpack/tiled-gallery", $content)) {
    twenty_twenty_one_print_first_instance_of_block("jetpack/tiled-gallery", $content);
} else {
    the_content();
}
