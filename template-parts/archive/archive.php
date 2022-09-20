<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : archive.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */ 
global $more;
global $wp_query;
global $first_post;
global $archive_type;
global $only_one_post;
global $theme_blog_section;

$current_options = get_current_options();
$theme_blog_section = "blog-section-left";
get_template_parts(["template-parts/index/index", "banner"], true);

$post_type_data = $wp_query;
?>
<div class="container archive<?php echo empty($archive_type) ? "" : " " . $archive_type; ?>">
    <div class="row <?php row_frame_border(""); ?> flexstretch">
        <div class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?> flexcolumn">
            <?php $paged = get_query_var("paged") ? get_query_var("paged") : 1;
            if(!empty($archive_type))
                $post_type_data = new WP_Query([
                    "post_type" => "post",
                    "paged" => $paged,
                    $archive_type => get_query_var($archive_type)
                ]);
            $only_one_post = $post_type_data->found_posts == 1;
            $first_post = true;
            while ($post_type_data->have_posts()) {
                $post_type_data->the_post();
                $more = 0;
                get_template_part("template-parts/content/content", get_theme_mod("display_excerpt_or_full_post", "excerpt"));
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
