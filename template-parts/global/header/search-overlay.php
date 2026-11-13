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
            <label class="input input-lg site-search__field">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                <span class="screen-reader-text"><?php esc_html_e("Search for:", "djs-wallstreet-pro"); ?></span>
                <input type="search" name="s" required placeholder="<?php esc_attr_e("Search", "djs-wallstreet-pro"); ?> …" value="<?php echo esc_attr(get_search_query()); ?>" autofocus>
            </label>
            <button type="submit" class="btn btn-primary btn-lg"><?php esc_html_e("Search", "djs-wallstreet-pro"); ?></button>
        </form>
        <form method="dialog" class="site-search__close">
            <button class="btn btn-ghost btn-circle" aria-label="<?php esc_attr_e("Close", "djs-wallstreet-pro"); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">close</span>
            </button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button tabindex="-1"><?php esc_html_e("Close", "djs-wallstreet-pro"); ?></button>
    </form>
</dialog>
