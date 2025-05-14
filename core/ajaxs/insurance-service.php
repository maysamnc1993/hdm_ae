<?php
/**
 * Insurance AJAX Handler
 *
 * Handles AJAX requests for insurance category navigation and services
 */

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    die('Access denied.');
}

// Fetch child categories based on parent category
function handle_get_child_categories() {
    // Ensure parent category is provided
    if (!isset($_POST['parent_category_id']) || empty($_POST['parent_category_id'])) {
        wp_send_json_error(['message' => 'شناسه دسته‌بندی والد مورد نیاز است.']);
    }

    $parent_category_id = absint($_POST['parent_category_id']);

    // Fetch child categories
    $args = [
        'taxonomy'   => 'insurance_category',
        'parent'     => $parent_category_id,
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ];

    $child_categories = get_terms($args);

    if (is_wp_error($child_categories)) {
        wp_send_json_error(['message' => 'خطا در دریافت زیرمجموعه‌ها.']);
        return;
    }

    if (empty($child_categories)) {
        wp_send_json_success(['categories' => []]);
        return;
    }

    // Prepare category data
    $category_data = array_map(function($term) {
        return [
            'term_id' => $term->term_id,
            'name'    => esc_html($term->name),
            'slug'    => $term->slug,
            'parent'  => $term->parent,
        ];
    }, $child_categories);

    wp_send_json_success(['categories' => $category_data]);
}

// Fetch posts for a given category
function handle_get_category_posts() {
    // Ensure category ID is provided
    if (!isset($_POST['category_id']) || empty($_POST['category_id'])) {
        wp_send_json_error(['message' => 'شناسه دسته‌بندی مورد نیاز است.']);
        return;
    }

    $category_id = absint($_POST['category_id']);
    
    // Fetch posts in the specified category dynamically
    $args = [
        'post_type'      => 'insurance', // Assuming 'insurance' is the custom post type you're using
        'posts_per_page' => -1, // Fetch all posts
        'tax_query'      => [
            [
                'taxonomy' => 'insurance_category', // Correct taxonomy
                'terms'    => $category_id, // Use the dynamically passed category ID
                'field'    => 'term_id',
                'operator' => 'IN'
            ]
        ],
    ];
    
    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        wp_send_json_success(['posts' => []]); // Return empty array if no posts
        return;
    }
    // Prepare the post data
    $posts_data = [];
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        
        // Get the insurance_icon meta field
        $insurance_icon_id = get_post_meta($post_id, '_document_attachment', true);
       
        $image = '';
        if ($insurance_icon_id) {
            // If insurance_icon exists, get the image URL using wp_get_attachment_url()
            $image = wp_get_attachment_url($insurance_icon_id);
        } else {
            $image = ''; // Fallback: if no icon, set a default or empty value
        }

        $posts_data[] = [
            'ID'    => $post_id,
            'title' => get_the_title(),
            'link'  => get_permalink(),
            'image' => $image,
        ];
    }
    
    wp_reset_postdata();
    wp_send_json_success(['posts' => $posts_data]);
}



// Register AJAX actions using the wpAjax plugin
if (class_exists('WPAjaxHandler')) {
    \WPAjaxHandler::register('crm_get_child_categories', 'handle_get_child_categories', [
        'public' => true,
        'nonce'  => false, // Nonce verification disabled
    ]);
    \WPAjaxHandler::register('crm_get_category_posts', 'handle_get_category_posts', [
        'public' => true,
        'nonce'  => false, // Nonce verification disabled
    ]);
}