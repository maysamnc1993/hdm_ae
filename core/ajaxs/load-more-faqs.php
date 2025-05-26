<?php
// Register the AJAX action for FAQ loading
WPAjaxHandler::register('load_more_faqs', 'ajax_load_more_faqs', [
    'public' => true,
    'nonce' => true
]);

/**
 * AJAX handler for loading more FAQs
 *
 * @return array Response data with FAQs HTML and pagination info
 */
function ajax_load_more_faqs() {
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'jthem_faq',
        'posts_per_page' => 10,
        'paged' => $page,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    if (!empty($category_slug)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'jthem_faq_category',
                'field' => 'slug',
                'terms' => $category_slug
            )
        );
    }

    $faq_query = new WP_Query($args);

    ob_start();

    if ($faq_query->have_posts()) {
        while ($faq_query->have_posts()) {
            $faq_query->the_post();
            $post_id = get_the_ID();
            $is_open = get_post_meta($post_id, '_jthem_faq_is_open', true) == '1';
            $item_categories = wp_get_post_terms($post_id, 'jthem_faq_category', array('fields' => 'slugs'));
            $category_data = !empty($item_categories) ? implode(' ', $item_categories) : '';
            ?>
            <div class="faq-item" id="faq_home_item_<?php echo esc_attr($post_id); ?>" data-categories="<?php echo esc_attr($category_data); ?>">
                <button type="button" class="faq-question" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="faq_home_content_<?php echo esc_attr($post_id); ?>">
                    <span><?php the_title(); ?></span>
                    <span class="faq-icon">
                        <?php if (!$is_open) : ?>
                            <?php svg_icon('arrow-square-down'); ?>
                        <?php else : ?>
                            <?php svg_icon('arrow-square-up'); ?>
                        <?php endif; ?>
                    </span>
                </button>
                <div id="faq_home_content_<?php echo esc_attr($post_id); ?>" class="faq-answer <?php echo $is_open ? '' : 'hidden'; ?>" style="max-height: <?php echo $is_open ? '1000px' : '0'; ?>;">
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p class="text-center py-4">هیچ سوالی در این دسته‌بندی یافت نشد.</p>';
    }

    $html = ob_get_clean();

    return [
        'success' => true,
        'data' => [
            'html' => $html,
            'page' => $page,
            'total_pages' => $faq_query->max_num_pages
        ]
    ];
}