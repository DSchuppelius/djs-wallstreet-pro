<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-client.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class theme_client_customizer extends theme_relationship_customizer {

    public function __construct() {
        parent::__construct();
        $this->name = "client";
    }

    protected function get_title() {
        return __("Our Clients", "wallstreet");
    }

    protected function get_description() {
        return __("Have a look at our clients we are growing their business and they are going up in the market by beating their competitors.", "wallstreet");
    }

    protected function get_section_title() {
        return __("Client settings", "wallstreet");
    }

    protected function add_button_relationships($wp_customize) {
        $wp_customize->add_control(
            new WP_Client_Customize_Control($wp_customize, $this->name, [
                "section" => $this->name . "_section_settings",
                "priority" => 500,
            ])
        );
    }
}

global $customizer_client;

if(!isset($customizer_client)) {
    $customizer_client = new theme_client_customizer();
    $customizer_client->register();
} ?>

