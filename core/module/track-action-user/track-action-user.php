<?php
/**
 * User Activity Tracking Module
 *
 * A lightweight, optimized module for tracking and displaying user actions across WordPress sites.
 * This module provides an easy way to log user activities, store them efficiently, and display them
 * in both admin and user-facing contexts.
 *
 * @package     RefactorCRM
 * @subpackage  Modules/UserActivityTracking
 * @version     1.1.0
 *
 * HOW TO USE THIS MODULE:
 * 
 * 1. TRACKING AN ACTION:
 *    Track any user action using the track_user_action() function:
 *    
 *    track_user_action($user_id, $action, $context, $details = []);
 *    
 *    Example:
 *    track_user_action(
 *        get_current_user_id(),
 *        'login',
 *        'authentication',
 *        ['ip_address' => $_SERVER['REMOTE_ADDR']]
 *    );
 *
 * 2. ADDING CUSTOM ACTIONS:
 *    You can use ANY action name when calling track_user_action(). If you want a custom 
 *    Persian display name for your action, add it to the $actions array in the 
 *    get_action_display_name() function:
 *    
 *    // In your code, call with any action name:
 *    track_user_action(get_current_user_id(), 'approve', 'customer', ['id' => $customer_id]);
 *    
 *    // Then add a translation in the get_action_display_name() function:
 *    function get_action_display_name($action) {
 *        $actions = [
 *            // Existing actions
 *            'approve' => 'تایید', // Your new action
 *        ];
 *        return isset($actions[$action]) ? $actions[$action] : $action;
 *    }
 *    
 * 3. DISPLAYING USER ACTIVITY:
 *    Get a user's activity using get_user_activity() function:
 *    
 *    $activities = get_user_activity($user_id, $limit = 10, $type = null);
 *    
 *    Or simply display it with:
 *    display_user_activity($user_id, $limit = 10);
 *
 * 4. COMMON BUILT-IN ACTIONS:
 *    - 'login' - User logs in
 *    - 'logout' - User logs out
 *    - 'register' - New user registration
 *    - 'create' - Creating content
 *    - 'update' - Updating content
 *    - 'delete' - Deleting content
 *    - 'delete-failed' - Failed deletion attempt
 *    - 'view' - Viewing content
 *    - 'download' - Downloading files
 *    - 'upload' - Uploading files
 *    - 'password_reset' - Resetting password
 *    - 'settings_change' - Changing settings
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Define constants
define('USER_ACTIVITY_VERSION', '1.0.0');
define('USER_ACTIVITY_TABLE', 'user_activity_logs');

/**
 * Initialize the user activity tracking module
 */
function init_user_activity_tracking() {
    // Include required files
    require_once(dirname(__FILE__) . '/class-user-activity-list-table.php');
    
    // Create database table if it doesn't exist
    create_user_activity_table();
    
    // Register hooks to track common actions
    register_default_activity_hooks();
    
    // Register admin dashboard widget
    add_action('wp_dashboard_setup', 'register_activity_dashboard_widget');
    
    // Register shortcode for frontend
    add_shortcode('user_activity', 'user_activity_shortcode');
}
add_action('init', 'init_user_activity_tracking');

/**
 * Create the user activity database table
 */
function create_user_activity_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
    
    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            action varchar(100) NOT NULL,
            context varchar(50) NOT NULL,
            details longtext DEFAULT NULL,
            action_time datetime DEFAULT CURRENT_TIMESTAMP,
            ip_address varchar(45) DEFAULT NULL,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY action (action),
            KEY context (context),
            KEY action_time (action_time)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/**
 * Track a user action
 *
 * @param int    $user_id The ID of the user performing the action
 * @param string $action  The action being performed (login, edit, delete, etc.)
 * @param string $context The context of the action (post, page, user, etc.)
 * @param array  $details Optional additional details about the action
 * @return int|false      The ID of the new activity record, or false on failure
 */
