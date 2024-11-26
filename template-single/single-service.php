<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<!-- Page Title Section -->
<?php get_template_part("template-parts/index/index", "banner"); ?>
<!-- /Page Title Section -->
<!-- Blog & Sidebar Section -->
<div class="container single service">
    <div class="row <?php row_frame_border(""); ?> flexstretch">

        <!--Blog Area-->
        <div
            class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?> flexcolumn<?php values_on_current_option("flexelements", " fill"); ?>">
            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class("blog-detail-section"); ?>>
                <?php if (has_post_thumbnail()) { ?>
                <?php $defalt_arg = [
                                "class" => "img-responsive attachment-post-thumbnail",
                            ]; ?>
                <div class="blog-post-img">
                    <?php the_post_thumbnail("", $defalt_arg); ?>
                </div>
                <?php } ?>
                <div class="clear"></div>
                <div class="blog-post-title">
                    <?php if ($current_setup->get("archive_page_meta_section_settings") == false) { ?>
                    <div class="blog-post-date"><span
                            class="date"><?php echo get_the_date("j"); ?><small><?php echo get_the_date("M"); ?></small></span>
                        <span class="comment"><i
                                class="fa fa-comment"></i><?php comments_number("0", "1", "%"); ?></span>
                    </div>
                    <div class="blog-post-title-wrapper">
                        <?php } else { ?>
                        <div class="blog-post-title-wrapper" style="width:100%;">
                            <?php } ?>
                            <h2><a><?php the_title(); ?></a></h2>
                            <?php echo "<p>" . get_post_meta(get_the_ID(), "service_description_text", true) . "</p>"; ?>
                            <?php wp_link_pages([
                                        "before" => '<div class="page-links">' . esc_html__("Page", "djs-wallstreet-pro"),
                                        "after" => "</div>",
                                    ]); ?>
                            <?php if ($current_setup->get("archive_page_meta_section_settings") == false) { ?>
                            <div class="blog-post-meta">

                                <a id="blog-author"
                                    href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>"><i
                                        class="fa fa-user"></i> <?php the_author(); ?></a>
                                <?php
                                            $tag_list = get_the_tag_list();
                                            if (!empty($tag_list)) { ?>
                                <div class="blog-tags">
                                    <i class="fa fa-tags"></i><?php the_tags("", ", ", ""); ?>
                                </div>
                                <?php }
                                            ?>
                                <?php
                                            $cat_list = get_the_category_list();
                                            if (!empty($cat_list)) { ?>
                                <div class="blog-tags">
                                    <i class="fa fa-star"></i><?php the_category(", "); ?>
                                </div>
                                <?php }
                                            ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!--Blog Author-->
                <div class="blog-author">
                    <div class="media">
                        <div class="pull-left">
                            <?php echo get_avatar(get_the_author_meta("ID"), 94); ?>
                        </div>
                        <div class="media-body">
                            <h6><?php the_author(); ?></h6>
                            <p> <?php the_author_meta("description"); ?> </p>
                            <ul class="blog-author-social">
                                <?php
                                        $facebook_profile = get_the_author_meta("facebook_profile");
                                        if ($facebook_profile && $facebook_profile != "") {
                                            echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="fa-brands fa-facebook"></i></a></li>';
                                        }

                                        $linkedin_profile = get_the_author_meta("linkedin_profile");
                                        if ($linkedin_profile && $linkedin_profile != "") {
                                            echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="fa-brands fa-linkedin"></i></a></li>';
                                        }
                                        $twitter_profile = get_the_author_meta("twitter_profile");
                                        if ($twitter_profile && $twitter_profile != "") {
                                            echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="fa-brands fa-twitter"></i></a></li>';
                                        }
                                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/Blog Author-->
                <?php
                } ?>
                <?php comments_template("", true); ?>
                <?php
            } ?>
                <div class="content-section columnfiller"></div>
            </div>
            <?php get_sidebar(); ?>
            <!--/Blog Area-->
        </div>
    </div>