<?php
/*
 * Created on   : Wed Sep 04 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcode_div.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// [clear_both] shortcode
function theme_shortcode_clear_both() {
    return '<div style="clear:both"></div>';
}
add_shortcode( 'clear_both', 'theme_shortcode_clear_both' );

// The [div class="class"] shortcode
function theme_shortcode_div($atts, $content=null) {
    extract(shortcode_atts([
        'class' => '',
        'style' => '',
        'id'    => '',
    ], $atts));

    $result = '<div';
    if (!empty($style)) $result .= ' style="'.$style . '" ';
    if (!empty($class)) $result .= ' class="'.$class . '" ';
    if (!empty($id))    $result .= ' id="'.$id . '" ';
    $result .= '>';
    if(!empty($content)) $result .= $content . "</div>";
    return $result;
}
add_shortcode('div', 'theme_shortcode_div');

// The [end_div] shortcode
function theme_shortcode_end_div() {
    return '</div>';
}
add_shortcode('end_div', 'theme_shortcode_end_div');

function theme_shortcode_row($atts, $content = null) {
    extract(shortcode_atts([
        "class" => "",
    ], $atts));
    $result = '<div class="row">';
    $content = str_replace("]<br />", "]", $content);
    $content = str_replace("<br />\n[", "[", $content);
    $result .= do_shortcode($content);
    $result .= "</div>";

    return $result;
}
add_shortcode("row", "theme_shortcode_row");

function column_shortcode($atts, $content = null) {
    extract(shortcode_atts([
        "offset" => "",
        "size" => "col-md-6",
    ], $atts));
    $result = '<div class="' . $size . '"><p>' . do_shortcode($content) . "</p></div>";

    return $result;
}
add_shortcode("column", "column_shortcode");

// [paypal_donation button_id="XXXXXXX" img_src="https://..."]
function paypal_donation_shortcode($atts, $content = null) {
    extract(shortcode_atts([
        "button_id" => "",
        "img_src" => "",
    ], $atts));
    $result =
        '<div id="donate-button-container" style="background-color: snow; border-radius: 4px;"><center><p></p>
            <div id="donate-button"></div>
            <p><script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                <script>
                    PayPal.Donation.Button({
                        env:\'production\',
                        hosted_button_id:\'' . $button_id . '\',
                        image: {
                            src:\'' . $img_src . '\',
                            alt:\'Donate with PayPal button\',
                            title:\'PayPal - The safer, easier way to pay online!\',
                        }
                    }).render(\'#donate-button\');
                </script>
            </p>
            <p></p>
        <p></p></center></div>';

    return $result;
}
add_shortcode("paypal_donation", "paypal_donation_shortcode");