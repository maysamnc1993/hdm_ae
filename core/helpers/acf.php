<?php

/**
 * Enhanced ACF Helper Functions
 *
 * A comprehensive collection of functions to make working with ACF easier in your WordPress theme
 *
 * @package     WordPress
 * @subpackage  ACF Helpers
 * @author      Improved by Claude
 * @version     2.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get ACF field value with fallback
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value if field is empty
 * @return mixed The field value or default
 */
function acf_get($field_name, $post_id = null, $default = '')
{
    if (!function_exists('get_field')) {
        return $default;
    }

    $post_id = $post_id ?: get_the_ID();
    $value = get_field($field_name, $post_id);

    return !empty($value) ? $value : $default;
}

/**
 * Get ACF image field and return array with various sizes
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $size The image size (optional)
 * @param array $sizes Array of additional sizes to include
 * @return array|string The image data or empty string
 */
function acf_image($field_name, $post_id = null, $size = 'full', $sizes = ['thumbnail', 'medium', 'large'])
{
    $image = acf_get($field_name, $post_id);

    if (empty($image)) {
        return '';
    }

    // If image is just the ID
    if (is_numeric($image)) {
        $image = [
            'ID' => $image,
            'id' => $image, // For compatibility
            'url' => wp_get_attachment_image_url($image, $size),
            'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
            'title' => get_the_title($image),
            'caption' => wp_get_attachment_caption($image),
            'description' => get_post_field('post_content', $image),
        ];
    }

    // Add different sizes if requested
    if (!empty($sizes) && isset($image['ID'])) {
        $image['sizes'] = [];
        foreach ($sizes as $img_size) {
            $size_data = wp_get_attachment_image_src($image['ID'], $img_size);
            $image['sizes'][$img_size] = [
                'url' => $size_data[0],
                'width' => $size_data[1],
                'height' => $size_data[2],
            ];
        }
    }

    // Add dimensions for the main image
    if (isset($image['ID'])) {
        $main_size = wp_get_attachment_image_src($image['ID'], $size);
        if ($main_size) {
            $image['width'] = $main_size[1];
            $image['height'] = $main_size[2];
        }
    }

    return $image;
}

/**
 * Get HTML img tag from ACF image field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $size The image size
 * @param array $attr Additional HTML attributes
 * @return string HTML img tag
 */
function acf_image_tag($field_name, $post_id = null, $size = 'full', $attr = [])
{
    $image = acf_image($field_name, $post_id, $size);

    if (empty($image)) {
        return '';
    }

    // If it's an array with ID
    if (isset($image['ID'])) {
        return wp_get_attachment_image($image['ID'], $size, false, $attr);
    }

    // Fallback for URLs
    if (isset($image['url'])) {
        $attributes = '';
        $default_attr = [
            'src' => $image['url'],
            'alt' => isset($image['alt']) ? $image['alt'] : '',
        ];

        $attr = array_merge($default_attr, $attr);

        foreach ($attr as $name => $value) {
            $attributes .= ' ' . $name . '="' . esc_attr($value) . '"';
        }

        return '<img' . $attributes . '>';
    }

    return '';
}

/**
 * Get ACF link field and ensure it has all properties
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return array Formatted link array
 */
function acf_link($field_name, $post_id = null)
{
    $link = acf_get($field_name, $post_id);

    if (empty($link)) {
        return [
            'url' => '',
            'title' => '',
            'target' => '',
            'aria-label' => '',
            'rel' => '',
        ];
    }

    // Ensure all properties exist
    $link['url'] = isset($link['url']) ? $link['url'] : '';
    $link['title'] = isset($link['title']) ? $link['title'] : '';
    $link['target'] = isset($link['target']) ? $link['target'] : '';
    $link['aria-label'] = isset($link['aria-label']) ? $link['aria-label'] : '';
    $link['rel'] = isset($link['rel']) ? $link['rel'] : '';

    // Add noopener noreferrer for external links
    if (!empty($link['target']) && $link['target'] === '_blank') {
        $link['rel'] = !empty($link['rel']) ? $link['rel'] . ' noopener noreferrer' : 'noopener noreferrer';
    }

    return $link;
}

/**
 * Render HTML anchor tag from ACF link field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param array $attr Additional HTML attributes
 * @param string $content Optional content to override link title
 * @return string HTML anchor tag
 */
function acf_link_tag($field_name, $post_id = null, $attr = [], $content = null)
{
    $link = acf_link($field_name, $post_id);

    if (empty($link['url'])) {
        return '';
    }

    $attributes = '';
    $default_attr = [
        'href' => $link['url'],
        'target' => $link['target'],
        'aria-label' => $link['aria-label'],
        'rel' => $link['rel'],
    ];

    // Filter out empty attributes
    $default_attr = array_filter($default_attr);

    $attr = array_merge($default_attr, $attr);

    foreach ($attr as $name => $value) {
        $attributes .= ' ' . $name . '="' . esc_attr($value) . '"';
    }

    $link_content = !is_null($content) ? $content : $link['title'];

    return '<a' . $attributes . '>' . $link_content . '</a>';
}

