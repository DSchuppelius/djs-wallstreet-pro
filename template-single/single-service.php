<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Einzelansicht eines Services (Header/Footer laedt single.php).
 */

get_template_part("template-parts/index/index", "banner");

djs_layout_start(["class" => "single service"]);

while (have_posts()) {
    the_post();
    $item  = djs_service_item();
    $badge = djs_show_post_date(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--service surface-card"); ?>>
        <?php if (has_post_thumbnail()) { ?>
            <figure class="entry__media"><?php the_post_thumbnail("bigpost-thumb", ["class" => "entry__img", "loading" => "eager", "fetchpriority" => "high"]); ?></figure>
        <?php } ?>
        <?php /* Wie bisher: Datums-Plakette, daneben der Titel, darunter die Beschreibung */ ?>
        <div class="entry__body<?php echo $badge ? " has-date-badge" : ""; ?>">
            <?php if ($badge) {
                get_template_part("template-parts/content/content", "date-badge");
            } ?>
            <header class="entry__header">
                <?php if ($item["icon"]) { ?>
                    <span class="service-card__icon entry__icon" aria-hidden="true"><i class="fa <?php echo esc_attr($item["icon"]); ?>"></i></span>
                <?php } ?>
                <?php /* Titel steht als <h1> im Banner; im Beitrag wie bisher neben der Plakette wiederholt */ ?>
                <p class="entry__title post-card__title" aria-hidden="true"><?php the_title(); ?></p>
            </header>
            <div class="entry-content">
                <?php if ($item["text"] !== "") { ?>
                    <p><?php echo $item["text"]; ?></p>
                <?php } ?>
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages([
                "before" => '<nav class="page-links" aria-label="' . esc_attr__("Page", "djs-wallstreet-pro") . '"><span>' . esc_html__("Page", "djs-wallstreet-pro") . ":</span>",
                "after"  => "</nav>",
            ]); ?>
            <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
        </div>
    </article>
    <?php get_template_part("template-parts/content/content", "author");
    comments_template("", true);
}

djs_layout_end();
