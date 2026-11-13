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
    $item = djs_service_item(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--service surface-card"); ?>>
        <?php if (has_post_thumbnail()) { ?>
            <figure class="entry__media"><?php the_post_thumbnail("bigpost-thumb", ["class" => "entry__img", "loading" => "eager"]); ?></figure>
        <?php } ?>
        <div class="entry__body">
            <?php if ($item["icon"]) { ?>
                <span class="service-card__icon entry__icon" aria-hidden="true"><i class="fa <?php echo esc_attr($item["icon"]); ?>"></i></span>
            <?php } ?>
            <?php if ($item["text"] !== "") { ?>
                <p class="entry__lead"><?php echo $item["text"]; ?></p>
            <?php } ?>
            <div class="entry-content"><?php the_content(); ?></div>
            <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
        </div>
    </article>
    <?php comments_template("", true);
}

djs_layout_end();