function track_user_action($user_id, $action, $context, $details = []) {
    global $wpdb;
    
    // Ensure user ID is valid
    $user_id = absint($user_id);
    if ($user_id <= 0) {
        return false;
    }
    
    // Sanitize inputs
    $action = sanitize_text_field($action);
    $context = sanitize_text_field($context);
    
    // Get IP address
    $ip_address = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    
    // Insert the activity record
    $result = $wpdb->insert(
        $wpdb->prefix . USER_ACTIVITY_TABLE,
        [
            'user_id' => $user_id,
            'action' => $action,
            'context' => $context,
            'details' => !empty($details) ? json_encode($details) : null,
            'ip_address' => $ip_address
        ],
        ['%d', '%s', '%s', '%s', '%s']
    );
    
    if ($result === false) {
        return false;
    }
    
    return $wpdb->insert_id;
}

/**
 * Get user activity records
 *
 * @param int    $user_id The ID of the user
 * @param int    $limit   Maximum number of records to retrieve
 * @param string $context Optional context filter
 * @param string $action  Optional action filter
 * @return array          Array of activity records
 */
function get_user_activity($user_id, $limit = 10, $context = null, $action = null) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
    $user_id = absint($user_id);
    $limit = absint($limit);
    
    // Build query
    $sql = "SELECT * FROM $table_name WHERE user_id = %d";
    $params = [$user_id];
    
    // Add optional filters
    if (!empty($context)) {
        $sql .= " AND context = %s";
        $params[] = sanitize_text_field($context);
    }
    
    if (!empty($action)) {
        $sql .= " AND action = %s";
        $params[] = sanitize_text_field($action);
    }
    
    // Add order and limit
    $sql .= " ORDER BY action_time DESC LIMIT %d";
    $params[] = $limit;
    
    // Prepare and execute query
    $prepared_sql = $wpdb->prepare($sql, $params);
    $results = $wpdb->get_results($prepared_sql);
    
    // Process results
    foreach ($results as &$result) {
        if (!empty($result->details)) {
            $result->details = json_decode($result->details, true);
        } else {
            $result->details = [];
        }
    }
    
    return $results;
}

/**
 * Get recent site activity across all users
 *
 * @param int    $limit   Maximum number of records to retrieve
 * @param string $context Optional context filter
 * @return array          Array of activity records with user data
 */
function get_recent_site_activity($limit = 10, $context = null) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
    $limit = absint($limit);
    
    // Build query
    $sql = "SELECT a.*, u.display_name 
            FROM $table_name a 
            LEFT JOIN {$wpdb->users} u ON a.user_id = u.ID";
    $params = [];
    
    // Add optional context filter
    if (!empty($context)) {
        $sql .= " WHERE context = %s";
        $params[] = sanitize_text_field($context);
    }
    
    // Add order and limit
    $sql .= " ORDER BY action_time DESC LIMIT %d";
    $params[] = $limit;
    
    // Prepare and execute query
    $prepared_sql = empty($params) ? $sql : $wpdb->prepare($sql, $params);
    $results = $wpdb->get_results($prepared_sql);
    
    // Process results
    foreach ($results as &$result) {
        if (!empty($result->details)) {
            $result->details = json_decode($result->details, true);
        } else {
            $result->details = [];
        }
    }
    
    return $results;
}

/**
 * Display user activity in a formatted table
 *
 * @param int    $user_id The ID of the user
 * @param int    $limit   Maximum number of records to display
 * @param string $context Optional context filter
 * @param bool   $echo    Whether to echo the output or return it
 * @return string         HTML output if $echo is false
 */
