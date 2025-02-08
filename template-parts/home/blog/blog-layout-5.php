<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-layout-5.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$post_per_page = $current_setup->get("home_blog_counts"); ?>

<div class="container home-blog-section wow fadeInDown" data-wow-delay="1s">
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $j = 1;
                $args = [
                    "post_type" => "post",
                    "posts_per_page" => $post_per_page,
                    "post__not_in" => get_option("sticky_posts"),
                ];
                query_posts($args);
                if (query_posts($args)) {
                    while (have_posts()):
                        the_post();
                        $recent_expet = get_the_excerpt(); ?>
                <div class="blog-section-left blog-list-view">
                    <div class="media">
                        <?php $defalt_arg = ["class" => "img-responsive"];
                                if (has_post_thumbnail()): ?>
                        <div class="blog-post-img">
                            <a
                                href="<?php esc_url(the_permalink()); ?>"><?php the_post_thumbnail("", $defalt_arg); ?></a>
                        </div>
                        <?php endif; ?>

                        <div class="blog-post-title media-body">
                            <?php if ($current_setup->get("home_meta_section_settings") == false) { ?>
                            <div class="blog-post-date">
                                <span
                                    class="date"><?php echo get_the_date($current_setup->get("fulldateformat")); ?></span>
                                <span class="comment"><i
                                        class="fa fa-comment"></i><?php comments_number("0", "1", "%"); ?></span>
                            </div>
                            <?php } ?>
                            <div class="blog-post-title-wrapper">
                                <h1><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h1>
                                <p><?php echo get_the_excerpt(); ?></p>
                                <?php the_read_more("home-blog-btn"); ?>
                                <div class="blog-post-detail">
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>"><i
                                            class="fa fa-user"></i> <?php the_author(); ?></a>
                                    <?php if (has_tag()): ?>
                                    <div class="blog-tags">
                                        <i class="fa fa-tags"></i><?php the_tags("", ", ", ""); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                } else {
                    echo "<div class='post_message'>" . esc_html__("No posts to show", "djs-wallstreet-pro") . "</div>";
                }

                if ($current_setup->get("view_all_posts_btn_enabled") == true) {
                    the_show_all($current_setup->get("all_posts_link"), $current_setup->get("view_all_posts_text"), $current_setup->get("view_all_link_target"));
                } ?>
            </div>
        </div>
    </div>
</div>