<?php

/**
 * AJAX Comment Handler
 * Registers with WPAjaxHandler to process comment submissions
 */

/**
 * Fallback comment template if custom_comment_template() is undefined
 */
function fallback_comment_template($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
?>
    <li id="comment-<?php comment_ID(); ?>" class="comment depth-<?php echo $depth; ?>">
        <div class="comment-body">
            <div class="comment-author"><?php echo get_comment_author(); ?></div>
            <div class="comment-content"><?php comment_text(); ?></div>
            <div class="comment-metadata">
                <time><?php echo get_comment_date('j F Y، g:i a'); ?></time>
            </div>
        </div>
    </li>
<?php
}

/**
 * Handle AJAX comment submission
 *
 * @return array Response data
 */
function handle_ajax_comment_submission()
{
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'comment_nonce')) {
        return [
            'success' => false,
            'message' => 'خطای امنیتی: لطفا صفحه را رفرش کنید و دوباره تلاش کنید.',
            'code' => 'invalid_nonce'
        ];
    }

    // Sanitize inputs
    $comment_post_id = isset($_POST['comment_post_ID']) ? absint($_POST['comment_post_ID']) : 0;
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $comment_content = isset($_POST['comment']) ? sanitize_textarea_field($_POST['comment']) : '';

    // Check required data
    if (empty($comment_content)) {
        return [
            'success' => false,
            'message' => 'لطفاً متن نظر را وارد کنید.',
            'code' => 'empty_comment'
        ];
    }

    if (!$comment_post_id) {
        return [
            'success' => false,
            'message' => 'شناسه مطلب نامعتبر است.',
            'code' => 'invalid_post_id'
        ];
    }

    // Check if post exists and comments are open
    $post = get_post($comment_post_id);
    if (!$post) {
        return [
            'success' => false,
            'message' => 'مطلب مورد نظر یافت نشد.',
            'code' => 'post_not_found'
        ];
    }

    if (!comments_open($comment_post_id)) {
        return [
            'success' => false,
            'message' => 'امکان ارسال نظر برای این مطلب وجود ندارد.',
            'code' => 'comments_closed'
        ];
    }

    // Prepare comment data
    $comment_data = [
        'comment_post_ID' => $comment_post_id,
        'comment_parent' => $comment_parent,
        'comment_content' => $comment_content,
        'comment_type' => 'comment',
    ];

    // Handle logged-in users
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $comment_data['user_id'] = $user->ID;
        $comment_data['comment_author'] = $user->display_name;
        $comment_data['comment_author_email'] = $user->user_email;
        $comment_data['comment_author_url'] = $user->user_url;
    } else {
        // Handle guest comments
        if (!isset($_POST['author']) || empty($_POST['author'])) {
            return [
                'success' => false,
                'message' => 'لطفاً نام خود را وارد کنید.',
                'code' => 'empty_author'
            ];
        }

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return [
                'success' => false,
                'message' => 'لطفاً ایمیل خود را وارد کنید.',
                'code' => 'empty_email'
            ];
        }

        if (!is_email($_POST['email'])) {
            return [
                'success' => false,
                'message' => 'ایمیل وارد شده معتبر نیست.',
                'code' => 'invalid_email'
            ];
        }

        $comment_data['comment_author'] = sanitize_text_field($_POST['author']);
        $comment_data['comment_author_email'] = sanitize_email($_POST['email']);

        // Set comment cookies if requested
        if (isset($_POST['wp-comment-cookies-consent']) && $_POST['wp-comment-cookies-consent'] === 'yes') {
            $comment_author = $comment_data['comment_author'];
            $comment_author_email = $comment_data['comment_author_email'];

            setcookie('comment_author_' . COOKIEHASH, $comment_author, time() + 30000000, COOKIEPATH, COOKIE_DOMAIN);
            setcookie('comment_author_email_' . COOKIEHASH, $comment_author_email, time() + 30000000, COOKIEPATH, COOKIE_DOMAIN);
        }
    }

    // Insert the comment
    $comment_id = wp_insert_comment($comment_data);

    if (!$comment_id) {
        return [
            'success' => false,
            'message' => 'خطا در ثبت نظر. لطفاً مجدداً تلاش کنید.',
            'code' => 'comment_error'
        ];
    }

    // Check if comment requires moderation
    $comment = get_comment($comment_id);
    $comments_count = get_comments_number($comment_post_id);

    if ($comment->comment_approved === '1') {
        // Comment was approved immediately
        global $post;
        $post = get_post($comment_post_id);

        ob_start();
        $GLOBALS['comment'] = $comment;
        if (function_exists('custom_comment_template')) {
            custom_comment_template($comment, array('style' => 'ul', 'short_ping' => true), 1);
        } else {
            fallback_comment_template($comment, array('style' => 'ul', 'short_ping' => true), 1);
        }
        $comment_html = ob_get_clean();

        return [
            'success' => true,
            'message' => 'نظر شما با موفقیت ثبت شد.',
            'comment_id' => $comment_id,
            'comment_parent' => $comment_parent,
            'html' => $comment_html,
            'comments_count' => $comments_count
        ];
    } else {
        // Comment is awaiting moderation
        return [
            'success' => true,
            'message' => 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.',
            'moderation' => true,
            'comments_count' => $comments_count
        ];
    }
}

// Register AJAX handler if WPAjaxHandler class exists
if (class_exists('WPAjaxHandler')) {
    WPAjaxHandler::register('submit_comment', 'handle_ajax_comment_submission', [
        'public' => true,
        'nonce' => 'comment_nonce',
        'nonce_key' => 'nonce',
    ]);
} else {
    error_log('Error: WPAjaxHandler class not found.');
}
