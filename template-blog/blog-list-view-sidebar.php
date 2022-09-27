<?php
/* Template Name: Blog List View Sidebar
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-list-view-sidebar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $more;
global $first_post;
global $only_one_post;
global $theme_blog_section;

$current_options = get_current_options();
$theme_blog_section = "blog-section-left blog-list-view";
get_template_parts(["template-parts/index/index", "banner"], true);
?>
<div class="container blog-list-view sidebar">
    <div class="row <?php row_frame_border(""); ?> flexstretch">
        <div class="col-md-8">
            <?php
            $paged = get_query_var("paged") ? get_query_var("paged") : 1;
            $args = ["post_type" => "post", "paged" => $paged];
            $post_type_data = new WP_Query($args);
            $only_one_post = $post_type_data->found_posts == 1;
            $first_post = true;
            while ($post_type_data->have_posts()) {
                $post_type_data->the_post();
                $more = 0;
                get_template_part("template-parts/content/content", $current_options["blog_template_content_excerpt_get_setting"]);
                $first_post = false;
            }
            the_pagination($paged, $post_type_data);
            get_template_part("template-parts/content/filler");
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
