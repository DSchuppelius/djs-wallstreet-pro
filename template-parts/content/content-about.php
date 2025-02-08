<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;
global $first_post;
global $no_thumb;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "blog-detail-section";
$first_post = true;
$no_thumb = true;

get_named_template_parts("template-parts/content/content", ["head", "meta-header"]); ?>

<header>
    <h1><a href="<?php esc_url(the_permalink()); ?>"><?php the_content_title(); ?></a></h1>
</header>
<section class="content-section about">
    <div class="content"><?php the_content(); ?></div>
</section>

<?php get_named_template_parts("template-parts/content/content", ["meta-footer", "footer"]);

wp_link_pages([
    "before" => '<div class="blog-pagination"><p class="page-links">' . esc_html__("Page", "djs-wallstreet-pro") . ":",
    "after" => "</p></div>",
    "link_before" => "",
    "link_after" => "",
]);
