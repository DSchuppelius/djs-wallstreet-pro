<?php
/*
 * Created on   : Fri Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-led.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Format-LED oben rechts an Beitraegen mit Beitragsformat (Farbe je Format, blinkt bei Hover).
 */

$format = get_post_format();
if (!$format) {
    return;
} ?>
<span class="content-led <?php echo esc_attr($format); ?>" title="<?php echo esc_attr(djs_post_format_label()); ?>" aria-hidden="true"></span>
