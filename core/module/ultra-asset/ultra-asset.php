<?php

/**
 * UltraAsset - Advanced WordPress Asset Management System
 * 
 * A comprehensive, high-performance asset management solution for WordPress themes
 * with intelligent dependency resolution, conditional loading, performance monitoring,
 * and advanced diagnostics.
 * @author Mohsen Hashempour
 * @version 1.0.1
 *
 * @usage:
 * @unload woocommerce-general, elementor-frontend
 * @theme_css about-page
 * @theme_js about-animations
 * @critical about-fold
 * @defer team-photos
 * @group gallery:load
 * @preload team-data
 */

class UltraAsset
{
    /** @var array Stores all extracted directives for the current template */
    private static $directives = [];

    /** @var array Processed asset stats for performance monitoring */
    private static $stats = [
        'enqueued' => 0,
        'dequeued' => 0,
        'inline' => 0,
        'critical' => 0,
        'defer' => 0,
        'async' => 0,
    ];

    /** @var array Asset groups for batch operations */
    private static $asset_groups = [];

    /** @var array Asset dependency map */
    private static $dependencies = [];

    /** @var bool Debug mode */
    private static $debug = false;

    /** @var array Critical CSS collected for this template */
    private static $critical_css = [];

    /** @var array Preloaded resources */
    private static $preloads = [];

    /** @var string Base cache key */
    private static $cache_key_base = '';

    /** @var int Cache expiration time in seconds */
    private static $cache_expiration = 86400; // 24 hours

    /**
     * Initialize the system
     */
    public static function init($debug = false)
    {
        self::$debug = $debug;
        self::$cache_key_base = 'ultraasset_' . md5(get_template() . '_' . get_stylesheet());

        // Load configuration
        self::load_config();

        // Configure default hook priority
        $priority = apply_filters('ultraasset_hook_priority', 999);

        // Set up core hooks
        add_filter('template_include', [__CLASS__, 'process_template'], $priority);
        add_action('wp_enqueue_scripts', [__CLASS__, 'process_assets'], $priority);
        //add_action('wp_footer', [__CLASS__, 'render_debug_panel'], 9999);
        add_action('wp_head', [__CLASS__, 'output_critical_css'], 1);
        add_action('wp_head', [__CLASS__, 'output_preload_tags'], 2);

        // Admin hooks
        if (is_admin()) {
            add_action('admin_menu', [__CLASS__, 'register_admin_page']);
            add_action('admin_init', [__CLASS__, 'handle_admin_actions']);
        }

        // Register uninstall hook
        register_deactivation_hook(__FILE__, [__CLASS__, 'clear_cache']);
    }

    /**
     * Register predefined asset groups and dependencies
     */
    private static function load_config()
    {
        // Default asset groups
        self::$asset_groups = apply_filters('ultraasset_groups', [
            'core' => ['jquery-core', 'jquery-migrate', 'wp-api', 'wp-embed'],
            'forms' => ['jquery-form', 'contact-form-7', 'wpcf7-recaptcha'],
            'gallery' => ['jquery-masonry', 'masonry', 'flexslider', 'photoswipe'],
            'comments' => ['comment-reply']
        ]);

        // Default asset dependencies
        self::$dependencies = apply_filters('ultraasset_dependencies', [
            'bootstrap' => ['jquery'],
            'slick-slider' => ['jquery'],
            'elementor-frontend' => ['jquery'],
            'wc-cart' => ['jquery', 'selectWoo']
        ]);
    }

    /**
     * Process the template file and extract asset directives
     */
    public static function process_template($template)
    {
        if (!file_exists($template)) {
            return $template;
        }

        // Try to get cached directives first
        $cache_key = self::$cache_key_base . '_' . md5($template);
        $cached = get_transient($cache_key);

        if (false !== $cached && !self::$debug) {
            self::$directives = $cached;
        } else {
            $content = file_get_contents($template);
            self::$directives = self::extract_directives($content);

            // Cache the extracted directives
            set_transient($cache_key, self::$directives, self::$cache_expiration);
        }

        // Add template info for debugging
        self::$directives['_template'] = [
            'path' => $template,
            'name' => basename($template),
            'type' => self::determine_template_type($template),
        ];

        return $template;
    }

