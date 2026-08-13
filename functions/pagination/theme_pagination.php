<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : theme_pagination.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class Theme_Pagination {
    private $current_setup;

    function __construct() {
        $this->current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();
    }

    /**
     * Erzeugt die Seitenlinks.
     *
     * $seiten_parameter: normalerweise null - dann entstehen die Links wie bisher per
     * get_pagenum_link(), also im Archivformat /pfad/page/2/. Auf einer statischen Seite
     * mit Seitentemplate gibt es diese Route aber nicht zwingend, und WordPress raeumt
     * die Standardparameter "paged"/"page" per redirect_canonical() weg. Fuer solche
     * Faelle laesst sich ein eigener Query-Parameter uebergeben (z.B. "portfolio_seite"),
     * den WordPress unangetastet laesst. Bereits vorhandene Parameter der aktuellen URL -
     * etwa der aktive Portfolio-Tab - bleiben dabei erhalten.
     */
    private function seiten_link($nr, $seiten_parameter) {
        if ($seiten_parameter === null) {
            return get_pagenum_link($nr);
        }

        $basis = remove_query_arg([$seiten_parameter, "paged", "page"]);

        return $nr <= 1 ? $basis : add_query_arg($seiten_parameter, $nr, $basis);
    }

    function page($curpage, $post_type_data, $seiten_parameter = null) {
        $maxpagebuttons = $this->current_setup->get("max_page_buttons");
        $firstbutton = $curpage - $maxpagebuttons / 2;
        $lastbutton = $curpage + $maxpagebuttons / 2;
        $lastbutton = $firstbutton < 1 ? $lastbutton + $firstbutton * -1 : $lastbutton;
        $firstbutton = $lastbutton >= $post_type_data->max_num_pages ? $firstbutton - ($lastbutton - $post_type_data->max_num_pages) : $firstbutton;
?>
        <div class="blog-pagination <?php echo get_with_filler() . get_innerrow_frame_border(" "); ?>">
            <?php
            if ($curpage != 1) {
                echo '<a class="page-btn" href="' . esc_url($this->seiten_link($curpage - 1 > 0 ? $curpage - 1 : 1, $seiten_parameter)) . '"><i class="fa fa-angle-double-left"></i></a>';
            } else {
                $lastbutton += 1;
            }
            for ($i = 1; $i <= $post_type_data->max_num_pages; $i++) {
                if ($i >= $firstbutton && $i <= $lastbutton)
                    echo '<a class="page-btn' . ($i == $curpage ? " active" : "") . '" href="' . esc_url($this->seiten_link($i, $seiten_parameter)) . '">' . $i . "</a>";
            }
            if ($i - 1 != $curpage) {
                echo '<a class="page-btn" href="' . esc_url($this->seiten_link($curpage + 1 <= $post_type_data->max_num_pages ? $curpage + 1 : $post_type_data->max_num_pages, $seiten_parameter)) . '"><i class="fa fa-angle-double-right"></i></a>';
            } ?>
        </div>
<?php
    }
}

function the_pagination($page, $query, $seiten_parameter = null) {
    $theme_pagination = new Theme_Pagination();
    $theme_pagination->page($page, $query, $seiten_parameter);
} ?>