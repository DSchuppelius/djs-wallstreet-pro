<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if (defined("WP_ADMIN") && WP_ADMIN) require_once "shortcode_popup.php";

require_once "shortcodes_div.php";

function parse_shortcode_content($content) {
    $content = trim(do_shortcode(shortcode_unautop($content)));

    if (substr($content, 0, 4) == "")  $content = substr($content, 4);
    if (substr($content, -3, 3) == "") $content = substr($content, 0, -3);

    $content = str_replace(["<p></p>"], "", $content);
    $content = str_replace(["<p>  </p>"], "", $content);
    return $content;
}

function button_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "style" => "",
        "size" => "small",
        "target" => "self",
        "url" => "#",
        "textdata" => "Button",
    ], $atts);

    $size = $atts["size"];
    $style = $atts["style"];
    $url = $atts["url"];
    $target = $atts["target"];
    $target = $target == "blank" ? ' target="_blank"' : "";
    $style = $style ? " " . $style : "";
    $result = "<a" . $target . ' class="' . $style . " " . $size . '  " href="' . $url . '" target="' . $target . '">' . do_shortcode($content) . "</a>";
    return $result;
}
add_shortcode("button", "button_shortcode");

function accordion_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "fields" => "1",
        "accordian_group" => "Accordions",
        "accordian_title" => "Accordions title, Accordions title",
        "accordian_text" => "Accordions Description, Accordions Description",
        "echo" => false,
    ], $atts);

    $fields = $atts["fields"];
    $accordian_group = $atts["accordian_group"];

    $accordian_title = $atts["accordian_title"];
    $title = explode(",", $accordian_title);

    $accordian_text = $atts["accordian_text"];
    $text = explode(",", $accordian_text);
    $result = "";
    $result .= '<div class="typo-head-title"><h3>' . $accordian_group . '</h3></div><div class="panel-group" id="accordion">';
    for ($i = 0; $i <= $fields; $i++) {
        $title[$i] = preg_replace("/__/", ",", $title[$i]);
        $text[$i] = preg_replace("/__/", ",", $text[$i]);
        //$title[$i] = preg_replace('~[^A-Za-z\d\s-]+~u', 'wr', $title[$i]);
        //$title1[$i] = preg_replace('/\s/', '_', $title[$i]);
        //$changetitle = preg_replace(" ", 'wl', $changetitle);
        if ($i == 0) {
            $result .=
                '<div class="acco_panel panel-default">
                    <div class="short-panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#' . $accordian_group . '" href="#' . $accordian_group . $i . '">' .
                                $title[$i] . '<span class="fa fa-minus"></span>
                            </a>
                        </h4>
                    </div>
                    <div  class="panel-collapse collapse in" id="' . $accordian_group . $i . '">
                        <div class="panel-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="image-para-content">' .
                                        $text[$i] .
                                    '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            $result .=
                '<div class="acco_panel panel-default">
                    <div class="short-panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#' . $accordian_group . '" href="#' . $accordian_group . $i . '">' .
                                $title[$i] . '<span class="fa fa-plus"></span>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="' . $accordian_group . $i . '">
                        <div class="panel-body">
                            <p>' .
                                $text[$i] .
                            '</p>
                        </div>
                    </div>
                </div>';
        }
    }
    $result .= "</div>";
    return $result;
}
add_shortcode("accordian", "accordion_shortcode");

if (!function_exists("tabgroup")) {
    function tabgroup($atts, $content = null) {
        $atts = shortcode_atts([
            "tabs_title" => "This is tabs heading",
            "echo" => false
        ], $atts);

        $tabs_title1 = $atts["tabs_title"];
        // Extract the tab titles for use in the tab shortcode
        preg_match_all('/tabs_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
        $tab_titles = [];
        $theme_tabs_title = [];
        if (isset($matches[1])) {
            $tab_titles = $matches[1];
        }
        $resultput = '<div class="short-tabs-section">';
        if (count($tab_titles)) {
            $resultput .= '<ul class="short-tabs" id="myTab-' . preg_replace("~[^A-Za-z\d\s-]+~u", "wr", $tabs_title1) . '">';
            $count = 0;
            foreach ($tab_titles as $tabs_title) {
                if ($count == 0) {
                    $theme_tabs_title[0] = str_replace(" ", "_", $tabs_title[0]);
                    $resultput .= '<li class="active" ><a data-toggle="tab" href="#' . preg_replace("~[^A-Za-z\d\s-]+~u", "wr", $theme_tabs_title[0]) . '">' . $tabs_title[0] . "</a></li>";
                } else {
                    $theme_tabs_title[0] = str_replace(" ", "_", $tabs_title[0]);
                    $resultput .= '<li class="" ><a data-toggle="tab" href="#' . preg_replace("~[^A-Za-z\d\s-]+~u", "wr", $theme_tabs_title[0]) . '">' . $tabs_title[0] . "</a></li>";
                }
                $count++;
            }
            $resultput .= '</ul><div id="myTabContent" class="tab-content">';
            $resultput .= do_shortcode($content);
        }
        $resultput .= "</div></div>";
        return $resultput;
    }
    add_shortcode("tabgroup", "tabgroup");
}

function tabs_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "tabs_title" => "This is tabs heading",
        "tabs_text" => "Description",
        "wrap" => "yes",
        "echo" => false,
    ], $atts);

    $tabs_title = $atts["tabs_title"];
    $tabs_text = $atts["tabs_text"];
    $wrap = $atts["wrap"];
    $theme_tabs_title = str_replace(" ", "_", $tabs_title);
    static $c = 0;
    $result = "";
    if ($c == 0 || $wrap == "yes") {
        $result .= '<div id="' . preg_replace("~[^A-Za-z\d\s-]+~u", "wr", $theme_tabs_title) . '" class="tab-pane fade active in">';
    } else {
        $result .= '<div id="' . preg_replace("~[^A-Za-z\d\s-]+~u", "wr", $theme_tabs_title) . '" class="tab-pane fade">';
    }
    $c++;
    $result .= '<p class="short-tabs-content" >' . $tabs_text . "</p>" . do_shortcode($content) . "</div>";
    return $result;
}
add_shortcode("tabs", "tabs_shortcode");

