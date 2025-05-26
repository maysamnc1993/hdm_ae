<?php
/**
 * Theme Configuration System
 * 
 * A centralized configuration management system that loads settings
 * from environment variables and provides a unified interface for
 * accessing theme configuration values.
 *
 * @package JThem
 * @since 1.0.0
 */

namespace JThem\Config;

use function \get_template_directory;

/**
 * ThemeConfig Class
 * 
 * Handles loading, processing, and accessing theme configuration.
 */
class ThemeConfig {
    /**
     * @var array Loaded configuration values
     */
    private static $config = [];
    
    /**
     * @var bool Whether environment variables have been loaded
     */
    private static $env_loaded = false;

    /**
     * Initialize theme configuration
     * 
     * Loads environment variables and sets up configuration array
     */
    public static function init() {
        // Load environment variables
        self::loadEnv();

        // Set up configuration
        self::$config = [
            'env' => self::env('JTHEM_DEV_MODE', 'production'),
            'debug' => self::env('THEME_DEBUG', false),
            'name' => self::env('THEME_NAME', 'JTheme'),
            'version' => self::env('THEME_VERSION', '1.0.0'),
            'vite' => [
                'server' => [
                    'host' => self::env('VITE_SERVER_HOST', 'localhost'),
                    'port' => self::env('VITE_SERVER_PORT', 3000),
                    'hmr' => [
                        'host' => self::env('VITE_HMR_HOST', 'localhost'),
                        'protocol' => self::env('VITE_HMR_PROTOCOL', 'ws'),
                    ],
                ],
            ],
            'wp' => [
                'home' => self::env('WP_HOME', ''),
                'content_url' => self::env('WP_CONTENT_URL', ''),
            ],
            'services' => [
                'ga_id' => self::env('GOOGLE_ANALYTICS_ID', ''),
                'gtm_id' => self::env('GOOGLE_TAG_MANAGER_ID', ''),
            ],
        ];

        // Define theme constants
        self::defineConstants();
    }

    /**
     * Load environment variables from .env file
     * 
     * Parses .env file and loads variables into environment,
     * handling comments and special character formatting.
     */
    private static function loadEnv() {
        // Only load once
        if (self::$env_loaded) {
            return;
        }
        
        $envFile = get_template_directory() . '/.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Skip comments and empty lines
                if (strpos($line, '#') === 0 || empty(trim($line))) {
                    continue;
                }
                
                // Split at the first equals sign (to handle values with = in them)
                $pos = strpos($line, '=');
                if ($pos === false) {
                    continue;
                }
                
                $key = trim(substr($line, 0, $pos));
                $value = trim(substr($line, $pos + 1));
                
                // Remove inline comments after the value
                if (strpos($value, ' #') !== false) {
                    $value = trim(substr($value, 0, strpos($value, ' #')));
                }
                
                // Remove quotes around values
                if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                    $value = $matches[2];
                }
                
                // Set environment variable
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
        
        self::$env_loaded = true;
    }

    /**
     * Get environment variable with fallback
     * 
     * @param string $key Variable name
     * @param mixed $default Default value if not found
     * @return mixed Value or default
     */
    public static function env($key, $default = null) {
        // Try $_ENV array first, then getenv() function
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }

    /**
     * Get configuration value using dot notation
     * 
     * @param string|null $key Configuration key in dot notation (e.g. 'vite.server.port')
     * @param mixed $default Default value if not found
     * @return mixed Configuration value or default
     */
    public static function get($key = null, $default = null) {
        // Ensure environment is loaded
        if (!self::$env_loaded) {
            self::loadEnv();
        }
        
        // Return entire config if no key provided
        if ($key === null) {
            return self::$config;
        }

        // Handle dot notation
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }

    /**
     * Define theme constants
     * 
     * Sets up global constants for the theme based on configuration
     */
    private static function defineConstants() {
        // Only define if not already defined
        if (!defined('JTHEM_VERSION')) {
            define('JTHEM_VERSION', self::get('version'));
        }
        
        if (!defined('JTHEM_DEV_MODE')) {
            define('JTHEM_DEV_MODE', self::get('env') === 'development');
        }
        
        if (!defined('JTHEM_DEBUG')) {
            define('JTHEM_DEBUG', self::get('debug'));
        }
        
        if (!defined('JTHEM_VITE_SERVER')) {
            define('JTHEM_VITE_SERVER', sprintf(
                'http://%s:%s',
                self::get('vite.server.host'),
                self::get('vite.server.port')
            ));
        }
    }
} 