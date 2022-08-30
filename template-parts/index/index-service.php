<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-service.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<!-- wallstreet Service Section ---->
<?php
$current_options = get_current_options();
get_template_part("template-parts/home/service/servic", $current_options["service_variation"]);


?>
