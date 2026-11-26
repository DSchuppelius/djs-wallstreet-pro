<?php
/* Template Name: Contact Us
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : contact-us.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Kontaktseite: Karte, Kontaktdaten (Customizer), Formular.
 * Das Formular wird VOR der Ausgabe verarbeitet; Fehler und Erfolg rendert das Template
 * selbst (vorher blendeten nachgeladene jQuery-Schnipsel die Meldungen ein).
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

/* ---- Formularverarbeitung ------------------------------------------- */
$form   = ["first_name" => "", "last_name" => "", "email" => "", "website" => "", "massage" => ""];
$errors = [];
$sent   = false;

if (isset($_POST["contact_submit"])) {
    if (!isset($_POST["wallstreet_name_nonce_field"]) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["wallstreet_name_nonce_field"])), "wallstreet_name_nonce_check")) {
        $errors["nonce"] = __("Sorry, your nonce did not verify", "djs-wallstreet-pro");
    } else {
        $form = [
            "first_name" => sanitize_text_field(wp_unslash($_POST["first_name"] ?? "")),
            "last_name"  => sanitize_text_field(wp_unslash($_POST["last_name"] ?? "")),
            "email"      => sanitize_email(wp_unslash($_POST["email"] ?? "")),
            "website"    => esc_url_raw(wp_unslash($_POST["website"] ?? "")),
            "massage"    => sanitize_textarea_field(wp_unslash($_POST["massage"] ?? "")),
        ];
        if ($form["first_name"] === "") {
            $errors["first_name"] = __("Please enter your first name.", "djs-wallstreet-pro");
        }
        if ($form["last_name"] === "") {
            $errors["last_name"] = __("Please enter your last name.", "djs-wallstreet-pro");
        }
        if ($form["email"] === "" || !is_email($form["email"])) {
            $errors["email"] = __("Please enter a valid email address.", "djs-wallstreet-pro");
        }
        if ($form["massage"] === "") {
            $errors["massage"] = __("Please enter a message.", "djs-wallstreet-pro");
        }

        if (!$errors) {
            $to      = get_option("admin_email");
            $subject = sprintf("%s %s - %s", $form["first_name"], $form["last_name"], get_option("blogname"));
            $body    = $form["massage"] . "\r\n\r\nMessage sent from: " . $form["first_name"] . " " . $form["last_name"] . " <" . $form["email"] . ">";
            if ($form["website"] !== "") {
                $body .= "\r\nWebsite: " . $form["website"];
            }
            $site_domain = preg_replace('/^www\./i', "", (string) wp_parse_url(home_url(), PHP_URL_HOST));
            $headers     = [
                "From: " . get_option("blogname") . " <wordpress@" . $site_domain . ">",
                "Reply-To: " . $form["first_name"] . " " . $form["last_name"] . " <" . $form["email"] . ">",
            ];
            $sent = wp_mail($to, $subject, $body, $headers);
            if (!$sent) {
                $errors["send"] = __("The message could not be sent. Please try again later.", "djs-wallstreet-pro");
            }
        }
    }
}

$field_error = static function (string $key) use ($errors): void {
    if (!empty($errors[$key])) {
        printf('<p class="field-error" id="%s-error">%s</p>', esc_attr($key), esc_html($errors[$key]));
    }
};
$invalid = static fn(string $key) => !empty($errors[$key]) ? ' aria-invalid="true" aria-describedby="' . esc_attr($key) . '-error"' : "";

/* ---- Kontaktkarten (Customizer) -------------------------------------- */
$cards = [];
foreach ([
    "address" => ["contact_address_settings", "contact_address_icon", "contact_address_title", ["contact_address_designation_one", "contact_address_designation_two"]],
    "phone"   => ["contact_phone_settings", "contact_phone_icon", "contact_phone_title", ["contact_phone_number_one", "contact_phone_number_two"]],
    "email"   => ["contact_email_settings", "contact_email_icon", "contact_email_title", ["contact_email_number_one", "contact_email_number_two"]],
] as $type => [$on, $icon, $title, $lines]) {
    if ($current_setup->get($on) != "on") {
        continue;
    }
    $cards[] = [
        "type"  => $type,
        "icon"  => (string) $current_setup->get($icon),
        "title" => (string) $current_setup->get($title),
        "lines" => array_values(array_filter(array_map(static fn($k) => trim((string) $current_setup->get($k)), $lines))),
    ];
}

$map_on  = $current_setup->get("contact_google_map_enabled") == "on";
$map_src = html_entity_decode((string) $current_setup->get("contact_google_map_url")) . "&output=embed";

get_template_parts(["template-parts/index/index", "banner"], true); ?>

