<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : lazyload.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$specialLoadHnds = (object) [
    "scripts" => (object) [
        "async" => [],
        "defer" => [],
    ],
    "styles" => (object) [
        "async" => [],
        "asyncPreload" => [],
    ],
];
// Same signature as wp_enqueue_style, + $loadMethod as last arg
function wp_enqueue_style_special($handle, $srcString = "", $depArray = [], $version = false, $media = "all", $loadMethod = "async") {
    global $specialLoadHnds;
    array_push($specialLoadHnds->styles->{$loadMethod}, $handle);
    wp_enqueue_style($handle, $srcString, $depArray, $version, $media);
}
// Same signature as wp_enqueue_script, + $loadMethod as last arg
// Reminder - $inFooter should probably be false for both async and defer
function wp_enqueue_script_special($handle, $srcString = "", $depArray = [], $version = false, $inFooter = false, $loadMethod = "async") {
    global $specialLoadHnds;
    array_push($specialLoadHnds->scripts->{$loadMethod}, $handle);
    wp_enqueue_script($handle, $srcString, $depArray, $version, $inFooter);
}
// Identical signature to wp_enqueue_style
function wp_enqueue_style_deferred($handle, $srcString = "", $depArray = [], $version = false, $media = "all") {
    wp_enqueue_style_special($handle, $srcString, $depArray, $version, $media, "async");
}

/**
 * Custom Script and Style Enqueued stuff
 */
/**
 * Callback for WP to hit before echoing out an enqueued resource
 * @param {string} $tag - Will be the full string of the tag (`<link>` or `<script>`)
 * @param {string} $handle - The handle that was specified for the resource when enqueuing it
 * @param {string} $src - the URI of the resource
 * @param {string|null} $media - if resources is style, should be the target media, else null
 * @param {boolean} $isStyle - If the resource is a stylesheet
 */
function scriptAndStyleTagCallback($tag, $handle, $src, $media, $isStyle) {
    global $specialLoadHnds;
    $finalTag = $tag;
    if ($isStyle) {
        // Async loading via invalid mediaquery switching
        if (in_array($handle, $specialLoadHnds->styles->async, true)) {
            // Do not touch if already modified
            if (!preg_match('/\sonload=|\smedia=["\']none["\']/', $tag)) {
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = "<noscript>" . $tag . "</noscript>";
                // Add onload and media="none" attr, and put together with noscript
                $matches = [];
                preg_match("/(<link[^>]+)>/", $tag, $matches);
                $finalTag = str_replace(['media="' . $media . '"', 'media=\'' . $media . '\''], 'media="none" onload="if(media!=\'all\')media=\'all\'"', preg_replace('/\/$/', "", $matches[1], 1) . " />" . $noScriptStr);
            }
        }
        // Async loading via preload and loadCSS - https://github.com/filamentgroup/loadCSS/
        elseif (in_array($handle, $specialLoadHnds->styles->asyncPreload, true)) {
            // Do not touch if already modified
            if (!preg_match('/\srel=["\']preload|\sonload=["\']/', $tag)) {
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = "<noscript>" . $tag . "</noscript>";
                // Strip rel="" & as="" portion, if exist
                $tag = preg_replace('/\srel=["\'][^"\']*["\']|\sas=["\'][^"\']*["\']/', "", $tag, -1);
                // Add onload, rel="preload", as="style", and put together with noscript
                $matches = [];
                preg_match("/(<link[^>]+)>/", $tag, $matches);
                $finalTag = preg_replace('/\/$/', "", $matches[1], 1) . ' rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"' . " />" . $noScriptStr;
            }
        }
    } else {
        // Async
        if (in_array($handle, $specialLoadHnds->scripts->async, true)) {
            // Do not touch if already modified, or missing src attr
            if (!preg_match("/\sasync/", $tag) && preg_match("/src=/", $tag)) {
                // Add async attr
                $matches = [];
                preg_match("/(<script[^>]+)>/", $tag, $matches);
                $finalTag = $matches[1] . ' async="true"' . "></script>";
            }
        }
        // Defer
        elseif (in_array($handle, $specialLoadHnds->scripts->defer, true)) {
            // Do not touch if already modified, or missing src attr
            if (!preg_match("/\sdefer/", $tag) && preg_match("/src=/", $tag)) {
                // Add defer attr
                $matches = [];
                preg_match("/(<script[^>]+)>/", $tag, $matches);
                $finalTag = $matches[1] . " defer" . "></script>";
            }
        }
    }
    return $finalTag;
}
// BE CAREFUL OF PRIORITY
add_filter(
    "script_loader_tag",
    function ($tag, $handle, $src) {
        return scriptAndStyleTagCallback($tag, $handle, $src, null, false);
    },
    10,
    4
);
add_filter(
    "style_loader_tag",
    function ($tag, $handle, $src, $media) {
        return scriptAndStyleTagCallback($tag, $handle, $src, $media, true);
    },
    10,
    4
);
?>