function display_user_activity($user_id, $limit = 10, $context = null, $echo = true) {
    $activities = get_user_activity($user_id, $limit, $context);
    
    ob_start();
    ?>
    <div class="user-activity-log">
        <table class="table align-middle table-row-dashed gy-5">
            <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                <tr class="text-start text-muted text-uppercase gs-0">
                    <th>تاریخ</th>
                    <th>فعالیت</th>
                    <th>بخش</th>
                    <th class="text-end">جزئیات</th>
                </tr>
            </thead>
            <tbody class="fs-6 fw-semibold text-gray-600">
                <?php if (empty($activities)) : ?>
                    <tr>
                        <td colspan="4" class="text-center">هیچ فعالیتی ثبت نشده است.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($activities as $activity) : ?>
                        <tr>
                            <td><?php   
                            if (function_exists('jdate')) {
                                echo jdate(get_option('date_format') . ' ' . get_option('time_format'), strtotime($activity->action_time));
                            } else {
                                echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($activity->action_time));
                            } ?></td>
                            <td><?php echo get_action_display_name($activity->action); ?></td>
                            <td><?php echo get_context_display_name($activity->context); ?></td>
                            <td class="text-end">
                                <?php 
                                if (!empty($activity->details)) {
                                    echo format_activity_details($activity->details);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
    $output = ob_get_clean();
    
    if ($echo) {
        echo $output;
    }
    
    return $output;
}

/**
 * Display site-wide activity in a formatted table
 *
 * @param int    $limit   Maximum number of records to display
 * @param string $context Optional context filter
 * @param bool   $echo    Whether to echo the output or return it
 * @return string         HTML output if $echo is false
 */
function display_site_activity($limit = 10, $context = null, $echo = true) {
    $activities = get_recent_site_activity($limit, $context);
    
    ob_start();
    ?>
    <div class="site-activity-log">
        <table class="table align-middle table-row-dashed gy-5">
            <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                <tr class="text-start text-muted text-uppercase gs-0">
                    <th>تاریخ</th>
                    <th>کاربر</th>
                    <th>فعالیت</th>
                    <th>بخش</th>
                    <th class="text-end">جزئیات</th>
                </tr>
            </thead>
            <tbody class="fs-6 fw-semibold text-gray-600">
                <?php if (empty($activities)) : ?>
                    <tr>
                        <td colspan="5" class="text-center">هیچ فعالیتی ثبت نشده است.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($activities as $activity) : ?>
                        <tr>
                            <td><?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($activity->action_time)); ?></td>
                            <td>
                                <a href="<?php echo admin_url('user-edit.php?user_id=' . $activity->user_id); ?>">
                                    <?php echo $activity->display_name; ?>
                                </a>
                            </td>
                            <td><?php echo get_action_display_name($activity->action); ?></td>
                            <td><?php echo get_context_display_name($activity->context); ?></td>
                            <td class="text-end">
                                <?php 
                                if (!empty($activity->details)) {
                                    echo format_activity_details($activity->details);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
    $output = ob_get_clean();
    
    if ($echo) {
        echo $output;
    }
    
    return $output;
}

/**
 * Format activity details for display
 *
 * @param array $details Activity details
 * @return string       Formatted details
 */
function format_activity_details($details) {
    if (empty($details)) {
        return '-';
    }
    
    $formatted = [];
    
    foreach ($details as $key => $value) {
        if ($key === 'ip_address') {
            $formatted[] = 'IP: ' . esc_html($value);
        } elseif ($key === 'id' && !empty($value)) {
            $formatted[] = 'شناسه: ' . esc_html($value);
        } elseif ($key === 'title' && !empty($value)) {
            $formatted[] = 'عنوان: ' . esc_html($value);
        } else {
            $formatted[] = esc_html($key) . ': ' . esc_html($value);
        }
    }
    
    return implode(', ', $formatted);
}

/**
 * Get human-readable action name
 *
 * @param string $action Action key
 * @return string        Human-readable action name
 */
