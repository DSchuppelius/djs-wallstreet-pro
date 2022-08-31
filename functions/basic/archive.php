<?php
/*
 * Created on   : Wed Aug 31 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : archive.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
 
 function archives_view($args) {
    $args['type'] = 'yearly';
    $args['limit'] = 5;
    return $args;
}
add_filter('widget_archives_args', 'archives_view');
add_filter('widget_archives_dropdown_args', 'archives_view');