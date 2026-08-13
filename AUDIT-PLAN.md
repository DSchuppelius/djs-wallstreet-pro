# Sanierungsplan djs-wallstreet-pro

Grundlage: Multi-Agent-Audit vom 2026-08-13 über sechs Dimensionen (Escaping, Eingaben,
PHP-Korrektheit, WordPress-API, Performance, toter Code), jede Dimension adversarial
gegengeprüft. 106 Befunde geprüft, **100 bestätigt, 6 widerlegt**. Nach Zusammenfassung
mehrfach gemeldeter Stellen bleiben rund **90 eindeutige Punkte**.

Bereits erledigt und **nicht** Teil dieses Plans: die Fixes aus den Commits `d0826d9`,
`0589494`, `eef23a5`, `a8b9dc4` sowie die noch nicht committeten Änderungen an
Kontaktformular, Blog-Layouts und `content-portfolio.php`.

---

## Phase 0 — Vorbereitung

Vor der ersten Änderung:

1. Arbeitszweig anlegen (`git switch -c audit-fixes`), die derzeit offenen Änderungen
   vorher committen.
2. Prüfen, welche Seiten die betroffenen Templates tatsächlich benutzen — insbesondere
   Team-, Testimonial-, Service- und Portfolio-Templates. Was nirgends zugewiesen ist,
   kann in Phase 6 entfallen statt repariert zu werden.
3. Festhalten, ob das Post-Types-Plugin dauerhaft aktiv bleiben soll. Davon hängt ab,
   wie aufwendig Phase 2 wird.

**Aufwand:** klein. **Risiko:** keins.

---

## Phase 1 — Sicherheit

Höchste Priorität. Zwei der Punkte sind von außen bzw. von jedem Redakteur ausnutzbar.

| # | Datei | Was |
|---|---|---|
| 1.1 | `functions/shortcodes/shortcodes.php:392` | `[heading]`: Tag-Name aus Attribut. Whitelist `h1`–`h6`, `esc_html()` auf den Titel |
| 1.2 | `functions/shortcodes/shortcodes.php:37` | `[button]`: `esc_url()` auf URL, `esc_attr()` auf style/size |
| 1.3 | `functions/shortcodes/shortcodes.php:493` | `[tooltip]`: URL und Tip-Text escapen |
| 1.4 | `functions/shortcodes/shortcodes.php:191` | `[alert]`: `alert_style` im class-Attribut escapen |
| 1.5 | `functions.php:216` | SVG-Upload ohne Sanitizer — **Entscheidung nötig**, siehe unten |
| 1.6 | `functions/shortcodes/shortcodes_iframe.php:31` | Direkt aufrufbare Datei bootet WordPress ohne ABSPATH-Guard, Capability-Prüfung und Nonce |
| 1.7 | `functions/scripts/custom_style_special.php:14` | Options-Werte ungeprüft in einen `<style>`-Block |
| 1.8 | `template-single/single-portfolio.php:65` | Portfolio-Website-Meta ungefiltert in `href` und Linktext |
| 1.9 | `template-single/single-portfolio.php:34` | `esc_html()` statt `esc_url()` beim Projekt-Button |
| 1.10 | `template-parts/index/index-portfolio.php:86` und `:94` | `meta_button_link` ohne `esc_url()` |
| 1.11 | `template-parts/index/index-slider.php:318` | `slider_button_link` ohne `esc_url()` |
| 1.12 | `template-parts/home/service/servic-1.php:59` | `service_icon_image` ohne `esc_attr()` |
| 1.13 | `template-parts/content/content-portfolio.php:93`, `:157` | Term-Slug in `id`/`aria-labelledby`, Summary im `alt` |
| 1.14 | `template-parts/team/team-1.php:66` | `esc_html()` statt `esc_url()` bei Social-Links |
| 1.15 | `template-parts/index/index-client.php:50` | `get_the_title()` ohne `esc_attr()` im title-Attribut |
| 1.16 | `template-parts/global/menu-search.php:15` | Request-abgeleitete URL ungefiltert im `href` |
| 1.17 | `template-parts/content/content-portfolio.php:28` | `$_GET` ohne `wp_unslash()`/Sanitizing (nur Vergleiche, daher niedrig) |

**Entscheidung 1.5 (SVG):** Entweder die Zeile entfernen — dann lassen sich keine SVGs
mehr hochladen — oder ein Sanitizer-Plugin (Safe SVG) installieren und die Freigabe daran
binden. Der Kommentar im Code setzt das bereits voraus, umgesetzt wurde es nie. Ich
brauche deine Entscheidung, weil beide Wege bestehende Inhalte betreffen können.

