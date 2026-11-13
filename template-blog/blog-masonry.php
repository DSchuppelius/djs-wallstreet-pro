<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-masonry.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Kompatibilitaet: Masonry-Liste, Spaltenzahl aus dem Namen des Seitentemplates.
 */

$columns = (int) filter_var(basename((string) get_page_template_slug(), ".php"), FILTER_SANITIZE_NUMBER_INT);
djs_blog_page(["view" => "masonry", "sidebar" => "none", "columns" => $columns ? abs($columns) : 3]);
