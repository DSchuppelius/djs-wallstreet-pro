<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if(defined("DJS_POSTTYPE_PLUGIN")) {
    switch (get_post_type()) {
        case PORTFOLIO_POST_TYPE:
            get_template_parts(["template-single/single", "portfolio"], true, true);
            break;
        case SERVICE_POST_TYPE:
            get_template_parts(["template-single/single", "service"], true, true);
            break;
        default:
            get_template_parts(["template-single/single"], true, true);
            break;
    }
} else { get_template_parts(["template-single/single"], true, true); } ?>
