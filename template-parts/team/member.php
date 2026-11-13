<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : member.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Karte eines Team-Mitglieds. $args: member (siehe djs_team_member), variant (1-4, about).
 */

$member  = $args["member"] ?? [];
$variant = sanitize_html_class((string) ($args["variant"] ?? "1"));
if (!$member) {
    return;
} ?>
<article class="team-card team-card--<?php echo esc_attr($variant); ?> surface-card reveal">
    <div class="team-card__media">
        <?php echo $member["image"] ?: '<span class="team-card__placeholder material-icons" aria-hidden="true">person</span>'; ?>
        <?php if (!empty($member["links"])) { ?>
            <ul class="team-card__social social-links">
                <?php foreach ($member["links"] as $link) { ?>
                    <li>
                        <a class="social-links__link" href="<?php echo esc_url($link["url"]); ?>" <?php blank_target($link["new_tab"]); ?><?php echo $link["new_tab"] ? ' rel="noopener"' : ""; ?>
                            aria-label="<?php echo esc_attr($link["label"] . " – " . $member["name"]); ?>">
                            <i class="<?php echo esc_attr($link["icon"]); ?>" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
    <div class="team-card__body">
        <h3 class="team-card__name"><?php echo esc_html($member["name"]); ?></h3>
        <?php if ($member["designation"] !== "") { ?>
            <p class="team-card__role"><?php echo esc_html($member["designation"]); ?></p>
        <?php } ?>
        <?php if ($member["description"] !== "") { ?>
            <p class="team-card__text"><?php echo esc_html($member["description"]); ?></p>
        <?php } ?>
    </div>
</article>
