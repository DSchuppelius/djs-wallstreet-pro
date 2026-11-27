<?php
/*
 * Created on   : Fri Nov 27 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-content.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Freier Inhaltsabschnitt der Startseite: gibt den Inhalt der im Customizer
 * gewaehlten Seite aus (Homepage-Einstellungen: "Seite fuer den Inhaltsabschnitt").
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$page_id = absint($current_setup->get("home_content_page"));
if (!$page_id) {
    return;
}

// Uebersetzung der Seite verwenden, falls WPML/Polylang aktiv ist
$page_id = (int) apply_filters("wpml_object_id", $page_id, "page", true);

$content_page = get_post($page_id);
if (!$content_page || $content_page->post_type !== "page" || $content_page->post_status !== "publish") {
    return;
}

// Seite als aktuellen Beitrag setzen, damit Bloecke, Shortcodes und der Passwortschutz wie auf der Seite selbst arbeiten
global $post;
$post = $content_page;
setup_postdata($post); ?>

<section class="section content-section site-wrap" id="home-content-<?php echo (int) $page_id; ?>">
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</section>

<?php wp_reset_postdata();
