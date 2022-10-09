<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : sidebar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

if (is_active_sidebar("sidebar_primary")) { ?>
<!--Sidebar Area-->
    <div class="col-md-4 flexcolumn<?php values_on_current_option("flexelements", " fill"); ?>">
        <div class="sidebar-section <?php with_filler(); innerrow_frame_border(" "); ?>">
            <?php dynamic_sidebar("sidebar_primary"); ?>
        </div>
        <?php get_template_part("template-parts/content/filler"); ?>
    </div>
<!--Sidebar Area-->
<?php } ?>
