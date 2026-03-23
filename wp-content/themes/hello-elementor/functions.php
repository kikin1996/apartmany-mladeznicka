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
/* Zamezit horizontálnímu přetékání – jen overflow, bez ovlivnění layoutu */
html { overflow-x: hidden; }
body { overflow-x: hidden; }

/* Hlavní strana – hero fotka s lidmi: posunout dolů aby byli lidé lépe vidět */
.elementor-element-d359096 {
    background-position: center 30% !important;
}

/* Footer fotka – poměr stran odpovídající fotce IMG_3759.webp (1920×1440 = 4:3) */
.elementor-element-73f5363 .elementor-cta {
    aspect-ratio: 4/3;
    min-height: 0 !important;
}

/* Hero – nadpis a tlačítko "Vyberte si svůj byt" */
.elementor-element-427523a .elementor-heading-title {
    color: #92b676 !important;
}
.elementor-element-a4301a1 .elementor-button {
    background-color: #92b676 !important;
    color: #ffffff !important;
    border-color: #92b676 !important;
}
.elementor-element-a4301a1 .elementor-button:hover {
    background-color: #7a9e60 !important;
    border-color: #7a9e60 !important;
}

/* Skrýt prázdný obdélník d843ff2 pod fotkou při šířce < 1498px */
@media (max-width: 1498px) {
    .elementor-element-d843ff2 { display: none !important; }
}

/* Skrýt sekci s obrázkem budovy, ceníkem a kytkou na stránce výběr bytu */
.elementor-element-98f458a { display: none !important; }

@media (max-width: 767px) {
    /* Kontejnery nepřesahují viewport pouze na mobilu */
    .elementor-section,
    .elementor-container,
    .e-con,
    .e-con-inner {
        max-width: 100% !important;
        box-sizing: border-box;
    }

    /* Textové bloky – word wrap */
    .elementor-heading-title,
    .elementor-widget-text-editor p,
    h1, h2, h3, h4 {
        overflow-wrap: break-word;
        word-break: break-word;
    }

    /* Obrázky nepřesahují rodiče */
    img { max-width: 100%; height: auto; }

    /* Navigace */
    .site-header { overflow: hidden; }
}

/* Skrýt sekci "Dokonalá oáza klidu a zeleně" na mobilu */
@media (max-width: 767px) {
    .elementor-element-2f90cc7 { display: none !important; }
    .elementor-spacer-inner { display: none !important; }

    /* Kytka flower_01 – posun výše na mobilu */
    .elementor-element-a753450 { top: 320px !important; }

    /* Kytka flower_02 – skrýt */
    .elementor-element-b1befaf { display: none !important; }

    /* Pozadí pozadi1.png – skrýt obě instance */
    .elementor-element-3d4110c,
    .elementor-element-3f6fff1 { display: none !important; }

    /* Carousel 66ad785 – skrýt na mobilu */
    .elementor-element-66ad785 { display: none !important; }
}
</style>' . "\n";
}
add_action('wp_head', 'apartmany_mobile_fix', 999);

// ── Nadpisy nad tabulkami bytů na stránkách pater ───────────────────────────
function apartmany_floor_headings() {
    $map = [
        902 => ['label' => '1. Patro', 'container' => '53e8878'],
        906 => ['label' => '2. Patro', 'container' => '82a32b8'],
        908 => ['label' => '3. Patro', 'container' => 'fa3739e'],
    ];
    $pid = get_the_ID();
    if (!isset($map[$pid])) return;
    $label     = esc_js($map[$pid]['label']);
    $container = esc_js($map[$pid]['container']);
    ?>
<style>
.am-floor-heading {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 48px 0 16px;
    font-family: 'Playfair Display', Georgia, serif;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.querySelector('.elementor-element-<?php echo esc_js($map[$pid]['container']); ?>');
    if (el) {
        var h = document.createElement('h2');
        h.className = 'am-floor-heading';
        h.textContent = '<?php echo esc_js($map[$pid]['label']); ?>';
        el.parentNode.insertBefore(h, el);
    }
});
</script>
    <?php
}
add_action('wp_head', 'apartmany_floor_headings', 999);

// ── Nadpisy s šipkou nad tabulkami na stránce ceníku ─────────────────────────
function apartmany_cenik_headings() {
    if (!is_page(232)) return;
    ?>
<style>
.am-cenik-heading {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin: 56px 0 20px;
    font-family: 'Playfair Display', Georgia, serif;
}
.am-cenik-heading a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: #92B675;
    border-radius: 50%;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    flex-shrink: 0;
    transition: background 0.2s;
}
.am-cenik-heading a:hover { background: #7a9e60; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tables = [
        { id: '1b1f003', label: '1. Patro', href: '/1-patro/' },
        { id: '3249c17', label: '2. Patro', href: '/2-patro/' },
        { id: '8fd1554', label: '3. Patro', href: '/3-patro/' },
    ];
    tables.forEach(function(t) {
        var el = document.querySelector('.elementor-element-' + t.id);
        if (!el) return;
        var wrap = document.createElement('div');
        wrap.className = 'am-cenik-heading';
        wrap.innerHTML = t.label + '<a href="' + t.href + '" title="Přejít na ' + t.label + '">&#8594;</a>';
        el.parentNode.insertBefore(wrap, el);
    });

    // Nadpis nad fotkou budovy
    var budovaEl = document.querySelector('.elementor-element-c38c8ef');
    if (budovaEl) {
        var budovaHeading = document.createElement('div');
        budovaHeading.className = 'am-cenik-heading';
        budovaHeading.style.marginTop = '0';
        budovaHeading.textContent = 'Vyberte si patro:';
        budovaEl.parentNode.insertBefore(budovaHeading, budovaEl);
    }
});
</script>
    <?php
}
add_action('wp_head', 'apartmany_cenik_headings', 999);

