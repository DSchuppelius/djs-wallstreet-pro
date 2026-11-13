<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : layout.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seitenlayout (Hauptspalte + Sidebar), Beitrags-Meta, Blog-Schleife.
 * Ersetzt die Bootstrap-Spalten (col-md-8/col-md-4) in allen Templates.
 */

/* -------------------------------------------------------------------------
 *  Hauptspalte + Sidebar
 * ---------------------------------------------------------------------- */

/**
 * Oeffnet den Inhaltsbereich unter dem Seitenbanner.
 *
 * @param array $args {
 *     @type string $sidebar  "right" (Standard), "left" oder "none"
 *     @type string $area     Widget-Bereich der Sidebar (Standard sidebar_primary)
 *     @type string $class    zusaetzliche Klassen fuer den Container
 *     @type bool   $wide     breiter Inhalt ohne Sidebar (Masonry, Portfolio ...)
 * }
 */
function djs_layout_start(array $args = []): void {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $args = wp_parse_args($args, [
        'sidebar' => 'right',
        'area'    => 'sidebar_primary',
        'class'   => '',
        'wide'    => false,
    ]);

    if ($args['sidebar'] !== 'none' && !is_active_sidebar($args['area'])) {
        $args['sidebar'] = 'none';
    }

    $GLOBALS['djs_layout'] = $args;

    $classes = ['page-shell', 'site-wrap', 'layout', 'layout--sidebar-' . $args['sidebar']];
    if ($args['wide']) {
        $classes[] = 'layout--wide';
    }
    if ($current_setup->get('flexelements')) {
        $classes[] = 'layout--stretch';
    }
    if ($args['class']) {
        $classes[] = $args['class'];
    } ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <main id="main" class="layout__main">
    <?php
}

/**
 * Schliesst die Hauptspalte, gibt die Sidebar aus und schliesst den Container.
 */
function djs_layout_end(): void {
    $args = $GLOBALS['djs_layout'] ?? ['sidebar' => 'right', 'area' => 'sidebar_primary'];
    get_template_part('template-parts/content/filler'); ?>
        </main>
        <?php if ($args['sidebar'] !== 'none') {
            get_sidebar($args['area'] === 'woocommerce' ? 'woocommerce' : null);
        } ?>
    </div>
    <?php
    unset($GLOBALS['djs_layout']);
}

/* -------------------------------------------------------------------------
 *  Meta-Angaben (Autor, Datum, Kategorien, Tags)
 * ---------------------------------------------------------------------- */

/**
 * Darf Beitrags-Meta angezeigt werden? Kontext:
 *  blog     Blogliste und Einzelbeitrag  (Customizer: "Meta auf der Beitragsseite ausblenden")
 *  archive  Archive und Suche            ("... auf Archivseiten ausblenden")
 *  page     Seiten                       ("... auf Seiten ausblenden")
 *  home     Blog-Teaser der Startseite   ("... auf der Startseite ausblenden")
 */
function djs_show_post_meta(string $context = ''): bool {
    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    if ($context === '') {
        $context = djs_meta_context();
    }
    if ($context === 'page' && is_page_template('template/page-full-width-no-meta.php')) {
        return false;
    }

    $setting = [
        'blog'    => 'blog_meta_section_settings',
        'archive' => 'archive_page_meta_section_settings',
        'page'    => 'page_meta_section_settings',
        'home'    => 'home_meta_section_settings',
    ][$context] ?? 'blog_meta_section_settings';

    return !$current_setup->get($setting);
}

/**
 * Datum zeigen? Die "dateless"-Seitentemplates und die Ueber-uns-Seite verzichten darauf.
 */
function djs_show_post_date(string $context = ''): bool {
    if (!djs_show_post_meta($context)) {
        return false;
    }
    return !is_page_template(['template/page-full-width-dateless.php', 'template/about-us.php']);
}

/**
 * Kontext aus der aktuellen Anfrage; Blog-Seitentemplates zaehlen als "blog".
 */
function djs_meta_context(): string {
    if (!empty($GLOBALS['djs_meta_context'])) {
        return $GLOBALS['djs_meta_context'];
    }
    if (is_archive() || is_search()) {
        return 'archive';
    }
    if (is_page() && !djs_is_blog_template()) {
        return 'page';
    }
    return 'blog';
}

function djs_is_blog_template(): bool {
    $slug = get_page_template_slug();
    return is_string($slug) && str_starts_with($slug, 'template-blog/');
}

/**
 * Beschriftung des Beitragsformats ("Video", "Zitat" ...); leer fuer Seiten/eigene Typen.
 */
