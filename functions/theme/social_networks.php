<?php
/*
 * Created on   : Thu Aug 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : social_networks.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

/*
 * Zentrale Liste aller Social-Media-Netzwerke.
 *
 * Ein neues Netzwerk wird ausschliesslich hier eingetragen, Customizer und
 * Template erzeugen sich daraus selbst. Die Options-Keys ("link"/"tab") sind
 * bewusst uneinheitlich, damit bereits gespeicherte Einstellungen erhalten
 * bleiben - fuer neue Netzwerke gilt das Schema social_media_<name>_link /
 * <name>_link_new_tab.
 *
 * Achtung: hier keine Uebersetzungsfunktionen verwenden - die Liste wird ueber
 * get_initial_setup() sehr frueh (vor 'init') ausgewertet. Markennamen bleiben
 * ohnehin unuebersetzt, uebersetzt wird erst im Customizer.
 *
 * Schluessel pro Eintrag:
 *   label   - Name des Dienstes (Customizer-Label, aria-label)
 *   icon    - vollstaendige Font-Awesome-Klasse
 *   link    - Options-Key der URL
 *   tab     - Options-Key fuer "in neuem Tab oeffnen"
 *   default - Vorgabewert der URL
 *   rel     - zusaetzliche rel-Tokens am <a>-Tag (z.B. "me" fuer Mastodon)
 *   verify  - true, wenn zusaetzlich <link rel="me"> in den <head> soll
 */
