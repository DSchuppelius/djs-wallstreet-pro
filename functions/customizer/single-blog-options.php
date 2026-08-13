<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : single-blog-options.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function wallstreet_single_blog_customizer( $wp_customize ) {

    // Die Labels werden hier direkt uebersetzt. Vorher stand weiter unten
    // esc_html__( $label, ... ) mit einer Variablen als Text-Argument - der
    // String-Extraktor findet solche Stellen nicht, die Labels landeten also nie
    // in der .pot-Datei und blieben in jeder Sprache englisch.
    $controls = [
        'wallstreet_logo_length'         => [ esc_html__( 'Logo Width', 'djs-wallstreet-pro' ),         156, 0, 500,  50 ],
        'wallstreet_logo_position'       => [ esc_html__( 'Logo Position', 'djs-wallstreet-pro' ),       0, -100, 100, 51 ],
        'wallstreet_fixed_logo_length'   => [ esc_html__( 'Fixed Logo Width', 'djs-wallstreet-pro' ),   94, 0, 500,  60 ],
        'wallstreet_fixed_logo_position' => [ esc_html__( 'Fixed Logo Position', 'djs-wallstreet-pro' ), 0, -100, 100, 61 ],
    ];

    foreach ( $controls as $id => $c ) {
        [ $label, $default, $min, $max, $priority ] = $c;

        $wp_customize->add_setting(
            $id,
            [
                'default'   => $default,
                'transport' => 'postMessage',
                'sanitize_callback' => function ( $v ) use ( $min, $max ) {
                    $v = intval( $v );
                    if ( $v < $min ) { $v = $min; }
                    if ( $v > $max ) { $v = $max; }
                    return $v;
                },
            ]
        );

        $wp_customize->add_control(
            new Wallsteet_Slider_Custom_Control(
                $wp_customize,
                $id,
                [
                    'label'       => $label,
                    'section'     => 'title_tagline',
                    'priority'    => $priority,
                    'input_attrs' => [
                        'min'  => $min,
                        'max'  => $max,
                        'step' => 1,
                    ],
                ]
            )
        );
    }
}
add_action( 'customize_register', 'wallstreet_single_blog_customizer' );
?>