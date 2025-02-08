<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<header>
    <h1><a href="<?php esc_url(the_permalink()); ?>"><?php the_content_title(); ?></a></h1>
</header>
<section class="excerpt-section">
    <div class="excerpt">
        <?php $content = get_the_content();
        if(strpos($content, form_more_button()) !== false) {
            echo $content;
        } else {
            $excerpt = get_the_excerpt();
            $excerpt_length = strlen($excerpt);
            $content_length = strlen($content);
            if(strlen($excerpt) > 0){
                the_excerpt();
                if($excerpt_length<$content_length)
                    the_read_more();
            } else {
                the_content();
            }
        } ?>
    </div>
</section>
