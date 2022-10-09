<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : sidebar-woocommerce.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>

<?php if (is_active_sidebar("woocommerce")): ?>
<!--Sidebar-->
    <div class="col-md-4 col-xs-12 flexcolumn<?php values_on_current_option("flexelements", " fill"); ?>">
        <div class="sidebar-section">
            <?php dynamic_sidebar("woocommerce"); ?>
        </div>
        <div class="sidebar-section columnfiller"></div>
    </div>
<!--/End of Sidebar-->
<?php endif; ?>
