<?php
/**
 * Component Loader
 *
 * Loads all components for the JTheme theme.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Load all component files
 */
function jthem_load_components() {
    // Define component loaders to include
    $component_loaders = [
        'faq/faq-loader.php',
        // Add other component loaders here as they are created
    ];
    
    // Loop through each component loader and include it
    foreach ($component_loaders as $loader) {
        $loader_file = get_template_directory() . '/components/' . $loader;
        
        if (file_exists($loader_file)) {
            require_once $loader_file;
        }
    }
}

// Load all components
//jthem_load_components(); 