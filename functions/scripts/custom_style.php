<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $link_color;
global $background_color;

$current_options = get_current_options();

if ($current_options["enable_custom_typography"] == true) { ?>
	<style type="text/css">
		/****** custom typography *********/ 
		body .home-blog-description p,
		body .portfolio-detail-description p,
		body .blog-post-title-wrapper-full p,
		body .blog-post-title-wrapper p {
			font-size:<?php echo $current_options["general_typography_fontsize"] . "px"; ?> ;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["general_typography_fontfamily"]; ?> ;
			font-style:<?php echo $current_options["general_typography_fontstyle"]; ?> ;
			line-height:<?php echo $current_options["general_typography_fontsize"] + 5 . "px"; ?> ;
		}
		/*** Menu title */
		.navbar .navbar-nav > li > a {
			font-size:<?php echo $current_options["menu_title_fontsize"] . "px"; ?> !important;
			font-family:'SiteFont' !important;
			font-style:<?php echo $current_options["menu_title_fontstyle"]; ?> !important;
			font-weight:<?php echo $current_options["menu_title_fontfamily"]; ?> !important;
		}
		/*** post and Page title */
		body .blog-post-title-wrapper h2,body .blog-post-title-wrapper h2 a, body .blog-post-title-wrapper-full h2, body .blog-post-title-wrapper-full h2 {
			font-size:<?php echo $current_options["post_title_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["post_title_fontfamily"]; ?>;
			font-style:<?php echo $current_options["post_title_fontstyle"]; ?>;
		}
		/*** service title */
		body .service-area h2 {
			font-size:<?php echo $current_options["service_title_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["service_title_fontfamily"]; ?>;
			font-style:<?php echo $current_options["service_title_fontstyle"]; ?>;
		}
		/******** portfolio title ********/
		body .main-portfolio-showcase .main-portfolio-showcase-detail h4 {
			font-size:<?php echo $current_options["portfolio_title_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["portfolio_title_fontfamily"]; ?>;
			font-style:<?php echo $current_options["portfolio_title_fontstyle"]; ?>;
		}
		/******* footer widget title*********/
		body .footer_widget_title,body .footer-widget-section .wp-block-search .wp-block-search__label,body .footer-widget-section h1, body .footer-widget-section h2, body .footer-widget-section h3, body .footer-widget-section h4, body .footer-widget-section h5, body .footer-widget-section h6,
		body .sidebar-widget-title h2, body .sidebar-widget .wp-block-search .wp-block-search__label,body .sidebar-widget h1,body .sidebar-widget h2,.sidebar-widget h3,body .sidebar-widget h4,body .sidebar-widget h5,body .sidebar-widget h6, .wc-block-product-search__label {
			font-size:<?php echo $current_options["widget_title_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["widget_title_fontfamily"]; ?>;
			font-style:<?php echo $current_options["widget_title_fontstyle"]; ?>;
		}
		body .callout-section h3 {
			font-size:<?php echo $current_options["calloutarea_title_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["calloutarea_title_fontfamily"]; ?>;
			font-style:<?php echo $current_options["calloutarea_title_fontstyle"]; ?>;
		}
		body .callout-section p {
			font-size:<?php echo $current_options["calloutarea_description_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["calloutarea_description_fontfamily"]; ?>;
			font-style:<?php echo $current_options["calloutarea_description_fontstyle"]; ?>;
		}
		body .callout-section a {	
			font-size:<?php echo $current_options["calloutarea_purches_fontsize"] . "px"; ?>;
			font-family:'SiteFont' !important;
			font-weight:<?php echo $current_options["calloutarea_purches_fontfamily"]; ?>;
			font-style:<?php echo $current_options["calloutarea_purches_fontstyle"]; ?>;
		}
		.custom-logo { width: <?php echo esc_html(get_theme_mod("busiprof_logo_length", "400")); ?>px; height: auto; }
	</style>
<?php }
?>
<style type="text/css">
	:root{
		--main-slider-radius: <?php echo $current_options["slideroundcorner"]; ?>px; 
		--sub-slider-radius: <?php echo $current_options["slideroundcorner"] - 20; ?>px;
        --theme-background-color: <?php echo $background_color; ?>;
        --theme-color: <?php echo $link_color; ?>;
	}

    #djs-body{
        background-color: <?php echo $background_color; ?>;
    }

    #page_fader {
        color:<?php echo $link_color; ?>;
        text-shadow: 0 0 1px <?php echo $link_color; ?>;
        background-color: <?php echo $background_color; ?>;
        <?php if($background = set_url_scheme(get_background_image())) { ?>
            background-image: url('<?php echo esc_url_raw($background); ?>');
            background-size: <?php echo get_theme_mod('background_size', get_theme_support('custom-background', 'default-size')); ?>;
            background-repeat: <?php echo get_theme_mod('background_repeat', get_theme_support('custom-background', 'default-repeat')); ?>;
            background-position: <?php echo get_theme_mod('background_position_x', get_theme_support('custom-background', 'default-position-x')). " ".get_theme_mod('background_position_y', get_theme_support('custom-background', 'default-position-y')); ?>;
            background-attachment: <?php echo get_theme_mod('background_attachment', get_theme_support('custom-background', 'default-attachment')); ?>;
        <?php } ?>
    }

	.custom-logo{ width: <?php echo esc_html(get_theme_mod("busiprof_logo_length", "156")); ?>px; height: auto;}
	.custom-positions .page-breadcrumbs{ bottom:<?php echo $current_options["breadcrumbposition"]; ?>px; }
	.custom-positions .page-mycarousel{ margin-bottom:<?php echo 80 - $current_options["contentposition"]; ?>px; }
</style>