<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : carousel-script.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$testimonial_slide_type = $current_options["testimonial_slide_type"];
$testimonial_scroll_items = $current_options["testimonial_scroll_items"];
$testimonial_scroll_duration = $current_options["testimonial_scroll_duration"];
$testimonial_timeout_duration = $current_options["testimonial_timeout_duration"];

if (!is_testimonial_grid()): ?>
	<script>
		jQuery(function() {
			jQuery('#testimonial-scroll').carouFredSel( {
				width: '100%',
				responsive : true,
				circular: true,
				pagination: "#pager2",
				items: {
					height : 'variable',
					visible: {
						min: 1,
						max: 2
					}
				},
				prev: '#prev3',
				next: '#next3',
				directon: 'left',
				auto: true,
				scroll: {
					items: <?php echo $testimonial_scroll_items; ?>,
					duration: <?php echo $testimonial_scroll_duration; ?>,
					fx: '<?php echo $testimonial_slide_type; ?>',
					timeoutDuration: <?php echo $testimonial_timeout_duration; ?>,
					pauseOnHover: true,
				},
			}).trigger('resize');
		});
	</script>
<?php endif; ?>
