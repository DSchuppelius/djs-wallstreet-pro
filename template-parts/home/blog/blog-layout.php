<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-layout.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Blog-Teaser der Startseite. Ersetzt blog-layout-1.php ... blog-layout-6.php
 * (get_template_part faellt auf diese Datei zurueck). Customizer "Blog design style":
 *  1 = Raster (3 Spalten, nur Standard-/Chat-Beitraege)   2-4 = Masonry mit 2/3/4 Spalten
 *  5 = Liste                                              6 = Wechselansicht
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$design        = max(1, min(6, (int) $current_setup->get("home_blog_design")));

$args = [
    "post_type"           => "post",
    "posts_per_page"      => (int) $current_setup->get("home_blog_counts"),
    "post__not_in"        => get_option("sticky_posts"),
    "ignore_sticky_posts" => true,
    "no_found_rows"       => true,
];
if ($design === 1) {
    $args["tax_query"] = [[
        "taxonomy" => "post_format",
        "field"    => "slug",
        "terms"    => ["post-format-aside", "post-format-status", "post-format-quote", "post-format-audio", "post-format-gallery", "post-format-image", "post-format-link", "post-format-video"],
        "operator" => "NOT IN",
    ]];
}
$query = new WP_Query($args);

[$list_class, $variant] = match ($design) {
    2       => ["post-list post-list--masonry post-list--cols-2", "compact"],
    3       => ["post-list post-list--masonry post-list--cols-3", "compact"],
    4       => ["post-list post-list--masonry post-list--cols-4", "compact"],
    5       => ["post-list post-list--list", "media"],
    6       => ["post-list post-list--switcher", "media"],
    default => ["card-grid card-grid--3 home-blog-grid", "compact"],
}; ?>

<section class="section home-blog-section home-blog--<?php echo $design; ?> site-wrap<?php echo in_array($design, [2, 3, 4], true) ? " site-wrap--wide" : ""; ?>">
    <?php djs_section_heading($current_setup->get("home_blog_heading"), $current_setup->get("home_blog_description")); ?>

    <?php if ($query->have_posts()) {
        $GLOBALS["djs_meta_context"] = "home"; ?>
        <div class="<?php echo esc_attr($list_class); ?>">
            <?php $i = 0;
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part("template-parts/content/content", null, [
                    "mode"    => "teaser",
                    "variant" => $design === 6 ? ($i % 2 ? "media-reverse" : "media") : $variant,
                ]);
                $i++;
            } ?>
        </div>
        <?php wp_reset_postdata();
        unset($GLOBALS["djs_meta_context"]);
    } else { ?>
        <p class="post_message empty-note"><?php esc_html_e("No posts to show", "djs-wallstreet-pro"); ?></p>
    <?php } ?>

    <?php if ($current_setup->get("view_all_posts_btn_enabled")) {
        the_show_all($current_setup->get("all_posts_link"), $current_setup->get("view_all_posts_text"), $current_setup->get("view_all_link_target"));
    } ?>
</section>
