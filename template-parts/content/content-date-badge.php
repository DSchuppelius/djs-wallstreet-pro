<?php
/*
 * Created on   : Fri Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-date-badge.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Datums-Plakette links neben dem Beitrag (Tag, Monat, Kommentaranzahl) - das
 * Erkennungszeichen der Blog-Ansicht seit den ersten Theme-Versionen.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$count         = (int) get_comments_number();
$linked        = comments_open() || $count > 0; // Zahl immer zeigen (wie bisher), verlinken nur wenn sinnvoll
$label         = sprintf(
    /* translators: %s: number of comments */
    _n("%s comment", "%s comments", $count, "djs-wallstreet-pro"),
    number_format_i18n($count)
); ?>

<div class="post-date-badge blog-post-date">
    <time class="post-date-badge__date date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"
        title="<?php echo esc_attr(get_the_date($current_setup->get("fulldatetimeformat"))); ?>">
        <span class="post-date-badge__day"><?php echo esc_html(get_the_date("j")); ?></span>
        <span class="post-date-badge__month"><?php echo esc_html(get_the_date("M")); ?></span>
    </time>
    <?php if ($linked) { ?>
        <a class="post-date-badge__comments comment" href="<?php comments_link(); ?>" aria-label="<?php echo esc_attr($label); ?>">
            <i class="fa-regular fa-comment" aria-hidden="true"></i><?php echo esc_html(number_format_i18n($count)); ?>
        </a>
    <?php } else { ?>
        <span class="post-date-badge__comments comment">
            <i class="fa-regular fa-comment" aria-hidden="true"></i><span aria-hidden="true"><?php echo esc_html(number_format_i18n($count)); ?></span><span class="screen-reader-text"><?php echo esc_html($label); ?></span>
        </span>
    <?php } ?>
</div>
