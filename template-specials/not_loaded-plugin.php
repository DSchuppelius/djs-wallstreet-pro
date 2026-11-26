<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : not_loaded-plugin.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Hinweis, wenn ein Seitentemplate das Post-Types-Plugin braucht.
 */

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["sidebar" => "none", "class" => "error"]); ?>
<section class="empty-state surface-card error_404">
    <span class="material-icons empty-state__icon" aria-hidden="true">extension_off</span>
    <h2 class="empty-state__title"><?php esc_html_e("Plugin missing", "djs-wallstreet-pro"); ?></h2>
    <p><?php esc_html_e("This page template needs the plugin DJS-Wallstreet-Pro Post-Types.", "djs-wallstreet-pro"); ?></p>
    <?php if (current_user_can("install_plugins")) { ?>
        <a class="btn btn-primary" href="https://github.com/DSchuppelius/djs-wallstreet-pro-post-types/releases/latest/" target="_blank" rel="noopener"><?php esc_html_e("Download", "djs-wallstreet-pro"); ?></a>
    <?php } ?>
</section>
<?php djs_layout_end();
get_footer();
