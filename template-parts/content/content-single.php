<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Einzelbeitrag. Der Titel steht als <h1> im Seitenbanner.
 */

$has_thumb = has_post_thumbnail() && !post_password_required(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--single surface-card"); ?>>
    <?php if ($has_thumb) { ?>
        <figure class="entry__media">
            <a href="<?php echo esc_url(get_attachment_link(get_post_thumbnail_id())); ?>">
                <?php the_post_thumbnail("bigpost-thumb", ["class" => "entry__img", "loading" => "eager", "fetchpriority" => "high"]); ?>
            </a>
            <?php if ($caption = get_the_post_thumbnail_caption()) { ?>
                <figcaption><?php echo wp_kses_post($caption); ?></figcaption>
            <?php } ?>
        </figure>
    <?php } ?>

    <div class="entry__body">
        <header class="entry__header">
            <?php get_template_part("template-parts/content/content", "meta-header"); ?>
        </header>

        <?php if (has_post_format("status")) { ?>
            <?php get_template_part("template-parts/excerpt/excerpt", "status"); ?>
        <?php } else { ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php } ?>

        <?php wp_link_pages([
            "before" => '<nav class="page-links" aria-label="' . esc_attr__("Page", "djs-wallstreet-pro") . '"><span>' . esc_html__("Page", "djs-wallstreet-pro") . ":</span>",
            "after"  => "</nav>",
        ]); ?>

        <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
    </div>
</article>

<?php get_template_part("template-parts/content/content", "author");

if (!post_password_required() && get_post_type() === "post") {
    the_post_navigation([
        "class"     => "post-nav",
        "prev_text" => '<span class="post-nav__label">' . esc_html__("Previous post", "djs-wallstreet-pro") . '</span><span class="post-nav__title">%title</span>',
        "next_text" => '<span class="post-nav__label">' . esc_html__("Next post", "djs-wallstreet-pro") . '</span><span class="post-nav__title">%title</span>',
    ]);
}
