<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-calloutarea.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<!-- wallstreet Callout Section -->
<?php $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<?php if ($current_setup->get("call_out_area_enabled") == true) { ?>
<div class="row <?php row_frame_border(""); ?> callout">		
    <div class="callout-section">
        <h3><?php if ($current_setup->get("call_out_title") != "") { echo $current_setup->get("call_out_title"); } ?></h3>
        <p>
            <?php if ($current_setup->get("call_out_text") != "") { echo $current_setup->get("call_out_text"); } ?><br>
            <?php if ($current_setup->get("call_out_button_text") != "") { ?> 
                <a <?php blank_target($current_setup->get("call_out_button_link_target") == "on"); ?> class="normal-button  reverse" href="<?php if ($current_setup->get("call_out_button_link") != "") { echo $current_setup->get("call_out_button_link"); } ?>" ><?php echo $current_setup->get("call_out_button_text"); ?></a>
            <?php } ?>
        </p>
    </div>		
</div>
<?php } ?>
<!-- /wallstreet Callout Section -->
