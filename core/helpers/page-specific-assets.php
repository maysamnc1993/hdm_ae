<?php

/**
 * Page Specific Assets Helper
 *
 * @package Jtheme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Load specific assets (CSS/JS) for a given page template.
 *
 * @param string $template_name The name of the page template (e.g., 'about-us').
 */
function theme_load_page_assets($template_name)
{
    if (theme_is_production()) {
        $css_file = "assets/css/pages/{$template_name}.css";
        $js_file = "assets/js/pages/{$template_name}.js";

        // Check if page-specific CSS exists
        if (file_exists(JTHEME_DIR . '/' . $css_file)) {
            wp_enqueue_style(
                "theme-{$template_name}",
                JTHEME_URI . '/' . $css_file,
                [],
                JTHEME_VERSION
            );
        }

        // Check if page-specific JS exists
        if (file_exists(JTHEME_DIR . '/' . $js_file)) {
            wp_enqueue_script(
                "theme-{$template_name}",
                JTHEME_URI . '/' . $js_file,
                ['jquery'],
                JTHEME_VERSION,
                true // Load in the footer
            );
        }
    }
}

// Hook into WordPress to load assets for the current template
add_action('wp_enqueue_scripts', function () {
    if (is_page_template()) { // Adjust this condition as needed
        $template_name = get_page_template_slug(); // Get the current template name
        theme_load_page_assets($template_name);
    }
});

function theme_scripts($template_name)
{
    vite_enqueue_asset("src/scss/pages/{$template_name}.scss", 'css');
    vite_enqueue_asset("src/js/pages/{$template_name}.js", 'js');
}


// Only include the basic template processing if UltraAsset is not active
// This avoids conflicts between the two systems
if (!class_exists('UltraAsset')) {
    /**
     * Scans a template file for asset inclusion/exclusion comments and processes them
     * 
     * Comment format examples:
     * <!-- LOAD: style-name, another-style -->
     * <!-- UNLOAD: unnecessary-style -->
     * <!-- THEME_CSS: contact-us -->
     * <!-- THEME_JS: main -->
     * Or in PHP comments:
     * * THEME_CSS: contact-us 
     * * THEME_JS: main
     * * LOAD: contact-us, another-style
     * Or in DocBlock style:
     * @load contact-us
     * @unload main
     * 
     * @param string $template Path to the template file
     * @return string The original template path (unchanged)
     */
    function theme_process_template_assets($template)
    {
        if (!file_exists($template)) {
            return $template;
        }

        $content = file_get_contents($template);

        // Process HTML comments format
        // Look for LOAD comments
        if (preg_match('/<!--\s*LOAD:\s*([a-z0-9-,\s]+)\s*-->/i', $content, $matches)) {
            $assets_to_load = array_map('trim', explode(',', $matches[1]));
            foreach ($assets_to_load as $asset) {
                if (strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset)) {
                    wp_enqueue_script($asset);
                } else {
                    wp_enqueue_style($asset);
                }
            }
        }

        // Look for UNLOAD comments
        if (preg_match('/<!--\s*UNLOAD:\s*([a-z0-9-,\s]+)\s*-->/i', $content, $matches)) {
            $assets_to_unload = array_map('trim', explode(',', $matches[1]));
            foreach ($assets_to_unload as $asset) {
                if (strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset)) {
                    wp_dequeue_script($asset);
                } else {
                    wp_dequeue_style($asset);
                }
            }
        }

        // Look for THEME_CSS comments
        if (preg_match_all('/(?:<!--\s*THEME_CSS:\s*([a-z0-9-_]+)\s*-->|\*\s*THEME_CSS:\s*([a-z0-9-_]+))/i', $content, $matches)) {
            foreach ($matches[1] as $key => $css_name) {
                // If the first capture group is empty, use the second one (PHP comment format)
                if (empty($css_name) && !empty($matches[2][$key])) {
                    $css_name = $matches[2][$key];
                }

                if (!empty($css_name)) {
                    $css_file = "assets/css/pages/{$css_name}.css";
                    if (file_exists(JTHEME_DIR . '/' . $css_file)) {
                        wp_enqueue_style(
                            "theme-{$css_name}",
                            THEME_URI . '/' . $css_file,
                            array('bootstrap'),
                            THEME_VERSION
                        );
                    }
                }
            }
        }

        // Look for THEME_JS comments
        if (preg_match_all('/(?:<!--\s*THEME_JS:\s*([a-z0-9-_]+)\s*-->|\*\s*THEME_JS:\s*([a-z0-9-_]+))/i', $content, $matches)) {
            foreach ($matches[1] as $key => $js_name) {
                // If the first capture group is empty, use the second one (PHP comment format)
                if (empty($js_name) && !empty($matches[2][$key])) {
                    $js_name = $matches[2][$key];
                }

                if (!empty($js_name)) {
                    $js_file = "assets/js/pages/{$js_name}.js";
                    if (file_exists(JTHEME_DIR . '/' . $js_file)) {
                        wp_enqueue_script(
                            "theme-{$js_name}",
                            THEME_URI . '/' . $js_file,
                            array('jquery'),
                            THEME_VERSION,
                            true // Load in the footer
                        );
                    }
                }
            }
        }

        // Process PHP comments format
        // Look for LOAD in PHP comments
        if (preg_match('/\*\s*LOAD:\s*([a-z0-9-,\s]+)/i', $content, $matches)) {
            $assets_to_load = array_map('trim', explode(',', $matches[1]));
            foreach ($assets_to_load as $asset) {
                if (strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset)) {
                    wp_enqueue_script($asset);
                } else {
                    wp_enqueue_style($asset);
                }
            }
        }

        // DocBlock style processing (@load, @unload)
        if (preg_match_all('/@(load|unload)\s+([a-z0-9-_]+)/i', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $action = strtolower($match[1]);
                $asset = trim($match[2]);

                if ($action === 'load') {
                    if (strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset)) {
                        wp_enqueue_script($asset);
                    } else {
                        wp_enqueue_style($asset);
                    }
                } elseif ($action === 'unload') {
                    if (strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset)) {
                        wp_dequeue_script($asset);
                    } else {
                        wp_dequeue_style($asset);
                    }
                }
            }
        }

        return $template;
    }

    // Hook into WordPress to process template assets only if UltraAsset is not active
    add_filter('template_include', 'theme_process_template_assets', 99);
}
