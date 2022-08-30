<?php
/* Template Name: Blog Right Sidebar
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : attachment.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
global $theme_blog_section;
global $no_thumb;

$current_options = get_current_options();
$theme_blog_section = "blog-detail-section";
$no_thumb = true;

get_template_parts(["template-parts/index/index", "banner"], true);

if(!isset($default_arg)) $default_arg="";
?>
<div class="container single attachment">
    <div class="row attachment-section img <?php row_Frame_Border(""); ?>">
        <!--Blog Area-->
        <?php the_post(); ?>
        <div class="blog-section-attachment col-md-12<?php innerrow_Frame_Border(" ");?>">
            <?php echo wp_get_attachment_link(get_post_thumbnail_id(), 'fullpost-thumb', true, false, false, array( "class" => "img-responsive" )); ?>
        </div>
    </div>
    <div class="row attachment-section content <?php row_Frame_Border(""); ?> flexstretch">
        <div class="col-md-<?php echo (is_active_sidebar( 'sidebar_primary' )?'8':'12'); ?> flexcolumn">
            <?php get_named_template_parts("template-parts/content/content", ["head", "meta-header"]);?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if(has_excerpt()) {
                the_excerpt();
            } else if (!empty(get_the_content())) {
                the_content();
            } else {
                echo "<p>".__("No description available.", "wallstreet")."</p>";
            }
            $data = get_post_meta( $post->ID, '_wp_attachment_metadata', true );
            if(!empty($data)){
                echo '<h4 style="margin-top:30px;">'.__("Properties of the media", "wallstreet").'</h4>';
                if(!empty($data['width'])) { echo __("Resolution (width/height):", "wallstreet")." ".$data['width']."/".$data['height']." Pixel<br />";}
                if(!empty($data['image_meta']['camera'])) { echo __("Camera model:", "wallstreet")." ".$data['image_meta']['camera']."<br />";}
                if(!empty($data['image_meta']['iso'])) { echo __("ISO:", "wallstreet")." ".$data['image_meta']['iso']."<br />";}
                if(!empty($data['image_meta']['shutter_speed'])) { echo __("Exposure time:", "wallstreet")." ".$data['image_meta']['shutter_speed']."<br />";}
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
                <h4 class="linked_post"><?php _e("Linked post", "wallstreet")?></h4>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo the_content(__('Read More', 'wallstreet'));
                get_named_template_parts("template-parts/content/content", ["meta-footer", "footer", "author"]);
            }
            get_template_part("template-parts/content/filler"); ?>            
        </div>
        <?php get_sidebar(); ?>
        <!--/Blog Area-->
    </div>
</div>
<?php get_footer(); ?>



