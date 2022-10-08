<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : selector.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $template;
$current_setup_posttypes = PostTypes_Plugin_Setup::instance();
$templates = ["template-parts/index/index", "banner"];

get_template_parts($templates, true);

if ($current_setup_posttypes->get("team_template_team_section_show_hide") == true) {
    get_template_part("template-parts/team/team", ltrim(filter_var(basename($template), FILTER_SANITIZE_NUMBER_INT), "-"));
}

if ($current_setup_posttypes->get("team_template_feature_section_show_hide") == true) {
    get_template_part("template-parts/index/index", "features");
}

if ($current_setup_posttypes->get("team_template_client_section_show_hide") == true) {
    get_template_part("template-parts/index/index", "client");
}

get_footer();
?>
