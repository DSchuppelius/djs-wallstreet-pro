<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom-post-types.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
define("CLIENT_POST_TYPE", "client");
define("PORTFOLIO_POST_TYPE", "portfolio");
define("SERVICE_POST_TYPE", "service");
define("SLIDER_POST_TYPE", "slider");
define("TEAM_POST_TYPE", "team");
define("TESTIMONIAL_POST_TYPE", "testimonial");

define("PORTFOLIO_TAXONOMY", PORTFOLIO_POST_TYPE . "_categories");

require_once "client.php";
require_once "portfolio.php";
require_once "service.php";
require_once "slider.php";
require_once "team.php";
require_once "testimonial.php";
?>
