<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-meta-footer.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$is_WooCommerce = class_exists("WooCommerce") && (is_account_page() || is_cart() || is_checkout());

$article_datetime = '<span class="material-icons">calendar_today</span>' . get_the_date($current_setup->get("fulldatetimeformat"));
if (get_the_modified_date("Ymd") > get_the_date("Ymd")) {
    $article_datetime .= " (" . esc_html__("Last updated:", "djs-wallstreet-pro") . " " . get_the_modified_date($current_setup->get("fulldateformat")) . ")";
}
?>

<footer>
    <?php if (!is_single()) {
        wp_link_pages([
            "before" => '<div class="page-links">' . esc_html__("Page", "djs-wallstreet-pro"),
            "after" => "</div>",
        ]);
    } ?>

    <?php if ((is_single() && $current_setup->get("archive_page_meta_section_settings") == false) || (!is_single() && $current_setup->get("blog_meta_section_settings") == false) || (!is_page() && $current_setup->get("page_meta_section_settings") == false)) { ?>
    <div class="blog-post-meta">
        <a id="blog-author" href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>"><i
                class="fa fa-user-pen"></i> <?php the_author(); ?></a>
        <?php
            $tag_list = get_the_tag_list();
            if (!empty($tag_list)) { ?>
        <div class="blog-tags">
            <i class="fa fa-tags"></i><span><?php the_tags("", ", ", ""); ?></span>
        </div>
        <?php }
            ?>
        <?php
            $cat_list = get_the_category_list();
            if (!empty($cat_list)) { ?>
        <div class="blog-tags">
            <span class="material-icons">category</span><span><?php the_category(", "); ?></span>
        </div>
        <?php }
            ?>
    </div>
    <time
        datetime="<?php echo get_the_date($current_setup->get("technicalfulldatetimeformat")); ?>"><?php echo $article_datetime; ?></time>
    <?php } elseif (!$is_WooCommerce && is_page() && $current_setup->get("page_meta_section_settings") == false) { ?>
    <div class="blog-post-meta">
        <a id="blog-author" href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>"><i
                class="fa fa-user"></i><?php the_author(); ?></a>
    </div>
    <time
        datetime="<?php echo get_the_date($current_setup->get("technicalfulldatetimeformat")); ?>"><?php echo $article_datetime; ?></time>
    <?php } else { ?>
    <time datetime="<?php echo get_the_date($current_setup->get("technicalfulldatetimeformat")); ?>"></time>
    <?php } ?>
</footer>