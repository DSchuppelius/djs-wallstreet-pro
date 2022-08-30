<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-3.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>
<div class="navbar-header index2 header-style-<?php echo $current_options["header_presets_stlyle"]; ?>">
	<div class="container">
		<?php
  get_template_part("template-parts/global/header/navbar", "logo");
  get_template_part("template-parts/global/separate-search-cart");
  ?>
	</div>
</div>
<!--/Header Details Section-->	
	
<!--Logo & Menu Section-->
<div class="navbar navbar-wrapper navbar-inverse navbar-static-top navbar2 header-style-<?php echo $current_options["header_presets_stlyle"]; ?>" role="navigation">
	<div class="container">
		<?php get_template_part("template-parts/global/header/navbar", "button"); ?>
		<div class="navbar-collapse collapse">
			<?php wp_nav_menu([
       "theme_location" => "primary",
       "container" => "nav-collapse collapse navbar-inverse-collapse",
       "menu_class" => "nav navbar-nav navbar-left",
       "fallback_cb" => "theme_fallback_page_menu",
       "walker" => new Theme_Bootstrap_Walker_Nav_Menu(),
   ]); ?>
		</div>
	</div>
</div>