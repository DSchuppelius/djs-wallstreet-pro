<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : searchform.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url("/")); ?>">
    <input type="text" class="search_widget_input" name="s" id="s"
        placeholder="<?php esc_attr_e("Search Here", "djs-wallstreet-pro"); ?>" required />
    <button type="submit" id="searchsubmit" class="btn search_btn" style="" name="submit"
        value="<?php esc_attr_e("Search", "djs-wallstreet-pro"); ?>"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></button>
</form>
