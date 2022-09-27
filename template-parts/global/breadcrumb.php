<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : breadcrumb.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>

<div class="page-breadcrumbs rellax" data-rellax-speed="<?php echo $current_options["data_rellax_speed_breadcrumbs"]; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumbs">
                    <?php if (function_exists("qt_custom_breadcrumbs")) {
                        qt_custom_breadcrumbs();
                    } ?>
                </ol>
            </div>
        </div>	
    </div>
</div>
