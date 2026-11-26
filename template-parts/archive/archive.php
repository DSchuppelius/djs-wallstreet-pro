<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : archive.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Archive (Kategorie, Schlagwort, Autor, Datum, Formate).
 */

global $archive_type, $wp_query;

get_template_parts(["template-parts/index/index", "banner"], true);

$query = $wp_query;
if (!empty($archive_type)) {
    // Kategorie/Schlagwort/Autor: nur Beitraege, keine fremden Post-Types im Archiv.
    $query = new WP_Query([
        "post_type"    => "post",
        "paged"        => max(1, (int) get_query_var("paged")),
        $archive_type  => get_query_var($archive_type),
    ]);
}

djs_layout_start(["class" => "archive" . (empty($archive_type) ? "" : " " . sanitize_html_class($archive_type))]);

if ($description = get_the_archive_description()) { ?>
    <div class="archive-intro surface-card entry-content"><?php echo wp_kses_post($description); ?></div>
<?php }

djs_blog_loop($query, ["context" => "archive"]);
djs_layout_end();

get_footer();
