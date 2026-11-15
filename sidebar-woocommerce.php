<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : sidebar-woocommerce.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

if (!is_active_sidebar("woocommerce")) {
    return;
} ?>
<aside class="layout__sidebar" aria-label="<?php esc_attr_e("Shop sidebar", "djs-wallstreet-pro"); ?>">
    <div class="sidebar-section <?php with_filler(); ?>">
        <?php dynamic_sidebar("woocommerce"); ?>
    </div>
    <?php get_template_part("template-parts/content/filler"); ?>
</aside>