/**
 * Get ACF gallery field with enhanced image data
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $size The image size
 * @param array $sizes Additional sizes to include
 * @return array Array of images
 */
function acf_gallery($field_name, $post_id = null, $size = 'full', $sizes = [])
{
    $gallery = acf_get($field_name, $post_id);

    if (empty($gallery)) {
        return [];
    }

    $images = [];
    foreach ($gallery as $image) {
        if (is_numeric($image)) {
            $img_data = [
                'ID' => $image,
                'id' => $image, // For compatibility
                'url' => wp_get_attachment_image_url($image, $size),
                'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
                'title' => get_the_title($image),
                'caption' => wp_get_attachment_caption($image),
                'description' => get_post_field('post_content', $image),
            ];

            // Add sizes
            if (!empty($sizes)) {
                $img_data['sizes'] = [];
                foreach ($sizes as $img_size) {
                    $size_data = wp_get_attachment_image_src($image, $img_size);
                    $img_data['sizes'][$img_size] = [
                        'url' => $size_data[0],
                        'width' => $size_data[1],
                        'height' => $size_data[2],
                    ];
                }
            }

            // Add dimensions for the main image
            $main_size = wp_get_attachment_image_src($image, $size);
            if ($main_size) {
                $img_data['width'] = $main_size[1];
                $img_data['height'] = $main_size[2];
            }

            $images[] = $img_data;
        } else {
            $images[] = $image;
        }
    }

    return $images;
}

/**
 * Get a background style from an ACF image field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $size The image size
 * @param array $additional_styles Additional CSS properties
 * @return string The style attribute
 */
function acf_bg_style($field_name, $post_id = null, $size = 'full', $additional_styles = [])
{
    $image = acf_image($field_name, $post_id, $size);

    if (empty($image) || empty($image['url'])) {
        return '';
    }

    $style = "background-image: url('" . esc_url($image['url']) . "');";

    if (!empty($additional_styles)) {
        foreach ($additional_styles as $property => $value) {
            $style .= " $property: $value;";
        }
    }

    return 'style="' . $style . '"';
}

/**
 * Get inline CSS styles for responsive background images
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param array $breakpoints Breakpoints and image sizes
 * @return string CSS styles
 */
function acf_responsive_bg($field_name, $post_id = null, $breakpoints = [
    'desktop' => 'full',
    'tablet' => 'large',
    'mobile' => 'medium'
])
{
    $image = acf_image($field_name, $post_id, 'full', array_values($breakpoints));

    if (empty($image) || empty($image['url'])) {
        return '';
    }

    $default_media_queries = [
        'desktop' => '@media screen and (min-width: 1024px)',
        'tablet' => '@media screen and (min-width: 768px) and (max-width: 1023px)',
        'mobile' => '@media screen and (max-width: 767px)'
    ];

    $styles = '';
    $selector = '.bg-' . sanitize_title($field_name);

    foreach ($breakpoints as $device => $size) {
        $media_query = isset($default_media_queries[$device]) ? $default_media_queries[$device] : '';
        $img_url = isset($image['sizes'][$size]['url']) ? $image['sizes'][$size]['url'] : $image['url'];

        if (!empty($media_query)) {
            $styles .= $media_query . ' { ' . $selector . ' { background-image: url(' . esc_url($img_url) . '); } } ';
        } else {
            $styles .= $selector . ' { background-image: url(' . esc_url($img_url) . '); } ';
        }
    }

    return $styles;
}

/**
 * Check if flexible content field has a specific layout
 *
 * @param string $field_name The field name
 * @param string $layout_name The layout to check for
 * @param int|string $post_id The post ID (optional)
 * @return bool True if layout exists
 */
function acf_has_layout($field_name, $layout_name, $post_id = null)
{
    $layouts = acf_get($field_name, $post_id);

    if (empty($layouts)) {
        return false;
    }

    foreach ($layouts as $layout) {
        if ($layout['acf_fc_layout'] === $layout_name) {
            return true;
        }
    }

    return false;
}

/**
 * Format ACF date field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $format Date format (optional)
 * @param string $input_format Input date format (optional)
 * @return string Formatted date
 */
function acf_date($field_name, $post_id = null, $format = 'F j, Y', $input_format = '')
{
    $date = acf_get($field_name, $post_id);

    if (empty($date)) {
        return '';
    }

    // If specific input format provided
    if (!empty($input_format)) {
        $date_obj = DateTime::createFromFormat($input_format, $date);
        if ($date_obj) {
            return date_i18n($format, $date_obj->getTimestamp());
        }
    }

    return date_i18n($format, strtotime($date));
}

/**
 * Get relative date from ACF date field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return string Human-readable relative date
 */
function acf_relative_date($field_name, $post_id = null)
{
    $date = acf_get($field_name, $post_id);

    if (empty($date)) {
        return '';
    }

    $timestamp = strtotime($date);
    return human_time_diff($timestamp, current_time('timestamp')) . ' ' .
        ($timestamp > current_time('timestamp') ? __('from now', 'text-domain') : __('ago', 'text-domain'));
}

