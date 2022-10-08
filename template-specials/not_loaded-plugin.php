<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : not_loaded_plugin.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
get_template_parts(["template-parts/index/index", "banner"], true); ?>
<div class="container error">
    <div class="row">	
        <div class="col-md-12">
            <div class="error_404">
                <h2><?php esc_html_e("Plugin Error", "djs-wallstreet-pro"); ?></h2>
                <h4><?php esc_html_e("Oops! Page can not load", "djs-wallstreet-pro"); ?></h4>
                <p><?php esc_html_e('We are sorry, but the page you are looking for can not load, because the recuired plugin "DJS-Wallstreet-Pro Post-Types" does not exist or is not activated.', "djs-wallstreet-pro"); ?></p>
                <p><a class="button btn back" href="<?php echo esc_url(home_url('/')); ?>" id="blogdetail_btn"><?php esc_html_e("Go back", "djs-wallstreet-pro"); ?></a></p>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
