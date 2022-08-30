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
    function page($curpage, $post_type_data) {
        ?>
        <div class="blog-pagination <?php echo get_with_Filler() . get_innerrow_Frame_Border(" "); ?>">
            <?php
            if ($curpage != 1) {
                echo '<a class="page-btn" href="' . get_pagenum_link($curpage - 1 > 0 ? $curpage - 1 : 1) . '"><i class="fa fa-angle-double-left"></i></a>';
            }
            for ($i = 1; $i <= $post_type_data->max_num_pages; $i++) {
                echo '<a class="page-btn' . ($i == $curpage ? " active" : "") . '" href="' . get_pagenum_link($i) . '">' . $i . "</a>";
            }
            if ($i - 1 != $curpage) {
                echo '<a class="page-btn" href="' . get_pagenum_link($curpage + 1 <= $post_type_data->max_num_pages ? $curpage + 1 : $post_type_data->max_num_pages) . '"><i class="fa fa-angle-double-right"></i></a>';
            }?>
        </div>
    <?php
    }
}

class Theme_Pagination2 {
    function page2($curpage, $post_type_data, $div) {
        ?>
        <div class="blog-pagination <?php echo get_with_Filler() . get_innerrow_Frame_Border(" "); ?>">
            <?php if ($curpage != 1) {
                $arr = explode("?", get_pagenum_link($curpage - 1 > 0 ? $curpage - 1 : 1));
                echo '<a href="' . $arr[0] . "?div=$div" . '"><i class="fa fa-angle-double-left"></i></a>';
            } ?>
            <?php
            for ($i = 1; $i <= $post_type_data->max_num_pages; $i++) {
                $arr = explode("?", get_pagenum_link($i));
                echo '<a class="' . ($i == $curpage ? "active " : "") . '" href="' . $arr[0] . "?div=$div" . '">' . $i . "</a>";
            }
            if ($i - 1 != $curpage) {
                $arr = explode("?", get_pagenum_link($curpage + 1 <= $post_type_data->max_num_pages ? $curpage + 1 : $post_type_data->max_num_pages));
                echo '<a class="" href="' . $arr[0] . "?div=$div" . '"><i class="fa fa-angle-double-right"></i></a>';
            }?>
        </div>
    <?php
    }
}

class Theme_Pagination3 {
    function page3($pages = "", $range = 2, $total_records = "", $show_item = "") {
        $showitems = $range * 2 + 1;
        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }

        if ($pages == "") {
            global $wp_query;
            $pages = ceil($total_records / $show_item);
            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) { ?>
            <div class="blog-pagination <?php echo get_with_Filler() . get_innerrow_Frame_Border(" "); ?>">
                <?php if ($paged > 2 && $paged > $range + 1 && $showitems < $pages); ?>
                    <a class="portfolio_categories" href="<?php echo get_pagenum_link(1); ?>">&laquo;</a>
                <?php if ($paged > 1 && $showitems < $pages); ?>
                    <a class="portfolio_categories" href="<?php echo get_pagenum_link($paged - 1); ?>">&lsaquo;</a>

                <?php
                for ($i = 1; $i <= $pages; $i++) {
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        echo $paged == $i ? '<a class="active">' . $i . "</a>" : '<a class="portfolio_categories" href="' . get_pagenum_link($i) . '" class="inactive" >' . $i . "</a>";
                    }
                }

                if ($paged < $pages && $showitems < $pages);
                ?>
                    <a class="portfolio_categories" href="<?php echo get_pagenum_link($paged + 1); ?>">&rsaquo;</a>
                <?php if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages); ?>
                    <a class="portfolio_categories" href="<?php echo get_pagenum_link($pages); ?>">&raquo;</a>
            </div>
        <?php }
    }
}

function the_pagination($page, $query, $total_pages = null, $posts_per_page = null) {
    $theme_pagination = new Theme_Pagination();
    $theme_pagination->page($page, $query, $total_pages, $posts_per_page);
}?>