**Prüfung:** `php -l` auf alle geänderten Dateien; anschließend je einen Testbeitrag mit
`[heading]`, `[button]`, `[tooltip]`, `[alert]` anlegen und den Quelltext ansehen.

**Aufwand:** ein halber Tag. **Risiko:** gering — Escaping ändert die Ausgabe nur dort,
wo bisher unerwünschte Zeichen durchkamen. Ausnahme 1.1: Wer bisher bewusst ein anderes
Tag als `h1`–`h6` gesetzt hat, bekommt nach der Whitelist ein anderes Element.

---

## Phase 2 — Fatale Fehler abstellen

| # | Datei | Was |
|---|---|---|
| 2.1 | 24 Dateien | `PostTypes_Plugin_Setup::instance()` ohne `defined("DJS_POSTTYPE_PLUGIN")`-Guard |
| 2.2 | `functions/shortcodes/shortcodes.php:223` | `[gridsystemlayout]` ohne Attribute → TypeError; `$result` uninitialisiert |
| 2.3 | `functions/breadcrumbs/breadcrumbs.php:52` | `$post_type->rewrite` kann `false` sein → Array-Zugriff auf bool |
| 2.4 | `functions/widget/wallstreet-post-format-widget.php:61` | `strip_tags()` auf möglicherweise fehlende Array-Keys |
| 2.5 | `template-parts/content/content-portfolio.php:151` | `$post_thumbnail_url` bedingt gesetzt, unbedingt ausgegeben |

Zu 2.1: Betroffen sind alle Team-, Testimonial- und Service-Templates sowie
`single-portfolio.php` und `content-portfolio.php`. Das Muster existiert bereits sauber in
`template-parts/portfolio/selector.php` (Fallback auf `template-specials/not_loaded-plugin.php`)
— das gehört auf die übrigen Selektoren übertragen. Am wenigsten Aufwand entsteht, wenn
der Guard je Selector-Datei sitzt statt in jedem einzelnen Template.

**Prüfung:** Post-Types-Plugin testweise deaktivieren und jede Template-Gattung einmal
aufrufen. Das ist der eigentliche Test dieser Phase.

**Aufwand:** ein Tag. **Risiko:** mittel — viele Dateien, aber jeweils dieselbe Änderung.

---

## Phase 3 — Sichtbare Funktionsfehler

Fehler, die Besucher heute schon sehen.

| # | Datei | Was |
|---|---|---|
| 3.1 | `template-parts/index/index-slider.php:230` | `the_post()` am Schleifenende → letzter Slide fehlt, bei einem Beitrag ist der Slider leer |
| 3.2 | `functions/shortcodes/shortcodes.php:413` | `list_function`: Index startet bei 1 → erster Eintrag fehlt, Warning am Ende; `unordered` liefert gar nichts |
| 3.3 | `attachment.php:44` | Medien-Eigenschaften werden berechnet und verworfen; `<br />` fehlen |
| 3.4 | `comments.php:28` | Avatar-Link jedes Kommentars zeigt auf die Website des **Beitrags**autors |
| 3.5 | `comments.php:24` | `$comment_data` nirgends gesetzt → Antwort-Kennzeichnung ist toter Zweig |
| 3.6 | `comments.php:34` | `esc_url()` um ausgebende Template-Tags — Ausgabe bleibt unescaped |
| 3.7 | `comments.php:102` | Identitäts-Filter `my_fields()` ohne Wirkung |
| 3.8 | `functions/widget/wallstreet-latest-widget.php:40` | Thumbnail-Link zeigt auf die aktuelle Seite statt auf den Beitrag |
| 3.9 | `functions/breadcrumbs/breadcrumbs.php:28` | `single_post_title()` gibt selbst aus → Titel steht vor dem `<li>` |
| 3.10 | `template-parts/global/menu-search.php:36` | Zerschossenes class-Attribut: `search-iconaria-haspopup` |
| 3.11 | `template-parts/global/menu-search.php:113` | `wp_nav_menu`-Argument `container` mit CSS-Klassen statt Tag-Name → Container entfällt |
| 3.12 | `template-specials/service-two-template.php:18` | `if (…);` — Bedingung ohne Wirkung |
| 3.13 | `header.php:145` | Verschachtelte Bedingung, `bg-light` wird nie gesetzt |
| 3.14 | `functions/menu/theme_bootstrap_walker_page.php:23` | Unerreichbarer else-Zweig, leere CSS-Klasse |
| 3.15 | `functions/theme/theme_functions.php:16` | Negativ-Zweig in `get_values_on_current_option` unerreichbar |
| 3.16 | `functions/basic/generator.php:27` | `visual_composer()` läuft auch, wenn nur die Klasse existiert |

**Prüfung:** Startseite mit Slider (mit genau einem und mit mehreren Beiträgen), eine
Anhang-Seite, ein Beitrag mit Kommentaren und Antworten, das mobile Menü.

