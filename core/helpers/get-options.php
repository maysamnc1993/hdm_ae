<?php

use Opilo\Farsi\JalaliDate;

function pg_get_option($key, $default = '')
{
    if (!class_exists('Redux')) return '';
    if (Redux::get_option('jtheme_options', $key)) {
        return Redux::get_option('jtheme_options', $key);
    }
    return $default;
}

function jtheme_get_attachment($attachment_id): array
{

    $attachment = get_post($attachment_id);

    return array(
        'alt' => get_post_meta($attachment->ID ?? 0, '_wp_attachment_image_alt', true) ?? '',
        'caption' => $attachment->post_excerpt ?? '',
        'description' => $attachment->post_content ?? '',
        'href' => get_permalink($attachment->ID ?? 0),
        'src' => $attachment->guid ?? '',
        'title' => $attachment->post_title ?? ''
    );
}


/**
 * echo url of staticassets from theme image folder
 *
 * @param ?string $file_name The file name inside the image folder
 * */
function the_theme_img(?string $file_name): void
{
    echo get_theme_img($file_name);
}

/**
 * @param ?string $file_name The file name inside the image folder
 * *@return string url of static assets from theme image folder
 *
 */
function get_theme_img(?string $file_name): string
{
    $file_name = $file_name ?: 'no-image.jpg';

    return home_url("wp-content/themes/ibne-sina/src/img/{$file_name}");
}

/**
 * @deprecated
 **/
function get_theme_img_dir(): string
{
    return get_template_directory_uri() . '/dist/img';
}


function display_image_redux($image_option, $default_class = '')
{
    if (isset($image_option['id']) && is_numeric($image_option['id'])) {
        echo wp_get_attachment_image($image_option['id'], 'full', false, ['class' => $default_class]);
    } elseif (!empty($image_option['url'])) {
        echo '<img class="' . esc_attr($default_class) . '" src="' . esc_url($image_option['url']) . '" alt="">';
    }
}


// simple uses

// <?php
//  Define the fields you want to retrieve from the repeater
// $field_names = array('image', 'category');

// // Get the repeater items
// $gallery_items = get_repeater_items('gallery_images', $field_names);

// if (!empty($gallery_items)) {
//     foreach ($gallery_items as $item) {
//         // Access the image data and category
//         $image_data = $item['image'];
//         $image_url = !empty($image_data['url']) ? esc_url($image_data['url']) : '';
//         $category = !empty($item['category']) ? esc_attr($item['category']) : 'uncategorized';

//         // Your custom display code here
//         echo '<div class="mb-4 break-inside-avoid bg-gray-200 rounded overflow-hidden filter-item">';
//         echo '<img src="' . $image_url . '" data-category="' . $category . '" class="rounded object-cover w-full h-auto">';
//         echo '</div>';
//     }
// } else {
//     echo '<p>No images found in the gallery.</p>';
// }


/**
 * Retrieves and formats data from a Redux repeater field.
 *
 * @param string $option_name The name of the option set in Redux.
 * @param array $field_names An array of field names to retrieve from the repeater.
 *
 * @return array An array of repeater items, each item being an associative array of field data.
 */
function get_repeater_items($option_name, $field_names = array())
{
    $repeater_data = pg_get_option($option_name);
    $items = array();

    if (!empty($repeater_data) && is_array($repeater_data)) {
        // Get the number of items by counting the elements in one of the fields
        $first_field = reset($repeater_data);
        $num_items = is_array($first_field) ? count($first_field) : 0;

        for ($i = 0; $i < $num_items; $i++) {
            $item = array();
            foreach ($field_names as $field_name) {
                if (isset($repeater_data[$field_name][$i])) {
                    $item[$field_name] = $repeater_data[$field_name][$i];
                } else {
                    $item[$field_name] = null;
                }
            }
            $items[] = $item;
        }
    }

    return $items;
}


/**
 * Display optimized responsive image from Redux settings
 *
 * @param array $image_option The image data from Redux
 * @param string $default_class CSS classes to add to the image
 * @param bool $lazy Whether to use lazy loading
 * @param array $size_attr Optional width and height attributes
 */
