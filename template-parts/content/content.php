<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Beitragskarte in Listen (Blog, Archiv, Suche).
 *
 * $args:
 *   mode     "excerpt" (Customizer-Standard), "content" oder "teaser" (Startseite)
 *   variant  stack | media | media-reverse | compact
 *   first    erster Beitrag der Liste (bekommt ein groesseres Bild)
 */

$mode    = $args["mode"] ?? (DJS_Wallstreet_Pro_Theme_Setup::instance()->get("blog_template_content_excerpt_get_setting") === "content" ? "content" : "excerpt");
$variant = $args["variant"] ?? "stack";
$first   = !empty($args["first"]);

$has_thumb = has_post_thumbnail() && !post_password_required();
$classes   = ["post-card", "surface-card", "reveal", "post-card--" . $variant];
if (!$has_thumb) {
    $classes[] = "has_no_post_thumbnail";
}
if ($first) {
    $classes[] = "first";
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <?php if ($has_thumb) { ?>
        <a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail($variant === "compact" ? "index-thumb" : "blog-thumb", [
                "class"   => "post-card__img",
                "loading" => $first ? "eager" : "lazy",
                "alt"     => "",
            ]); ?>
        </a>
    <?php } ?>

    <div class="post-card__body">
        <header class="post-card__header">
            <?php get_template_part("template-parts/content/content", "meta-header"); ?>
            <h2 class="post-card__title entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </header>

        <?php if ($mode === "teaser") { ?>
            <div class="post-card__content entry-summary">
                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28, " …")); ?></p>
                <?php the_read_more(); ?>
            </div>
        <?php } elseif ($mode === "content") { ?>
            <div class="post-card__content entry-content">
                <?php the_content(esc_html__("Read More", "djs-wallstreet-pro")); ?>
            </div>
        <?php } else { ?>
            <div class="post-card__content entry-summary entry-content">
                <?php get_template_part("template-parts/excerpt/excerpt", get_post_format()); ?>
            </div>
        <?php } ?>

        <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
    </div>
</article>
