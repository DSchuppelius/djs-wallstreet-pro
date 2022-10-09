<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : search.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $wp_query;
global $theme_blog_section;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "blog-section-left";
?>
<!-- Page Title Section -->
<?php get_template_parts(["template-parts/index/index", "banner"], true); ?>
<!-- /Page Title Section -->

<!-- Blog & Sidebar Section -->
<div class="container search">
    <div class="row <?php row_frame_border(""); ?> flexstretch">
        <div class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?> flexcolumn<?php values_on_current_option("flexelements", " fill"); ?>">
            <?php if (have_posts()) { ?>
                <h1 class="search_heading">
                    <?php printf(esc_html__("Search results for: %s", "djs-wallstreet-pro"), '<span>"' . get_search_query() . '"</span>'); ?>
                </h1>
                <?php while (have_posts()) {
                    the_post();
                    get_template_part("template-parts/content/content", $current_setup->get("blog_template_content_excerpt_get_setting"));
                } ?>
                <?php if($wp_query->found_posts > 1) { ?>
                <div class="blog-pagination">
                    <?php next_posts_link(esc_html__("Previous", "djs-wallstreet-pro")); ?>
                    <?php previous_posts_link(esc_html__("Next", "djs-wallstreet-pro")); ?>
                </div>
                <?php } ?>
            <?php } else { ?>
                <div class="search_error">
                    <div class="search_err_heading"><h2><?php esc_html_e("Nothing Found", "djs-wallstreet-pro"); ?></h2></div>
                    <div class="wallstreet_searching">
                        <p><?php esc_html_e("Sorry, but nothing matched your search criteria. Please try again with some different keywords.", "djs-wallstreet-pro"); ?></p>
                    </div>	
                </div>
                <?php get_search_form(); ?>
            <?php }
            get_template_part("template-parts/content/filler"); ?>
        </div><!--/Blog Area-->
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
<!-- /Blog & Sidebar Section -->		
