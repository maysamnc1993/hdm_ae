<?php
/**
 * FAQ Component
 *
 * A professional, reusable FAQ module for WordPress sites.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * JThem_FAQ Class
 * 
 * Handles the rendering and functionality of FAQ sections.
 */
class JThem_FAQ {
    
    /**
     * Default settings for the FAQ component
     * 
     * @var array
     */
    private $defaults = [
        'title' => 'سوالات متداول',
        'subtitle' => '',
        'items' => [],
        'container_class' => 'faq-container my-12',
        'accordion_type' => 'single', // 'single' or 'multiple'
        'icon_open' => 'plus',
        'icon_close' => 'minus',
        'animation' => true,
        'custom_id' => '',
    ];

    /**
     * FAQ settings after merging defaults with user provided options
     * 
     * @var array
     */
    private $settings = [];

    /**
     * Unique ID for this instance
     * 
     * @var string
     */
    private $instance_id;

    /**
     * Constructor
     * 
     * @param array $args The FAQ parameters
     */
    public function __construct($args = []) {
        $this->instance_id = uniqid('faq_');
        $this->settings = $this->parse_args($args, $this->defaults);
    }

    /**
     * Parse arguments with defaults (for non-WordPress context)
     * 
     * @param array $args Arguments
     * @param array $defaults Default values
     * @return array Merged arguments
     */
    private function parse_args($args, $defaults) {
        if (function_exists('wp_parse_args')) {
            return wp_parse_args($args, $defaults);
        }
        
        // Fallback implementation
        $result = $defaults;
        foreach ($args as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }

    /**
     * Escape attribute (for non-WordPress context)
     * 
     * @param string $text Text to escape
     * @return string Escaped text
     */
    private function esc_attr($text) {
        if (function_exists('esc_attr')) {
            return esc_attr($text);
        }
        
        // Fallback implementation
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escape HTML (for non-WordPress context)
     * 
     * @param string $text Text to escape
     * @return string Escaped text
     */
    private function esc_html($text) {
        if (function_exists('esc_html')) {
            return esc_html($text);
        }
        
        // Fallback implementation
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Format text with paragraphs (for non-WordPress context)
     * 
     * @param string $text Text to format
     * @return string Formatted text
     */
    private function wpautop($text) {
        if (function_exists('wpautop')) {
            return wpautop($text);
        }
        
        // Fallback implementation - very basic
        $text = trim($text);
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace("/\n\n+/", "\n\n", $text);
        $paragraphs = preg_split('/\n\s*\n/', $text, -1, PREG_SPLIT_NO_EMPTY);
        
        $text = '';
        foreach ($paragraphs as $p) {
            $text .= '<p>' . str_replace("\n", '<br />', trim($p)) . '</p>' . "\n";
        }
        
        return $text;
    }

    /**
     * Render the FAQ module
     * 
     * @return string The HTML output
     */
    public function render() {
        // Set a custom ID if provided, otherwise use the instance ID
        $container_id = !empty($this->settings['custom_id']) ? 
            $this->esc_attr($this->settings['custom_id']) : $this->instance_id;
            
        ob_start();
        
        // Include styles and scripts
        $this->enqueue_assets();
        
        // Container
        echo '<div id="' . $this->esc_attr($container_id) . '" class="' . $this->esc_attr($this->settings['container_class']) . '">';
        
        // Title section
        $this->render_header();
        
        // FAQ items
        $this->render_items();
        
        echo '</div>'; // End container
        
        return ob_get_clean();
    }

    /**
     * Render the FAQ header with title and subtitle
     */
    private function render_header() {
        if (!empty($this->settings['title']) || !empty($this->settings['subtitle'])) {
            echo '<div class="faq-header">';
            
            if (!empty($this->settings['title'])) {
                echo '<h2 class="text-3xl font-bold text-gray-800 mb-3">' . $this->esc_html($this->settings['title']) . '</h2>';
            }
            
            if (!empty($this->settings['subtitle'])) {
                echo '<p class="text-gray-600">' . $this->esc_html($this->settings['subtitle']) . '</p>';
            }
            
            echo '</div>';
        }
    }

    /**
     * Render the FAQ items
     */
    private function render_items() {
        if (empty($this->settings['items'])) {
            return;
        }
        
        // Determine if multiple panels can be open at once
        $data_attrs = $this->settings['accordion_type'] === 'multiple' ? 
            'data-allow-multiple="true"' : 'data-allow-multiple="false"';
        
        echo '<div class="faq-items space-y-4" ' . $data_attrs . '>';
        
        foreach ($this->settings['items'] as $index => $item) {
            $this->render_item($item, $index);
        }
        
        echo '</div>';
    }

    /**
     * Render a single FAQ item
     * 
     * @param array $item The FAQ item data
     * @param int $index The index of the item
     */
    private function render_item($item, $index) {
        $item_id = $this->instance_id . '_item_' . $index;
        $is_open = isset($item['is_open']) && $item['is_open'] ? 'true' : 'false';
        
        echo '<div class="faq-item " id="' . $this->esc_attr($item_id) . '">';
        
        // FAQ Question (header)
        echo '<button type="button" class="faq-question " 
            aria-expanded="' . $is_open . '" 
            aria-controls="' . $this->esc_attr($item_id) . '_content">';
        
        echo '<span>' . $this->esc_html($item['question']) . '</span>';
        
        // Toggle icons
        echo '<span class="faq-icon ">';
        echo $this->get_icon($is_open === 'true' ? $this->settings['icon_close'] : $this->settings['icon_open']);
        echo '</span>';
        
        echo '</button>';
        
        // FAQ Answer (content)
        $display = $is_open === 'true' ? 'block' : 'hidden';
        $max_height = $is_open === 'true' ? '1000px' : '0';
        
        echo '<div id="' . $this->esc_attr($item_id) . '_content" 
            class="faq-answer ' . $display . ' transition-all duration-300 ease-in-out overflow-hidden"
            style="max-height: ' . $max_height . ';">';
        
        echo '<div class="p-5 ">';
        echo $this->wpautop($item['answer']);
        echo '</div>';
        
        echo '</div>'; // End answer
        
        echo '</div>'; // End item
    }

    /**
     * Get the SVG icon markup
     * 
     * @param string $icon_type The icon type (plus, minus, etc.)
     * @return string The icon SVG markup
     */
    private function get_icon($icon_type) {
        switch ($icon_type) {
            case 'plus':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>';
            
            case 'minus':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>';
                
            case 'chevron-down':
                return '<svg class="icon icon-arrow-square-up" aria-hidden="true"><use href="https://hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-up"></use></svg>';
            
            case 'chevron-up':
                return '<svg class="icon icon-arrow-square-down" aria-hidden="true"><use href="https://hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-down"></use></svg>';
            
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>';
        }
    }

    /**
     * Include required styles and scripts
     */
    private function enqueue_assets() {
        // Check if we're in WordPress context
        // if (function_exists('wp_enqueue_style') && function_exists('wp_enqueue_script')) {
        //     // Enqueue through WordPress
        //     wp_enqueue_style('jthem-faq', get_template_directory_uri() . '/components/faq/faq-standalone.css', [], '1.0.1');
        //     wp_enqueue_script('jthem-faq', get_template_directory_uri() . '/components/faq/faq-standalone.js', [], '1.0.1', true);
        // } else {
        //     // Direct inclusion for non-WordPress context
        //     $theme_url = defined('THEME_URI') ? THEME_URI : '';
        //     $components_url = $theme_url . '/components';
            
        //     // Fall back to relative path if THEME_URI is not available
        //     if (empty($theme_url)) {
        //         $components_url = './components';
        //     }
            
        //     echo '<link rel="stylesheet" href="' . $components_url . '/faq/faq-standalone.css?v=1.0.1">';
        //     echo '<script src="' . $components_url . '/faq/faq-standalone.js?v=1.0.1" defer></script>';
        // }
    }
}

/**
 * Helper function to display an FAQ
 * 
 * @param array $args The FAQ parameters
 * @return void Echoes the FAQ HTML
 */
function jthem_faq($args = []) {
    $faq = new JThem_FAQ($args);
    echo $faq->render();
}

/**
 * Helper function to return an FAQ as a string
 * 
 * @param array $args The FAQ parameters
 * @return string The FAQ HTML
 */
function jthem_get_faq($args = []) {
    $faq = new JThem_FAQ($args);
    return $faq->render();
} 