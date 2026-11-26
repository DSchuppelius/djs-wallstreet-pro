<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : social-media.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Aufruf: get_template_part("template-parts/global/social-media", null, ["context" => "footer"]);
 * Kontexte: head, footer, about. Das alte "global $ul_class" funktioniert weiterhin.
 */
global $ul_class;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$context       = $args["context"] ?? ($ul_class ?: "");
$context       = sanitize_html_class($context);

$links = [];
foreach (djs_wallstreet_social_networks() as $network) {
    $url = djs_wallstreet_social_url($network);
    if ($url == "") {
        continue;
    }
    $links[] = [$network, $url];
}

if (!$links) {
    return;
} ?>

<ul class="social-links<?php echo $context ? " social-links--" . $context . " " . $context . "-contact-social" : " contact-social"; ?>">
    <?php foreach ($links as [$network, $url]) {
        $new_tab = (bool) $current_setup->get($network["tab"]);
        $rel     = empty($network["rel"]) ? [] : explode(" ", $network["rel"]);
        if ($new_tab) {
            $rel[] = "noopener";
        } ?>
        <li>
            <a class="social-links__link" href="<?php echo esc_url($url); ?>" <?php blank_target($new_tab); ?>
                <?php echo $rel ? ' rel="' . esc_attr(implode(" ", array_unique($rel))) . '"' : ""; ?>
                aria-label="<?php echo esc_attr($network["label"]); ?>" title="<?php echo esc_attr($network["label"]); ?>">
                <i class="<?php echo esc_attr($network["icon"]); ?>" aria-hidden="true"></i>
            </a>
        </li>
    <?php } ?>
</ul>
