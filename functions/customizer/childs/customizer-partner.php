<?php
/*
 * Created on   : Wed Sep 01 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-partner.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_partner_customizer extends theme_relationship_customizer {

    public function __construct() {
        parent::__construct();
        $this->name = "partner";
    }

    protected function get_title() {
        return __("Our Partners", "wallstreet");
    }

    protected function get_description() {
        return __("Have a look at our partners we are growing their business and they are going up in the market by beating their competitors.", "wallstreet");
    }

    protected function get_section_title() {
        return __("Partner settings", "wallstreet");
    }

    protected function add_button_relationships($wp_customize) {
        $wp_customize->add_control(
            new WP_Partner_Customize_Control($wp_customize, $this->name, [
                "section" => $this->name . "_section_settings",
                "priority" => 500,
            ])
        );
    }
}

global $customizer_partner;

if(!isset($customizer_partner)) {
    $customizer_partner = new theme_partner_customizer();
    $customizer_partner->register();
} ?>
