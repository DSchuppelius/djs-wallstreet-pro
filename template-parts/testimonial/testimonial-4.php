<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : testimonial-4.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup_posttypes = PostTypes_Plugin_Setup::instance();
$testimonial_columns = get_testimonial_columns();

get_template_part("template-parts/testimonial/carousel", "script");
?>
<!-- Testimonial Section -->
<div class="testimonial-section testimonial3"
    style="background: url('<?php echo $current_setup_posttypes->get("testimonial_background"); ?>'); background-size:cover;">
    <div class="overlay">
        <div class="container">
            <div class="row" <?php if (is_testimonial_carousel()): ?> id="testimonial-scroll" <?php endif; ?>>
                <?php $count_posts = wp_count_posts(TESTIMONIAL_POST_TYPE)->publish;
                $args = [
                    "post_type" => TESTIMONIAL_POST_TYPE,
                    "posts_per_page" => $count_posts,
                ];
                $testimonial = new WP_Query($args);
                if ($testimonial->have_posts()) {
                    $first_post = true;
                    while ($testimonial->have_posts()) {
                        $testimonial->the_post();
                        $testimonial_description_text = sanitize_text_field(get_post_meta(get_the_ID(), "testimonial_description_text", true));
                        if (is_testimonial_grid()) { ?>
                <div class="col-md-<?php echo $testimonial_columns; ?>">
                    <div class="testimonial-area pull-left <?php echo $first_post ? 'first' : 'next'; ?>">
                        <?php } else { ?>
                        <div
                            class="col-md-<?php echo $testimonial_columns; ?> testimonial-area pull-left <?php echo $first_post ? 'first' : 'next'; ?>">
                            <?php }
                        $defalt_arg = ["class" => "img-circle img-responsive"];
                        if (has_post_thumbnail()) { ?>
                            <div><?php the_post_thumbnail("", $defalt_arg); ?></div>
                            <?php } ?>
                            <p><?php if (!empty($testimonial_description_text)) { echo $testimonial_description_text; } ?>
                            </p>
                            <h2><i></i><?php the_title(); ?><i></i></h2>
                            <?php if (is_testimonial_grid()) { ?>
                        </div>
                    </div>
                    <?php } else { ?>
                </div>
                <?php } ?>
                <?php $first_post = false;
                    }
                } else {
                    for ($i = 1; $i <= 4; $i++) {
                        if (is_testimonial_grid()) { ?>
                <div class="col-md-<?php echo $testimonial_columns; ?>">
                    <div class="testimonial-area pull-left <?php echo $i==1 ? 'first' : 'next'; ?>">
                        <?php } else { ?>
                        <div
                            class="col-md-<?php echo $testimonial_columns; ?> testimonial-area pull-left <?php echo $i==1 ? 'first' : 'next'; ?>">
                            <?php } ?>
                            <div><img class="img-circle img-responsive" alt="Wallstreet Image"
                                    src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/testi<?php echo $i; ?>.jpg"></div>
                            <p><?php echo "Juis voluptatem sequi nesciunt. Neque porro quisquam est, qui don numquam eius modi ssim hen urlus mattis dignissim dapibctumst."; ?>
                            </p>
                            <h2><i></i> <?php echo "David Warner"; ?><i></i></h2>
                            <?php if (is_testimonial_grid()) { ?>
                        </div>
                    </div>
                    <?php } else { ?>
                </div>
                <?php }
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Testimonial Section -->