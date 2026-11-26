<?php
/*
 * Created on   : Fri Aug 14 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes_vc_compat.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// Der WPBakery Page Builder (js_composer) ist nicht mehr aktiv. Drei Seiten tragen seine
// Shortcodes aber weiterhin im Content:
//   /ueber-mich/curriculum-vitae/          vc_row, vc_column, vc_column_text,
//                                          vc_tta_accordion, vc_tta_section
//   /projekte/quad-adapter-fuer-klickfix/  vc_row, vc_column, vc_column_text
//   /projekte/containersystem/             vc_row, vc_column, vc_column_text
// Ohne registrierte Tags gibt WordPress sie als Rohtext aus. Hier werden genau diese
// fuenf Tags nachgebaut, der Content in der Datenbank bleibt unangetastet. Kommt spaeter
// ein weiterer vc_-Tag hinzu, muss er in DJS_VC_COMPAT_TAGS und per add_shortcode()
// ergaenzt werden - ein Catch-all gibt es absichtlich nicht, damit nichts stillschweigend
// verschluckt wird.

if (!defined("DJS_VC_COMPAT_TAGS")) {
    define("DJS_VC_COMPAT_TAGS", ["vc_row", "vc_column", "vc_column_text", "vc_tta_accordion", "vc_tta_section"]);
}

/* -------------------------------------------------------------------------
 * Hilfsfunktionen
 * ----------------------------------------------------------------------*/

/**
 * Uebersetzt das css-Attribut des Builders in ein style-Attribut.
 *
 * Der Builder legt die Gestaltung als fertige Regel mit generiertem Klassennamen ab:
 *   css=".vc_custom_1589123990560{background-color: #222222 !important;border-radius: 5px !important;}"
 * Da die zugehoerige Stylesheet-Datei mit dem Plugin verschwunden ist, wird der
 * Deklarationsblock direkt am Element ausgegeben. Nur Eigenschaften der Whitelist
 * ueberleben; Werte mit Klammern (url(), expression()), Anfuehrungszeichen oder
 * spitzen Klammern werden verworfen - im Content stehen ausschliesslich Farb- und
 * Laengenangaben.
 *
 * $skip nennt Eigenschaften, die das Theme selbst setzen soll. Ein Stylesheet kann sie
 * nicht einfach ueberschreiben: der Builder haengt an jede Deklaration ein !important,
 * und ein !important im style-Attribut schlaegt in der Kaskade auch ein !important aus
 * dem Stylesheet. Sie duerfen deshalb gar nicht erst ausgegeben werden.
 */
function djs_vc_compat_css_to_style($css, array $skip = []) {
    if (!is_string($css) || $css === "" || !preg_match("/\{(.*)\}/s", $css, $match)) {
        return "";
    }

    $allowed = [
        "background", "background-color", "border", "border-color", "border-radius",
        "border-style", "border-width", "color", "margin", "margin-bottom", "margin-left",
        "margin-right", "margin-top", "padding", "padding-bottom", "padding-left",
        "padding-right", "padding-top", "text-align",
    ];

    $declarations = [];
    foreach (explode(";", $match[1]) as $declaration) {
        if (strpos($declaration, ":") === false) {
            continue;
        }

        list($property, $value) = explode(":", $declaration, 2);
        $property = strtolower(trim($property));
        $value = trim($value);

        if ($value === "" || !in_array($property, $allowed, true) || in_array($property, $skip, true)) {
            continue;
        }
        if (preg_match("/[()\"'<>\\\\]|@import|expression/i", $value)) {
            continue;
        }

        $declarations[] = $property . ":" . $value;
    }

    return $declarations ? ' style="' . esc_attr(implode(";", $declarations)) . '"' : "";
}

/**
 * Attributwerte aus dem Content enthalten HTML-Entities (z.B. "Lehrg&auml;nge"), weil der
 * Beitrag so importiert wurde. Erst dekodieren, dann maskieren - sonst wird aus &auml;
 * ein sichtbares "&auml;" statt eines "ä".
 */
