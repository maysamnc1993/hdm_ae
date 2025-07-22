<?php

/**
 * Advanced Assets Management Helper
 *
 * A comprehensive solution for loading, managing, and optimizing CSS and JS assets
 * in WordPress themes with support for page-specific assets, template detection,
 * and declarative asset loading via comments.
 *
 * @package   JTheme
 * @author    JTheme Team
 * @version   1.0.0
 * @license   GPL-2.0+
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Assets Management Class
 */
class JTheme_Assets_Manager
{
    /**
     * Instance of this class
     *
     * @var JTheme_Assets_Manager
     */
    private static $instance = null;

    /**
     * Constants for asset types
     */
    const CSS = 'css';
    const JS = 'js';

    /**
     * Get instance of this class
     *
     * @return JTheme_Assets_Manager
     */
    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        // Initialize hooks
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks()
    {
        // Hook for page-specific assets
        add_action('wp_enqueue_scripts', array($this, 'load_template_assets'), 20);

        // Hook for processing template comments if UltraAsset isn't active
        if (!class_exists('UltraAsset')) {
            add_filter('template_include', array($this, 'process_template_assets'), 99);
        }
    }

    /**
     * Load page-specific assets based on template
     */
    public function load_template_assets()
    {
        // Only proceed if we're on a page template
        if (!is_page_template()) {
            return;
        }

        // $template_name = get_page_template_slug();

        // // Clean up template name to get just the basename without extension
        // $template_name = pathinfo($template_name, PATHINFO_FILENAME);

        // $this->load_page_assets($template_name);
    }

    /**
     * Load specific assets for a page template
     *
     * @param string $template_name The name of the page template (e.g., 'about-us')
     */
    public function load_page_assets($template_name)
    {
        if (empty($template_name)) {
            return;
        }

        $this->load_dev_assets($template_name);
    }

    /**
     * Load development assets using Vite
     *
     * @param string $template_name The template name
     */
    private function load_dev_assets($template_name)
    {
        // Check if vite_enqueue_asset function exists
        if (function_exists('vite_enqueue_asset')) {
            
            vite_enqueue_asset("src/scss/pages/{$template_name}.scss", self::CSS);
            vite_enqueue_asset("src/js/pages/{$template_name}.js", self::JS);
        }
    }

    /**
     * Load production assets
     *
     * @param string $template_name The template name
     */
    private function load_prod_assets($template_name)
    {
        $css_file = "assets/css/pages/{$template_name}.css";
        $js_file = "assets/js/pages/{$template_name}.js";

        // Check if page-specific CSS exists and enqueue it
        if (file_exists(JTHEME_DIR . '/' . $css_file)) {
            wp_enqueue_style(
                "jtheme-{$template_name}",
                JTHEME_URI . '/' . $css_file,
                array(),
                defined('JTHEME_VERSION') ? JTHEME_VERSION : '1.0.0'
            );
        }

        // Check if page-specific JS exists and enqueue it
        if (file_exists(JTHEME_DIR . '/' . $js_file)) {
            wp_enqueue_script(
                "jtheme-{$template_name}",
                JTHEME_URI . '/' . $js_file,
                array('jquery'),
                defined('JTHEME_VERSION') ? JTHEME_VERSION : '1.0.0',
                true // Load in footer
            );
        }
    }

    /**
     * Check if theme is in development mode
     *
     * @return boolean True if in development mode
     */
    private function is_development_mode()
    {
        // Check if there's a function defined for this
        if (function_exists('jtheme_is_development')) {
            return jtheme_is_development();
        }

        // Default: Check for the presence of common development constants or environment variables
        return (
            defined('WP_DEBUG') && WP_DEBUG ||
            defined('JTHEME_DEV') && JTHEME_DEV ||
            getenv('JTHEME_ENV') === 'development'
        );
    }

    /**
     * Process template assets from comments in template files
     *
     * @param string $template Path to the template file
     * @return string The original template path (unchanged)
     */
    public function process_template_assets($template)
    {
        if (!file_exists($template)) {
            return $template;
        }

        $content = file_get_contents($template);

        // Process HTML style comments (<!-- LOAD: ... -->)
        $this->process_html_comments($content);

        // Process PHP style comments (* LOAD: ... *)
        $this->process_php_comments($content);

        // Process DocBlock style comments (@load, @unload)
        $this->process_docblock_comments($content);

        return $template;
    }

