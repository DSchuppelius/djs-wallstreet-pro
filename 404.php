<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : 404.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

get_template_parts(["template-parts/index/index", "banner"], true); ?>

<?php /* Wie bisher: Fehlermeldung gross und mittig ueber dem abgedunkelten Seitenkopf, ohne Inhaltsrahmen */ ?>
<main id="main" class="error-404 error_404" aria-labelledby="error-404-title">
    <div class="error-404__inner">
        <p class="error-404__code" aria-hidden="true"><?php esc_html_e("Error 404", "djs-wallstreet-pro"); ?></p>
        <h2 id="error-404-title" class="error-404__title"><?php esc_html_e("Oops! Page not found", "djs-wallstreet-pro"); ?></h2>
        <p class="error-404__text"><?php esc_html_e("We are sorry, but the page you are looking for does not exist.", "djs-wallstreet-pro"); ?></p>
        <a class="btn btn-primary more back" href="<?php echo esc_url(home_url("/")); ?>">
            <?php esc_html_e("Go back", "djs-wallstreet-pro"); ?><span class="material-icons" aria-hidden="true">fast_rewind</span>
        </a>
    </div>
</main>

<?php get_footer();
