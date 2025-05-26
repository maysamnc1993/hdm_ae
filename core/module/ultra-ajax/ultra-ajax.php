<?php
/**
 * Ultra-ajax WPAjaxHandler: A zero-config AJAX solution for WordPress
 * 
 * @author Mohsen Hashempour
 * @version 2.1
 */

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    die('Access denied.');
}

// Import required WordPress files for media handling
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

class WPAjaxHandler {
    private static $initialized = false;
    private static $nonce_key = 'wp_ajax_nonce';
    private static $registered_actions = [];
    
    /**
     * Register an AJAX action with one line
     *  
     * 
     * @param string $action   The AJAX action name
     * @param callable|null $callback Function to run (optional)
     * @param array $options   Additional options (optional)
     */
    public static function register($action, $callback = null, $options = []) {
        // Validate action name
        if (empty($action) || !is_string($action)) {
            self::log_error('Invalid AJAX action name. Must be a non-empty string.');
            return;
        }
        
        // Default options
        $defaults = [
            'public' => true,          // Allow non-logged in users
            'nonce' => true,            // Use nonce security
            'js_namespace' => null,     // Custom JS namespace
            'error_messages' => [       // Custom error messages
                'not_logged_in' => 'Access denied: You must be logged in to perform this action.',
                'invalid_nonce' => 'Security verification failed. Please refresh the page and try again.',
                'missing_data' => 'Required data is missing from the request.',
                'general_error' => 'An unexpected error occurred while processing your request.'
            ]
        ];
        
        $options = array_merge($defaults, $options);
        
        // Track registered actions
        self::$registered_actions[$action] = [
            'public' => $options['public'],
            'nonce' => $options['nonce'],
            'nonce_key' => isset($options['nonce_key']) ? $options['nonce_key'] : 'nonce'
        ];
        
        // Initialize just once
        self::initialize();
        
        // Default callback handler
        if (!$callback) {
            $callback = function() use ($action) {
                return "Action $action completed successfully!";
            };
        }
        
        // Create the handler function
        $handler = function() use ($action, $callback, $options) {
            $response = ['success' => false, 'data' => null, 'code' => 'unknown_error'];
            
            try {
                // Check if user is logged in when required
                if (!$options['public'] && !is_user_logged_in()) {
                    wp_send_json_error([
                        'message' => $options['error_messages']['not_logged_in'],
                        'code' => 'not_logged_in'
                    ], 403);
                    exit;
                }
                
                // Check nonce if enabled
                if ($options['nonce']) {
                    $nonce_key = isset($options['nonce_key']) ? $options['nonce_key'] : 'nonce';
                    $nonce_value = isset($_REQUEST[$nonce_key]) ? $_REQUEST[$nonce_key] : '';
                    $nonce_name = is_string($options['nonce']) ? $options['nonce'] : self::$nonce_key;
                    
                    if (!$nonce_value || !\wp_verify_nonce($nonce_value, $nonce_name)) {
                        wp_send_json_error([
                            'message' => $options['error_messages']['invalid_nonce'],
                            'code' => 'invalid_nonce'
                        ], 403);
                        exit;
                    }
                }
                
                // Process the result
                $result = call_user_func($callback);
                
                // Handle different return types
                if (is_array($result) && isset($result['success'])) {
                    // Developer returned a structured response
                    if ($result['success']) {
                        $response = [
                            'success' => true,
                            'data' => isset($result['data']) ? $result['data'] : null,
                            'code' => isset($result['code']) ? $result['code'] : 'success'
                        ];
                        
                        // Add message if available
                        if (isset($result['message'])) {
                            $response['message'] = $result['message'];
                        }
                    } else {
                        $response = [
                            'success' => false,
                            'data' => isset($result['data']) ? $result['data'] : null,
                            'message' => isset($result['message']) ? $result['message'] : $options['error_messages']['general_error'],
                            'code' => isset($result['code']) ? $result['code'] : 'error'
                        ];
                    }
                } else {
                    // Simple response
                    $response = [
                        'success' => true,
                        'data' => $result,
                        'code' => 'success'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'code' => 'exception',
                    'data' => WP_DEBUG ? [
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ] : null
                ];
                
                self::log_error('Exception in AJAX handler: ' . $e->getMessage(), $e);
            }
            
            // Send JSON response
            if ($response['success']) {
                wp_send_json_success($response['data']);
            } else {
                $error_data = isset($response['data']) ? $response['data'] : null;
                $error_message = isset($response['message']) ? $response['message'] : $options['error_messages']['general_error'];
                
                wp_send_json_error([
                    'message' => $error_message,
                    'code' => $response['code'],
                    'data' => $error_data
                ]);
            }
        };
        
        // Register the WordPress hooks
        add_action('wp_ajax_' . $action, $handler);
        if ($options['public']) {
            add_action('wp_ajax_nopriv_' . $action, $handler);
        }
        
        // Register the action for JS
        self::register_js_action($action, $options['js_namespace']);
    }
    
    /**
     * Initialize the system
     */
    private static function initialize() {
        if (self::$initialized) {
            return;
        }
        
        // Register the script loading hook
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
        
        // Add REST API endpoint for system status (useful for debugging)
        add_action('rest_api_init', function() {
            register_rest_route('wp-ajax-handler/v1', '/status', [
                'methods' => 'GET',
                'permission_callback' => function() {
                    return current_user_can('manage_options');
                },
                'callback' => function() {
                    return [
                        'status' => 'active',
                        'registered_actions' => self::$registered_actions,
                        'version' => '2.1'
                    ];
                }
            ]);
        });
        
        self::$initialized = true;
    }
    
    /**
     * Enqueue necessary scripts
     */
    public static function enqueue_scripts() {
        // Only enqueue if we have registered AJAX actions
        if (!self::$initialized || empty(self::$registered_actions)) {
            return;
        }
        
        // Enqueue the main script
        wp_enqueue_script(
            'wp-ajax-handler', 
            get_template_directory_uri() . '/src/js/core/wp-ajax.js',
            ['jquery'],
            filemtime(get_template_directory() . '/src/js/core/wp-ajax.js'),
            true
        );
        
        // Get actions and determine if we need multiple nonces
        $actions = array_keys(self::$registered_actions);
        $action_nonces = [];
        
        // Get the nonce for each registered action
        foreach (self::$registered_actions as $action => $options) {
            if (!empty($options['nonce']) && is_string($options['nonce'])) {
                $action_nonces[$action] = \wp_create_nonce($options['nonce']);
            }
        }
        
        // Use a single generic nonce if no specific nonces are defined
        $default_nonce = \wp_create_nonce(self::$nonce_key);
        
        // Pass the basics to JS along with registered actions info
        wp_localize_script('wp-ajax-handler', 'wpAjaxData', [
            'url' => admin_url('admin-ajax.php'),
            'nonce' => $default_nonce,
            'actions' => $actions,
            'action_nonces' => $action_nonces,
            'is_user_logged_in' => is_user_logged_in()
        ]);
    }
    
    /**
     * Register a specific action for JS
     */
    private static function register_js_action($action, $namespace = null) {
        // If no specific namespace, use the global one
        if (!$namespace) {
            return;
        }
        
        // Register a custom namespace
        add_action('wp_footer', function() use ($action, $namespace) {
            echo "<script>
                if (typeof {$namespace} === 'undefined') {
                    var {$namespace} = {};
                }
                {$namespace}.{$action} = function(data, callback) {
                    wpAjax('{$action}', data, callback);
                };
            </script>";
        });
    }
    
    /**
     * Log error to WordPress debug log if WP_DEBUG is enabled
     */
    private static function log_error($message, $exception = null) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('WPAjaxHandler Error: ' . $message);
            
            if ($exception instanceof Exception) {
                error_log('Exception: ' . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine());
            }
        }
    }
    
    /**
     * Get a list of all registered AJAX actions
     */
    public static function get_registered_actions() {
        return self::$registered_actions;
    }
}

