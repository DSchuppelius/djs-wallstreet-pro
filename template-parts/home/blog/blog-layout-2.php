<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog-layout-2.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_options = get_current_options();
$post_per_page = $current_options["home_blog_counts"];
?>	
<div class="container home-blog-section wow fadeInDown" data-wow-delay="1s">
	<?php if (!empty($current_options["home_blog_heading"]) || !empty($current_options["home_blog_description"])): ?>
	<div class="row">
		<div class="section_heading_title">
		<?php if ($current_options["home_blog_heading"]) { ?>
			<h1><?php echo $current_options["home_blog_heading"]; ?></h1>
		<?php } ?>
		<?php if ($current_options["home_blog_description"]) { ?>
			<div class="pagetitle-separator">
			<div class="pagetitle-separator-border">
				<div class="pagetitle-separator-box"></div>
			</div>
		</div>
			<p><?php echo $current_options["home_blog_description"]; ?></p>
		<?php } ?>
		</div>
	</div>
<?php endif; ?>
	<div class="row masonry-2">
		<?php
        $j = 1;
        $args = [
            "post_type" => "post",
            "posts_per_page" => $post_per_page,
            "post__not_in" => get_option("sticky_posts"),
        ];
        query_posts($args);
        if (query_posts($args)) {
            while (have_posts()) {
                the_post();
                $recent_expet = get_the_excerpt(); ?>
                <div class="masonry-item">
                    <div class="home-blog-area">
                        <div class="home-blog-post-img"><?php $defalt_arg = ["class" => "img-responsive"]; if (has_post_thumbnail()) { the_post_thumbnail("", $defalt_arg); } ?></div>
                        <div class="home-blog-info">
                            <?php if ($current_options["home_meta_section_settings"] == false) { ?>
                                <div class="home-blog-post-detail">
    							    <span class="date"><?php echo get_the_date(); ?> </span>
    							    <span class="comment"><a href="<?php the_permalink(); ?>"><i class="fa fa-comment"></i><?php comments_number(__("No Comments", "wallstreet"), __("1 Comment", "wallstreet"), __("% Comments", "wallstreet")); ?></a></span>
    						    </div>
    						<?php } ?>
    						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>		
    						<div class="home-blog-description"><p><?php echo get_the_excerpt(); ?></p></div>
    						<div class="home-blog-btn"><a href="<?php the_permalink(); ?>"><?php _e("Read More", "wallstreet"); ?></a></div>							
    					</div>
    			    </div>
    		    </div>
    		    <?php
                if ($j % 3 == 0) {
                    echo "<div class='clearfix'></div>";
                }
                $j++;    
            }
        } else {
            echo "<div class='post_message'>" . __("No posts to show", "wallstreet") . "</div>";
        } ?>
    </div>
	<?php if ($current_options["view_all_posts_btn_enabled"] == true) {
        if ($current_options["view_all_posts_text"]) { ?>
            <div class ="row">
				<div class="proejct-btn">
					<a href="<?php if ($current_options["all_posts_link"] != "") { echo $current_options["all_posts_link"]; } ?>" <?php if ($current_options["view_all_lnik_target"] == true) { echo "target='_blank'"; } ?>> <?php echo $current_options["view_all_posts_text"]; ?></a>
				</div>
			</div>
        <?php }
    } ?>
</div>
