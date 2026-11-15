<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-portfolio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Portfolio-Seiten (2/3/4 Spalten) mit Kategorie-Tabs und Pagination je Tab.
 * Tabs sind Links (?tab=slug) und funktionieren ohne JavaScript; theme.js schaltet sie ohne
 * Neuladen um. Seitenzahl ueber ?portfolio_seite= (WordPress raeumt paged auf Seiten weg).
 */

$pt = PostTypes_Plugin_Setup::instance();
djs_use_script("lightbox");

$columns = match (true) {
    is_page_template("template-specials/portfolio-2-column.php") => 2,
    is_page_template("template-specials/portfolio-3-column.php") => 3,
    default                                                       => 4,
};
$per_page    = (int) $pt->get("portfolio_numbers_on_templates");
$page_param  = "portfolio_seite";
$curpage     = max(1, (int) ($_GET[$page_param] ?? 1));
$tab         = sanitize_title(wp_unslash($_GET["tab"] ?? ($_GET["div"] ?? "")));
$terms       = get_terms(["taxonomy" => PORTFOLIO_TAXONOMY, "hide_empty" => true, "orderby" => "id"]);
$terms       = is_wp_error($terms) ? [] : $terms;

// Alle Projekte einmal laden und den Kategorien (inkl. Elternkategorien) zuordnen
$all = new WP_Query([
    "post_type"           => PORTFOLIO_POST_TYPE,
    "post_status"         => "publish",
    "posts_per_page"      => -1,
    "orderby"             => "menu_order",
    "no_found_rows"       => true,
    "ignore_sticky_posts" => true,
]);
$term_by_id = [];
foreach ($terms as $t) {
    $term_by_id[$t->term_id] = $t;
}
$by_slug = [];
if ($all->posts) {
    $slugs_per_post = [];
    $relations = wp_get_object_terms(wp_list_pluck($all->posts, "ID"), PORTFOLIO_TAXONOMY, ["fields" => "all_with_object_id"]);
    if (!is_wp_error($relations)) {
        foreach ($relations as $rel) {
            $slugs_per_post[$rel->object_id][$rel->slug] = true;
            $parent = (int) $rel->parent;
            $seen   = [];
            while ($parent && isset($term_by_id[$parent]) && !isset($seen[$parent])) {
                $seen[$parent] = true;
                $slugs_per_post[$rel->object_id][$term_by_id[$parent]->slug] = true;
                $parent = (int) $term_by_id[$parent]->parent;
            }
        }
    }
    foreach ($all->posts as $p) {
        foreach (array_keys($slugs_per_post[$p->ID] ?? []) as $slug) {
            $by_slug[$slug][] = $p;
        }
    }
}

$terms = array_values(array_filter($terms, static fn($t) => !empty($by_slug[$t->slug])));
$slugs = array_map(static fn($t) => rawurldecode($t->slug), $terms);
if ($tab === "" || !in_array($tab, $slugs, true)) {
    $tab = $slugs[0] ?? "";
} ?>

<div class="page-shell site-wrap portfolio portfoliocat">
    <?php djs_section_heading($pt->get("two_thre_four_col_port_tem_title"), $pt->get("two_thre_four_col_port_tem_desc")); ?>

    <?php if (count($terms) > 1) { ?>
        <nav class="portfolio-tabs" aria-label="<?php esc_attr_e("Categories", "djs-wallstreet-pro"); ?>">
            <div class="portfolio-tabs__list" role="tablist" data-tabs>
                <?php foreach ($terms as $t) {
                    $slug = rawurldecode($t->slug); ?>
                    <a role="tab" class="btn btn-primary portfolio-tab<?php echo $slug === $tab ? " tab-active" : ""; ?>" id="tab-<?php echo esc_attr($slug); ?>"
                        aria-selected="<?php echo $slug === $tab ? "true" : "false"; ?>" aria-controls="pane-<?php echo esc_attr($slug); ?>"
                        href="<?php echo esc_url(add_query_arg("tab", $slug, remove_query_arg([$page_param, "div"]))); ?>"><?php echo esc_html($t->name); ?></a>
                <?php } ?>
            </div>
        </nav>
    <?php } ?>

    <?php foreach ($terms as $t) {
        $slug  = rawurldecode($t->slug);
        $posts = $by_slug[$t->slug];
        $pages = $per_page > 0 ? (int) ceil(count($posts) / $per_page) : 1;
        $page  = min($curpage, max(1, $pages));
        $shown = $per_page > 0 ? array_slice($posts, ($page - 1) * $per_page, $per_page) : $posts; ?>
        <section id="pane-<?php echo esc_attr($slug); ?>" class="portfolio-pane" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($slug); ?>"<?php echo $slug === $tab ? "" : " hidden"; ?>>
            <div class="card-grid card-grid--<?php echo $columns; ?> portfolio-grid">
                <?php foreach ($shown as $i => $p) {
                    get_template_part("template-parts/portfolio/card", null, [
                        "item"  => djs_portfolio_item($p->ID, "port-thumb", $columns === 4 ? 15 : 30),
                        "index" => $i,
                    ]);
                } ?>
            </div>
            <?php if ($pages > 1) {
                $fake = (object) ["max_num_pages" => $pages];
                the_pagination($page, $fake, $page_param, add_query_arg("tab", $slug, remove_query_arg("div")));
            } ?>
        </section>
    <?php } ?>

    <?php if (!$terms) {
        get_template_part("template-parts/content/content", "none");
    } ?>
</div>
