<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : partner-demo.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
for ($tt = 1; $tt <= 4; $tt++) { ?>
<?php get_template_part("template-parts/partner/partner", "header"); ?>
<img src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/clients/client<?php echo $tt; ?>.png" class="img-responsive"
    title="Sonny">
<?php get_template_part("template-parts/partner/partner", "footer"); ?>
<?php } ?>