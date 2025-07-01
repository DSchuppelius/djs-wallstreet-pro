<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : functions.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
/* -------------------------------------------------------------------------
 * 1.  Basis‑Konstanten (werden nur gesetzt, falls noch nicht definiert)
 * ----------------------------------------------------------------------*/
defined( 'TEMPLATE_DIR' )      || define( 'TEMPLATE_DIR',      untrailingslashit( get_template_directory() ) );
defined( 'TEMPLATE_DIR_URI' )  || define( 'TEMPLATE_DIR_URI',  untrailingslashit( get_template_directory_uri() ) );

defined( 'THEME_ASSETS_PATH' )     || define( 'THEME_ASSETS_PATH',     TEMPLATE_DIR     . '/assets' );
defined( 'THEME_ASSETS_PATH_URI' ) || define( 'THEME_ASSETS_PATH_URI', TEMPLATE_DIR_URI . '/assets' );

defined( 'THEME_FUNCTIONS_PATH' )  || define( 'THEME_FUNCTIONS_PATH',  TEMPLATE_DIR     . '/functions' );
defined( 'THEME_OPTIONS_PATH' )    || define( 'THEME_OPTIONS_PATH',    TEMPLATE_DIR_URI . '/functions/theme_options' );

/* -------------------------------------------------------------------------
 * 2.  Pflicht‑Plugins prüfen (simple Notice, kein Theme‑Switch)
 * ----------------------------------------------------------------------*/
if ( ! defined( 'DJS_CORE_PLUGIN_DIR' ) ) {
	add_action( 'admin_notices', static function () {
		printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			esc_html__('To use the theme "DJS-Wallstreet-Pro" download the plugin DJS-Wallstreet-Pro Core', "djs-wallstreet-pro") .
			' <a href="https://github.com/DSchuppelius/djs-wallstreet-pro-core/releases/latest/" target="_blank" rel="noopener">Download</a>'
		);
	} );
}

if ( ! defined( 'DJS_POSTTYPE_PLUGIN_DIR' ) ) {
	add_action( 'admin_notices', static function () {
		printf(
			'<div class="notice notice-warning"><p>%s</p></div>',
			esc_html__('To use all features of the theme "DJS-Wallstreet-Pro" download the plugin DJS-Wallstreet-Pro Post-Types', "djs-wallstreet-pro") .
			' <a href="https://github.com/DSchuppelius/djs-wallstreet-pro-post-types/releases/latest/" target="_blank" rel="noopener">Download</a>'
		);
	} );
}

require_once TEMPLATE_DIR . '/theme_setup_data.php';

/* -------------------------------------------------------------------------
 * 3.  Autoload für Theme‑Klassen (PSR‑4‑ähnlich)
 * ----------------------------------------------------------------------*/
spl_autoload_register( static function ( $class ) {
	$prefix = 'DJS\\';
	if ( strpos( $class, $prefix ) !== 0 ) {
		return;
	}
	$path = THEME_FUNCTIONS_PATH . '/' . strtolower( str_replace( [ $prefix, '\\' ], [ '', '/' ], $class ) ) . '.php';
	if ( is_readable( $path ) ) {
		require_once $path;
	}
} );

/* -------------------------------------------------------------------------
 * 4.  Helfer zum einfachen Einbinden alter Funktions‑Dateien
 * ----------------------------------------------------------------------*/
foreach ( [
	'base/get_template_parts',
	'base/get_content_title',
	'theme/theme_functions',
	'theme/theme_colors',
	'scripts/scripts',
    'scripts/custom_style',
	'font/font',
	'content/content',
	'excerpt/excerpt',
	'breadcrumbs/breadcrumbs',
	'testimonials/testimonials',
	'pagination/theme_pagination',
	'menu/theme_bootstrap_walker_page',
	'menu/theme_bootstrap_walker_nav_menu',
	'basic/blog',
	'basic/footnote',
	'basic/archive',
	'basic/lazyload',
	'basic/generator',
	'basic/htmlclasses',
	'widget/custom-sidebar',
	'widget/wallstreet-latest-widget',
	'widget/wallstreet-post-format-widget',
	'shortcodes/shortcodes',
	'customizer/customizer',
	'customizer/customizer-controls',
	'customizer/childs/customizer-blog',
	'customizer/childs/customizer-home',
	'customizer/childs/customizer-global',
	'customizer/childs/customizer-social',
	'customizer/childs/customizer-template',
	'customizer/childs/customizer-copyright',
	'customizer/childs/customizer-typography',
	'customizer/childs/customizer-theme_style',
	'customizer/single-blog-options',
] as $file ) {
	$path = THEME_FUNCTIONS_PATH . '/' . ltrim( $file, '/' ) . '.php';
	if ( is_readable( $path ) ) {
		require_once $path;
	}
}

