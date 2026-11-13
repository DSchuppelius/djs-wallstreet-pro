<?php
/* Template Name: About Us
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : about-us.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Ueber-uns: Beitragsbild, Text + Sidebar, Social-Links, Team, Call-out.
 */
$current_setup_posttypes = defined("DJS_POSTTYPE_PLUGIN") ? PostTypes_Plugin_Setup::instance() : DJS_Wallstreet_Pro_Theme_Setup::instance();

get_template_parts(["template-parts/index/index", "banner"], true);
the_post();

if (has_post_thumbnail()) { ?>
    <div class="page-shell site-wrap about-hero">
        <figure class="about-hero__media surface-card">
            <?php the_post_thumbnail("about-thumb", ["class" => "about-hero__img", "loading" => "eager", "fetchpriority" => "high"]); ?>
        </figure>
    </div>
<?php }

djs_layout_start(["class" => "about-us"]);

get_template_part("template-parts/content/content", "about");

if ($current_setup_posttypes->get("about_social_media_enabled")) { ?>
    <div class="about-social surface-card">
        <?php get_template_part("template-parts/global/social-media", null, ["context" => "about"]); ?>
    </div>
<?php }

djs_layout_end();

if (defined("TEAM_POST_TYPE") && $current_setup_posttypes->get("about_team_section_show_hide")) { ?>
    <section class="section team-section about-team site-wrap" aria-label="<?php esc_attr_e("Team", "djs-wallstreet-pro"); ?>">
        <?php djs_section_heading($current_setup_posttypes->get("about_team_title"), $current_setup_posttypes->get("about_team_description")); ?>
        <div class="card-grid card-grid--4">
            <?php foreach (djs_team_members() as $member) {
                get_template_part("template-parts/team/member", null, ["member" => $member, "variant" => "about"]);
            } ?>
        </div>
    </section>
<?php }

if ($current_setup_posttypes->get("about_callout_section_show_hide")) {
    get_template_part("template-parts/index/index", "calloutarea");
}

get_footer();
