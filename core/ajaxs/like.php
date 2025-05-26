<?php
/**
 * AJAX handler for post likes/dislikes
 */
function helepre_handle_post_reaction() {
    // Process likes and dislikes for posts
    // if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'post_reaction_nonce')) {
    //     wp_send_json_error([
    //         'message' => __('Security verification failed', 'helepre'),
    //         'code' => 'invalid_nonce'
    //     ]);
    // }
    
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $reaction_type = isset($_POST['reaction_type']) ? sanitize_text_field($_POST['reaction_type']) : '';
    
    if (!$post_id || !in_array($reaction_type, ['like', 'dislike'])) {
        wp_send_json_error([
            'message' => __('Invalid request parameters', 'helepre'),
            'code' => 'invalid_params'
        ]);
    }
    
    // Get current count
    $meta_key = $reaction_type . '_count';
    $current_count = get_post_meta($post_id, $meta_key, true) ?: 0;
    
    // Store reaction in user meta to prevent duplicate reactions
    $user_id = get_current_user_id();
    $cookie_key = 'helepre_post_' . $reaction_type . '_' . $post_id;
    
    if ($user_id) {
        // For logged-in users, use user meta
        $user_reacted = get_user_meta($user_id, 'helepre_post_reaction_' . $post_id, true);
        
        if ($user_reacted === $reaction_type) {
            // User already reacted this way, remove reaction
            delete_user_meta($user_id, 'helepre_post_reaction_' . $post_id);
            update_post_meta($post_id, $meta_key, max(0, $current_count - 1));
            $new_count = max(0, $current_count - 1);
            $action = 'removed';
            $message = __('واکنش شما حذف شد', 'helepre');
        } elseif ($user_reacted) {
            // User had a different reaction before, update it
            update_user_meta($user_id, 'helepre_post_reaction_' . $post_id, $reaction_type);
            
            // Update the counts
            $opposite_type = $reaction_type === 'like' ? 'dislike' : 'like';
            $opposite_count = get_post_meta($post_id, $opposite_type . '_count', true) ?: 0;
            
            update_post_meta($post_id, $opposite_type . '_count', max(0, $opposite_count - 1));
            update_post_meta($post_id, $meta_key, $current_count + 1);
            
            $new_count = $current_count + 1;
            $action = 'changed';
            $message = sprintf(__(' %s ثبت شد', 'helepre'), $reaction_type === 'like' ? __('لایک', 'helepre') : __('دیس لایک', 'helepre'));
        } else {
            // New reaction
            update_user_meta($user_id, 'helepre_post_reaction_' . $post_id, $reaction_type);
            update_post_meta($post_id, $meta_key, $current_count + 1);
            $new_count = $current_count + 1;
            $action = 'added';
            $message = sprintf(__(' %s ثبت شد', 'helepre'), $reaction_type === 'like' ? __('لایک', 'helepre') : __('دیس لایک', 'helepre'));
        }
    } else {
        // For non-logged in users, use cookies
        $has_reacted = isset($_COOKIE[$cookie_key]) ? $_COOKIE[$cookie_key] : false;
        
        if ($has_reacted) {
            // Already reacted, remove
            setcookie($cookie_key, '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN);
            update_post_meta($post_id, $meta_key, max(0, $current_count - 1));
            $new_count = max(0, $current_count - 1);
            $action = 'removed';
            $message = __('واکنش شما حذف شد', 'helepre');
        } else {
            // New reaction
            setcookie($cookie_key, '1', time() + 60 * 60 * 24 * 365, COOKIEPATH, COOKIE_DOMAIN);
            update_post_meta($post_id, $meta_key, $current_count + 1);
            $new_count = $current_count + 1;
            $action = 'added';
            $message = sprintf(__('شما %s این پست', 'helepre'), $reaction_type === 'like' ? __('لایک', 'helepre') : __('دیس لایک', 'helepre'));
        }
    }
    
    // Get the updated opposite count for a complete UI update
    $opposite_type = $reaction_type === 'like' ? 'dislike' : 'like';
    $opposite_count = get_post_meta($post_id, $opposite_type . '_count', true) ?: 0;
    
    wp_send_json_success([
        'count' => $new_count,
        'opposite_count' => $opposite_count,
        'action' => $action,
        'type' => $reaction_type,
        'opposite_type' => $opposite_type,
        'post_id' => $post_id,
        'message' => $message
    ]);
}

// Register the AJAX handler if WPAjaxHandler class exists
if (class_exists('WPAjaxHandler')) {
    WPAjaxHandler::register('helepre_post_reaction', 'helepre_handle_post_reaction', [
        'public' => true, // Allow non-logged in users
        // 'nonce' => 'post_reaction_nonce',
        // 'nonce_key' => 'nonce'
    ]);
} else {
    // Fallback if WPAjaxHandler is not available
    add_action('wp_ajax_helepre_post_reaction', 'helepre_handle_post_reaction');
    add_action('wp_ajax_nopriv_helepre_post_reaction', 'helepre_handle_post_reaction');
}
