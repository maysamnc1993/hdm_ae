<?php

/**
 * SVG Icon Helper Functions
 *
 * @package JThem
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Get SVG icon from sprite
 *
 * @param string $icon  Icon name (without extension)
 * @param string $class Additional CSS classes
 * @param array  $attrs Additional HTML attributes (e.g., ['style' => 'color: red'])
 * @return string SVG markup
 */
function get_svg_icon($icon, $class = '', $attrs = [])
{
    if (empty($icon)) {
        return '';
    }

    // Remove 'icon-' prefix if present
    $icon_name = str_replace('', '', $icon);

    // Define base class
    $class_names = 'icon icon-' . esc_attr($icon_name);
    if (!empty($class)) {
        $class_names .= ' ' . esc_attr($class);
    }

    // Build attributes string
    $attr_string = ' aria-hidden="true"';
    foreach ($attrs as $attr => $value) {
        $attr_string .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
    }

    // Get sprite path
    $file_path = '/src/images/sprite.svg';
    $sprite_path = get_template_directory_uri() . $file_path;

    // Return SVG markup
    return sprintf(
        '<svg class="%1$s"%2$s><use href="%3$s#%4$s"></use></svg>',
        $class_names,
        $attr_string,
        esc_url($sprite_path),
        esc_attr($icon_name)
    );
}

/**
 * Echo SVG icon from sprite
 *
 * @param string $icon  Icon name (without extension)
 * @param string $class Additional CSS classes
 * @param array  $attrs Additional HTML attributes
 */
function svg_icon($icon, $class = '', $attrs = [])
{
    echo get_svg_icon($icon, $class, $attrs);
}

/**
 * Get inline SVG from file (fallback or alternative)
 *
 * @param string $icon SVG file name (without extension)
 * @param string $class Additional CSS classes
 * @param array $attrs Additional HTML attributes
 * @return string SVG markup
 */
function get_inline_svg($icon, $class = '', $attrs = [])
{
    if (empty($icon)) {
        return '';
    }

    // Determine icon path
    $icon_path = get_template_directory() . '/src/images/svg/icons/' . $icon . '.svg';

    // Check if file exists
    if (!file_exists($icon_path)) {
        return '<!-- SVG icon not found: ' . esc_attr($icon) . ' -->';
    }

    // Read SVG content
    $svg_content = file_get_contents($icon_path);

    // Process SVG content to add classes and attributes
    $dom = new DOMDocument();
    @$dom->loadXML($svg_content); // Suppress warnings for malformed XML
    $svg = $dom->getElementsByTagName('svg')->item(0);

    if ($svg) {
        // Add classes
        $existing_class = $svg->getAttribute('class');
        $new_class = trim($existing_class . ' icon icon-' . esc_attr($icon) . ' ' . esc_attr($class));
        $svg->setAttribute('class', $new_class);

        // Add attributes
        $svg->setAttribute('aria-hidden', 'true');
        foreach ($attrs as $attr => $value) {
            $svg->setAttribute($attr, esc_attr($value));
        }

        // Remove any inline fill that might cause issues
        if ($svg->hasAttribute('fill')) {
            $svg->removeAttribute('fill');
        }

        // Return modified SVG
        return $dom->saveHTML($svg);
    }

    // Fallback if DOM manipulation fails
    return $svg_content;
}

/**
 * Echo inline SVG from file
 *
 * @param string $icon SVG file name (without extension)
 * @param string $class Additional CSS classes
 * @param array $attrs Additional HTML attributes
 */
function inline_svg($icon, $class = '', $attrs = [])
{
    echo get_inline_svg($icon, $class, $attrs);
}
