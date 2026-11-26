<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : team.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Team-Sektion (Startseite, Team-Seitentemplates). Ersetzt team-1.php ... team-4.php.
 * Customizer: team_design_style (Kartenstil 1-4), team_design_layout_style (Spaltenbreite).
 */

$pt = djs_pt();
if (!$pt || !defined("TEAM_POST_TYPE")) {
    return;
}
$style   = max(1, min(4, (int) ($args["variant"] ?? $pt->get("team_design_style"))));
$columns = djs_cols_from_colmd($pt->get("team_design_layout_style"), 3); ?>

<section class="section team-section team-section--v<?php echo $style; ?> site-wrap">
    <?php djs_section_heading($pt->get("home_team_title"), $pt->get("home_team_description")); ?>
    <div class="card-grid card-grid--<?php echo min(4, $columns); ?> team-grid">
        <?php foreach (djs_team_members() as $member) {
            get_template_part("template-parts/team/member", null, ["member" => $member, "variant" => (string) $style]);
        } ?>
    </div>
</section>
