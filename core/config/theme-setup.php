<?php

if (!defined('JTHEME_VERSION')) {
    define('JTHEME_VERSION', '1.0.0');
}

if (!defined('JTHEME_DIR')) {
    define('JTHEME_DIR', get_template_directory());
}

if (!defined('JTHEME_URI')) {
    define('JTHEME_URI', get_template_directory_uri());
}

function jthem_setup()
{
    load_theme_textdomain('JTheme', get_template_directory() . '/languages');

    // Theme Support
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('custom-logo');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Add RTL support
    add_theme_support('rtl');

    // Navigation
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'JTheme'),
        'footer'  => esc_html__('Footer Menu', 'JTheme'),
        'mobile'  => esc_html__('Mobile Menu', 'JTheme'),
        'footer_quick_access'  => esc_html__('Quick Access', 'JTheme'),
        'footer_useful_links'  => esc_html__('Useful Links', 'JTheme'),
    ]);
}
add_action('after_setup_theme', 'jthem_setup');



function add_custom_upload_mimes($mimes_types)
{
    $mimes_types['webp'] = 'image/webp'; // webp files
    return $mimes_types;
}
add_filter('upload_mimes', 'add_custom_upload_mimes');

function add_allow_upload_extension_exception($types, $file, $filename, $mimes)
{
    // Do basic extension validation and MIME mapping
    $wp_filetype = wp_check_filetype($filename, $mimes);
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    if (in_array($ext, array('webp'))) { // if follows webp files have
        $types['ext'] = $ext;
        $types['type'] = $type;
    }
    return $types;
}
add_filter('wp_check_filetype_and_ext', 'add_allow_upload_extension_exception', 99, 4);



function displayable_image_webp($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'displayable_image_webp', 10, 2);


// Add support for WebP in your theme
function mytheme_support_webp()
{
    // Ensure the theme supports featured images
    add_theme_support('post-thumbnails');

    // Add a filter to allow WebP uploads
    add_filter('upload_mimes', function ($mimes) {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    });
}
add_action('after_setup_theme', 'mytheme_support_webp');

add_filter('wp_image_editors', 'wpse425693_prefer_gd_over_imagick');
function wpse425693_prefer_gd_over_imagick($array)
{
    return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
}




// Add Elementor support
function theme_add_elementor_support()
{
    // Add theme support for Elementor
    add_theme_support('elementor');

    // Add support for Elementor Pro features
    add_theme_support('elementor-pro');

    // Register Elementor locations (for Elementor Pro)
    if (function_exists('elementor_theme_do_location')) {
        register_nav_menus(
            array(
                'primary' => __('Primary Menu', 'your-theme'),
                'footer' => __('Footer Menu', 'your-theme'),
            )
        );
    }
}
add_action('after_setup_theme', 'theme_add_elementor_support');

// Add Elementor page templates
function theme_add_elementor_templates($templates)
{
    $templates['elementor_header_footer'] = 'Elementor Header & Footer';
    $templates['elementor_canvas'] = 'Elementor Canvas';
    return $templates;
}
add_filter('theme_page_templates', 'theme_add_elementor_templates');

// Add Elementor content width support
function theme_content_width()
{
    $GLOBALS['content_width'] = 1140; // Adjust this based on your theme's design
}
add_action('after_setup_theme', 'theme_content_width');

// Add Elementor widget locations
function theme_register_elementor_locations($elementor_theme_manager)
{
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single');
    $elementor_theme_manager->register_location('archive');
}
add_action('elementor/theme/register_locations', 'theme_register_elementor_locations');
