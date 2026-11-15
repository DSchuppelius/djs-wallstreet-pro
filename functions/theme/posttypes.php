<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : posttypes.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Helfer fuer die Inhalte des Post-Types-Plugins (Team, Testimonials, Kunden ...) und gemeinsame Abschnitts-Bausteine.
 */

/**
 * Abschnittsueberschrift (Startseiten-Sektionen, Team, Testimonials ...).
 * Titel/Beschreibung stammen aus dem Customizer und duerfen einfaches HTML enthalten.
 */
function djs_section_heading(?string $title, ?string $description = '', string $tag = 'h2'): void {
    $title       = trim((string) $title);
    $description = trim((string) $description);
    if ($title === '' && $description === '') {
        return;
    }
    $tag = in_array($tag, ['h1', 'h2', 'h3'], true) ? $tag : 'h2'; ?>
    <header class="section-heading section_heading_title">
        <?php if ($title !== '') { ?>
            <<?php echo $tag; ?> class="section-heading__title"><?php echo wp_kses_post($title); ?></<?php echo $tag; ?>>
            <span class="section-heading__sep pagetitle-separator" aria-hidden="true"><span></span></span>
        <?php } ?>
        <?php if ($description !== '') { ?>
            <p class="section-heading__text"><?php echo wp_kses_post($description); ?></p>
        <?php } ?>
    </header>
    <?php
}

/**
 * Daten eines Team-Mitglieds (Meta-Felder des Post-Types-Plugins).
 *
 * @return array{name:string, designation:string, description:string, image:string, links:array}
 */
function djs_team_member(?int $post_id = null): array {
    $post_id = $post_id ?: get_the_ID();
    $meta    = static fn(string $key) => sanitize_text_field((string) get_post_meta($post_id, $key, true));

    $networks = [
        'fb'    => ['fa-brands fa-facebook', 'Facebook'],
        'skype' => ['fa-brands fa-skype', 'Skype'],
        'rss'   => ['fa-solid fa-rss', 'RSS'],
        'lnkd'  => ['fa-brands fa-linkedin', 'LinkedIn'],
        'twt'   => ['fa-brands fa-x-twitter', 'X / Twitter'],
    ];

    $links = [];
    foreach ($networks as $key => [$icon, $label]) {
        $url = $meta($key . '_meta_save');
        if ($url !== '') {
            $links[] = [
                'url'     => $url,
                'icon'    => $icon,
                'label'   => $label,
                'new_tab' => (bool) $meta($key . '_meta_save_chkbx'),
            ];
        }
    }

    return [
        'name'        => get_the_title($post_id),
        'designation' => $meta('designation_meta_save'),
        'description' => $meta('description_meta_save'),
        'image'       => has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id, 'port-thumb', ['class' => 'team-card__img', 'loading' => 'lazy']) : '',
        'links'       => $links,
    ];
}

/**
 * Platzhalter-Team, solange keine Mitglieder angelegt sind (wie bisher).
 */
function djs_team_demo_members(int $count = 4): array {
    $names = ['Danial Creg', 'Alexia Doe', 'John Doe', 'Beatrix Doe'];
    $roles = [__('FOUNDER', 'djs-wallstreet-pro'), __('DEVELOPER', 'djs-wallstreet-pro'), __('DESIGNER', 'djs-wallstreet-pro'), __('DEVELOPER', 'djs-wallstreet-pro')];
    $out   = [];
    for ($i = 1; $i <= min($count, 4); $i++) {
        $out[] = [
            'name'        => $names[$i - 1],
            'designation' => $roles[$i - 1],
            'description' => 'Lorem ipsum dolor sit amet, conet adipis cing. Lorem ipsum dolore sit amet, consectetur adipisicings elit',
            'image'       => '<img class="team-card__img" src="' . esc_url(THEME_ASSETS_PATH_URI . '/images/team/team' . $i . '.jpg') . '" alt="" loading="lazy">',
            'links'       => [],
        ];
    }
    return $out;
}

/**
 * Alle Team-Mitglieder (oder Platzhalter).
 */
