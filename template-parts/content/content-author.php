<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : content-author.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Autorbox unter Beitraegen.
 */

$author_id   = get_the_author_meta("ID");
$description = get_the_author_meta("description");
$profiles    = [
    "facebook_profile" => ["fa-brands fa-facebook", "Facebook"],
    "linkedin_profile" => ["fa-brands fa-linkedin", "LinkedIn"],
    "twitter_profile"  => ["fa-brands fa-x-twitter", "X / Twitter"],
    "google_profile"   => ["fa-brands fa-google", "Google"],
]; ?>

<aside class="author-box surface-card blog-author" aria-label="<?php esc_attr_e("About the author", "djs-wallstreet-pro"); ?>">
    <div class="author-box__avatar">
        <?php echo get_avatar($author_id, 96, "", "", ["class" => "author-box__img"]); ?>
    </div>
    <div class="author-box__body">
        <p class="author-box__eyebrow"><?php esc_html_e("Written by", "djs-wallstreet-pro"); ?></p>
        <h2 class="author-box__name">
            <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" rel="author"><?php the_author(); ?></a>
        </h2>
        <?php if ($description) { ?>
            <p class="author-box__bio"><?php echo wp_kses_post($description); ?></p>
        <?php } ?>
        <ul class="social-links">
            <?php foreach ($profiles as $meta => [$icon, $label]) {
                $url = get_the_author_meta($meta);
                if (!$url) {
                    continue;
                } ?>
                <li>
                    <a class="social-links__link" href="<?php echo esc_url($url); ?>" rel="me noopener" target="_blank" aria-label="<?php echo esc_attr($label); ?>">
                        <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
