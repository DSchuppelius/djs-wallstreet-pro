<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup_posttypes = PostTypes_Plugin_Setup::instance();

get_template_part("template-parts/index/index", "banner"); ?>
<div class="container single portfolio">
    <div class="row portfolio-detail-section <?php row_frame_border(""); ?>">
        <div class="col-md-4 portfolio-detail-sidebar">
            <ul class="portfolio-detail-pagi">
                <?php $next_post = get_next_post();
                if (!empty($next_post)): ?>
                    <li><a class="button btn back" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php esc_attr_e("Back", "djs-wallstreet-pro"); ?>" rel="next"><?php esc_html_e("Back", "djs-wallstreet-pro"); ?></a></li>
                <?php endif;
                $prev_post = get_previous_post();
                if (!empty($prev_post)): ?>
                    <li><a class="button btn forward" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" title="<?php esc_attr_e("Next", "djs-wallstreet-pro"); ?>" rel="prev"><?php esc_html_e("Next", "djs-wallstreet-pro"); ?></a></li>    
                <?php endif; ?>	
            </ul>
            <div class="portfolio-detail-button">
                <?php if (get_post_meta(get_the_ID(), "portfolio_project_button_text", true)) { ?>
                    <p><a class="button btn loadmore project-btn" <?php blank_target(get_post_meta(get_the_ID(), "meta_button_target", true)); ?> href="<?php if (get_post_meta(get_the_ID(), "meta_button_link", true)) { echo esc_html(get_post_meta(get_the_ID(), "meta_button_link", true)); } ?>" title="<?php esc_attr_e("Website", "djs-wallstreet-pro"); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "portfolio_project_button_text", true)); ?></a></p>
                <?php } ?>
            </div>
            <?php $draught_links = [];
            $terms = get_the_terms($post->ID, PORTFOLIO_TAXONOMY);
            if ($terms && !is_wp_error($terms)):
                foreach ($terms as $term) {
                    $draught_links[] = $term->name;
                }
                $on_draught = join(", ", $draught_links);
            endif; ?>
            <div class="portfolio-detail-description">
                <div class="qua-separator-small" id=""></div>
                <?php the_post(); ?>
                <p><?php the_content(); ?></p>	
            </div>
            <div class="portfolio-detail-info">
                <?php if (get_post_meta(get_the_ID(), "portfolio_client_project_title", true)) { ?>
                    <p><?php esc_html_e("Clients", "djs-wallstreet-pro"); ?>: <small><?php echo get_post_meta(get_the_ID(), "portfolio_client_project_title", true); ?></small></p>
                <?php } ?>
                <p><?php esc_html_e("Date", "djs-wallstreet-pro"); ?>: <small><?php the_time("d M, Y"); ?> </small></p>
                <p><?php esc_html_e("Categories", "djs-wallstreet-pro"); ?>: <small><?php echo $on_draught; ?></small></p>
                    
                <?php if (get_post_meta(get_the_ID(), "portfolio_project_visit_site", true)) { ?>
                    <p><?php esc_html_e("Website", "djs-wallstreet-pro"); ?>: <small><?php echo get_post_meta(get_the_ID(), "portfolio_project_visit_site", true); ?></small></p>
                <?php } ?>
            </div>
            <div class="portfolio-detail-filler"></div>
        </div>			
        <?php if (has_post_thumbnail()) { ?>
            <div class="col-md-8 portfolio-detail-picture">
                <?php $class = ["class" => "img-responsive"]; ?>
                <div class="portfolio-detail-filler top"></div>
                <div class="port-detail-img"><?php the_post_thumbnail("bigport-thumb", $class); ?></div>
                <div class="portfolio-detail-filler bottom"></div>
            </div>
        <?php } ?>	
    </div>	
</div>
<!-- /Project Section Detail-->

