<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : sidebar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

if (!is_active_sidebar("sidebar_primary")) {
    return;
} ?>
<aside class="layout__sidebar" aria-label="<?php esc_attr_e("Sidebar", "djs-wallstreet-pro"); ?>">
    <?php /* Wie bisher: Widgets in einer eigenen Flaeche, die Fuellflaeche getrennt darunter */ ?>
    <div class="sidebar-section <?php with_filler(); ?>">
        <?php dynamic_sidebar("sidebar_primary"); ?>
    </div>
    <?php get_template_part("template-parts/content/filler"); ?>
</aside>
