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

if ($current_setup_posttypes->get("testimonial_template_cta_section_show_hide") == true) {
    get_template_part("template-parts/testimonial/calltoaction_title");
}

if ($current_setup_posttypes->get("testimonial_template_testimonial_section_show_hide") == true) {
    get_template_part("template-parts/testimonial/testimonial", ltrim(filter_var(basename($template), FILTER_SANITIZE_NUMBER_INT), "-"));
}

if ($current_setup_posttypes->get("testimonial_template_client_section_show_hide") == true) {
    get_template_part("template-parts/index/index", "client");
}

get_footer();
?>
