<?php
/**
 * Functions
 *
 * @package SignLab_theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove the editor from page
 */
add_action( 'init', function() {
    remove_post_type_support('page', 'editor');
}, 99);

$website_url = get_field('website_url', 'option') ?: "https://signlab.com.au";

add_filter('wpseo_canonical', function($canonical) use ($website_url) {
    return str_replace(home_url(), $website_url, $canonical);
});

add_filter('wpseo_opengraph_url', function($url) use ($website_url) {
    return str_replace(home_url(), $website_url, $url);
});

add_filter('wpseo_json_ld_output', function($data, $context) use ($website_url) {
    $search  = home_url();
    $replace = $website_url;

    return json_decode(str_replace($search, $replace, wp_json_encode($data)), true);
}, 10, 2);