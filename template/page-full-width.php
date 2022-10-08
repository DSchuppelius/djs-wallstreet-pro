<?php
/* Template Name: Page Full Width (with date)
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page-full-width.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;

$theme_blog_section = "blog-detail-section";
?>
<!-- Page Title Section -->
<?php get_template_parts(["template-parts/index/index", "banner"], true); ?>
<!-- /Page Title Section -->
<!-- Blog & Sidebar Section -->
<div class="container page-full-width">
    <div class="row <?php row_frame_border(""); ?>">		
        <!--Blog Area-->
        <div class="col-md-12">
            <?php the_post(); ?>
            <?php get_template_part("template-parts/content/content"); ?>
            <?php comments_template("", true); ?>
        </div>		
        <!--/Blog Area-->
    </div>
</div>
<?php get_footer(); ?>