function djs_vc_compat_text($value) {
    return esc_html(html_entity_decode((string) $value, ENT_QUOTES, get_bloginfo("charset") ?: "UTF-8"));
}

/**
 * Klassenliste aus festen und aus dem Content stammenden Teilen bauen.
 */
function djs_vc_compat_classes(array $base, $el_class = "") {
    foreach (preg_split("/\s+/", (string) $el_class, -1, PREG_SPLIT_NO_EMPTY) as $extra) {
        $base[] = sanitize_html_class($extra);
    }

    return implode(" ", array_filter(array_unique($base)));
}

/**
 * Laufzeit-Zustand des Accordions. Die Sektionen brauchen die Gruppen-ID des
 * Elternelements (fuer Bootstraps data-parent), ihre laufende Nummer (active_section)
 * und das Icon-Paar. Rueckgabe per Referenz, damit die Section-Callbacks schreiben
 * koennen, ohne eine globale Variable anzulegen.
 */
function &djs_vc_compat_tta_state() {
    static $state = ["group" => "", "index" => 0, "active" => 0, "gap" => 0, "icon" => ["", ""]];

    return $state;
}

/**
 * Icon-Paar [zugeklappt, aufgeklappt] zum c_icon-Attribut des Builders.
 * assets/js/accordion-tab.js tauscht die beiden beim Auf- und Zuklappen.
 */
function djs_vc_compat_tta_icon($c_icon) {
    switch (strtolower(trim((string) $c_icon))) {
        case "chevron":
            return ["fa-chevron-down", "fa-chevron-up"];
        case "triangle":
            return ["fa-caret-down", "fa-caret-up"];
        case "plus":
            return ["fa-plus", "fa-minus"];
        default:
            return ["", ""];
    }
}

/* -------------------------------------------------------------------------
 * Shortcodes
 * ----------------------------------------------------------------------*/

// Bewusst ein schlichter Container und nicht Bootstraps .row: dessen negative
// Aussenabstaende setzen col-*-Kinder voraus, die der Content nicht mitbringt.
// Spaltenbreiten (width="1/2") kommen auf den drei Seiten nicht vor und werden
// daher auch nicht auf ein Grid abgebildet.
function djs_vc_compat_row($atts, $content = null) {
    $atts = shortcode_atts(["el_class" => "", "css" => ""], $atts, "vc_row");

    return '<div class="' . esc_attr(djs_vc_compat_classes(["vc_row"], $atts["el_class"])) . '"'
        . djs_vc_compat_css_to_style($atts["css"]) . ">" . do_shortcode((string) $content) . "</div>";
}
add_shortcode("vc_row", "djs_vc_compat_row");

function djs_vc_compat_column($atts, $content = null) {
    $atts = shortcode_atts(["el_class" => "", "css" => "", "width" => ""], $atts, "vc_column");

    return '<div class="' . esc_attr(djs_vc_compat_classes(["vc_column"], $atts["el_class"])) . '"'
        . djs_vc_compat_css_to_style($atts["css"]) . ">" . do_shortcode((string) $content) . "</div>";
}
add_shortcode("vc_column", "djs_vc_compat_column");

function djs_vc_compat_column_text($atts, $content = null) {
    $atts = shortcode_atts(["el_class" => "", "css" => ""], $atts, "vc_column_text");

    // Innerhalb des Accordions bestimmt das Theme die Rundung, damit Karten und Boxen
    // dasselbe Radius-Token teilen (var(--border-smallbase)). Ausserhalb - also im
    // Fliesstext vor dem Accordion und auf den beiden Projektseiten - bleibt der Wert
    // aus dem Builder unangetastet.
    $state = &djs_vc_compat_tta_state();
    $skip = $state["group"] !== "" ? ["border-radius"] : [];

    return '<div class="' . esc_attr(djs_vc_compat_classes(["vc_column_text"], $atts["el_class"])) . '"'
        . djs_vc_compat_css_to_style($atts["css"], $skip) . ">" . do_shortcode((string) $content) . "</div>";
}
add_shortcode("vc_column_text", "djs_vc_compat_column_text");

