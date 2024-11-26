<?php
/* Template Name: Page Full Width (without meta)
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page-full-width.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;

$theme_blog_section = "blog-detail-section no-meta";
?>
<?php get_template_parts(["template-parts/index/index", "banner"], true); ?>
<div class="container page-full-width">
    <div class="row <?php row_frame_border(""); ?>">
        <div class="col-md-12">
            <?php the_post(); ?>
            <?php get_template_part("template-parts/content/content"); ?>
            <?php comments_template("", true); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>