/*-----------Alert short code-----------*/
function alert_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "alert_heading" => "Please enter alert heading",
        "alert_text" => "Please enter text in alert text",
        "alert_style" => "",
    ], $atts);

    $alert_heading = $atts["alert_heading"];
    $alert_text = $atts["alert_text"];
    $alert_style = $atts["alert_style"];

    $result =
        '<div class="' .
        $alert_style .
        '">
            <button data-dismiss="alert" class="close material-icons-outlined" type="button">close</button>
            <strong>' .
        $alert_heading .
        "</strong>&nbsp;&nbsp;" .
        $alert_text .
        do_shortcode($content) .
        "</div>";
    return $result;
}
add_shortcode("alert", "alert_shortcode");

/*-----------Dropcap-----------*/
function dropcp_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "dropcp_style" => "dropcap_simple_content",
        "dropcp_text" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
        "dropcp_first_letter" => "L",
        "echo" => false,
    ], $atts);

    $dropcp_text = $atts["dropcp_text"];
    $dropcp_style = $atts["dropcp_style"];
    $dropcp_first_letter = $atts["dropcp_first_letter"];

    $result = '<p class="' . $dropcp_style . '"><span class="first">' . $dropcp_first_letter . "</span>&nbsp;&nbsp;" . $dropcp_text . "</p>";
    return $result;
}
add_shortcode("dropcap", "dropcp_shortcode");