// ── PDF Lightbox pro Kartu bytu na stránce ceníku a stránkách pater ─────────
function apartmany_karta_lightbox() {
    if (!is_page([232, 902, 906, 908])) return;
    ?>
<style>
#am-pdf-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0,0,0,0.75);
    align-items: center;
    justify-content: center;
}
#am-pdf-overlay.am-open {
    display: flex;
}
#am-pdf-box {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    width: 96vw;
    max-width: 1600px;
    height: 92vh;
    box-shadow: 0 24px 80px rgba(0,0,0,0.4);
    position: relative;
}
#am-pdf-close {
    position: absolute;
    top: 12px;
    right: 14px;
    width: 36px;
    height: 36px;
    background: #363F2E;
    color: #fff;
    border: none;
    border-radius: 50%;
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}
#am-pdf-frame {
    flex: 1;
    border: none;
    height: 100%;
}
#am-pdf-sidebar {
    width: 200px;
    flex-shrink: 0;
    background: #f8f7ec;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
    padding: 24px 16px;
    border-left: 1px solid #e2e8d5;
}
#am-pdf-sidebar p {
    font-size: 14px;
    color: #363F2E;
    font-weight: 600;
    text-align: center;
    margin: 0 0 4px;
}
.am-pdf-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 16px 12px;
    border-radius: 10px;
    border: 2px solid #92b676;
    background: #92b676;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s;
    line-height: 1.3;
}
.am-pdf-btn:hover {
    background: #7a9e60;
    border-color: #7a9e60;
    color: #fff;
}
.am-pdf-btn svg {
    width: 32px;
    height: 32px;
    fill: #fff;
}
</style>

<div id="am-pdf-overlay">
    <div id="am-pdf-box">
        <button id="am-pdf-close" onclick="amClosePdf()" title="Zavřít">&#x2715;</button>
        <iframe id="am-pdf-frame" src=""></iframe>
        <div id="am-pdf-sidebar">
            <a id="am-pdf-print" class="am-pdf-btn" href="#" onclick="amPrintPdf();return false;">
                <svg viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                Vytisknout<br>kartu k bytu
            </a>
            <a id="am-pdf-download" class="am-pdf-btn" href="#" download>
                <svg viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                Stáhnout<br>kartu k bytu
            </a>
        </div>
    </div>
</div>

<script>
var amCurrentPdfUrl = '';

function amOpenPdf(url) {
    amCurrentPdfUrl = url;
    document.getElementById('am-pdf-frame').src = url;
    var base = window.location.origin;
    document.getElementById('am-pdf-download').href = base + '/?am_karta=download&url=' + encodeURIComponent(url);
    document.getElementById('am-pdf-download').setAttribute('download', '');
    document.getElementById('am-pdf-overlay').classList.add('am-open');
    document.body.style.overflow = 'hidden';
}

function amClosePdf() {
    document.getElementById('am-pdf-overlay').classList.remove('am-open');
    document.getElementById('am-pdf-frame').src = '';
    document.body.style.overflow = '';
}

function amPrintPdf() {
    var frame = document.getElementById('am-pdf-frame');
    if (frame && frame.contentWindow) {
        try {
            frame.contentWindow.print();
        } catch(e) {
            // fallback: open PDF in new tab for printing
            window.open(amCurrentPdfUrl, '_blank');
        }
    }
}

// Zavřít kliknutím na pozadí
document.getElementById('am-pdf-overlay').addEventListener('click', function(e) {
    if (e.target === this) amClosePdf();
});

// Zavřít Escape klávesou
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') amClosePdf();
});

// Zachytit kliknutí na Karta bytu linky (ceník tabulka + floor pages info panel)
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.eael-data-table-wrap a').forEach(function(a) {
        var href = a.getAttribute('href') || '';
        if (href.indexOf('/byty/karty/') !== -1 && href.indexOf('.pdf') !== -1) {
            a.addEventListener('click', function(e) {
                e.preventDefault();
                amOpenPdf(href);
            });
        }
    });
});
// Event delegation pro dynamicky generovaný #byty-info-pdf (stránky pater)
document.addEventListener('click', function(e) {
    var a = e.target.closest('#byty-info-pdf');
    if (a) {
        var href = a.getAttribute('href') || '';
        if (href && href !== '#') {
            e.preventDefault();
            amOpenPdf(href);
        }
    }
});
</script>
    <?php
}
add_action('wp_footer', 'apartmany_karta_lightbox', 999);