/**
 * Get options page field
 *
 * @param string $field_name The field name
 * @param mixed $default Default value
 * @return mixed Field value
 */
function acf_option($field_name, $default = '')
{
    return acf_get($field_name, 'option', $default);
}

/**
 * Render ACF blocks easily
 *
 * @param string $field_name The flexible content field name
 * @param int|string $post_id The post ID (optional)
 * @param string $template_path Path to templates (optional)
 * @param array $context Additional context variables
 */
function acf_render_blocks($field_name, $post_id = null, $template_path = 'template-parts/acf-blocks/', $context = [])
{
    $layouts = acf_get($field_name, $post_id);

    if (empty($layouts)) {
        return;
    }

    foreach ($layouts as $index => $layout) {
        $layout_name = $layout['acf_fc_layout'];
        $template_file = locate_template($template_path . $layout_name . '.php');

        if ($template_file) {
            // Add context variables
            $block_context = array_merge($layout, [
                'block_index' => $index,
                'block_count' => count($layouts),
                'is_first_block' => $index === 0,
                'is_last_block' => $index === (count($layouts) - 1),
            ], $context);

            // Extract variables to make them available in the template
            extract($block_context);

            include $template_file;
        }
    }
}

/**
 * Get ACF true/false field as boolean
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $default Default value
 * @return bool Boolean value
 */
function acf_bool($field_name, $post_id = null, $default = false)
{
    $value = acf_get($field_name, $post_id, $default);
    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
}

/**
 * Get ACF checkbox field values
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $glue Join multiple values with this string
 * @return string|array Checkbox values
 */
function acf_checkbox($field_name, $post_id = null, $glue = null)
{
    $values = acf_get($field_name, $post_id, []);

    if (empty($values)) {
        return is_null($glue) ? [] : '';
    }

    return is_null($glue) ? $values : implode($glue, $values);
}

/**
 * Get ACF select field value
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed Select value
 */
function acf_select($field_name, $post_id = null, $default = '')
{
    return acf_get($field_name, $post_id, $default);
}

/**
 * Get ACF post object or relationship field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $single Return single post or array
 * @return WP_Post|array|null Post object(s)
 */
function acf_posts($field_name, $post_id = null, $single = false)
{
    $posts = acf_get($field_name, $post_id);

    if (empty($posts)) {
        return $single ? null : [];
    }

    // If already a single post object
    if (is_object($posts) && $posts instanceof WP_Post) {
        return $posts;
    }

    // If array of post IDs
    if (is_array($posts) && isset($posts[0]) && is_numeric($posts[0])) {
        $post_objects = array_map('get_post', $posts);
        return $single ? reset($post_objects) : $post_objects;
    }

    // If single post ID
    if (is_numeric($posts)) {
        return get_post($posts);
    }

    return $single ? reset($posts) : $posts;
}

/**
 * Get ACF taxonomy field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $single Return single term or array
 * @return WP_Term|array|null Term object(s)
 */
function acf_terms($field_name, $post_id = null, $single = false)
{
    $terms = acf_get($field_name, $post_id);

    if (empty($terms)) {
        return $single ? null : [];
    }

    // If already a single term object
    if (is_object($terms) && $terms instanceof WP_Term) {
        return $terms;
    }

    // If array of term IDs
    if (is_array($terms) && isset($terms[0]) && is_numeric($terms[0])) {
        $term_objects = array_map(function ($term_id) {
            return get_term($term_id);
        }, $terms);
        return $single ? reset($term_objects) : $term_objects;
    }

    // If single term ID
    if (is_numeric($terms)) {
        return get_term($terms);
    }

    return $single ? reset($terms) : $terms;
}

/**
 * Get ACF user field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $single Return single user or array
 * @return WP_User|array|null User object(s)
 */
function acf_users($field_name, $post_id = null, $single = false)
{
    $users = acf_get($field_name, $post_id);

    if (empty($users)) {
        return $single ? null : [];
    }

    // If already a single user object
    if (is_object($users) && $users instanceof WP_User) {
        return $users;
    }

    // If array of user IDs
    if (is_array($users) && isset($users[0]) && is_numeric($users[0])) {
        $user_objects = array_map('get_user_by', array_fill(0, count($users), 'id'), $users);
        return $single ? reset($user_objects) : $user_objects;
    }

    // If single user ID
    if (is_numeric($users)) {
        return get_user_by('id', $users);
    }

    return $single ? reset($users) : $users;
}

/**
 * Get ACF file field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return array File data
 */
function acf_file($field_name, $post_id = null)
{
    $file = acf_get($field_name, $post_id);

    if (empty($file)) {
        return [];
    }

    // If file is just the ID
    if (is_numeric($file)) {
        $file = [
            'ID' => $file,
            'id' => $file,
            'url' => wp_get_attachment_url($file),
            'title' => get_the_title($file),
            'filename' => basename(get_attached_file($file)),
            'filesize' => filesize(get_attached_file($file)),
            'mime_type' => get_post_mime_type($file),
        ];
    }

    return $file;
}

/**
 * Get formatted attributes for HTML elements
 *
 * @param array $attributes Key-value pairs of attributes
 * @return string Formatted attributes string
 */