/**
 * Customer Interaction AJAX Handler
 * 
 * Handles AJAX requests for customer interactions and attachments
 */

/**
 * Handle customer interaction AJAX request - add comment or file
 * 
 * @return array
 */
function handle_customer_interaction() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'crm_interaction_nonce')) {
        return [
            'success' => false,
            'message' => 'خطای امنیتی: لطفا صفحه را رفرش کنید و دوباره تلاش کنید.',
            'code' => 'invalid_nonce'
        ];
    }
    
    // Check required data
    if (!isset($_POST['customer_id']) || empty($_POST['customer_id'])) {
        return [
            'success' => false,
            'message' => 'شناسه مشتری وارد نشده است.',
            'code' => 'missing_customer_id'
        ];
    }
    
    $customer_id = absint($_POST['customer_id']);
    $content = isset($_POST['interaction_content']) ? sanitize_textarea_field($_POST['interaction_content']) : '';
    $content = trim($content);
    
    // Check customer exists
    $customer = get_post($customer_id);
    if (!$customer || $customer->post_type !== 'customer') {
        return [
            'success' => false,
            'message' => 'مشتری مورد نظر یافت نشد.',
            'code' => 'customer_not_found'
        ];
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $customer_id)) {
        return [
            'success' => false,
            'message' => 'شما اجازه افزودن تعامل برای این مشتری را ندارید.',
            'code' => 'permission_denied'
        ];
    }
    
    // Set default values for response
    $interaction_type = 'note';
    $attachment_id = 0;
    $attachment_url = '';
    $file_name = '';
    
    // Process file upload if present
    if (isset($_FILES['interaction_file']) && !empty($_FILES['interaction_file']['name'])) {
        // Define allowed file types
        $allowed_types = [
            'jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 
            'xls', 'xlsx', 'txt', 'rtf', 'zip', 'rar'
        ];
        
        $file = $_FILES['interaction_file'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Validate file type
        if (!in_array($file_ext, $allowed_types)) {
            return [
                'success' => false,
                'message' => 'نوع فایل مجاز نیست. فقط فایل‌های تصویری، PDF، Word، Excel و فشرده مجاز هستند.',
                'code' => 'invalid_file_type',
                'file_ext' => $file_ext
            ];
        }
        
        // WordPress upload handling
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($file, $upload_overrides);
        
        if (isset($movefile['error'])) {
            return [
                'success' => false,
                'message' => 'خطا در آپلود فایل: ' . $movefile['error'],
                'code' => 'upload_error'
            ];
        }
        
        // Create attachment
        if (wp_attachment_is_image($attachment_id)) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $movefile['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);
        }
        
        // Link attachment to customer
        update_post_meta($attachment_id, '_crm_customer_id', $customer_id);
        update_post_meta($attachment_id, '_crm_user_id', get_current_user_id());
        
        // Set attachment info for response
        $attachment_url = wp_get_attachment_url($attachment_id);
        $file_name = basename($movefile['file']);
        
        // If we have a file, set interaction type
        if (empty($content)) {
            $interaction_type = 'file';
        } else {
            $interaction_type = 'both';
        }
    } else if (empty($content)) {
        // No file and no content
        return [
            'success' => false,
            'message' => 'متن یا فایل برای افزودن تعامل وارد نشده است.',
            'code' => 'empty_interaction'
        ];
    }
    
    // Create interaction post for better tracking
    $current_user = wp_get_current_user();
    $interaction_id = wp_insert_post([
        'post_type' => 'customer_interaction',
        'post_title' => sprintf('تعامل با %s', get_the_title($customer_id)),
        'post_content' => $content,
        'post_status' => 'publish',
        'post_author' => get_current_user_id()
    ]);
    
    if (is_wp_error($interaction_id)) {
        // If there was an error creating the interaction but we have a file,
        // still return success with the file info
        if ($attachment_id > 0) {
            return [
                'success' => true,
                'message' => 'فایل با موفقیت آپلود شد اما در ثبت تعامل خطایی رخ داد: ' . $interaction_id->get_error_message(),
                'interaction_id' => 0,
                'attachment_id' => $attachment_id,
                'attachment_url' => $attachment_url,
                'file_name' => $file_name,
                'file_type' => $file_ext,
                'content' => $content,
                'interaction_type' => 'file',
                'user_name' => $current_user->display_name,
                'user_avatar' => get_avatar_url($current_user->ID),
            ];
        }
        
        return [
            'success' => false,
            'message' => 'خطا در ثبت تعامل: ' . $interaction_id->get_error_message(),
            'code' => 'interaction_error'
        ];
    }
    
    // Link interaction to customer and user
    update_post_meta($interaction_id, '_crm_customer_id', $customer_id);
    update_post_meta($interaction_id, '_crm_user_id', get_current_user_id());
    update_post_meta($interaction_id, '_crm_interaction_type', $interaction_type);
    
    // Link attachment to interaction if exists
    if ($attachment_id > 0) {
        update_post_meta($interaction_id, '_crm_attachment_id', $attachment_id);
        update_post_meta($attachment_id, '_crm_interaction_id', $interaction_id);
    }
    
    // Success response with all data needed for immediate UI update
    return [
        'success' => true,
        'message' => 'تعامل با موفقیت ثبت شد.',
        'interaction_id' => $interaction_id,
        'attachment_id' => $attachment_id,
        'attachment_url' => $attachment_url,
        'file_name' => $file_name,
        'file_type' => $file_ext ?? '',
        'content' => $content,
        'interaction_type' => $interaction_type,
        'user_name' => $current_user->display_name,
        'user_avatar' => get_avatar_url($current_user->ID),
        'date' => current_time('mysql')
    ];
}

