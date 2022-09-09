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
<?php $current_options = get_current_options(); ?>
<?php if ($current_options["call_out_area_enabled"] == true) { ?>
<div class="row <?php row_frame_border(""); ?> callout">		
	<div class="callout-section">
		<h3><?php if ($current_options["call_out_title"] != "") { echo $current_options["call_out_title"]; } ?></h3>
		<p>
            <?php if ($current_options["call_out_text"] != "") { echo $current_options["call_out_text"]; } ?><br>
		    <?php if ($current_options["call_out_button_text"] != "") { ?> 
    		    <a <?php if ($current_options["call_out_button_link_target"] == "on") { echo "target='_blank'"; } ?> class="normal-button  reverse" href="<?php if ($current_options["call_out_button_link"] != "") { echo $current_options["call_out_button_link"]; } ?>" ><?php echo $current_options["call_out_button_text"]; ?></a>
		    <?php } ?>
		</p>
	</div>		
</div>
<?php } ?>
<!-- /wallstreet Callout Section -->
