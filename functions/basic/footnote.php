<?php
/*
 * Created on   : Tue Nov 12 2024
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : footnote.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// Funktion zur Anpassung der Fußnoten-Links in <sup>- und <ol>-Elementen
function adjust_footnote_links($content) {
    // Aktuellen Beitrag und Permalink ermitteln
    if (is_single()) {
        $post_url = get_permalink(); // Aktueller Permalink des Beitrags
    } else {
        return $content; // Keine Änderungen bei Nicht-Beiträgen
    }

    // Anpassung der Links in <sup>-Tags mit Klasse fn und data-fn Attribut (Rückverweise)
    $content = preg_replace_callback(
        '/<sup data-fn="([^"]+)" class="fn"><a href="([^"]+)" id="([^"]+)-link">/',
        function($matches) use ($post_url) {
            $data_fn = $matches[1]; // Extrahiere den data-fn Wert
            $href = $matches[2];
            $id = $matches[3];
            $corrected_href = esc_url($post_url . $href);
            return '<sup data-fn="' . $data_fn . '" class="fn"><a href="' . $corrected_href . '" id="' . $id . '-link">';
        },
        $content
    );

    // Anpassung der Links im <ol>-Tag mit Klasse wp-block-footnotes (nur Rücksprunglinks)
    $content = preg_replace_callback(
        '/<ol class="wp-block-footnotes">(.*?)<\/ol>/s',
        function($matches) use ($post_url) {
            $footnotes_content = $matches[1];
            // Anpassen der Rücksprung-Links in den Fußnoten
            $footnotes_content = preg_replace_callback(
                '/<a href="([^"]+)" aria-label="Zur Fußnotenreferenz (\d+) navigieren">↩︎<\/a>/',
                function($sub_matches) use ($post_url) {
                    $href = $sub_matches[1];
                    preg_match('/#([a-z0-9\-]+)-link$/', $href, $id_matches);
                    $id = $id_matches[1] ?? '';
                    $corrected_href = esc_url($post_url . '#' . $id . '-link');
                    return '<a href="' . $corrected_href . '" aria-label="Zur Fußnotenreferenz ' . $sub_matches[2] . ' navigieren">↩︎</a>';
                },
                $footnotes_content
            );
            return '<ol class="wp-block-footnotes">' . $footnotes_content . '</ol>';
        },
        $content
    );

    return $content;
}

// Filter anwenden, um die Fußnoten-Links anzupassen
add_filter('the_content', 'adjust_footnote_links');