**Aufwand:** ein bis zwei Tage. **Risiko:** mittel — hier ändert sich sichtbares Verhalten,
teils zum ersten Mal seit Jahren. 3.1 und 3.2 vorher mit Testinhalten reproduzieren.

---

## Phase 4 — WordPress-API korrekt nutzen

| # | Datei | Was |
|---|---|---|
| 4.1 | `index.php:26` | Hauptquery wird durch zweite `WP_Query` ersetzt → keine Sticky Posts, `pre_get_posts` wirkungslos |
| 4.2 | `functions/scripts/scripts.php:130`, `:135` | `template-special/` statt `template-specials/` → Lightbox lädt auf Portfolio-Spaltentemplates nie |
| 4.3 | `functions/content/content.php:73` | `is_page_template("template/blog-fullwidth.php")` — Datei liegt in `template-blog/` |
| 4.4 | `functions/theme/theme_functions.php:57` | `is_page_template("search.php")` kann nie wahr werden |
| 4.5 | `template-parts/home/service/servic-1.php:41` | Sekundäre `WP_Query` ohne `wp_reset_postdata()` |
| 4.6 | `template-blog/blog-masonry.php:67` | dito |
| 4.7 | `header.php:29` | Vergleich gegen den **übersetzten** Core-String von `get_the_archive_title()` |
| 4.8 | `functions/customizer/single-blog-options.php:41` | Übersetzungsfunktion mit Variable als Text-Argument |
| 4.9 | `functions/breadcrumbs/breadcrumbs.php:95` | `get_page()` ist deprecated |
| 4.10 | `functions/scripts/scripts.php:196` | `wp_enqueue_script` auf nicht vorhandene `assets/js/collapse.js` |
| 4.11 | `functions.php:125` | `add_editor_style()` auf nicht existierende `assets/css/editor.css` |
| 4.12 | `template-parts/content/content-portfolio.php:170` | `the_pagination()` mit vier Argumenten (nimmt zwei) |

4.7 ist subtil: Der Vergleich funktioniert nur bei englischer WP-Sprache und ist auf einer
deutschen Installation immer falsch.

**Aufwand:** ein Tag. **Risiko:** gering, bis auf 4.1 — dort ändert sich, welche Beiträge
die Blog-Übersicht zeigt (Sticky Posts erscheinen wieder).

---

## Phase 5 — Performance

| # | Datei | Was |
|---|---|---|
| 5.1 | `theme_setup_data.php:34` | `get_initial_setup()` baut das Default-Array bei **jedem** `->get()` neu auf und vergleicht per `array_diff`. `static` einbauen |
| 5.2 | `functions.php:93` | ~123 KB Customizer-Code werden bei jedem Frontend-Request geladen. In `is_admin()`/`customize_register` kapseln |
| 5.3 | `template-parts/content/content-portfolio.php:91` | Eine `WP_Query` je Taxonomie-Term (N+1), alle Tabs serverseitig gerendert |
| 5.4 | `template-parts/index/index-banner.php:15` | `attachment_url_to_postid()` ungecacht bei jedem Aufruf |
| 5.5 | `template-parts/index/index-client.php:34` | `posts_per_page => -1` auf der Startseite |
| 5.6 | `template-parts/team/team-1.php:36` | `wp_count_posts()->publish` als `posts_per_page` — praktisch unbegrenzt |
| 5.7 | `header.php:32` | `get_the_excerpt()` im `<head>` jeder Seite, genutzt nur bei `is_single()` |
| 5.8 | `template-parts/excerpt/excerpt.php:20` | Excerpt pro Beitrag zweimal erzeugt |
| 5.9 | `template-parts/home/blog/blog-layout-1.php:62` | Ungenutzte Variable erzeugt den Excerpt ein zweites Mal |
| 5.10 | `template-parts/content/content-meta-footer.php:32` | Tag- und Kategorienliste je Beitrag doppelt |
| 5.11 | `functions/theme/theme_functions.php:13` | `->get()` zweimal für denselben Schlüssel |
| 5.12 | `functions/scripts/scripts.php:112` | `parallax.min.js` auf allen Seiten, gebraucht nur beim Parallax-Banner |
| 5.13 | `functions/widget/wallstreet-latest-widget.php:42`, `servic-1.php:71`, `blog-layout-2.php:49` | Nicht registrierte Bildgrößen → Originalbilder werden ausgeliefert |

5.1 und 5.2 bringen am meisten und sind risikoarm — damit anfangen. 5.13 ist der größte
Hebel für die Ladezeit: Statt Thumbnails gehen aktuell Originalbilder an den Browser.
Nach dem Registrieren der Größen müssen die Thumbnails einmal neu erzeugt werden
(Plugin *Regenerate Thumbnails* ist installiert).

