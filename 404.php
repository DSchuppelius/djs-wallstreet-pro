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
<div class="container error">
    <div class="row">	
        <div class="col-md-12">
            <div class="error_404">
                <h2><?php esc_html_e("Error 404", "djs-wallstreet-pro"); ?></h2>
                <h4><?php esc_html_e("Oops! Page not found", "djs-wallstreet-pro"); ?></h4>
                <p><?php esc_html_e("We are sorry, but the page you are looking for does not exist.", "djs-wallstreet-pro"); ?></p>
                <p><a class="button btn back" href="<?php echo esc_url(home_url('/')); ?>" id="blogdetail_btn"><?php esc_html_e("Go back", "djs-wallstreet-pro"); ?></a></p>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
