<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-layout-4.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$post_per_page = $current_setup->get("home_blog_counts");
?>
<div class="container home-blog-section">
    <?php if (!empty($current_setup->get("home_blog_heading")) || !empty($current_setup->get("home_blog_description"))): ?>
        <div class="row">
            <div class="section_heading_title">
                <?php if ($current_setup->get("home_blog_heading")) { ?>
                    <h1><?php echo $current_setup->get("home_blog_heading"); ?></h1>
                <?php } ?>
                <?php if ($current_setup->get("home_blog_description")) { ?>
                    <div class="pagetitle-separator">
                        <div class="pagetitle-separator-border">
                            <div class="pagetitle-separator-box"></div>
                        </div>
                    </div>
                    <p><?php echo $current_setup->get("home_blog_description"); ?></p>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row masonry-4">
        <?php $j = 1;
        $args = [
            "post_type" => "post",
            "posts_per_page" => $post_per_page,
            "post__not_in" => get_option("sticky_posts"),
        ];

        $home_blog_query = new WP_Query($args);
        if ($home_blog_query->have_posts()) {
            while ($home_blog_query->have_posts()):
                $home_blog_query->the_post();
                ?>
                <div class="masonry-item">
                    <div class="home-blog-area">
                        <div class="home-blog-post-img"><?php
                                                        $defalt_arg = ["class" => "img-responsive"];
                                                        if (has_post_thumbnail()):
                                                            the_post_thumbnail("", $defalt_arg);
                                                        endif; ?>
                        </div>
                        <div class="home-blog-info">
                            <?php if ($current_setup->get("home_meta_section_settings") == false) { ?>
                                <div class="home-blog-post-detail">
                                    <span class="date"><?php echo get_the_date($current_setup->get("fulldateformat")); ?> </span>
                                    <span class="comment"><a href="<?php esc_url(the_permalink()); ?>"><i
                                                class="fa fa-comment"></i><?php comments_number(esc_html__("No Comments", "djs-wallstreet-pro"), esc_html__("1 Comment", "djs-wallstreet-pro"), esc_html__("% Comments", "djs-wallstreet-pro")); ?></a></span>
                                </div>
                            <?php } ?>
                            <h2><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h2>
                            <div class="home-blog-description">
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                            <?php the_read_more("home-blog-btn"); ?>
                        </div>
                    </div>
                </div>
        <?php endwhile;
            wp_reset_postdata();
        } else {
            echo "<div class='post_message'>" . esc_html__("No posts to show", "djs-wallstreet-pro") . "</div>";
        } ?>
    </div>
    <?php if ($current_setup->get("view_all_posts_btn_enabled") == true) {
        the_show_all($current_setup->get("all_posts_link"), $current_setup->get("view_all_posts_text"), $current_setup->get("view_all_link_target"));
    } ?>
</div>