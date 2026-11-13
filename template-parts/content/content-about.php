<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-about.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Inhalt der Ueber-uns-Seite (ohne Datum).
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--about surface-card"); ?>>
    <div class="entry__body">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php wp_link_pages([
            "before" => '<nav class="page-links" aria-label="' . esc_attr__("Page", "djs-wallstreet-pro") . '"><span>' . esc_html__("Page", "djs-wallstreet-pro") . ":</span>",
            "after"  => "</nav>",
        ]); ?>
    </div>
</article>
