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

// parse_shortcode_content() entfernt: nirgends aufgerufen (Theme und alle drei Plugins
// geprueft) und in sich wirkungslos - die beiden substr()-Vergleiche pruefen gegen einen
// Leerstring und konnten daher nie zutreffen.

function button_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "style"    => "",
        "size"     => "small",
        "target"   => "self",
        "url"      => "#",
        "textdata" => "Button",
    ], $atts);

    $sizes = ["mini" => "btn-xs", "small" => "btn-sm", "medium" => "", "large" => "btn-lg", "big" => "btn-lg"];
    $size  = $sizes[$atts["size"]] ?? "";
    $style = trim((string) $atts["style"]);
    // Alte Stilnamen (btn-default, btn-green ...) bleiben als Klasse erhalten; ohne Stil primaer.
    $color = preg_match('/\b(btn-(primary|secondary|accent|neutral|info|success|warning|error|danger|ghost|link|outline|default))\b/', $style) ? "" : "btn-primary";
    $label = $content !== null && $content !== "" ? do_shortcode($content) : esc_html($atts["textdata"]);
    $blank = $atts["target"] === "blank";

    return sprintf(
        '<a class="%s" href="%s"%s>%s</a>',
        esc_attr(trim("btn " . $color . " " . $style . " " . $size)),
        esc_url($atts["url"]),
        $blank ? ' target="_blank" rel="noopener"' : "",
        $label
    );
}
add_shortcode("button", "button_shortcode");

function accordion_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "fields"          => "1",
        "accordian_group" => "Accordions",
        "accordian_title" => "Accordions title, Accordions title",
        "accordian_text"  => "Accordions Description, Accordions Description",
        "echo"            => false,
    ], $atts);

    static $counter = 0;
    $counter++;

    $group  = "djs-accordion-" . $counter;
    $titles = explode(",", (string) $atts["accordian_title"]);
    $texts  = explode(",", (string) $atts["accordian_text"]);
    $count  = min(max(1, (int) $atts["fields"] + 1), count($titles));

    // <details name="..."> verhaelt sich wie data-parent: es ist immer nur ein Eintrag offen.
    $result = '<div class="sc-accordion" id="' . esc_attr($group) . '">';
    if (trim((string) $atts["accordian_group"]) !== "") {
        $result .= '<h3 class="sc-accordion__group typo-head-title">' . esc_html($atts["accordian_group"]) . "</h3>";
    }
    for ($i = 0; $i < $count; $i++) {
        $title = str_replace("__", ",", trim($titles[$i] ?? ""));
        $text  = str_replace("__", ",", trim($texts[$i] ?? ""));
        $result .= '<details class="sc-accordion__item acco_panel" name="' . esc_attr($group) . '"' . ($i === 0 ? " open" : "") . ">"
            . '<summary class="sc-accordion__title">' . wp_kses_post($title) . '<span class="sc-accordion__icon material-icons" aria-hidden="true">expand_more</span></summary>'
            . '<div class="sc-accordion__body panel-body"><p>' . wp_kses_post($text) . "</p></div>"
            . "</details>";
    }
    return $result . "</div>";
}
add_shortcode("accordian", "accordion_shortcode");

if (!function_exists("tabgroup")) {
    function tabgroup($atts, $content = null) {
        $atts = shortcode_atts([
            "tabs_title" => "This is tabs heading",
            "echo"       => false,
        ], $atts);

        static $counter = 0;
        $counter++;
        $group = "djs-tabs-" . $counter;

        preg_match_all('/tabs_title="([^"]+)"/i', (string) $content, $matches);
        $titles = $matches[1] ?? [];
        if (!$titles) {
            return do_shortcode((string) $content);
        }

        $result = '<div class="sc-tabs short-tabs-section">'
            . '<div class="tabs tabs-border sc-tabs__list short-tabs" role="tablist" data-tabs>';
        foreach ($titles as $i => $title) {
            $result .= sprintf(
                '<button type="button" role="tab" class="tab%s" id="%s-tab-%d" aria-controls="%s-pane-%d" aria-selected="%s">%s</button>',
                $i === 0 ? " tab-active" : "",
                $group, $i, $group, $i,
                $i === 0 ? "true" : "false",
                esc_html($title)
            );
        }
        $result .= "</div>";

        // [tabs] darin liest Gruppe und Zaehler, um IDs und Sichtbarkeit zu setzen.
        $previous = $GLOBALS["djs_tabgroup"] ?? null;
        $GLOBALS["djs_tabgroup"] = ["id" => $group, "index" => 0];
        $result .= '<div class="sc-tabs__panes tab-content">' . do_shortcode((string) $content) . "</div>";
        $GLOBALS["djs_tabgroup"] = $previous;

        return $result . "</div>";
    }
    add_shortcode("tabgroup", "tabgroup");
}