function get_action_display_name($action) {
    $actions = [
        'login' => 'ورود به سیستم',
        'logout' => 'خروج از سیستم',
        'session_end' => 'پایان نشست',
        'register' => 'ثبت نام',
        'create' => 'ایجاد',
        'update' => 'بروزرسانی',
        'delete' => 'حذف',
        'delete-failed' => 'حذف انجام نشد',
        'view' => 'مشاهده',
        'download' => 'دانلود',
        'upload' => 'آپلود',
        'password_reset' => 'بازنشانی رمز عبور',
        'settings_change' => 'تغییر تنظیمات',
        'export' => 'خروجی گرفتن',
        'import' => 'ورود اطلاعات',
        'print' => 'چاپ',
        'share' => 'اشتراک‌گذاری',
        'approve' => 'تایید',
        'reject' => 'رد',
        'assign' => 'اختصاص دادن',
        'unassign' => 'لغو اختصاص',
        'block' => 'مسدود کردن',
        'unblock' => 'رفع انسداد',
        'add_interaction' => 'کامنت گذاری برای مشتری',
        'delete_interaction' => 'حذف کامنت مشتری'
    ];
    
    return isset($actions[$action]) ? $actions[$action] : $action;
}

/**
 * Get human-readable context name
 *
 * @param string $context Context key
 * @return string         Human-readable context name
 */
function get_context_display_name($context) {
    $contexts = [
        'authentication' => 'احراز هویت',
        'customer' => 'مشتری',
        'post' => 'نوشته',
        'page' => 'صفحه',
        'user' => 'کاربر',
        'comment' => 'دیدگاه',
        'media' => 'رسانه',
        'settings' => 'تنظیمات',
        'product' => 'محصول',
        'order' => 'سفارش',
    ];
    
    return isset($contexts[$context]) ? $contexts[$context] : $context;
}

/**
 * Register hooks to track common WordPress actions
 */
function register_default_activity_hooks() {
    // Authentication actions
    add_action('wp_login', 'track_user_login', 10, 2);
    add_action('wp_logout', 'track_user_logout');
    add_action('user_register', 'track_user_registration');
    add_action('password_reset', 'track_password_reset', 10, 2);
    
    // Post/Page actions
    add_action('save_post', 'track_post_save', 10, 3);
    add_action('delete_post', 'track_post_delete');
    
    // User profile actions
    add_action('profile_update', 'track_profile_update', 10, 2);
    add_action('deleted_user', 'track_user_delete');
    
    // Comment actions
    add_action('wp_insert_comment', 'track_comment_insert', 10, 2);
    add_action('deleted_comment', 'track_comment_delete', 10, 2);
    
    // WooCommerce actions (if available)
    if (class_exists('WooCommerce')) {
        add_action('woocommerce_order_status_changed', 'track_order_status_change', 10, 4);
        add_action('woocommerce_new_product', 'track_product_create');
        add_action('woocommerce_update_product', 'track_product_update');
    }
    
    // Add new hook for session end
    add_action('clear_auth_cookie', 'track_session_end');
}

/**
 * Track user login action
 *
 * @param string  $user_login Username
 * @param WP_User $user       User object
 */
function track_user_login($user_login, $user) {
    track_user_action(
        $user->ID,
        'login',
        'authentication',
        ['ip_address' => $_SERVER['REMOTE_ADDR']]
    );
    
    // Update last login time
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}

/**
 * Track user logout action
 */
function track_user_logout() {
    $user_id = get_current_user_id();
    if ($user_id) {
        track_user_action(
            $user_id,
            'logout',
            'authentication',
            ['ip_address' => $_SERVER['REMOTE_ADDR']]
        );
    }
}

/**
 * Track user registration
 *
 * @param int $user_id User ID
 */
function track_user_registration($user_id) {
    track_user_action(
        $user_id,
        'register',
        'user',
        ['ip_address' => $_SERVER['REMOTE_ADDR']]
    );
}

/**
 * Track password reset
 *
 * @param WP_User $user     User object
 * @param string  $new_pass New password (not used)
 */
function track_password_reset($user, $new_pass) {
    track_user_action(
        $user->ID,
        'password_reset',
        'authentication',
        ['ip_address' => $_SERVER['REMOTE_ADDR']]
    );
}

