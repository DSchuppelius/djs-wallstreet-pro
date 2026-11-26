<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-none.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Keine Treffer (Suche, leere Archive).
 */

?>
<section class="empty-state surface-card">
    <span class="material-icons empty-state__icon" aria-hidden="true"><?php echo is_search() ? "search_off" : "inbox"; ?></span>
    <h2 class="empty-state__title"><?php esc_html_e("Nothing Found", "djs-wallstreet-pro"); ?></h2>
    <p><?php is_search()
            ? esc_html_e("Sorry, but nothing matched your search criteria. Please try again with some different keywords.", "djs-wallstreet-pro")
            : esc_html_e("There are no posts here yet.", "djs-wallstreet-pro"); ?></p>
    <div class="empty-state__search"><?php get_search_form(); ?></div>
</section>
