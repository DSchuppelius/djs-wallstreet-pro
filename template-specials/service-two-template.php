<?php
/* Template Name: Service Two Template
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : service-two-template.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
get_header();
get_template_part("template-parts/index/index", "banner");
$current_setup_posttypes = PostTypes_Plugin_Setup::instance();
?>
<!-- Service Section -->
<div class="container">
    <div class="row">
        <div class="section_heading_title">
            <?php if ($current_setup_posttypes->get("service_title") != ""); ?>
            <h1><?php echo $current_setup_posttypes->get("service_title"); ?></h1>
            <div class="pagetitle-separator">
                <div class="pagetitle-separator-border">
                    <div class="pagetitle-separator-box"></div>
                </div>
            </div>
            <?php if ($current_setup_posttypes->get("service_description") != ""); ?>
            <p><?php echo $current_setup_posttypes->get("service_description"); ?></p>
        </div>
    </div>
    <div class="row service-section service1">
        <?php $count_posts = wp_count_posts(SERVICE_POST_TYPE)->publish;
        if ($count_posts > 3) {
            $count_posts = 3;
        }
        $arg = ["post_type" => SERVICE_POST_TYPE, "posts_per_page" => $count_posts];
        $service = new WP_Query($arg);
        if ($service->have_posts()) {
            while ($service->have_posts()) {
                $service->the_post();
                $service_icon_image = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_image", true));
                $service_icon_target = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_target", true));
                $meta_service_link = sanitize_text_field(get_post_meta(get_the_ID(), "meta_service_link", true));
                $meta_service_target = sanitize_text_field(get_post_meta(get_the_ID(), "meta_service_target", true));
                $service_description_text = sanitize_text_field(get_post_meta(get_the_ID(), "service_description_text", true));
                $service_readmore_text = sanitize_text_field(get_post_meta(get_the_ID(), "service_readmore_text", true)); ?>
        <div class="col-md-4 col-sm-6 service-effect">
            <?php if (get_post_meta(get_the_ID(), "meta_service_link", true)) {
                        $meta_service_link = esc_url($meta_service_link);
                    } else {
                        $meta_service_link = esc_url(get_the_permalink());
                    } ?>
            <?php if ($service_icon_target && $service_icon_image) { ?>
            <div class="service-box">
                <a href="<?php echo $meta_service_link; ?>"
                    <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                    <i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
                </a>
            </div>
            <?php } else {
                        $defalt_arg = ["class" => "img-responsive"];
                        if (has_post_thumbnail()) { ?>
            <div class="service-box">
                <a href="<?php echo $meta_service_link; ?>"
                    <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                    <?php the_post_thumbnail("", $defalt_arg); ?>
                </a>
            </div>
            <?php } else { ?>
            <div class="other-service-area1">
                <a href="<?php echo $meta_service_link; ?>"
                    <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                    <i class="fa" style="font-size:24px;"><?php esc_html_e("Icon", "djs-wallstreet-pro"); ?></i>
                </a>
            </div>
            <?php }
                    } ?>
            <div class="service-area">
                <h2><a href="<?php echo $meta_service_link; ?>"
                        <?php blank_target($meta_service_target); ?>><?php the_title(); ?></a></h2>
                <p><?php if ($service_description_text) { echo $service_description_text; } ?></p>
                <?php if ($service_readmore_text) { ?>
                <div class="service-btn"><a href="<?php echo $meta_service_link; ?>">
                        <?php echo $service_readmore_text; ?> </a></div>
                <?php } ?>
            </div>
        </div>
        <?php }
        } else {
            $service_title = ["", esc_html__("Product designing", "djs-wallstreet-pro"), esc_html__("WordPress themes", "djs-wallstreet-pro"), esc_html__("Responsive Design", "djs-wallstreet-pro")];
            for ($i = 1; $i <= 3; $i++) { ?>
        <div class="col-md-4 col-sm-6 service-effect">
            <div class="service-box">
                <img class="img-responsive"
                    src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/service<?php echo $i; ?>.jpg">
            </div>
            <div class="service-area">
                <h2><a href="<?php the_currentURL(); ?>"><?php echo $service_title[$i]; ?></a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit dignissim dapib tumst dign eger porta nisl.</p>
                <div class="service-btn"><a
                        href="<?php the_currentURL(); ?>"><?php esc_html_e("Read More", "djs-wallstreet-pro"); ?></a>
                </div>
            </div>
        </div>
        <?php }
        } ?>
    </div>
</div>
<!-- /Service Section -->

<!-- Our Other Service Section -->
<div class="container">
    <?php get_template_part("template-parts/index/index", "calloutarea"); ?>

    <?php if ($current_setup_posttypes->get("other_service_section_enabled") == true) { ?>
    <?php $count_posts = wp_count_posts("service")->publish;
        if ($count_posts >= 4 || $count_posts == 0) { ?>
    <div class="row">
        <div class="section_heading_title">
            <?php if ($current_setup_posttypes->get("other_service_title") != "") { ?>
            <h1><?php echo $current_setup_posttypes->get("other_service_title"); ?></h1>
            <?php } ?>
            <div class="pagetitle-separator">
                <div class="pagetitle-separator-border">
                    <div class="pagetitle-separator-box"></div>
                </div>
            </div>
            <?php if ($current_setup_posttypes->get("other_service_description") != "") { ?>
            <p><?php echo $current_setup_posttypes->get("other_service_description"); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="row service-section service1">
        <?php $j = 1;
            $count_posts = wp_count_posts(SERVICE_POST_TYPE)->publish;
            $arg = [
                "offset" => "3",
                "post_type" => SERVICE_POST_TYPE,
                "posts_per_page" => $count_posts,
            ];
            $service = new WP_Query($arg);
            if ($service->have_posts()) {
                while ($service->have_posts()) {
                    $service->the_post();
                    $service_icon_image = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_image", true));
                    $service_icon_target = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_target", true));
                    $service_description_text = sanitize_text_field(get_post_meta(get_the_ID(), "service_description_text", true));

                    if ($service_icon_target && $service_icon_image) { ?>
        <div class="col-md-3 other-service-area">
            <i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
            <h2><?php the_title(); ?></h2>
            <p><?php if ($service_description_text) { echo $service_description_text; } ?></p>
        </div>
        <?php } else {
                        $defalt_arg = ["class" => "img-responsive"];
                        if (has_post_thumbnail()) { ?>
        <div class="col-md-3 other-service-area service-box1">
            <?php the_post_thumbnail("", $defalt_arg); ?>
            <h2><?php the_title(); ?></h2>
            <p><?php if ($service_description_text) { echo $service_description_text; } ?></p>
        </div>
        <?php } else { ?>
        <div class="col-md-3 other-service-area">
            <i class="fa" style="font-size:16px;"><?php esc_html_e("Icon", "djs-wallstreet-pro"); ?></i>
            <h2><?php the_title(); ?></h2>
            <p><?php if ($service_description_text) { echo $service_description_text; } ?></p>
        </div>
        <?php }
                    }
                    if ($j % 4 == 0) {
                        echo "<div class='clearfix'></div>";
                    }
                    $j++;
                }
            } else {
                $count_posts = wp_count_posts("service")->publish;
                $service_title = [__("Responsive", "djs-wallstreet-pro"), esc_html__("WordPress themes", "djs-wallstreet-pro"), esc_html__("Mobile ready", "djs-wallstreet-pro"), esc_html__("Live support", "djs-wallstreet-pro")];
                $other_service_icon = ["fa-tablet", "fa-tachometer", "fa-mobile", "fa-support"];
                if ($count_posts >= 4 || $count_posts == 0) {
                    for ($i = 0; $i <= 3; $i++) { ?>
        <div class="col-md-3 other-service-area">
            <a href=""><i class="fa <?php echo $other_service_icon[$i]; ?>"></i></a>
            <h2><?php echo $service_title[$i]; ?></h2>
            <p>Mauris rhoncus pretium porttitor Cras scelerisque commodo odio Phasellus dolor.</p>
        </div>
        <?php }
                }
            } ?>
    </div>
    <?php } ?>
</div>
<?php get_footer(); ?>
<!-- /Our Other Service Section -->