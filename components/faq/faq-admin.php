<?php
/**
 * FAQ Component Admin
 *
 * Admin interface for managing FAQ items.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register the FAQ admin menu and page
 */
function jthem_faq_admin_menu() {
    add_submenu_page(
        'themes.php', // Parent slug
        'مدیریت سوالات متداول', // Page title
        'سوالات متداول', // Menu title
        'edit_theme_options', // Capability
        'jthem-faq-manager', // Menu slug
        'jthem_render_faq_admin_page' // Callback function
    );
}
add_action('admin_menu', 'jthem_faq_admin_menu');

/**
 * Render the FAQ admin page
 */
function jthem_render_faq_admin_page() {
    // Check user capabilities
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    
    // Handle form submissions
    if (isset($_POST['jthem_faq_save'])) {
        jthem_save_faq_items();
    }
    
    // Get saved FAQ items
    $faq_items = get_option('jthem_faq_items', array());
    
    // Include admin UI
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('مدیریت سوالات متداول', 'JTheme'); ?></h1>
        
        <div class="notice notice-info">
            <p><?php echo esc_html__('برای استفاده از سوالات متداول در صفحات خود، از شورت‌کد زیر استفاده کنید:', 'JTheme'); ?></p>
            <code>[jthem_faq items="1,2,3" title="سوالات متداول" subtitle="پاسخ به سوالات رایج"]</code>
            <p><?php echo esc_html__('جایگزین کنید 1,2,3 را با شناسه‌های سوالاتی که می‌خواهید نمایش داده شوند.', 'JTheme'); ?></p>
        </div>
        
        <form method="post" action="">
            <?php wp_nonce_field('jthem_faq_nonce', 'jthem_faq_nonce'); ?>
            
            <div id="jthem-faq-items">
                <?php if (!empty($faq_items)) : ?>
                    <?php foreach ($faq_items as $id => $item) : ?>
                        <div class="jthem-faq-item postbox">
                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">
                                    <?php echo esc_html($item['question']); ?>
                                    <span class="faq-id">(ID: <?php echo esc_html($id); ?>)</span>
                                </h2>
                                <div class="handle-actions hide-if-no-js">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="screen-reader-text"><?php echo esc_html__('Toggle panel', 'JTheme'); ?></span>
                                        <span class="toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="inside">
                                <div class="faq-fields">
                                    <input type="hidden" name="faq_item_id[]" value="<?php echo esc_attr($id); ?>">
                                    
                                    <p>
                                        <label for="faq_question_<?php echo esc_attr($id); ?>"><?php echo esc_html__('سوال:', 'JTheme'); ?></label>
                                        <input type="text" class="large-text" id="faq_question_<?php echo esc_attr($id); ?>" name="faq_question[]" value="<?php echo esc_attr($item['question']); ?>" required>
                                    </p>
                                    
                                    <p>
                                        <label for="faq_answer_<?php echo esc_attr($id); ?>"><?php echo esc_html__('پاسخ:', 'JTheme'); ?></label>
                                        <?php 
                                        wp_editor(
                                            $item['answer'],
                                            'faq_answer_' . $id,
                                            array(
                                                'textarea_name' => 'faq_answer[]',
                                                'textarea_rows' => 5,
                                                'media_buttons' => true,
                                                'teeny' => true,
                                            )
                                        );
                                        ?>
                                    </p>
                                    
                                    <p>
                                        <label>
                                            <input type="checkbox" name="faq_is_open[<?php echo esc_attr($id); ?>]" value="1" <?php checked(isset($item['is_open']) && $item['is_open']); ?>>
                                            <?php echo esc_html__('نمایش بصورت باز به صورت پیش‌فرض', 'JTheme'); ?>
                                        </label>
                                    </p>
                                    
                                    <p class="faq-actions">
                                        <button type="button" class="button faq-remove-item"><?php echo esc_html__('حذف', 'JTheme'); ?></button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="faq-actions">
                <button type="button" id="add-faq-item" class="button button-secondary"><?php echo esc_html__('افزودن سوال جدید', 'JTheme'); ?></button>
                <button type="submit" name="jthem_faq_save" class="button button-primary"><?php echo esc_html__('ذخیره تغییرات', 'JTheme'); ?></button>
            </div>
        </form>
        
        <!-- Template for new FAQ item -->
        <div id="faq-item-template" style="display:none;">
            <div class="jthem-faq-item postbox">
                <div class="postbox-header">
                    <h2 class="hndle ui-sortable-handle">
                        <?php echo esc_html__('سوال جدید', 'JTheme'); ?>
                    </h2>
                    <div class="handle-actions hide-if-no-js">
                        <button type="button" class="handlediv" aria-expanded="true">
                            <span class="screen-reader-text"><?php echo esc_html__('Toggle panel', 'JTheme'); ?></span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="inside">
                    <div class="faq-fields">
                        <input type="hidden" name="faq_item_id[]" value="new">
                        
                        <p>
                            <label for="faq_question_new"><?php echo esc_html__('سوال:', 'JTheme'); ?></label>
                            <input type="text" class="large-text" id="faq_question_new" name="faq_question[]" value="" required>
                        </p>
                        
                        <p>
                            <label for="faq_answer_new"><?php echo esc_html__('پاسخ:', 'JTheme'); ?></label>
                            <textarea class="large-text" id="faq_answer_new" name="faq_answer[]" rows="5"></textarea>
                        </p>
                        
                        <p>
                            <label>
                                <input type="checkbox" name="faq_is_open[new]" value="1">
                                <?php echo esc_html__('نمایش بصورت باز به صورت پیش‌فرض', 'JTheme'); ?>
                            </label>
                        </p>
                        
                        <p class="faq-actions">
                            <button type="button" class="button faq-remove-item"><?php echo esc_html__('حذف', 'JTheme'); ?></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            .jthem-faq-item {
                margin-bottom: 15px;
            }
            .faq-actions {
                margin-top: 15px;
            }
            .faq-id {
                font-size: 12px;
                color: #777;
                margin-left: 10px;
                font-weight: normal;
            }
            #jthem-faq-items {
                margin-bottom: 20px;
            }
        </style>
        
        <script>
            jQuery(document).ready(function($) {
                // Add new FAQ item
                $('#add-faq-item').on('click', function() {
                    var template = $('#faq-item-template').html();
                    var newId = 'new_' + Math.floor(Math.random() * 1000);
                    
                    // Replace placeholder IDs with random ID
                    template = template.replace(/faq_question_new/g, 'faq_question_' + newId);
                    template = template.replace(/faq_answer_new/g, 'faq_answer_' + newId);
                    template = template.replace(/faq_is_open\[new\]/g, 'faq_is_open[' + newId + ']');
                    
                    // Add new item to the list
                    $('#jthem-faq-items').append(template);
                    
                    // Update hidden input value
                    $('#jthem-faq-items .jthem-faq-item:last-child input[name="faq_item_id[]"]').val(newId);
                });
                
                // Remove FAQ item
                $(document).on('click', '.faq-remove-item', function() {
                    if (confirm('<?php echo esc_js(__('آیا مطمئن هستید که می‌خواهید این سوال را حذف کنید؟', 'JTheme')); ?>')) {
                        $(this).closest('.jthem-faq-item').remove();
                    }
                });
                
                // Toggle FAQ items
                $(document).on('click', '.handlediv', function() {
                    var $el = $(this);
                    var $postbox = $el.closest('.postbox');
                    var $inside = $postbox.find('.inside');
                    
                    $inside.toggle();
                    $el.attr('aria-expanded', $inside.is(':visible'));
                });
            });
        </script>
    </div>
    <?php
}

