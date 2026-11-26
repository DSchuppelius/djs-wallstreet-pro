<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Blog-Startseite und Fallback aller Listen.
 */

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["class" => "blog-index"]);
djs_blog_loop(null, ["context" => "blog"]);
djs_layout_end();

get_footer();
