<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : wallstreet_latest_widget.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

add_action("widgets_init", "wallstreet_latest_widget");
function wallstreet_latest_widget() {
    return register_widget("wallstreet_latest_widget");
}

/**
 * Adds wallstreet_latest_widget widget.
 */
class wallstreet_latest_widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            "wallstreet_latest_widget",
            esc_html__("WBR : Latest Posts", "djs-wallstreet-pro"),
            ["description" => esc_html__("This widget allows you to display latest, popular and commented posts.", "djs-wallstreet-pro")]
        );
    }

    function widget_posts($posts) {
        global $post;
        $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
        if (!$posts) {
            return;
        } ?>
        <ul class="mini-posts">
            <?php foreach ($posts as $post) {
                setup_postdata($post); ?>
                <li class="mini-post">
                    <?php if (has_post_thumbnail($post->ID)) { ?>
                        <a class="mini-post__media" href="<?php echo esc_url(get_permalink()); ?>" tabindex="-1" aria-hidden="true">
                            <?php echo get_the_post_thumbnail($post->ID, "widget-thumb", ["class" => "mini-post__img", "loading" => "lazy", "alt" => ""]); ?>
                        </a>
                    <?php } ?>
                    <div class="mini-post__body">
                        <a class="mini-post__title" href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
                        <span class="mini-post__meta">
                            <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C, $post->ID)); ?>"><?php echo esc_html(get_the_date($current_setup->get("fulldateformat"), $post->ID)); ?></time>
                            · <?php the_author(); ?>
                        </span>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <?php wp_reset_postdata();
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
        $title         = apply_filters("widget_title", $instance["title"] ?? "");
        $uid           = esc_attr($this->id);
        $tabs          = [
            "popular" => __("Popular", "djs-wallstreet-pro"),
            "recent"  => __("Recent", "djs-wallstreet-pro"),
            "comment" => __("Comment", "djs-wallstreet-pro"),
        ];

        echo $args["before_widget"];
        if (!empty($title)) {
            echo $args["before_title"] . $title . $args["after_title"];
        } ?>

        <div class="tabs tabs-box tabs-sm widget-tabs" role="tablist" data-tabs>
            <?php $first = true;
            foreach ($tabs as $key => $label) { ?>
                <button type="button" role="tab" class="tab<?php echo $first ? " tab-active" : ""; ?>" id="<?php echo $uid . "-tab-" . $key; ?>"
                    aria-controls="<?php echo $uid . "-" . $key; ?>" aria-selected="<?php echo $first ? "true" : "false"; ?>"><?php echo esc_html($label); ?></button>
            <?php $first = false;
            } ?>
        </div>

        <div id="<?php echo $uid; ?>-popular" class="widget-tabs__pane" role="tabpanel" aria-labelledby="<?php echo $uid; ?>-tab-popular">
            <?php $this->widget_posts(get_posts([
                "numberposts" => 5,
                "orderby"     => "comment_count",
                "order"       => "DESC",
                "post_type"   => "post",
                "post_status" => "publish",
            ])); ?>
        </div>
        <div id="<?php echo $uid; ?>-recent" class="widget-tabs__pane" role="tabpanel" aria-labelledby="<?php echo $uid; ?>-tab-recent" hidden>
            <?php $this->widget_posts(get_posts([
                "post_type"      => "post",
                "posts_per_page" => 5,
                "post__not_in"   => get_option("sticky_posts"),
            ])); ?>
        </div>
        <div id="<?php echo $uid; ?>-comment" class="widget-tabs__pane" role="tabpanel" aria-labelledby="<?php echo $uid; ?>-tab-comment" hidden>
            <ul class="mini-posts">
                <?php foreach (get_comments(["number" => 5, "status" => "approve"]) as $comment) {
                    $link = get_comment_link($comment); ?>
                    <li class="mini-post">
                        <span class="mini-post__media"><?php echo get_avatar($comment, 56, "", "", ["class" => "mini-post__img"]); ?></span>
                        <div class="mini-post__body">
                            <a class="mini-post__title" href="<?php echo esc_url($link); ?>"><?php echo esc_html(get_comment_sidebar($comment->comment_content)); ?></a>
                            <span class="mini-post__meta">
                                <time datetime="<?php echo esc_attr(get_comment_date(DATE_W3C, $comment)); ?>"><?php echo esc_html(get_comment_date($current_setup->get("fulldateformat"), $comment)); ?></time>
                                · <?php echo esc_html(get_comment_author($comment)); ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <?php echo $args["after_widget"];
    }

    public function form($instance) {
        if (isset($instance["title"])) {
            $title = $instance["title"];
        } else {
            $title = "Tabs Content";
        } ?>
        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>"><?php esc_html_e("Title", "djs-wallstreet-pro"); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                value="<?php echo esc_attr($title); ?>" />
        </p>
<?php }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance["title"] = !empty($new_instance["title"]) ? strip_tags($new_instance["title"]) : "";
        return $instance;
    }
} // class Foo_Widget
?>
