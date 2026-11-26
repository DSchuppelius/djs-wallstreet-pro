<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Standard-Auszug mit Customizer-Laenge (Zeichen) und Weiterlesen-Button.
 * Titel und Meta gibt die Beitragskarte aus (template-parts/content/content.php).
 */

$current_setup  = DJS_Wallstreet_Pro_Theme_Setup::instance();
$excerpt_laenge = (int) $current_setup->get("blog_template_content_excerpt_length");
$content        = get_the_content();

if (preg_match('/<!--more(.*?)?-->/', get_post_field("post_content", get_the_ID()))) {
    // Manueller Weiterlesen-Trenner: Inhalt bis zum Trenner, der Button kommt aus the_content_more_link.
    the_content();
} else {
    $excerpt  = get_the_excerpt();
    $klartext = strip_all($excerpt);
    if ($klartext !== "") {
        if ($excerpt_laenge > 0 && mb_strlen($klartext) > $excerpt_laenge) {
            echo apply_filters("the_excerpt", rtrim(mb_substr($klartext, 0, $excerpt_laenge)) . " …");
            the_read_more();
        } else {
            echo apply_filters("the_excerpt", $excerpt);
            // mb_strlen auf beiden Seiten, damit der Vergleich nicht an Umlauten haengt.
            if (mb_strlen($klartext) < mb_strlen(strip_all($content))) {
                the_read_more();
            }
        }
    } else {
        the_content();
    }
}
