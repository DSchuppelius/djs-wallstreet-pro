<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-audio.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<header>
    <h1><a href="<?php esc_url(the_permalink()); ?>"><?php the_content_title(); ?></a></h1>
</header>
<section class="excerpt-section audio">
    <div class="excerpt">
        <?php $content = get_the_content();
        if (has_block("core/audio", $content)) {
            twenty_twenty_one_print_first_instance_of_block("core/audio", $content);
        } elseif (has_block("core/embed", $content)) {
            twenty_twenty_one_print_first_instance_of_block("core/embed", $content);
        } else {
            twenty_twenty_one_print_first_instance_of_block("core-embed/*", $content);
        } ?>
    </div>
</section>
