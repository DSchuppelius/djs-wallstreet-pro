<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-slider.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$animation = $current_options["animation"];
$animationSpeed = $current_options["animationSpeed"];
$direction = $current_options["slide_direction"];
$slideshowSpeed = $current_options["slideshowSpeed"];

if ($current_options["home_slider_enabled"] == true && $current_options["slidertype"] == "base") { ?>
    <script>
        jQuery(window).load(function(){
            jQuery('.flexslider').flexslider({
                animation: "<?php echo $animation; ?>",
                animationSpeed: <?php echo $animationSpeed; ?>,
                direction: "<?php echo $direction; ?>",
                slideshowSpeed: <?php echo $slideshowSpeed; ?>,
                pauseOnHover: true, 
                slideshow: true,
                start: function(slider){
                    jQuery('body').removeClass('loading');
                }
            }); 
        });
    </script>
<?php }
?>

<style type="text/css">
    #slider_desktop_slider_title h1 {
        border-top: 2px solid transparent;
    }
    @media only screen and (min-width: 960px) and (max-width: 1200px) {
        .slide-text-bg1.mobile-active {
            display: block !important;
        }
        .slide-text-bg1	{
            display: none;
        }
        .flex-slider-center .slide-text-bg2.mobile-active h1 {
            border-top: 2px solid #fff !important;
        }
        .slide-text-bg2.mobile-deactive h1 {
            border-top: 2px solid transparent;
        }

        .slide-text-bg2.mobile-active {
            display: block !important;
        }
        .slide-text-bg2.mobile-active.mobile-subtitle-deactive,
        .slide-text-bg2.mobile-subtitle-deactive {
            display: none !important;
        }

        .slide-text-bg3.mobile-description-active {
            display: block !important;
        }
        .slide-text-bg3.mobile-description-deactive {
            display: none !important;
        }
        .flex_btn_div.mobile-button-active {
            display: block !important;
        }
        .flex_btn_div.mobile-button-deactive {
            display: none !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 959px) {
        .slide-text-bg1.mobile-active {
            display: block !important;
        }
        .slide-text-bg1 {
            display: none;
        }
        .flex-slider-center .slide-text-bg2.mobile-active h1 {
            border-top: 2px solid #fff !important;
        }
        .slide-text-bg2.mobile-deactive h1 {
            border-top: 2px solid transparent;
        }
        .slide-text-bg2.mobile-active {
            display: block !important;
        }
        .slide-text-bg2.mobile-active.mobile-subtitle-deactive,
        .slide-text-bg2.mobile-subtitle-deactive {
            display: none !important;
        }

        .slide-text-bg3.mobile-description-active {
            display: block !important;
        }
        .slide-text-bg3.mobile-description-deactive {
            display: none !important;
        }
        .flex_btn_div.mobile-button-active {
            display: block !important;
        }
        .flex_btn_div.mobile-button-deactive {
            display: none !important;
        }
    }
    @media only screen and (min-width: 480px) and (max-width: 767px) {
        .slide-text-bg1.mobile-active {
            display: block !important;
        }
        .slide-text-bg1 {
            display: none;
        }
        .flex-slider-center .slide-text-bg2.mobile-active h1 {
            border-top: 2px solid #fff !important;
        }
        .slide-text-bg2.mobile-deactive h1 {
            border-top: 2px solid transparent;
        }
        .slide-text-bg2.mobile-active {
            display: block !important;
        }
        .slide-text-bg2.mobile-active.mobile-subtitle-deactive,
        .slide-text-bg2.mobile-subtitle-deactive {
            display: none !important;
        }

        .slide-text-bg3.mobile-description-active {
            display: block !important;
        }
        .slide-text-bg3.mobile-description-deactive {
            display: none !important;
        }
        .flex_btn_div.mobile-button-active {
            display: block !important;
        }
        .flex_btn_div.mobile-button-deactive {
            display: none !important;
        }
    }
    @media only screen and (min-width: 200px) and (max-width: 480px) {
        .slide-text-bg1.mobile-active {
            display: block !important;
        }
        .slide-text-bg1 {
            display: none;
        }
        .flex-slider-center .slide-text-bg2.mobile-active h1 {
            border-top: 2px solid #fff !important;
        }
        .slide-text-bg2.mobile-deactive h1 {
            border-top: 2px solid transparent;
        }
        .slide-text-bg2.mobile-active {
            display: block !important;
        }
        .slide-text-bg2.mobile-active.mobile-subtitle-deactive,
        .slide-text-bg2.mobile-subtitle-deactive {
            display: none !important;
        }

        .slide-text-bg3.mobile-description-active {
            display: block !important;
        }
        .slide-text-bg3.mobile-description-deactive {
            display: none !important;
        }
        .flex_btn_div.mobile-button-active {
            display: block !important;
        }
        .flex_btn_div.mobile-button-deactive {
            display: none !important;
        }
    }
</style>

<!-- /Slider Section -->
<?php if ($current_options["home_slider_enabled"] == true && $current_options["slidertype"] == "base") { ?>
    <div class="homepage_mycarousel<?php echo $current_options["home_slider_enabled"] ? " " . $current_options["revolutionslidername"] . " " : " "; ?>rellax" data-rellax-speed="<?php echo $current_options["data_rellax_speed_slider"]; ?>">		
        <div class="flexslider">
            <div class="flex-viewport">
                <?php $count_posts = wp_count_posts(SLIDER_POST_TYPE)->publish;
                $args = [
                    "post_type" => SLIDER_POST_TYPE,
                    "posts_per_page" => $count_posts,
                ];
                $slider = new WP_Query($args);
                $first_post = true;
                if ($slider->have_posts()) { 
                    $slider->the_post(); ?>
                    <noscript><ul class="slides"><?php render_slide('noscript', 'display: block; -webkit-backface-visibility: unset;'); ?></ul></noscript>
                    <ul class="slides">
                        <?php while ($slider->have_posts()) {
                            render_slide($first_post ? 'first' : 'next');
                            $first_post = false;
                            $slider->the_post(); 
                        } ?>
                    </ul>
                <?php } else { ?>
                    <ul class="slides">
                        <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <li class="<?php echo $i==1 ? 'first' : 'next'; ?>">
                                <img class="img-responsive" src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/slider/slide<?php echo $i; ?>.jpg">
                                <div class="flex-slider-center">
                                    <div <?php if ($current_options["home_slider_desktop_title_enabled"] != true) { ?> style="display: none;"  <?php } ?> class="slide-text-bg1 <?php if ($current_options["home_slider_desktop_title_enabled"] == true) { echo "desktop-active"; } ?> <?php if ($current_options["home_slider_mobile_title_enabled"] == true) { echo "mobile-active"; } ?>">
                                        <h2><?php _e("Clean & fresh theme", "wallstreet"); ?></h2>
                                    </div>
                                    <div <?php if ($current_options["home_slider_desktop_subtitle_enabled"] != true) { ?> style="display: none;"  <?php } ?> <?php if ($current_options["home_slider_desktop_title_enabled"] != true) { ?> id="slider_desktop_slider_title" <?php } ?> class="slide-text-bg2 <?php if ($current_options["home_slider_mobile_title_enabled"] == true) { echo "mobile-active"; } else { echo "mobile-deactive"; } ?> <?php if ($current_options["home_slider_mobile_subtitle_enabled"] == true) { echo "mobile-subtitle-active"; } else { echo "mobile-subtitle-deactive"; } ?>">
                                        <h1><?php _e("Welcome to wallstreet", "wallstreet"); ?></h1>
                                    </div>
                                    <div <?php if ($current_options["home_slider_desktop_desc_enabled"] != true) { ?> style="display: none;" <?php } ?> class="slide-text-bg3 <?php if ($current_options["home_slider_mobile_desc_enabled"] == true) { echo "mobile-description-active"; } else { echo "mobile-description-deactive"; } ?>">
                                        <p><?php _e("The state-of-the-art HTML5 powered flexible layout with lightspeed fast CSS3 transition effects. Works perfect in any modern mobile.", "wallstreet"); ?></p>
                                    </div>
                                    <div <?php if ($current_options["home_slider_desktop_button_enabled"] != true) { ?> style="display: none;" <?php } ?> class="flex_btn_div <?php if ($current_options["home_slider_mobile_button_enabled"] == true) { echo "mobile-button-active"; } else { echo "mobile-button-deactive"; } ?>">
                                        <form action="#"><button class="btn buy flex_btn" type="submit"><?php _e("Purchase Now", "wallstreet"); ?></button></form>
                                    </div>		
                                </div>
                            </li>				
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>  
    </div>
<?php } elseif ($current_options["home_slider_enabled"] == true && $current_options["slidertype"] == "revolution" && function_exists("add_revslider")) { ?>
    <div class="homepage_mycarousel<?php echo $current_options["home_slider_enabled"] ? " " . $current_options["revolutionslidername"] . " " : " "; ?>rellax" data-rellax-speed="<?php echo $current_options["data_rellax_speed_slider"]; ?>">		
        <?php add_revslider($current_options["revolutionslidername"]); ?>
    </div>
<?php } else { ?>
    <?php get_template_part("template-parts/index/index", "banner"); ?>
<?php }

function render_slide($class, $style=""){ 
    $current_options = get_current_options(); ?>
    <li class="<?php echo $class; ?>" <?php if(!empty($style)) { echo 'style="' . $style . '"'; } ?>>
        <?php if (has_post_thumbnail()): ?>
            <?php $defalt_arg = ["class" => "img-responsive"]; ?>
            <?php the_post_thumbnail("bigbanner-thumb", $defalt_arg); ?>
        <?php endif; ?>
        <div class="flex-slider-center">
            <div <?php if ($current_options["home_slider_desktop_title_enabled"] != true) { ?> style="display: none;"  <?php } ?> class="slide-text-bg1 <?php if ($current_options["home_slider_desktop_title_enabled"] == true) { echo "desktop-active"; } ?> <?php if ($current_options["home_slider_mobile_title_enabled"] == true) { echo "mobile-active"; } ?>">
                <h2><?php the_title(); ?></h2>
            </div>
            <?php if (get_post_meta(get_the_ID(), "slider_title", true)) { ?>
                <div <?php if ($current_options["home_slider_desktop_subtitle_enabled"] != true) { ?> style="display: none;"  <?php } ?> <?php if ($current_options["home_slider_desktop_title_enabled"] != true) { ?> id="slider_desktop_slider_title" <?php } ?> class="slide-text-bg2 <?php if ($current_options["home_slider_mobile_title_enabled"] == true) { echo "mobile-active"; } else { echo "mobile-deactive"; } ?> <?php if ($current_options["home_slider_mobile_subtitle_enabled"] == true) { echo "mobile-subtitle-active"; } else { echo "mobile-subtitle-deactive";} ?>">
                    <h1><?php echo get_post_meta(get_the_ID(), "slider_title", true); ?></h1>
                </div>
            <?php }
            if (get_post_meta(get_the_ID(), "slider_description", true)) { ?>
                <div <?php if ($current_options["home_slider_desktop_desc_enabled"] != true) { ?> style="display: none;" <?php } ?> class="slide-text-bg3 <?php if ($current_options["home_slider_mobile_desc_enabled"] == true) { echo "mobile-description-active"; } else { echo "mobile-description-deactive"; } ?>">
                    <p><?php echo get_post_meta(get_the_ID(), "slider_description", true); ?></p>
                </div>
            <?php }
            if (get_post_meta(get_the_ID(), "slider_button_text", true)) { ?>
                <div <?php if ($current_options["home_slider_desktop_button_enabled"] != true) { ?> style="display: none;" <?php } ?> class="flex_btn_div <?php if ($current_options["home_slider_mobile_button_enabled"] == true) { echo "mobile-button-active"; } else { echo "mobile-button-deactive"; } ?>">
                    <form action="<?php echo get_post_meta(get_the_ID(), "slider_button_link", true); ?>" <?php blank_target(get_post_meta(get_the_ID(), "slider_button_target", true), 'method="get"'); ?>>
                        <button class="btn more flex_btn" type="submit">
                            <?php echo get_post_meta(get_the_ID(), "slider_button_text", true); ?>
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </li>
<?php } ?>
