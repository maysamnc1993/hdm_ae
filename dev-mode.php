<?php
/**
 * Development Mode Toggle
 *
 * Include this file at the top of functions.php to force development mode.
 * This file makes it easy to switch between development and production modes.
 * 
 * HOW TO USE:
 * 1. For development: Add this line to the top of functions.php:
 *    require_once get_template_directory() . '/dev-mode.php';
 * 
 * 2. For production: Comment out or remove the require line.
 * 
 * @package JThem
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

// Force development mode constants
define('JTHEM_DEV_MODE', true);
define('JTHEM_VITE_SERVER', 'http://localhost:3000');

// Add a visual indicator in the admin bar
function jthem_dev_mode_indicator($wp_admin_bar) {
    $args = [
        'id'    => 'jthem-dev-mode',
        'title' => 'DEV MODE',
        'href'  => '#',
        'meta'  => [
            'class' => 'jthem-dev-mode-indicator',
            'title' => 'JTheme Theme is running in development mode'
        ]
    ];
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'jthem_dev_mode_indicator', 999);

// Add styling for the indicator
function jthem_dev_mode_indicator_css() {
    echo '
    <style>
        #wp-admin-bar-jthem-dev-mode {
            background-color: #FF5722 !important;
            color: white !important;
            animation: jthem-dev-pulse 2s infinite;
        }
        #wp-admin-bar-jthem-dev-mode .ab-item {
            color: white !important;
            font-weight: bold !important;
        }
        @keyframes jthem-dev-pulse {
            0% { background-color: #FF5722; }
            50% { background-color: #FF8A65; }
            100% { background-color: #FF5722; }
        }
    </style>
    ';
}
add_action('wp_head', 'jthem_dev_mode_indicator_css');
add_action('admin_head', 'jthem_dev_mode_indicator_css');

// Debug info
function jthem_dev_mode_debug() {
    echo "<!-- DEVELOPMENT MODE FORCED VIA dev-mode.php -->";
}
add_action('wp_head', 'jthem_dev_mode_debug'); 