    /**
     * Process HTML comments for asset directives
     *
     * @param string $content The template content
     */
    private function process_html_comments($content)
    {
        // Process LOAD comments
        if (preg_match('/<!--\s*LOAD:\s*([a-z0-9-,\s]+)\s*-->/i', $content, $matches)) {
            $this->handle_asset_list($matches[1], 'load');
        }

        // Process UNLOAD comments
        if (preg_match('/<!--\s*UNLOAD:\s*([a-z0-9-,\s]+)\s*-->/i', $content, $matches)) {
            $this->handle_asset_list($matches[1], 'unload');
        }

        // Process THEME_CSS comments
        if (preg_match_all('/<!--\s*THEME_CSS:\s*([a-z0-9-_]+)\s*-->/i', $content, $matches)) {
            foreach ($matches[1] as $css_name) {
                $this->load_theme_asset($css_name, self::CSS);
            }
        }

        // Process THEME_JS comments
        if (preg_match_all('/<!--\s*THEME_JS:\s*([a-z0-9-_]+)\s*-->/i', $content, $matches)) {
            foreach ($matches[1] as $js_name) {
                $this->load_theme_asset($js_name, self::JS);
            }
        }
    }

    /**
     * Process PHP comments for asset directives
     *
     * @param string $content The template content
     */
    private function process_php_comments($content)
    {
        // Process LOAD in PHP comments
        if (preg_match('/\*\s*LOAD:\s*([a-z0-9-,\s]+)/i', $content, $matches)) {
            $this->handle_asset_list($matches[1], 'load');
        }

        // Process UNLOAD in PHP comments
        if (preg_match('/\*\s*UNLOAD:\s*([a-z0-9-,\s]+)/i', $content, $matches)) {
            $this->handle_asset_list($matches[1], 'unload');
        }

        // Process THEME_CSS in PHP comments
        if (preg_match_all('/\*\s*THEME_CSS:\s*([a-z0-9-_]+)/i', $content, $matches)) {
            foreach ($matches[1] as $css_name) {
                $this->load_theme_asset($css_name, self::CSS);
            }
        }

        // Process THEME_JS in PHP comments
        if (preg_match_all('/\*\s*THEME_JS:\s*([a-z0-9-_]+)/i', $content, $matches)) {
            foreach ($matches[1] as $js_name) {
                $this->load_theme_asset($js_name, self::JS);
            }
        }
    }

    /**
     * Process DocBlock style comments for asset directives
     *
     * @param string $content The template content
     */
    private function process_docblock_comments($content)
    {
        if (preg_match_all('/@(load|unload)\s+([a-z0-9-_]+)/i', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $action = strtolower($match[1]);
                $asset = trim($match[2]);

                $this->handle_asset($asset, $action);
            }
        }
    }

    /**
     * Handle a list of assets
     *
     * @param string $assets_string Comma-separated list of assets
     * @param string $action Action to perform ('load' or 'unload')
     */
    private function handle_asset_list($assets_string, $action)
    {
        $assets = array_map('trim', explode(',', $assets_string));

        foreach ($assets as $asset) {
            if (!empty($asset)) {
                $this->handle_asset($asset, $action);
            }
        }
    }

    /**
     * Handle a single asset
     *
     * @param string $asset Asset handle or filename
     * @param string $action Action to perform ('load' or 'unload')
     */
    private function handle_asset($asset, $action)
    {
        // Determine if it's a JS file by extension or name pattern
        $is_js = strpos($asset, '.js') !== false || preg_match('/^[a-z0-9-_]+\.js$/i', $asset);

        if ($action === 'load') {
            if ($is_js) {
                wp_enqueue_script($asset);
            } else {
                wp_enqueue_style($asset);
            }
        } elseif ($action === 'unload') {
            if ($is_js) {
                wp_dequeue_script($asset);
            } else {
                wp_dequeue_style($asset);
            }
        }
    }

    /**
     * Load a theme asset (CSS or JS)
     *
     * @param string $name Asset name without extension
     * @param string $type Asset type (CSS or JS)
     */
    private function load_theme_asset($name, $type)
    {
        if (empty($name)) {
            return;
        }

        if ($type === self::CSS) {
            $file = "assets/css/pages/{$name}.css";
            if (file_exists(JTHEME_DIR . '/' . $file)) {
                wp_enqueue_style(
                    "jtheme-{$name}",
                    JTHEME_URI . '/' . $file,
                    defined('JTHEME_CSS_DEPS') ? JTHEME_CSS_DEPS : array(),
                    defined('JTHEME_VERSION') ? JTHEME_VERSION : '1.0.0'
                );
            }
        } elseif ($type === self::JS) {
            $file = "assets/js/pages/{$name}.js";
            if (file_exists(JTHEME_DIR . '/' . $file)) {
                wp_enqueue_script(
                    "jtheme-{$name}",
                    JTHEME_URI . '/' . $file,
                    defined('JTHEME_JS_DEPS') ? JTHEME_JS_DEPS : array('jquery'),
                    defined('JTHEME_VERSION') ? JTHEME_VERSION : '1.0.0',
                    true // Load in footer
                );
            }
        }
    }

