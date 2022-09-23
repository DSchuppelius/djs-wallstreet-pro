<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);
?>
<header>
    <h2><a href="<?php esc_url(the_permalink()); ?>"><?php the_content_title(); ?></a></h2>
</header>
<section class="content-section">
    <div class="content"><?php the_content(); ?></div>
</section>
<?php
get_named_template_parts("template-parts/content/content", ["meta-footer", "footer"]);
if (is_meta_enabled("blog")) {
    get_template_part("template-parts/content/content", "author");
}
?>