/* -------------------------------------------------------------------------
 * 5.  Theme‑Setup (Nach WP‑Best Practice)
 * ----------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'djs_wallstreet_setup' );

function djs_wallstreet_setup() {
	// Übersetzungen
	load_theme_textdomain( 'djs-wallstreet-pro', TEMPLATE_DIR . '/languages' );

	// Content‑Width (Legacy)
	$GLOBALS['content_width'] = $GLOBALS['content_width'] ?? 600;

	// Editor‑Styles & Block‑Styles
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_editor_style( THEME_ASSETS_PATH_URI . '/css/editor.css' );

	// Grundlegende Supports
	add_theme_supports( [
		'automatic-feed-links',
		'html5' => [ 'comment-list', 'comment-form', 'search-form' ],
		'post-thumbnails',
		'responsive-embeds',
		'title-tag',
	] );

	add_theme_support( 'post-formats', [ 'aside','gallery','image','quote','video','audio' ] );

	// Bildgrößen
	$djs_sizes = [
		'index-thumb'   => [493, 300, true],
		'blog-thumb'    => [1000, 400, true],
		'about-thumb'   => [1525, 450, true],
		'banner-thumb'  => [2144, 650, true],
		'bigbanner-thumb'=>[2144, 800, true],
		'port-thumb'    => [550, 550, true],
		'bigport-thumb' => [1000,1000, true],
		'post-thumb'    => [733, 0, false],
		'bigpost-thumb' => [1000,0,false],
		'fullpost-thumb'=> [1525,0,false],
	];
	foreach ( $djs_sizes as $name => $args ) {
		add_image_size( $name, ...$args );
	}
	set_post_thumbnail_size( 1000, 400, true );

	// Menüs
	register_nav_menu( 'primary', __( 'Primary Menu', 'djs-wallstreet-pro' ) );

	// Head‑Grafiken
	register_default_headers( [
		'mypic' => [
			'url'           => THEME_ASSETS_PATH_URI . '/images/page-header-bg.jpg',
			'thumbnail_url' => THEME_ASSETS_PATH_URI . '/images/page-header-bg.jpg',
			'description'   => _x( 'MyPic', 'header image description', 'djs-wallstreet-pro' ),
		],
	] );

	// Custom Header / Logo / Background
	add_theme_support( 'custom-header', [
		'default-image'      => THEME_ASSETS_PATH_URI . '/images/page-header-bg.jpg',
		'width'              => 2560,
		'height'             => 640,
		'default-text-color' => '#143745',
	] );

	add_theme_support( 'custom-logo', [
		'width'       => 300,
		'height'      => 50,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => [ 'site-title', 'site-description' ],
	] );

	add_theme_support( 'custom-background', [
		'default-color'      => '000000',
		'default-image'      => THEME_ASSETS_PATH_URI . '/images/page-bg.jpg',
		'default-repeat'     => 'no-repeat',
		'default-position-x' => 'center',
		'default-position-y' => 'center',
		'default-attachment' => 'fixed',
	] );

	// WooCommerce
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/* -------------------------------------------------------------------------
 * 6.  MIME‑Types (SVG nur mit Safe‑SVG o. Ä.)
 * ----------------------------------------------------------------------*/
add_filter( 'upload_mimes', static function ( $types ) {
	return $types + [
		'fcstd' => 'application/zip',
		'svg'   => 'image/svg+xml',
		'zip'   => 'application/zip',
		'm4a'   => 'audio/mp4',
		'mp4'   => 'video/mp4',
		'mp3'   => 'audio/mpeg',
	];
} );

/* -------------------------------------------------------------------------
 * 7.  Benutzer‑Profile – Social Links
 * ----------------------------------------------------------------------*/
add_filter( 'user_contactmethods', static function ( $methods ) {
	return $methods + [
		'facebook_profile' => __( 'Facebook URL', 'djs-wallstreet-pro' ),
		'twitter_profile'  => __( 'Twitter URL', 'djs-wallstreet-pro' ),
		'linkedin_profile' => __( 'LinkedIn URL', 'djs-wallstreet-pro' ),
	];
}, 10, 1 );

/* -------------------------------------------------------------------------
 * 8.  Avatar‑Klasse erweitern
 * ----------------------------------------------------------------------*/
add_filter( 'get_avatar', static function ( $html ) {
	return str_replace( "class='avatar", "class='avatar img-responsive comment-img img-circle", $html );
} );

/* -------------------------------------------------------------------------
 * 9.  Pagination‑Buttons
 * ----------------------------------------------------------------------*/
add_filter( 'next_posts_link_attributes',     fn() => 'class="btn next"' );
add_filter( 'previous_posts_link_attributes', fn() => 'class="btn prev"' );

/* -------------------------------------------------------------------------
 * 10.  Fallback <title> für sehr alte WP‑Versionen (<4.1)
 * ----------------------------------------------------------------------*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_filter( 'wp_title', static function ( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}
		$title .= get_bloginfo( 'name' );
		if ( ( $tagline = get_bloginfo( 'description' ) ) && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $tagline";
		}
		return $title;
	}, 10, 2 );
}
