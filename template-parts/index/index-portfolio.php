<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<!-- AddThis Button END -->
<div class="portfolio-section">
    <div class="container">
        <?php
        $current_options = get_current_options();
        if (!empty($current_options["portfolio_title"]) || !empty($current_options["portfolio_description"])): ?>
            <div class="row">
                <div class="section_heading_title">
                    <?php if ($current_options["portfolio_title"]) { ?>
                        <h1><?php echo $current_options["portfolio_title"]; ?></h1>
                        <div class="pagetitle-separator">
                            <div class="pagetitle-separator-border">
                                <div class="pagetitle-separator-box"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($current_options["portfolio_description"]) { ?>
                        <p><?php echo $current_options["portfolio_description"]; ?></p>
                    <?php } ?>				
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php
            $j = 1;
            $col_count = $current_options["portfolio_homepage_column_layouts"] == 3 ? 4 : ($current_options["portfolio_homepage_column_layouts"] == 4 ? 3 : 2);
            $total_portfolio = $current_options["portfolio_list"];
            $args = [
                "post_type" => PORTFOLIO_POST_TYPE,
                "posts_per_page" => $total_portfolio,
            ];
            $portfolio = new WP_Query($args);
            if ($portfolio->have_posts()) {
                while ($portfolio->have_posts()):

                    $portfolio->the_post();
                    $portfolio_row_pos = get_first_middle_last_row($j, $portfolio->post_count, $col_count, " ");
                    $portfolio_odd_row = get_odd_even_row($j, $portfolio->post_count, $col_count, " ");
                    $portfolio_item_pos = get_first_middle_last($j, $portfolio->post_count, " ");
                    $portfolio_item_type = $current_options["portfolio_homepage_item_layouts"];
                    if($col_count != 4 && $current_options["portfolio_homepage_item_layouts"] == "clover-items")
                        $portfolio_item_type = null;

                    if (get_post_meta(get_the_ID(), "meta_project_link", true)) {
                        $meta_project_link = get_post_meta(get_the_ID(), "meta_project_link", true);
                    } else {
                        $meta_project_link = get_post_permalink();
                    } ?>
                    <div class="col-md-<?php echo $current_options["portfolio_homepage_column_layouts"]; ?> home-portfolio-area">
                        <div class="home-portfolio-showcase">
                            <div class="home-portfolio-showcase-media count<?php echo $j; echo $portfolio_odd_row. $portfolio_item_pos . $portfolio_row_pos; echo " ". $portfolio_item_type; ?>">
                                <?php
                                $defalt_arg = ["class" => "img-responsive" . get_big_border(" ")];
                                if (has_post_thumbnail()):

                                    the_post_thumbnail("port-thumb", $defalt_arg);
                                    $post_thumbnail_id = get_post_thumbnail_id();
                                    $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                                    ?>
                                    <div class="home-portfolio-showcase-overlay<?php big_border(" "); ?>">
                                        <div class="home-portfolio-showcase-overlay-inner">
                                            <div class="home-portfolio-showcase-detail">
                                                <h4><?php the_title(); ?></h4>
                                                <?php
                                                if ($current_options["portfolio_homepage_column_layouts"] == 3) { ?>
                                                    <p><?php echo portfolio_excerpt(15, get_the_ID()); ?></p>
                                                <?php } else { ?>
                                                    <p><?php echo portfolio_excerpt(30, get_the_ID()); ?></p>
                                                <?php }
                                                if (get_post_meta(get_the_ID(), "portfolio_project_button_text", true)) { ?>
                                                    <div class="portfolio-btn">
                                                        <form action="<?php echo $meta_project_link; ?>" <?php blank_target(get_post_meta(get_the_ID(), "meta_project_target", true), 'method="get"'); ?>>
                                                            <button class="btn small more portfolio" type="submit"><?php echo get_post_meta(get_the_ID(), "portfolio_project_button_text", true); ?></button>								
                                                        </form>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>	
                    <?php $j++;
                endwhile;
            } else {
                for ($i = 1; $i <= $current_options["portfolio_list"]; $i++) { ?>
                    <div class="col-md-<?php echo $current_options["portfolio_homepage_column_layouts"]; ?> home-portfolio-area">
                        <div class="home-portfolio-showcase">
                            <div class="home-portfolio-showcase-media">
                                <img class="img-responsive<?php big_border(" "); ?>" src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/portfolio/port<?php echo rand(1, 4); ?>.jpg" />
                                <div class="home-portfolio-showcase-overlay">
                                    <div class="home-portfolio-showcase-overlay-inner">
                                        <div class="home-portfolio-showcase-detail">
                                            <h4><?php _e("Wallstreet style", "wallstreet"); ?></h4>
                                            <p><?php _e("A wonderful serenity has taken possession of my entire soul, like these sweet mornings.", "wallstreet"); ?></p>
                                            <div class="portfolio-btn"><form action="#"><button class="btn small more portfolio" type="submit" ><?php _e("Read More", "wallstreet"); ?></button></form></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>				
                    </div>
                <?php } ?>
                <div class='clearfix'></div>
                <?php if ($current_options["view_all_projects_btn_enabled"] == true) {
                    the_show_all($current_options["portfolio_more_link"], $current_options["portfolio_more_text"], $current_options["portfolio_more_link_target"], "project");                   
                }
            } ?>			
        </div>
        <?php if ($portfolio->have_posts()) {
            if ($current_options["view_all_projects_btn_enabled"] == true) {
                the_show_all($current_options["portfolio_more_link"], $current_options["portfolio_more_text"], $current_options["portfolio_more_link_target"], "project");                   
            }
        } ?>
    </div>	
</div>
<!-- /wallstreet Portfolio Section ---->
