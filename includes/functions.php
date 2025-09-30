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