5.3 ist der einzige Punkt mit echtem Umbaubedarf — bei vielen Portfolio-Kategorien lohnt
sich das, sonst kann er warten.

**Aufwand:** ein bis zwei Tage. **Risiko:** gering, außer 5.3.

---

## Phase 6 — Aufräumen

Kein Funktionsgewinn, aber weniger Code, der bei künftigen Änderungen in die Irre führt.

**Toter Code:** `parse_shortcode_content()`, `the_theme_link_color()`/`the_theme_bg_color()`,
`get_wallstreet_resource_url()`, drei ungenutzte Excerpt-Funktionen, `case "story"` in
`get_content_title.php`, `functions/shortcodes/types/gridsystemlayout.php` (über die
Oberfläche nicht erreichbar), `assets/js/flexslider/flexslider-element.js` (nie eingebunden),
Konstante `THEME_OPTIONS_PATH`.

**Customizer:** verwaiste Settings `taxonomy_portfolio_list`, `wallstreet_taxonomy_title`,
`wallstreet_taxonomy_desc`; `blog_template_content_excerpt_length` wird nirgends gelesen;
in `customizer-typography.php:203` sind Settings und Controls doppelt registriert.

**Markup/CSS:** Rest-Klasse `sssss` in `service-three-template.php:45`, `odd-row`/`even-row`
ohne Entsprechung im Stylesheet, WOW.js-Klassen ohne die Bibliothek.

**Theme-Header:** `style.css:14` `Requires PHP: 5.6` → `8.0`; `Requires Plugins` (Zeile 19)
wird bei Themes nicht ausgewertet.

**Entscheidung nötig — `google_analytics`:** `footer.php:56` schreibt den Wert ungefiltert
in ein `<script>`-Tag, es gibt aber **kein** Customizer-Setting dafür. Das Feld ist also
nicht befüllbar und der Ausgabeblock toter Code. Entweder Setting nachrüsten oder den
Block entfernen. Dasselbe gilt für `webrit_custom_css` daneben — bitte sag mir, ob du
diese Felder brauchst.

**Aufwand:** ein Tag. **Risiko:** gering, sofern jede Löschung wie gehabt vorher per
Referenzsuche über Theme **und** die drei Plugins belegt wird.

---

## Reihenfolge und Aufwand

| Phase | Inhalt | Aufwand | Risiko |
|---|---|---|---|
| 0 | Vorbereitung | klein | keins |
| 1 | Sicherheit | ½ Tag | gering |
| 2 | Fatale Fehler | 1 Tag | mittel |
| 3 | Sichtbare Fehler | 1–2 Tage | mittel |
| 4 | WordPress-API | 1 Tag | gering |
| 5 | Performance | 1–2 Tage | gering |
| 6 | Aufräumen | 1 Tag | gering |

Gesamt grob **6–8 Arbeitstage**. Phasen 1 und 2 sollten zusammen deployt werden, danach
ist jede Phase einzeln auslieferbar.

## Entscheidungen (getroffen 2026-08-14)

1. **SVG-Upload** (1.5): **Safe SVG einführen.** Die `upload_mimes`-Freigabe wird an einen
   tatsächlich vorhandenen Sanitizer gebunden — ohne aktives Safe-SVG-Plugin bleibt SVG
   gesperrt statt ungefiltert offen. Reihenfolge beim Ausrollen: erst Plugin installieren,
   dann diese Änderung deployen.
2. **Post-Types-Plugin** (Phase 2): **Das Theme muss ohne funktionieren.** Alle ungeschützten
   Aufrufe bekommen einen Guard mit Fallback auf `template-specials/not_loaded-plugin.php`,
   gesetzt auf Selector-Ebene statt in jedem einzelnen Template.
3. **`google_analytics` / `webrit_custom_css`** (Phase 6): **Settings nachrüsten.** Beide Felder
   bleiben und bekommen Customizer-Einträge. Achtung beim Sanitizing: `sanitize_text_field()`
   würde JavaScript bzw. CSS zerstören — es braucht passende Callbacks.
4. **Portfolio-Tabs** (5.3): **Umbauen.** Eine Abfrage über alle Terme statt einer pro Term,
   Gruppierung in PHP.

## Prüfung nach jeder Phase

- `php -l` über alle PHP-Dateien des Themes (läuft in Sekunden, hat schon zweimal etwas gefangen)
- `node --check` bei JS-Änderungen
- Für Löschungen: Referenzsuche über Theme und alle drei DJS-Plugins
- Sichtprüfung der in der Phase genannten Seitentypen
- `debug.log` nach dem Durchklicken auf neue Warnings ansehen
