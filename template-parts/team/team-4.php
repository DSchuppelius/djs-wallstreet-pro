<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : team-4.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup_posttypes = PostTypes_Plugin_Setup::instance(); ?>
<div class="team-section1 team4">
    <div class="container">
        <?php if (!empty($current_setup_posttypes->get("home_team_title")) || !empty($current_setup_posttypes->get("home_team_description"))): ?>		
            <div class="row">
                <div class="section_heading_title">
                    <?php if ($current_setup_posttypes->get("home_team_title")) { ?>
                        <h1><?php echo $current_setup_posttypes->get("home_team_title"); ?></h1>
                        <div class="pagetitle-separator">
                            <div class="pagetitle-separator-border">
                                <div class="pagetitle-separator-box"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($current_setup_posttypes->get("home_team_description")) { ?>
                        <p><?php echo $current_setup_posttypes->get("home_team_description"); ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php $count_posts = wp_count_posts(TEAM_POST_TYPE)->publish;
            $arg = ["post_type" => TEAM_POST_TYPE, "posts_per_page" => $count_posts];
            $team = new WP_Query($arg);
            $i = 1;
            if ($team->have_posts()) {
                while ($team->have_posts()):
                    $team->the_post();
                    $designation_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "designation_meta_save", true));
                    $description_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "description_meta_save", true));
                    $fb_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "fb_meta_save", true));
                    $fb_meta_save_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "fb_meta_save_chkbx", true));
                    $skype_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "skype_meta_save", true));
                    $skype_meta_save_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "skype_meta_save_chkbx", true));
                    
                    $rss_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "rss_meta_save", true));
                    $rss_meta_save_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "rss_meta_save_chkbx", true));
                    $lnkd_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "lnkd_meta_save", true));
                    $lnkd_meta_save_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "lnkd_meta_save_chkbx", true));
                    $twt_meta_save = sanitize_text_field(get_post_meta(get_the_ID(), "twt_meta_save", true));
                    $twt_meta_save_chkbx = sanitize_text_field(get_post_meta(get_the_ID(), "twt_meta_save_chkbx", true)); ?>
                    <div class="col-md-<?php echo $current_setup_posttypes->get("team_design_layout_style"); ?> col-sm-6 col-xs-12">
                        <div class="team-block">
                            <div class="team-img">
                                <?php $defalt_arg = ["class" => "img-responsive"];
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail("port-thumb", $defalt_arg);
                                } ?>
                            </div>
                            <div class="team-details">
                                <h3 class="name"><?php the_title(); ?></h3>
                                <span class="position"><?php if (!empty($designation_meta_save)) { echo $designation_meta_save; } ?></span>
                                <div class="desi-seperate"></div>
                                <p><?php if (!empty($description_meta_save)) { echo $description_meta_save; } ?></p>
                                <ul class="custom-social-icons">
                                    <?php if ($fb_meta_save) { ?>
                                        <li><a href="<?php if ($fb_meta_save) { echo esc_html($fb_meta_save); } ?>" <?php blank_target($fb_meta_save_chkbx); ?>><i class="fa-brands fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if ($skype_meta_save) { ?>
                                        <li><a href="<?php if ($skype_meta_save) { echo esc_html($skype_meta_save); } ?>" <?php blank_target($skype_meta_save_chkbx); ?>><i class="fa-brands fa-skype"></i></a></li>
                                    <?php } ?>
                                    <?php if ($rss_meta_save) { ?>
                                        <li><a href="<?php if ($rss_meta_save) { echo esc_html($rss_meta_save); } ?>" <?php blank_target($rss_meta_save_chkbx); ?>><i class="fa fa-rss"></i></a></li>
                                    <?php } ?>
                                    <?php if ($lnkd_meta_save) { ?>
                                        <li><a href="<?php if ($lnkd_meta_save) { echo esc_html($lnkd_meta_save); } ?>" <?php blank_target($lnkd_meta_save_chkbx); ?>><i class="fa-brands fa-linkedin"></i></a></li>			   
                                    <?php } ?>
                                    <?php if ($twt_meta_save) { ?>
                                        <li><a href="<?php if ($twt_meta_save) { echo esc_html($twt_meta_save); } ?>" <?php blank_target($twt_meta_save_chkbx); ?>><i class="fa-brands fa-twitter"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                endwhile;
            } else {
                $team_title = ["Danial Creg", "Alexia Doe", "John Doe", "Beatrix Doe"];
                $team_designation = [esc_html__("FOUNDER", "djs-wallstreet-pro"), esc_html__("DEVELOPER", "djs-wallstreet-pro"), esc_html__("DESIGNER", "djs-wallstreet-pro"), esc_html__("DEVELOPER", "djs-wallstreet-pro")];
                for ($i = 1; $i <= 4; $i++) { ?>
                    <div class="col-md-<?php echo $current_setup_posttypes->get("team_design_layout_style"); ?> col-sm-6 col-xs-12">
                        <div class="team-block">
                            <div class="team-img">
                                <img class="img-responsive" src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/team/hometeam<?php echo $i; ?>.jpg">						
                            </div>
                            <div class="team-details">
                                <h3 class="name"><?php echo $team_title[$i - 1]; ?></h3>
                                <span class="position"><?php echo $team_designation[$i - 1]; ?></span>
                                <div class="desi-seperate"></div>
                                <p><?php echo "Lorem ipsum dolor sit amet, conet adipis cing. Lorem ipsum dolore sit amet, consectetur adipisicings elit"; ?></p>
                                <ul class="custom-social-icons">
                                    <li><a href="<?php echo FACEBOOK_URL; ?>" class="btn btn-just-icon btn-simple customize-unpreviewable"><i class="fa-brands fa-facebook "></i></a></li>
                                    <li><a href="<?php echo TWITTER_URL; ?>" class="btn btn-just-icon btn-simple customize-unpreviewable"><i class="fa-brands fa-twitter "></i></a></li>
                                    <li><a href="<?php echo LINKEDIN_URL; ?>" class="btn btn-just-icon btn-simple customize-unpreviewable"><i class="fa-brands fa-linkedin "></i></a></li>
                                    <li><a href="<?php echo BEHANCE_URL; ?>" class="btn btn-just-icon btn-simple customize-unpreviewable"><i class="fa-brands fa-behance "></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }
            }?>
        </div>
    </div>	
</div>
