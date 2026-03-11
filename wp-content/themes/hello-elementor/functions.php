<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

use Elementor\WPNotificationsPackage\V110\Notifications as ThemeNotifications;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.3.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);
			add_theme_support( 'align-wide' );
			add_theme_support( 'responsive-embeds' );

			/*
			 * Editor Styles
			 */
			add_theme_support( 'editor-styles' );
			add_editor_style( 'editor-styles.css' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				get_template_directory_uri() . '/header-footer' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Admin notice
if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}

function hello_elementor_get_theme_notifications(): ThemeNotifications {
	static $notifications = null;

	if ( null === $notifications ) {
		require get_template_directory() . '/vendor/autoload.php';

		$notifications = new ThemeNotifications(
			'hello-elementor',
			HELLO_ELEMENTOR_VERSION,
			'theme'
		);
	}

	return $notifications;
}

hello_elementor_get_theme_notifications();

// ── Mobilní CSS fix – přetékání obsahu ─────────────────────────────────────
function apartmany_mobile_fix() {
    echo '<style id="apartmany-mobile-fix">
/* Zamezit horizontálnímu přetékání na všech zařízeních */
html { overflow-x: hidden; }
body { overflow-x: hidden; max-width: 100%; }

/* Elementor kontejnery – nesmí přesáhnout viewport */
.elementor-section,
.elementor-container,
.e-con,
.e-con-inner {
    max-width: 100% !important;
    box-sizing: border-box;
}

@media (max-width: 767px) {
    /* Oprava fixního backgroundu na mobilu */
    [style*="background-position"] {
        background-position: center center !important;
        background-size: cover !important;
    }

    /* Absolutně pozicované dekorativní prvky nepřesahují */
    .elementor-element[style*="position:absolute"],
    .elementor-element[style*="position: absolute"] {
        max-width: 100vw;
        overflow: hidden;
    }

    /* Textové bloky – word wrap */
    .elementor-heading-title,
    .elementor-widget-text-editor p,
    h1, h2, h3, h4 {
        overflow-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
    }

    /* Obrázky nepřesahují rodiče */
    img { max-width: 100%; height: auto; }

    /* Elementor hero sekce – min-height pro mobil */
    .elementor-element[style*="min-height:800px"],
    .elementor-element[style*="min-height: 800px"] {
        min-height: 70vw !important;
    }

    /* Navigace */
    .site-header { overflow: hidden; }

    /* Nadpisy v hero – zmenšit font pokud přetékají */
    .elementor-widget-heading .elementor-heading-title {
        font-size: clamp(1.4rem, 7vw, 3rem) !important;
        line-height: 1.2 !important;
    }
}

@media (max-width: 480px) {
    .elementor-widget-heading .elementor-heading-title {
        font-size: clamp(1.2rem, 6vw, 2rem) !important;
    }
}

/* Skrýt sekci "Dokonalá oáza klidu a zeleně" na mobilu */
@media (max-width: 767px) {
    .elementor-element-2f90cc7 { display: none !important; }
    .elementor-spacer-inner { display: none !important; }
}
</style>' . "\n";
}
add_action('wp_head', 'apartmany_mobile_fix', 5);

