<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : iframe.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function youtube_nocookie_solution($original, $url, $attr, $post_ID) {
    $html = str_replace("youtube.com", "youtube-nocookie.com", $original);
    $html = str_replace("feature=oembed", "feature=oembed&showinfo=0", $html);
    return $html;
}
add_filter("embed_oembed_html", "youtube_nocookie_solution", 10, 4);

function iframe_cookie_lazy_load($content) {
    $current_options = get_current_options();
    $actual_link = get_the_currentURL();

    if (empty($content)) {
        return $content;
    } else {
        libxml_use_internal_errors(true);
        $post = new DOMDocument();
        $post->loadHTML(mb_convert_encoding($content, "HTML-ENTITIES", "UTF-8"));
        $iframes = $post->getElementsByTagName("iframe");
        if (!isset($_COOKIE["cookieconsent_estatus"]) || $_COOKIE["cookieconsent_estatus"] != "allow") {
            if (count($iframes) > 0 && !headers_sent()) {
                header("Cache-Control: no-cache, no-store, must-revalidate");
            }
            foreach ($iframes as $iframe) {
                if ($iframe->hasAttribute("data-src") || $iframe->hasAttribute("internal")) {
                    continue;
                }
                $clone = $iframe->cloneNode();
                $src = $iframe->getAttribute("src");
                if (str_contains($src, $_SERVER["HTTP_HOST"])) {
                    continue;
                }

                $disclaimer  = '<hr style="width:50%;text-align:center;margin:20px auto"><div class="cookies"><h3>'.__("Third-party cookies", "wallstreet").'</h3><div class="inner cookies">';
                $disclaimer .= '<p class="cookies justify"><b>'.__("Hint:", "wallstreet").'</b> ' . utf8_decode($current_options["cookie_before"]) . "</p>";
                $disclaimer .= '<form class="cookies center" action="' . $actual_link . '"><button class="btn" onclick="document.cookie=\'cookieconsent_estatus=allow;path=/;SameSite=Lax\'; location.reload(true);">' . utf8_decode($current_options["cookie_link"]) . '</button></form>';
                $disclaimer .= '<p class="cookies justify">' . utf8_encode($current_options["cookie_after"]) . '</p></div></div>';
                $disclaimer .= '<div class="lcd crt"><a href="' . $src . '" target="_blank">' . $src . '</a></div><hr style="width:50%;text-align:center;margin:20px auto">';

                $cookieNode = $post->createElement("div");
                appendHTML($cookieNode, $disclaimer);

                $sanbox = str_replace("allow-same-origin", "", $iframe->getAttribute("sandbox"));
                if (isset($sandbox)) {
                    $iframe->setAttribute("sandbox", $sandbox);
                }

                $iframe->parentNode->insertBefore($cookieNode, $iframe);
                $iframe->removeAttribute("src");
                $iframe->setAttribute("data-src", $src);
                $srcset = $iframe->getAttribute("srcset");
                $iframe->removeAttribute("srcset");
                if (!empty($srcset)) {
                    $iframe->setAttribute("data-srcset", $srcset);
                }
                $iframeClass = $iframe->getAttribute("class");
                $iframe->setAttribute("class", $iframeClass . " lazy notShow");
            }
        }
        return $post->saveHTML();
    }
}
add_filter("the_content", "iframe_cookie_lazy_load", 15);

function appendHTML(DOMNode $parent, $source) {
    $tmpDoc = new DOMDocument();
    $tmpDoc->loadHTML($source);
    foreach ($tmpDoc->getElementsByTagName("body")->item(0)->childNodes as $node) {
        $node = $parent->ownerDocument->importNode($node, true);
        $parent->appendChild($node);
    }
}
?>
