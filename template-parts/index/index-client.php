<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : index-client.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<!-- wallstreet Clients Section ---->
<?php $current_options = get_current_options(); ?>
<clients>
	<div class="container client-section">	
		<div class="row">	
			<?php if (!empty($current_options["home_client_title"]) || !empty($current_options["home_client_description"])): ?>		
				<div class="section_heading_title">
					<?php if ($current_options["home_client_title"]) { ?>
						<h1><?php echo $current_options["home_client_title"]; ?></h1>
						<div class="pagetitle-separator">
							<div class="pagetitle-separator-border">
								<div class="pagetitle-separator-box"></div>
							</div>
						</div>
					<?php } ?>
					<?php if ($current_options["home_client_description"]) { ?>
						<p><?php echo $current_options["home_client_description"]; ?></p>
					<?php } ?>
				</div>	
			<?php endif; ?>	
			<div class="row flexstretch">
                <?php $j = 1;
                $args = ["post_type" => CLIENT_POST_TYPE, "posts_per_page" => -1];
                $client = new WP_Query($args);
                if ($client->have_posts()) {
                    while ($client->have_posts()) {
                        $client->the_post();
                        get_template_part("template-parts/client/client", "header");
    
                        $post_client_url = get_post_meta(get_the_ID(), "clientstrip_link", true) ? get_post_meta(get_the_ID(), "clientstrip_link", true) : "#";
                        $post_client_url_target = blank_target(get_post_meta(get_the_ID(), "meta_client_target", true));
    
                        if (has_post_thumbnail()) {
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
    
                            if ($post_thumbnail_url) { ?>
                                <a href="<?php echo $post_client_url; ?>" <?php echo $post_client_url_target; ?>>
                                    <img class="img-responsive" title="<?php echo get_the_title(); ?>" src="<?php echo $post_thumbnail_url; ?>">
                                </a>
    					    <?php } else { ?>
                                <img class="img-responsive" title="<?php echo get_the_title(); ?>" src="<?php echo $post_thumbnail_url; ?>">
                            <?php }
                        } else { ?>
                            <a href="<?php echo $post_client_url; ?>" <?php echo $post_client_url_target; ?>>
                                <h2 class="clients-text"><?php echo get_the_title(); ?></h2>
                            </a>
                        <?php }
    
                        get_template_part("template-parts/client/client", "footer");
                        if ($j % 4 == 0) {
                            // echo "<div class='clearfix'></div>";
                            echo '</div><div class="next row flexstretch">';
                        }
                        $j++;
                    }
                } else {
                    get_template_part("template-parts/client/client", "demo");
                } ?>			
			</div>		
		</div> 		
	</div>
</clients>
<!-- /wallstreet wallstreet Cliens Section Section ---->