function display_optimized_image_redux($image_option, $default_class = '', $lazy = true, $size_attr = [])
{
    // If we have a valid attachment ID
    if (isset($image_option['id']) && is_numeric($image_option['id'])) {
        $image_id = $image_option['id'];
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: '';
        $image_src = wp_get_attachment_image_url($image_id, 'full');
        $image_srcset = wp_get_attachment_image_srcset($image_id, 'full');

        // Build attributes
        $attr = [
            'class' => $default_class,
            'src' => $image_src, // Add the src attribute
            'srcset' => $image_srcset,
            'sizes' => '(max-width: 767px) 100vw, 100vw',
            'loading' => $lazy ? 'lazy' : 'eager',
            'alt' => $image_alt
        ];

        // Add size attributes if provided
        if (!empty($size_attr['width'])) {
            $attr['width'] = $size_attr['width'];
        }
        if (!empty($size_attr['height'])) {
            $attr['height'] = $size_attr['height'];
        }

        // Build the attribute string
        $attr_string = '';
        foreach ($attr as $key => $value) {
            $attr_string .= esc_attr($key) . '="' . esc_attr($value) . '" ';
        }

        echo '<img ' . $attr_string . '/>';
    } // Fallback to URL if no ID or if ID is invalid
    elseif (!empty($image_option['url'])) {
        $attr_string = 'class="' . esc_attr($default_class) . '" ';
        $attr_string .= 'src="' . esc_url($image_option['url']) . '" ';
        $attr_string .= 'alt="" ';
        $attr_string .= 'loading="' . ($lazy ? 'lazy' : 'eager') . '" ';

        if (!empty($size_attr['width'])) {
            $attr_string .= 'width="' . esc_attr($size_attr['width']) . '" ';
        }
        if (!empty($size_attr['height'])) {
            $attr_string .= 'height="' . esc_attr($size_attr['height']) . '" ';
        }

        echo '<img ' . $attr_string . '>';
    }
}


/**
 * Retrieves file details from a Redux media field.
 *
 * @param string $option_name The Redux option name for the media field.
 * @param bool $include_attachment Whether to include full attachment metadata.
 * @return array File details including URL, ID, MIME type, and optional attachment data.
 */
function get_redux_file($option_name, $include_attachment = false)
{
    $file_data = pg_get_option($option_name);
    $default = [
        'url' => '',
        'id' => 0,
        'mime_type' => '',
        'thumbnail' => '',
        'filename' => '',
        'attachment' => [],
    ];

    if (empty($file_data) || !is_array($file_data)) {
        return $default;
    }

    $file = [
        'url' => !empty($file_data['url']) ? esc_url($file_data['url']) : '',
        'id' => !empty($file_data['id']) && is_numeric($file_data['id']) ? (int)$file_data['id'] : 0,
        'mime_type' => '',
        'thumbnail' => !empty($file_data['thumbnail']) ? esc_url($file_data['thumbnail']) : '',
        'filename' => '',
    ];

    if ($file['id']) {
        // Get MIME type from attachment
        $file['mime_type'] = get_post_mime_type($file['id']);
        // Get filename from attachment
        $file['filename'] = basename(get_attached_file($file['id']));
        // Include full attachment metadata if requested
        if ($include_attachment) {
            $file['attachment'] = jtheme_get_attachment($file['id']);
        }
    } elseif ($file['url']) {
        // Fallback for URL-based files (no attachment ID)
        $file['filename'] = basename($file['url']);
        // Guess MIME type from extension if possible
        $extension = pathinfo($file['url'], PATHINFO_EXTENSION);
        $mime_types = wp_get_mime_types();
        foreach ($mime_types as $ext => $mime) {
            if (in_array($extension, explode('|', $ext))) {
                $file['mime_type'] = $mime;
                break;
            }
        }
    }

    // Set default thumbnail for non-image files if not provided
    if (empty($file['thumbnail']) && $file['mime_type']) {
        $file['thumbnail'] = wp_mime_type_icon($file['mime_type']);
    }

    return $file;
}


/**
 * Retrieve posts based on Redux settings with defaults.
 *
 * @param string $prefix Redux option prefix (e.g., 'news', 'health').
 * @param array $defaults Default query args.
 * @return WP_Query
 */
function pg_get_posts_from_redux($prefix, $defaults = [])
{
    $args = wp_parse_args([
        'post_type' => 'post',
        'posts_per_page' => pg_get_option("{$prefix}_count", $defaults['posts_per_page'] ?? 4),
        'cat' => pg_get_option("{$prefix}_category", $defaults['cat'] ?? null),
    ], $defaults);
    return new WP_Query($args);
}