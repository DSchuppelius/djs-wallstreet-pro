<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-layout-1.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$post_per_page = $current_options["home_blog_counts"];
?>	
<div class="container home-blog-section">
    <?php if (!empty($current_options["home_blog_heading"]) || !empty($current_options["home_blog_description"])): ?>
        <div class="row">
            <div class="section_heading_title">
                <?php if ($current_options["home_blog_heading"]) { ?>
                    <h1><?php echo $current_options["home_blog_heading"]; ?></h1>
                <?php } ?>
                <?php if ($current_options["home_blog_description"]) { ?>
                    <div class="pagetitle-separator">
                        <div class="pagetitle-separator-border">
                            <div class="pagetitle-separator-box"></div>
                        </div>
                    </div>
                    <p><?php echo $current_options["home_blog_description"]; ?></p>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row blogview flexstretch">
        <?php $j = 1;
        $col_count = 3;
        $tax_query = [[
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => [
                'post-format-aside',
                'post-format-status',
                'post-format-quote',
                'post-format-audio',
                'post-format-gallery',
                'post-format-image',
                'post-format-link',
                'post-format-video' 
            ],
            'operator' => 'NOT IN'
        ]];

        $args = [
            "post_type" => "post",
            "posts_per_page" => $post_per_page,
            "post__not_in" => get_option("sticky_posts"),
            'tax_query' => $tax_query
        ];

        $blog_posts = new WP_Query($args);
        if ($blog_posts->have_posts()) {
            while ($blog_posts->have_posts()):

                $blog_posts->the_post();
                $recent_expet = get_the_excerpt();
                $blog_row_pos = get_first_middle_last_row($j, $blog_posts->post_count, $col_count, " ");
                $blog_item_pos = get_first_middle_last($j, $blog_posts->post_count); ?>
                <div class="col-md-4 col-sm-4 flexstretch <?php echo $blog_item_pos . $blog_row_pos; ?>">
                    <div class="home-blog-area<?php big_Border(" "); ?>">
                        <div class="home-blog-post-img">
                            <?php $default_arg = ["class" => "img-responsive"];
                            if (has_post_thumbnail()):
                                the_post_thumbnail("index-thumb", $default_arg);
                            endif; ?>
                        </div>
                        <div class="home-blog-info">						
                            <?php if ($current_options["home_meta_section_settings"] == false) { ?>
                                <div class="home-blog-post-detail">
                                    <span class="date"><?php echo get_the_date(); ?> </span>
                                    <span class="comment"><a href="<?php the_permalink(); ?>"><i class="fa fa-comment"></i><?php comments_number(__("No Comments", "wallstreet"), __("1 Comment", "wallstreet"), __("% Comments", "wallstreet")); ?></a></span>
                                </div>
                            <?php } ?>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>		
                            <div class="home-blog-description"><p><?php echo get_the_excerpt(); ?></p></div>
                            <div class="home-blog-btn"><form action="<?php the_permalink(); ?>"><button class="btn more" type="submit" ><?php _e("Read More", "wallstreet"); ?></button></form></div>							
                        </div>
                    </div>
                </div>
                <?php $j++; ?>
            <?php endwhile;
        } else {
            echo "<div class='post_message'>" . __("No posts to show", "wallstreet") . "</div>";
        } ?>
    </div>
    <?php if ($current_options["view_all_posts_btn_enabled"] == true) {
        if ($current_options["view_all_posts_text"]) { ?>
            <div class ="row">
                <div class="proejct-btn">
                    <form action="<?php if ($current_options["all_posts_link"] != "") { echo $current_options["all_posts_link"]; } ?>" <?php if ($current_options["view_all_lnik_target"] == true) { echo 'method="get" target="_blank"'; } ?>>
                        <button class="btn more blog" type="submit" ><?php echo $current_options["view_all_posts_text"]; ?></button>
                    </form>
                </div>
            </div>
        <?php }
    } ?>
</div>