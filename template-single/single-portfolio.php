<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Einzelansicht eines Projekts mit Details, Vor/Zurueck und verwandten Projekten.
 */

if (!defined("DJS_POSTTYPE_PLUGIN")) {
    get_template_part("template-specials/not_loaded", "plugin");
    return;
}
$pt = PostTypes_Plugin_Setup::instance();
djs_use_script("lightbox");

get_template_part("template-parts/index/index", "banner");
the_post();

$terms     = get_the_terms(get_the_ID(), PORTFOLIO_TAXONOMY);
$terms     = $terms && !is_wp_error($terms) ? $terms : [];
$client    = (string) get_post_meta(get_the_ID(), "portfolio_client_project_title", true);
$website   = (string) get_post_meta(get_the_ID(), "portfolio_project_visit_site", true);
$btn_text  = (string) get_post_meta(get_the_ID(), "portfolio_project_button_text", true);
$btn_link  = (string) get_post_meta(get_the_ID(), "meta_button_link", true);
$btn_tab   = (bool) get_post_meta(get_the_ID(), "meta_button_target", true);
$full      = has_post_thumbnail() ? wp_get_attachment_image_url(get_post_thumbnail_id(), "full") : ""; ?>

<div class="page-shell site-wrap single portfolio portfolio-detail">
    <article id="post-<?php the_ID(); ?>" <?php post_class("portfolio-detail__grid"); ?>>
        <figure class="portfolio-detail__media surface-card">
            <?php if ($full) { ?>
                <a href="<?php echo esc_url($full); ?>" data-lightbox="project" data-title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail("bigport-thumb", ["class" => "portfolio-detail__img", "loading" => "eager", "fetchpriority" => "high"]); ?>
                </a>
            <?php } ?>
        </figure>

        <aside class="portfolio-detail__info surface-card">
            <div class="entry-content portfolio-detail-description"><?php the_content(); ?></div>

            <dl class="portfolio-facts">
                <?php if ($client !== "") { ?><div><dt><?php esc_html_e("Clients", "djs-wallstreet-pro"); ?></dt><dd><?php echo esc_html($client); ?></dd></div><?php } ?>
                <div><dt><?php esc_html_e("Date", "djs-wallstreet-pro"); ?></dt><dd><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></dd></div>
                <?php if ($terms) { ?><div><dt><?php esc_html_e("Categories", "djs-wallstreet-pro"); ?></dt><dd><?php echo esc_html(implode(", ", wp_list_pluck($terms, "name"))); ?></dd></div><?php } ?>
                <?php if ($website !== "") { ?><div><dt><?php esc_html_e("Website", "djs-wallstreet-pro"); ?></dt><dd><a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"><?php echo esc_html(wp_parse_url($website, PHP_URL_HOST) ?: $website); ?></a></dd></div><?php } ?>
            </dl>

            <?php if ($btn_text !== "") { ?>
                <a class="btn btn-primary btn-block" href="<?php echo esc_url($btn_link ?: $website ?: "#"); ?>"<?php echo $btn_tab ? ' target="_blank" rel="noopener"' : ""; ?>><?php echo esc_html($btn_text); ?></a>
            <?php } ?>

            <nav class="portfolio-detail__pager join" aria-label="<?php esc_attr_e("Projects", "djs-wallstreet-pro"); ?>">
                <?php if ($next = get_next_post()) { ?>
                    <a class="btn btn-sm join-item" rel="next" href="<?php echo esc_url(get_permalink($next)); ?>"><span class="material-icons" aria-hidden="true">chevron_left</span><?php esc_html_e("Back", "djs-wallstreet-pro"); ?></a>
                <?php } ?>
                <?php if ($prev = get_previous_post()) { ?>
                    <a class="btn btn-sm join-item" rel="prev" href="<?php echo esc_url(get_permalink($prev)); ?>"><?php esc_html_e("Next", "djs-wallstreet-pro"); ?><span class="material-icons" aria-hidden="true">chevron_right</span></a>
                <?php } ?>
            </nav>
        </aside>
    </article>

    <?php comments_template("", true); ?>
</div>

<?php if ($pt->get("related_portfolio_project_hide_show") && $terms) {
    $related = new WP_Query([
        "post_type"           => PORTFOLIO_POST_TYPE,
        "tax_query"           => [["taxonomy" => PORTFOLIO_TAXONOMY, "field" => "term_id", "terms" => wp_list_pluck($terms, "term_id")]],
        "post__not_in"        => [get_the_ID()],
        "posts_per_page"      => 12,
        "no_found_rows"       => true,
        "ignore_sticky_posts" => true,
    ]);
    if ($related->have_posts()) {
        djs_use_script("carousel"); ?>
        <section class="section site-wrap related-projects">
            <?php djs_section_heading($pt->get("related_portfolio_title"), $pt->get("related_portfolio_description")); ?>
            <div class="carousel carousel--cards" data-carousel data-per-view="3" data-autoplay="0" aria-roledescription="carousel">
                <div class="carousel__viewport">
                    <div class="carousel__track">
                        <?php $i = 0;
                        while ($related->have_posts()) {
                            $related->the_post(); ?>
                            <div class="carousel__slide" role="group" aria-roledescription="slide">
                                <?php get_template_part("template-parts/portfolio/card", null, ["item" => djs_portfolio_item(null, "index-thumb", 15), "index" => $i++]); ?>
                            </div>
                        <?php }
                        wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php get_template_part("template-parts/global/carousel", "controls"); ?>
            </div>
        </section>
    <?php }
}
