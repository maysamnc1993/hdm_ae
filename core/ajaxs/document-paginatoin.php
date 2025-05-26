<?php

/**
 * Register the AJAX action for document pagination
 * Add this to your functions.php or a custom plugin file
 */

WPAjaxHandler::register('load_category_documents', 'ajax_load_category_documents', [
    'public' => true,
    'nonce' => true
]);

/**
 * AJAX handler for loading documents by category with pagination
 * 
 * @return array Response data with documents HTML
 */
function ajax_load_category_documents()
{
    // Validate and sanitize inputs
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 4;

    // Verify category exists
    if (!term_exists($category_id, 'document_category')) {
        return [
            'success' => false,
            'message' => 'Invalid category',
            'code' => 'invalid_category'
        ];
    }

    // Query the documents
    $args = [
        'post_type' => 'document',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'tax_query' => [
            [
                'taxonomy' => 'document_category',
                'field' => 'term_id',
                'terms' => $category_id
            ]
        ]
    ];

    $documents_query = new WP_Query($args);

    // Start output buffering to capture HTML
    ob_start();

    if ($documents_query->have_posts()) {
?>
        <ul class="reports-section__list">
            <?php
            if ($documents_query->have_posts()) {
                while ($documents_query->have_posts()) {
                    $documents_query->the_post();
                    $file_id = get_post_meta(get_the_ID(), '_document_attachment', true);
                    $file_url = $file_id ? wp_get_attachment_url($file_id) : '#';
                    $file_name = $file_id ? basename(wp_get_attachment_url($file_id)) : 'No file attached';
            ?>
                    <li class="flex items-center flex-col md:flex-row justify-between gap-3 mb-4 w-full">
                        <div class="file-meta">
                            <div class="file-name"><?php the_title(); ?></div>
                            <div class="file-date">
                                <?php echo $file_date; ?>
                            </div>
                        </div>
                        <?php if ($file_id) : ?>
                            <a href="<?php echo esc_url($file_url); ?>" class="btn btn-primary-icon flex-shrink-0" download>
                                دانلود فایل
                                <?php svg_icon('download-icon', 'icon icon-location w-6 h-6 shrink-0'); ?>
                            </a>
                        <?php else : ?>
                            <button class="btn btn-primary-icon flex-shrink-0" disabled>
                                فایل موجود نیست
                                <?php svg_icon('download-icon'); ?>
                            </button>
                        <?php endif; ?>

                    </li>
                <?php
                }

                // Pagination controls
                if ($documents_query->max_num_pages > 1) {
                ?>
                    <nav class="ajax-pagination mt-6 flex justify-center" aria-label="Pagination for <?php echo esc_html($category->name); ?>">
                        <?php if ($documents_query->max_num_pages > 1) : ?>
                            <a href="#" class="page-numbers mx-1 px-3 py-1 rounded bg-white text-gray-700 <?php echo 1 === 1 ? 'cursor-not-allowed opacity-50' : ''; ?>" data-page="<?php echo esc_attr(max(1, 1 - 1)); ?>" data-category-id="<?php echo esc_attr($category->term_id); ?>" <?php echo 1 === 1 ? 'aria-disabled="true"' : ''; ?>>
                                قبلی
                            </a>
                        <?php endif; ?>
                        <?php
                        for ($i = 1; $i <= $documents_query->max_num_pages; $i++) {
                            $active_class = ($i === 1) ? 'active text-white' : 'bg-white text-gray-700';
                        ?>
                            <a href="#" class="page-numbers mx-1 px-3 py-1 rounded <?php echo esc_attr($active_class); ?>" data-page="<?php echo esc_attr($i); ?>" data-category-id="<?php echo esc_attr($category->term_id); ?>">
                                <?php echo esc_html($i); ?>
                            </a>
                        <?php
                        }
                        ?>
                        <?php if ($documents_query->max_num_pages > 1) : ?>
                            <a href="#" class="page-numbers mx-1 px-3 py-1 rounded bg-white text-gray-700" data-page="<?php echo esc_attr(min($documents_query->max_num_pages, 1 + 1)); ?>" data-category-id="<?php echo esc_attr($category->term_id); ?>">
                                بعدی
                            </a>
                        <?php endif; ?>
                    </nav>
                <?php
                }
                wp_reset_postdata();
            } else {
                ?>
                <p>هیچ سندی در این دسته‌بندی یافت نشد.</p>
            <?php
            }
            ?>
        </ul>
        <div class="loading-spinner hidden text-center py-4">
            <svg class="animate-spin h-6 w-6 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A 7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    <?php

        wp_reset_postdata();
    } else {
    ?>
        <p>هیچ سندی در این دسته‌بندی یافت نشد.</p>
<?php
    }

    $html = ob_get_clean();

    return [
        'success' => true,
        'data' => [
            'html' => $html,
            'page' => $page,
            'total_pages' => $documents_query->max_num_pages,
        ]
    ];
}
