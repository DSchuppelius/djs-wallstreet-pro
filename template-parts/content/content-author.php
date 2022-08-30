<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-author.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
?>
<div class="blog-author<?php innerrow_Frame_Border(" "); ?>">
    <div class="media">
        <div class="pull-left">
            <?php echo get_avatar(get_the_author_meta("ID"), 94); ?>
        </div>
        <div class="media-body">
            <h6><?php the_author(); ?></h6>
            <p><?php the_author_meta("description"); ?></p>
            <ul class="blog-author-social">
                <?php
                $facebook_profile = get_the_author_meta("facebook_profile");
                if ($facebook_profile && $facebook_profile != "") {
                    echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="fa-brands fa-facebook"></i></a></li>';
                }

                $linkedin_profile = get_the_author_meta("linkedin_profile");
                if ($linkedin_profile && $linkedin_profile != "") {
                    echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="fa-brands fa-linkedin"></i></a></li>';
                }

                $twitter_profile = get_the_author_meta("twitter_profile");
                if ($twitter_profile && $twitter_profile != "") {
                    echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="fa-brands fa-twitter"></i></a></li>';
                }

                $google_profile = get_the_author_meta("google_profile");
                if ($google_profile && $google_profile != "") {
                    echo '<li class="googleplus"><a href="' . esc_url($google_profile) . '" rel="author"><i class="fa-brands fa-google-plus"></i></a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