function acf_html_attrs($attributes)
{
    $html = '';

    foreach ($attributes as $key => $value) {
        if (is_bool($value) && $value) {
            $html .= ' ' . esc_attr($key);
        } elseif (!is_bool($value)) {
            $html .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
    }

    return $html;
}

/**
 * Get ACF color picker value
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $default Default color
 * @return string Color value
 */
function acf_color($field_name, $post_id = null, $default = '')
{
    return acf_get($field_name, $post_id, $default);
}

/**
 * Get ACF WYSIWYG field with proper formatting
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $apply_filters Whether to apply WordPress filters
 * @return string Formatted content
 */
function acf_wysiwyg($field_name, $post_id = null, $apply_filters = true)
{
    $content = acf_get($field_name, $post_id, '');

    if (empty($content)) {
        return '';
    }

    if ($apply_filters) {
        return apply_filters('the_content', $content);
    }

    return wpautop($content);
}

/**
 * Debug ACF field (outputs formatted value)
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $die Whether to die after output
 */
function acf_debuger($field_name, $post_id = null, $die = true)
{
    $value = acf_get($field_name, $post_id);

    echo '<pre>';
    print_r($value);
    echo '</pre>';

    if ($die) {
        die();
    }
}

/**
 * Get ACF repeater field values
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param callable $callback Optional callback for each row
 * @return array Processed repeater values
 */
function acf_repeater($field_name, $post_id = null, $callback = null)
{
    $rows = acf_get($field_name, $post_id, []);

    if (empty($rows)) {
        return [];
    }

    if (is_callable($callback)) {
        $processed_rows = [];
        foreach ($rows as $index => $row) {
            $processed_rows[] = call_user_func_array($callback, [$row, $index]);
        }
        return $processed_rows;
    }

    return $rows;
}

/**
 * Get nested ACF field from repeater or group
 *
 * @param string $parent_field Parent field name
 * @param string $sub_field Sub field name
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed Field value
 */
function acf_sub_field($parent_field, $sub_field, $post_id = null, $default = '')
{
    $parent = acf_get($parent_field, $post_id);

    if (empty($parent) || !isset($parent[$sub_field])) {
        return $default;
    }

    return $parent[$sub_field];
}

/**
 * Get text field with appropriate escaping
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $default Default text
 * @param string $context Escaping context (html, attr, js, url, etc.)
 * @return string Escaped text
 */
function acf_text($field_name, $post_id = null, $default = '', $context = 'html')
{
    $text = acf_get($field_name, $post_id, $default);

    switch ($context) {
        case 'html':
            return esc_html($text);
        case 'attr':
            return esc_attr($text);
        case 'js':
            return esc_js($text);
        case 'url':
            return esc_url($text);
        case 'textarea':
            return esc_textarea($text);
        case 'kses':
            return wp_kses_post($text);
        default:
            return $text;
    }
}

/**
 * Check if ACF field exists and has a value
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return bool True if field exists and has value
 */
function acf_has_value($field_name, $post_id = null)
{
    if (!function_exists('get_field')) {
        return false;
    }

    $post_id = $post_id ?: get_the_ID();
    $value = get_field($field_name, $post_id);

    return !empty($value);
}

/**
 * Get meta data for ACF image field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return array EXIF and other meta data
 */
function acf_image_meta($field_name, $post_id = null)
{
    $image = acf_image($field_name, $post_id);

    if (empty($image) || !isset($image['ID'])) {
        return [];
    }

    $metadata = wp_get_attachment_metadata($image['ID']);
    $exif_data = isset($metadata['image_meta']) ? $metadata['image_meta'] : [];

    return array_merge($image, ['meta' => $exif_data]);
}

/**
 * Get Google Maps data from ACF map field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return array Map data
 */
function acf_map($field_name, $post_id = null)
{
    $map = acf_get($field_name, $post_id);

    if (empty($map)) {
        return [
            'address' => '',
            'lat' => 0,
            'lng' => 0,
            'zoom' => 12,
        ];
    }

    // Ensure all properties exist
    $map['address'] = isset($map['address']) ? $map['address'] : '';
    $map['lat'] = isset($map['lat']) ? $map['lat'] : 0;
    $map['lng'] = isset($map['lng']) ? $map['lng'] : 0;
    $map['zoom'] = isset($map['zoom']) ? $map['zoom'] : 12;
    $map['static_url'] = 'https://maps.googleapis.com/maps/api/staticmap?center=' .
        $map['lat'] . ',' . $map['lng'] . '&zoom=' . $map['zoom'] .
        '&size=600x400&markers=color:red|' . $map['lat'] . ',' . $map['lng'];

    return $map;
}

/**
 * Get field from parent page (if current page is a child)
 *
 * @param string $field_name The field name
 * @param mixed $default Default value
 * @return mixed Field value from parent
 */
function acf_parent($field_name, $default = '')
{
    $post_id = get_the_ID();
    $parent_id = wp_get_post_parent_id($post_id);

    if (!$parent_id) {
        return $default;
    }

    return acf_get($field_name, $parent_id, $default);
}

/**
 * 
 * Convert fields to CSS variables
 *
 * @param array $fields Array of field names and CSS variable names
 * @param int|string $post_id The post ID (optional)
 * @return string CSS custom properties
 */
function acf_css_vars($fields, $post_id = null)
{
    if (empty($fields) || !is_array($fields)) {
        return '';
    }

    $css = '';
    foreach ($fields as $field_name => $var_name) {
        $value = acf_get($field_name, $post_id, '');
        if (!empty($value)) {
            $css .= '--' . $var_name . ': ' . $value . '; ';
        }
    }

    return !empty($css) ? 'style="' . esc_attr($css) . '"' : '';
}

/**
 * Get YouTube video ID from ACF field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return string YouTube video ID
 */
function acf_youtube_id($field_name, $post_id = null)
{
    $url = acf_get($field_name, $post_id, '');

    if (empty($url)) {
        return '';
    }

    preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/', $url, $matches);
    return isset($matches[7]) ? $matches[7] : '';
}

/**
 * Get Vimeo video ID from ACF field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return string Vimeo video ID
 */
function acf_vimeo_id($field_name, $post_id = null)
{
    $url = acf_get($field_name, $post_id, '');

    if (empty($url)) {
        return '';
    }

    preg_match('/^.*(vimeo\.com\/)((channels\/[a-z0-9]+\/)|(groups\/[a-z0-9]+\/videos\/))?([0-9]+)/', $url, $matches);
    return isset($matches[5]) ? $matches[5] : '';
}

/**
 * Generate responsive background image CSS
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param array $breakpoints Array of breakpoints and sizes
 * @param string $selector CSS selector
 * @return string CSS for responsive backgrounds
 */
function acf_responsive_bg_css($field_name, $post_id = null, $breakpoints = [], $selector = '')
{
    $image = acf_image($field_name, $post_id);

    if (empty($image) || empty($image['url'])) {
        return '';
    }

    if (empty($selector)) {
        $selector = '.bg-' . sanitize_title($field_name);
    }

    // Default breakpoints if not provided
    if (empty($breakpoints)) {
        $breakpoints = [
            [
                'size' => 'full',
                'media' => '(min-width: 1024px)'
            ],
            [
                'size' => 'large',
                'media' => '(min-width: 768px) and (max-width: 1023px)'
            ],
            [
                'size' => 'medium',
                'media' => '(max-width: 767px)'
            ]
        ];
    }

    // Build CSS
    $css = '';
    foreach ($breakpoints as $breakpoint) {
        $url = isset($image['sizes'][$breakpoint['size']]) ?
            $image['sizes'][$breakpoint['size']]['url'] :
            $image['url'];

        if (!empty($breakpoint['media'])) {
            $css .= '@media ' . $breakpoint['media'] . ' { ' . $selector . ' { background-image: url(' . esc_url($url) . '); } } ';
        } else {
            $css .= $selector . ' { background-image: url(' . esc_url($url) . '); } ';
        }
    }

    return $css;
}

/**
 * Get ACF fields with wildcard pattern
 *
 * @param string $pattern Field pattern with wildcard (*)
 * @param int|string $post_id The post ID (optional)
 * @return array Matched fields
 */
function acf_get_pattern($pattern, $post_id = null)
{
    $post_id = $post_id ?: get_the_ID();
    $fields = get_fields($post_id);

    if (empty($fields)) {
        return [];
    }

    $result = [];
    $regex = '/^' . str_replace('*', '.*', $pattern) . '$/';

    foreach ($fields as $key => $value) {
        if (preg_match($regex, $key)) {
            $result[$key] = $value;
        }
    }

    return $result;
}

/**
 * Get social media URLs from ACF fields
 *
 * @param array $field_names Field names for social media URLs
 * @param int|string $post_id The post ID (optional)
 * @return array Social media URLs
 */
function acf_social_media($field_names = [], $post_id = null)
{
    $defaults = [
        'facebook' => 'facebook_url',
        'twitter' => 'twitter_url',
        'instagram' => 'instagram_url',
        'linkedin' => 'linkedin_url',
        'youtube' => 'youtube_url',
        'pinterest' => 'pinterest_url',
        'tiktok' => 'tiktok_url',
    ];

    $fields = !empty($field_names) ? $field_names : $defaults;
    $result = [];

    foreach ($fields as $platform => $field_name) {
        $url = acf_get($field_name, $post_id);
        if (!empty($url)) {
            $result[$platform] = $url;
        }
    }

    return $result;
}

/**
 * Generate social media links
 *
 * @param array $field_names Field names for social media URLs
 * @param int|string $post_id The post ID (optional)
 * @param array $classes CSS classes for links
 * @return string HTML for social media links
 */
function acf_social_links($field_names = [], $post_id = null, $classes = [])
{
    $social_media = acf_social_media($field_names, $post_id);

    if (empty($social_media)) {
        return '';
    }

    $output = '<ul class="' . esc_attr($classes['list'] ?? 'social-links') . '">';

    foreach ($social_media as $platform => $url) {
        $output .= '<li class="' . esc_attr($classes['item'] ?? 'social-item') . '">';
        $output .= '<a href="' . esc_url($url) . '" class="' . esc_attr($classes['link'] ?? 'social-link') . ' ' . esc_attr($platform) . '" target="_blank" rel="noopener noreferrer">';
        $output .= '<span class="' . esc_attr($classes['icon'] ?? 'social-icon') . ' ' . esc_attr($platform) . '-icon"></span>';
        $output .= '<span class="' . esc_attr($classes['text'] ?? 'sr-only') . '">' . esc_html(ucfirst($platform)) . '</span>';
        $output .= '</a>';
        $output .= '</li>';
    }

    $output .= '</ul>';

    return $output;
}

/**
 * Get time values from ACF time picker
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $format Time format
 * @return string|array Formatted time
 */
function acf_time($field_name, $post_id = null, $format = 'g:i a')
{
    $time = acf_get($field_name, $post_id);

    if (empty($time)) {
        return '';
    }

    // If we need to parse a specific format
    if (strpos($time, ':') !== false) {
        return date($format, strtotime($time));
    }

    return $time;
}

/**
 * Get ACF field and convert to JSON
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $pretty Pretty print
 * @return string JSON string
 */
function acf_json($field_name, $post_id = null, $pretty = false)
{
    $value = acf_get($field_name, $post_id);

    if (empty($value)) {
        return '{}';
    }

    $options = $pretty ? JSON_PRETTY_PRINT : 0;
    return wp_json_encode($value, $options);
}

/**
 * Convert ACF fields to JSON-LD schema
 *
 * @param string $schema_type Type of schema
 * @param array $field_mapping Field mapping
 * @param int|string $post_id The post ID (optional)
 * @return string JSON-LD script tag
 */
function acf_schema($schema_type, $field_mapping, $post_id = null)
{
    $post_id = $post_id ?: get_the_ID();

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => $schema_type
    ];

    foreach ($field_mapping as $schema_key => $field_name) {
        $value = acf_get($field_name, $post_id);
        if (!empty($value)) {
            $schema[$schema_key] = $value;
        }
    }

    $json = wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    return '<script type="application/ld+json">' . $json . '</script>';
}

