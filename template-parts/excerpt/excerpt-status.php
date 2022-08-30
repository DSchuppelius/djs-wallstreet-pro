<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-status.php
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
        $content_length = strlen($content);
        ?>
        <div class="lcd crt"><?php echo $content; ?><small><?php echo $content_length; ?> / 255 <?php if ($content_length > 255) {
     echo "(" . intdiv($content_length, 255) + ((int) 1) . ")";
 } ?></small></div>
    </p>
</section>
