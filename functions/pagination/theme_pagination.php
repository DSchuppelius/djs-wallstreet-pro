<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_pagination.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 *
 * Seitennavigation fuer Beitragslisten (Customizer: maximale Anzahl Seitenknoepfe).
 */

class Theme_Pagination {
    private $current_setup;

    function __construct() {
        $this->current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    }

    /**
     * Link zu Seite $nr. Ohne $seiten_parameter wie gewohnt per get_pagenum_link()
     * (/pfad/page/2/). Auf statischen Seiten mit Seitentemplate raeumt WordPress
     * "paged"/"page" per redirect_canonical() weg - dafuer laesst sich ein eigener
     * Query-Parameter uebergeben (z. B. "portfolio_seite"); vorhandene Parameter bleiben.
     */
    private function seiten_link($nr, $seiten_parameter) {
        if ($seiten_parameter === null) {
            return get_pagenum_link($nr);
        }
        $basis = remove_query_arg([$seiten_parameter, "paged", "page"]);
        return $nr <= 1 ? $basis : add_query_arg($seiten_parameter, $nr, $basis);
    }

    function page($curpage, $post_type_data, $seiten_parameter = null) {
        $max = (int) $post_type_data->max_num_pages;
        if ($max <= 1) {
            return;
        }

        $curpage = max(1, min((int) $curpage, $max));
        $buttons = max(3, (int) $this->current_setup->get("max_page_buttons"));
        $first   = (int) max(1, $curpage - floor($buttons / 2));
        $last    = (int) min($max, $first + $buttons - 1);
        $first   = (int) max(1, $last - $buttons + 1); ?>

        <nav class="pagination blog-pagination" aria-label="<?php esc_attr_e("Pages", "djs-wallstreet-pro"); ?>">
            <div class="join">
                <?php if ($curpage > 1) { ?>
                    <a class="join-item btn btn-sm page-btn" rel="prev" href="<?php echo esc_url($this->seiten_link($curpage - 1, $seiten_parameter)); ?>">
                        <span class="material-icons" aria-hidden="true">chevron_left</span>
                        <span class="screen-reader-text"><?php esc_html_e("Previous page", "djs-wallstreet-pro"); ?></span>
                    </a>
                <?php } ?>

                <?php if ($first > 1) { ?>
                    <a class="join-item btn btn-sm page-btn" href="<?php echo esc_url($this->seiten_link(1, $seiten_parameter)); ?>">1</a>
                    <?php if ($first > 2) { ?><span class="join-item btn btn-sm btn-disabled" aria-hidden="true">…</span><?php } ?>
                <?php } ?>

                <?php for ($i = $first; $i <= $last; $i++) {
                    if ($i === $curpage) { ?>
                        <span class="join-item btn btn-sm btn-primary page-btn active" aria-current="page"><?php echo $i; ?></span>
                    <?php } else { ?>
                        <a class="join-item btn btn-sm page-btn" href="<?php echo esc_url($this->seiten_link($i, $seiten_parameter)); ?>"><?php echo $i; ?></a>
                    <?php }
                } ?>

                <?php if ($last < $max) { ?>
                    <?php if ($last < $max - 1) { ?><span class="join-item btn btn-sm btn-disabled" aria-hidden="true">…</span><?php } ?>
                    <a class="join-item btn btn-sm page-btn" href="<?php echo esc_url($this->seiten_link($max, $seiten_parameter)); ?>"><?php echo $max; ?></a>
                <?php } ?>

                <?php if ($curpage < $max) { ?>
                    <a class="join-item btn btn-sm page-btn" rel="next" href="<?php echo esc_url($this->seiten_link($curpage + 1, $seiten_parameter)); ?>">
                        <span class="material-icons" aria-hidden="true">chevron_right</span>
                        <span class="screen-reader-text"><?php esc_html_e("Next page", "djs-wallstreet-pro"); ?></span>
                    </a>
                <?php } ?>
            </div>
        </nav>
<?php
    }
}

function the_pagination($page, $query, $seiten_parameter = null) {
    $theme_pagination = new Theme_Pagination();
    $theme_pagination->page($page, $query, $seiten_parameter);
}
