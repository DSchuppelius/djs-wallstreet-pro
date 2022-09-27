<?php
/* Template Name: About Us
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : about-us.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $ul_class;

$current_options = get_current_options();

get_template_parts(["template-parts/index/index", "banner"], true);

the_post();
?>
<div class="container page about-us">
    <?php if (has_post_thumbnail()) { ?>
        <div class="row <?php row_frame_border(""); ?> about-section img">
            <?php $defalt_arg = ["class" => "img-responsive"]; ?>
            <div class="col-md-12<?php innerrow_frame_border(" ");?>">
                <?php the_post_thumbnail('about-thumb', $defalt_arg); ?>
            </div>
        </div>
    <?php } ?>
    <div class="row <?php row_frame_border(""); ?> about-section text flexstretch">
        <div class="col-md-8 flexcolumn">
            <?php get_template_part("template-parts/content/content", "about"); ?>	
            <?php if ($current_options["about_social_media_enabled"] == true) { ?>
                <div class="social<?php innerrow_frame_border(" "); ?>">
                <?php $ul_class = "about";
                get_template_part("template-parts/global/social-media");?>
                </div>
            <?php }
            get_template_part("template-parts/content/filler"); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<!--/About Section-->

<!-- Team Section -->
<div class="container page about-us team">
    <?php if ($current_options["about_team_section_show_hide"] == true): ?>
        <?php if (!empty($current_options["about_team_title"]) || !empty($current_options["about_team_description"])): ?>
            <div class="row <?php row_frame_border(""); ?> about-section text team-title">
                <div class="section_heading_title<?php innerrow_frame_border(" "); ?>">
                    <?php if ($current_options["about_team_title"] != "") { ?><h1><?php echo $current_options["about_team_title"]; ?></h1>
                        <div class="pagetitle-separator">
                            <div class="pagetitle-separator-border">
                                <div class="pagetitle-separator-box"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($current_options["about_team_description"] != "") { ?><p><?php echo $current_options["about_team_description"]; ?></p><?php } ?>
                </div>
            </div>
        <?php endif; ?>
    
        <div class="row <?php row_frame_border(""); ?> about-section text team-section">
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
                    <div class="col-md-3 col-sm-6 team-effect">
                        <?php
                        $defalt_arg = ["class" => "img-responsive"];
                        if (has_post_thumbnail()) { ?>
                            <div class="team-box">
                                <?php the_post_thumbnail('port-thumb', $defalt_arg); ?>
                            </div>
                        <?php } ?>
                        <div class="team-area<?php big_border(" "); ?>">				
                            <h5><?php the_title(); ?><span><?php if (!empty($designation_meta_save)) { echo $designation_meta_save; } ?></span></h5>
                            <div class="desi-seperate"></div>
                            <p><?php if (!empty($description_meta_save)) { echo $description_meta_save; } ?></p>
                            <ul class="team-social-icons">
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
                    <?php if ($i % 4 == 0) {
                        echo "<div class='clearfix'></div>";
                    }
                    $i++;
                endwhile;
            } else {
                $team_title = ["Danial Creg", "Alexia Doe", "John Doe", "Beatrix Doe"];
                $team_designation = [__("FOUNDER", "wallstreet"), __("DEVELOPER", "wallstreet"), __("DESIGNER", "wallstreet"), __("DEVELOPER", "wallstreet")];
                for ($i = 1; $i <= 4; $i++) { ?>
                    <div class="col-md-3 col-sm-6 team-effect">
                        <div class="team-box">
                            <img class="img-responsive" src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/team/team<?php echo $i; ?>.jpg">
                        </div>
                        <div class="team-area<?php innerrow_frame_border(" ");?>">				
                            <h5><?php echo $team_title[$i - 1]; ?> <span><?php echo $team_designation[$i - 1]; ?></span></h5>
                            <div class="desi-seperate"></div>
                            <p><?php echo "Lorem ipsum dolor sit amet, conet adipis cing. Lorem ipsum dolore sit amet, consectetur adipisicings elit"; ?></p>
                            <ul class="team-social-icons">
                                <li><a><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a><i class="fa-brands fa-skype"></i></a></li>
                                <li><a><i class="fa-brands fa-google-plus"></i></a></li>
                                <li><a><i class="fa fa-rss"></i></a></li>
                                <li><a><i class="fa-brands fa-linkedin"></i></a></li>			   
                                <li><a><i class="fa-brands fa-twitter"></i></a></li>
                            </ul>
                        </div>	
                    </div>
                <?php }
            } ?>
        </div>	
    <?php endif; ?>

    <?php if ($current_options["about_callout_section_show_hide"] == true):
        get_template_part("template-parts/index/index", "calloutarea");
    endif; ?>
</div>
<?php get_footer(); ?>