// ── Proxy pro stažení a tisk PDF karet k bytu ────────────────────────────────
function apartmany_karta_proxy() {
    $action = $_GET['am_karta'] ?? '';
    if (!$action) return;

    $url = $_GET['url'] ?? '';
    // Převést relativní URL na absolutní
    if ($url && $url[0] === '/') {
        $url = home_url($url);
    }
    // Povolené URL - pouze naše PDF karty
    if (!preg_match('#^https?://[^/]*/(wp-content/uploads/byty/karty/Mladeznicka[ %0-9]+\.pdf)$#i', $url, $m)) {
        wp_die('Nepovolená URL');
    }

    $response = wp_remote_get($url, ['sslverify' => false, 'timeout' => 15]);
    if (is_wp_error($response)) {
        wp_die('PDF se nepodařilo načíst: ' . $response->get_error_message());
    }
    $pdf = wp_remote_retrieve_body($response);

    $filename = basename(urldecode($url));

    if ($action === 'download') {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
        exit;
    }

    if ($action === 'print') {
        $pdf_b64 = base64_encode($pdf);
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html><head><meta charset="utf-8">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
@page { size: A4 portrait; margin: 0; }
html, body { width:100%; height:100%; }
iframe { width:100%; height:100vh; border:none; display:block; }
</style></head><body>
<iframe id="pdfFrame"></iframe>
<script>
var b64 = "' . $pdf_b64 . '";
var binary = atob(b64);
var bytes = new Uint8Array(binary.length);
for (var i = 0; i < binary.length; i++) bytes[i] = binary.charCodeAt(i);
var blob = new Blob([bytes], {type: "application/pdf"});
var blobUrl = URL.createObjectURL(blob);
var frame = document.getElementById("pdfFrame");
frame.src = blobUrl;
frame.onload = function() {
    setTimeout(function() { frame.contentWindow.print(); }, 800);
};
</script>
</body></html>';
        exit;
    }
}
add_action('init', 'apartmany_karta_proxy', 1);

// ── Šipky pro Swiper carousely na mobilu ────────────────────────────────────
function apartmany_carousel_arrows() {
    if (!is_front_page() && !is_home()) return;
    ?>
<style>
.apartmany-carousel-wrap { position: relative; }
.apartmany-carousel-arrow {
    display: none;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background: rgba(0,0,0,0.45);
    color: #fff;
    border: none;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    font-size: 22px;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    line-height: 1;
    -webkit-tap-highlight-color: transparent;
}
.apartmany-carousel-arrow.prev { left: 6px; }
.apartmany-carousel-arrow.next { right: 6px; }
@media (max-width: 767px) {
    .apartmany-carousel-arrow { display: flex; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var carouselIds = ['6de25bb', '66ad785'];
    carouselIds.forEach(function(id) {
        var widget = document.querySelector('.elementor-element-' + id);
        if (!widget) return;
        var swiper = widget.querySelector('.e-n-carousel.swiper');
        if (!swiper) return;

        // Wrap
        var wrap = document.createElement('div');
        wrap.className = 'apartmany-carousel-wrap';
        swiper.parentNode.insertBefore(wrap, swiper);
        wrap.appendChild(swiper);

        // Šipky
        var prev = document.createElement('button');
        prev.className = 'apartmany-carousel-arrow prev';
        prev.setAttribute('aria-label', 'Předchozí');
        prev.innerHTML = '&#8249;';

        var next = document.createElement('button');
        next.className = 'apartmany-carousel-arrow next';
        next.setAttribute('aria-label', 'Další');
        next.innerHTML = '&#8250;';

        wrap.appendChild(prev);
        wrap.appendChild(next);

        // Získej Swiper instanci (Elementor ji ukládá do .swiper.swiper)
        function getSwiper() {
            return swiper.swiper || (swiper.querySelector('.swiper') || {}).swiper || null;
        }

        prev.addEventListener('click', function() {
            var s = getSwiper();
            if (s) s.slidePrev();
            else {
                // fallback – klikni na aktivní slide a scroll
                var slides = swiper.querySelectorAll('.swiper-slide');
                var active = swiper.querySelector('.swiper-slide-active');
                var idx = Array.from(slides).indexOf(active);
                if (idx > 0) slides[idx-1].click();
            }
        });

        next.addEventListener('click', function() {
            var s = getSwiper();
            if (s) s.slideNext();
        });
    });
});
</script>
    <?php
}
add_action('wp_footer', 'apartmany_carousel_arrows');

// Byty Gallery Modal
function byty_modal_enqueue() {
    $pages = ['1-patro', '2-patro', '3-patro'];
    if (is_page($pages)) {
        wp_enqueue_style('byty-modal', get_template_directory_uri() . '/assets/byty-modal.css', [], '1.1');
        wp_enqueue_script('byty-modal', get_template_directory_uri() . '/assets/byty-modal.js', ['jquery'], '1.1', true);
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
