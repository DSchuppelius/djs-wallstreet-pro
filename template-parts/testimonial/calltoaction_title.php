<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : calltoaction_title.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Ueberschrift ueber den Testimonials (Testimonial-Seitentemplates).
 */

$pt = djs_pt();
if (!$pt) {
    return;
} ?>
<section class="section site-wrap testimonial-cta">
    <?php djs_section_heading($pt->get("testimonial_cta_title"), $pt->get("testimonial_cta_description")); ?>
</section>