function tabs_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "tabs_title" => "This is tabs heading",
        "tabs_text"  => "Description",
        "wrap"       => "yes",
        "echo"       => false,
    ], $atts);

    $group = $GLOBALS["djs_tabgroup"] ?? null;
    $body  = '<p class="short-tabs-content">' . wp_kses_post($atts["tabs_text"]) . "</p>" . do_shortcode((string) $content);

    if (!$group) {
        // [tabs] ohne [tabgroup]: als einfacher Abschnitt ausgeben
        return '<div class="sc-tabs__pane tab-pane">' . $body . "</div>";
    }

    $i = $GLOBALS["djs_tabgroup"]["index"]++;
    return sprintf(
        '<div class="sc-tabs__pane tab-pane" role="tabpanel" id="%1$s-pane-%2$d" aria-labelledby="%1$s-tab-%2$d"%3$s>%4$s</div>',
        esc_attr($group["id"]),
        $i,
        $i === 0 ? "" : " hidden",
        $body
    );
}
add_shortcode("tabs", "tabs_shortcode");

/*-----------Alert short code-----------*/
function alert_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "alert_heading" => "Please enter alert heading",
        "alert_text"    => "Please enter text in alert text",
        "alert_style"   => "",
    ], $atts);

    $style = (string) $atts["alert_style"];
    $types = ["success" => ["alert-success", "check_circle"], "info" => ["alert-info", "info"], "warning" => ["alert-warning", "warning"], "danger" => ["alert-error", "error"], "error" => ["alert-error", "error"]];
    [$type, $icon] = ["", "info"];
    foreach ($types as $needle => $map) {
        if (str_contains($style, $needle)) {
            [$type, $icon] = $map;
            break;
        }
    }

    return '<div role="alert" class="' . esc_attr(trim("alert alert-soft sc-alert " . $type . " " . $style)) . '">'
        . '<span class="material-icons" aria-hidden="true">' . $icon . "</span>"
        . "<div><strong>" . esc_html($atts["alert_heading"]) . "</strong> " . esc_html($atts["alert_text"]) . do_shortcode((string) $content) . "</div>"
        . '<button type="button" class="btn btn-ghost btn-sm btn-circle" data-dismiss="alert" aria-label="' . esc_attr__("Close", "djs-wallstreet-pro") . '"><span class="material-icons" aria-hidden="true">close</span></button>'
        . "</div>";
}
add_shortcode("alert", "alert_shortcode");

/*-----------Dropcap-----------*/
function dropcp_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        "dropcp_style"        => "dropcap_simple_content",
        "dropcp_text"         => "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.",
        "dropcp_first_letter" => "L",
        "echo"                => false,
    ], $atts);

    return '<p class="sc-dropcap ' . esc_attr($atts["dropcp_style"]) . '"><span class="first">' . esc_html($atts["dropcp_first_letter"]) . "</span>" . wp_kses_post($atts["dropcp_text"]) . "</p>";
}
add_shortcode("dropcap", "dropcp_shortcode");

