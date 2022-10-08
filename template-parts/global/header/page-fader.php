<?php
/*
 * Created on   : Wed Sep 28 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : page_fader.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
 ?>
 <div id="page_fader">
    <div class="page_fader logo <?php row_frame_border(""); ?>">
        <?php get_template_part("template-parts/global/header/navbar", "logo"); ?>
        <h2 class="animate"><?php esc_html_e("Loading content...", "djs-wallstreet-pro"); ?></h2>
    </div>
</div>
<script>
    const style = document.createElement('style');
    style.innerHTML = '#page_fader { display:flex; }';
    document.head.appendChild(style);
</script>
<noscript>
    <div class="warning java"><span title="<?php esc_attr_e("JavaScript disabled...", "djs-wallstreet-pro"); ?>" class="material-symbols-outlined">report</span></div>
</noscript>