/**
 * Delete a customer attachment and optionally its associated interaction
 * 
 * @return array Response data
 */
function handle_delete_attachment() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'crm_interaction_nonce')) {
        return [
            'success' => false,
            'message' => 'خطای امنیتی: لطفا صفحه را رفرش کنید و دوباره تلاش کنید.',
            'code' => 'invalid_nonce'
        ];
    }
    
    // Verify attachment ID
    if (!isset($_POST['attachment_id']) || empty($_POST['attachment_id'])) {
        return [
            'success' => false,
            'message' => 'شناسه فایل وارد نشده است.',
            'code' => 'missing_attachment_id'
        ];
    }

    $attachment_id = absint($_POST['attachment_id']);
    
    // Verify attachment exists
    $attachment = get_post($attachment_id);
    if (!$attachment || $attachment->post_type !== 'attachment') {
        return [
            'success' => false,
            'message' => 'فایل معتبر نیست یا یافت نشد.',
            'code' => 'invalid_attachment'
        ];
    }
    
    // Get customer ID
    $customer_id = get_post_meta($attachment_id, '_crm_customer_id', true);
    
    // Check permissions
    if (!current_user_can('delete_post', $attachment_id) && !current_user_can('edit_post', $customer_id)) {
        return [
            'success' => false,
            'message' => 'شما اجازه حذف این فایل را ندارید.',
            'code' => 'permission_denied'
        ];
    }
    
    // Find related interaction
    $interaction_id = get_post_meta($attachment_id, '_crm_interaction_id', true);
    
    // If no direct relationship, search for interactions with this attachment
    if (!$interaction_id) {
        $args = [
            'post_type' => 'customer_interaction',
            'posts_per_page' => 1,
            'meta_query' => [
                [
                    'key' => '_crm_attachment_id',
                    'value' => $attachment_id
                ]
            ]
        ];
        
        $interactions = get_posts($args);
        if (!empty($interactions)) {
            $interaction_id = $interactions[0]->ID;
        }
    }
    
    // Delete the attachment
    $deleted = wp_delete_attachment($attachment_id, true);
    
    if (!$deleted) {
        return [
            'success' => false,
            'message' => 'خطا در حذف فایل.',
            'code' => 'delete_failed'
        ];
    }
    
    // Update interaction if exists
    if ($interaction_id) {
        // If interaction is file-only, delete it too
        $interaction_type = get_post_meta($interaction_id, '_crm_interaction_type', true);
        if ($interaction_type === 'file') {
            wp_delete_post($interaction_id, true);
        } else {
            // Just remove the attachment link
            delete_post_meta($interaction_id, '_crm_attachment_id');
            update_post_meta($interaction_id, '_crm_interaction_type', 'note');
        }
    }
    
    // Success
    return [
        'success' => true,
        'message' => 'فایل با موفقیت حذف شد.',
        'attachment_id' => $attachment_id,
        'interaction_id' => $interaction_id,
        'action' => 'delete'
    ];
}

// Register the AJAX handlers
if (class_exists('WPAjaxHandler')) {
    \WPAjaxHandler::register('crm_add_customer_interaction', 'handle_add_customer_interaction_comments', [
        'public' => false, // Only for logged-in users
        'nonce' => 'crm_interaction_nonce',  // Use this specific nonce name
        'nonce_key' => 'nonce',  // Match the key expected by wp-ajax.js
        'formatted_response' => true  // Ensure WP-formatted response
    ]);
    
    \WPAjaxHandler::register('crm_delete_customer_attachment', 'handle_delete_customer_attachment', [
        'public' => false, // Only for logged-in users
        'nonce' => 'crm_interaction_nonce',  // Use this specific nonce name
        'nonce_key' => 'nonce',  // Match the key expected by wp-ajax.js
        'formatted_response' => true  // Ensure WP-formatted response
    ]);
}