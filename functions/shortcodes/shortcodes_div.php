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
add_shortcode( 'end_div', 'theme_shortcode_end_div' );

function theme_shortcode_row($params, $content = null) {
    extract(shortcode_atts([
        "class" => "",
    ], $params));
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
        //'position' =>'first'
    ], $atts));
    $atts = shortcode_atts(["offset" => "", "size" => "col-md-6"], $atts);
    $result = '<div class="' . $size . '"><p>' . do_shortcode($content) . "</p></div>";

    return $result;
}
add_shortcode("column", "column_shortcode");
