<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$current_setup_posttypes = PostTypes_Plugin_Setup::instance();

$term_args = ["hide_empty" => true, "orderby" => "id"];
$posts_per_page = $current_setup_posttypes->get("portfolio_numbers_on_templates");
$tax_terms = get_terms(PORTFOLIO_TAXONOMY, $term_args);
$j = 1;
$tab = "";

$structure = get_option("permalink_structure");
$permalink = get_permalink();
if ($structure == "") {
    $permalink .= "&tab=";
} else {
    $permalink .= "?tab=";
}

if (isset($_GET["tab"])) {
    $tab = $_GET["tab"];
}
if (isset($_GET["div"])) {
    $tab = $_GET["div"];
}
?>

<section class="portfolio portfoliocat">
    <div class="container<?php big_border(" "); ?>">
        <div class="row">
            <div class="section_heading_title">
                <?php if ($current_setup_posttypes->get("two_thre_four_col_port_tem_title")) { ?>
                <h1><?php echo $current_setup_posttypes->get("two_thre_four_col_port_tem_title"); ?></h1>
                <div class="pagetitle-separator">
                    <div class="pagetitle-separator-border">
                        <div class="pagetitle-separator-box"></div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($current_setup_posttypes->get("two_thre_four_col_port_tem_desc")) { ?>
                <p><?php echo $current_setup_posttypes->get("two_thre_four_col_port_tem_desc"); ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portfolio-tabs-section">
                    <ul id="tabs" class="portfolio-tabs" role="tablist">
                        <?php foreach ($tax_terms as $tax_term) {
                            $decoded_slug = rawurldecode($tax_term->slug); ?>
                        <li rel="tab" class="nav-item">
                            <span class="tab">
                                <a id="tab-<?php echo $decoded_slug; ?>"
                                    href="<?php echo esc_url($current_setup->get("page_fader_enabled") ? $permalink . $decoded_slug : get_the_currentURL() . "#" . $decoded_slug); ?>"
                                    class="btn tab nav-link <?php if ($tab == "") { if ($j == 1) { echo "active"; $j = 2; } } elseif ($tab == $decoded_slug) { echo "active"; } ?>"><?php echo $tax_term->name; ?></a>
                            </span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id="loading_container" align="center" class="loading-image" style="display:none;">
            <img id="loading-image" src="<?php echo THEME_ASSETS_PATH_URI . "/images/loading_2.gif"; ?>" />
        </div>
        <div id="content" class="tab-content" role="tablist">
            <?php
            global $paged;
            $curpage = $paged ? $paged : 1;
            $norecord = 0;
            $is_active = true;
            if ($tax_terms) {
                foreach ($tax_terms as $tax_term) {
                    $decoded_slug = rawurldecode($tax_term->slug);
                    $args = [
                        "post_type" => PORTFOLIO_POST_TYPE,
                        "post_status" => "publish",
                        PORTFOLIO_TAXONOMY => $tax_term->slug,
                        "posts_per_page" => $posts_per_page,
                        "paged" => $curpage,
                        "orderby" => "menu_order",
                    ];
                    $portfolio_query = null;
                    $portfolio_query = new WP_Query($args);
                    if ($portfolio_query->have_posts()) { ?>
            <div id="<?php echo $decoded_slug; ?>"
                class="tab-pane fade in <?php if ($tab == "") { if ($is_active == true) { echo "active"; } $is_active = false; } elseif ($tab == $decoded_slug) { echo "active"; } ?>"
                role="tabpanel" aria-labelledby="tab-<?php echo $decoded_slug; ?>">
                <div class="row">
                    <?php while ($portfolio_query->have_posts()) {
                                    $portfolio_query->the_post();
                                    if (get_post_meta(get_the_ID(), "meta_project_link", true)) {
                                        $meta_project_link = esc_url(get_post_meta(get_the_ID(), "meta_project_link", true));
                                    } else {
                                        $meta_project_link = esc_url(get_post_permalink());
                                    }
                                    $portfolio_target = sanitize_text_field(get_post_meta(get_the_ID(), "portfolio_target", true));
                                    $project_link_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "project_link_chkbx", true));
                                    $show_project_picture_link = sanitize_text_field(get_post_meta(get_the_ID(), "show_project_picture_link", true));
                                    if (get_post_meta(get_the_ID(), "project_more_btn_link", true)) {
                                        $project_more_btn_link = esc_url(get_post_meta(get_the_ID(), "project_more_btn_link", true));
                                    } else {
                                        $project_more_btn_link = esc_url(get_permalink());
                                    }
                                    $portfolio_project_summary = esc_html__("Detail", "djs-wallstreet-pro");
                                    if (get_post_meta(get_the_ID(), "portfolio_project_summary", true)) {
                                        $portfolio_project_summary = get_post_meta(get_the_ID(), "portfolio_project_summary", true);
                                    }

                                    $class = "";
                                    if (is_page_template("template-specials/portfolio-2-column.php")) {
                                        $class = "col-md-6 col-sm-6";
                                        $class1 = "two-colum-portfolio";
                                    } elseif (is_page_template("template-specials/portfolio-3-column.php")) {
                                        $class = "col-md-4 col-sm-4";
                                        $class1 = "three-column-layout";
                                    } elseif (is_page_template("template-specials/portfolio-4-column.php")) {
                                        $class = "col-md-3 col-sm-6";
                                        $class1 = "four-colum-layout";
                                    } ?>
                    <div class="<?php echo $class; ?> col-xs-12 main-portfolio-area">
                        <div class="main-portfolio-showcase">
                            <div class="<?php echo $class1; ?> main-portfolio-showcase-media">
                                <?php
                                                the_post_thumbnail("port-thumb", [ "class" => "img-responsive" . get_big_border(" ")]);
                                                if (has_post_thumbnail()) {
                                                    $post_thumbnail_id = get_post_thumbnail_id();
                                                    $post_thumbnail_url = esc_url(get_attachment_link($post_thumbnail_id));
                                                } ?>
                                <div class="main-portfolio-showcase-overlay<?php big_border(" "); ?>">
                                    <div class="main-portfolio-showcase-overlay-inner">
                                        <div class="main-portfolio-showcase-detail">
                                            <h4><?php the_title(); ?></h4>
                                            <?php if (is_page_template("template-specials/portfolio-4-column.php")) { ?>
                                            <p><?php echo portfolio_excerpt(15, get_the_ID()); ?></p>
                                            <?php } else { ?>
                                            <p><?php echo portfolio_excerpt(30, get_the_ID()); ?></p>
                                            <?php } ?>
                                            <div
                                                class="portfolio-icon <?php echo $show_project_picture_link? "":"without_image"; ?>">
                                                <?php if ($show_project_picture_link) { ?>
                                                <a <?php blank_target(get_post_meta(get_the_ID(), "meta_project_target", true)); ?>
                                                    class="hover_thumb" title="<?php the_title(); ?>"
                                                    data-lightbox="image" href="<?php echo $post_thumbnail_url; ?>"><i
                                                        class="fa fa-image"></i></a>
                                                <?php } ?>
                                                <?php if ($meta_project_link) { ?>
                                                <a <?php blank_target(get_post_meta(get_the_ID(), "meta_project_target", true)); ?>
                                                    href="<?php echo $meta_project_link; ?>"
                                                    alt="<?php echo $portfolio_project_summary; ?>"><i
                                                        class="fa fa-link"></i></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $norecord = 1; ?>
                    <?php } ?>
                </div>
                <?php the_pagination($curpage, $portfolio_query, $portfolio_query->found_posts, $posts_per_page); ?>
            </div>
            <?php wp_reset_query();
                    } else { ?>
            <div id="<?php echo $decoded_slug; ?>"
                class="tab-pane fade in <?php if ($tab == "") { if ($is_active == true) { echo "active"; } $is_active = false; } elseif ($tab == $decoded_slug) { echo "active"; } ?>">
            </div>
            <?php }
                }
            } ?>
        </div>
    </div>
</section>
<?php if (!$current_setup->get("page_fader_enabled")) { ?>
<script type="text/javascript">
jQuery('.lightbox').hide();
jQuery('#lightbox').hide();

jQuery(".tab .nav-link ").click(function(e) {
    var h = decodeURI(jQuery(this).attr('href').replace(/#/, ""));
    var tjk = "<?php the_title(); ?>";
    var str1 = tjk.replace(/\s+/g, '-').toLowerCase();
    var pageurl = "<?php echo $permalink; ?>" + h;

    jQuery("#lightbox").remove();
    jQuery.ajax({
        url: pageurl,
        beforeSend: function() {
            jQuery(".tab-content").hide();
            jQuery("#loading_container").show();
        },
        success: function(data) {
            jQuery(".tab-content").show();
            jQuery('.lightbox').remove();
            jQuery('#lightbox').remove();
            jQuery('.page-mycarousel').hide();
            jQuery('.container').hide();
            jQuery('footer.site').hide();
            jQuery('#wall_wrapper').html(data);
        },
        complete: function(data) {
            jQuery("#loading_container").hide();
        }
    });

    if (pageurl != window.location) {
        window.history.pushState({
            path: pageurl
        }, '', pageurl);
    }
    return false;
});
</script>
<?php } ?>