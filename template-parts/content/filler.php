<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel J�rg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : filler.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();

if ($current_options["addflexelements"]) { ?>
	<div class="columnfiller<?php innerrow_Frame_Border(" "); ?>"></div>
<?php } ?>
