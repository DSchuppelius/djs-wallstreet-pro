<?php
/*
 * Created on   : Wed Sep 1 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-partner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<!-- wallstreet Partners Section ---->
<?php $current_options = get_current_options(); ?>
<partners>
    <div class="container partner-section">	
        <div class="row">	
            <?php if (!empty($current_options["home_partner_title"]) || !empty($current_options["home_partner_description"])): ?>		
                <div class="section_heading_title">
                    <?php if ($current_options["home_partner_title"]) { ?>
                        <h1><?php echo $current_options["home_partner_title"]; ?></h1>
                        <div class="pagetitle-separator">
                            <div class="pagetitle-separator-border">
                                <div class="pagetitle-separator-box"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($current_options["home_partner_description"]) { ?>
                        <p><?php echo $current_options["home_partner_description"]; ?></p>
                    <?php } ?>
                </div>	
            <?php endif; ?>	
            <div class="row flexstretch">
                <?php $j = 1;
                $args = ["post_type" => PARTNER_POST_TYPE, "posts_per_page" => -1];
                $partner = new WP_Query($args);
                if ($partner->have_posts()) {
                    while ($partner->have_posts()) {
                        $partner->the_post();
                        get_template_part("template-parts/partner/partner", "header");
    
                        $post_partner_url = esc_url(get_post_meta(get_the_ID(), "partnerstrip_link", true) ? get_post_meta(get_the_ID(), "partnerstrip_link", true) : get_the_currentURL() . "#");
                        $post_partner_url_target = get_blank_target(get_post_meta(get_the_ID(), "meta_partner_target", true));
    
                        if (has_post_thumbnail()) {
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
    
                            if ($post_thumbnail_url) { ?>
                                <a href="<?php echo $post_partner_url; ?>" <?php echo $post_partner_url_target; ?>>
                                    <img class="img-responsive" title="<?php echo get_the_title(); ?>" src="<?php echo $post_thumbnail_url; ?>">
                                </a>
                            <?php } else { ?>
                                <img class="img-responsive" title="<?php echo get_the_title(); ?>" src="<?php echo $post_thumbnail_url; ?>">
                            <?php }
                        } else { ?>
                            <a href="<?php echo $post_partner_url; ?>" <?php echo $post_partner_url_target; ?>>
                                <h2 class="partners-text"><?php echo get_the_title(); ?></h2>
                            </a>
                        <?php }
    
                        get_template_part("template-parts/partner/partner", "footer");
                        if ($j % 4 == 0) {
                            echo '</div><div class="next row flexstretch">';
                        }
                        $j++;
                    }
                } else {
                    get_template_part("template-parts/partner/partner", "demo");
                } ?>			
            </div>		
        </div> 		
    </div>
</partners>
<!-- /wallstreet wallstreet Cliens Section Section ---->
