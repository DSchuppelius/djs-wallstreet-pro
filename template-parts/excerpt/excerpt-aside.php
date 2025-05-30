<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : excerpt-aside.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<header>
    <h1><a href="<?php esc_url(the_permalink()); ?>"><?php the_content_title(); ?></a></h1>
</header>
<section class="excerpt-section aside">
    <div class="excerpt"><?php echo the_content(); ?></div>
</section>