function djs_post_format_label(?int $post_id = null): string {
    $post_id = $post_id ?: get_the_ID();
    if (get_post_type($post_id) !== 'post') {
        return '';
    }
    $format = get_post_format($post_id) ?: 'standard';
    $labels = [
        'aside'    => __('Aside', 'djs-wallstreet-pro'),
        'audio'    => __('Audio', 'djs-wallstreet-pro'),
        'video'    => __('Video', 'djs-wallstreet-pro'),
        'chat'     => __('Chat', 'djs-wallstreet-pro'),
        'gallery'  => __('Gallery', 'djs-wallstreet-pro'),
        'image'    => __('Image', 'djs-wallstreet-pro'),
        'link'     => __('Link', 'djs-wallstreet-pro'),
        'quote'    => __('Quote', 'djs-wallstreet-pro'),
        'status'   => __('Status', 'djs-wallstreet-pro'),
        'standard' => __('Blog Post', 'djs-wallstreet-pro'),
    ];
    return $labels[$format] ?? '';
}

/**
 * Icon (Material Icons) je Beitragsformat.
 */
function djs_post_format_icon(?int $post_id = null): string {
    $format = get_post_format($post_id ?: get_the_ID()) ?: 'standard';
    return [
        'aside'    => 'sticky_note_2',
        'audio'    => 'headphones',
        'video'    => 'smart_display',
        'chat'     => 'forum',
        'gallery'  => 'photo_library',
        'image'    => 'image',
        'link'     => 'link',
        'quote'    => 'format_quote',
        'status'   => 'terminal',
        'standard' => 'article',
    ][$format] ?? 'article';
}

/* -------------------------------------------------------------------------
 *  Blog-Schleife fuer alle Listen (Index, Archive, Suche, Blog-Seitentemplates)
 * ---------------------------------------------------------------------- */

/**
 * Gibt eine Beitragsliste aus.
 *
 * @param WP_Query|null $query  null = Hauptabfrage
 * @param array $args {
 *     @type string $view     "stack" (Karten untereinander), "list" (Bild links),
 *                            "switcher" (Bild abwechselnd links/rechts), "masonry"
 *     @type int    $columns  Spalten fuer masonry (2-4)
 *     @type string $context  Meta-Kontext (blog, archive)
 *     @type string $page_param  eigener Query-Parameter fuer die Pagination
 * }
 */
function djs_blog_loop(?WP_Query $query = null, array $args = []): void {
    global $wp_query, $more;

    $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    $query = $query ?: $wp_query;
    $args  = wp_parse_args($args, [
        'view'       => 'stack',
        'columns'    => 3,
        'context'    => '',
        'page_param' => null,
    ]);

    $mode = $current_setup->get('blog_template_content_excerpt_get_setting') === 'content' ? 'content' : 'excerpt';
    $GLOBALS['djs_meta_context'] = $args['context'] ?: djs_meta_context();

    if (!$query->have_posts()) {
        get_template_part('template-parts/content/content', 'none');
        unset($GLOBALS['djs_meta_context']);
        return;
    }

    $columns = max(2, min(4, (int) $args['columns']));
    $classes = ['post-list', 'post-list--' . $args['view']];
    if ($args['view'] === 'masonry') {
        $classes[] = 'post-list--cols-' . $columns;
    } ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <?php
        $index = 0;
        while ($query->have_posts()) {
            $query->the_post();
            $more = 0;

            $variant = match ($args['view']) {
                'list'     => 'media',
                'switcher' => $index % 2 === 0 ? 'media' : 'media-reverse',
                'masonry'  => 'compact',
                default    => 'stack',
            };

            get_template_part('template-parts/content/content', null, [
                'mode'    => $mode,
                'variant' => $variant,
                'first'   => $index === 0,
            ]);
            $index++;
        } ?>
    </div>
    <?php
    $paged = max(1, (int) ($args['page_param'] ? ($_GET[$args['page_param']] ?? 1) : get_query_var('paged')));
    the_pagination($paged, $query, $args['page_param']);

    if ($query !== $wp_query) {
        wp_reset_postdata();
    }
    unset($GLOBALS['djs_meta_context']);
}

/**
 * Komplette Blog-Seite fuer die Seitentemplates in template-blog/.
 */
function djs_blog_page(array $args = []): void {
    $args = wp_parse_args($args, [
        'view'    => 'stack',
        'sidebar' => 'right',
        'columns' => 3,
    ]);

    get_template_parts(['template-parts/index/index', 'banner'], true);

    $paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
    $query = new WP_Query([
        'post_type'           => 'post',
        'paged'               => $paged,
        'ignore_sticky_posts' => false,
    ]);

    djs_layout_start([
        'sidebar' => $args['sidebar'],
        'wide'    => $args['view'] === 'masonry',
        'class'   => 'blog-page blog-page--' . $args['view'],
    ]);

    // Inhalt der Seite selbst (Einleitungstext ueber der Liste), falls vorhanden
    while (have_posts()) {
        the_post();
        if (trim(get_the_content()) !== '') { ?>
            <div class="page-intro surface-card entry-content"><?php the_content(); ?></div>
        <?php }
    }

    djs_blog_loop($query, ['view' => $args['view'], 'columns' => $args['columns'], 'context' => 'blog']);
    djs_layout_end();

    get_footer();
}
