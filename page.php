<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;

$current_options = get_current_options();
$theme_blog_section = "blog-detail-section";

$is_WooCommerce = class_exists("WooCommerce") && (is_account_page() || is_cart() || is_checkout());

get_template_parts(["template-parts/index/index", "banner"], true);
?>
<div class="container page">
	<div class="row <?php row_Frame_Border(); ?> flexstretch">
		<?php if ($is_WooCommerce) { ?>
			<div class="col-md-<?php echo !is_active_sidebar("woocommerce") ? "12" : "8"; ?> flexcolumn"> 
		<?php } else { ?>
			<div class="col-md-<?php echo !is_active_sidebar("sidebar_primary") ? "12" : "8"; ?> flexcolumn">
		<?php } ?>
				<main class="content-section <?php echo $current_options["addflexelements"] ? "with_filler" : "no_filler"; ?>">
					<?php the_post(); ?>
					<?php get_template_part("template-parts/content/content", get_theme_mod("display_excerpt_or_full_post", "excerpt")); ?>
				</main>
				<?php comments_template("", true); ?>
				<?php if ($current_options["addflexelements"]) { ?>
					<div class="content-section columnfiller<?php innerrow_Frame_Border(" "); ?>"></div>
				<?php } ?>
			</div>
		<?php if ($is_WooCommerce) {
      get_sidebar("woocommerce");
  } else {
      get_sidebar();
  } ?>
	</div>
</div>
<?php get_footer(); ?>