/**
 * Get first populated field from a list of fields
 *
 * @param array $field_names List of field names
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed First non-empty field value
 */
function acf_first_populated($field_names, $post_id = null, $default = '')
{
    foreach ($field_names as $field_name) {
        $value = acf_get($field_name, $post_id);
        if (!empty($value)) {
            return $value;
        }
    }

    return $default;
}

/**
 * Get text with character limit
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param int $limit Character limit
 * @param string $more Read more text
 * @return string Limited text
 */
function acf_text_limit($field_name, $post_id = null, $limit = 100, $more = '...')
{
    $text = acf_get($field_name, $post_id, '');

    if (empty($text)) {
        return '';
    }

    if (strlen($text) <= $limit) {
        return $text;
    }

    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));

    return $text . $more;
}

/**
 * Get ACF field and use as wp_query args
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param array $default_args Default query args
 * @return WP_Query Query results
 */
function acf_query($field_name, $post_id = null, $default_args = [])
{
    $args = acf_get($field_name, $post_id, []);
    $query_args = array_merge($default_args, $args);

    return new WP_Query($query_args);
}

/**
 * Format phone number from ACF field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param string $format Format (raw, link, pretty)
 * @return string Formatted phone number
 */
function acf_phone($field_name, $post_id = null, $format = 'link')
{
    $phone = acf_get($field_name, $post_id);

    if (empty($phone)) {
        return '';
    }

    // Clean the number
    $clean_number = preg_replace('/[^0-9+]/', '', $phone);

    switch ($format) {
        case 'raw':
            return $clean_number;
        case 'link':
            return '<a href="tel:' . $clean_number . '">' . $phone . '</a>';
        case 'pretty':
            // Format based on length and starting digits
            if (strlen($clean_number) == 10) {
                return '(' . substr($clean_number, 0, 3) . ') ' . substr($clean_number, 3, 3) . '-' . substr($clean_number, 6);
            } elseif (strlen($clean_number) == 11 && substr($clean_number, 0, 1) == '1') {
                return '(' . substr($clean_number, 1, 3) . ') ' . substr($clean_number, 4, 3) . '-' . substr($clean_number, 7);
            }
            return $phone;
        default:
            return $phone;
    }
}