    /**
     * Determine template type (single, archive, etc.)
     */
    private static function determine_template_type($template)
    {
        $basename = basename($template);

        if (strpos($basename, 'single') === 0) return 'single';
        if (strpos($basename, 'archive') === 0) return 'archive';
        if (strpos($basename, 'page') === 0) return 'page';
        if (strpos($basename, 'taxonomy') === 0) return 'taxonomy';
        if ($basename === 'index.php') return 'index';
        if ($basename === 'front-page.php') return 'front-page';
        if ($basename === 'home.php') return 'home';
        if ($basename === '404.php') return '404';
        if ($basename === 'search.php') return 'search';

        return 'other';
    }

    /**
     * Extract all directives from template content with improved pattern matching
     */
    private static function extract_directives($content)
    {
        $directives = [
            'load' => [],
            'unload' => [],
            'theme_css' => [],
            'theme_js' => [],
            'critical' => [],
            'preload' => [],
            'defer' => [],
            'async' => [],
            'group' => [],
            'inline' => [],
        ];

        // Enhanced pattern to match directives in HTML comments, PHP comments, and special DocBlock formats
        $pattern = '/' .
            // HTML comments style
            '<!--\s*(?P<html_type>LOAD|UNLOAD|THEME_CSS|THEME_JS|CRITICAL|PRELOAD|DEFER|ASYNC|GROUP|INLINE):\s*(?P<html_value>[^>]+?)-->|' .
            // PHP comments style
            '\/\*+\s*?\*?\s*(?P<php_type>LOAD|UNLOAD|THEME_CSS|THEME_JS|CRITICAL|PRELOAD|DEFER|ASYNC|GROUP|INLINE):\s*(?P<php_value>[^*]+?)\s*\*+\/|' .
            // DocBlock style
            '@(?P<doc_type>load|unload|theme_css|theme_js|critical|preload|defer|async|group|inline)\s+(?P<doc_value>[^\s*]+)' .
            '/i';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $type = strtolower(
                $match['html_type'] ??
                    $match['php_type'] ??
                    $match['doc_type'] ??
                    ''
            );

            $value = trim(
                $match['html_value'] ??
                    $match['php_value'] ??
                    $match['doc_value'] ??
                    ''
            );

            if (empty($type) || empty($value)) {
                continue;
            }

            switch ($type) {
                case 'load':
                case 'unload':
                case 'defer':
                case 'async':
                case 'preload':
                    $directives[$type] = array_merge(
                        $directives[$type],
                        array_map('trim', explode(',', $value))
                    );
                    break;

                case 'theme_css':
                case 'theme_js':
                case 'critical':
                case 'inline':
                    $directives[$type][] = $value;
                    break;

                case 'group':
                    list($group_name, $action) = array_pad(explode(':', $value, 2), 2, 'load');
                    $directives['group'][] = [
                        'name' => trim($group_name),
                        'action' => trim(strtolower($action))
                    ];
                    break;
            }
        }

