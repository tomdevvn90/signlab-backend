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


// echo "<pre>";
// print_r(get_field('header_logo', 'option'));
// print_r(get_field('main_menu', 'option'));
// echo "</pre>";