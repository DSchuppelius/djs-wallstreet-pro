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
