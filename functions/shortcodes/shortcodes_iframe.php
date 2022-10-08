<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes_iframe.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function FindWPConfig($directory) {
    global $confroot;
    foreach (glob($directory . "/*") as $f) {
        if (basename($f) == "wp-config.php") {
            $confroot = str_replace("\\", "/", dirname($f));
            return true;
        }
        if (is_dir($f)) {
            $newdir = dirname(dirname($f));
        }
    }
    if (isset($newdir) && $newdir != $directory) {
        if (FindWPConfig($newdir)) {
            return false;
        }
    }
    return false;
}
if (!isset($table_prefix)) {
    global $confroot;
    FindWPConfig(dirname(dirname(__FILE__)));
    include_once $confroot . "/wp-load.php";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php esc_html_e("Insert Shortcode", "djs-wallstreet-pro"); ?></title>
        <script type="text/javascript" src="<?php echo THEME_ASSETS_PATH_URI;?>/jquery/1.6.1/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo esc_url(home_url()); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
        <style type="text/css" src="<?php echo esc_url(home_url()); ?>/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
        <link rel="stylesheet" href="css/shortcode_tinymce.css" />
        <script>
            jQuery(document).ready(function($){
                //select shortcode
                $("#shortcode-select").change(function ramboselect() {
                    var shortcodeSelectVal = "";
                    var shortcodeSelectText = "";
                    $("#shortcode-select option:selected").each(function ramboselect() {
                        shortcodeSelectVal += $(this).val();
                        shortcodeSelectText += $(this).text();
                    });

                    if( shortcodeSelectVal != 'default') {
                        $('#selected-shortcode').load('types/'+shortcodeSelectVal+'.php', function ramboselect(){
                            $('.shortcode-editor-title').text(shortcodeSelectText + ' Editor');
                        });
                    } else {
                        $('#selected-shortcode').text('Select Your Shortcode Above To Get Started').addClass('padding-bottom');
                        $('.shortcode-editor-title').text('Shortcode Editor');
                    }
                })
                .trigger('change');	
            });
        </script>
    </head>
    <body>
        <div id="wpex-shortcodes-popup">
            <h2 id="shortcode-selector-title"><?php esc_html_e("Shortcode Selector", "djs-wallstreet-pro"); ?></h2>
            <div id="select-shortcode">
                <div id="select-shortcode-inner">
                    <form action="/" method="get" accept-charset="utf-8">
                        <div>
                            <select name="shortcode-select" id="shortcode-select" size="1">
                                <option value="default" selected="selected"><?php esc_html_e("Shortcodes", "djs-wallstreet-pro"); ?></option>  
                                <option value="column"><?php esc_html_e("column", "djs-wallstreet-pro"); ?></option>
                                <option value="tabs"><?php esc_html_e("Tabs", "djs-wallstreet-pro"); ?></option>
                                <option value="accordion"><?php esc_html_e("Accordion", "djs-wallstreet-pro"); ?></option>	
                                <option value="alert"><?php esc_html_e("Alert", "djs-wallstreet-pro"); ?></option>
                                <option value="drop"><?php esc_html_e("Drop-Caps", "djs-wallstreet-pro"); ?></option>
                                <option value="button"><?php esc_html_e("Button", "djs-wallstreet-pro"); ?></option>
                                <option value="heading"><?php esc_html_e("Heading", "djs-wallstreet-pro"); ?></option>
                                <option value="tooltip"><?php esc_html_e("Tool Tip", "djs-wallstreet-pro"); ?></option>
                                <option value="list"><?php esc_html_e("List", "djs-wallstreet-pro"); ?></option>
                            </select>
                        </div>
                    </form>
                </div>
            <!-- /select-shortcode-inner -->
            </div>
            <!-- /select-shortcode-wrap -->
            <h2 class="shortcode-editor-title"></h2>
            <div id="shortcode-editor">
                <div id="shortcode-editor-inner" class="clearfix">
                    <div id="selected-shortcode"> </div>
                </div>       
            </div>
        </div>
    </body>
</html>
