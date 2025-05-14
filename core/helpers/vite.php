<?php

/**
 * Vite Integration for WordPress
 * 
 * Handles asset loading for both development and production environments.
 * 
 * @package JThem
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Get Vite manifest file contents
 * 
 * @return array Manifest data as associative array
 */
function get_vite_manifest()
{
    static $manifest = null;
    if ($manifest === null) {
        $manifest_path = get_template_directory() . '/assets/.vite/manifest.json';
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $manifest = [];
        }
    }
    return $manifest;
}

/**
 * Get URL for a Vite asset
 * 
 * @param string $entry Entry point path
 * @return string URL for the asset
 */
function vite_get_asset_url($entry)
{
    if (defined('JTHEM_DEV_MODE') && JTHEM_DEV_MODE) {
        return JTHEM_VITE_SERVER . '/' . $entry;
    }

    $manifest = get_vite_manifest();

    if (isset($manifest[$entry])) {
        return get_template_directory_uri() . '/assets/' . $manifest[$entry]['file'];
    }

    return get_template_directory_uri() . '/assets/' . $entry;
}

/**
 * Enqueue a Vite asset including all its dependencies
 * 
 * @param string $entry Entry point path
 * @param string $type Asset type ('js' or 'css')
 */
function vite_enqueue_asset($entry, $type = 'js')
{
    // Development mode - load from dev server
    if (!theme_is_production()) {

        if ($type === 'js') {
            // Enqueue Vite client for HMR
            wp_enqueue_script(
                'vite-client',
                JTHEM_VITE_SERVER . '/@vite/client',
                [],
                null,
                true
            );

            // Enqueue the entry point
            wp_enqueue_script(
                'vite-' . sanitize_key($entry),
                JTHEM_VITE_SERVER . '/' . $entry,
                [],
                null,
                true
            );
        } else {
            wp_enqueue_style(
                'vite-' . sanitize_key($entry),
                JTHEM_VITE_SERVER . '/' . $entry,
                [],
                null
            );
        }
    }
    // Production mode - load from built assets
    else {
        $manifest = get_vite_manifest();

        if (isset($manifest[$entry])) {
            $url = get_template_directory_uri() . '/assets/' . $manifest[$entry]['file'];
            $version = wp_get_theme()->get('Version');

            if ($type === 'js') {
                wp_enqueue_script(
                    'vite-' . sanitize_key($entry),
                    $url,
                    [],
                    $version,
                    true
                );
            } else {
                wp_enqueue_style(
                    'vite-' . sanitize_key($entry),
                    $url,
                    [],
                    $version
                );
            }

            // Enqueue CSS dependencies in production
            if (isset($manifest[$entry]['css'])) {
                foreach ($manifest[$entry]['css'] as $css_file) {
                    wp_enqueue_style(
                        'vite-css-' . sanitize_key($css_file),
                        get_template_directory_uri() . '/assets/' . $css_file,
                        [],
                        $version
                    );
                }
            }

            // Enqueue imported JS dependencies in production
            if (isset($manifest[$entry]['imports'])) {
                foreach ($manifest[$entry]['imports'] as $import) {
                    if (isset($manifest[$import])) {
                        wp_enqueue_script(
                            'vite-import-' . sanitize_key($import),
                            get_template_directory_uri() . '/assets/' . $manifest[$import]['file'],
                            [],
                            $version,
                            true
                        );
                    }
                }
            }
        }
    }
}


/**
 * Configure script loading attributes for Vite
 */
function jthem_script_loader_tag($tag, $handle)
{
    // Add type="module" for all Vite JavaScript files regardless of mode
    if (str_starts_with($handle, 'vite') && strpos($tag, '.js') !== false) {
        return str_replace(' src', ' type="module" crossorigin src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'jthem_script_loader_tag', 10, 2);


/**
 * Admin-only debugging helper
 */
function jthem_debug_env()
{
    if (is_user_logged_in() && current_user_can('administrator')) {
        echo '<!-- ENV: ' . (JTHEM_DEV_MODE ? 'DEVELOPMENT' : 'PRODUCTION') . ' -->';
    }
}
add_action('wp_head', 'jthem_debug_env');
