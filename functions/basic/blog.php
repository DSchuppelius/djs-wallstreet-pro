<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : blog.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

/**
 * Print the first instance of a block in the content, and then break away.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @param string      $block_name The full block type name, or a partial match.
 *                                Example: `core/image`, `core-embed/*`.
 * @param string|null $content    The content to search in. Use null for get_the_content().
 * @param int         $instances  How many instances of the block will be printed (max). Default  1.
 * @return bool Returns true if a block was located & printed, otherwise false.
 */
function twenty_twenty_one_print_first_instance_of_block($block_name, $content = null, $instances = 1) {
    $instances_count = 0;
    $blocks_content = "";

    if (!$content) {
        $content = get_the_content();
    }

    // Parse blocks in the content.
    $blocks = parse_blocks($content);

    // Loop blocks.
    foreach ($blocks as $block) {
        // Sanity check.
        if (!isset($block["blockName"])) {
            continue;
        }

        // Check if this the block matches the $block_name.
        $is_matching_block = false;

        // If the block ends with *, try to match the first portion.
        if ("*" === $block_name[-1]) {
            $is_matching_block = 0 === strpos($block["blockName"], rtrim($block_name, "*"));
        } else {
            $is_matching_block = $block_name === $block["blockName"];
        }

        if ($is_matching_block) {
            // Increment count.
            $instances_count++;

            // Add the block HTML.
            $blocks_content .= render_block($block);

            // Break the loop if the $instances count was reached.
            if ($instances_count >= $instances) {
                break;
            }
        }
    }

    if ($blocks_content) {
        /** This filter is documented in wp-includes/post-template.php */
        echo apply_filters("the_content", $blocks_content); //phpcs:ignore WordPress.Security.EscapeOutput
        return true;
    }
    return false;
}

/**
 * Determines if post thumbnail can be displayed.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return bool
 */
function twenty_twenty_one_can_show_post_thumbnail() {
    /**
     * Filters whether post thumbnail can be displayed.
     *
     * @since Twenty Twenty-One 1.0
     *
     * @param bool $show_post_thumbnail Whether to show post thumbnail.
     */
    return apply_filters("twenty_twenty_one_can_show_post_thumbnail", !post_password_required() && !is_attachment() && has_post_thumbnail());
}

function get_the_read_more($class = 'blog-btn-col') {
    return '<div class="' . $class . '"><form action"' . get_the_permalink() . '"><button class="btn more" type="submit" >' . __("Read More", "wallstreet") . '</button></form></div>';
}

function the_read_more($class = 'blog-btn-col') {
    echo get_the_read_more($class);
}

function get_the_show_all($link, $text, $target = false, $button_class = "more blog") {
    $action = ""; $result = "";

    if(!empty($text)) {
        if(!empty($link)) {
            $action = 'action="' . $link . '" ' . get_blank_target($target, 'method="get"');
        }
        $result =
            '<div class ="row">
                <div class="show-all-btn">
                    <form ' . $action . '>
                        <button class="btn big ' . $button_class . '" type="submit" >' . $text . '</button>
                    </form>
                </div>
            </div>';
    }

    return $result;
}

function the_show_all($link, $text, $target = false, $button_class = "more blog") {
    echo get_the_show_all($link, $text, $target, $button_class);
}
?>

