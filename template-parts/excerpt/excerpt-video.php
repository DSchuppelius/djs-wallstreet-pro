<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-video.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<header>
    <h2><a href="<?php the_permalink(); ?>"><?php the_content_title(); ?></a></h2>
</header>
<section>
    <p>
        <?php
        $content = get_the_content();

        if (has_block("core/video", $content)) {
            twenty_twenty_one_print_first_instance_of_block("core/video", $content);
        } elseif (has_block("core/embed", $content)) {
            twenty_twenty_one_print_first_instance_of_block("core/embed", $content);
        } elseif (has_block("core-embed/*", $content)){
            twenty_twenty_one_print_first_instance_of_block("core-embed/*", $content);
        } else {
            the_content();
        }
        ?>
    </p>
</section>