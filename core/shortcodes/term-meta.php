<?php
/**
 * Add shortcode for category icons
 */
function register_category_icon_shortcode()
{
    add_shortcode('category_icon', function($atts) {
        $atts = shortcode_atts([
            'id' => 0,
            'slug' => '',
            'size' => 'thumbnail',
            'field' => 'category_icon'
        ], $atts);

        $term_id = 0;

        if ($atts['id']) {
            $term_id = absint($atts['id']);
        } elseif ($atts['slug']) {
            $term = get_term_by('slug', $atts['slug'], 'category');
            if ($term) {
                $term_id = $term->term_id;
            }
        } elseif (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }

        return display_category_icon($term_id, $atts['size'], $atts['field']);
    });
}
add_action('init', 'register_category_icon_shortcode');