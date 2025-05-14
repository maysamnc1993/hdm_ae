<?php
/**
 * FAQ Component Example
 *
 * Example usage of the FAQ component.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

/**
 * Using the FAQ post type with shortcodes
 * 
 * Place any of these shortcodes in your WordPress content to display FAQs
 */

/**
 * Example 1: Display all FAQs
 * 
 * This will display all published FAQ items.
 * 
 * [jthem_faq]
 */


/**
 * Example 2: Display FAQs from a specific category
 * 
 * This will display FAQs from the "general" category.
 * 
 * [jthem_faq category="general" title="General Questions" subtitle="Common questions about our services"]
 */


/**
 * Example 3: Display specific FAQ items by ID
 * 
 * This will display only the specified FAQ items by their post IDs.
 * 
 * [jthem_faq ids="1,2,3" title="Featured FAQs" subtitle="Our most important questions"]
 */


/**
 * Example 4: Display FAQs with customized appearance
 * 
 * This will display FAQs with multiple items open at once and different icons.
 * 
 * [jthem_faq accordion_type="multiple" icon_open="chevron-down" icon_close="chevron-up"]
 */


/**
 * Example 5: Group FAQs by category with headings
 * 
 * This will display all FAQs grouped by their categories with category headings.
 * 
 * [jthem_faq show_category_title="true" title="All FAQ Categories"]
 */


/**
 * Example 6: Display limited number of FAQs in reverse chronological order
 * 
 * This will display the 5 most recent FAQs.
 * 
 * [jthem_faq limit="5" orderby="date" order="DESC" title="Latest FAQs"]
 */


/**
 * Using the FAQ post type programmatically
 * 
 * The following examples show how to use the FAQ post type in your theme templates.
 */

/**
 * Example 7: Display FAQs programmatically
 */
function jthem_faq_programmatic_example() {
    // Query FAQ posts
    $args = array(
        'post_type' => 'jthem_faq',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $faq_query = new WP_Query($args);
    
    // Prepare items for the FAQ component
    $faq_items = array();
    
    if ($faq_query->have_posts()) {
        while ($faq_query->have_posts()) {
            $faq_query->the_post();
            $post_id = get_the_ID();
            
            $faq_items[] = array(
                'question' => get_the_title(),
                'answer' => get_the_content(),
                'is_open' => get_post_meta($post_id, '_jthem_faq_is_open', true) == '1',
            );
        }
        
        // Reset post data
        wp_reset_postdata();
        
        // Create FAQ component args
        $faq_args = array(
            'title' => 'Programmatic FAQs',
            'subtitle' => 'These FAQs were loaded programmatically',
            'items' => $faq_items,
            'accordion_type' => 'single',
            'icon_open' => 'plus',
            'icon_close' => 'minus',
        );
        
        // Instantiate FAQ class and render
        $faq = new JThem_FAQ($faq_args);
        echo $faq->render();
    }
}

/**
 * Example 8: Display FAQs from a specific category programmatically
 */
function jthem_faq_category_example($category_slug) {
    // Query FAQ posts from a specific category
    $args = array(
        'post_type' => 'jthem_faq',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'jthem_faq_category',
                'field' => 'slug',
                'terms' => $category_slug,
            ),
        ),
    );
    
    $faq_query = new WP_Query($args);
    
    // Prepare items for the FAQ component
    $faq_items = array();
    
    if ($faq_query->have_posts()) {
        while ($faq_query->have_posts()) {
            $faq_query->the_post();
            $post_id = get_the_ID();
            
            $faq_items[] = array(
                'question' => get_the_title(),
                'answer' => get_the_content(),
                'is_open' => get_post_meta($post_id, '_jthem_faq_is_open', true) == '1',
            );
        }
        
        // Reset post data
        wp_reset_postdata();
        
        // Get the category name
        $category = get_term_by('slug', $category_slug, 'jthem_faq_category');
        $category_name = $category ? $category->name : $category_slug;
        
        // Create FAQ component args
        $faq_args = array(
            'title' => $category_name . ' FAQs',
            'subtitle' => 'Frequently asked questions about ' . strtolower($category_name),
            'items' => $faq_items,
            'accordion_type' => 'single',
        );
        
        // Instantiate FAQ class and render
        $faq = new JThem_FAQ($faq_args);
        echo $faq->render();
    } else {
        echo '<p>No FAQs found in this category.</p>';
    }
}

// Example usage:
// jthem_faq_programmatic_example();
// jthem_faq_category_example('general'); 