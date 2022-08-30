<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : calltoaction_title.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>
<div class="container">
	<?php
 if (!empty($current_options["testimonial_cta_title"]) || !empty($current_options["testimonial_cta_description"])) { ?>
		<div class="row">
			<div class="section_heading_title">
				<?php if ($current_options["testimonial_cta_title"] != "") { ?>
					<h1><?php echo $current_options["testimonial_cta_title"]; ?></h1>
					<div class="pagetitle-separator">
						<div class="pagetitle-separator-border">
							<div class="pagetitle-separator-box"></div>
						</div>
					</div>
				<?php } ?>
				<?php if ($current_options["testimonial_cta_description"] != "") { ?>
					<p><?php echo $current_options["testimonial_cta_description"]; ?></p>
				<?php } ?>
			</div>
		</div>
	<?php }
 get_template_part("template-parts/index/index", "calloutarea");
 ?>
</div>