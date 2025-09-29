<?php
/**
 * Admin Functions
 *
 * @package SignLab_theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF JSON Autosync: Save path
 */
add_filter('acf/settings/save_json', function($path) {
    return get_stylesheet_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);

    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});


/**
 * ACF Options Page Setup
 */
function signlab_theme_acf_options_page() {
  if (function_exists('acf_add_options_page')) {
      acf_add_options_page(array(
          'page_title' => 'Theme Options',
          'menu_title' => 'Theme Options',
          'menu_slug' => 'theme-options',
          'capability' => 'edit_posts',
      ));
      
      acf_add_options_sub_page(array(
          'page_title' => 'Header Settings',
          'menu_title' => 'Header',
          'parent_slug' => 'theme-options',
      ));
      
      acf_add_options_sub_page(array(
          'page_title' => 'Footer Settings',
          'menu_title' => 'Footer',
          'parent_slug' => 'theme-options',
      ));
  }
}
add_action('acf/init', 'signlab_theme_acf_options_page');