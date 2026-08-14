<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<header>
    <h1><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_content_title(); ?></a></h1>
</header>
<section class="excerpt-section">
    <div class="excerpt">
        <?php
        // Die Customizer-Option "Excerpt length only for excerpt option"
        // (blog_template_content_excerpt_length) war bislang zwar einstellbar, wurde aber
        // nirgends gelesen. Sie greift jetzt hier - an der einzigen Stelle, an der die
        // Blog-Templates ihren Excerpt ausgeben. Der Wert zaehlt Zeichen, nicht Woerter;
        // 0 oder leer bedeutet "nicht kuerzen", dann gilt weiter WordPress' eigene Laenge.
        $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
        $excerpt_laenge = (int) $current_setup->get("blog_template_content_excerpt_length");

        $content = get_the_content();
        if (strpos($content, form_more_button()) !== false) {
            echo $content;
        } else {
            $excerpt = get_the_excerpt();
            $klartext = strip_all($excerpt);

            if ($klartext !== "") {
                if ($excerpt_laenge > 0 && mb_strlen($klartext) > $excerpt_laenge) {
                    echo apply_filters("the_excerpt", mb_substr($klartext, 0, $excerpt_laenge));
                    the_read_more();
                } else {
                    echo apply_filters("the_excerpt", $excerpt);
                    // mb_strlen auf beiden Seiten, damit der Vergleich nicht an Umlauten haengt.
                    if (mb_strlen($klartext) < mb_strlen(strip_all($content))) {
                        the_read_more();
                    }
                }
            } else {
                the_content();
            }
        } ?>
    </div>
</section>