/**
 * Format email from ACF field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param bool $link Create mailto link
 * @param string $link_text Text for link
 * @return string Formatted email
 */
function acf_email($field_name, $post_id = null, $link = true, $link_text = '')
{
    $email = acf_get($field_name, $post_id);

    if (empty($email)) {
        return '';
    }

    if (!$link) {
        return antispambot($email);
    }

    $text = !empty($link_text) ? $link_text : antispambot($email);
    return '<a href="mailto:' . antispambot($email) . '">' . $text . '</a>';
}

/**
 * Generate responsive image picture element
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param array $sizes Array of sizes and media queries
 * @param array $attr Additional HTML attributes
 * @return string HTML picture element
 */
function acf_picture($field_name, $post_id = null, $sizes = [], $attr = [])
{
    $image = acf_image($field_name, $post_id, 'full');

    if (empty($image) || empty($image['ID'])) {
        return '';
    }

    // Default sizes if not provided
    if (empty($sizes)) {
        $sizes = [
            [
                'size' => 'large',
                'media' => '(min-width: 1024px)'
            ],
            [
                'size' => 'medium',
                'media' => '(min-width: 768px)'
            ],
            [
                'size' => 'thumbnail',
                'media' => '(max-width: 767px)'
            ]
        ];
    }

    $output = '<picture>';

    // Add source elements
    foreach ($sizes as $size_data) {
        $size = $size_data['size'];
        $media = $size_data['media'];

        $src = wp_get_attachment_image_url($image['ID'], $size);
        $srcset = wp_get_attachment_image_srcset($image['ID'], $size);

        $output .= '<source media="' . esc_attr($media) . '" srcset="' . esc_attr($srcset) . '" sizes="' . esc_attr($size_data['sizes'] ?? '100vw') . '">';
    }

    // Add fallback img tag
    $default_attr = [
        'src' => $image['url'],
        'alt' => $image['alt'],
    ];

    $attr = array_merge($default_attr, $attr);
    $attributes = acf_html_attrs($attr);

    $output .= '<img' . $attributes . '>';
    $output .= '</picture>';

    return $output;
}