function djs_wallstreet_social_networks() {
    static $networks = null;

    if ($networks === null) {
        $networks = [
            "twitter" => [
                "label" => "Twitter",
                "icon" => "fa-brands fa-twitter",
                "link" => "social_media_twitter_link",
                "tab" => "twitter_link_new_tab",
                "default" => "#",
            ],
            "x" => [
                "label" => "X",
                "icon" => "fa-brands fa-x-twitter",
                "link" => "social_media_x_link",
                "tab" => "x_link_new_tab",
                "default" => "",
            ],
            "facebook" => [
                "label" => "Facebook",
                "icon" => "fa-brands fa-facebook",
                "link" => "social_media_facebook_link",
                "tab" => "facebook_link_new_tab",
                "default" => "#",
            ],
            "mastodon" => [
                "label" => "Mastodon",
                "icon" => "fa-brands fa-mastodon",
                "link" => "social_media_mastodon_link",
                "tab" => "mastodon_link_new_tab",
                "default" => "",
                "rel" => "me",
                "verify" => true,
            ],
            "bluesky" => [
                "label" => "Bluesky",
                "icon" => "fa-brands fa-bluesky",
                "link" => "social_media_bluesky_link",
                "tab" => "bluesky_link_new_tab",
                "default" => "",
            ],
            "threads" => [
                "label" => "Threads",
                "icon" => "fa-brands fa-threads",
                "link" => "social_media_threads_link",
                "tab" => "threads_link_new_tab",
                "default" => "",
            ],
            "linkedin" => [
                "label" => "LinkedIn",
                "icon" => "fa-brands fa-linkedin",
                "link" => "social_media_linkedin_link",
                "tab" => "linkedin_link_new_tab",
                "default" => "#",
            ],
            "xing" => [
                "label" => "Xing",
                "icon" => "fa-brands fa-xing",
                "link" => "social_media_xing_link",
                "tab" => "xing_link_new_tab",
                "default" => "",
            ],
            "github" => [
                "label" => "GitHub",
                "icon" => "fa-brands fa-github",
                "link" => "social_media_github_link",
                "tab" => "github_link_new_tab",
                "default" => "#",
            ],
            "pinterest" => [
                "label" => "Pinterest",
                "icon" => "fa-brands fa-pinterest",
                "link" => "social_media_pinterest_link",
                "tab" => "pintrest_link_new_tab",
                "default" => "#",
            ],
            "youtube" => [
                "label" => "Youtube",
                "icon" => "fa-brands fa-youtube",
                "link" => "social_media_youtube_link",
                "tab" => "youtube_link_new_tab",
                "default" => "#",
            ],
            "tiktok" => [
                "label" => "TikTok",
                "icon" => "fa-brands fa-tiktok",
                "link" => "social_media_tiktok_link",
                "tab" => "tiktok_link_new_tab",
                "default" => "",
            ],
            "reddit" => [
                "label" => "Reddit",
                "icon" => "fa-brands fa-reddit",
                "link" => "social_media_reddit_link",
                "tab" => "reddit_link_new_tab",
                "default" => "",
            ],
            "discord" => [
                "label" => "Discord",
                "icon" => "fa-brands fa-discord",
                "link" => "social_media_discord_link",
                "tab" => "discord_link_new_tab",
                "default" => "",
            ],
            "telegram" => [
                "label" => "Telegram",
                "icon" => "fa-brands fa-telegram",
                "link" => "social_media_telegram_link",
                "tab" => "telegram_link_new_tab",
                "default" => "",
            ],
            "signal" => [
                "label" => "Signal",
                "icon" => "fa-brands fa-signal-messenger",
                "link" => "social_media_signal_link",
                "tab" => "signal_link_new_tab",
                "default" => "",
            ],
            "skype" => [
                "label" => "Skype",
                "icon" => "fa-brands fa-skype",
                "link" => "social_media_skype_link",
                "tab" => "skype_link_new_tab",
                "default" => "#",
            ],
            "rssfeed" => [
                "label" => "RSS",
                "icon" => "fa fa-rss",
                "link" => "social_media_rssfeed_link",
                "tab" => "rss_link_new_tab",
                "default" => "#",
            ],
            "wordpress" => [
                "label" => "WordPress",
                "icon" => "fa-brands fa-wordpress",
                "link" => "social_media_wordpress_link",
                "tab" => "wp_link_new_tab",
                "default" => "#",
            ],
            "dropbox" => [
                "label" => "Dropbox",
                "icon" => "fa-brands fa-dropbox",
                "link" => "social_media_dropbox_link",
                "tab" => "db_link_new_tab",
                "default" => "#",
            ],
            "instagram" => [
                "label" => "Instagram",
                "icon" => "fa-brands fa-instagram",
                "link" => "social_media_instagram_link",
                "tab" => "insta_link_new_tab",
                "default" => "#",
            ],
            "vimeo" => [
                "label" => "Vimeo",
                "icon" => "fa-brands fa-vimeo",
                "link" => "social_media_vimeo_link",
                "tab" => "vimeo_link_new_tab",
                "default" => "",
            ],
            "spotify" => [
                "label" => "Spotify",
                "icon" => "fa-brands fa-spotify",
                "link" => "social_media_spotify_link",
                "tab" => "spotify_link_new_tab",
                "default" => "",
            ],
            "tidal" => [
                "label" => "Tidal",
                "icon" => "fa-brands fa-tidal",
                "link" => "social_media_tidal_link",
                "tab" => "tidal_link_new_tab",
                "default" => "",
            ],
        ];

        $networks = apply_filters("djs_wallstreet_social_networks", $networks);
    }

    return $networks;
}

/*
 * Standardwerte aller Social-Media-Optionen fuer get_initial_setup().
 */
function djs_wallstreet_social_defaults() {
    $defaults = [];

    foreach (djs_wallstreet_social_networks() as $network) {
        $defaults[$network["link"]] = isset($network["default"]) ? $network["default"] : "";
        $defaults[$network["tab"]] = false;
    }

    return $defaults;
}

/*
 * Liefert die konfigurierte URL eines Netzwerks oder "", wenn nicht gesetzt.
 */
function djs_wallstreet_social_url($network) {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $url = $current_setup->get($network["link"]);

    return (empty($url) || $url == "#") ? "" : $url;
}

/*
 * Identitaets-Verifikation (Mastodon, IndieWeb): <link rel="me"> im <head>.
 * Wird unabhaengig davon ausgegeben, ob die Icon-Leiste sichtbar ist.
 */
function djs_wallstreet_social_rel_me_links() {
    foreach (djs_wallstreet_social_networks() as $network) {
        if (empty($network["verify"])) {
            continue;
        }

        $url = djs_wallstreet_social_url($network);
        if ($url == "") {
            continue;
        }

        printf('<link rel="me" href="%s" />' . "\n", esc_url($url));
    }
}

add_action("wp_head", "djs_wallstreet_social_rel_me_links", 1);