function djs_team_members(): array {
    if (!defined('TEAM_POST_TYPE')) {
        return [];
    }
    $query = new WP_Query([
        'post_type'           => TEAM_POST_TYPE,
        'posts_per_page'      => -1,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    ]);
    if (!$query->have_posts()) {
        return djs_team_demo_members();
    }
    $members = [];
    while ($query->have_posts()) {
        $query->the_post();
        $members[] = djs_team_member();
    }
    wp_reset_postdata();
    return $members;
}

/* -------------------------------------------------------------------------
 *  Allgemein
 * ---------------------------------------------------------------------- */

/**
 * Einstellungen des Post-Types-Plugins (oder null, wenn es fehlt).
 */
function djs_pt(): ?object {
    return defined('DJS_POSTTYPE_PLUGIN') ? PostTypes_Plugin_Setup::instance() : null;
}

/**
 * Bootstrap-Spaltenbreite aus alten Optionen (col-md-N) -> Anzahl Spalten.
 */
function djs_cols_from_colmd($value, int $default = 3): int {
    $value = (int) $value;
    return $value > 0 && $value <= 12 ? max(1, min(6, intdiv(12, $value))) : $default;
}

/**
 * Bindet ein Frontend-Modul (assets/js/<name>.js) bei Bedarf ein - Aufruf aus Templates.
 */
function djs_use_script(string $name): void {
    $path = 'js/' . $name . '.js';
    wp_enqueue_script('djs-' . $name, djs_asset_uri($path), ['djs-wallstreet-pro'], djs_asset_version($path), ['strategy' => 'defer', 'in_footer' => true]);
}

/* -------------------------------------------------------------------------
 *  Services
 * ---------------------------------------------------------------------- */

function djs_service_item(?int $post_id = null): array {
    $post_id = $post_id ?: get_the_ID();
    $link    = (string) get_post_meta($post_id, 'meta_service_link', true);
    $use_icon = (bool) get_post_meta($post_id, 'service_icon_target', true);
    $icon     = sanitize_text_field((string) get_post_meta($post_id, 'service_icon_image', true));

    return [
        'title'   => get_the_title($post_id),
        'text'    => wp_kses_post((string) get_post_meta($post_id, 'service_description_text', true)),
        'icon'    => $use_icon && $icon !== '' ? $icon : '',
        'image'   => (!$use_icon || $icon === '') && has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id, 'service-thumb', ['class' => 'service-card__img', 'loading' => 'lazy']) : '',
        'url'     => $link !== '' ? $link : get_permalink($post_id),
        'new_tab' => (bool) get_post_meta($post_id, 'meta_service_target', true),
        'more'    => sanitize_text_field((string) get_post_meta($post_id, 'service_readmore_text', true)),
    ];
}

function djs_service_demo(): array {
    $titles = [__('Product designing', 'djs-wallstreet-pro'), __('WordPress themes', 'djs-wallstreet-pro'), __('Responsive designs', 'djs-wallstreet-pro')];
    $items  = [];
    foreach ($titles as $i => $title) {
        $items[] = [
            'title'   => $title,
            'text'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl.',
            'icon'    => '',
            'image'   => '<img class="service-card__img" src="' . esc_url(THEME_ASSETS_PATH_URI . '/images/service' . ($i + 1) . '.jpg') . '" alt="" loading="lazy">',
            'url'     => '#',
            'new_tab' => false,
            'more'    => __('Read More', 'djs-wallstreet-pro'),
        ];
    }
    return $items;
}

/**
 * Services als Liste. $limit -1 = alle, $offset fuer "weitere Services".
 */
function djs_service_items(int $limit = -1, int $offset = 0, bool $demo = true): array {
    if (!defined('SERVICE_POST_TYPE')) {
        return [];
    }
    $query = new WP_Query([
        'post_type'           => SERVICE_POST_TYPE,
        'posts_per_page'      => $limit,
        'offset'              => $offset,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    ]);
    if (!$query->have_posts()) {
        return ($demo && $offset === 0) ? djs_service_demo() : [];
    }
    $items = [];
    while ($query->have_posts()) {
        $query->the_post();
        $items[] = djs_service_item();
    }
    wp_reset_postdata();
    return $items;
}

/* -------------------------------------------------------------------------
 *  Portfolio
 * ---------------------------------------------------------------------- */

