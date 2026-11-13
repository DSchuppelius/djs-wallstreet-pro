<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-meta-footer.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Fusszeile eines Beitrags: Autor, Kategorien, Schlagwoerter, Aktualisierungsdatum.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

if (class_exists("WooCommerce") && (is_account_page() || is_cart() || is_checkout())) {
    return;
}
if (!djs_show_post_meta()) {
    return;
}

$is_post  = get_post_type() === "post";
$cats     = $is_post ? get_the_category_list(", ") : "";
$tags     = $is_post ? get_the_tag_list("", ", ", "") : "";
$updated  = get_the_modified_date("Ymd") > get_the_date("Ymd");
$show_date = djs_show_post_date(); ?>

<footer class="post-meta post-meta--bottom">
    <a class="post-meta__author" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta("ID"))); ?>" rel="author">
        <?php echo get_avatar(get_the_author_meta("ID"), 28, "", "", ["class" => "post-meta__avatar"]); ?>
        <span><?php the_author(); ?></span>
    </a>

    <?php if ($cats) { ?>
        <span class="post-meta__terms">
            <span class="material-icons" aria-hidden="true">category</span><span class="screen-reader-text"><?php esc_html_e("Categories", "djs-wallstreet-pro"); ?>:</span><?php echo $cats; ?>
        </span>
    <?php } ?>

    <?php if ($tags && !is_wp_error($tags)) { ?>
        <span class="post-meta__terms">
            <span class="material-icons" aria-hidden="true">sell</span><span class="screen-reader-text"><?php esc_html_e("Tags", "djs-wallstreet-pro"); ?>:</span><?php echo $tags; ?>
        </span>
    <?php } ?>

    <?php if ($show_date && $updated && is_singular()) { ?>
        <span class="post-meta__updated">
            <span class="material-icons" aria-hidden="true">update</span><?php esc_html_e("Last updated:", "djs-wallstreet-pro"); ?>
            <time datetime="<?php echo esc_attr(get_the_modified_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_modified_date($current_setup->get("fulldateformat"))); ?></time>
        </span>
    <?php } ?>
</footer>
