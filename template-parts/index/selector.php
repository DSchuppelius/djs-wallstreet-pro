<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : selector.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$data = is_array($current_options["front_page_data"]) ? $current_options["front_page_data"] : explode(",", $current_options["front_page_data"]);

if ($data) {
    foreach ($data as $key => $value) {
        switch ($value) {
            case "service":
                //****** get index service  ********
                get_template_part("template-parts/index/index", "service");
                break;
            case "portfolio":
                //****** get index project  ********
                get_template_part("template-parts/index/index", "portfolio");
                break;
            case "team":
                //****** get index project  ********
                get_template_part("template-parts/index/index", "team");
                break;
            case "testimonials":
                //****** get index testimonials  ********
                get_template_part("template-parts/index/index", "testimonials");
                break;
            case "blog":
                //****** get index recent blog  ********
                get_template_part("template-parts/index/index", "blog");
                break;
            case "features":
                //****** get index Features Section  ********
                get_template_part("template-parts/index/index", "features");
                break;
            case "client":
                //****** get index  client  ********
                get_template_part("template-parts/index/index", "client");
                break;
        }
    }
}
?>