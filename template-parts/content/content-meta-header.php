<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-meta-header.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Kopfzeile eines Beitrags: Format, Datum, Kommentaranzahl.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$format_label  = djs_post_format_label();
$show_date     = djs_show_post_date();
$show_comments = djs_show_post_meta() && (comments_open() || get_comments_number() > 0) && post_type_supports(get_post_type(), "comments");

if ($format_label === "" && !$show_date && !$show_comments && !is_sticky()) {
    return;
} ?>

<div class="post-meta post-meta--top">
    <?php if (is_sticky() && !is_single()) { ?>
        <span class="badge badge-sm badge-warning post-meta__sticky">
            <span class="material-icons" aria-hidden="true">push_pin</span><?php esc_html_e("Featured", "djs-wallstreet-pro"); ?>
        </span>
    <?php } ?>

    <?php if ($format_label !== "") { ?>
        <a class="badge badge-sm badge-soft badge-primary post-meta__format format-<?php echo esc_attr(get_post_format() ?: "standard"); ?>"
            href="<?php echo esc_url(get_post_format() ? get_post_format_link(get_post_format()) : get_permalink()); ?>">
            <span class="material-icons" aria-hidden="true"><?php echo esc_html(djs_post_format_icon()); ?></span><?php echo esc_html($format_label); ?>
        </a>
    <?php } ?>

    <?php if ($show_date) { ?>
        <time class="post-meta__date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"
            title="<?php echo esc_attr(get_the_date($current_setup->get("fulldatetimeformat"))); ?>">
            <span class="material-icons" aria-hidden="true">calendar_today</span><?php echo esc_html(get_the_date($current_setup->get("fulldateformat"))); ?>
        </time>
    <?php } ?>

    <?php if ($show_comments) { ?>
        <a class="post-meta__comments" href="<?php comments_link(); ?>">
            <span class="material-icons" aria-hidden="true">chat_bubble_outline</span><?php
            /* translators: %s: number of comments */
            echo esc_html(sprintf(_n("%s comment", "%s comments", get_comments_number(), "djs-wallstreet-pro"), number_format_i18n(get_comments_number()))); ?>
        </a>
    <?php } ?>
</div>
