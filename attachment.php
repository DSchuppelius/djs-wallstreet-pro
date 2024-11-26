<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : attachment.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;
global $no_thumb;

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
$theme_blog_section = "blog-detail-section";
$no_thumb = true;

get_template_parts(["template-parts/index/index", "banner"], true);

if(!isset($default_arg)) $default_arg="";
?>
<div class="container single attachment">
    <div class="row attachment-section img <?php row_frame_border(""); ?>">
        <!--Blog Area-->
        <?php the_post(); ?>
        <div class="blog-section-attachment col-md-12<?php innerrow_frame_border(" ");?>">
            <?php echo wp_get_attachment_link(get_post_thumbnail_id(), 'fullpost-thumb', true, false, false, array("class" => "img-responsive")); ?>
        </div>
    </div>
    <div class="row attachment-section content <?php row_frame_border(""); ?> flexstretch">
        <div
            class="col-md-<?php echo (is_active_sidebar('sidebar_primary')?'8':'12'); ?> flexcolumn<?php values_on_current_option("flexelements", " fill"); ?>">
            <?php get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);?>
            <h2><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h2>
            <?php if(has_excerpt()) {
                the_excerpt();
            } else if (!empty(get_the_content())) {
                the_content();
            } else {
                echo "<p>". esc_html__("No description available.", "djs-wallstreet-pro")."</p>";
            }
            $data = get_post_meta( $post->ID, '_wp_attachment_metadata', true );
            if(!empty($data)){
                echo '<h4 style="margin-top:30px;">'. esc_html__("Properties of the media", "djs-wallstreet-pro").'</h4>';
                if(!empty($data['width'])) { esc_html_e("Resolution (width/height):", "djs-wallstreet-pro")." ".$data['width']."/".$data['height']." Pixel<br />";}
                if(!empty($data['image_meta']['camera'])) { esc_html_e("Camera model:", "djs-wallstreet-pro")." ".$data['image_meta']['camera']."<br />";}
                if(!empty($data['image_meta']['iso'])) { esc_html_e("ISO:", "djs-wallstreet-pro")." ".$data['image_meta']['iso']."<br />";}
                if(!empty($data['image_meta']['shutter_speed'])) { esc_html_e("Exposure time:", "djs-wallstreet-pro")." ".$data['image_meta']['shutter_speed']."<br />";}
            }
            get_named_template_parts("template-parts/content/content", ["meta-footer", "footer"]);

            $attached_parentpost = get_post($post->post_parent);
            if($post->post_author != $attached_parentpost->post_author || $post->post_parent == 0) {
                get_template_part("template-parts/content/content", "author");
            }

            comments_template('', true);

            if($post->post_parent != 0) {
                $post = get_post($post->post_parent);
                setup_postdata($post);
                $no_thumb = false;
                get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);?>
            <h4 class="linked_post"><?php esc_html_e("Linked post", "djs-wallstreet-pro")?></h4>
            <h2><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h2>
            <?php echo the_content(esc_html__('Read More', "djs-wallstreet-pro"));
                get_named_template_parts("template-parts/content/content", ["meta-footer", "footer", "author"]);
            }
            get_template_part("template-parts/content/filler"); ?>
        </div>
        <?php get_sidebar(); ?>
        <!--/Blog Area-->
    </div>
</div>
<?php get_footer(); ?>
