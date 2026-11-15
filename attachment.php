<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : attachment.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Anhangseite: Bild gross, Beschreibung, EXIF-Daten, verknuepfter Beitrag.
 */

get_template_parts(["template-parts/index/index", "banner"], true);

/* Wie bisher: das Bild steht in voller Breite (fullpost-thumb, eigenes Seitenverhaeltnis)
   ueber Text und Sidebar */
$attachment_id = get_queried_object_id(); ?>
<div class="page-shell site-wrap media-hero">
    <figure class="media-hero__media surface-card attachment-figure">
        <?php if (wp_attachment_is_image($attachment_id)) { ?>
            <a href="<?php echo esc_url(wp_get_attachment_url($attachment_id)); ?>">
                <?php echo wp_get_attachment_image($attachment_id, "fullpost-thumb", false, ["class" => "media-hero__img", "loading" => "eager", "fetchpriority" => "high"]); ?>
            </a>
        <?php } else {
            echo wp_get_attachment_link($attachment_id, "fullpost-thumb", false, true);
        } ?>
    </figure>
</div>
<?php
djs_layout_start(["class" => "single attachment"]);

while (have_posts()) {
    the_post();
    $data   = wp_get_attachment_metadata(get_the_ID());
    $parent = $post->post_parent ? get_post($post->post_parent) : null; ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class("entry entry--attachment surface-card"); ?>>
        <div class="entry__body">
            <?php get_template_part("template-parts/content/content", "meta-header"); ?>

            <div class="entry-content">
                <?php if (has_excerpt()) {
                    the_excerpt();
                } elseif (trim(get_the_content()) !== "") {
                    the_content();
                } else {
                    echo "<p>" . esc_html__("No description available.", "djs-wallstreet-pro") . "</p>";
                } ?>
            </div>

            <?php if (!empty($data)) {
                $props = [];
                if (!empty($data["width"])) {
                    $props[__("Resolution (width/height):", "djs-wallstreet-pro")] = $data["width"] . " × " . $data["height"] . " px";
                }
                if (!empty($data["image_meta"]["camera"])) {
                    $props[__("Camera model:", "djs-wallstreet-pro")] = $data["image_meta"]["camera"];
                }
                if (!empty($data["image_meta"]["iso"])) {
                    $props[__("ISO:", "djs-wallstreet-pro")] = $data["image_meta"]["iso"];
                }
                if (!empty($data["image_meta"]["shutter_speed"])) {
                    $props[__("Exposure time:", "djs-wallstreet-pro")] = $data["image_meta"]["shutter_speed"];
                }
                if ($props) { ?>
                    <section class="attachment-props">
                        <h2 class="attachment-props__title"><?php esc_html_e("Properties of the media", "djs-wallstreet-pro"); ?></h2>
                        <dl>
                            <?php foreach ($props as $label => $value) { ?>
                                <div><dt><?php echo esc_html($label); ?></dt><dd><?php echo esc_html($value); ?></dd></div>
                            <?php } ?>
                        </dl>
                    </section>
                <?php }
            } ?>

            <?php get_template_part("template-parts/content/content", "meta-footer"); ?>
        </div>
    </article>

    <?php if (!$parent || $post->post_author != $parent->post_author) {
        get_template_part("template-parts/content/content", "author");
    }

    comments_template("", true);

    if ($parent) {
        $post = $parent;
        setup_postdata($post); ?>
        <section class="linked-post">
            <h2 class="linked-post__title linked_post"><?php esc_html_e("Linked post", "djs-wallstreet-pro"); ?></h2>
            <?php /* Bild wie bisher oben ueber dem Beitrag (blog-thumb, nicht seitlich beschnitten) */
            get_template_part("template-parts/content/content", null, ["mode" => "excerpt"]); ?>
        </section>
        <?php wp_reset_postdata();
    }
}

djs_layout_end();
get_footer();
