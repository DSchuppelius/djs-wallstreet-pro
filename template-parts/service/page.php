<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seitentemplates "Service Two ... Six": drei Services, Call-out, weitere Services.
 * $args: variant (2-6).
 */

$pt      = djs_pt();
$variant = max(1, min(6, (int) ($args["variant"] ?? 2)));

get_template_parts(["template-parts/index/index", "banner"], true);

$all   = djs_service_items(-1);
$first = array_slice($all, 0, 3);
$rest  = array_slice($all, 3); ?>

<div class="page-shell site-wrap service-page service-page--v<?php echo $variant; ?>">
    <?php while (have_posts()) {
        the_post();
        if (trim(get_the_content()) !== "") { ?>
            <div class="page-intro surface-card entry-content"><?php the_content(); ?></div>
        <?php }
    } ?>

    <section class="section service-section">
        <?php djs_section_heading($pt->get("service_title"), $pt->get("service_description")); ?>
        <?php get_template_part("template-parts/service/grid", null, ["items" => $first, "variant" => $variant, "hover" => true]); ?>
    </section>
</div>

<?php get_template_part("template-parts/index/index", "calloutarea");

if ($pt->get("other_service_section_enabled") && $rest) { ?>
    <section class="section service-section service-section--more site-wrap">
        <?php djs_section_heading($pt->get("other_service_title"), $pt->get("other_service_description")); ?>
        <?php get_template_part("template-parts/service/grid", null, ["items" => $rest, "variant" => $variant, "hover" => true]); ?>
    </section>
<?php }

get_footer();