/**
 * Save FAQ items
 */
function jthem_save_faq_items() {
    // Check if our nonce is set
    if (!isset($_POST['jthem_faq_nonce'])) {
        return;
    }
    
    // Verify the nonce
    if (!wp_verify_nonce($_POST['jthem_faq_nonce'], 'jthem_faq_nonce')) {
        return;
    }
    
    // Check user capabilities
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    
    // Get form data
    $faq_item_ids = isset($_POST['faq_item_id']) ? (array) $_POST['faq_item_id'] : array();
    $faq_questions = isset($_POST['faq_question']) ? (array) $_POST['faq_question'] : array();
    $faq_answers = isset($_POST['faq_answer']) ? (array) $_POST['faq_answer'] : array();
    $faq_is_open = isset($_POST['faq_is_open']) ? (array) $_POST['faq_is_open'] : array();
    
    $faq_items = array();
    
    // Process each FAQ item
    foreach ($faq_item_ids as $index => $id) {
        // Skip if no question or answer
        if (empty($faq_questions[$index]) || empty($faq_answers[$index])) {
            continue;
        }
        
        // Generate a new ID if it's a new item
        if (strpos($id, 'new_') === 0) {
            $id = uniqid();
        }
        
        // Save the item
        $faq_items[$id] = array(
            'question' => sanitize_text_field($faq_questions[$index]),
            'answer' => wp_kses_post($faq_answers[$index]),
            'is_open' => isset($faq_is_open[$id]) ? true : false,
        );
    }
    
    // Update the option
    update_option('jthem_faq_items', $faq_items);
    
    // Add admin notice
    add_settings_error(
        'jthem_faq_notices',
        'jthem_faq_updated',
        __('سوالات متداول با موفقیت ذخیره شدند.', 'JTheme'),
        'updated'
    );
}

/**
 * Register admin scripts and styles
 */
function jthem_faq_admin_scripts($hook) {
    // Only load on our admin page
    if ($hook != 'appearance_page_jthem-faq-manager') {
        return;
    }
    
    // Load WordPress core scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-sortable');
    
    // Load TinyMCE for rich text editing
    wp_enqueue_editor();
}
add_action('admin_enqueue_scripts', 'jthem_faq_admin_scripts'); 