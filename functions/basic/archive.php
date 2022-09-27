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
    $current_options = get_current_options();
    switch ($args['type']) {
    	case 'yearly':
            if ($current_options["max_archive_year"] > 0)
    		    $args['limit'] = $current_options["max_archive_year"];
    		break;
    	case 'monthly':
            if ($current_options["max_archive_month"] > 0)
        		$args['limit'] = $current_options["max_archive_month"];
    		break;
    	case 'daily':
            if ($current_options["max_archive_day"] > 0)
                $args['limit'] = $current_options["max_archive_day"];
    		break;
    	default:
    		$args['limit'] = 10;
    		break;
    }
    return $args;
}
add_filter('widget_archives_args', 'archives_view');
add_filter('widget_archives_dropdown_args', 'archives_view');