<!-- Realted Project ---->
<?php if ($current_setup_posttypes->get("related_portfolio_project_hide_show") == true) { ?>
    <div class="container single portfolio preview">
        <?php if (!empty($current_setup_posttypes->get("related_portfolio_title")) || !empty($current_setup_posttypes->get("related_portfolio_description"))): ?>
            <div class="row <?php row_frame_border(""); ?>">
                <div class="section_heading_title">
                    <?php if ($current_setup_posttypes->get("related_portfolio_title")) { ?>
                        <h1><?php echo $current_setup_posttypes->get("related_portfolio_title"); ?></h1>
                        <div class="pagetitle-separator"></div>
                    <?php } ?>
                    <?php if ($current_setup_posttypes->get("related_portfolio_description")) { ?>
                        <p><?php echo $current_setup_posttypes->get("related_portfolio_description"); ?></p>
                    <?php } ?>				
                </div>
            </div>
        <?php endif; ?>
        <div class="row <?php row_frame_border(""); ?>">
            <div class="row related-project-section" id="related_project_scroll">
                <?php $count_posts = wp_count_posts(PORTFOLIO_POST_TYPE)->publish;
                $args = [
                    "post_type" => PORTFOLIO_POST_TYPE,
                    PORTFOLIO_TAXONOMY => $draught_links[0],
                    "post__not_in" => [$post->ID],
                    "posts_per_page" => $count_posts,
                    "post_status" => "publish",
                ];
    
                $portfolio_query = null;
                $portfolio_query = new WP_Query($args);
    
                if ($portfolio_query->have_posts()) {
                    while ($portfolio_query->have_posts()):
                        $portfolio_query->the_post();
                        if (get_post_meta(get_the_ID(), "meta_project_link", true)) {
                            $meta_project_link = esc_url(get_post_meta(get_the_ID(), "meta_project_link", true));
                        } ?>
                        <div class="col-md-4 pull-left main-portfolio-area">
                            <div class="main-portfolio-showcase">
                                <div class="main-portfolio-showcase-media">
                                    <?php if (has_post_thumbnail()) {
                                        $class = ["class" => "img-responsive"];
                                        the_post_thumbnail("index-thumb", $class);
                                        $post_thumbnail_id = get_post_thumbnail_id();
                                        $post_thumbnail_url = esc_url(wp_get_attachment_url($post_thumbnail_id)); ?>
                                        <div class="main-portfolio-showcase-overlay">
                                            <div class="main-portfolio-showcase-overlay-inner">
                                                <div class="main-portfolio-showcase-detail">
                                                    <h4><?php the_title(); ?></h4>
                                                    <p><?php echo portfolio_excerpt(15, get_the_ID()); ?></p>
                                                    <div class="portfolio-icon">
                                                        <a href="<?php echo $post_thumbnail_url; ?>" <?php blank_target(get_post_meta(get_the_ID(), "meta_project_target", true)); ?> data-lightbox="image"><i class="fa fa-image"></i></a>
                                                        <?php if (isset($meta_project_link)) { ?>
                                                            <a href="<?php echo $meta_project_link; ?>" <?php blank_target(get_post_meta(get_the_ID(), "meta_project_target", true)); ?>><i class="fa fa-link"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                } ?>
            </div>
        
            <div class="row pagi">
                <div class="col-md-12">
                    <ul class="prelated-project-btn">
                        <?php $next_post = get_next_post();
                        if (!empty($next_post)): ?>
                            <li>
                                <a class="button btn back" id="project_prev" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php esc_attr_e("Back", "djs-wallstreet-pro"); ?>"><?php esc_html_e("Back", "djs-wallstreet-pro"); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php $prev_post = get_previous_post();
                        if (!empty($prev_post)): ?>
                            <li>
                                <a class="button btn forward" id="project_next" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" title="<?php esc_attr_e("Forward", "djs-wallstreet-pro"); ?>"><?php esc_html_e("Forward", "djs-wallstreet-pro"); ?></a>
                            </li>
                        <?php endif; ?>				
                    </ul>
                </div>
            </div>
        </div>
    </div>	
<?php } ?>
