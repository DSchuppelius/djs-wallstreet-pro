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

function get_big_Border($prefix = "", $suffix = "") {
    return get_Values_On_Current_Option("bigborder", "bigborder", "", $prefix, $suffix);
}

function big_Border($prefix = "", $suffix = "") {
    echo get_big_Border($prefix, $suffix);
}

function get_with_Filler($prefix = "", $suffix = "") {
    return get_Values_On_Current_Option("addflexelements", "with_filler", "no_filler", $prefix, $suffix);
}

function with_Filler($prefix = "", $suffix = "") {
    echo get_with_Filler($prefix, $suffix);
}

function get_Page_Frame($prefix = "", $suffix = "") {
    return get_Values_On_Current_Option("addframe", "with_background", "no_background", $prefix, $suffix);
}

function page_Frame($prefix = "", $suffix = "") {
    echo get_Page_Frame($prefix, $suffix);
}

function row_Frame_Border($prefix = "", $suffix = "") {
    if (is_NoFrame_With_BigBorder()) {
        page_Frame($prefix, $suffix);
    } else {
        echo get_Page_Frame($prefix) . get_big_Border(" ", $suffix);
    }
}
function get_innerrow_Frame_Border($prefix = "", $suffix = "") {
    if (is_NoFrame_With_BigBorder()) {
        return get_big_Border($prefix, $suffix);
    }
    return "";
}
function innerrow_Frame_Border($prefix = "", $suffix = "") {
    echo get_innerrow_Frame_Border($prefix, $suffix);
}
?>