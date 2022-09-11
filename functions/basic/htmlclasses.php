<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : htmlclasses.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function get_first_middle_last($count, $total, $prefix = "") {
    $output = null;

    if ($count == $total) {
        $output = "last";
    } elseif ($count == 1) {
        $output = "first";
    } else {
        $output = "middle";
    }

    return $prefix . $output;
}

function get_first_middle_last_row($count, $total, $maxcol, $prefix = "") {
    $output = null;

    if ($count % $maxcol == 0) {
        $output = "last_column";
    } elseif (($count - 1) % $maxcol == 0) {
        $output = "first_column";
    } else {
        $output = "middle_column";
    }

    return $prefix . $output;
}

function get_odd_even_row($count, $total, $maxcol, $prefix = "") {
    $output = null;

    $output = ceil($count/$maxcol)%2 != 0?"odd-row":"even-row";

    return $prefix . $output;
}

function get_big_border($prefix = "", $suffix = "") {
    return get_values_on_current_option("bigborder", "bigborder", "", $prefix, $suffix);
}

function big_border($prefix = "", $suffix = "") {
    echo get_big_border($prefix, $suffix);
}

function get_with_filler($prefix = "", $suffix = "") {
    return get_values_on_current_option("addflexelements", "with_filler", "no_filler", $prefix, $suffix);
}

function with_filler($prefix = "", $suffix = "") {
    echo get_with_filler($prefix, $suffix);
}

function get_Page_Frame($prefix = "", $suffix = "") {
    return get_values_on_current_option("addframe", "with_background", "no_background", $prefix, $suffix);
}

function page_frame($prefix = "", $suffix = "") {
    echo get_Page_Frame($prefix, $suffix);
}

function row_frame_border($prefix = "", $suffix = "") {
    if (is_noframe_with_bigborder()) {
        page_frame($prefix, $suffix);
    } else {
        echo get_Page_Frame($prefix) . get_big_border(" ", $suffix);
    }
}
function get_innerrow_frame_border($prefix = "", $suffix = "") {
    if (is_noframe_with_bigborder()) {
        return get_big_border($prefix, $suffix);
    }
    return "";
}
function innerrow_frame_border($prefix = "", $suffix = "") {
    echo get_innerrow_frame_border($prefix, $suffix);
}
?>