<div class="page-shell site-wrap contact">
    <?php if ($map_on) { ?>
        <section class="contact-map surface-card">
            <?php if ($current_setup->get("contact_google_map_title") != "") { ?>
                <h2 class="contact-map__title google-map-title"><?php echo esc_html($current_setup->get("contact_google_map_title")); ?></h2>
            <?php } ?>
            <iframe class="contact-map__frame" src="<?php echo esc_url($map_src); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="<?php echo esc_attr($current_setup->get("contact_google_map_title") ?: __("Location map", "djs-wallstreet-pro")); ?>"></iframe>
        </section>
    <?php } ?>

    <?php if ($cards) { ?>
        <div class="card-grid card-grid--<?php echo count($cards); ?> contact-detail-section">
            <?php foreach ($cards as $card) { ?>
                <div class="contact-card surface-card contact-detail-area reveal">
                    <?php if ($card["icon"] !== "") { ?>
                        <span class="contact-card__icon" aria-hidden="true"><i class="fa <?php echo esc_attr($card["icon"]); ?>"></i></span>
                    <?php } ?>
                    <?php if ($card["title"] !== "") { ?><h3 class="contact-card__title"><?php echo esc_html($card["title"]); ?></h3><?php } ?>
                    <?php foreach ($card["lines"] as $line) {
                        if ($card["type"] === "phone") {
                            printf('<a href="tel:%s">%s</a>', esc_attr(preg_replace("/[^0-9+]/", "", $line)), esc_html($line));
                        } elseif ($card["type"] === "email" && is_email($line)) {
                            printf('<a href="mailto:%1$s">%1$s</a>', esc_html(antispambot($line)));
                        } else {
                            printf("<address>%s</address>", esc_html($line));
                        }
                    } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <section class="contact-form-section surface-card" id="myformdata">
        <?php djs_section_heading($current_setup->get("contact_form_title"), $current_setup->get("contact_form_description")); ?>

        <?php if ($sent) { ?>
            <div class="alert alert-success" role="status" id="mailsentbox">
                <span class="material-icons" aria-hidden="true">check_circle</span>
                <span><strong><?php esc_html_e("Thank you", "djs-wallstreet-pro"); ?></strong> <?php esc_html_e("Your information has been sent.", "djs-wallstreet-pro"); ?></span>
            </div>
        <?php } else { ?>
            <?php if (!empty($errors["nonce"]) || !empty($errors["send"])) { ?>
                <div class="alert alert-error" role="alert">
                    <span class="material-icons" aria-hidden="true">error</span>
                    <span><?php echo esc_html($errors["nonce"] ?? $errors["send"]); ?></span>
                </div>
            <?php } ?>
            <form class="contact-form" method="post" action="#myformdata" novalidate>
                <?php wp_nonce_field("wallstreet_name_nonce_check", "wallstreet_name_nonce_field"); ?>
                <div class="contact-form__grid">
                    <label class="form-field">
                        <span class="form-field__label"><?php esc_html_e("First name", "djs-wallstreet-pro"); ?> *</span>
                        <input type="text" name="first_name" autocomplete="given-name" required value="<?php echo esc_attr($form["first_name"]); ?>"<?php echo $invalid("first_name"); ?>>
                        <?php $field_error("first_name"); ?>
                    </label>
                    <label class="form-field">
                        <span class="form-field__label"><?php esc_html_e("Last name", "djs-wallstreet-pro"); ?> *</span>
                        <input type="text" name="last_name" autocomplete="family-name" required value="<?php echo esc_attr($form["last_name"]); ?>"<?php echo $invalid("last_name"); ?>>
                        <?php $field_error("last_name"); ?>
                    </label>
                    <label class="form-field">
                        <span class="form-field__label"><?php esc_html_e("Email", "djs-wallstreet-pro"); ?> *</span>
                        <input type="email" name="email" autocomplete="email" required value="<?php echo esc_attr($form["email"]); ?>"<?php echo $invalid("email"); ?>>
                        <?php $field_error("email"); ?>
                    </label>
                    <label class="form-field">
                        <span class="form-field__label"><?php esc_html_e("Website", "djs-wallstreet-pro"); ?></span>
                        <input type="url" name="website" autocomplete="url" value="<?php echo esc_attr($form["website"]); ?>">
                    </label>
                    <label class="form-field form-field--full">
                        <span class="form-field__label"><?php esc_html_e("Message", "djs-wallstreet-pro"); ?> *</span>
                        <textarea name="massage" rows="6" required<?php echo $invalid("massage"); ?>><?php echo esc_textarea($form["massage"]); ?></textarea>
                        <?php $field_error("massage"); ?>
                    </label>
                </div>
                <button class="btn btn-primary more" name="contact_submit" id="contact_submit" type="submit">
                    <?php esc_html_e("Send Message", "djs-wallstreet-pro"); ?><span class="material-icons" aria-hidden="true">send</span>
                </button>
            </form>
        <?php } ?>
    </section>
</div>

<?php get_footer();
