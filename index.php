<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $more;
global $theme_blog_section;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "blog-section-left";

get_template_parts(["template-parts/index/index", "banner"], true);
?>

<!-- Blog & Sidebar Section -->
<div class="container">
    <div class="row">
        <div class="col-md-<?php echo is_active_sidebar("sidebar_primary") ? "8" : "12"; ?>">
            <?php
            $paged = get_query_var("paged") ? get_query_var("paged") : 1;
            $args = ["post_type" => "post", "paged" => $paged];
            $post_type_data = new WP_Query($args);
            while ($post_type_data->have_posts()) {
                $post_type_data->the_post();
                $more = 0;
                get_named_template_parts("template-parts/content/content", ["head", "title"]);
                the_content(esc_html__("Read More", "djs-wallstreet-pro"));
                get_named_template_parts("template-parts/content/content", ["meta", "footer"]);
            }
            the_pagination($paged, $post_type_data);
            ?>
        </div><!--/Blog Area-->
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
<!-- /Blog & Sidebar Section -->
