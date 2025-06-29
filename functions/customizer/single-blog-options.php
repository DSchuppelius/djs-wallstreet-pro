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

    $controls = [
        'wallstreet_logo_length'         => [ 'Logo Width',         156, 0, 500,  50 ],
        'wallstreet_logo_position'       => [ 'Logo Position',       0, -100, 100, 51 ],
        'wallstreet_fixed_logo_length'   => [ 'Fixed Logo Width',   94, 0, 500,  60 ],
        'wallstreet_fixed_logo_position' => [ 'Fixed Logo Position', 0, -100, 100, 61 ],
    ];

    foreach ( $controls as $id => $c ) {
        [ $label, $default, $min, $max, $priority ] = $c;

        $wp_customize->add_setting(
            $id,
            [
                'default'           => $default,
                'transport'         => 'postMessage',
                'sanitize_callback' => function ( $v ) use ( $min, $max ) {
                    return sanitize_number_range( $v, $min, $max );
                },
            ]
        );

        $wp_customize->add_control(
            new Wallsteet_Slider_Custom_Control(
                $wp_customize,
                $id,
                [
                    'label'       => esc_html__( $label, 'djs-wallstreet-pro' ),
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
