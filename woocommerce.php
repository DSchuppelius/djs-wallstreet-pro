<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : woocommerce.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["area" => "woocommerce", "class" => "woocommerce-page-shell"]); ?>
<div id="post-<?php the_ID(); ?>" class="surface-card woocommerce-content">
    <?php woocommerce_content(); ?>
</div>
<?php djs_layout_end();

get_footer();
