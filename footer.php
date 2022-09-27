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

$current_options = get_current_options();

if (show_rellax_div()){ ?></div><?php } ?>
                <footer class="site<?php if ($current_options["fixedfooter_enabled"]) { echo " fixed"; } ?>">
                    <i class="show-me fa fa-info-circle fa-4x"></i>
                    <?php if ($current_options["footer_social_media_enabled"] == true) { ?>
                        <div class="footer-social-area">
                            <?php
                            global $ul_class;
                            $ul_class = "footer";
                            get_template_part("template-parts/global/social-media");
                            ?>
                        </div>
                    <?php } ?>
                    <div class="container">
                        <?php
                        if (is_active_sidebar("footer-widget-area")) { ?>
                            <div class="row footer-widget-section">
                                <?php dynamic_sidebar("footer-widget-area"); ?>
                            </div>
                        <?php }
                        if ($current_options["footerbar_enabled"] == true) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="footer-copyright">
                                        <?php if($current_options["footer_link_enabled"] == true) { ?>
                                            <p><?php echo $current_options["footer_link"];?></p>
                                        <?php } ?>
                                        <p><?php echo $current_options["footer_copyright"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </footer>
                <?php
                if ($current_options["webrit_custom_css"] != "") { ?>
                    <style type="text/css">
                        <?php echo $current_options["webrit_custom_css"]; ?>
                    </style>
                <?php }
                if ($current_options["google_analytics"] != "") { ?>
                    <script type="text/javascript">
                        <?php echo $current_options["google_analytics"]; ?>
                    </script>
                <?php } ?>	
            </div>
            <?php if ($current_options["scroll_to_top_enabled"] == true) { ?>
                <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="page_scrollup"><i class="fa fa-chevron-up"></i></a>
            <?php } ?>
        </div>
        <script> var rellax = new Rellax('.rellax'); </script>
        <?php wp_footer(); ?>
    </body>
</html>
