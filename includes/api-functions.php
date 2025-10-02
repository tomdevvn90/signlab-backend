<?php
/**
 * API Functions
 *
 * @package SignLab_theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * CORS Support for REST API
 */
function signlab_theme_add_cors_http_header() {
  if (is_user_logged_in()) {
      return;
  }
  
  // Allow requests from any origin (customize as needed for production)
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
  
  // Handle preflight requests
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
  }
}
add_action('rest_api_init', 'signlab_theme_add_cors_http_header');

/**
 * Optimize REST API responses for headless usage
 */
function signlab_theme_clean_rest_response($response, $post, $request) {
  $data = $response->get_data();
  
  // Remove unnecessary fields to reduce response size
  unset($data['author']);
  unset($data['comment_status']);
  unset($data['ping_status']);
  unset($data['format']);
  unset($data['meta']);
  unset($data['sticky']);
  unset($data['template']);
  unset($data['type']);
  unset($data['_links']);
  
  $response->set_data($data);
  return $response;
}
add_action('rest_api_init', function() {
  add_filter('rest_prepare_post', 'signlab_theme_clean_rest_response', 10, 3);
  add_filter('rest_prepare_page', 'signlab_theme_clean_rest_response', 10, 3);
});

add_action('rest_api_init', function () {
  add_filter('rest_prepare_post', 'add_acf_options_to_api', 10, 3);
  add_filter('rest_prepare_page', 'add_acf_options_to_api', 10, 3);
});

function add_acf_options_to_api($response, $post, $request) {
  $options = [
    'header_logo'   => get_field('header_logo', 'option'),
    'main_menu'   => get_field('main_menu', 'option'),
    'footer_logo'   => get_field('footer_logo', 'option'),
    'footer_banner'   => get_field('footer_banner', 'option'),
    'footer_phone'   => get_field('footer_phone', 'option'),
    'footer_email'   => get_field('footer_email', 'option'),
    'footer_address'   => get_field('footer_address', 'option'),
    'social_media_links'   => get_field('social_media_links', 'option'),
  ];
  // Append vào response
  $response->data['theme_options'] = $options;

  return $response;
}