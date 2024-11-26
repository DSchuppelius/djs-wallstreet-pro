<?php
/* Template Name: Contact Us
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : contact-us.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$mapsrc = $current_setup->get("contact_google_map_url");
$mapsrc .= "&amp;output=embed";

get_template_parts(["template-parts/index/index", "banner"], true); ?>

<div class="container contact">
    <div class="row map <?php row_frame_border(""); ?> flexstretch">
        <div class="col-md-12  <?php innerrow_frame_border(""); ?> ">
            <?php if ($current_setup->get("contact_google_map_enabled") == "on") { ?>
            <?php if (!empty($current_setup->get("contact_google_map_title"))) { ?>
            <div class="google-map-title">
                <h1><?php echo $current_setup->get("contact_google_map_title"); ?></h1>
            </div>
            <?php } ?>
            <div class="qua_google_map">
                <iframe width="100%" scrolling="no" height="500" frameborder="0" src="<?php echo esc_url($mapsrc); ?>"
                    marginwidth="0" marginheight="0"></iframe>
            </div>
            <?php } ?>
        </div>
    </div>
    <div
        class="row <?php row_frame_border(""); ?> flexstretch contact-detail-section <?php if ($current_setup->get("contact_google_map_enabled") != "on") { ?>map-disabled <?php } ?>">
        <?php if ($current_setup->get("contact_address_settings") == "on") { ?>
        <div class="col-md-4 col-sm-4">
            <div class="contact-detail-area <?php row_frame_border(""); innerrow_frame_border(" "); ?>">
                <?php if (!empty($current_setup->get("contact_address_icon"))): ?><span><i
                        class="fa <?php if ($current_setup->get("contact_address_icon")) { echo $current_setup->get("contact_address_icon"); } ?>"></i></span><?php endif; ?>
                <?php if (!empty($current_setup->get("contact_address_title"))) { ?><h5>
                    <?php echo $current_setup->get("contact_address_title"); ?></h5><?php } ?>
                <?php if (!empty($current_setup->get("contact_address_designation_one"))) { ?><address>
                    <?php echo $current_setup->get("contact_address_designation_one"); ?> </address><?php } ?>
                <?php if (!empty($current_setup->get("contact_address_designation_two"))) { ?><address>
                    <?php echo $current_setup->get("contact_address_designation_two"); ?> </address><?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($current_setup->get("contact_phone_settings") == "on") { ?>
        <div class="col-md-4 col-sm-4">
            <div class="contact-detail-area <?php row_frame_border(""); innerrow_frame_border(" "); ?>">
                <?php if (!empty($current_setup->get("contact_phone_icon"))) { ?><span><i
                        class="fa <?php echo $current_setup->get("contact_phone_icon"); ?>"></i></span><?php } ?>
                <?php if (!empty($current_setup->get("contact_phone_title"))) { ?><h5>
                    <?php echo $current_setup->get("contact_phone_title"); ?></h5><?php } ?>
                <?php if (!empty($current_setup->get("contact_phone_number_one"))) { ?><address>
                    <?php echo $current_setup->get("contact_phone_number_one"); ?></address><?php } ?>
                <?php if (!empty($current_setup->get("contact_phone_number_two"))) { ?><address>
                    <?php echo $current_setup->get("contact_phone_number_two"); ?></address><?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($current_setup->get("contact_email_settings") == "on") { ?>
        <div class="col-md-4 col-sm-4">
            <div class="contact-detail-area <?php row_frame_border(""); innerrow_frame_border(" "); ?>">
                <?php if (!empty($current_setup->get("contact_email_icon"))) { ?><span><i
                        class="fa <?php echo $current_setup->get("contact_email_icon"); ?>"></i></span><?php } ?>
                <?php if (!empty($current_setup->get("contact_email_title"))) { ?><h5>
                    <?php echo $current_setup->get("contact_email_title"); ?></h5><?php } ?>
                <?php if (!empty($current_setup->get("contact_email_number_one"))) { ?><address>
                    <?php echo $current_setup->get("contact_email_number_one"); ?></address><?php } ?>
                <?php if (!empty($current_setup->get("contact_email_number_two"))) { ?><address>
                    <?php echo $current_setup->get("contact_email_number_two"); ?></address><?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="row <?php row_frame_border(""); ?> flexstretch contact-form-section" id="myformdata">
        <div class="col-md-12">
            <?php if (!empty($current_setup->get("contact_form_title")) || !empty($current_setup->get("contact_form_description"))): ?>
            <div class="cont-heading-title">
                <?php if (!empty($current_setup->get("contact_form_title"))) { ?>
                <h1><?php echo $current_setup->get("contact_form_title"); ?></h1>
                <?php } ?>
                <?php if (!empty($current_setup->get("contact_form_description"))) { ?>
                <p><?php echo $current_setup->get("contact_form_description"); ?></p>
                <?php } ?>
            </div>
            <?php endif; ?>
            <div class="contact-form <?php innerrow_frame_border(""); ?>">
                <form role="form" class="form-inline" method="post" action="#">
                    <?php wp_nonce_field("wallstreet_name_nonce_check", "wallstreet_name_nonce_field"); ?>
                    <div class="cont-form-group">
                        <input type="name" id="first_name" name="first_name"
                            placeholder="<?php esc_attr_e("First name", "djs-wallstreet-pro"); ?>"
                            class="blog-form-control">
                        <span style="display:none; color:red"
                            id="contact_user_firstname_error"><?php esc_html_e("First name", "djs-wallstreet-pro"); ?>
                        </span>
                    </div>
                    <div class="cont-form-group">
                        <input type="name" id="last_name" name="last_name"
                            placeholder="<?php esc_attr_e("Last name", "djs-wallstreet-pro"); ?>"
                            class="blog-form-control">
                        <span style="display:none; color:red"
                            id="contact_user_lastname_error"><?php esc_html_e("Last name", "djs-wallstreet-pro"); ?>
                        </span>
                    </div>
                    <div class="cont-form-group">
                        <input type="email" id="email" name="email"
                            placeholder="<?php esc_attr_e("Email", "djs-wallstreet-pro"); ?>" class="blog-form-control">
                        <span style="display:none; color:red"
                            id="contact_user_email_error"><?php esc_html_e("Email", "djs-wallstreet-pro"); ?> </span>
                    </div>
                    <div class="cont-form-group">
                        <input type="text" id="website" name="website"
                            placeholder="<?php esc_attr_e("Website", "djs-wallstreet-pro"); ?>"
                            class="blog-form-control">
                        <span style="display:none; color:red"
                            id="contact_user_website_error"><?php esc_html_e("Website", "djs-wallstreet-pro"); ?>
                        </span>
                    </div>
                    <div class="cont-form-group-textarea">
                        <textarea placeholder="<?php esc_attr_e("Message", "djs-wallstreet-pro"); ?>"
                            class="cont-form-control-textarea" id="massage" name="massage" rows="5"></textarea>
                        <span style="display:none; color:red"
                            id="contact_user_massage_error"><?php esc_html_e("Message", "djs-wallstreet-pro"); ?>
                        </span>
                    </div>
                    <button class="qua_contact_btn" name="contact_submit" id="contact_submit"
                        type="submit"><?php esc_html_e("Send Message", "djs-wallstreet-pro"); ?>
                        <span style="display:none; color:red"
                            id="contact_nonce_error"><?php esc_html_e("Sorry, your nonce did not verify", "djs-wallstreet-pro"); ?></span>
                </form>
            </div>
        </div>
    </div>
    <div id="mailsentbox" style="display:none">
        <div class="alert alert-success">
            <strong><?php esc_html_e("Thank you", "djs-wallstreet-pro"); ?></strong>
            <?php esc_html_e("Your information has been sent.", "djs-wallstreet-pro"); ?>
        </div>
    </div>

    <?php if (isset($_POST["contact_submit"])) {
        $flag = 1;
        if (empty($_POST["first_name"])) {
            $flag = 0;
            echo "<script>jQuery('#contact_user_firstname_error').show();</script>";
        } elseif (empty($_POST["last_name"])) {
            $flag = 0;
            echo "<script>jQuery('#contact_user_lastname_error').show();</script>";
        } elseif ($_POST["email"] == "") {
            $flag = 0;
            echo "<script>jQuery('#contact_user_email_error').show();</script>";
        } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["email"])) {
            $flag = 0;
            echo "<script>jQuery('#contact_user_email_error').show();</script>";
        } elseif ($_POST["massage"] == "") {
            $flag = 0;
            echo "<script>jQuery('#contact_user_massage_error').show();</script>";
        } elseif (empty($_POST) || !wp_verify_nonce($_POST["wallstreet_name_nonce_field"], "wallstreet_name_nonce_check")) {
            echo "<script>jQuery('#contact_nonce_error').show();</script>";
            exit();
        } else {
            if ($flag == 1) {
                $to = get_option("admin_email");
                $subject = trim($_POST["first_name"]) . trim($_POST["last_name"]) . get_option("blogname");
                $massage = stripslashes(trim($_POST["massage"])) . "Message sent from:: " . trim($_POST["email"]);
                $headers = "From: " . trim($_POST["first_name"]) . trim($_POST["last_name"]) . " <" . trim($_POST["email"]) . ">\r\nReply-To:" . trim($_POST["email"]);
                $website = stripslashes(trim($_POST["website"]));
                $maildata = wp_mail($to, $subject, $massage, $headers, $website);
                if ($maildata) {
                    echo "<script>jQuery('#myformdata').hide();</script>";
                    echo "<script>jQuery('#mailsentbox').show();</script>";
                }
            }
        }
    } ?>
</div><?php get_footer(); ?>