/**
 * Track post save
 *
 * @param int     $post_id Post ID
 * @param WP_Post $post    Post object
 * @param bool    $update  Whether this is an update
 */
function track_post_save($post_id, $post, $update) {
    // Don't track auto-saves or revisions
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || $post->post_status === 'auto-draft') {
        return;
    }
    
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    $action = $update ? 'update' : 'create';
    $context = $post->post_type;
    
    track_user_action(
        $user_id,
        $action,
        $context,
        [
            'id' => $post_id,
            'title' => $post->post_title
        ]
    );
}

/**
 * Track post deletion
 *
 * @param int $post_id Post ID
 */
function track_post_delete($post_id) {
    // Don't track revisions
    if (wp_is_post_revision($post_id)) {
        return;
    }
    
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    $post = get_post($post_id);
    if (!$post) {
        return;
    }
    
    track_user_action(
        $user_id,
        'delete',
        $post->post_type,
        [
            'id' => $post_id,
            'title' => $post->post_title
        ]
    );
}

/**
 * Track profile update
 *
 * @param int     $user_id       User ID
 * @param WP_User $old_user_data Old user object
 */
function track_profile_update($user_id, $old_user_data) {
    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return;
    }
    
    track_user_action(
        $current_user_id,
        'update',
        'user',
        [
            'id' => $user_id,
            'user_login' => $old_user_data->user_login
        ]
    );
}

/**
 * Track user deletion
 *
 * @param int $user_id User ID
 */
function track_user_delete($user_id) {
    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return;
    }
    
    $user = get_userdata($user_id);
    if (!$user) {
        return;
    }
    
    track_user_action(
        $current_user_id,
        'delete',
        'user',
        [
            'id' => $user_id,
            'user_login' => $user->user_login
        ]
    );
}

/**
 * Track comment insertion
 *
 * @param int        $comment_id Comment ID
 * @param WP_Comment $comment    Comment object
 */
function track_comment_insert($comment_id, $comment) {
    if (!$comment->user_id) {
        return;
    }
    
    track_user_action(
        $comment->user_id,
        'create',
        'comment',
        [
            'id' => $comment_id,
            'post_id' => $comment->comment_post_ID
        ]
    );
}

/**
 * Track comment deletion
 *
 * @param int        $comment_id Comment ID
 * @param WP_Comment $comment    Comment object
 */
function track_comment_delete($comment_id, $comment) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    track_user_action(
        $user_id,
        'delete',
        'comment',
        [
            'id' => $comment_id,
            'post_id' => $comment->comment_post_ID
        ]
    );
}

/**
 * Track WooCommerce order status change
 *
 * @param int    $order_id   Order ID
 * @param string $old_status Old status
 * @param string $new_status New status
 */
function track_order_status_change($order_id, $old_status, $new_status, $order) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    track_user_action(
        $user_id,
        'update',
        'order',
        [
            'id' => $order_id,
            'old_status' => $old_status,
            'new_status' => $new_status
        ]
    );
}

/**
 * Track WooCommerce product creation
 *
 * @param int $product_id Product ID
 */
function track_product_create($product_id) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    $product = wc_get_product($product_id);
    if (!$product) {
        return;
    }
    
    track_user_action(
        $user_id,
        'create',
        'product',
        [
            'id' => $product_id,
            'title' => $product->get_name()
        ]
    );
}

/**
 * Track WooCommerce product update
 *
 * @param int $product_id Product ID
 */
function track_product_update($product_id) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return;
    }
    
    $product = wc_get_product($product_id);
    if (!$product) {
        return;
    }
    
    track_user_action(
        $user_id,
        'update',
        'product',
        [
            'id' => $product_id,
            'title' => $product->get_name()
        ]
    );
}

/**
 * Register admin dashboard widget
 */
function register_activity_dashboard_widget() {
    wp_add_dashboard_widget(
        'user_activity_dashboard',
        'فعالیت‌های اخیر سایت',
        'render_activity_dashboard_widget'
    );
}