        return $directives;
    }

    /**
     * Process all extracted directives
     */
    public static function process_assets()
    {
        if (empty(self::$directives)) {
            return;
        }

        // Early bailout for admin pages or AJAX requests
        if (is_admin() || wp_doing_ajax()) {
            return;
        }

        // Process groups first (they can contain multiple assets)
        if (!empty(self::$directives['group'])) {
            foreach (self::$directives['group'] as $group) {
                if (!isset(self::$asset_groups[$group['name']])) {
                    continue;
                }

                $assets = self::$asset_groups[$group['name']];
                $method = $group['action'] === 'unload' ? 'unload_asset' : 'load_asset';

                array_map([__CLASS__, $method], $assets);
            }
        }

        // Process individual unload directives (higher priority than load)
        if (!empty(self::$directives['unload'])) {
            array_map([__CLASS__, 'unload_asset'], array_unique(self::$directives['unload']));
        }

        // Process individual load directives
        if (!empty(self::$directives['load'])) {
            array_map([__CLASS__, 'load_asset'], array_unique(self::$directives['load']));
        }

        // Process defer directives
        if (!empty(self::$directives['defer'])) {
            array_map([__CLASS__, 'defer_script'], array_unique(self::$directives['defer']));
        }

        // Process async directives
        if (!empty(self::$directives['async'])) {
            array_map([__CLASS__, 'async_script'], array_unique(self::$directives['async']));
        }

        // Process preload directives
        if (!empty(self::$directives['preload'])) {
            array_map([__CLASS__, 'preload_asset'], array_unique(self::$directives['preload']));
        }

        // Process theme-specific assets
        if (!empty(self::$directives['theme_css'])) {
            array_map([__CLASS__, 'enqueue_theme_css'], array_unique(self::$directives['theme_css']));
        }

        if (!empty(self::$directives['theme_js'])) {
            array_map([__CLASS__, 'enqueue_theme_js'], array_unique(self::$directives['theme_js']));
        }

        // Process critical CSS
        if (!empty(self::$directives['critical'])) {
            array_map([__CLASS__, 'add_critical_css'], array_unique(self::$directives['critical']));
        }

        // Process inline assets
        if (!empty(self::$directives['inline'])) {
            array_map([__CLASS__, 'inline_asset'], array_unique(self::$directives['inline']));
        }
    }

    /**
     * Determine asset type with improved detection
     */
    private static function get_asset_type($handle)
    {
        global $wp_scripts, $wp_styles;

        // Check if it's already registered
        if (isset($wp_scripts->registered[$handle])) {
            return 'script';
        }

        if (isset($wp_styles->registered[$handle])) {
            return 'style';
        }

        // If not registered, try to determine from name
        if (preg_match('/\.(js|css)$/i', $handle, $matches)) {
            return $matches[1] === 'js' ? 'script' : 'style';
        }

        // Default guess based on naming convention
        if (strpos($handle, 'css') !== false || strpos($handle, 'style') !== false) {
            return 'style';
        }

        // Default to script
        return 'script';
    }

    /**
     * Load an asset
     */
    private static function load_asset($handle)
    {
        $type = self::get_asset_type($handle);
        $method = "wp_enqueue_{$type}";

        if (function_exists($method)) {
            // Check dependencies
            if (isset(self::$dependencies[$handle])) {
                foreach (self::$dependencies[$handle] as $dependency) {
                    self::load_asset($dependency);
                }
            }

            $method($handle);
            self::$stats['enqueued']++;

            // Log when in debug mode
            if (self::$debug) {
                self::log("Enqueued {$type}: {$handle}");
            }
        }
    }

    /**
     * Unload an asset
     */
    private static function unload_asset($handle)
    {
        $type = self::get_asset_type($handle);
        $method = "wp_dequeue_{$type}";

        if (function_exists($method)) {
            $method($handle);
            self::$stats['dequeued']++;

            // Also deregister to prevent other parts of the code from re-enqueueing
            $deregister_method = "wp_deregister_{$type}";
            if (function_exists($deregister_method)) {
                $deregister_method($handle);
            }

            // Log when in debug mode
            if (self::$debug) {
                self::log("Dequeued {$type}: {$handle}");
            }
        }
    }

    /**
     * Add defer attribute to script
     */
    private static function defer_script($handle)
    {
        add_filter('script_loader_tag', function ($tag, $script_handle) use ($handle) {
            if ($handle !== $script_handle) {
                return $tag;
            }

            // Don't add defer if already present
            if (strpos($tag, 'defer') !== false) {
                return $tag;
            }

            self::$stats['defer']++;
            return str_replace(' src', ' defer src', $tag);
        }, 10, 2);
    }

    /**
     * Add async attribute to script
     */
    private static function async_script($handle)
    {
        add_filter('script_loader_tag', function ($tag, $script_handle) use ($handle) {
            if ($handle !== $script_handle) {
                return $tag;
            }

            // Don't add async if already present
            if (strpos($tag, 'async') !== false) {
                return $tag;
            }

            self::$stats['async']++;
            return str_replace(' src', ' async src', $tag);
        }, 10, 2);
    }

    /**
     * Add preload directive for an asset
     */
    private static function preload_asset($handle)
    {
        $type = self::get_asset_type($handle);
        $as = $type === 'style' ? 'style' : 'script';

        global $wp_scripts, $wp_styles;
        $registry = $type === 'style' ? $wp_styles : $wp_scripts;

        if (isset($registry->registered[$handle])) {
            $src = $registry->registered[$handle]->src;

            // Convert relative URLs to absolute
            if (strpos($src, 'http') !== 0 && strpos($src, '//') !== 0) {
                $src = site_url($src);
            }

            self::$preloads[] = [
                'url' => $src,
                'as' => $as,
                'handle' => $handle
            ];
        }
    }

    /**
     * Output preload tags in head
     */
    public static function output_preload_tags()
    {
        foreach (self::$preloads as $preload) {
            echo '<link rel="preload" href="' . esc_url($preload['url']) . '" as="' . esc_attr($preload['as']) . '" crossorigin>' . PHP_EOL;
        }
    }

    /**
     * Enqueue theme CSS with optimization
     */
    private static function enqueue_theme_css($name)
    {
        $handle = "theme-{$name}";
        $theme_dir = trailingslashit(get_template_directory());
        $theme_uri = trailingslashit(get_template_directory_uri());

        // Check multiple possible locations
        $locations = [
            "assets/css/pages/{$name}.css",
            "assets/css/{$name}.css",
            "css/{$name}.css",
        ];

        foreach ($locations as $path) {
            $file_path = $theme_dir . $path;

            if (file_exists($file_path)) {
                // Get file modification time for versioning
                $ver = filemtime($file_path);

                // Determine dependencies
                $deps = apply_filters('ultraasset_css_deps', ['theme-global'], $name);

                wp_enqueue_style(
                    $handle,
                    $theme_uri . $path,
                    $deps,
                    $ver
                );

                self::$stats['enqueued']++;

                // Log when in debug mode
                if (self::$debug) {
                    self::log("Enqueued theme CSS: {$handle} from {$path}");
                }

                break;
            }
        }
    }

    /**
     * Enqueue theme JS with optimization
     */
    private static function enqueue_theme_js($name)
    {
        $handle = "theme-{$name}";
        $theme_dir = trailingslashit(get_template_directory());
        $theme_uri = trailingslashit(get_template_directory_uri());

        // Check multiple possible locations
        $locations = [
            "assets/js/pages/{$name}.js",
            "assets/js/{$name}.js",
            "js/{$name}.js",
        ];

        foreach ($locations as $path) {
            $file_path = $theme_dir . $path;

            if (file_exists($file_path)) {
                // Get file modification time for versioning
                $ver = filemtime($file_path);

                // Determine dependencies
                $deps = apply_filters('ultraasset_js_deps', ['jquery'], $name);

                wp_enqueue_script(
                    $handle,
                    $theme_uri . $path,
                    $deps,
                    $ver,
                    true // Load in footer for performance
                );

                self::$stats['enqueued']++;

                // Log when in debug mode
                if (self::$debug) {
                    self::log("Enqueued theme JS: {$handle} from {$path}");
                }

                break;
            }
        }
    }

    /**
     * Add critical CSS
     */
    private static function add_critical_css($name)
    {
        $theme_dir = trailingslashit(get_template_directory());

        // Check multiple possible locations
        $locations = [
            "assets/css/critical/{$name}.css",
            "assets/critical/{$name}.css",
            "critical/{$name}.css",
        ];

        foreach ($locations as $path) {
            $file_path = $theme_dir . $path;

            if (file_exists($file_path)) {
                $css = file_get_contents($file_path);
                self::$critical_css[] = $css;
                self::$stats['critical']++;

                // Log when in debug mode
                if (self::$debug) {
                    self::log("Added critical CSS: {$name} from {$path}");
                }

                break;
            }
        }
    }

    /**
     * Output critical CSS in head
     */
    public static function output_critical_css()
    {
        if (!empty(self::$critical_css)) {
            echo '<style id="ultraasset-critical-css">' . PHP_EOL;
            foreach (self::$critical_css as $css) {
                echo $css . PHP_EOL;
            }
            echo '</style>' . PHP_EOL;
        }
    }

    /**
     * Inline an asset instead of loading it as a separate file
     */
    private static function inline_asset($handle)
    {
        $type = self::get_asset_type($handle);

        global $wp_scripts, $wp_styles;
        $registry = $type === 'style' ? $wp_styles : $wp_scripts;

        if (isset($registry->registered[$handle])) {
            $src = $registry->registered[$handle]->src;
            $content = '';

            // Handle different URL formats
            if (strpos($src, 'http') === 0 || strpos($src, '//') === 0) {
                // External URL - try to get content via HTTP request
                $response = wp_remote_get($src);
                if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                    $content = wp_remote_retrieve_body($response);
                } else {
                    // Failed to retrieve content, skip inlining
                    self::log("Failed to retrieve content for {$handle} from {$src}");
                    return;
                }
            } else {
                // Local file
                $file_path = '';

                if (strpos($src, '/') === 0) {
                    // Absolute path from site root
                    $file_path = ABSPATH . ltrim($src, '/');
                } else {
                    // Relative path - check if it's relative to a plugin or theme
                    $file_path = WP_CONTENT_DIR . '/' . $src;

                    if (!file_exists($file_path)) {
                        // Try plugins directory
                        $file_path = WP_PLUGIN_DIR . '/' . $src;
                    }
                }

                if (file_exists($file_path)) {
                    $content = file_get_contents($file_path);
                } else {
                    self::log("File not found for {$handle}: {$file_path}");
                    return;
                }
            }

            if (!empty($content)) {
                if ($type === 'style') {
                    wp_dequeue_style($handle);
                    wp_deregister_style($handle);
                    wp_register_style($handle, false);
                    wp_enqueue_style($handle);
                    wp_add_inline_style($handle, $content);
                } else {
                    wp_dequeue_script($handle);
                    wp_deregister_script($handle);
                    wp_register_script($handle, false);
                    wp_enqueue_script($handle);
                    wp_add_inline_script($handle, $content);
                }

                self::$stats['inline']++;

                // Log when in debug mode
                if (self::$debug) {
                    self::log("Inlined {$type}: {$handle}");
                }
            }
        }
    }

    /**
     * Handle admin actions
     */
    public static function handle_admin_actions()
    {
        if (isset($_POST['ultraasset_clear_cache']) && check_admin_referer('ultraasset_clear_cache', 'ultraasset_nonce')) {
            self::clear_cache();
            add_action('admin_notices', function () {
                echo '<div class="notice notice-success is-dismissible"><p>UltraAsset cache cleared successfully!</p></div>';
            });
        }

        if (isset($_POST['ultraasset_toggle_debug']) && check_admin_referer('ultraasset_toggle_debug', 'ultraasset_nonce')) {
            $debug_mode = get_option('ultraasset_debug_mode', false);
            update_option('ultraasset_debug_mode', !$debug_mode);

            add_action('admin_notices', function () use ($debug_mode) {
                $status = !$debug_mode ? 'enabled' : 'disabled';
                echo '<div class="notice notice-success is-dismissible"><p>UltraAsset debug mode ' . $status . '!</p></div>';
            });
        }
    }

    /**
     * Render debug panel for administrators
     */
    public static function render_debug_panel()
    {
        if (!self::$debug || !current_user_can('manage_options')) {
            return;
        }

?>
        <div id="ultraasset-debug" style="color:black; position:fixed; bottom:20px; right:20px; background:#fff; border:1px solid #ccc; padding:15px; z-index:9999; max-width:400px; max-height:80vh; overflow:auto; box-shadow:0 0 10px rgba(0,0,0,0.1); font-size:12px; font-family:monospace;">
            <h3 style="margin:0 0 10px; font-size:14px;">UltraAsset Debug</h3>

            <div style="margin-bottom:10px;">
                <strong>Template:</strong> <?php echo esc_html(self::$directives['_template']['name']); ?><br>
                <strong>Type:</strong> <?php echo esc_html(self::$directives['_template']['type']); ?>
            </div>

            <div style="margin-bottom:10px;">
                <strong>Stats:</strong><br>
                <?php foreach (self::$stats as $key => $value): ?>
                    <?php echo esc_html(ucfirst($key)); ?>: <?php echo esc_html($value); ?><br>
                <?php endforeach; ?>
            </div>

            <?php if (!empty(self::$directives['load'])): ?>
                <div style="margin-bottom:10px;">
                    <strong>Loaded:</strong>
                    <ul style="margin:5px 0; padding-left:20px;">
                        <?php foreach (self::$directives['load'] as $handle): ?>
                            <li><?php echo esc_html($handle); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (!empty(self::$directives['unload'])): ?>
                <div style="margin-bottom:10px;">
                    <strong>Unloaded:</strong>
                    <ul style="margin:5px 0; padding-left:20px;">
                        <?php foreach (self::$directives['unload'] as $handle): ?>
                            <li><?php echo esc_html($handle); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div style="text-align:right; margin-top:10px;">
                <a href="#" onclick="document.getElementById('ultraasset-debug').style.display='none'; return false;" style="text-decoration:none; color:#999;">Close</a>
            </div>
        </div>
<?php
    }

    /**
     * Log a message (for debug mode)
     */
    private static function log($message)
    {
        if (!self::$debug) {
            return;
        }

        // Add to error log
        error_log('[UltraAsset] ' . $message);
    }

    /**
     * Clear asset cache
     */
    public static function clear_cache()
    {
        global $wpdb;

        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM $wpdb->options WHERE option_name LIKE %s",
                '_transient_' . self::$cache_key_base . '%'
            )
        );

        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM $wpdb->options WHERE option_name LIKE %s",
                '_transient_timeout_' . self::$cache_key_base . '%'
            )
        );
    }

    /**
     * Register admin page
     */
    public static function register_admin_page()
    {
        add_submenu_page(
            'tools.php',
            'UltraAsset Manager',
            'Asset Manager',
            'manage_options',
            'ultraasset-manager',
            [__CLASS__, 'render_admin_page']
        );
    }

    /**
     * Render admin page
     */
    public static function render_admin_page()
    {
        $debug_mode = get_option('ultraasset_debug_mode', false);

        // Admin UI code
        echo '<div class="wrap">';
        echo '<h1>UltraAsset Manager</h1>';
        echo '<p>Advanced asset management for WordPress themes.</p>';

        echo '<div class="card" style="max-width:800px; padding:20px; margin-bottom:20px;">';
        echo '<h2>Cache Management</h2>';

        // Add a button to clear cache
        echo '<form method="post" action="">';
        wp_nonce_field('ultraasset_clear_cache', 'ultraasset_nonce');
        echo '<p><input type="submit" name="ultraasset_clear_cache" class="button button-primary" value="Clear Asset Cache"></p>';
        echo '<p class="description">Clears all cached template directives to ensure fresh analysis of templates.</p>';
        echo '</form>';
        echo '</div>';

        echo '<div class="card" style="max-width:800px; padding:20px; margin-bottom:20px;">';
        echo '<h2>Debug Settings</h2>';

        // Add toggle for debug mode
        echo '<form method="post" action="">';
        wp_nonce_field('ultraasset_toggle_debug', 'ultraasset_nonce');
        echo '<p><input type="submit" name="ultraasset_toggle_debug" class="button button-secondary" value="' . ($debug_mode ? 'Disable' : 'Enable') . ' Debug Mode"></p>';
        echo '<p class="description">Current status: ' . ($debug_mode ? '<strong>Enabled</strong>' : 'Disabled') . '</p>';
        echo '<p class="description">When enabled, UltraAsset will show detailed information in the frontend for administrators and log additional data.</p>';
        echo '</form>';
        echo '</div>';

        echo '<div class="card" style="max-width:800px; padding:20px;">';
        echo '<h2>Usage Instructions</h2>';
        echo '<p>Add directives to your template files to control asset loading:</p>';

        echo '<pre style="background:#f4f4f4; padding:10px; overflow:auto;">
        /**
         * @unload woocommerce-general, elementor-frontend
         * @theme_css about-page
         * @theme_js about-animations
         * @critical about-fold
         * @defer team-photos
         * @group gallery:load
         * @preload team-data
         */</pre>';

        echo '<p><strong>Alternative formats:</strong> You can also use HTML comments or PHP block comments:</p>';

        echo '<pre style="background:#f4f4f4; padding:10px; overflow:auto;">
        <!-- UNLOAD: woocommerce-general, elementor-frontend -->
        <!-- THEME_CSS: about-page -->
        
        /* UNLOAD: woocommerce-general, elementor-frontend */
        /* THEME_CSS: about-page */</pre>';

        echo '</div>';

        echo '</div>';
    }
}

// Initialize with configurable debug mode
$debug_setting = get_option('ultraasset_debug_mode', WP_DEBUG);
UltraAsset::init($debug_setting);