function djs_portfolio_item(?int $post_id = null, string $size = 'port-thumb', int $words = 30): array {
    $post_id   = $post_id ?: get_the_ID();
    $project   = (string) get_post_meta($post_id, 'meta_project_link', true);
    $button    = (string) get_post_meta($post_id, 'meta_button_link', true);
    $thumb_id  = get_post_thumbnail_id($post_id);

    return [
        'id'          => $post_id,
        'title'       => get_the_title($post_id),
        'excerpt'     => portfolio_excerpt($words, $post_id),
        'image'       => $thumb_id ? wp_get_attachment_image($thumb_id, $size, false, ['class' => 'portfolio-card__img', 'loading' => 'lazy', 'alt' => '']) : '',
        'full'        => $thumb_id ? (string) wp_get_attachment_image_url($thumb_id, 'full') : '',
        'url'         => $project !== '' ? $project : get_permalink($post_id),
        'new_tab'     => (bool) get_post_meta($post_id, 'meta_project_target', true),
        'show_image'  => (bool) get_post_meta($post_id, 'show_project_picture_link', true),
        'button_url'  => $button !== '' ? $button : ($project !== '' ? $project : get_permalink($post_id)),
        'button_tab'  => (bool) get_post_meta($post_id, 'meta_button_target', true),
        'summary'     => (string) (get_post_meta($post_id, 'portfolio_project_summary', true) ?: __('Detail', 'djs-wallstreet-pro')),
    ];
}

/* -------------------------------------------------------------------------
 *  Testimonials
 * ---------------------------------------------------------------------- */

function djs_testimonial_items(): array {
    if (!defined('TESTIMONIAL_POST_TYPE')) {
        return [];
    }
    $query = new WP_Query([
        'post_type'           => TESTIMONIAL_POST_TYPE,
        'posts_per_page'      => -1,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    ]);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = [
                'name'  => get_the_title(),
                'text'  => sanitize_text_field((string) get_post_meta(get_the_ID(), 'testimonial_description_text', true)),
                'image' => has_post_thumbnail() ? get_the_post_thumbnail(null, 'widget-thumb', ['class' => 'quote-card__img', 'loading' => 'lazy', 'alt' => '']) : '',
            ];
        }
        wp_reset_postdata();
        return $items;
    }
    for ($i = 1; $i <= 4; $i++) {
        $items[] = [
            'name'  => 'David Warner',
            'text'  => 'Juis voluptatem sequi nesciunt. Neque porro quisquam est, qui don numquam eius modi ssim hen urlus mattis dignissim dapibctumst.',
            'image' => '<img class="quote-card__img" src="' . esc_url(THEME_ASSETS_PATH_URI . '/images/testi' . $i . '.jpg') . '" alt="" loading="lazy">',
        ];
    }
    return $items;
}

/* -------------------------------------------------------------------------
 *  Kunden / Partner (Logo-Leisten)
 * ---------------------------------------------------------------------- */

function djs_logo_items(string $post_type, string $link_meta, string $target_meta, string $demo_dir): array {
    if (!post_type_exists($post_type)) {
        return [];
    }
    $query = new WP_Query([
        'post_type'           => $post_type,
        'posts_per_page'      => -1,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    ]);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = [
                'name'    => get_the_title(),
                'url'     => (string) get_post_meta(get_the_ID(), $link_meta, true),
                'new_tab' => (bool) get_post_meta(get_the_ID(), $target_meta, true),
                'image'   => has_post_thumbnail() ? get_the_post_thumbnail(null, 'medium', ['class' => 'logo-strip__img', 'loading' => 'lazy', 'alt' => get_the_title()]) : '',
            ];
        }
        wp_reset_postdata();
        return $items;
    }
    for ($i = 1; $i <= 4; $i++) {
        $items[] = [
            'name'    => 'Demo',
            'url'     => '',
            'new_tab' => false,
            'image'   => '<img class="logo-strip__img" src="' . esc_url(THEME_ASSETS_PATH_URI . '/images/' . $demo_dir . '/' . rtrim($demo_dir, 's') . $i . '.png') . '" alt="" loading="lazy">',
        ];
    }
    return $items;
}
