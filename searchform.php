<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : searchform.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$field_id = wp_unique_id("search-field-");
$label    = $args["aria_label"] ?? __("Search", "djs-wallstreet-pro"); ?>
<form role="search" method="get" class="search-form join w-full" action="<?php echo esc_url(home_url("/")); ?>" aria-label="<?php echo esc_attr($label); ?>">
    <label class="screen-reader-text" for="<?php echo esc_attr($field_id); ?>"><?php esc_html_e("Search for:", "djs-wallstreet-pro"); ?></label>
    <input type="search" id="<?php echo esc_attr($field_id); ?>" class="input join-item search-field" name="s" required
        placeholder="<?php esc_attr_e("Search Here", "djs-wallstreet-pro"); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
    <button type="submit" class="btn btn-primary join-item search-submit">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <span class="screen-reader-text sm:not-sr-only"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></span>
    </button>
</form>