/**
 * Accordion-Rahmen. Bootstrap 3 regelt das Auf- und Zuklappen ueber data-toggle und
 * data-parent, die Optik kommt aus den Panel-Klassen, die der theme-eigene
 * [accordian]-Shortcode ebenfalls benutzt.
 *
 * collapsible_all des Builders ("alle Sektionen zuklappbar") entspricht dem Verhalten
 * einer data-parent-Gruppe in Bootstrap 3: die offene Sektion laesst sich per Klick
 * wieder schliessen. Das Attribut braucht deshalb keine eigene Behandlung.
 */
function djs_vc_compat_tta_accordion($atts, $content = null) {
    $atts = shortcode_atts([
        "style" => "classic",
        "color" => "",
        "gap" => "",
        "c_icon" => "",
        "active_section" => "1",
        "collapsible_all" => "",
        "el_class" => "",
        "css" => "",
    ], $atts, "vc_tta_accordion");

    static $counter = 0;
    $counter++;

    $state = &djs_vc_compat_tta_state();
    $outer = $state; // verschachtelte Accordions kommen nicht vor, kosten so aber auch nichts

    $group = "djs-tta-accordion-" . $counter;
    $state["group"] = $group;
    $state["index"] = 0;
    $state["active"] = max(0, (int) $atts["active_section"]);
    $state["gap"] = max(0, (int) $atts["gap"]);
    $state["icon"] = djs_vc_compat_tta_icon($atts["c_icon"]);

    $inner = do_shortcode((string) $content);

    $state = $outer;

    $classes = ["sc-accordion", "vc_tta-accordion"];
    if ($atts["style"] !== "") {
        $classes[] = "vc_tta-style-" . sanitize_html_class($atts["style"]);
    }
    if ($atts["color"] !== "") {
        $classes[] = "vc_tta-color-" . sanitize_html_class($atts["color"]);
    }

    return '<div class="' . esc_attr(djs_vc_compat_classes($classes, $atts["el_class"])) . '" id="' . esc_attr($group) . '"'
        . djs_vc_compat_css_to_style($atts["css"]) . ">" . $inner . "</div>";
}
add_shortcode("vc_tta_accordion", "djs_vc_compat_tta_accordion");

function djs_vc_compat_tta_section($atts, $content = null) {
    $atts = shortcode_atts([
        "title"    => "",
        "tab_id"   => "",
        "el_class" => "",
        "css"      => "",
    ], $atts, "vc_tta_section");

    $state = &djs_vc_compat_tta_state();
    $state["index"]++;
    $index = $state["index"];
    $group = $state["group"];

    // Die tab_id des Builders bleibt als ID, damit Deep-Links (#...) weiter funktionieren;
    // theme.js oeffnet die angesprungene Sektion.
    $id = $atts["tab_id"] !== ""
        ? "djs-tta-" . sanitize_html_class($atts["tab_id"])
        : ($group !== "" ? $group : "djs-tta") . "-section-" . $index;

    $is_active = ($index === $state["active"]);

    [$icon_closed, $icon_open] = $state["icon"];
    $icon = $icon_closed !== ""
        ? '<span class="fa ' . esc_attr($icon_closed) . ' sc-accordion__fa sc-accordion__fa--closed" aria-hidden="true"></span><span class="fa ' . esc_attr($icon_open) . ' sc-accordion__fa sc-accordion__fa--open" aria-hidden="true"></span>'
        : "";

    $gap  = $state["gap"] > 0 ? ' style="margin-bottom:' . $state["gap"] . 'px"' : "";
    $name = $group !== "" ? ' name="' . esc_attr($group) . '"' : "";

    return '<details id="' . esc_attr($id) . '" class="' . esc_attr(djs_vc_compat_classes(["sc-accordion__item", "acco_panel"], $atts["el_class"])) . '"' . $name . $gap . ($is_active ? " open" : "") . ">"
        . '<summary class="sc-accordion__title">' . djs_vc_compat_text($atts["title"]) . $icon . "</summary>"
        . '<div class="sc-accordion__body panel-body"' . djs_vc_compat_css_to_style($atts["css"]) . ">" . do_shortcode((string) $content) . "</div>"
        . "</details>";
}
add_shortcode("vc_tta_section", "djs_vc_compat_tta_section");

