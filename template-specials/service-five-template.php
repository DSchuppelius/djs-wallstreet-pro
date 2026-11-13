<?php
/* Template Name: Service Five Template
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : service-five-template.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Service-Seite, Variante 5 (Darstellung wie Startseiten-Service 5).
 */

if (!defined("DJS_POSTTYPE_PLUGIN")) {
    get_template_part("template-specials/not_loaded", "plugin");
    return;
}
get_template_part("template-parts/service/page", null, ["variant" => 5]);
