<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : woocommerce.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance(); ?>
<!-- Page Title Section -->
<?php get_template_parts(["template-parts/index/index", "banner"], true); ?>
<!-- /Page Title Section -->

<!-- Blog & Sidebar Section -->
<div class="container">
    <div class="row">
        <!--Blog Detail-->
        <div class="col-md-<?php echo is_active_sidebar("woocommerce") ? "8" : "12"; ?> col-xs-12">
            <div id="post-<?php the_ID(); ?>">
                <?php woocommerce_content(); ?>
            </div>
        </div>
        <!--/End of Blog Detail-->
        <?php get_sidebar("woocommerce"); ?>
    </div>
</div>
<!-- End of Blog & Sidebar Section -->
<div class="clearfix"></div>
<?php get_footer(); ?>