/**
 * Transform ACF fields to HTML data attributes
 *
 * @param array $fields Field names and attribute names
 * @param int|string $post_id The post ID (optional)
 * @return string HTML data attributes
 */
function acf_data_attrs($fields, $post_id = null)
{
    if (empty($fields) || !is_array($fields)) {
        return '';
    }

    $attrs = '';

    foreach ($fields as $field_name => $attr_name) {
        $value = acf_get($field_name, $post_id);

        if (!empty($value)) {
            if (is_array($value) || is_object($value)) {
                $value = wp_json_encode($value);
            }

            $attrs .= ' data-' . esc_attr($attr_name) . '="' . esc_attr($value) . '"';
        }
    }

    return $attrs;
}

/**
 * Get ACF field and apply callback function
 *
 * @param string $field_name The field name
 * @param callable $callback Function to apply to value
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed Processed field value
 */
function acf_process($field_name, $callback, $post_id = null, $default = '')
{
    $value = acf_get($field_name, $post_id, $default);

    if (empty($value) || !is_callable($callback)) {
        return $value;
    }

    return call_user_func($callback, $value);
}

/**
 * Get ACF fields from multiple posts
 *
 * @param string $field_name The field name
 * @param array $post_ids Array of post IDs
 * @param mixed $default Default value
 * @return array Values indexed by post ID
 */
function acf_multi_post($field_name, $post_ids, $default = '')
{
    if (empty($post_ids)) {
        return [];
    }

    $result = [];

    foreach ($post_ids as $post_id) {
        $result[$post_id] = acf_get($field_name, $post_id, $default);
    }

    return $result;
}

/**
 * Get ACF Clone field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return array Clone field values
 */
function acf_clone($field_name, $post_id = null)
{
    return acf_get($field_name, $post_id, []);
}

/**
 * Create data for JavaScript from ACF fields
 *
 * @param string $object_name JS object name
 * @param array $fields Fields to include
 * @param int|string $post_id The post ID (optional)
 * @return string Script tag with data
 */
function acf_js_data($object_name, $fields, $post_id = null)
{
    if (empty($fields) || !is_array($fields)) {
        return '';
    }

    $data = [];

    foreach ($fields as $js_key => $field_name) {
        $data[$js_key] = acf_get($field_name, $post_id);
    }

    $json = wp_json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);

    return '<script>var ' . esc_js($object_name) . ' = ' . $json . ';</script>';
}

/**
 * Get field from ancestors in page hierarchy
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed Field value from post or closest ancestor
 */
function acf_ancestor($field_name, $post_id = null, $default = '')
{
    $post_id = $post_id ?: get_the_ID();

    // Check current post first
    $value = acf_get($field_name, $post_id);
    if (!empty($value)) {
        return $value;
    }

    // Check ancestors
    $ancestors = get_post_ancestors($post_id);

    if (!empty($ancestors)) {
        foreach ($ancestors as $ancestor_id) {
            $value = acf_get($field_name, $ancestor_id);
            if (!empty($value)) {
                return $value;
            }
        }
    }

    return $default;
}

/**
 * Get current language version of ACF field for multilingual sites
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @param mixed $default Default value
 * @return mixed Localized field value
 */
