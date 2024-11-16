<?php
function is_testimonial_grid() {
    global $template;

    // Überprüfen, ob $template definiert und ein String ist
    if (empty($template) || !is_string($template)) {
        return false; // Standardwert zurückgeben
    }

    return strpos(basename($template), "testimonial-grid") !== false;
}

function is_testimonial_carousel() {
    global $template;

    // Überprüfen, ob $template definiert und ein String ist
    if (empty($template) || !is_string($template)) {
        return false; // Standardwert zurückgeben
    }

    return strpos(basename($template), "testimonial-carousel") !== false || strpos(basename($template), "home") !== false;
}

function get_testimonial_columns() {
    return is_testimonial_grid() ? 6 : 12;
}
?>