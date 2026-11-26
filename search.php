<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : search.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

global $wp_query;

get_template_parts(["template-parts/index/index", "banner"], true);

djs_layout_start(["class" => "search"]); ?>

<div class="search-head">
    <p class="search-head__count">
        <?php printf(
            /* translators: %s: number of results */
            esc_html(_n("%s result", "%s results", (int) $wp_query->found_posts, "djs-wallstreet-pro")),
            "<strong>" . esc_html(number_format_i18n((int) $wp_query->found_posts)) . "</strong>"
        ); ?>
    </p>
    <?php get_search_form(); ?>
</div>

<?php djs_blog_loop(null, ["context" => "archive"]);
djs_layout_end();

get_footer();
