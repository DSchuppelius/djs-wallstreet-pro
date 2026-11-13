<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-link.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Auszug fuer das Format "Link": erster Absatz oder Embed.
 * Titel und Meta gibt die Beitragskarte aus (template-parts/content/content.php).
 */

$content = get_the_content();
if (has_block("core/paragraph", $content)) {
    twenty_twenty_one_print_first_instance_of_block("core/paragraph", $content);
} elseif (has_block("core/embed", $content)) {
    twenty_twenty_one_print_first_instance_of_block("core/embed", $content);
} else {
    the_content();
}
