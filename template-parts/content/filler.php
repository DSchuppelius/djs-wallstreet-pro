<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : filler.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Fuellflaeche am Spaltenende (Customizer: Fuellelemente hinzufuegen).
 */

if (DJS_Wallstreet_Pro_Theme_Setup::instance()->get("addflexelements")) { ?>
    <div class="columnfiller surface-card" aria-hidden="true"></div>
<?php }
