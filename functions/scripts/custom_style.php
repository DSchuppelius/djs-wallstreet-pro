<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : custom_style.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if ( ! function_exists( 'djs_wallstreet_root_css' ) ) {
	/**
	 * Baut den :root‑Block + optionalen #page_fader‑Selektor
	 */
	function djs_wallstreet_root_css(): string {

		$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

		/* --------------------------------------------------
		 * 1. Variablen sammeln
		 * ------------------------------------------------*/
        $link = esc_attr(get_theme_link_color());
		$vars = [
			/* Farben */
            '--theme-background-color'          => esc_attr(get_theme_bg_color()),
            '--theme-color'                     => esc_attr(get_theme_link_color()),

            '--link-color'                      => $link,                                      // Volle Farbe
            '--link-color-contrast'             => is_dark_color($link, 0.9) ? '#ffffff' : '#000000',

            // «additional» = zusätzliche Deckkraft / Aufhellen
            '--link-color_additional-100'       => get_rgba_color($link, 1.00, '#101010'),  // 100 %
            '--link-color_additional-70'        => get_rgba_color($link, 0.70, '#101010'),  // 70 %
            '--link-color_additional-65'        => get_rgba_color($link, 0.65, '#101010'),  // 65 %
            '--link-color_additional-60'        => get_rgba_color($link, 0.60, '#101010'),  // 60 %
            '--link-color_additional-15'        => get_rgba_color($link, 0.15, '#101010'),  // 70 %

            // «reduced» = abgedunkelte Variante (je nach Bedarf Farbe #303030 anpassen)
            '--link-color_reduced-100'          => get_rgba_color($link, 1.00, '#303030'),  // 100 %
            '--link-color_reduced-85'           => get_rgba_color($link, 0.85, '#303030'),  // 85 %
            '--link-color_reduced-70'           => get_rgba_color($link, 0.70, '#303030'),  // 70 %
            '--link-color_reduced-60'           => get_rgba_color($link, 0.60, '#303030'),  // 60 %
            '--link-color_reduced-50'           => get_rgba_color($link, 0.50, '#303030'),  // 50 %
            '--link-color_reduced-25'           => get_rgba_color($link, 0.25, '#303030'),  // 25 %
            '--link-color_reduced-15'           => get_rgba_color($link, 0.15, '#303030'),  // 15 %

			/* Input & Border */
			'--input-base'                      => $current_setup->get('input_base') . 'em',
			'--input-biggerbase'                => ($current_setup->get('input_base') + 0.2) . 'em',
			'--input-smallerbase'               => ($current_setup->get('input_base') - 0.1) . 'em',
			'--border-base'                     => absint($current_setup->get('border_base'))           . 'px',
			'--border-bigbase'                  => absint($current_setup->get('border_bigbase'))        . 'px',
			'--border-smallbase'                => absint($current_setup->get('border_smallbase'))      . 'px',
			'--border-verysmallbase'            => absint($current_setup->get('border_verysmallbase'))  . 'px',

			/* Logo */
			'--logo-width'                      => absint(get_theme_mod('wallstreet_logo_length', 156)) . 'px',
			'--logo-top'                        => intval(get_theme_mod('wallstreet_logo_position', 0)) . 'px',
			'--fixed-logo-width'                => absint(get_theme_mod('wallstreet_fixed_logo_length', 94)) . 'px',
			'--fixed-logo-top'                  => intval(get_theme_mod('wallstreet_fixed_logo_position', 0)) . 'px',
		];

		/* Slider‑Radien, falls Post‑Type‑Plugin fehlt */
		if ( ! defined( 'DJS_POSTTYPE_PLUGIN' ) ) {
			$round = absint($current_setup->get('slideroundcorner'));
			$vars['--main-slider-radius']       = $round . 'px';
			$vars['--sub-slider-radius']        = max(0, $round - 20) . 'px';
		}

		/* Typografie */
		if ($current_setup->get("enable_custom_typography") == true) {
			$font                               = esc_attr($current_setup->get('google_font'));
			$vars['--font-family-base']         = "'{$font}','SiteFont'";

			$groups = [
				'general'                       => 'general_typography',
				'menu'                          => 'menu_title',
				'post'                          => 'post_title',
				'service'                       => 'service_title',
				'portfolio'                     => 'portfolio_title',
				'widget'                        => 'widget_title',
				'callout-title'                 => 'calloutarea_title',
				'callout-desc'                  => 'calloutarea_description',
				'callout-link'                  => 'calloutarea_purches',
			];

			foreach ( $groups as $key => $opt ) {
				$vars["--{$key}-font-size"]     = absint($current_setup->get("{$opt}_fontsize"))  . 'px';
				$vars["--{$key}-font-weight"]   = esc_attr($current_setup->get("{$opt}_fontfamily"));
				$vars["--{$key}-font-style"]    = esc_attr($current_setup->get("{$opt}_fontstyle"));
			}
		}

		/* Layout‑Abstände */
		$header_corr = $current_setup->get( 'fixedheader_enabled' ) ? 80 : 0;
		$sub_corr    = absint( $current_setup->get( 'slideroundcorner' ) );
		$sub_corr    = $sub_corr > 0 ? $sub_corr - 20 : 0;

		$vars += [
			'--carousel-margin-bottom'          => (80 - $sub_corr) . 'px',
			'--carousel-margin-bottom-alt'      => (80 - $current_setup->get('contentposition') - $sub_corr) . 'px',
			'--breadcrumb-bottom'               => $current_setup->get('breadcrumbposition') . 'px',
			'--title-padding-bottom'            => ($sub_corr + $current_setup->get('breadcrumbposition') - $header_corr) . 'px',
		];

		/* --------------------------------------------------
		 * 2. :root‑Block zusammenbauen
		 * ------------------------------------------------*/
		$css = ':root{';
		foreach ($vars as $name => $value) {
			$css .= $name . ':' . $value. ';';
		}
		$css .= '}';

		/* --------------------------------------------------
		 * 3. Page‑Fader (wenn Bild vorhanden)
		 * ------------------------------------------------*/
		if ( $url = set_url_scheme(get_background_image())) {
			$size   = esc_html(get_theme_mod('background_size',       get_theme_support('custom-background', 'default-size')));
			$repeat = esc_html(get_theme_mod('background_repeat',     get_theme_support('custom-background', 'default-repeat')));
			$pos_x  = esc_html(get_theme_mod('background_position_x', get_theme_support('custom-background', 'default-position-x')));
			$pos_y  = esc_html(get_theme_mod('background_position_y', get_theme_support('custom-background', 'default-position-y')));
			$attach = esc_html(get_theme_mod('background_attachment', get_theme_support('custom-background', 'default-attachment')));

			$css .= '#page_fader{'
			     . "background-image:url('{$url}');"
			     . "background-size:{$size};"
                 . "background-color:{$vars['--theme-background-color']};"
			     . "background-repeat:{$repeat};"
			     . "background-position:{$pos_x} {$pos_y};"
			     . "background-attachment:{$attach};"
			     . '}';
		}

		return $css;
	}
}

/**
 * Hook: hängt den :root‑Block an das Stylesheet & lädt Google Fonts
 */
add_action( 'wp_enqueue_scripts', function () {
	$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

	// Header‑Top mobil ausblenden
	if ('on' !== $current_setup->get('contact_header_settings' )) {
		add_filter('body_class', static function($classes) {
			$classes[] = 'hide-header-top';
			return $classes;
		} );
	}
}, 20 );