<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Einzelbeitrag (Header/Footer laedt single.php).
 */

get_template_part("template-parts/index/index", "banner");

djs_layout_start(["class" => "single-post"]);

while (have_posts()) {
    the_post();
    get_template_part("template-parts/content/content", "single");
    comments_template("", true);
}

djs_layout_end();
