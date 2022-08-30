<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : selector.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$templates = [["template-parts/index/index", "banner"], ["template-parts/content/content", "portfolio"]];

get_template_parts($templates, true, true);
?>