/**
 * Render admin dashboard widget
 */
function render_activity_dashboard_widget() {
    display_site_activity(5);
    
    echo '<p class="activity-view-all">';
    echo '<a href="' . admin_url('admin.php?page=user-activity-logs') . '">مشاهده همه فعالیت‌ها</a>';
    echo '</p>';
}

/**
 * Register user activity admin page
 */
function register_activity_admin_page() {
    add_menu_page(
        'فعالیت‌های کاربران',
        'فعالیت‌های کاربران',
        'manage_options',
        'user-activity-logs',
        'render_activity_admin_page',
        'dashicons-visibility',
        30
    );
}
add_action('admin_menu', 'register_activity_admin_page');

/**
 * Render admin page for activity logs
 */
function render_activity_admin_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        wp_die(__('شما اجازه دسترسی به این بخش را ندارید.', 'hdm-crm'));
    }

    // Create an instance of our list table class
    $activity_table = new User_Activity_List_Table();
    
    // Handle any actions (like bulk actions)
    $activity_table->process_bulk_action();
    
    // Prepare items for display
    $activity_table->prepare_items();
    
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html__('فعالیت‌های کاربران', 'hdm-crm'); ?></h1>
        
        <form id="activity-filter" method="get">
            <!-- Need to ensure these inputs -->
            <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />
            <?php wp_nonce_field('bulk-' . $activity_table->_args['plural']); ?>
            
            <!-- Display the table -->
            <?php $activity_table->display(); ?>
        </form>
    </div>
    <?php
}

/**
 * User activity shortcode
 *
 * @param array $atts Shortcode attributes
 * @return string     Shortcode output
 */
function user_activity_shortcode($atts) {
    $atts = shortcode_atts([
        'user_id' => 'current',
        'limit' => 10,
        'context' => null,
    ], $atts, 'user_activity');
    
    // Determine user ID
    if ($atts['user_id'] === 'current') {
        $user_id = get_current_user_id();
        if (!$user_id) {
            return '<p class="activity-error">شما باید وارد سیستم شوید تا فعالیت‌های خود را مشاهده کنید.</p>';
        }
    } else {
        $user_id = absint($atts['user_id']);
        if (!$user_id) {
            return '<p class="activity-error">شناسه کاربر نامعتبر است.</p>';
        }
    }
    
    // Display activity
    return display_user_activity($user_id, absint($atts['limit']), $atts['context'], false);
}

/**
 * Add custom meta box to user profile
 */