    /**
     * Load an NPM package asset (CSS or JS) at end of document
     *
     * @param string $handle Unique handle for the asset
     * @param string $package_path Path to the asset within node_modules
     * @param string $type Asset type ('css' or 'js')
     * @param array $deps Dependencies array
     * @param string|null $version Version string or null
     * @param string $media Media attribute for CSS
     */
    public function load_npm_asset_last($handle, $package_path, $type = self::CSS, $deps = array(), $version = null, $media = 'all')
    {
        $src = get_stylesheet_directory_uri() . '/node_modules/' . ltrim($package_path, '/');

        if ($type === self::JS) {
            add_action('wp_footer', function () use ($handle, $src, $deps, $version) {
                wp_enqueue_script($handle, $src, $deps, $version, true);
            }, 9999);
        } else {
            add_action('wp_head', function () use ($handle, $src, $deps, $version, $media) {
                wp_enqueue_style($handle, $src, $deps, $version, $media);
            }, 9999);
        }
    }

    /**
     * Immediately load an asset
     *
     * @param string $handle Unique handle for the asset
     * @param string $path Path to the asset (relative or npm)
     * @param string $type Asset type ('css' or 'js')
     * @param string $source Source of the asset ('theme' or 'npm')
     * @param string $position Where to load ('head' or 'footer')
     * @param array $deps Dependencies array
     * @param string|null $version Version string or null
     * @param string $media Media attribute for CSS
     */
    public function load_asset_immediately($handle, $path, $type = self::CSS, $source = 'theme', $position = 'head', $deps = array(), $version = null, $media = 'all')
    {
        // Determine the source URL based on whether it's a theme asset or npm package
        if ($source === 'npm') {
            $src = get_stylesheet_directory_uri() . '/node_modules/' . ltrim($path, '/');
        } else {
            $src = get_stylesheet_directory_uri() . '/' . ltrim($path, '/');
        }

        // The callback that registers, enqueues, and prints the asset
        $callback = function () use ($handle, $src, $type, $deps, $version, $media) {
            if ($type === self::JS) {
                wp_register_script($handle, $src, $deps, $version, true);
                wp_enqueue_script($handle);
                wp_print_scripts($handle);
            } else {
                wp_register_style($handle, $src, $deps, $version, $media);
                wp_enqueue_style($handle);
                wp_print_styles($handle);
            }
        };

        // Attach to the appropriate hook
        if ($position === 'footer') {
            add_action('wp_footer', $callback, 9999);
        } else {
            add_action('wp_head', $callback, 9999);
        }
    }
}

// Initialize the Assets Manager
$jtheme_assets = JTheme_Assets_Manager::get_instance();

/**
 * Helper function to load page assets
 *
 * @param string $template_name The name of the page template
 */
function theme_scripts($template_name)
{
    JTheme_Assets_Manager::get_instance()->load_page_assets($template_name);
}

/**
 * Helper function to load NPM asset at the end of document
 *
 * @param string $handle Unique handle for the asset
 * @param string $package_path Path to the asset within node_modules
 * @param string $type Asset type ('css' or 'js')
 * @param array $deps Dependencies array
 * @param string|null $version Version string or null
 * @param string $media Media attribute for CSS
 */
function jtheme_load_npm_asset_last($handle, $package_path, $type = 'css', $deps = array(), $version = null, $media = 'all')
{
    JTheme_Assets_Manager::get_instance()->load_npm_asset_last($handle, $package_path, $type, $deps, $version, $media);
}

/**
 * Helper function to immediately load an asset
 *
 * @param string $handle Unique handle for the asset
 * @param string $path Path to the asset
 * @param string $type Asset type ('css' or 'js')
 * @param string $source Source of the asset ('theme' or 'npm')
 * @param string $position Where to load ('head' or 'footer')
 * @param array $deps Dependencies array
 * @param string|null $version Version string or null
 * @param string $media Media attribute for CSS
 */
function jtheme_load_asset_immediately($handle, $path, $type = 'css', $source = 'theme', $position = 'head', $deps = array(), $version = null, $media = 'all')
{
    JTheme_Assets_Manager::get_instance()->load_asset_immediately($handle, $path, $type, $source, $position, $deps, $version, $media);
}

// For backward compatibility
function load_npm_js_last($handle, $package_path, $deps = array(), $version = null)
{
    jtheme_load_npm_asset_last($handle, $package_path, 'js', $deps, $version);
}

function load_npm_css_last($handle, $package_path, $deps = array(), $version = null, $media = 'all')
{
    jtheme_load_npm_asset_last($handle, $package_path, 'css', $deps, $version, $media);
}

function load_npm_asset($handle, $package_path, $type = 'css', $deps = array(), $version = null, $media = 'all')
{
    jtheme_load_asset_immediately($handle, $package_path, $type, 'npm', 'head', $deps, $version, $media);
}

function enqueue_css_with_position($handle, $relative_path, $position = 'head', $deps = array(), $version = null, $media = 'all')
{
    jtheme_load_asset_immediately($handle, $relative_path, 'css', 'theme', $position, $deps, $version, $media);
}

function load_asset_immediately($handle, $relative_path, $type = 'css', $position = 'head', $deps = array(), $version = null, $media = 'all')
{
    jtheme_load_asset_immediately($handle, $relative_path, $type, 'theme', $position, $deps, $version, $media);
}
