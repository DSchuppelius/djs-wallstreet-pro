<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-about.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Inhalt der Ueber-uns-Seite: Titel, Text, Autor + Datum (ohne Datums-Plakette).
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--about surface-card"); ?>>
    <div class="entry__body">
        <header class="entry__header">
            <?php /* Titel steht als <h1> im Banner; im Inhalt wie bisher wiederholt */ ?>
            <p class="entry__title post-card__title" aria-hidden="true"><?php the_title(); ?></p>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php wp_link_pages([
            "before" => '<nav class="page-links" aria-label="' . esc_attr__("Page", "djs-wallstreet-pro") . '"><span>' . esc_html__("Page", "djs-wallstreet-pro") . ":</span>",
            "after"  => "</nav>",
        ]); ?>

        <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
    </div>
</article>
