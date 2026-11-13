<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-complete.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seiteninhalt (page.php und die Seitentemplates). Titel steht im Seitenbanner.
 */

$has_thumb = has_post_thumbnail() && !post_password_required(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--page surface-card"); ?>>
    <?php if ($has_thumb) { ?>
        <figure class="entry__media">
            <?php the_post_thumbnail("fullpost-thumb", ["class" => "entry__img", "loading" => "eager", "fetchpriority" => "high"]); ?>
        </figure>
    <?php } ?>

    <div class="entry__body">
        <?php get_template_part("template-parts/content/content", "meta-header"); ?>

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
