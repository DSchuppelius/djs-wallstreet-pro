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
    <h2><a href="<?php the_permalink(); ?>"><?php the_content_title(); ?></a></h2>
</header>
<section>
    <div class="excerpt"><?php echo the_content(); ?></div>
</section>

