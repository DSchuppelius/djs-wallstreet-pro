<?php
/* Template Name: Home Page
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : homepage.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
get_header();

get_template_part("template-parts/index/index", "slider");
get_template_part("template-parts/index/selector");

get_footer();
?>
