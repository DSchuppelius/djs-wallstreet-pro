<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : search-overlay.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Vollbild-Suche (Customizer "Suche: Toogle") als natives <dialog>:
 * Fokusfalle, Escape und Hintergrund-Sperre liefert der Browser.
 */
?>
<dialog id="site-search" class="modal site-search" aria-label="<?php esc_attr_e("Search", "djs-wallstreet-pro"); ?>">
    <div class="modal-box site-search__box">
        <form method="get" role="search" autocomplete="off" class="site-search__form" action="<?php echo esc_url(home_url("/")); ?>">
            <label class="site-search__field">
                <span class="screen-reader-text"><?php esc_html_e("Search for:", "djs-wallstreet-pro"); ?></span>
                <input type="search" class="site-search__input" name="s" required placeholder="<?php esc_attr_e("Search", "djs-wallstreet-pro"); ?> …" value="<?php echo esc_attr(get_search_query()); ?>" autofocus>
            </label>
            <button type="submit" class="btn btn-primary"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></button>
        </form>
        <form method="dialog" class="site-search__close">
            <button aria-label="<?php esc_attr_e("Close", "djs-wallstreet-pro"); ?>">
                <span class="material-icons" aria-hidden="true">close</span>
            </button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button tabindex="-1"><?php esc_html_e("Close", "djs-wallstreet-pro"); ?></button>
    </form>
</dialog>
