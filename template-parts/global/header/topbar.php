<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : topbar.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Kopfzeile ueber dem Header: Social-Media-Links und Kontaktdaten.
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$show_social   = (bool) $current_setup->get("header_social_media_enabled");
$show_contact  = $current_setup->get("contact_header_settings") == "on";

if (!$show_social && !$show_contact) {
    return;
}

$phone = trim((string) $current_setup->get("contact_header_contact_settings"));
$email = trim((string) $current_setup->get("contact_header_email_settings")); ?>

<div class="site-topbar header-top-area rellax" data-rellax-speed="<?php echo intval($current_setup->get("data_rellax_speed_social_contact_header")); ?>">
    <div class="site-wrap site-topbar__inner">
        <div class="site-topbar__social">
            <?php if ($show_social) {
                get_template_part("template-parts/global/social-media", null, ["context" => "head"]);
            } ?>
        </div>

        <?php if ($show_contact && ($phone !== "" || $email !== "")) { ?>
            <ul class="site-topbar__contact head-contact-info">
                <?php if ($phone !== "") { ?>
                    <li>
                        <a href="tel:<?php echo esc_attr(preg_replace("/[^0-9+]/", "", $phone)); ?>">
                            <i class="fa-solid fa-phone" aria-hidden="true"></i><span><?php echo esc_html($phone); ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($email !== "") { ?>
                    <li>
                        <a href="mailto:<?php echo esc_attr(antispambot($email)); ?>">
                            <i class="fa-solid fa-envelope" aria-hidden="true"></i><span><?php echo esc_html(antispambot($email)); ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
