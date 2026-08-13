<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : social-media.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $ul_class;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
if (!empty($ul_class)) {
    $ul_class .= "-";
}
?>

<ul class="<?php echo $ul_class; ?>contact-social">
    <?php foreach (djs_wallstreet_social_networks() as $network) {
        $url = djs_wallstreet_social_url($network);
        if ($url == "") {
            continue;
        }

        $new_tab = $current_setup->get($network["tab"]);

        $rel = empty($network["rel"]) ? [] : explode(" ", $network["rel"]);
        if ($new_tab) {
            $rel[] = "noopener";
        }
        $rel = empty($rel) ? "" : ' rel="' . esc_attr(implode(" ", $rel)) . '"'; ?>
        <li><a href="<?php echo esc_url($url); ?>" <?php blank_target($new_tab); ?>
                aria-label="<?php echo esc_attr($network["label"]); ?>"<?php echo $rel; ?>><i
                    class="<?php echo esc_attr($network["icon"]); ?>"></i></a></li>
    <?php } ?>
</ul>