function gridsystemlayout_function($atts, $content = null) {
    $grid_layout = $atts["grid_layout"];

    if ($grid_layout == "one-column") {
        $atts = shortcode_atts([
            "one_column_title" => "One Column",
            "one_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
        ], $atts);

        $one_column_title = $atts["one_column_title"];
        $one_column_description = $atts["one_column_description"];
        $result =
            '<div class="row">
                <div class="col-md-12">
                    <div class="hc_head_title"><span>' .
                        $one_column_title .
                    '</span></div>
                    <p>' .
                        $one_column_description .
                    '</p>
                </div>
            </div>';
    } elseif ($grid_layout == "two-column") {
        $atts = shortcode_atts([
            "one_column_title" => "two Column",
            "one_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "two_column_title" => "two Column",
            "two_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "echo" => false,
        ], $atts);

        $one_column_title = $atts["one_column_title"];
        $one_column_description = $atts["one_column_description"];
        $two_column_title = $atts["two_column_title"];
        $two_column_description = $atts["two_column_description"];

        $result =
            '<div class="row">
                <div class="col-md-6">
                    <div class="hc_head_title"><span>' .
                        $one_column_title .
                    '</span></div>
                    <p>' .
                        $one_column_description .
                    '</p>
                </div>
                <div class="col-md-6">
                    <div class="hc_head_title"><span>' .
                        $two_column_title .
                    '</span></div>
                    <p>' .
                        $two_column_description .
                    '</p>
                </div>				
            </div>';
    } elseif ($grid_layout == "three-column") {
        $atts = shortcode_atts([
            "one_column_title" => "Three Column",
            "one_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "two_column_title" => "Three Column",
            "two_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "three_column_title" => "Three Column",
            "three_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "echo" => false,
        ], $atts);

        $one_column_title = $atts["one_column_title"];
        $one_column_description = $atts["one_column_description"];
        $two_column_title = $atts["two_column_title"];
        $two_column_description = $atts["two_column_description"];
        $three_column_title = $atts["three_column_title"];
        $three_column_description = $atts["three_column_description"];
        $result =
            '<div class="row">
                <div class="col-md-4">
                    <div class="hc_head_title"><span>' .
                        $one_column_title .
                    '</span></div>
                    <p>' .
                        $one_column_description .
                    '</p>
                </div>
                <div class="col-md-4">
                    <div class="hc_head_title"><span>' .
                        $two_column_title .
                    '</span></div>
                    <p>' .
                        $two_column_description .
                    '</p>
                </div>
                <div class="col-md-4">
                    <div class="hc_head_title"><span>' .
                        $three_column_title .
                    '</span></div>
                    <p>' .
                        $three_column_description .
                    '</p>
                </div>				
            </div>';
    } elseif ($grid_layout == "fourth-column") {
        $atts = shortcode_atts([
            "one_column_title" => "fourth Column",
            "one_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "two_column_title" => "fourth Column",
            "two_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "three_column_title" => "fourth Column",
            "three_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "fourth_column_title" => "fourth Column",
            "fourth_column_description" => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
            "echo" => false,
        ], $atts);

        $one_column_title = $atts["one_column_title"];
        $one_column_description = $atts["one_column_description"];
        $two_column_title = $atts["two_column_title"];
        $two_column_description = $atts["two_column_description"];
        $three_column_title = $atts["three_column_title"];
        $three_column_description = $atts["three_column_description"];
        $fourth_column_title = $atts["fourth_column_title"];
        $fourth_column_description = $atts["fourth_column_description"];

        $result =
            '<div class="row">
                <div class="col-md-3">
                    <div class="hc_head_title"><span>' .
                        $one_column_title .
                    '</span></div>
                    <p>' .
                        $one_column_description .
                    '</p>
                </div>
                <div class="col-md-3">
                    <div class="hc_head_title"><span>' .
                        $two_column_title .
                    '</span></div>
                    <p>' .
                        $two_column_description .
                    '</p>
                </div>
                <div class="col-md-3">
                    <div class="hc_head_title"><span>' .
                        $three_column_title .
                    '</span></div>
                    <p>' .
                        $three_column_description .
                    '</p>
                </div>
                <div class="col-md-3">
                    <div class="hc_head_title"><span>' .
                        $fourth_column_title .
                    '</span></div>
                    <p>' .
                        $fourth_column_description .
                    '</p>
                </div>
            </div>';
    }
    return $result;
}
add_shortcode("gridsystemlayout", "gridsystemlayout_function");

/******* heading shortcode **********/
function heading_function($atts, $content = null) {
    $atts = shortcode_atts([
        "heading_style" => "h1",
        "title" => "Heading",
    ], $atts);

    $heading_style = $atts["heading_style"];
    $title = $atts["title"];
    $result = '<div class="typo-section"><' . $heading_style . ">" . $title . "</" . $heading_style . "></div>";
    return $result;
}
add_shortcode("heading", "heading_function");

/******* List shortcode **********/
function list_function($atts, $content = null) {
    $atts = shortcode_atts([
        "fields" => "1",
        "list_style" => "unordered",
        "list_item" => "list title",
    ], $atts);

    $list_style = $atts["list_style"];
    $list_item = $atts["list_item"];
    $list_item = explode(", ", $list_item);
    $fields = $atts["fields"];
    $result = "";
    if ($list_style == "chevron circle right") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-chevron-circle-right"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "thumbs up") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-thumbs-o-up"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "check circle") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-check-circle"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "caret right") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-caret-right"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "chevron right") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-chevron-right"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "angle double right") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-angle-double-right"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "dot circle") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-dot-circle-o"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
    if ($list_style == "arrow") {
        $result .= '<div class="typo-para-icons"><div class="para-box">';
        for ($i = 1; $i <= $fields; $i++) {
            $result .= '<i class="fa fa-arrow-right"></i><span>' . $list_item[$i] . "</span>";
        }
        $result .= "</div></div>";
        return $result;
    }
}
add_shortcode("list", "list_function");

/*Tool Tip*/
function tooltip_function($atts, $content = null) {
    wp_enqueue_style("tool-tip", THEME_ASSETS_PATH_URI . "/css/css-tooltips.css"); //ToolTip
    $atts = shortcode_atts([
        "tooltip_text" => "Tight pants next level keffiyeh&nbsp;",
        "tooltip_word" => "sample",
        "tooltip_url" => "#",
        "tip_word" => "ToolTip",
    ], $atts);

    $tooltip_text = $atts["tooltip_text"];
    $tooltip_word = $atts["tooltip_word"];
    $tooltip_url = $atts["tooltip_url"];
    $tip_word = $atts["tip_word"];

    $myString = $tooltip_text;
    $tooltip_text = str_replace($tooltip_word, "<a data-tip='" . $tip_word . "' href='" . $tooltip_url . "'>" . $tooltip_word . "</a>", $myString);

    $result =
        '<div class="short-tooltip">
            <p class="short-tooltip">' .
                $tooltip_text .
            "</p>
        </div>";
    return $result;
}
add_shortcode("tooltip", "tooltip_function");
