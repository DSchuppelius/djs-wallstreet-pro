<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : header-5.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>
<div class="navbar navbar-wrapper navbar-inverse navbar-static-top  navbar4 header-style-<?php echo $current_options["header_presets_stlyle"]; ?>" role="navigation">
	<div class="container">
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="navbar-header">
				<?php get_named_template_parts("template-parts/global/header/navbar", ["logo", "button"]); ?>
			</div>
		</div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="navbar-collapse collapse">
	            <?php get_template_part("template-parts/global/menu-search"); ?>
		   </div>
        </div>
    </div>
</div>
