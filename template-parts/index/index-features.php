<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-features.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if (defined("DJS_POSTTYPE_PLUGIN")) {
    $current_setup_posttypes = PostTypes_Plugin_Setup::instance();

    $theme_feature_image = $current_setup_posttypes->get("theme_feature_image");
    $theme_feature_title = $current_setup_posttypes->get("theme_feature_title");
    $theme_feature_enabled = $current_setup_posttypes->get("theme_feature_enabled");

    $theme_first_title = $current_setup_posttypes->get("theme_first_title");
    $theme_first_description = $current_setup_posttypes->get("theme_first_description");
    $theme_first_feature_icon = $current_setup_posttypes->get("theme_first_feature_icon");

    $theme_second_title = $current_setup_posttypes->get("theme_second_title");
    $theme_second_description = $current_setup_posttypes->get("theme_second_description");
    $theme_second_feature_icon = $current_setup_posttypes->get("theme_second_feature_icon");

    $theme_third_title = $current_setup_posttypes->get("theme_third_title");
    $theme_third_description = $current_setup_posttypes->get("theme_third_description");
    $theme_third_feature_icon = $current_setup_posttypes->get("theme_third_feature_icon");

    if ($theme_feature_enabled == true) { ?>
<div class="features-section"
    style="background: url('<?php echo $current_setup_posttypes->get("theme_feature_background"); ?>'); background-size:cover; background-position:center center; <?php echo $current_setup_posttypes->get("theme_feature_background_fixed") ? 'background-attachment:fixed;' : '' ;?>">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <?php if (!empty($theme_feature_image)) { ?>
                <div class="col-md-6 col-sm-6">
                    <?php if ($current_setup_posttypes->get("feature_image_link")) { ?>
                    <a href="<?php echo $current_setup_posttypes->get("feature_image_link"); ?>"
                        <?php blank_target($current_setup_posttypes->get("image_link_target") == true); ?>><img
                            class="img-responsive features-img" alt="Wallstreet Image"
                            style="height:331px; width:525px;" src="<?php echo $theme_feature_image; ?>"></a>
                    <?php } else { ?>
                    <img class="img-responsive features-img" alt="Wallstreet Image" style="height:331px; width:525px;"
                        src="<?php echo $theme_feature_image; ?>">
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="col-md-6 col-sm-6">
                    <?php if (!empty($theme_feature_title)) { ?><div class="features-title">
                        <?php echo $theme_feature_title; ?></div><?php } ?>
                    <?php if (!empty($theme_first_feature_icon) || !empty($theme_first_title) || !empty($theme_first_description)): ?>
                    <div class="media features-area">
                        <?php if (!empty($theme_first_feature_icon)): ?>
                        <div class="feature-icon"><i
                                class="fa <?php if (!empty($theme_first_feature_icon)) { echo $theme_first_feature_icon; } ?>"></i>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($theme_first_title) || !empty($theme_first_description)): ?>
                        <div class="media-body">
                            <?php if (!empty($theme_first_title)) { ?><h3><?php echo $theme_first_title; ?></h3>
                            <?php } ?>
                            <?php if (!empty($theme_first_description)) { ?><p><?php echo $theme_first_description; ?>
                            </p><?php } ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($theme_second_feature_icon) || !empty($theme_second_title) || !empty($theme_second_description)): ?>
                    <div class="media features-area">
                        <?php if (!empty($theme_second_feature_icon)): ?><div class="feature-icon"><i
                                class="fa <?php if (!empty($theme_second_feature_icon)) { echo $theme_second_feature_icon; } ?>"></i>
                        </div><?php endif; ?>
                        <div class="media-body">
                            <?php if (!empty($theme_second_title)) { ?><h3><?php echo $theme_second_title; ?></h3>
                            <?php } ?>
                            <?php if (!empty($theme_second_description)) { ?><p><?php echo $theme_second_description; ?>
                            </p><?php } ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($theme_third_feature_icon) || !empty($theme_third_title) || !empty($theme_third_description)): ?>
                    <div class="media features-area">
                        <?php if (!empty($theme_third_feature_icon)): ?><div class="feature-icon"><i
                                class="fa <?php if (!empty($theme_third_feature_icon)) { echo $theme_third_feature_icon; } ?>"></i>
                        </div><?php endif; ?>
                        <div class="media-body">
                            <?php if (!empty($theme_third_title)) { ?><h3><?php echo $theme_third_title; ?></h3>
                            <?php } ?>
                            <?php if (!empty($theme_third_description)) { ?><p><?php echo $theme_third_description; ?>
                            </p><?php } ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
} ?>