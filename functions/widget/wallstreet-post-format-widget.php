<?php
/*
 * Created on   : Tue Sep 20 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : wallstreet-post-format-widget.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

add_action('widgets_init', 'Post_Format_Archives_init_Widget');

function Post_Format_Archives_init_Widget() {
    return register_widget('Post_Format_Archives_Widget');
}

class Post_Format_Archives_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'post_format_archives_widget',
            esc_html__('Post Format Archives', "djs-wallstreet-pro"),
            ['description'=>__('Displays a list of links to post-format archives', "djs-wallstreet-pro")]
        );
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        $title =    empty($instance['title'])   ? ' ' : apply_filters('widget_title',   $instance['title']);
        $aside =    empty($instance['aside'])   ? ' ' : apply_filters('widget_aside',   $instance['aside']);
        $image =    empty($instance['image'])   ? ' ' : apply_filters('widget_image',   $instance['image']);
        $link   =   empty($instance['link'])    ? ' ' : apply_filters('widget_link',    $instance['link']);
        $quote  =   empty($instance['quote'])   ? ' ' : apply_filters('widget_quote',   $instance['quote']);
        $status =   empty($instance['status'])  ? ' ' : apply_filters('widget_status',  $instance['status']);
        $gallery =  empty($instance['gallery']) ? ' ' : apply_filters('widget_gallery', $instance['gallery']);
        $video =    empty($instance['video'])   ? ' ' : apply_filters('widget_video',   $instance['video']);
        $chat =     empty($instance['chat'])    ? ' ' : apply_filters('widget_chat',    $instance['chat']);
        $audio =    empty($instance['audio'])   ? ' ' : apply_filters('widget_audio',   $instance['audio']);

        echo $before_widget;
        if (!empty($title)) { echo $before_title . $title . $after_title; };

        // @ http://codex.wordpress.org/Function_Reference/get_post_format_link
        echo '<ul id="custom-post-format-widget">';
        echo '	<li><a href="' . get_post_format_link('aside') .    '">' . $aside . '</a></li>';
        echo '	<li><a href="' . get_post_format_link('image') .    '">' . $image . '</a></li>';
        echo '	<li><a href="' . get_post_format_link('link') .     '">' . $link . '</a></li>';
        echo '	<li><a href="' . get_post_format_link('quote') .    '">' . $quote . '</a></li>';
        echo '  <li><a href="' . get_post_format_link('status') .   '">' . $status . '</a></li>';
        echo '  <li><a href="' . get_post_format_link('gallery') .  '">' . $gallery . '</a></li>';
        echo '  <li><a href="' . get_post_format_link('video') .    '">' . $video . '</a></li>';
        echo '  <li><a href="' . get_post_format_link('chat') .     '">' . $chat . '</a></li>';
        echo '	<li><a href="' . get_post_format_link('audio') .    '">' . $audio . '</a></li>';
        echo '</ul>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] =    strip_tags($new_instance['title']);
        $instance['aside'] =    strip_tags($new_instance['aside']);
        $instance['image'] =    strip_tags($new_instance['image']);
        $instance['link'] =     strip_tags($new_instance['link']);
        $instance['quote'] =    strip_tags($new_instance['quote']);
        $instance['status'] =   strip_tags($new_instance['status']);
        $instance['gallery'] =  strip_tags($new_instance['gallery']);
        $instance['video'] =    strip_tags($new_instance['video']);
        $instance['chat'] =     strip_tags($new_instance['chat']);
        $instance['audio'] =    strip_tags($new_instance['audio']);
        return $instance;
    }

    function form($instance) {
        $defaults = array(
            'title' =>      esc_html__('Browse the site', "djs-wallstreet-pro"),
            'aside' =>      esc_html__('View Aside posts', "djs-wallstreet-pro"),
            'image' =>      esc_html__('View Image posts', "djs-wallstreet-pro"),
            'link' =>       esc_html__('View Link posts', "djs-wallstreet-pro"),
            'quote' =>      esc_html__('View Quote posts', "djs-wallstreet-pro"),
            'status' =>     esc_html__('View Status posts', "djs-wallstreet-pro"),
            'gallery' =>    esc_html__('View Gallery posts', "djs-wallstreet-pro"),
            'video' =>      esc_html__('View Video posts', "djs-wallstreet-pro"),
            'chat' =>       esc_html__('View Chat posts', "djs-wallstreet-pro"),
            'audio' =>      esc_html__('View Audio posts', "djs-wallstreet-pro"),
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $title =    strip_tags($instance['title']);
        $aside =    strip_tags($instance['aside']);
        $image =    strip_tags($instance['image']);
        $link =     strip_tags($instance['link']);
        $quote =    strip_tags($instance['quote']);
        $status =   strip_tags($instance['status']);
        $gallery =  strip_tags($instance['gallery']);
        $video =    strip_tags($instance['video']);
        $chat =     strip_tags($instance['chat']);
        $audio =    strip_tags($instance['audio']);
?>

<p><label for="<?php echo $this->get_field_id('title'); ?>">Title text</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('aside'); ?>"><?php esc_html_e('Link text for Aside archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('aside'); ?>"
        name="<?php echo $this->get_field_name('aside'); ?>" type="text" value="<?php echo esc_attr($aside); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('image'); ?>"><?php esc_html_e('Link text for Image archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>"
        name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('link'); ?>"><?php esc_html_e('Link text for Link archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
        name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('quote'); ?>"><?php esc_html_e('Link text for Quote archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('quote'); ?>"
        name="<?php echo $this->get_field_name('quote'); ?>" type="text" value="<?php echo esc_attr($quote); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('status'); ?>"><?php esc_html_e('Link text for Status archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('status'); ?>"
        name="<?php echo $this->get_field_name('status'); ?>" type="text" value="<?php echo esc_attr($status); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('gallery'); ?>"><?php esc_html_e('Link text for Gallery archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('gallery'); ?>"
        name="<?php echo $this->get_field_name('gallery'); ?>" type="text" value="<?php echo esc_attr($gallery); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('video'); ?>"><?php esc_html_e('Link text for Video archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('video'); ?>"
        name="<?php echo $this->get_field_name('video'); ?>" type="text" value="<?php echo esc_attr($video); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('chat'); ?>"><?php esc_html_e('Link text for Chat archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('chat'); ?>"
        name="<?php echo $this->get_field_name('chat'); ?>" type="text" value="<?php echo esc_attr($chat); ?>" />
</p>
<p><label
        for="<?php echo $this->get_field_id('audio'); ?>"><?php esc_html_e('Link text for Audio archive', "djs-wallstreet-pro"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('audio'); ?>"
        name="<?php echo $this->get_field_name('audio'); ?>" type="text" value="<?php echo esc_attr($audio); ?>" />
</p>
<?php }
}
?>