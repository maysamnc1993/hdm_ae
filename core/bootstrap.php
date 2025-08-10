<?php

/**
 * JTheme Bootstrap
 *
 * Loads all core builder classes and functionality
 */

// Define the theme root path
if (!defined('JTHEME_DIR')) {
    define('JTHEME_DIR', dirname(__DIR__));
}

// Load core builder classes
require_once JTHEME_DIR . '/core/builders/class-wp-functions.php'; // Load first - trait
require_once JTHEME_DIR . '/core/builders/class-cpt-creator.php';
require_once JTHEME_DIR . '/core/builders/class-tx-create.php';
require_once JTHEME_DIR . '/core/builders/class-metabox-creator.php';
require_once JTHEME_DIR . '/core/builders/class-term-meta.php';
require_once JTHEME_DIR . '/core/helpers/options.php'; // Add this line to load the Options class

/**
 * Check if all required builder classes exist
 * 
 * @return bool
 */
function jtheme_check_builder_classes()
{
    $required_classes = [
        // 'JTheme\\Core\\WP_Functions',
        'JTheme\\CustomPostTypes\\CPT_Creator',
        'JTheme\\CustomPostTypes\\Taxonomy_Creator',
        'JTheme\\Builders\\Term_Meta',
        'JTheme\\Admin\\Metabox',
        //'Core\\Helpers\\Options',
    ];

    foreach ($required_classes as $class) {
        if (!class_exists($class)) {
            trigger_error("JTheme Error: Required class '{$class}' not found", E_USER_WARNING);
            return false;
        }
    }

    return true;
}

// Check if all required builder classes exist
jtheme_check_builder_classes();

/**
 * Auto-load all custom post type modules in the custom-post-types directory
 * 
 * This eliminates the need to manually include each custom post type file
 */
function jtheme_load_post_types()
{
    $cpt_directory = JTHEME_DIR . '/custom-post-types';

    // Check if directory exists
    if (!is_dir($cpt_directory)) {
        return;
    }

    // Get all PHP files in the directory
    $files = glob($cpt_directory . '/*.php');

    if (empty($files)) {
        return;
    }

    // Load each file
    foreach ($files as $file) {
        require_once $file;
    }
}

// Register a hook to load all post types during init
if (function_exists('add_action')) {
    add_action('after_setup_theme', 'jtheme_load_post_types');
} else {
    // Fallback for when WordPress functions aren't available yet
    jtheme_load_post_types();
}
