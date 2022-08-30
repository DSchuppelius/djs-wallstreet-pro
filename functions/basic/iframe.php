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
    $wallstreet_pro_options = theme_data_setup();
    $current_options = wp_parse_args(get_option("wallstreet_pro_options", []), $wallstreet_pro_options);
    $actual_link = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
                $disclaimer .= '<p class="cookies justify"><b>'.__("Hint:", "wallstreet").'</b> '.__("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", "wallstreet").' <a href="/impressum">'.__("Imprint", "wallstreet").'</a>, <a href="/datenschutzerklaerung">'.__("Privacy policy", "wallstreet").'</a>. '.__("Do you have any further questions on this topic? Write me via the", "wallstreet").' <a href="/kontakt">'.__("contact form", "wallstreet").'</a> '.__("or by e-mail", "wallstreet").' (<a href="mailto:' . $current_options["contact_email_number_one"] . '" >' . $current_options["contact_email_number_one"] . "</a>)</p>";
                $disclaimer .= '<form class="cookies center" action="' . $actual_link . '"><button class="btn" onclick="document.cookie=\'cookieconsent_estatus=allow;path=/;SameSite=Lax\'; location.reload(true);">'.__("Yes, I would like to activate the content on this page...", "wallstreet").'</button></form>';
                $disclaimer .= '<p class="cookies justify">'.__("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", "wallstreet").'</p></div></div>';
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
