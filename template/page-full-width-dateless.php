<?php
/* Template Name: Page Full Width (without date)
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page-full-width-dateless.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["sidebar" => "none", "class" => "page-full-width"]);

while (have_posts()) {
    the_post();
    get_template_part("template-parts/content/content", "complete");
    comments_template("", true);
}

djs_layout_end();
get_footer();
