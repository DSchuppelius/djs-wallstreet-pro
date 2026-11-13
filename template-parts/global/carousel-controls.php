<?php
/*
 * Created on   : Thu Nov 13 2026
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : carousel-controls.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Bedienelemente fuer [data-carousel] (siehe assets/js/carousel.js).
 */

?>
<div class="carousel__controls">
    <button type="button" class="carousel__btn carousel__prev btn btn-circle btn-sm" data-carousel-prev>
        <span class="material-icons" aria-hidden="true">chevron_left</span>
        <span class="screen-reader-text"><?php esc_html_e("Previous", "djs-wallstreet-pro"); ?></span>
    </button>
    <div class="carousel__dots" data-carousel-dots></div>
    <button type="button" class="carousel__btn carousel__pause btn btn-circle btn-sm" data-carousel-pause aria-pressed="false">
        <span class="material-icons" aria-hidden="true">pause</span>
        <span class="screen-reader-text"><?php esc_html_e("Pause automatic rotation", "djs-wallstreet-pro"); ?></span>
    </button>
    <button type="button" class="carousel__btn carousel__next btn btn-circle btn-sm" data-carousel-next>
        <span class="material-icons" aria-hidden="true">chevron_right</span>
        <span class="screen-reader-text"><?php esc_html_e("Next", "djs-wallstreet-pro"); ?></span>
    </button>
</div>
