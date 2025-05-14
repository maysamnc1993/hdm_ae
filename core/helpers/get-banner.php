<?php
/**
 * Custom Banner Display Functions
 * Add these functions to your theme's functions.php or include as a separate file
 */

if (!function_exists('get_custom_banner')) {
    /**
     * Get custom banner HTML for a specific page or the current page
     * 
     * @param int|string $page_id Optional. Specific page ID or 'current' for current page
     * @param array $args Optional. Additional arguments
     * @return string HTML for the banner or empty string if no banner exists
     */
    function get_custom_banner($page_id = 'current', $args = array()) {
        // Default arguments
        $defaults = array(
            'container_class' => 'custom-banner-container',
            'image_class'     => 'custom-banner',
            'show_title'      => false,
            'title_class'     => 'banner-title',
            'lazyload'        => true,
            'echo'            => false
        );
        
        $args = wp_parse_args($args, $defaults);
        
        // Get current page identifier if not specified
        if ($page_id === 'current') {
            if (is_front_page()) {
                $page_identifier = 'front_page';
            } elseif (is_page()) {
                $page_identifier = 'page_' . get_the_ID();
            } elseif (is_singular()) {
                $page_identifier = get_post_type() . '_' . get_the_ID();
            } else {
                $page_identifier = false;
            }
        } else {
            // If specific page ID provided
            $post_type = get_post_type($page_id);
            if ($post_type === 'page') {
                $page_identifier = 'page_' . $page_id;
            } elseif ($post_type) {
                $page_identifier = $post_type . '_' . $page_id;
            } else {
                $page_identifier = false;
            }
        }
        
        if (!$page_identifier) {
            return '';
        }
        
        // Find banner that should be displayed on this page
        $banner_query_args = array(
            'post_type'      => 'custom_banner',
            'posts_per_page' => 1,
            'meta_query'     => array(
                array(
                    'key'     => 'banner_display_pages',
                    'value'   => $page_identifier,
                    'compare' => 'LIKE'
                )
            )
        );
        
        $banners = get_posts($banner_query_args);
        $current_banner_id = !empty($banners) ? $banners[0]->ID : false;
        
        // Check for "all posts of this type" setting if no specific banner found
        if (!$current_banner_id && $page_id === 'current') {
            $post_type = get_post_type();
            if ($post_type) {
                $banner_query_args = array(
                    'post_type'      => 'custom_banner',
                    'posts_per_page' => 1,
                    'meta_query'     => array(
                        array(
                            'key'     => 'banner_display_pages',
                            'value'   => 'all_' . $post_type,
                            'compare' => 'LIKE'
                        )
                    )
                );
                
                $banners = get_posts($banner_query_args);
                $current_banner_id = !empty($banners) ? $banners[0]->ID : false;
            }
        }
        
        if (!$current_banner_id) {
            return '';
        }
        
        // Get banner images
        $desktop_image_id = get_post_thumbnail_id($current_banner_id);
        $mobile_image_id = get_post_meta($current_banner_id, 'banner_mobile_image', true);
        
        if (!$desktop_image_id) {
            return '';
        }
        
        $desktop_image = wp_get_attachment_image_src($desktop_image_id, 'full');
        $mobile_image = $mobile_image_id ? wp_get_attachment_image_src($mobile_image_id, 'full') : null;
        
        if (!$desktop_image) {
            return '';
        }
        
        // Get banner title for alt text
        $banner_title = get_the_title($current_banner_id);
        
        // Start building output
        $output = '<div class="' . esc_attr($args['container_class']) . '">';
        
        // Add title if requested
        if ($args['show_title']) {
            $output .= '<h2 class="' . esc_attr($args['title_class']) . '">' . esc_html($banner_title) . '</h2>';
        }
        
        // Set up lazyload attributes if enabled
        $lazy_attr = $args['lazyload'] ? 'loading="lazy"' : '';
        
        if ($mobile_image) {
            // If we have both desktop and mobile images, use picture element
            $output .= '<picture>';
            $output .= '<source media="(max-width: 768px)" srcset="' . esc_url($mobile_image[0]) . '">';
            $output .= '<img src="' . esc_url($desktop_image[0]) . '" alt="' . esc_attr($banner_title) . '" ' . $lazy_attr . ' class="' . esc_attr($args['image_class']) . '">';
            $output .= '</picture>';
        } else {
            // If we only have desktop image
            $output .= '<img src="' . esc_url($desktop_image[0]) . '" alt="' . esc_attr($banner_title) . '" ' . $lazy_attr . ' class="' . esc_attr($args['image_class']) . '">';
        }
        
        $output .= '</div>';
        
        if ($args['echo']) {
            echo $output;
        }
        
        return $output;
    }
}

if (!function_exists('the_custom_banner')) {
    /**
     * Display custom banner for current page or specific page
     * 
     * @param int|string $page_id Optional. Specific page ID or 'current' for current page
     * @param array $args Optional. Additional arguments
     */
    function the_custom_banner($page_id = 'current', $args = array()) {
        $args['echo'] = true;
        get_custom_banner($page_id, $args);
    }
}