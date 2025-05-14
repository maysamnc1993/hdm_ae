<?php
/**
 * Example usage of the enhanced WPAjaxHandler
 * 
 * Include this in your theme's functions.php
 */

// First, include the class
require_once get_template_directory() . '/core/module/ultra-ajax.php';

// EXAMPLE 1: Ultra-simple one-liner
WPAjaxHandler::register('hello_world');

// EXAMPLE 2: With a custom callback and proper error handling
WPAjaxHandler::register('greet_user', function() {
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    
    // Return error if no name provided
    if (empty($name)) {
        return [
            'success' => false,
            'message' => 'لطفا نام خود را وارد کنید.',
            'code' => 'missing_name'
        ];
    }
    
    return [
        'success' => true,
        'data' => "سلام, $name!",
        'code' => 'greeting_success'
    ];
},['public' => true]);

// EXAMPLE 3: Public action with custom error messages
WPAjaxHandler::register('get_post_count', function() {
    // Check if WP_Query is needed
    $post_type = isset($_REQUEST['post_type']) ? sanitize_text_field($_REQUEST['post_type']) : 'post';
    
    // Validate post type exists
    if (!post_type_exists($post_type)) {
        return [
            'success' => false,
            'message' => "Invalid post type: $post_type",
            'code' => 'invalid_post_type'
        ];
    }
    
    // Get post count
    $count = wp_count_posts($post_type)->publish;
    
    return [
        'success' => true,
        'data' => [
            'count' => $count,
            'post_type' => $post_type
        ],
        'code' => 'count_retrieved'
    ];
}, [
    'public' => true,
    'error_messages' => [
        'general_error' => 'Failed to retrieve post count.'
    ]
]);

// EXAMPLE 4: Handling file uploads
WPAjaxHandler::register('upload_attachment', function() {
    // Check if file was sent
    if (!isset($_FILES['file'])) {
        return [
            'success' => false,
            'message' => 'No file was uploaded.',
            'code' => 'no_file'
        ];
    }
    
    // Check for upload errors
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error_message = 'Unknown upload error.';
        
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $error_message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message = 'No file was uploaded.';
                break;
        }
        
        return [
            'success' => false,
            'message' => $error_message,
            'code' => 'upload_error'
        ];
    }
    
    // Require WordPress media handling
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    
    // Handle file upload
    $attachment_id = media_handle_upload('file', 0);
    
    if (is_wp_error($attachment_id)) {
        return [
            'success' => false,
            'message' => $attachment_id->get_error_message(),
            'code' => $attachment_id->get_error_code()
        ];
    }
    
    // Get attachment details
    $attachment_url = wp_get_attachment_url($attachment_id);
    
    return [
        'success' => true,
        'data' => [
            'id' => $attachment_id,
            'url' => $attachment_url,
            'filename' => basename($attachment_url)
        ],
        'code' => 'upload_success'
    ];
});

// EXAMPLE 5: Database operations with transaction safety
WPAjaxHandler::register('save_user_data', function() {
    global $wpdb;
    
    // Get required parameters
    $user_id = get_current_user_id();
    $data = isset($_POST['data']) ? json_decode(stripslashes($_POST['data']), true) : [];
    
    if (empty($data) || !is_array($data)) {
        return [
            'success' => false,
            'message' => 'Invalid or missing data.',
            'code' => 'invalid_data'
        ];
    }
    
    // Start transaction
    $wpdb->query('START TRANSACTION');
    
    try {
        // Save each piece of data
        foreach ($data as $key => $value) {
            $key = sanitize_text_field($key);
            $value = sanitize_text_field($value);
            
            // Save to user meta
            $result = update_user_meta($user_id, "custom_data_{$key}", $value);
            
            if ($result === false) {
                throw new Exception("Failed to save data for key: {$key}");
            }
        }
        
        // All good, commit transaction
        $wpdb->query('COMMIT');
        
        return [
            'success' => true,
            'data' => [
                'message' => 'All data saved successfully.',
                'count' => count($data)
            ],
            'code' => 'data_saved'
        ];
    } catch (Exception $e) {
        // Something went wrong, rollback
        $wpdb->query('ROLLBACK');
        
        return [
            'success' => false,
            'message' => $e->getMessage(),
            'code' => 'save_failed'
        ];
    }
});
