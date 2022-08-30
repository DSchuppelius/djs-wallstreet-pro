<?php
function is_testimonial_grid() {
    global $template;
    return strpos(basename($template), "testimonial-grid") !== false;
}

function is_testimonial_carousel() {
    global $template;
    return strpos(basename($template), "testimonial-carousel") !== false || strpos(basename($template), "home") !== false;
}

function get_testimonial_columns() {
    return is_testimonial_grid() ? 6 : 12;
}
?>
