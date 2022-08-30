<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);

get_template_part("template-parts/excerpt/excerpt", get_post_format());

get_named_template_parts("template-parts/content/content", ["meta-footer", "footer"]);
?>
