<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : footer.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $loaded_banner;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$fixed_footer  = (bool) $current_setup->get("fixedfooter_enabled");
$show_social   = (bool) $current_setup->get("footer_social_media_enabled");
$show_bar      = (bool) $current_setup->get("footerbar_enabled");

if (show_rellax_div()) { ?></div><?php } ?>
        </div><!-- #site-content -->

        <footer class="site-footer site<?php echo $fixed_footer ? " site-footer--fixed" : ""; ?>">
            <?php if (is_active_sidebar("footer-widget-area")) { ?>
                <div class="site-footer__widgets">
                    <div class="site-wrap footer-widget-section">
                        <?php dynamic_sidebar("footer-widget-area"); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ($show_social || $show_bar) { ?>
                <div class="site-footer__bar" <?php echo $fixed_footer ? "data-footer-bar" : ""; ?>>
                    <?php if ($fixed_footer) { ?>
                        <button type="button" class="site-footer__peek btn btn-circle btn-ghost show-me" data-footer-peek aria-expanded="false" aria-controls="site-footer-details">
                            <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                            <span class="screen-reader-text"><?php esc_html_e("Show site information", "djs-wallstreet-pro"); ?></span>
                        </button>
                    <?php } ?>
                    <div id="site-footer-details" class="site-wrap site-footer__details">
                        <?php if ($show_social) { ?>
                            <div class="footer-social-area">
                                <?php get_template_part("template-parts/global/social-media", null, ["context" => "footer"]); ?>
                            </div>
                        <?php } ?>
                        <?php if ($show_bar) { ?>
                            <div class="footer-copyright">
                                <?php if ($current_setup->get("footer_link_enabled")) { ?>
                                    <nav class="footer-copyright__links" aria-label="<?php esc_attr_e("Legal", "djs-wallstreet-pro"); ?>">
                                        <?php echo wp_kses_post($current_setup->get("footer_link")); ?>
                                    </nav>
                                <?php } ?>
                                <p class="footer-copyright__text"><?php echo wp_kses_post($current_setup->get("footer_copyright")); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </footer>

        <?php if ($current_setup->get("webrit_custom_css") != "") { ?>
            <style id="djs-custom-css"><?php echo wp_strip_all_tags($current_setup->get("webrit_custom_css")); ?></style>
        <?php } ?>
        <?php if ($current_setup->get("google_analytics") != "") {
            // Bewusst ungefiltert: das Feld nimmt ausschliesslich Tracking-Code eines Admins auf
            // (Capability edit_theme_options), genau wie vorher.
            ?>
            <script><?php echo $current_setup->get("google_analytics"); ?></script>
        <?php } ?>
    </div><!-- #wall_wrapper -->

    <?php if ($current_setup->get("scroll_to_top_enabled")) { ?>
        <a href="#djs-body" class="page_scrollup btn btn-circle btn-primary" data-scroll-top>
            <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php esc_html_e("Back to top", "djs-wallstreet-pro"); ?></span>
        </a>
    <?php } ?>

    <?php wp_footer(); ?>
</body>

</html>
