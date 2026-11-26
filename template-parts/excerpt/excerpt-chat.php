<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-chat.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Auszug fuer das Format "Chat": die ersten beiden Absaetze.
 * Titel und Meta gibt die Beitragskarte aus (template-parts/content/content.php).
 */

$content = get_the_content();
if (has_block("core/paragraph", $content)) {
    twenty_twenty_one_print_first_instance_of_block("core/paragraph", $content, 2);
} else {
    the_content();
}
