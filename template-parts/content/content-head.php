<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-head.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;
global $only_one_post;
global $first_post;
global $no_thumb;

$local_theme_blog_section = $theme_blog_section;
if ($first_post) {
    $local_theme_blog_section .= " first";
}
if ($only_one_post) {
    $local_theme_blog_section .= " one";
}
$has_thumbnail = has_post_thumbnail();

if (!$has_thumbnail) {
    $local_theme_blog_section .= " has_no_post_thumbnail";
}
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class($local_theme_blog_section . get_innerrow_frame_border(" ")); ?>>
        <?php if ($has_thumbnail && !$no_thumb) { ?>
            <?php $defalt_arg = [
                "class" => "img-responsive attachment-post-thumbnail",
            ]; ?>
            <div class="blog-post-img">
                <?php if (is_single()) { ?>
	               	<a href="<?php echo esc_url(get_attachment_link(get_post_thumbnail_id())); ?>" target="_blank"><?php echo the_post_thumbnail("bigpost-thumb", $defalt_arg); ?></a>
    			<?php } else { ?>
                    <a href="<?php the_permalink(); ?>" target="_self"><?php the_post_thumbnail("blog-thumb", $defalt_arg); ?></a>                
                <?php } ?>
            </div>
        <?php } ?>
