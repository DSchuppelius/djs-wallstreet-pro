<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-meta-header.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$wrapper_classes = "";
$title_classes = "";
$no_clear = false;
$post_date = get_the_date("j") . "<small>" . get_the_date("M") . "</small>";
if (is_page_template("template-blog/blog-switcher-view.php") || is_page_template("template-blog/blog-switcher-view-sidebar.php") || is_page_template("template-blog/blog-list-view.php") || is_page_template("template-blog/blog-list-view-sidebar.php")) {
    $wrapper_classes = "full-width";
    $title_classes = "media-body";
    $no_clear = true;
    $post_date = get_the_date("d. F Y");
}
?>
<?php if (!$no_clear) { ?>
    <div class="clear"></div>
<?php } ?>
<div class="blog-post-title flex_stretch<?php echo !empty($title_classes) ? " " . $title_classes : ''; ?>">
    <?php if (is_meta_enabled("with_date")) { ?>
        <div class="blog-post-date"><span class="date" title="<?php echo get_the_date("d. F Y - H:i"); ?>"><?php echo $post_date; ?></span></time>
            <span class="comment"><i class="fa fa-comment"></i><?php comments_number("0", "1", "%"); ?></span>
        </div>
        <div class="blog-post-title-wrapper<?php echo !empty($wrapper_classes) ? " " . $wrapper_classes : ''; ?>">
    <?php } else { ?>
        <div class="blog-post-title-wrapper" style="width:100%;">
    <?php } ?>
    <?php if (has_post_format()) { ?> <div class="content-led <?php echo get_post_format(); ?>"></div><?php } ?>
    <article>