function gridsystemlayout_function($atts, $content = null) {
    $grid_atts = shortcode_atts(["grid_layout" => ""], (array) $atts, "gridsystemlayout");
    $columns   = ["one-column" => 1, "two-column" => 2, "three-column" => 3, "fourth-column" => 4][$grid_atts["grid_layout"]] ?? 0;
    if (!$columns) {
        return "";
    }

    $names    = ["one", "two", "three", "fourth"];
    $label    = ["One Column", "two Column", "Three Column", "fourth Column"][$columns - 1];
    $lorem    = "orem ipsum dolor sit amet, Integer commodo tristiqu odio, aliquet ut. Maecenas sed justo imperdiet bibendum. Vivamus nec sapien imperdiet diam. Aliquam erat volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet,volutpat. Sed onsectetur suscipit nunc et rutrum. Lorem ipsum dolor sit amet, volutpat.";
    $defaults = ["echo" => false];
    for ($i = 0; $i < $columns; $i++) {
        $defaults[$names[$i] . "_column_title"]       = $label;
        $defaults[$names[$i] . "_column_description"] = $lorem;
    }
    $atts = shortcode_atts($defaults, $atts);

    $result = '<div class="sc-grid sc-grid--' . $columns . '">';
    for ($i = 0; $i < $columns; $i++) {
        $result .= '<div class="sc-grid__item">'
            . '<h4 class="sc-grid__title hc_head_title"><span>' . wp_kses_post($atts[$names[$i] . "_column_title"]) . "</span></h4>"
            . "<p>" . wp_kses_post($atts[$names[$i] . "_column_description"]) . "</p>"
            . "</div>";
    }
    return $result . "</div>";
}
add_shortcode("gridsystemlayout", "gridsystemlayout_function");

/******* heading shortcode **********/
function heading_function($atts, $content = null) {
    $atts = shortcode_atts([
        "heading_style" => "h1",
        "title" => "Heading",
    ], $atts);

    // Der Tag-Name kam vorher ungefiltert aus dem Attribut. [heading heading_style="script"]
    // erzeugte damit woertlich ein <script>-Element - gespeichertes XSS durch jeden, der
    // Beitraege schreiben darf. Nur Ueberschriften-Tags zulassen, Titel escapen.
    $erlaubte_tags = ["h1", "h2", "h3", "h4", "h5", "h6"];
    $heading_style = strtolower(trim((string) $atts["heading_style"]));
    if (!in_array($heading_style, $erlaubte_tags, true)) {
        $heading_style = "h1";
    }
    $title = esc_html($atts["title"]);
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
    ], $atts, "list");

    $icons = [
        "chevron circle right" => "fa-chevron-circle-right",
        "thumbs up"            => "fa-thumbs-o-up",
        "check circle"         => "fa-check-circle",
        "caret right"          => "fa-caret-right",
        "chevron right"        => "fa-chevron-right",
        "angle double right"   => "fa-angle-double-right",
        "dot circle"           => "fa-dot-circle-o",
        "arrow"                => "fa-arrow-right",
    ];

    $list_style = $atts["list_style"];
    $eintraege = array_map("trim", explode(",", (string) $atts["list_item"]));
    $anzahl = max(0, (int) $atts["fields"]);
    if ($anzahl > 0) {
        $eintraege = array_slice($eintraege, 0, $anzahl);
    }

    if (!isset($icons[$list_style])) {
        // "unordered" und alles Unbekannte als schlichte Liste ausgeben.
        $result = '<div class="typo-para-icons"><div class="para-box"><ul>';
        foreach ($eintraege as $eintrag) {
            $result .= "<li>" . esc_html($eintrag) . "</li>";
        }
        return $result . "</ul></div></div>";
    }

    $result = '<div class="typo-para-icons"><div class="para-box">';
    foreach ($eintraege as $eintrag) {
        $result .= '<i class="fa ' . esc_attr($icons[$list_style]) . '"></i><span>' . esc_html($eintrag) . "</span>";
    }
    return $result . "</div></div>";
}
add_shortcode("list", "list_function");

/*Tool Tip*/
function tooltip_function($atts, $content = null) {
    $atts = shortcode_atts([
        "tooltip_text" => "Tight pants next level keffiyeh&nbsp;",
        "tooltip_word" => "sample",
        "tooltip_url"  => "#",
        "tip_word"     => "ToolTip",
    ], $atts);

    // Das Schluesselwort im Text wird zum Link mit Tooltip (daisyUI, reines CSS).
    $link = sprintf(
        '<span class="tooltip" data-tip="%s"><a href="%s">%s</a></span>',
        esc_attr($atts["tip_word"]),
        esc_url($atts["tooltip_url"]),
        esc_html($atts["tooltip_word"])
    );
    $text = str_replace($atts["tooltip_word"], "\0", wp_kses_post($atts["tooltip_text"]));

    return '<p class="sc-tooltip short-tooltip">' . str_replace("\0", $link, $text) . "</p>";
}
add_shortcode("tooltip", "tooltip_function");