function add_activity_meta_box() {
    add_meta_box(
        'user_activity_meta_box',
        'فعالیت‌های اخیر کاربر',
        'render_user_activity_meta_box',
        'user-edit',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes_user-edit', 'add_activity_meta_box');

/**
 * Render activity meta box for user profile
 *
 * @param WP_User $user User object
 */
function render_user_activity_meta_box($user) {
    display_user_activity($user->ID, 5);
    
    echo '<p>';
    echo '<a href="' . admin_url('admin.php?page=user-activity-logs&user_id=' . $user->ID) . '">مشاهده همه فعالیت‌های این کاربر</a>';
    echo '</p>';
}

/**
 * Add activity tab to user profile in frontend
 *
 * @param array $tabs Existing tabs
 * @return array      Modified tabs
 */
function add_activity_tab_to_account($tabs) {
    $tabs['activity'] = [
        'title' => 'فعالیت‌های اخیر',
        'priority' => 50
    ];
    
    return $tabs;
}
add_filter('woocommerce_account_menu_items', 'add_activity_tab_to_account');

/**
 * Add endpoint for activity tab
 */
function add_activity_endpoint() {
    add_rewrite_endpoint('activity', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_activity_endpoint');

/**
 * Display activity content in user account
 */
function account_activity_content() {
    $user_id = get_current_user_id();
    
    echo '<h3>فعالیت‌های اخیر شما</h3>';
    display_user_activity($user_id, 10);
}
add_action('woocommerce_account_activity_endpoint', 'account_activity_content');

/**
 * Helper function to delete old activity logs
 * 
 * @param int $days Number of days to keep logs (default: 90)
 * @return int      Number of records deleted
 */
function delete_old_activity_logs($days = 90) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
    $cutoff_date = date('Y-m-d H:i:s', strtotime("-$days days"));
    
    $query = $wpdb->prepare(
        "DELETE FROM $table_name WHERE action_time < %s",
        $cutoff_date
    );
    
    $wpdb->query($query);
    
    return $wpdb->rows_affected;
}

/**
 * Schedule cleanup of old logs
 */
function schedule_activity_logs_cleanup() {
    if (!wp_next_scheduled('activity_logs_cleanup')) {
        wp_schedule_event(time(), 'weekly', 'activity_logs_cleanup');
    }
}
add_action('wp', 'schedule_activity_logs_cleanup');

/**
 * Cleanup old logs on scheduled event
 */
function do_activity_logs_cleanup() {
    $retention_days = apply_filters('user_activity_retention_days', 90);
    delete_old_activity_logs($retention_days);
}
add_action('activity_logs_cleanup', 'do_activity_logs_cleanup');

/**
 * Add styles for activity tables
 */
function enqueue_activity_styles() {
    $screen = get_current_screen();
    
    if ($screen && ($screen->id === 'dashboard' || $screen->id === 'toplevel_page_user-activity-logs')) {
        wp_enqueue_style(
            'user-activity-admin-styles',
            false,
            [],
            USER_ACTIVITY_VERSION
        );
        
        wp_add_inline_style('user-activity-admin-styles', '
            .activity-filters {
                display: flex;
                margin-bottom: 20px;
                flex-wrap: wrap;
                align-items: end;
            }
            .activity-filter {
                margin-right: 15px;
                margin-bottom: 10px;
            }
            .activity-filter label {
                display: block;
                margin-bottom: 5px;
                font-weight: 600;
            }
            .activity-view-all {
                text-align: right;
                margin-top: 10px;
            }
        ');
    }
}
add_action('admin_enqueue_scripts', 'enqueue_activity_styles');

/**
 * Track when user session ends (cookie cleared)
 */
function track_session_end() {
    $user_id = get_current_user_id();
    if ($user_id) {
        track_user_action(
            $user_id,
            'session_end',
            'authentication',
            ['ip_address' => $_SERVER['REMOTE_ADDR']]
        );
    }
}

/**
 * Track customer management actions
 *
 * @param int    $user_id      The ID of the user performing the action
 * @param int    $customer_id  The ID of the customer being acted upon
 * @param string $action       The action being performed (create, update, delete, view)
 * @param array  $details      Optional additional details about the action
 */
function track_customer_action($user_id, $customer_id, $action, $details = []) {
    // Add customer ID to details if not present
    if (!isset($details['customer_id'])) {
        $details['customer_id'] = $customer_id;
    }
    
    // Add customer name to details if available
    $customer_name = get_the_title($customer_id);
    if ($customer_name) {
        $details['customer_name'] = $customer_name;
    }
    
    track_user_action($user_id, $action, 'customer', $details);
}

/**
 * Track user management actions
 *
 * @param int    $admin_id    The ID of the admin performing the action
 * @param int    $target_id   The ID of the user being acted upon
 * @param string $action      The action being performed (create, update, delete, view)
 * @param array  $details     Optional additional details about the action
 */
function track_user_management_action($admin_id, $target_id, $action, $details = []) {
    // Add target user ID to details if not present
    if (!isset($details['target_user_id'])) {
        $details['target_user_id'] = $target_id;
    }
    
    // Add target username to details if available
    $user_data = get_userdata($target_id);
    if ($user_data) {
        $details['target_username'] = $user_data->user_login;
    }
    
    track_user_action($admin_id, $action, 'user_management', $details);
}
