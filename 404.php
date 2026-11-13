<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : 404.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["sidebar" => "none", "class" => "error"]); ?>

<section class="empty-state empty-state--404 surface-card error_404">
    <p class="empty-state__code" aria-hidden="true">404</p>
    <h2 class="empty-state__title"><?php esc_html_e("Oops! Page not found", "djs-wallstreet-pro"); ?></h2>
    <p><?php esc_html_e("We are sorry, but the page you are looking for does not exist.", "djs-wallstreet-pro"); ?></p>
    <div class="empty-state__search"><?php get_search_form(); ?></div>
    <a class="btn btn-primary" href="<?php echo esc_url(home_url("/")); ?>">
        <span class="material-icons" aria-hidden="true">home</span><?php esc_html_e("Go back", "djs-wallstreet-pro"); ?>
    </a>
</section>

<?php djs_layout_end();
get_footer();
