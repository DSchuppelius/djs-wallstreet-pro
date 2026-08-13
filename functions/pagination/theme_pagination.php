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

    function page($curpage, $post_type_data) {
        $maxpagebuttons = $this->current_setup->get("max_page_buttons");
        $firstbutton = $curpage - $maxpagebuttons / 2;
        $lastbutton = $curpage + $maxpagebuttons / 2;
        $lastbutton = $firstbutton < 1 ? $lastbutton + $firstbutton * -1 : $lastbutton;
        $firstbutton = $lastbutton >= $post_type_data->max_num_pages ? $firstbutton - ($lastbutton - $post_type_data->max_num_pages) : $firstbutton;
?>
        <div class="blog-pagination <?php echo get_with_filler() . get_innerrow_frame_border(" "); ?>">
            <?php
            if ($curpage != 1) {
                echo '<a class="page-btn" href="' . get_pagenum_link($curpage - 1 > 0 ? $curpage - 1 : 1) . '"><i class="fa fa-angle-double-left"></i></a>';
            } else {
                $lastbutton += 1;
            }
            for ($i = 1; $i <= $post_type_data->max_num_pages; $i++) {
                if ($i >= $firstbutton && $i <= $lastbutton)
                    echo '<a class="page-btn' . ($i == $curpage ? " active" : "") . '" href="' . get_pagenum_link($i) . '">' . $i . "</a>";
            }
            if ($i - 1 != $curpage) {
                echo '<a class="page-btn" href="' . get_pagenum_link($curpage + 1 <= $post_type_data->max_num_pages ? $curpage + 1 : $post_type_data->max_num_pages) . '"><i class="fa fa-angle-double-right"></i></a>';
            } ?>
        </div>
<?php
    }
}

function the_pagination($page, $query) {
    $theme_pagination = new Theme_Pagination();
    $theme_pagination->page($page, $query);
} ?>