<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : breadcrumb.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>

<nav class="page-breadcrumbs rellax" aria-label="<?php esc_attr_e("Breadcrumb", "djs-wallstreet-pro"); ?>"
    data-rellax-speed="<?php echo intval($current_setup->get("data_rellax_speed_breadcrumbs")); ?>">
    <div class="site-wrap breadcrumbs">
        <?php djs_breadcrumbs(); ?>
    </div>
</nav>
