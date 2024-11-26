<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-testimonials.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<noscript>
    <style>
    .testimonial-area.next {
        display: none;
    }
    </style>
</noscript>
<?php if(defined("DJS_POSTTYPE_PLUGIN")) {
    $current_setup_posttypes = PostTypes_Plugin_Setup::instance();
    get_template_part("template-parts/testimonial/testimonial", $current_setup_posttypes->get("testimonial_design_style"));
} ?>