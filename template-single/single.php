<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "blog-detail-section";
get_template_part("template-parts/index/index", "banner");
?>
<div class="container single">
    <div class="row <?php row_frame_border(""); ?> flexstretch">
        <div class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?> flexcolumn">
            <?php while (have_posts()) {
                the_post();
                get_template_part("template-parts/content/content", "single");
            }
            comments_template("", true);
            get_template_part("template-parts/content/filler");
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