function acf_localized($field_name, $post_id = null, $default = '')
{
    $post_id = $post_id ?: get_the_ID();

    // WPML compatibility
    if (function_exists('icl_object_id') && function_exists('wpml_get_language_information')) {
        $language_info = wpml_get_language_information(null, $post_id);
        $current_lang = isset($language_info['language_code']) ? $language_info['language_code'] : null;

        if ($current_lang) {
            // Try to get field with language suffix first
            $localized_field = $field_name . '_' . $current_lang;
            $value = acf_get($localized_field, $post_id);

            if (!empty($value)) {
                return $value;
            }
        }
    }

    // Polylang compatibility
    if (function_exists('pll_current_language') && function_exists('pll_get_post_language')) {
        $current_lang = pll_current_language();
        $post_lang = pll_get_post_language($post_id);

        if ($current_lang && $post_lang) {
            // Try to get field with language suffix first
            $localized_field = $field_name . '_' . $current_lang;
            $value = acf_get($localized_field, $post_id);

            if (!empty($value)) {
                return $value;
            }
        }
    }

    // Fall back to standard field
    return acf_get($field_name, $post_id, $default);
}

/**
 * Check if ACF flexible content has rows
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return bool True if flexible content has rows
 */
function acf_has_flexible_content($field_name, $post_id = null)
{
    if (!function_exists('have_rows')) {
        return false;
    }

    return have_rows($field_name, $post_id);
}

/**
 * Get the count of items in a repeater or flexible content field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 * @return int Number of rows
 */
function acf_count_rows($field_name, $post_id = null)
{
    $field = acf_get($field_name, $post_id);

    if (empty($field) || !is_array($field)) {
        return 0;
    }

    return count($field);
}

/**
 * Get the layout name of the current flexible content row
 *
 * @param string $field_name The field name
 * @param int $row Row index
 * @param int|string $post_id The post ID (optional)
 * @return string Layout name
 */
function acf_flexible_layout_name($field_name, $row = 0, $post_id = null)
{
    $layouts = acf_get($field_name, $post_id);

    if (empty($layouts) || !isset($layouts[$row])) {
        return '';
    }

    return isset($layouts[$row]['acf_fc_layout']) ? $layouts[$row]['acf_fc_layout'] : '';
}

/**
 * Cache ACF fields for a post to improve performance
 *
 * @param int|string $post_id The post ID
 * @return array All fields for the post
 */
function acf_cache_fields($post_id)
{
    static $cache = [];

    if (isset($cache[$post_id])) {
        return $cache[$post_id];
    }

    $fields = get_fields($post_id);
    $cache[$post_id] = $fields ?: [];

    return $cache[$post_id];
}

/**
 * Get ACF field from cached fields
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID
 * @param mixed $default Default value
 * @return mixed Field value
 */
function acf_get_cached($field_name, $post_id, $default = '')
{
    $fields = acf_cache_fields($post_id);

    return isset($fields[$field_name]) ? $fields[$field_name] : $default;
}

/**
 * Get all ACF fields as array
 *
 * @param int|string $post_id The post ID (optional)
 * @param bool $format_values Whether to format values
 * @return array All ACF fields
 */
function acf_get_all($post_id = null, $format_values = true)
{
    $post_id = $post_id ?: get_the_ID();

    if (!function_exists('get_fields')) {
        return [];
    }

    return get_fields($post_id, $format_values) ?: [];
}

/**
 * Output debug information about ACF field
 *
 * @param string $field_name The field name
 * @param int|string $post_id The post ID (optional)
 */
function acf_field_info($field_name, $post_id = null)
{
    if (!function_exists('get_field_object')) {
        echo '<div class="acf-debug">ACF not active</div>';
        return;
    }

    $field_object = get_field_object($field_name, $post_id);

    echo '<div class="acf-debug">';
    echo '<h3>Field: ' . esc_html($field_name) . '</h3>';
    echo '<pre>';
    print_r($field_object);
    echo '</pre>';
    echo '</div>';
}

/**
 * Generate HTML attributes from ACF fields
 *
 * @param array $attrs Attribute mapping (attr_name => field_name)
 * @param int|string $post_id The post ID (optional)
 * @return string HTML attributes
 */
function acf_html_attributes($attrs, $post_id = null)
{
    if (empty($attrs) || !is_array($attrs)) {
        return '';
    }

    $html_attrs = '';

    foreach ($attrs as $attr_name => $field_name) {
        $value = acf_get($field_name, $post_id);

        if (!empty($value)) {
            if (is_array($value)) {
                $value = implode(' ', $value);
            }

            $html_attrs .= ' ' . esc_attr($attr_name) . '="' . esc_attr($value) . '"';
        }
    }

    return $html_attrs;
}

/**
 * Initialize ACF helpers system
 */
function acf_helpers_init()
{
    // This function can be used to initialize any additional functionality
    // when using the ACF helpers throughout your theme

    // Add any initialization code here

    // Example: Add action to print ACF fields as JS data
    add_action('wp_footer', 'acf_helpers_print_js_data');
}

/**
 * Print ACF fields as JavaScript data in footer
 * (Example function that could be called by acf_helpers_init)
 */
function acf_helpers_print_js_data()
{
    // Example configuration - customize in your theme
    if (is_single() || is_page()) {
        $fields_to_expose = [
            'pageTitle' => 'page_title',
            'pageSubtitle' => 'page_subtitle',
            'featuredImage' => 'featured_image',
        ];

        echo acf_js_data('acfPageData', $fields_to_expose);
    }
}

// Initialize helpers
acf_helpers_init();
