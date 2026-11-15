<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Portfolio der Startseite. Customizer: portfolio_list (Anzahl), portfolio_homepage_column_layouts
 * (Spaltenbreite), portfolio_homepage_item_layouts (single/block/clover-items = Rundungen je Position),
 * view_all_projects_btn_enabled.
 */

$pt = djs_pt();
if (!$pt || !defined("PORTFOLIO_POST_TYPE")) {
    return;
}
djs_use_script("lightbox");

$columns = djs_cols_from_colmd($pt->get("portfolio_homepage_column_layouts"), 4);
$layout  = (string) $pt->get("portfolio_homepage_item_layouts");
// Wie bisher: "clover" nur bei vier Spalten, "block" verbindet jede Reihe zu einem Band, sonst rundum gerundet
$shape   = $layout === "clover-items" && $columns === 4 ? "clover" : ($layout === "block-items" ? "block" : "");
$query   = new WP_Query([
    "post_type"           => PORTFOLIO_POST_TYPE,
    "posts_per_page"      => (int) $pt->get("portfolio_list") ?: 8,
    "no_found_rows"       => true,
    "ignore_sticky_posts" => true,
]); ?>

<section class="section portfolio-section site-wrap">
    <?php djs_section_heading($pt->get("portfolio_title"), $pt->get("portfolio_description")); ?>

    <div class="card-grid card-grid--<?php echo min(4, $columns); ?> portfolio-grid">
        <?php if ($query->have_posts()) {
            $i = 0;
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part("template-parts/portfolio/card", null, [
                    "item"   => djs_portfolio_item(null, "port-thumb", $columns >= 4 ? 15 : 30),
                    "button" => (string) get_post_meta(get_the_ID(), "portfolio_project_button_text", true),
                    "shape"  => $shape,
                    "index"  => $i++,
                ]);
            }
            wp_reset_postdata();
        } else {
            for ($i = 1; $i <= 4; $i++) {
                get_template_part("template-parts/portfolio/card", null, ["item" => [
                    "id" => 0, "title" => "Lorem ipsum", "excerpt" => "", "url" => "#", "new_tab" => false, "show_image" => false, "full" => "",
                    "button_url" => "#", "button_tab" => false, "summary" => __("Detail", "djs-wallstreet-pro"),
                    "image" => '<img class="portfolio-card__img" src="' . esc_url(THEME_ASSETS_PATH_URI . "/images/portfolio/port" . $i . ".jpg") . '" alt="" loading="lazy">',
                ], "shape" => $shape, "index" => $i]);
            }
        } ?>
    </div>

    <?php if ($pt->get("view_all_projects_btn_enabled")) {
        the_show_all($pt->get("portfolio_more_link"), $pt->get("portfolio_more_text"), $pt->get("portfolio_more_link_target"), "project");
    } ?>
</section>
