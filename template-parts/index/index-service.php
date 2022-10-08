<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if(defined("DJS_POSTTYPE_PLUGIN")) {
    $current_setup_posttypes = PostTypes_Plugin_Setup::instance();
    get_template_part("template-parts/home/service/servic", $current_setup_posttypes->get("service_variation"));
} ?>
