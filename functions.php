<?php
/**
 * SignLab Theme functions and definitions
 *
 * @package SignLab_theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function signlab_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('menus');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'signlab-theme'),
        'footer' => __('Footer Menu', 'signlab-theme'),
    ));
    
    // Add support for custom background
    add_theme_support('custom-background');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'signlab_theme_setup');

/**
 * Enqueue scripts and styles
 */
function signlab_theme_scripts() {
    wp_enqueue_style('signlab-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'signlab_theme_scripts');

/**
 * Disable WordPress frontend for headless setup
 */
function signlab_theme_disable_frontend() {
    // Only disable frontend if not in admin or REST API
    if (!is_admin() && !defined('REST_REQUEST')) {
        // Redirect to admin or show maintenance message
        if (!current_user_can('edit_posts')) {
            wp_die(
                '<h1>Headless WordPress Backend</h1>
                <p>This WordPress installation is configured as a headless backend.</p>
                <p><a href="/wp-admin/">Go to Admin</a></p>',
                'Headless Backend',
                array('response' => 200)
            );
        }
    }
}
add_action('template_redirect', 'signlab_theme_disable_frontend');

/**
 * Include theme functions
 */
require_once get_template_directory() . '/includes/custom-post-types.php';
require_once get_template_directory() . '/includes/admin-functions.php';
require_once get_template_directory() . '/includes/api-functions.php'; 
require_once get_template_directory() . '/includes/functions.php';