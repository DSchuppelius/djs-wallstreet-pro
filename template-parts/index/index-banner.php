<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-banner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
global $loaded_banner;
$loaded_banner = true; ?>

<div class="page-mycarousel">
    <?php $header_img = wp_get_attachment_image_url(attachment_url_to_postid(get_header_image()), "banner-thumb");
    if (empty($header_img)) {
        $header_img = get_header_image();
    }
    $banner_options = 'class="parallax-window" ';
    if ($current_setup->get("parallaxheader_enabled")) {
        $banner_options .= 'data-position-x="right" data-z-index="-1" data-parallax="scroll" data-image-src="' . $header_img . '"';
    } else {
        $banner_options .= 'style="background: url(\'' . $header_img . '\') no-repeat center; background-size: cover;"';
    }
    ?>
    <div <?php echo $banner_options; ?>>
        <img class="img-responsive header-img" src="<?php echo $header_img; ?>" style="visibility: hidden;" />
        <noscript>
            <style>
            .img-responsive.header-img {
                visibility: visible !important;
            }
            </style>
        </noscript>
    </div>
    <div class="container page-title-col">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <?php if ((is_front_page() && is_home()) || is_front_page()) {
                    echo "<h1>";
                    esc_html_e("Home", "djs-wallstreet-pro");
                    echo "</h1>";
                } elseif (is_home()) {
                    echo "<h1>";
                    echo esc_html(single_post_title());
                    echo "</h1>";
                } elseif (is_loaded_template("category.php")) {
                    echo "<h1>";
                    printf(esc_html__("Category Archive: %s", "djs-wallstreet-pro"), "<span>" . single_cat_title("", false) . "</span>");
                    echo "</h1>";
                } elseif (is_loaded_template("tag.php")) {
                    echo "<h1>";
                    printf(esc_html__("Tag Archive: %s", "djs-wallstreet-pro"), "<span>" . single_tag_title("", false) . "</span>");
                    echo "</h1>";
                } elseif (is_loaded_template("author.php")) {
                    echo "<h1>";
                    printf(esc_html__("Author Archive: %s", "djs-wallstreet-pro"), '<a href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . "</a>");
                    echo "</h1>";
                } elseif (is_loaded_template("archive.php") ) {
                    $archiv_post_format = get_query_var('post_format');
                    if ($archiv_post_format == 'post-format-aside') {
                        echo "<h1>";
                        esc_html_e('Aside Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-audio') {
                        echo "<h1>";
                        esc_html_e('Audio Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-chat') {
                        echo "<h1>";
                        esc_html_e('Chat Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-gallery') {
                        echo "<h1>";
                        esc_html_e('Gallery Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-image') {
                        echo "<h1>";
                        esc_html_e('Image Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-link') {
                        echo "<h1>";
                        esc_html_e('Link Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-quote') {
                        echo "<h1>";
                        esc_html_e('Quote Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-status') {
                        echo "<h1>";
                        esc_html_e('Status Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } elseif ($archiv_post_format == 'post-format-video') {
                        echo "<h1>";
                        esc_html_e('Video Archives', "djs-wallstreet-pro");
                        echo "</h1>";
                    } else {
                        echo "<h1>";
                        if (is_day()):
                            esc_html_e("Daily Archive", "djs-wallstreet-pro");
                            echo " " . get_the_date($current_setup->get("fulldateformat"));
                        elseif (is_month()):
                            esc_html_e("Monthly Archive", "djs-wallstreet-pro");
                            echo " " . get_the_date($current_setup->get("monthyearformat"));
                        elseif (is_year()):
                            esc_html_e("Yearly Archive", "djs-wallstreet-pro");
                            echo " " . get_the_date($current_setup->get("yearformat"));
                        else:
                            esc_html_e("Blog Archive", "djs-wallstreet-pro");
                        endif;
                        echo "</h1>";
                    }
                } elseif (class_exists("WooCommerce")) {
                    if (is_shop()) {
                        echo "<h1>";
                        woocommerce_page_title();
                        echo "</h1>";
                    } elseif (is_cart() || is_checkout()) {
                        the_title("<h1>", "</h1>");
                    } else {
                        the_title("<h1>", "</h1>");
                    }
                } elseif (is_archive()) {
                    the_archive_title("<h1>", "</h1>");
                } elseif (is_search()) {
                    printf("<h1>" . esc_html__("Search results for: %s", "djs-wallstreet-pro") . "</h1>", '<span>"' . get_search_query() . '"</span>');
                } else {
                    the_title("<h1>", "</h1>");
                } ?>
            </div>
        </div>
    </div>
    <?php get_template_part("template-parts/global/breadcrumb"); ?>
</div>
<?php if(show_rellax_div()) { ?>
<div class="site rellax" data-rellax-speed="<?php echo $current_setup->get("data_rellax_speed_banner"); ?>">
    <?php } ?>