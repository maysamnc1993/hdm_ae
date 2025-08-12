<?php


/**
 * Add this to your category-posts-icon.php file
 */

// Initialize the category icons
function setup_category_icons()
{
    // Create a new instance of Term_Meta for the category taxonomy
    $category_icons = new \JTheme\Builders\Term_Meta('category');

    // Add an image field for the icons
    $category_icons->add_image('category_icon', 'Category Icon', [
        'description' => 'یک نماد برای این دسته آپلود یا انتخاب کنید.',
        'button_text' => 'انتخاب آیکون'
    ]);
    $category_icons->add_icon('category_icon_line_aswome', 'Category Icon line aswome', [
        'description' => 'یک کلاس ایکون برای این دسته وارد کنید کنید.',
    ]);
}

add_action('init', 'setup_category_icons');