// Byty Gallery Modal
function byty_modal_enqueue() {
    $pages = ['1-patro', '2-patro', '3-patro'];
    if (is_page($pages)) {
        wp_enqueue_style('byty-modal', get_template_directory_uri() . '/assets/byty-modal.css', [], '1.0');
        wp_enqueue_script('byty-modal', get_template_directory_uri() . '/assets/byty-modal.js', ['jquery'], '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'byty_modal_enqueue');

// ── SEO: Meta description, Open Graph, Schema.org ──────────────────────────
function apartmany_seo_meta() {
    $page_seo = [
        'home'        => [
            'desc'  => 'Moderní apartmány Mládežnická v Bohumíně. Prostorné byty 1+kk až 3+kk s balkonem, sklepem a parkovacím stáním. Prohlídka zdarma – zjistěte aktuální ceny.',
            'title' => 'Apartmány Mládežnická Bohumín – nové byty k prodeji',
            'image' => get_template_directory_uri() . '/assets/images/og-home.jpg',
        ],
        '1-patro'     => [
            'desc'  => 'Byty 1. patro – Apartmány Mládežnická Bohumín. Dispozice 1+kk až 3+kk, balkony, sklepy, parkovací stání. Klikněte na půdorys a prohlédněte fotografie.',
            'title' => 'Byty 1. patro | Apartmány Mládežnická Bohumín',
            'image' => get_template_directory_uri() . '/assets/images/og-1patro.jpg',
        ],
        '2-patro'     => [
            'desc'  => 'Byty 2. patro – Apartmány Mládežnická Bohumín. Dispozice 1+kk až 3+kk, balkony, sklepy, parkovací stání. Klikněte na půdorys a prohlédněte fotografie.',
            'title' => 'Byty 2. patro | Apartmány Mládežnická Bohumín',
            'image' => get_template_directory_uri() . '/assets/images/og-2patro.jpg',
        ],
        '3-patro'     => [
            'desc'  => 'Byty 3. patro – Apartmány Mládežnická Bohumín. Dispozice 1+kk až 3+kk, balkony, sklepy, parkovací stání. Klikněte na půdorys a prohlédněte fotografie.',
            'title' => 'Byty 3. patro | Apartmány Mládežnická Bohumín',
            'image' => get_template_directory_uri() . '/assets/images/og-3patro.jpg',
        ],
        'cenik'       => [
            'desc'  => 'Ceník bytů – Apartmány Mládežnická Bohumín. Aktuální ceny bytů 1+kk, 2+kk a 3+kk včetně sklepa a parkovacího stání.',
            'title' => 'Ceník bytů | Apartmány Mládežnická Bohumín',
            'image' => '',
        ],
        'kontakt'     => [
            'desc'  => 'Kontakt na prodejce bytů Apartmány Mládežnická v Bohumíně. Domluvte si prohlídku nebo se zeptejte na dostupnost bytů.',
            'title' => 'Kontakt | Apartmány Mládežnická Bohumín',
            'image' => '',
        ],
        'lokalita'    => [
            'desc'  => 'Lokalita Apartmánů Mládežnická – Bohumín. Klidná čtvrť s výbornou dostupností do centra, škol, obchodů a přírody.',
            'title' => 'Lokalita | Apartmány Mládežnická Bohumín',
            'image' => '',
        ],
        'financovani' => [
            'desc'  => 'Financování koupě bytu – Apartmány Mládežnická Bohumín. Hypotéka, vlastní zdroje nebo kombinace. Poradíme vám s výběrem.',
            'title' => 'Financování | Apartmány Mládežnická Bohumín',
            'image' => '',
        ],
    ];

    // Zjisti aktuální stránku
    if (is_front_page() || is_home()) {
        $seo = $page_seo['home'];
    } else {
        $slug = get_post_field('post_name', get_queried_object_id());
        $seo  = $page_seo[$slug] ?? [
            'desc'  => get_bloginfo('description'),
            'title' => get_the_title() . ' | Apartmány Mládežnická',
            'image' => '',
        ];
    }

    $url   = esc_url(get_permalink() ?: home_url('/'));
    $title = esc_attr($seo['title']);
    $desc  = esc_attr($seo['desc']);
    $img   = esc_url($seo['image']);
    $site  = esc_attr(get_bloginfo('name'));

    echo "\n<!-- SEO meta -->\n";
    echo "<meta name=\"description\" content=\"{$desc}\">\n";
    echo "<link rel=\"canonical\" href=\"{$url}\">\n";

    // Open Graph
    echo "<meta property=\"og:type\" content=\"website\">\n";
    echo "<meta property=\"og:site_name\" content=\"{$site}\">\n";
    echo "<meta property=\"og:title\" content=\"{$title}\">\n";
    echo "<meta property=\"og:description\" content=\"{$desc}\">\n";
    echo "<meta property=\"og:url\" content=\"{$url}\">\n";
    if ($img) echo "<meta property=\"og:image\" content=\"{$img}\">\n";

    // Twitter Card
    echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
    echo "<meta name=\"twitter:title\" content=\"{$title}\">\n";
    echo "<meta name=\"twitter:description\" content=\"{$desc}\">\n";
    if ($img) echo "<meta name=\"twitter:image\" content=\"{$img}\">\n";

    // Schema.org LocalBusiness (jen homepage)
    if (is_front_page()) {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'RealEstateAgent',
            'name'        => 'Apartmány Mládežnická',
            'description' => 'Nové moderní byty k prodeji v Bohumíně.',
            'url'         => home_url('/'),
            'address'     => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Mládežnická',
                'addressLocality' => 'Bohumín',
                'postalCode'      => '735 81',
                'addressCountry'  => 'CZ',
            ],
        ];
        echo "<script type=\"application/ld+json\">" . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
    }
}
add_action('wp_head', 'apartmany_seo_meta', 1);
