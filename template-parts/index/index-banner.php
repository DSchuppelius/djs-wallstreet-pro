<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-banner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
global $loaded_banner;
$loaded_banner = true; ?>

<div class="page-mycarousel">
	<?php $header_img = wp_get_attachment_image_url(attachment_url_to_postid(get_header_image()), "banner-thumb");
    if (empty($header_img)) {
        $header_img = get_header_image();
    }
    $banner_options = 'class="parallax-window" ';
    if ($current_options["parallaxheader_enabled"]) {
        $banner_options .= 'data-position-x="right" data-z-index="-1" data-parallax="scroll" data-image-src="' . $header_img . '"';
    } else {
        $banner_options .= 'style="background: url(\'' . $header_img . '\') no-repeat center; background-size: cover;"';
    }
    ?>
	<div <?php echo $banner_options; ?>>
		<img class="img-responsive header-img" src="<?php echo $header_img; ?>" style="visibility: hidden;"/>
        <noscript><style>.img-responsive.header-img { visibility: visible !important; }</style></noscript>
    </div>
	<div class="container page-title-col">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php if ((is_front_page() && is_home()) || is_front_page()) {
                    echo "<h1>";
                    esc_html_e("Home", "wallstreet");
                    echo "</h1>";
                } elseif (is_home()) {
                    echo "<h1>";
                    echo esc_html(single_post_title());
                    echo "</h1>";
                } elseif (is_page_template("category.php")) {
                    echo "<h1>";
                    echo single_cat_title("", false);
                    echo "</h1>";
                } elseif (is_page_template("tag.php")) {
                    echo "<h1>";
                    printf(__("Tag Archive %s", "wallstreet"), "<span>" . single_tag_title("", false) . "</span>");
                    echo "</h1>";
                } elseif (is_page_template("author.php")) {
                    echo "<h1>";
                    printf(__("Author Archive %s", "wallstreet"), '<a href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . "</a>");
                    echo "</h1>";
                } elseif (is_page_template("archive.php")) {
                    echo "<h1>";
                    if (is_day()):
                    _e("Daily Archive", "wallstreet");
                    echo " " . get_the_date();
                    elseif (is_month()):
                    _e("Monthly Archive", "wallstreet");
                    echo " " . get_the_date("F Y");
                    elseif (is_year()):
                    _e("Yearly Archive", "wallstreet");
                    echo " " . get_the_date("Y");
                    else:
                    _e("Blog Archive", "wallstreet");
                    endif;
                    echo "</h1>";
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
                    printf("<h1>" . __("Search results for: %s", "wallstreet") . "</h1>", '<span>"' . get_search_query() . '"</span>');
                } else {
                    the_title("<h1>", "</h1>");
                } ?>	
			</div>	
		</div>
	</div>
	<?php get_template_part("template-parts/global/breadcrumb"); ?>
</div>
<div class="site rellax" data-rellax-speed="<?php echo $current_options["data_rellax_speed_banner"]; ?>">
