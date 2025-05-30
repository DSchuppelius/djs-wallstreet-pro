<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : servic-5.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup_posttypes = PostTypes_Plugin_Setup::instance(); ?>
<div class="service-section">
    <div class="container wow fadeInDown" data-wow-delay="1s">
        <?php if (!empty($current_setup_posttypes->get("service_title")) || !empty($current_setup_posttypes->get("service_description"))): ?>
        <div class="row">
            <div class="section_heading_title">
                <?php if ($current_setup_posttypes->get("service_title")) { ?>
                <h1><?php echo $current_setup_posttypes->get("service_title"); ?></h1>
                <div class="pagetitle-separator">
                    <div class="pagetitle-separator-border">
                        <div class="pagetitle-separator-box"></div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($current_setup_posttypes->get("service_description")) { ?>
                <p><?php echo $current_setup_posttypes->get("service_description"); ?></p>
                <?php } ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row service4">
            <?php $j = 1;
            $total_services = $current_setup_posttypes->get("service_list");
            $args = [
                "post_type" => SERVICE_POST_TYPE,
                "posts_per_page" => $total_services,
            ];
            $service = new WP_Query($args);
            if ($service->have_posts()) {
                while ($service->have_posts()):
                    $service->the_post();
                    $service_icon_image = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_image", true));
                    $service_icon_target = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_target", true)); ?>
            <div class="col-md-4 col-sm-6">
                <div class="service-effect">
                    <?php if (get_post_meta(get_the_ID(), "meta_service_link", true)) {
                                $meta_service_link = esc_url(get_post_meta(get_the_ID(), "meta_service_link", true));
                            } else {
                                $meta_service_link = esc_url(get_the_currentURL() . "#");
                            }
                            if ($service_icon_target && $service_icon_image) { ?>
                    <div class="service-box">
                        <?php if ($meta_service_link) { ?>
                        <a href="<?php echo $meta_service_link; ?>"
                            <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                            <i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
                        </a>
                        <?php } else { ?>
                        <i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
                        <?php } ?>
                    </div>
                    <?php } else {
                                $defalt_arg = ["class" => "img-responsive"];
                                if (has_post_thumbnail()) { ?>
                    <div class="service-box">
                        <?php if ($meta_service_link) { ?>
                        <a href="<?php echo $meta_service_link; ?>"
                            <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                            <?php the_post_thumbnail("theme_service_img", $defalt_arg); ?>
                        </a>
                        <?php } else { ?>
                        <?php the_post_thumbnail("theme_service_img", $defalt_arg); ?>
                        <?php } ?>
                    </div>
                    <?php }
                            } ?>
                    <div class="service-area">
                        <h2><a href="<?php echo $meta_service_link; ?>"
                                <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                                <?php echo the_title(); ?> </a></h2>
                        <p><?php echo $excerpt = get_post_meta(get_the_ID(), "service_description_text", true); ?></p>
                        <div class="service-btn">
                            <a href="<?php echo $meta_service_link; ?>"
                                <?php blank_target(get_post_meta(get_the_ID(), "meta_service_target", true)); ?>>
                                <?php echo get_post_meta(get_the_ID(), "service_readmore_text", true); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($j % $total_services == 0) {
                        echo "<div class='clearfix'></div>";
                    }
                    $j++;
                endwhile;
            } else {
                $service_defaulttext = [__("Product designing", "djs-wallstreet-pro"), esc_html__("WordPress themes", "djs-wallstreet-pro"), esc_html__("Responsive designs", "djs-wallstreet-pro")];
                for ($i = 1; $i <= 3; $i++) { ?>
            <div class="col-md-4 col-sm-6">
                <div class="service-effect">
                    <div class="service-box">
                        <img class="img-responsive"
                            src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/service<?php echo $i; ?>.jpg">
                    </div>
                    <div class="service-area">
                        <h2><a href="<?php the_currentURL(); ?>"><?php echo $service_defaulttext[$i - 1]; ?></a></h2>
                        <p><?php echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl."; ?>
                        </p>
                        <div class="service-btn"><a
                                href="<?php the_currentURL(); ?>"><?php esc_html_e("Read More", "djs-wallstreet-pro"); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } ?>
        </div>
    </div>
</div>