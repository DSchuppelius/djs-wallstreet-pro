<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);

if (has_post_format("status")) {
    get_template_part("template-parts/excerpt/excerpt", "status");
} else { ?>
    <header>
        <h2><a href="<?php the_permalink(); ?>"><?php the_content_title(); ?></a></h2>
    </header>
    <section>
        <div class="content single"><?php the_content(); ?></div>
    </section>
<?php }
get_named_template_parts("template-parts/content/content", ["meta-footer", "footer"]);

wp_link_pages([
    "before" => '<div class="blog-pagination"><p class="page-links">' . __("Page", "wallstreet") . ":",
    "after" => "</p></div>",
    "link_before" => "",
    "link_after" => "",
]);
get_template_part("template-parts/content/content", "author"); ?>
