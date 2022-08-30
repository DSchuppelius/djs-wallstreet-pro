<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : servic-1.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options(); ?>
<div class="service-section">
	<div class="container">
		<?php if (!empty($current_options["service_title"]) || !empty($current_options["service_description"])): ?>
			<div class="row">
				<div class="section_heading_title">
					<?php if ($current_options["service_title"]) { ?>
						<h1><?php echo $current_options["service_title"]; ?></h1>
						<div class="pagetitle-separator">
							<div class="pagetitle-separator-border">
								<div class="pagetitle-separator-box"></div>
							</div>
						</div>
					<?php } ?>
					<?php if ($current_options["service_description"]) { ?>
						<p><?php echo $current_options["service_description"]; ?></p>
					<?php } ?>
				</div>
			</div>	
		<?php endif; ?>
		<div class="row service">
			<?php
            $j = 1;
            $col_count = 3;
            $total_services = $current_options["service_list"];
            $args = [
                "post_type" => SERVICE_POST_TYPE,
                "posts_per_page" => $total_services,
            ];
            $service = new WP_Query($args);
            if ($service->have_posts()) {
                while ($service->have_posts()):

                    $service->the_post();
                    $service_icon_image = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_image", true));
                    $service_icon_target = sanitize_text_field(get_post_meta(get_the_ID(), "service_icon_target", true));
                    $service_row_pos = get_first_middle_last_row($j, $service->post_count, $col_count, " ");
                    $service_item_pos = get_first_middle_last($j, $service->post_count, " "); ?>

					<div class="col-md-4 col-sm-6 <?php echo $current_options["service_hover_change_effect"] == true ? "service-effect" : "stop-service-effect"; echo $service_item_pos . $service_row_pos; ?>">
						<?php if (get_post_meta(get_the_ID(), "meta_service_link", true)) {
                            $meta_service_link = get_post_meta(get_the_ID(), "meta_service_link", true);
                        } else {
                            $meta_service_link = "#";
                        } ?>
						<?php if ($service_icon_target && $service_icon_image) { ?>
							<div class="other-service-area1">
								<?php if ($meta_service_link) { ?>
									<a href="<?php echo $meta_service_link; ?>" <?php if (get_post_meta(get_the_ID(), "meta_service_target", true)) { echo 'target="_blank"';} ?>>
                                        <i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
									</a>
								<?php } else { ?>
									<i class="fa <?php if ($service_icon_image) { echo $service_icon_image; } ?>"></i>
								<?php } ?>
							</div>
						<?php } else {
                            $defalt_arg = ["class" => "img-responsive"];
                            if (has_post_thumbnail()) { ?>
								<div class="service-box">
									<?php if ($meta_service_link) { ?>
										<a href="<?php echo $meta_service_link; ?>" <?php if (get_post_meta(get_the_ID(), "meta_service_target", true)) { echo 'target="_blank"'; } ?>><?php the_post_thumbnail("theme_service_img", $defalt_arg); ?></a>
									<?php } else { ?>
										<?php the_post_thumbnail("theme_service_img", $defalt_arg); ?>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="other-service-area1">
									<i class="fa" style="font-size:24px;"><?php _e("Icon", "wallstreet"); ?></i>
								</div> 
							<?php }} ?>
						<div class="service-area<?php big_Border(" "); ?>">
							<h2><a href="<?php echo $meta_service_link; ?>" <?php if (get_post_meta(get_the_ID(), "meta_service_target", true)) { echo "target='_blank'"; } ?> > <?php echo the_title(); ?> </a></h2>
							<p><?php echo $excerpt = get_post_meta(get_the_ID(), "service_description_text", true); ?></p>
							<?php if (get_post_meta(get_the_ID(), "service_readmore_text", true)) { ?>
								<div class="service-btn">
									<form action="<?php echo $meta_service_link; ?>" <?php if (get_post_meta(get_the_ID(), "meta_service_target", true)) { echo 'method="get" target="_blank"'; } ?>>
										<button class="btn more services" ><?php echo get_post_meta(get_the_ID(), "service_readmore_text", true); ?></button>
									</form>
								</div>
							<?php } ?>
						</div><!-- / service-area -->
					</div> <!-- / service-effect column --> 
					<?php
                    if ($j % $total_services == 0) {
                        echo "<div class='clearfix'></div>";
                    }
                    $j++;
                endwhile;
            } else {
                $service_defualttext = [__("Product designing", "wallstreet"), __("WordPress themes", "wallstreet"), __("Responsive designs", "wallstreet")];
                for ($i = 1; $i <= 3; $i++) { ?>		
					<div class="col-md-4 col-sm-6 <?php if ($current_options["service_hover_change_effect"] == true) { echo "service-effect"; } else { echo "stop-service-effect"; } ?>">
						<div class="service-box">
							<img class="img-responsive" src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/service<?php echo $i; ?>.jpg">
						</div>
						<div class="service-area">
							<h2><a href="#"><?php echo $service_defualttext[$i - 1]; ?></a></h2>
							<p><?php echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl."; ?></p>
							<div class="service-btn"><a href="#"><?php _e("Read More", "wallstreet"); ?></a></div>
						</div>
					</div>
				<?php }
            } ?>
		</div>	
	</div>
</div>
