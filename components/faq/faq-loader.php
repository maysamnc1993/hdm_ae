<?php
/**
 * FAQ Component Loader
 *
 * Loads all required files for the FAQ component.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Set up assets path
if (!defined('JTHEM_FAQ_URL')) {
    define('JTHEM_FAQ_URL', get_template_directory_uri() . '/components/faq');
}

// Load the core FAQ class
require_once dirname(__FILE__) . '/faq.php';

// Load the FAQ custom post type - load this first to ensure it's registered early
require_once dirname(__FILE__) . '/class-faq-post-type.php';

// Load the shortcode handler
require_once dirname(__FILE__) . '/faq-shortcode.php';

// Load admin interface only in admin area
if (is_admin()) {
    require_once dirname(__FILE__) . '/faq-admin.php';
}

/**
 * Initialize the FAQ component
 */
function jthem_init_faq_component() {
    // Enqueue frontend scripts and styles
    add_action('wp_enqueue_scripts', 'jthem_faq_enqueue_assets');
    
    // Flush rewrite rules once when needed - only do this once
    if (get_option('jthem_faq_flush_needed', false)) {
        add_action('init', function() {
            flush_rewrite_rules();
            update_option('jthem_faq_flush_needed', false);
        }, 20);
    }
}
add_action('after_setup_theme', 'jthem_init_faq_component');

/**
 * Enqueue the FAQ assets
 */
function jthem_faq_enqueue_assets() {
    // Only enqueue on pages with FAQ shortcode or template
    // if (is_singular() && has_shortcode(get_the_content(), 'jthem_faq')) {
    //     wp_enqueue_style('jthem-faq', JTHEM_FAQ_URL . '/faq-standalone.css', [], '1.0.1');
    //     wp_enqueue_script('jthem-faq', JTHEM_FAQ_URL . '/faq-standalone.js', [], '1.0.1', true);
    // }
}

/**
 * This function is run on theme activation to set up the FAQ post type
 */
function jthem_faq_activate() {
    // Make sure the post type is registered
    JThem_FAQ_Post_Type::get_instance();
    
    // Flag that we need to flush rewrite rules
    update_option('jthem_faq_flush_needed', true);
}
register_activation_hook(__FILE__, 'jthem_faq_activate');

/**
 * Debug function to check if FAQ post type is registered
 * Only shown to admins and only when debug parameter is present
 */
function jthem_debug_faq_post_type() {
    // Only show debug info to admins and when requested
    if (!current_user_can('manage_options') || !isset($_GET['debug_faq'])) {
        return;
    }
    
    echo '<div class="notice notice-info is-dismissible"><p><strong>FAQ Post Type Debug Info:</strong></p>';
    
    // Check if post type class exists
    echo '<p>FAQ Post Type Class exists: ' . (class_exists('JThem_FAQ_Post_Type') ? 'Yes' : 'No') . '</p>';
    
    // Check if post type is registered
    $post_types = get_post_types(['name' => 'jthem_faq'], 'objects');
    echo '<p>FAQ Post Type is registered: ' . (!empty($post_types) ? 'Yes' : 'No') . '</p>';
    
    if (!empty($post_types)) {
        $post_type = reset($post_types);
        echo '<p>Post Type Label: ' . esc_html($post_type->label) . '</p>';
        echo '<p>Post Type Public: ' . ($post_type->public ? 'Yes' : 'No') . '</p>';
        echo '<p>Post Type Show UI: ' . ($post_type->show_ui ? 'Yes' : 'No') . '</p>';
        echo '<p>Post Type Show in Menu: ' . ($post_type->show_in_menu ? 'Yes' : 'No') . '</p>';
    }
    
    // Check if taxonomy is registered
    $taxonomies = get_taxonomies(['name' => 'jthem_faq_category'], 'objects');
    echo '<p>FAQ Taxonomy is registered: ' . (!empty($taxonomies) ? 'Yes' : 'No') . '</p>';
    
    echo '</div>';
}
add_action('admin_notices', 'jthem_debug_faq_post_type');

/**
 * Add manual activation handler
 */
function jthem_manual_faq_activation() {
    // Only process for admin users
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Check if manual activation is requested
    if (isset($_GET['force_faq_activation'])) {
        // Make sure FAQ post type is initialized
        JThem_FAQ_Post_Type::get_instance();
        
        // Force flush rewrite rules
        flush_rewrite_rules();
        
        // Set notice
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success is-dismissible">';
            echo '<p><strong>FAQ Post Type:</strong> Manual activation completed. The FAQ post type should now be visible.</p>';
            echo '</div>';
        });
        
        // Redirect to remove the query parameter
        wp_redirect(remove_query_arg('force_faq_activation'));
        exit;
    }
}
add_action('admin_init', 'jthem_manual_faq_activation'); 