/* -------------------------------------------------------------------------
 * Aufloesen vor wpautop
 * ----------------------------------------------------------------------*/

/**
 * do_shortcode haengt an the_content mit Prioritaet 11, wpautop und wptexturize mit 10.
 * Die Builder-Tags muessen aber VOR wpautop aufgeloest werden: sonst verpackt wpautop die
 * Shortcode-Zeilen in <p>-Tags, aus denen die erzeugten <div>-Container im Browser wieder
 * ausbrechen - Ergebnis waren leere Absaetze und zerrissene Verschachtelung. wptexturize
 * wuerde zusaetzlich die Attribut-Anfuehrungszeichen in typografische verwandeln
 * (css=&rdquo;...&rdquo;), womit das css-Attribut nicht mehr zu parsen waere.
 *
 * Deshalb ein eigener Durchlauf mit Prioritaet 9, der ausschliesslich die vc_-Tags
 * aufloest: $shortcode_tags wird dafuer kurz auf diese reduziert, damit die uebrigen
 * Shortcodes des Themes unveraendert erst bei Prioritaet 11 an die Reihe kommen.
 * Der Fliesstext innerhalb der Container wird danach von wpautop normal in Absaetze
 * gesetzt, weil <div> fuer wpautop eine Blockgrenze ist.
 */
function djs_vc_compat_do_shortcodes($content) {
    if (!is_string($content) || strpos($content, "[vc_") === false) {
        return $content;
    }

    global $shortcode_tags;

    $backup = $shortcode_tags;
    $shortcode_tags = array_intersect_key($shortcode_tags, array_flip(DJS_VC_COMPAT_TAGS));
    $content = do_shortcode($content);
    $shortcode_tags = $backup;

    return $content;
}
add_filter("the_content", "djs_vc_compat_do_shortcodes", 9);

/* -------------------------------------------------------------------------
 * Assets
 * ----------------------------------------------------------------------*/

/**
 * Nur die drei betroffenen Seiten brauchen das Icon-Umschalten und die Abstaende.
 * Prioritaet 20, damit "djs-wallstreet-pro-standard" aus theme_scripts() bereits
 * registriert ist - wp_add_inline_style setzt das voraus.
 */
function djs_vc_compat_enqueue() {
    // Frueher Bootstrap-Collapse + accordion-tab.js. Die Sektionen sind jetzt native
    // <details>-Elemente; das Styling steckt im Theme-Stylesheet (content.css).
}
add_action("wp_enqueue_scripts", "djs_vc_compat_enqueue", 20);

/**
 * Die Farbflaechen der Boxen kommen aus dem css-Attribut des Builders, deren Innen- und
 * Aussenabstaende lieferte vorher das Grid des Plugins. Genau die werden hier ersetzt -
 * alles andere erben die Panels von Bootstrap und aus der style.css.
 *
 * Der Panel-Hintergrund muss dabei weichen: Bootstrap gibt .panel ein weisses #fff,
 * der Inhalt der Sektionen ist aber auf den dunklen Seitenhintergrund ausgelegt und
 * bringt eine helle Schrift (#f5f5f5) mit. Die Zeilen, die im css-Attribut keine eigene
 * Hintergrundfarbe tragen, standen dadurch fast weiss auf weiss. Nur innerhalb von
 * .vc_tta-accordion gesetzt, damit der theme-eigene [accordian]-Shortcode unberuehrt
 * bleibt.
 */
function djs_vc_compat_inline_css() {
    return "";
}
