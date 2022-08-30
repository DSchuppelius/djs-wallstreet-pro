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

$current_options = get_current_options();
$theme_blog_section = "blog-section-left";
?>
<!-- Page Title Section -->
<?php get_template_parts(["template-parts/index/index", "banner"], true); ?>
<!-- /Page Title Section -->

<!-- Blog & Sidebar Section -->
<div class="container search">
	<div class="row rellax <?php row_Frame_Border(""); ?> flexstretch" data-rellax-speed="4">
		<div class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?> flexcolumn">
			<?php if (have_posts()) { ?>
				<h1 class="search_heading">
					<?php printf(__("Search results for: %s", "wallstreet"), '<span>"' . get_search_query() . '"</span>'); ?>
				</h1>
				$only_one_post = ;
				<?php while (have_posts()) {
                    the_post();
                    get_template_part("template-parts/content/content", get_theme_mod("display_excerpt_or_full_post", "excerpt"));
                } ?>
				<?php if($wp_query->found_posts > 1) { ?>
				<div class="blog-pagination">
					<?php next_posts_link(__("Previous", "wallstreet")); ?>
					<?php previous_posts_link(__("Next", "wallstreet")); ?>
				</div>
				<?php } ?>
			<?php } else { ?>
				<div class="search_error">
					<div class="search_err_heading"><h2><?php _e("Nothing Found", "wallstreet"); ?></h2></div>
					<div class="wallstreet_searching">
						<p><?php _e("Sorry, but nothing matched your search criteria. Please try again with some different keywords.", "wallstreet"); ?></p>
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
