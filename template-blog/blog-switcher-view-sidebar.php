<?php
/* Template Name: Blog Switcher View Sidebar
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-switcher-view-sidebar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $more;
global $first_post;
global $only_one_post;
global $theme_blog_section;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "media";
get_template_parts(["template-parts/index/index", "banner"], true);
?>
<style type="text/css">
.blog-post-title-wrapper-full div .blog-btn {
    visibility: hidden;
    border-radius: 3px 3px 3px 3px;
    cursor: pointer;
    display: contents;
    font-family: 'SiteFont';
    font-weight: 100;
    font-size: 0;
    line-height: 0;
    margin-top: 0;
    margin-bottom: 0;
    padding: 0;
}

.blog-post-title-wrapper-full div .blog-btn:after {
    content: '<?php echo $current_setup->get("blog_template_read_more"); ?>';
    visibility: visible;
    background-color: #00c2a9;
    border-radius: 3px 3px 3px 3px;
    cursor: pointer;
    display: inline-block;
    font-family: 'SiteFont';
    font-weight: 400;
    font-size: 13px;
    line-height: 20px;
    margin-top: 12px;
    margin-bottom: 35px;
    padding: 9px 18px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    text-decoration: none;
    float: left;
}

.left .has-post-thumbnail .media-body {
    display: block;
}
</style>
<div class="blog6 blog-section">
    <div class="container blog-switcher-view sidebar">
        <div class="row <?php row_frame_border(""); ?> flexstretch">
            <!--Blog Area-->
            <div class="col-md-8">
                <?php
                $switcher = 1;
                $paged = get_query_var("paged") ? get_query_var("paged") : 1;
                $args = ["post_type" => "post", "paged" => $paged];
                $post_type_data = new WP_Query($args);
                $only_one_post = $post_type_data->found_posts == 1;
                $first_post = true;
                while ($post_type_data->have_posts()) {
                    $post_type_data->the_post();
                    $more = 0; ?>
                <div class="blog-section-left blog-list-view <?php echo ($switcher % 2 == 0) ? "right" : "left"; ?>">
                    <?php get_template_part("template-parts/content/content", $current_setup->get("blog_template_content_excerpt_get_setting")); ?>
                </div>
                <?php $switcher++;
                    $first_post = false;
                }
                the_pagination($paged, $post_type_data);
                get_template_part("template-parts/content/filler");
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>