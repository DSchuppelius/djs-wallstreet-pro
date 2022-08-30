<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-testimonials.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>

<noscript><style>.testimonial-area.next { display: none; }</style></noscript>
<?php get_template_part("template-parts/testimonial/testimonial", $current_options["testimonial_design_style"]); ?>
